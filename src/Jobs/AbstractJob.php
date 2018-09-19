<?php

namespace iLUB\Plugins\TestCron\Jobs;

use ilCronJob;
use iLUB\Plugins\TestCron\Helper\DIC;

/**
 * Class AbstractJob
 *
 * @package iLUB\Plugins\TestCron\Jobs
 */
abstract class AbstractJob extends ilCronJob {

	use DIC;


	/**
	 * @param string $message
	 */
	protected function log($message) {
		$this->ilLog()->write($message);
	}
}
