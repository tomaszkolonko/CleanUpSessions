<?php

namespace iLUB\Plugins\CleanUpSessions\Jobs;

use ilCronJob;
use iLUB\Plugins\CleanUpSessions\Helper\DIC;

/**
 * Class AbstractJob
 *
 * @package iLUB\Plugins\CleanUpSessions\Jobs
 */
abstract class AbstractJob extends ilCronJob {

	# use DIC;


	/**
	 * @param string $message
	 */
	protected function log($message) {
		$this->ilLog()->write($message);
	}
}
