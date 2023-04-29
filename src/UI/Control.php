<?php
/*
 * BSD 3-Clause License
 *
 * Copyright (c) 2023, TASoft Applications
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 *
 *  Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 *  Neither the name of the copyright holder nor the names of its
 *   contributors may be used to endorse or promote products derived from
 *   this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 */

namespace Ikarus\SPS\Dev\UI;

class Control extends Name
{
	const TYPE_STRING = 'text';
	const TYPE_NUMBER = 'number';
	const TYPE_BOOL = 'bool';
	const TYPE_LIST = 'list';

	const TYPE_GPIO = 'gpio';

	private $type;
	private $required;

	private $list;

	private static $default_list_generator;

	public function __construct(string $name, string $type, bool $required = false)
	{
		parent::__construct($name);
		$this->type = $type;
		$this->required = $required;
	}

	/**
	 * @return callable
	 */
	public static function getDefaultListGenerator(): ?callable
	{
		return self::$default_list_generator;
	}

	/**
	 * @param callable $default_list_generator
	 */
	public static function setDefaultListGenerator(callable $default_list_generator): void
	{
		self::$default_list_generator = $default_list_generator;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @return bool
	 */
	public function isRequired(): bool
	{
		return $this->required;
	}

	/**
	 * @return null|string|array|callable
	 */
	public function getList()
	{
		if($this->type == self::TYPE_LIST && !$this->list && self::$default_list_generator)
			return (self::getDefaultListGenerator())($this);
		return $this->list;
	}

	/**
	 * @param string|array|callable $list
	 */
	public function setList($list)
	{
		$this->list = $list;
		return $this;
	}
}