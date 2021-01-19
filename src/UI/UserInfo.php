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

namespace Ikarus\SPS\Dev\UI;


class UserInfo implements UserInfoInterface
{
	/** @var string */
	private $name, $group;
	/** @var string|null */
	private $description;

	/** @var Command[] */
	private $commands = [];

	/** @var Status[] */
	private $status = [];

	/** @var Value[] */
	private $values = [];

	/** @var Declaration[] */
	private $declarations = [];

	/** @var Pin[] */
	private $desiredPins = [];

	private $construction;

	/**
	 * UserInfo constructor.
	 * @param Name|Description|Command[]|Status[]
	 */
	public function __construct(...$items)
	{
		foreach($items as $item) {
			if($item instanceof Value)
				$this->values[] = $item;
			elseif($item instanceof Status)
				$this->status[] = $item;
			elseif($item instanceof Pin)
				$this->desiredPins[] = $item;
			elseif($item instanceof Command)
				$this->commands[] = $item;
			elseif($item instanceof Description)
				$this->description = (string)$item;
			elseif($item instanceof Group)
				$this->group = (string)$item;
			elseif($item instanceof Declaration)
				$this->declarations[] = $item;
			elseif($item instanceof Name)
				$this->name = (string)$item;
			elseif($item instanceof PluginConstructionInterface)
				$this->construction = $item;
		}
	}


	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return string|null
	 */
	public function getGroup(): ?string
	{
		return $this->group;
	}

	/**
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @return Command[]
	 */
	public function getCommands(): array
	{
		return $this->commands;
	}

	/**
	 * @return Status[]
	 */
	public function getStatus(): array
	{
		return $this->status;
	}

	/**
	 * @return Value[]
	 */
	public function getValues(): array
	{
		return $this->values;
	}

	public function getPluginConstruction(): ?PluginConstructionInterface
	{
		return $this->construction;
	}

	/**
	 * @return Declaration[]
	 */
	public function getDeclarations(): array
	{
		return $this->declarations;
	}

	/**
	 * @return Pin[]
	 */
	public function getDesiredPins(): array
	{
		return $this->desiredPins;
	}
}