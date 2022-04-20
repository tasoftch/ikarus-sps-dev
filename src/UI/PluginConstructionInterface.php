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


use Skyline\HTML\Form\FormElement;

interface PluginConstructionInterface
{
	/**
	 * Called to setup the form
	 *
	 * @param FormElement $formElement
	 */
	public function setupForm(FormElement $formElement);

	/**
	 * Use this default values if no data was stored.
	 * This method also identifies the keys used by the construction
	 *
	 * @return array
	 */
	public function getDefaultValues(): array;

	/**
	 * Specify the labels for human reading of the values
	 *
	 * @return array
	 */
	public function getDefaultValueLabels(): array;

	/**
	 * Called to map the persistent values into the form
	 *
	 * @param array $data
	 * @return array|null
	 */
	public function getValuesFromStorage(array $data): ?array;

	/**
	 * Called to remap the form's values into the storage.
	 *
	 * @param array $data
	 * @return array|null
	 */
	public function getStorageFromValues(array $data): ?array;

	/**
	 * Can add some options to the pin link process such as resistor settings.
	 *
	 * @param string $pinName
	 * @param array $formData
	 * @return int
	 */
	public function getPinOptionsBeforeLinking($pinName, array $formData): int;
}