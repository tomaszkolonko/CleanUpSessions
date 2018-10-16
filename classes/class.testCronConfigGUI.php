<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\TestCron\UI\ConfigFormGUI;
use iLUB\Plugins\TestCron\Helper\TestCronAccess;

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
	 *
	 */
	protected function index() {
		$form = new ConfigFormGUI($this);

		$this->tpl()->setContent($form->getHTML());
	}


    /**
	 *
	 */
	protected function saveConfig() {
		$form = new ConfigFormGUI($this);
		$this->access = new TestCronAccess();
		if ($form->checkInput()) {
		    // TODO: fix the for each loop... it's not needed
			foreach ($form->getInputItemsRecursive() as $item) {
				$expiration = $form->getInput($item->getPostVar());
                $this->access->updateExpirationValue($expiration);
			}
			ilUtil::sendSuccess($this->pl->txt('msg_successfully_saved'), true);
			$this->ctrl()->redirect($this);
		}
		$form->setValuesByPost();
		$this->tpl()->setContent($form->getHTML());
	}

    /**
	 *
	 */
	protected function initTabs() {
		$this->tabs()->activateTab(self::TAB_PLUGIN_CONFIG);
	}
}
