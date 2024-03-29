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

	/** @var PinoutDefinition[]|null */
	private $pinoutDefinitions;

	private $construction;

	/** @var Readonly|null */
	private $readonly;

	/** @var Writeonly */
	private $writeonly;

	private $statistics = [];

	/**
	 * UserInfo constructor.
	 * @param Name|Description|Command[]|Status[]
	 */
	public function __construct(...$items)
	{
		foreach($items as $item) {
			if($item instanceof StatisticsPush)
				$this->statistics[] = $item;
			elseif($item instanceof Writeonly)
				$this->writeonly = $item;
			elseif($item instanceof Readonly)
				$this->readonly = $item;
			elseif($item instanceof Value)
				$this->values[] = $item;
			elseif($item instanceof Status)
				$this->status[] = $item;
			elseif($item instanceof PinoutDefinition)
				$this->pinoutDefinitions[ $item->getName() ] = $item;
			elseif($item instanceof Command)
				$this->commands[] = $item;
			elseif($item instanceof Description)
				$this->description = (string)$item;
			elseif($item instanceof Group)
				$this->group = (string)$item;
			elseif($item instanceof Control && $this->construction instanceof PlainParameterConstructor) {
				$item->userInfo = $this;
				$this->construction->setControl($item);
			}
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
	 * @return PinoutDefinition[]|null
	 */
	public function getPinoutDefinitions(): ?array
	{
		return $this->pinoutDefinitions;
	}

	public function isReadonly(InteractionElementInterface $element): bool {
		if($this->readonly)
			return in_array($element->getName(), $this->readonly->getKeys()) || in_array(get_class($element), $this->readonly->getKeys());
		return false;
	}

	public function isWriteonly(InteractionElementInterface $element): bool {
		if($this->writeonly)
			return in_array($element->getName(), $this->writeonly->getKeys()) || in_array(get_class($element), $this->writeonly->getKeys());
		return false;
	}

	/**
	 * @return array
	 */
	public function getStatistics(): array
	{
		return $this->statistics;
	}
}