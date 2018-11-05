<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use iLUB\Plugins\TestCron\Helper\DIC;

/**
 * Class TestCronRemoveDataConfirm
 *
 * @ilCtrl_isCalledBy TestCronRemoveDataConfirm: ilUIPluginRouterGUI
 */
class TestCronRemoveDataConfirm {

	use DIC;

	/**
	 * @param bool $plugin
	 */
	public static function saveParameterByClass(bool $plugin = true) {
		// TODO: ?
	}


	/**
	 * @var ilTestCronPlugin
	 */
	protected $pl;


	/**
	 *
	 */
	public function __construct() {
		$this->pl = ilTestCronPlugin::getInstance();
	}


	/**
	 *
	 */
	public function executeCommand() {
        // TODO: ?
	}


	/**
	 *
	 * @param string $html
	 */
	protected function show(string $html) {
	    // TODO: ?
	}


	/**
	 * @param string $cmd
	 */
	protected function redirectToPlugins(string $cmd) {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function cancel() {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function confirmRemoveTestCronData() {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function deactivateTestCron() {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function setKeepTestCronData() {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function setRemoveTestCronData() {
        // TODO: ?
	}
}
