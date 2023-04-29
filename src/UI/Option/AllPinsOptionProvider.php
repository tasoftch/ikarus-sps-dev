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

namespace Ikarus\SPS\Dev\UI\Option;


use Skyline\HTML\Form\Control\Option\Provider\OptionProviderInterface;

class AllPinsOptionProvider implements OptionProviderInterface
{
	const PIN_ALL_GPIO = -1;
	const PIN_ANY_GPIO = -2;


	/** @var callable This factory gets injected by Ikarus SPS Web Interface */
	protected static $factory;

	/** @var int|array */
	private $acceptedPins;

	protected $mods = ['all'];

	public function __construct($acceptedPins = self::PIN_ALL_GPIO)
	{
		$this->acceptedPins = $acceptedPins;
	}

	public function yieldOptions(?string &$group): \Generator
	{
		yield from (self::$factory)($this->getAcceptedPins(), $this->mods, $group);
	}

	/**
	 * @return array|int
	 */
	public function getAcceptedPins()
	{
		return $this->acceptedPins;
	}

}