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


use Closure;

/**
 * This class ist a placeholder to inject dynamic arguments into plugins.
 * You define a closure and this gets extracted out of your code.
 * The closure must not accept any argument or usages!
 * Please follow the syntax:
 new DynamicArgument(function() {
 	from here


    until here gets extracted.
 })
 *
 * use the Ikarus() function to get global values on runtime.
 *
 * @package Ikarus\SPS\Dev\PluginGen
 * @see Ikarus()
 */
class DynamicArgument implements ArgumentInterface
{
	/** @var Closure */
	private $callback;

	/**
	 * DynamicArgument constructor.
	 * @param Closure $callback
	 */
	public function __construct(Closure $callback)
	{
		$this->callback = $callback;
	}


	/**
	 * @return Closure
	 */
	public function getCallback(): Closure
	{
		return $this->callback;
	}

	public function export(): string
	{
		$fn = new \ReflectionFunction( $this->getCallback() );
		if($file = $fn->getFileName()) {
			$s = $fn->getStartLine();
			$e = $fn->getEndLine();

			$lines = trim(implode(" ", array_slice(file($file), $s, $e-$s-1)));
			return "(function() { $lines })()";
		}
		trigger_error("Can not transform closure into executable string!", E_USER_WARNING);
		return "NULL";
	}
}