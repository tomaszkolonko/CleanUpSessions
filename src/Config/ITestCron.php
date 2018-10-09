<?php

namespace iLUB\Plugins\TestCron\Config;

/**
 * Interface IHubConfig
 *
 * @package iLUB\Plugins\TestCron\Config
 */
interface ITestCron {

	const EXPIRATION_THRESHOLD = 'expiration_treshold';


	/**
	 * Get the name of the first variable
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
