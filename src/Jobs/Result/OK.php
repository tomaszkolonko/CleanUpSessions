<?php

namespace iLUB\Plugins\DelUser\Jobs\Result;

/**
 * Class OK
 *
 * @package iLUB\Plugins\DelUser\Jobs\Result
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class OK extends AbstractResult {

	protected function initStatus() {
		$this->setStatus(self::STATUS_OK);
	}
}
