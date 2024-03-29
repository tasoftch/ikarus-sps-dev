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


class PinoutDefinition extends Name
{
	const DEF_DIGITAL_INPUT = 'dinp';
	const DEF_DIGITAL_INPUT_WITH_PLUG = 'dinpp';
	const DEF_ANALOG_INPUT = 'ainp';
	const DEF_DIFFERENCE_ANALOG_INPUT = 'dainp';
	const DEF_DIGITAL_OUTPUT = 'dout';
	const DEF_DIGITAL_OUTPUT_RELAIS = 'doutr';
	const DEF_ANALOG_OUTPUT = 'aout';
	const DEF_ANALOG_OUTPUT_WITH_MEASURE = 'aoutp';


	/** @var string */
	private $definition;
	/** @var string */
	private $label;

	/**
	 * PinoutDefinition constructor.
	 *
	 * The name specifies the argument name in the constructor.
	 *
	 * @param string $name
	 * @param string $definition
	 * @param string|null $label
	 */
	public function __construct(string $name, string $definition,  string $label = NULL)
	{
		parent::__construct($name);
		$this->definition = $definition;
		$this->label = $label;
	}

	/**
	 * @return string
	 */
	public function getDefinition(): string
	{
		return $this->definition;
	}

	/**
	 * @return string
	 */
	public function getLabel(): ?string
	{
		return $this->label;
	}
}