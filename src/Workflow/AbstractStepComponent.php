<?php
/*
 * BSD 3-Clause License
 *
 * Copyright (c) 2022, TASoft Applications
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

namespace Ikarus\SPS\Dev\Workflow;

use Ikarus\SPS\Dev\Workflow\Model\FormGroup;
use Ikarus\SPS\Dev\Workflow\Model\Group;
use Ikarus\SPS\Dev\Workflow\Model\Tag;
use Skyline\HTML\Form\Control\ControlInterface;

abstract class AbstractStepComponent extends \Ikarus\SPS\Workflow\Model\AbstractStepComponent
{
	/** @var ControlInterface[] */
	private $controls = [];
	private $groupName;
	private $tags = [];

	public function __construct(string $componentName, ...$items)
	{
		foreach($items as &$item) {
			if($item instanceof ControlInterface)
				$this->controls[$item->getName()] = $item;
			if($item instanceof Group) {
				$this->groupName = $item->getName();
				$item=NULL;
			}

			if($item instanceof Tag) {
				$this->tags[] = $item->getName();
				$item = NULL;
			}
		}
		parent::__construct($componentName, ... $items);
	}

	/**
	 * @return ControlInterface[]
	 */
	public function getControls(): array
	{
		return $this->controls;
	}

	/**
	 * @return mixed
	 */
	public function getGroupName()
	{
		return $this->groupName;
	}

	/**
	 * @return array
	 */
	public function getTags(): array
	{
		return $this->tags;
	}
}