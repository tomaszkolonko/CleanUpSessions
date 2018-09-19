<?php

namespace iLUB\Plugins\DelUser\Exception;

use ilException;

/**
 * Class HubException
 *
 * @package iLUB\Plugins\DelUser\Exception
 */
class DelUserException extends ilException {

	/**
	 * @param string $message
	 */
	public function __construct($message) {
		parent::__construct($message, 0);
	}
}
