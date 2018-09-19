<?php

namespace iLUB\Plugins\DelUser\Config;

/**
 * Interface IHubConfig
 *
 * @package iLUB\Plugins\DelUser\Config
 */
interface IDelUser {

	const FIRST_VARIABLE_NAME = 'first_variable_name';
	const SECOND_VARIABLE_NAME = 'second_variable_name';


	/**
	 * Get the name of the first variable
	 *
	 * @return string
	 */
	public function getFirstVariableName();


	/**
	 * Get the name of the second variable
	 *
	 * @return string
	 */
	public function getSecondVariableName();


	/**
	 * Get a config value by key.
	 *
	 * @param string $key
	 *
	 * @return mixed
	 */
	public function get($key);
}
