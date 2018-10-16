<?php

namespace iLUB\Plugins\TestCron\UI;

use TestCronConfigGUI;
use ilTestCronConfigGUI;
use ilTestCronPlugin;
use ilPropertyFormGUI;
use ilTextInputGUI;
use iLUB\Plugins\TestCron\Helper\TestCronAccess;
use iLUB\Plugins\TestCron\Helper\DIC;

/**
 * Class ConfigFOrmGUI
 *
 * @package iLUB\Plugins\TestCron\UI
 */
class ConfigFormGUI extends ilPropertyFormGUI {

	use DIC;
	/**
	 * @var ilTestCronConfigGUI
	 */
	protected $parent_gui;
	/**
	 * @var ITestCron
	 */
	protected $config;
	/**
	 * @var ilTestCronPlugin
	 */
	protected $pl;
    /**
     * @var TestCronAccess
     */
	protected $access;


	/**
	 * @param TestCronConfigGUI $parent_gui
	 */
	public function __construct($parent_gui) {
		$this->parent_gui = $parent_gui;
		$this->access = new TestCronAccess();
		$this->pl = ilTestCronPlugin::getInstance();
		$this->setFormAction($this->ctrl()->getFormAction($this->parent_gui));
		$this->initForm();
		$this->addCommandButton(testCronConfigGUI::CMD_SAVE_CONFIG, $this->pl->txt('button_save'));
		$this->addCommandButton(testCronConfigGUI::CMD_CANCEL, $this->pl->txt('button_cancel'));
		parent::__construct();
	}


	/**
	 *
	 */
	protected function initForm() {
		$this->setTitle($this->pl->txt('admin_form_title'));

		$item = new ilTextInputGUI($this->pl->txt('expiration_threshold'), ilTestCronPlugin::EXPIRATION_THRESHOLD);
		$item->setInfo($this->pl->txt('expiration_info'));
		$item->setValue($this->access->getExpirationValue());
		$this->addItem($item);
	}
}
