<?php

namespace iLUB\Plugins\CleanUpSessions\Jobs\Result;

/**
 * Class Error
 *
 * @package iLUB\Plugins\CleanUpSessions\Jobs\Result
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class Error extends AbstractResult {

	protected function initStatus() {
		$this->setStatus(self::STATUS_CRASHED);
	}
}
