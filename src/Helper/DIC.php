<?php

namespace iLUB\Plugins\CleanUpSessions\Helper;

use ilCtrl;
use ilDBInterface;
use ILIAS\DI\Container;
use ILIAS\DI\HTTPServices;
use ILIAS\DI\RBACServices;
use ILIAS\DI\UIServices;
use ilLanguage;
use ilLog;
use ilObjUser;
use ilSetting;
use ilTabsGUI;
use ilTemplate;
use ilToolbarGUI;
use ilTree;

/**
 * Trait DIC
 *
 * @package iLUB\Plugins\CleanUpSessions\Helper
 */
trait DIC {

	/**
	 * @return Container
	 */
	public function dic() {
		return $GLOBALS['DIC'];
	}


	/**
	 * @return ilCtrl
	 */
	protected function ctrl() {
		return $this->dic()->ctrl();
	}

	/**
	 * @return ilTemplate
	 */
	protected function tpl() {
		return $this->dic()->ui()->mainTemplate();
	}


	/**
	 * @return ilLanguage
	 */
	protected function lng() {
		return $this->dic()->language();
	}


	/**
	 * @return ilTabsGUI
	 */
	protected function tabs() {
		return $this->dic()->tabs();
	}


	/**
	 * @return UIServices
	 */
	protected function ui() {
		return $this->dic()->ui();
	}


	/**
	 * @return ilObjUser
	 */
	protected function user() {
		return $this->dic()->user();
	}


	/**
	 * @return HTTPServices
	 */
	protected function http() {
		return $this->dic()->http();
	}


	/**
	 * @return ilDBInterface
	 */
	protected function db() {
		return $this->dic()->database();
	}


	/**
	 * @return ilToolbarGUI
	 */
	protected function toolbar() {
		return $this->dic()->toolbar();
	}


	/**
	 * @return RBACServices
	 */
	protected function rbac() {
		return $this->dic()->rbac();
	}


	/**
	 * @return ilTree
	 */
	protected function tree() {
		return $this->dic()->repositoryTree();
	}


	/**
	 * @return ilLog
	 */
	protected function ilLog() {
		return $this->dic()["ilLog"];
	}


	/**
	 * @return ilSetting
	 */
	protected function settings() {
		return $this->dic()->settings();
	}
}
