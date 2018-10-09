<?php

namespace iLUB\Plugins\TestCron\Config;

/**
 * Interface ITestCron
 *
 * @package iLUB\Plugins\TestCron\Config
 */
interface ITestCron {

	const EXPIRATION_THRESHOLD = 'expiration_treshold';


	/**
	 * Get the expiration threshold after which an anonymous user will be removed from the DB
	 *
	 * @return string
	 */
	public function getExpirationThreshold();

	/**
	 * Get a config value by key.
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function get($key);
}
