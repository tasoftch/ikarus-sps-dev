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


use Ikarus\SPS\Dev\UI\UserInfoInterface;

interface PluginDescriptionInterface
{
	/** @var int placed as very first plugin, updated only once */
	const PLACEMENT_INIT = 1<<0;

	const PLACEMENT_CYCLE_BEGIN = 1<<1;

	const PLACEMENT_BEFORE_PROCEDURES = 1<<2;
	const PLACEMENT_AFTER_PROCEDURES = 1<<3;

	const PLACEMENT_BEFORE_RELATIONS = 1<<4;
	const PLACEMENT_AFTER_RELATIONS = 1<<5;

	const PLACEMENT_CYCLE_END = 1<<6;

	const PLACEMENT_END = 1<<7;


	const OPTION_STORABLE = 1<<0;
	const OPTION_EDITABLE_NAME = 1<<1;
	const OPTION_EDITABLE_DESCRIPTION = 1<<2;
	const OPTION_EDITABLE_CONSTRUCTION = 1<<3;

	const OPTION_SPAWNED = 1<<8;


	/**
	 * Returns the main plugin description
	 *
	 * @return UserInfoInterface
	 */
	public static function getUserInterface(): UserInfoInterface;

	/**
	 * Returns a human readable name for the plugin
	 * @return string
	 */
	public static function getPluginName(): string;

	/**
	 * The description must decide, where to place the plugin in the cycle.
	 *
	 * @return int
	 * @see PluginDescriptionInterface::PLACEMENT_* constants
	 */
	public function getRegistrationPlacement(): int;

	/**
	 * The plugin relevant options to respect if possible from Ikarus SPS
	 *
	 * @return int
	 * @see PluginDescriptionInterface::OPTION_* constants
	 */
	public function getPluginOptions(): int;

	/**
	 * @return int
	 */
	public function getDesiredFrequency(): int;
}