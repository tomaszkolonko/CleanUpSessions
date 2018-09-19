<?php

namespace iLUB\Plugins\DelUser\Log;

/**
 * Interface ILog
 *
 * @package iLUB\Plugins\DelUser\Log
 */
interface ILog {

	// @see ilLogLevel
	const LEVEL_INFO = 200;
	const LEVEL_WARNING = 300;
	const LEVEL_CRITICAL = 500;


	/**
	 * @param string $message
	 * @param int    $level
	 */
	public function write($message, $level = self::LEVEL_INFO);
}
