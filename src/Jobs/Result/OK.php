<?php

namespace iLUB\Plugins\CleanUpSessions\Jobs\Result;

/**
 * Class OK
 *
 * @package iLUB\Plugins\CleanUpSessions\Jobs\Result
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class OK extends AbstractResult {

	protected function initStatus() {
		$this->setStatus(self::STATUS_OK);
	}
}
