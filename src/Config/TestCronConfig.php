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
	public function getFirstVariableName() {
		return ArConfig::getValueByKey(ITestCron::FIRST_VARIABLE_NAME);
	}


	/**
	 * @inheritdoc
	 */
	public function getSecondVariableName() {
		return ArConfig::getValueByKey(ITestCron::SECOND_VARIABLE_NAME);
	}


	/**
	 * @inheritdoc
	 */
	public function get($key) {
		return ArConfig::getValueByKey($key);
	}
}
