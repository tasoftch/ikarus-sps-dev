<?php
/*
 * BSD 3-Clause License
 *
 * Copyright (c) 2021, TASoft Applications
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

namespace Ikarus\SPS\Dev\PluginGen;


use Ikarus\SPS\Dev\PluginGen\Argument\ArgumentInterface;
use Ikarus\SPS\Dev\PluginGen\Argument\StaticArgument;

class Plugin implements PluginInterface
{
	/** @var string */
	private $_class;
	/** @var string */
	private $identifier;
	/** @var string */
	private $pluginName;
	/** @var string|null */
	private $pluginDescription;
	/** @var ArgumentInterface */
	private $constructor = [];

	public function __construct(string $class, string $identifier, ...$args)
	{
		$this->_class = $class;
		$this->identifier = $identifier;

		$this->constructor[] = new StaticArgument($identifier);

		foreach($args as $item) {
			if($item instanceof Description)
				$this->pluginDescription = (string)$item;
			elseif($item instanceof Name)
				$this->pluginName = (string)$item;
			elseif($item instanceof ArgumentInterface)
				$this->constructor[] = $item;
		}
	}

	/**
	 * @return string
	 */
	public function getClass(): string
	{
		return $this->_class;
	}

	/**
	 * @return string
	 */
	public function getPluginName(): string
	{
		return $this->pluginName;
	}

	/**
	 * @return string|null
	 */
	public function getPluginDescription(): ?string
	{
		return $this->pluginDescription;
	}

	/**
	 * @return array
	 */
	public function getConstructor(): array
	{
		return $this->constructor;
	}

	public function construct(): string {
		return sprintf("new %s(%s)", $this->getClass(), implode(",", array_map(function(ArgumentInterface $argument) {
			return $argument->export();
		}, $this->getConstructor())));
	}

	/**
	 * @return string
	 */
	public function getIdentifier(): string
	{
		return $this->identifier;
	}
}