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

namespace Ikarus\SPS\Dev\Node;

use Ikarus\SPS\Dev\Node\Socket\Input;
use Ikarus\SPS\Dev\Node\Socket\Output;

abstract class AbstractNodeComponent implements NodeComponentInterface
{
	private $menuPath;
	private $inputs = [];
	private $outputs = [];
	private $controls = [];

	/**
	 * AbstractNode constructor.
	 * @param mixed ...$items
	 */
	public function __construct(...$items)
	{
		foreach($items as $item) {
			if($item instanceof Output)
				$this->outputs[ $item->getName() ] = $item;
			elseif($item instanceof Input)
				$this->inputs[ $item->getName() ] = $item;
			elseif($item instanceof MenuPath)
				$this->menuPath = $item->getPath();
			elseif($item instanceof Control)
				$this->controls[ $item->getName() ] = $item;
		}
	}

	/**
	 * @inheritDoc
	 */
	public function getLabel(): ?string
	{
		return ucfirst($this->getName());
	}

	/**
	 * @inheritDoc
	 */
	public function getMenuPath(): ?array
	{
		return $this->menuPath;
	}

	/**
	 * @inheritDoc
	 */
	public function getOutputs(): array
	{
		return $this->outputs;
	}

	public function getInputs(): array
	{
		return $this->inputs;
	}

	/**
	 * @return array
	 */
	public function getControls(): array
	{
		return $this->controls;
	}
}