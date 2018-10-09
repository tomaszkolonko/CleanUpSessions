<?php

namespace iLUB\Plugins\TestCron\Config;

/**
 * Class TestCron
 *
 * @package iLUB\Plugins\TestCron\Config
 */
class TestCronConfig implements ITestCron {


	/**
	 * @inheritdoc
	 */
	public function getExpirationThreshold() {
		return ArConfig::getValueByKey(ITestCron::EXPIRATION);
	}


	/**
	 * @inheritdoc
	 */
	public function get($key) {
		return ArConfig::getValueByKey($key);
	}
}
