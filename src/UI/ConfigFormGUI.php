<?php

namespace iLUB\Plugins\TestCron\UI;

use TestCronConfigGUI;
use ilCheckboxInputGUI;
use ilFormSectionHeaderGUI;
use ilTestCronConfigGUI;
use ilTestCronPlugin;
use ilPropertyFormGUI;
use ilTextInputGUI;
use iLUB\Plugins\TestCron\Config\ITestCron;
use iLUB\Plugins\TestCron\Helper\DIC;

/**
 * Class ConfigFOrmGUI
 *
 * @package iLUB\Plugins\TestCron\UI
 * @author  Stefan Wanzenried <sw@studer-raimann.ch>
 * @author  Fabian Schmid <fs@studer-raimann.ch>
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
	 * @param TestCronConfigGUI $parent_gui
	 * @param ITestCron    $config
	 */
	public function __construct($parent_gui, ITestCron $config) {
        var_dump("1234"); exit;
		$this->parent_gui = $parent_gui;
		$this->config = $config;
		$this->pl = ilTestCronPlugin::getInstance();
		$this->setFormAction($this->ctrl()->getFormAction($this->parent_gui));
		$this->initForm();
		$this->addCommandButton(TestCronConfigGUI::CMD_SAVE_CONFIG, $this->pl->txt('button_save'));
		$this->addCommandButton(TestCronConfigGUI::CMD_CANCEL, $this->pl->txt('button_cancel'));
		var_dump("1234"); exit;
		parent::__construct();
	}


	/**
	 *
	 */
	protected function initForm() {
		$this->setTitle($this->pl->txt('admin_form_title'));

		$item = new ilTextInputGUI($this->pl->txt('first_variable'), ITestCron::FIRST_VARIABLE_NAME);
		$item->setInfo($this->pl->txt('first_variable'));
		$item->setValue($this->config->get(ITestCron::FIRST_VARIABLE_NAME));
		$this->addItem($item);

		$cb = new ilCheckboxInputGUI($this->pl->txt('second_variable'), ITestCron::SECOND_VARIABLE_NAME);
		$cb->setChecked($this->config->get(ITestCron::SECOND_VARIABLE_NAME));
		$this->addItem($cb);

//		$item = new ilFormSectionHeaderGUI();
//		$item->setTitle($this->pl->txt('common_permissions'));
//		$this->addItem($item);
//
//
//		$h = new ilFormSectionHeaderGUI();
//		$h->setTitle($this->pl->txt('admin_shortlink'));
//		$this->addItem($h);
//
//
//		$item = new \ilTextAreaInputGUI($this->pl->txt('admin_msg_' . ITestCron::SHORTLINK_SUCCESS), ITestCron::SHORTLINK_SUCCESS);
//		$item->setUseRte(false);
//		$item->setValue($this->config->get(ITestCron::SHORTLINK_SUCCESS));
//		$item->setInfo($this->pl->txt('admin_msg_' . ITestCron::SHORTLINK_SUCCESS . '_info'));
//		$this->addItem($item);

	}
}
