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

namespace Ikarus\SPS\Dev\UI\Simulator;

/**
 * Objects of SimulatorInterface can be used to provide a simulation environment when the user is about to create new bricks.
 * Only if the SPS does not run, simulations are possible.
 *
 * Please note that the simulator instance will be called by http api requests, so you can not hold information between those periods.
 * All information that will be sent to the constructor in future runtime, can be retrieved from the environment.
 *
 * @package Ikarus\SPS\Dev\UI\LiveTest
 */
interface SimulatorInterface
{
	/**
	 * Setup the simulation using a given environment.
	 * If this method returns true, the simulation gets started for the user.
	 * Otherwise the simulation will cancel.
	 *
	 * @param EnvironmentInterface $environment
	 * @return bool
	 */
	public function initializeSimulation(EnvironmentInterface $environment): bool;

	/**
	 * Right after a successfully initialized simulation environment, the instance gets asked for which constructor arguments
	 * that must be protected before change during the simulation.
	 * Returning NULL just locks the arguments holding pin definitions.
	 *
	 * @return array|null
	 */
	public function getLockedArgumentNames(): ?array;

	/**
	 * Asks the instance, if the representing simulation requires a periodic update.
	 * Returning NULL does not automatically update the simulation. (Normally inputs need, to update the value/state and outputs don't, because the user needs to interact for a changed state/value)
	 *
	 * @return int|null
	 */
	public function getUpdateInterval(): ?int;

	/**
	 * Creates an initial html table row representing the simulated brick.
	 * You may specify the following html attributes:
	 * data-event        The event type, by default "click"
	 * data-command        A string that can be retrieved from the environment -- getSentCommand()
	 * data-value        (only input, textarea or select elements) the hold value -- getSentValue(string)
	 * data-update        Uniquely identifies an element to be updated with values from the simulator result.
	 * data-update-mode        Mode, how to update: val => $.val(), text => $.text() or html => $.html()
	 *
	 * @param EnvironmentInterface $environment
	 * @param SimulatorRenderInterface $render
	 * @return bool
	 */
	public function renderTableTemplate(EnvironmentInterface $environment, SimulatorRenderInterface $render): bool;

	/**
	 * This method gets called either frequently if an update interval is specified or by a user interaction.
	 *
	 * @param EnvironmentInterface $environment
	 * @param SimulationResultInterface $result
	 * @return bool
	 */
	public function updateSimulation(EnvironmentInterface $environment, SimulationResultInterface $result): bool;

	/**
	 * Tears down the simulation environment and acknowledge by returning true.
	 *
	 * @param EnvironmentInterface $environment
	 * @return bool
	 */
	public function finalizeSimulation(EnvironmentInterface $environment): bool;
}