<?php
/*
 * BSD 3-Clause License
 *
 * Copyright (c) 2022, TASoft Applications
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

namespace Ikarus\SPS\Dev\Workflow\Control;


use Skyline\HTML\Form\Control\Option\Provider\OptionProviderInterface;
use TASoft\Service\ServiceManager;
use TASoft\Util\PDO;

class UsedProceduresOptionProvider implements OptionProviderInterface
{
	/**
	 * @inheritDoc
	 */
	public function yieldOptions(?string &$group): \Generator
	{
		/** @var PDO $PDO */
		$PDO = ServiceManager::generalServiceManager()->get("PDO");

		foreach($PDO->select("SELECT
PROCFUNC.id,
       PROCFUNC.label,
       D.label AS groupName
FROM PROCFUNC
JOIN PROCFUNC_TYPE PT ON type  = PT.id
JOIN DOMAIN D on PROCFUNC.domain = D.id
WHERE can_call_from_visualizer > 0
ORDER BY D.order_idx, D.label, PROCFUNC.label") as $record) {
			$group = $record["groupName"];
			yield $record['id'] => $record["label"];
		}
	}
}