<?php
require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\TestCron\Config\ArConfig;
use iLUB\Plugins\TestCron\Config\TestCronConfig;
use iLUB\Plugins\TestCron\UI\ConfigFormGUI;

/**
 * Class testCronConfigGUI
 *
 * @package
 */
class testCronConfigGUI extends testCronMainGUI {

	const CMD_SAVE_CONFIG = 'saveConfig';
	const CMD_CANCEL = 'cancel';


	/**
	 *
	 */
	protected function index() {
		$form = new ConfigFormGUI($this, new TestCronConfig());

		$this->tpl()->setContent($form->getHTML());
	}


    /**
	 *
	 */
	protected function saveConfig() {
		$form = new ConfigFormGUI($this, new TestCronConfig());
		if ($form->checkInput()) {
			foreach ($form->getInputItemsRecursive() as $item) {
				/** @var ilFormPropertyGUI $item */
				$config = ARConfig::getInstanceByKey($item->getPostVar());
				$config->setValue($form->getInput($item->getPostVar()));
				$config->save();
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
