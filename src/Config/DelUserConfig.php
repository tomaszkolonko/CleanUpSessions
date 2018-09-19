<?php

namespace iLUB\Plugins\DelUser\Config;

/**
 * Class DelUser
 *
 * @package iLUB\Plugins\DelUser\Config
 */
class DelUserConfig implements IDelUser {


	/**
	 * @inheritdoc
	 */
	public function getFirstVariableName() {
		return ArConfig::getValueByKey(IDelUser::FIRST_VARIABLE_NAME);
	}


	/**
	 * @inheritdoc
	 */
	public function getSecondVariableName() {
		return ArConfig::getValueByKey(IDelUser::SECOND_VARIABLE_NAME);
	}


	/**
	 * @inheritdoc
	 */
	public function get($key) {
		return ArConfig::getValueByKey($key);
	}
}
