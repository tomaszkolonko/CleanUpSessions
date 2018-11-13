<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\CleanUpSessions\UI\ConfigFormGUI;
use iLUB\Plugins\CleanUpSessions\Helper\CleanUpSessionsDBAccess;


/**
 * Class cleanUpSessionsConfigGUI
 */
class cleanUpSessionsConfigGUI extends cleanUpSessionsMainGUI {
	const CMD_SAVE_CONFIG = 'saveConfig';
	const CMD_CANCEL = 'cancel';

	/**
	 * @var $access
	 */
	protected $access;


	/**
	 * Creates a new ConfigFormGUI and sets the Content
	 */
	protected function index() {
		$form = new ConfigFormGUI($this);
		global $tpl;
		$tpl->setContent($form->getHTML());
	}


	/**
	 * Checks the form input and forwards to checkAndUpdate()
	 *
	 * @throws Exception
	 */
	protected function saveConfig() {
		global $DIC;
		$form = new ConfigFormGUI($this);
		if ($form->checkInput()) {
			$this->checkAndUpdate($form->getInput(ilCleanUpSessionsPlugin::EXPIRATION_THRESHOLD));
		} else {
			ilUtil::sendFailure($this->pl->txt('msg_failed_save'), true);
		}
		$DIC->ctrl()->redirect($this);
	}

	/**
	 * $expiration_value must be numeric and bigger than 0 for the check to pass. If check passes value gets
	 * updated into DB
	 *
	 * @param $expiration_value
	 * @throws Exception
	 */
	protected function checkAndUpdate($expiration_value) {
		$this->access = new CleanUpSessionsDBAccess();
		if (is_numeric($expiration_value) && (int)$expiration_value > 0) {
			$this->access->updateExpirationValue($expiration_value);
			ilUtil::sendSuccess($this->pl->txt('msg_successfully_saved'), true);
		} else {
			ilUtil::sendFailure($this->pl->txt('msg_not_valid_expiration_input'), true);
		}
	}

	/**
	 *
	 */
	protected function initTabs() {
		global $DIC;
		$DIC->tabs()->activateTab(self::TAB_PLUGIN_CONFIG);
	}
}
