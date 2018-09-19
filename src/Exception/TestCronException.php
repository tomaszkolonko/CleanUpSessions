<?php

namespace iLUB\Plugins\TestCron\Exception;

use ilException;

/**
 * Class HubException
 *
 * @package iLUB\Plugins\TestCron\Exception
 */
class TestCronException extends ilException {

	/**
	 * @param string $message
	 */
	public function __construct($message) {
		parent::__construct($message, 0);
	}
}
