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

namespace Ikarus\SPS\Dev\UI\Simulator;


interface EnvironmentInterface
{
	/**
	 * Finds the sent pin definitions
	 *
	 * @return PinDefinitionInterface[]
	 */
	public function getPinDefinitions(): array;

	/**
	 * Finds a specific pin definition selected using the constructor argument name
	 *
	 * @param string $pinArgumentName
	 * @return PinDefinitionInterface|null
	 */
	public function getPinDefinition(string $pinArgumentName): ?PinDefinitionInterface;

	/**
	 * Returns the live user specified constructor argument value during the simulation
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function get(string $name);

	/**
	 * Returns the name of a command rendered by your html template under the attribute data-command
	 *
	 * @return string|null
	 */
	public function getSentCommand(): ?string;

	/**
	 * Returns a sent value by the rendered simulation template under the attribute data-value (only input, textarea or select elements)
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function getSentValue(string $name);
}