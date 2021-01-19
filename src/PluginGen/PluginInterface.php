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


interface PluginInterface
{
	/**
	 * Returns the required plugin class
	 *
	 * @return string
	 */
	public function getClass(): string;

	/**
	 * Uniquely identifiers this plugin instance inside the whole Ikarus SPS
	 *
	 * @return string
	 */
	public function getIdentifier(): string;

	/**
	 * The array may return any value to be passed to the plugin's constructor.
	 * Any passed DynamicArgument gets resolved on runtime
	 *
	 * @return array
	 */
	public function getConstructor(): array;

	/**
	 * A human readable label to present it to the user.
	 *
	 * @return string
	 */
	public function getPluginName(): string;

	/**
	 * A description presented to the user to explain this plugin instance
	 *
	 * @return string|null
	 */
	public function getPluginDescription(): ?string;

	/**
	 * Creates an executable php code string that will create the plugin instance
	 *
	 * @return string
	 */
	public function construct(): string;
}