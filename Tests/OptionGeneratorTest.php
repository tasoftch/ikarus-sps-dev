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

use Ikarus\SPS\Dev\UI\Option\CallbackOptionFilter;
use Ikarus\SPS\Dev\UI\Option\Pinout\DefinedPinOptionGenerator;
use PHPUnit\Framework\TestCase;

class OptionGeneratorTest extends TestCase
{
	public function testGeneratorWithoutFilters() {
		$og = new DefinedPinOptionGenerator();

		$og->bindGenerator(function(&$g) {
			$g = 1;
			yield 4 => 89;

			$g = 3;
			yield 9 => 190;
		});

		foreach($og->yieldOptions($myGroup) as $id => $label) {
			if($id == 4) {
				$this->assertEquals(89, $label);
				$this->assertEquals(1, $myGroup);
			} elseif(9) {
				$this->assertEquals(190, $label);
				$this->assertEquals(3, $myGroup);
			} else
				$this->assertTrue(false);
		}
	}

	public function testGeneratorWithFilters() {
		$og = new DefinedPinOptionGenerator(new CallbackOptionFilter(function($id, $label, $group) {
			if($id == 9)
				return false;
			return true;
		}));

		$og->bindGenerator(function(&$g) {
			$g = 1;
			yield 4 => 89;

			$g = 3;
			yield 9 => 190;
		});

		foreach($og->yieldOptions($myGroup) as $id => $label) {
			if($id == 4) {
				$this->assertEquals(89, $label);
				$this->assertEquals(1, $myGroup);
			} else {
				echo "$myGroup $id $label";
				$this->assertTrue(false);
			}
		}
	}
}
