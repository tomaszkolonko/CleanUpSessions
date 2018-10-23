<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\TestCron\UI\ConfigFormGUI;
use iLUB\Plugins\TestCron\Helper\TestCronDBAccess;


/**
 * Class testCronConfigGUI
 *
 * @package
 */
class testCronConfigGUI extends testCronMainGUI {

	const CMD_SAVE_CONFIG = 'saveConfig';
	const CMD_CANCEL = 'cancel';

    /**
     * @var $this->access
     */
	protected $access;


    /**
     * Creates a new ConfigFormGUI and sets the Content
     */
	protected function index() {
		$form = new ConfigFormGUI($this);

		$this->tpl()->setContent($form->getHTML());
	}


    /**
     * Checks the form input and forwards to checkAndUpdate()
     */
	protected function saveConfig() {
		$form = new ConfigFormGUI($this);
		if ($form->checkInput()) {
		    $this->checkAndUpdate($form->getInput(ilTestCronPlugin::EXPIRATION_THRESHOLD));
		} else {
            ilUtil::sendFailure($this->pl->txt('msg_failed_save'), true);
        }
        $this->ctrl()->redirect($this);
	}

    /**
     * $expiration_value must be numeric and biger than 0 for the check to pass. If check passes value gets
     * updated into DB
     *
     * @param $expiration_value
     * @throws Exception
     */
	protected function checkAndUpdate($expiration_value) {
        $this->access = new TestCronDBAccess();
        if(is_numeric($expiration_value) && (int)$expiration_value > 0) {
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
		$this->tabs()->activateTab(self::TAB_PLUGIN_CONFIG);
	}
}
