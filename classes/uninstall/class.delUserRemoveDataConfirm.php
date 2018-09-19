<?php

require_once __DIR__ . "/../../vendor/autoload.php";

use iLUB\Plugins\DelUser\Helper\DIC;

/**
 * Class DelUserRemoveDataConfirm
 *
 * @ilCtrl_isCalledBy DelUserRemoveDataConfirm: ilUIPluginRouterGUI
 */
class DelUserRemoveDataConfirm {

	use DIC;

	/**
	 * @param bool $plugin
	 */
	public static function saveParameterByClass(bool $plugin = true) {
		// TODO: ?
	}


	/**
	 * @var ilDelUserPlugin
	 */
	protected $pl;


	/**
	 *
	 */
	public function __construct() {
		$this->pl = ilDelUserPlugin::getInstance();
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
	protected function confirmRemoveDelUserData() {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function deactivateDelUser() {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function setKeepDelUserData() {
        // TODO: ?
	}


	/**
	 *
	 */
	protected function setRemoveDelUserData() {
        // TODO: ?
	}
}
