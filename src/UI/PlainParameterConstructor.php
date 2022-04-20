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


use Skyline\HTML\Form\Control\ControlInterface;
use Skyline\HTML\Form\FormElement;

class PlainParameterConstructor implements PluginConstructionInterface
{
	private $fieldNames = [];
	private $controls = [];
	private $labels = [];
	private $defaults = [];
	private $valueHandlers = [];
	private $storageHandlers = [];
	private $optionGens = [];

	public function __construct(...$defaultFieldNames)
	{
		foreach($defaultFieldNames as $name) {
			$this->fieldNames[$name] = $name;
			$this->defaults[$name] = NULL;
		}

		$this->fieldNames = array_values($this->fieldNames);
	}

	/**
	 * @param $name
	 * @return static
	 */
	public function setControl(ControlInterface $control) {
		if(in_array($control->getName(), $this->fieldNames))
			$this->controls[$control->getName()] = $control;
		return $this;
	}

	/**
	 * @param $name
	 * @param $label
	 * @return static
	 */
	public function setLabel($name, $label) {
		if(in_array($name, $this->fieldNames))
			$this->labels[$name] = $label;
		return $this;
	}

	/**
	 * @param $name
	 * @param $default
	 * @return static
	 */
	public function setDefault($name, $default) {
		if(in_array($name, $this->fieldNames))
			$this->defaults[$name] = $default;
		return $this;
	}

	/**
	 * @param $name
	 * @param callable $handler
	 * @return static
	 */
	public function setValueHandler($name, callable $handler) {
		if(in_array($name, $this->fieldNames))
			$this->valueHandlers[$name] = $handler;
		return $this;
	}

	/**
	 * @param $name
	 * @param callable $handler
	 * @return static
	 */
	public function setStorageHandler($name, callable $handler) {
		if(in_array($name, $this->fieldNames))
			$this->storageHandlers[$name] = $handler;
		return $this;
	}

	/**
	 * @param $pinName
	 * @param callable $generator
	 * @return static
	 */
	public function setOptionGenerator($pinName, callable $generator) {
		if(in_array($pinName, $this->fieldNames))
			$this->optionGens[$pinName] = $generator;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function setupForm(FormElement $formElement)
	{
		foreach($this->controls as $control) {
			$formElement->appendElement( $control );
		}
	}

	public function getDefaultValueLabels(): array
	{
		return $this->labels;
	}

	/**
	 * @inheritDoc
	 */
	public function getDefaultValues(): array
	{
		return $this->defaults;
	}

	/**
	 * @inheritDoc
	 */
	public function getValuesFromStorage(array $data): ?array
	{
		foreach($data as $name => &$value) {
			if($h = $this->valueHandlers[$name] ?? NULL)
				$value = $h($value);
		}
		return $data ?: NULL;
	}

	/**
	 * @inheritDoc
	 */
	public function getStorageFromValues(array $data): ?array
	{
		foreach($data as $name => &$value) {
			if($h = $this->storageHandlers[$name] ?? NULL)
				$value = $h($value);
		}
		return $data ?: NULL;
	}

	/**
	 * @inheritDoc
	 */
	public function getPinOptionsBeforeLinking($pinName, array $formData): int
	{
		if(isset($this->optionGens[$pinName]))
			return ($this->optionGens[$pinName])($formData);
		return 0;
	}
}