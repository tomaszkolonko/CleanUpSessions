<?php
require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\DelUser\Config\ArConfig;
use iLUB\Plugins\DelUser\Config\DelUserConfig;
use iLUB\Plugins\DelUser\UI\ConfigFormGUI;

/**
 * Class delUserConfigGUI
 *
 * @package
 */
class delUserConfigGUI extends ilPluginConfigGUI {

	const CMD_SAVE_CONFIG = 'saveConfig';
	const CMD_CANCEL = 'cancel';


	/**
	 *
	 */
	protected function index() {
		$form = new ConfigFormGUI($this, new DelUserConfig());
		$this->tpl()->setContent($form->getHTML());
	}


	/**
	 *
	 */
	protected function saveConfig() {
		$form = new ConfigFormGUI($this, new DelUserConfig());
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

    /**
     * @param string $cmd
     */
    public function performCommand($cmd) {
        // noting to to here
    }
}
