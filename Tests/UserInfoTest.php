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

use Ikarus\SPS\Dev\UI\Command;
use Ikarus\SPS\Dev\UI\Declaration;
use Ikarus\SPS\Dev\UI\FixedValue;
use Ikarus\SPS\Dev\UI\Name;
use Ikarus\SPS\Dev\UI\UserInfo;
use PHPUnit\Framework\TestCase;

class UserInfoTest extends TestCase
{
	public function testName() {
		$ui = new UserInfo(
			new Name("Me")
		);

		$this->assertEquals("Me", $ui->getName());
	}

	public function testCommand() {
		$ui = new UserInfo(
			new Name("Me"),
			new Command("cmd-a"),
			new Command("cmd-b")
		);

		$this->assertEquals("Me", $ui->getName());
		$this->assertEquals(["cmd-a", 'cmd-b'], $ui->getCommands());
	}

	public function testDeclaration() {
		$ui = new UserInfo(
			new Name("Me"),
			new Command("cmd-a"),
			new Command("cmd-b"),
			new Declaration("decl")
		);

		$this->assertEquals("Me", $ui->getName());
		$this->assertEquals(["cmd-a", 'cmd-b'], $ui->getCommands());
		$this->assertEquals(['decl'], $ui->getDeclarations());
	}

	public function testFixedValue() {
		$ui = new UserInfo(
			new Name("Me"),
			new Command("cmd-a"),
			new Command("cmd-b"),
			new Declaration("decl"),
			new FixedValue('v1', [1,2,3])
		);

		$this->assertEquals("Me", $ui->getName());
		$this->assertEquals(["cmd-a", 'cmd-b'], $ui->getCommands());
		$this->assertEquals(['decl'], $ui->getDeclarations());
		$this->assertEquals(['v1'], $ui->getValues());
	}
}
