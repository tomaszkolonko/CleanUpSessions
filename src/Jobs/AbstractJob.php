<?php

namespace iLUB\Plugins\DelUser\Jobs;

use ilCronJob;
use iLUB\Plugins\DelUser\Helper\DIC;

/**
 * Class AbstractJob
 *
 * @package iLUB\Plugins\DelUser\Jobs
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
