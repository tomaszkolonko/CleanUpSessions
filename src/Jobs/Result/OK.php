<?php

namespace iLUB\Plugins\TestCron\Jobs\Result;

/**
 * Class OK
 *
 * @package iLUB\Plugins\TestCron\Jobs\Result
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class OK extends AbstractResult {

	protected function initStatus() {
		$this->setStatus(self::STATUS_OK);
	}
}
