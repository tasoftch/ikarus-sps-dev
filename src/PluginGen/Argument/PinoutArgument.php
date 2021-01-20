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

namespace Ikarus\SPS\Dev\PluginGen\Argument;


class PinoutArgument implements ArgumentInterface
{
	const OPTION_OUTPUT = 1<<0;

	const OPTION_RESISTOR_UP = 1<<1;
	const OPTION_RESISTOR_DOWN = 1<<2;
	const OPTION_PWM_OUTPUT = 1<<3 | self::OPTION_OUTPUT;

	const PIN_ALL_GPIO = -1;
	const PIN_ANY_GPIO = -2;

	/** @var int */
	private $pin;
	/** @var int */
	private $options;



	/**
	 * PinoutArgument constructor.
	 * @param int $pin
	 * @param int $options
	 */
	public function __construct(int $pin, int $options = 0)
	{
		$this->pin = $pin;
		$this->options = $options;
	}

	/**
	 * @return int
	 */
	public function getPin(): int
	{
		return $this->pin;
	}

	/**
	 * @return int
	 */
	public function getOptions(): int
	{
		return $this->options;
	}

	/**
	 * @inheritDoc
	 */
	public function export(): string
	{
		return sprintf("[%d, %d]", $this->getPin(), $this->getOptions());
	}
}