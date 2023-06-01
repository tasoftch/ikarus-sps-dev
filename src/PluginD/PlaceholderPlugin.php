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

namespace Ikarus\SPS\Dev\PluginD;

use Ikarus\SPS\Dev\PluginDescriptionInterface;
use Ikarus\SPS\Dev\UI\Control;
use Ikarus\SPS\Dev\UI\Description;
use Ikarus\SPS\Dev\UI\Group;
use Ikarus\SPS\Dev\UI\Name;
use Ikarus\SPS\Dev\UI\PinoutDefinition;
use Ikarus\SPS\Dev\UI\PlainParameterConstructor;
use Ikarus\SPS\Dev\UI\Status;
use Ikarus\SPS\Dev\UI\UserInfo;
use Ikarus\SPS\Dev\UI\UserInfoInterface;
use Ikarus\SPS\Dev\UI\Value;

class PlaceholderPlugin implements PluginDescriptionInterface
{
	public function getUserInterface(): UserInfoInterface
	{
		return new UserInfo(
			new Name("Platzhalter"),
			new Description("Diese Bauteile steuern nichts an. Sie dienen als Platzhalter im Speicherregister. Es gibt andere Plugins, welche einen Status an andere Bauteile weitergeben."),
			new Status(2, "EIN"),
			new Status(1, 'AUS'),
			new Group("Spezial")
		);
	}

	public function getPluginName(): string
	{
		return "platzhalter";
	}

	public function getRegistrationPlacement(): int
	{
		return self::PLACEMENT_CYCLE_END;
	}

	public function getPluginOptions(): int
	{
		return self::OPTION_PIN_AS_BOARD;
	}

	public function getDesiredInterval(): int
	{
		return 100;
	}
}