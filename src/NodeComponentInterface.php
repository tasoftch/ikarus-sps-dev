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

namespace Ikarus\SPS\Dev;


use Ikarus\SPS\Dev\Node\Control;
use Ikarus\SPS\Dev\Node\Socket\Input;
use Ikarus\SPS\Dev\Node\Socket\Output;

interface NodeComponentInterface
{
	/**
	 * The component's name. It must not change at all cause all already created nodes are invalid
	 *
	 * @return string
	 */
	public function getName(): string;

	/**
	 * Gets a default label for any created node on the scene
	 *
	 * @return string|null
	 */
	public function getLabel(): ?string;

	/**
	 * Defines, where to put the component inside of the new component context menu
	 *
	 * @return array|null
	 */
	public function getMenuPath(): ?array;

	/**
	 * Defines all possible input's
	 *
	 * @return Output[]
	 */
	public function getOutputs(): array;

	/**
	 * @return Input[]
	 */
	public function getInputs(): array;

	/**
	 * @return Control[]
	 */
	public function getControls(): array;

	/**
	 * Exports a closure with instructions to handle the component.
	 * Please note that the closure will not run in the classes context!
	 *
	 * @return \Closure
	 */
	public function getExecutable(): \Closure;
}