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

use Ikarus\SPS\Dev\PluginGen\Description;
use Ikarus\SPS\Dev\PluginGen\Argument\DynamicArgument;
use Ikarus\SPS\Dev\PluginGen\Name;
use Ikarus\SPS\Dev\PluginGen\Plugin;
use Ikarus\SPS\Dev\PluginGen\Argument\StaticArgument;
use Ikarus\SPS\Plugin\AbstractPlugin;
use PHPUnit\Framework\TestCase;

class PluginGenerattorTest extends TestCase
{
	public function testSimpleGenerator() {
		$gen = new Plugin(
			AbstractPlugin::class,
			'id',
			new Name("Test"),
			new Description("Here I am")
		);

		$this->assertEquals("id", $gen->getIdentifier());
		$this->assertEquals("Test", $gen->getPluginName());
		$this->assertEquals('Here I am', $gen->getPluginDescription());
		$this->assertEquals(AbstractPlugin::class, $gen->getClass());

		$this->assertEquals("new Ikarus\SPS\Plugin\AbstractPlugin('id')", $gen->construct());
	}

	public function testStaticArgumentsGenerator() {
		$gen = new Plugin(
			AbstractPlugin::class,
			'id',
			new StaticArgument(1),
			new StaticArgument('test')
		);

		$this->assertEquals("new Ikarus\SPS\Plugin\AbstractPlugin('id',1,'test')", $gen->construct());
	}

	public function testDynamicArgument() {
		$gen = new Plugin(
			AbstractPlugin::class,
			'my-id',
			new DynamicArgument(function() {
				return Ikarus("Test") * 13;
			})
		);

		$this->assertEquals("new Ikarus\SPS\Plugin\AbstractPlugin('my-id',(function() { return Ikarus(\"Test\") * 13; })())", $gen->construct());
	}
}
