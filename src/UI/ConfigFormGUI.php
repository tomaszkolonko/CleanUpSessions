<?php

namespace iLUB\Plugins\DelUser\UI;

use DelUserConfigGUI;
use ilCheckboxInputGUI;
use ilFormSectionHeaderGUI;
use ilDelUserConfigGUI;
use ilDelUserPlugin;
use ilPropertyFormGUI;
use ilTextInputGUI;
use iLUB\Plugins\DelUser\Config\IDelUser;
use iLUB\Plugins\DelUser\Helper\DIC;

/**
 * Class ConfigFOrmGUI
 *
 * @package iLUB\Plugins\DelUser\UI
 * @author  Stefan Wanzenried <sw@studer-raimann.ch>
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class ConfigFormGUI extends ilPropertyFormGUI {

	use DIC;
	/**
	 * @var ilDelUserConfigGUI
	 */
	protected $parent_gui;
	/**
	 * @var IDelUser
	 */
	protected $config;
	/**
	 * @var ilDelUserPlugin
	 */
	protected $pl;


	/**
	 * @param DelUserConfigGUI $parent_gui
	 * @param IDelUser    $config
	 */
	public function __construct($parent_gui, IDelUser $config) {
        var_dump("1234"); exit;
		$this->parent_gui = $parent_gui;
		$this->config = $config;
		$this->pl = ilDelUserPlugin::getInstance();
		$this->setFormAction($this->ctrl()->getFormAction($this->parent_gui));
		$this->initForm();
		$this->addCommandButton(DelUserConfigGUI::CMD_SAVE_CONFIG, $this->pl->txt('button_save'));
		$this->addCommandButton(DelUserConfigGUI::CMD_CANCEL, $this->pl->txt('button_cancel'));
		var_dump("1234"); exit;
		parent::__construct();
	}


	/**
	 *
	 */
	protected function initForm() {
		$this->setTitle($this->pl->txt('admin_form_title'));

		$item = new ilTextInputGUI($this->pl->txt('first_variable'), IDelUser::FIRST_VARIABLE_NAME);
		$item->setInfo($this->pl->txt('first_variable'));
		$item->setValue($this->config->get(IDelUser::FIRST_VARIABLE_NAME));
		$this->addItem($item);

		$cb = new ilCheckboxInputGUI($this->pl->txt('second_variable'), IDelUser::SECOND_VARIABLE_NAME);
		$cb->setChecked($this->config->get(IDelUser::SECOND_VARIABLE_NAME));
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
//		$item = new \ilTextAreaInputGUI($this->pl->txt('admin_msg_' . IDelUser::SHORTLINK_SUCCESS), IDelUser::SHORTLINK_SUCCESS);
//		$item->setUseRte(false);
//		$item->setValue($this->config->get(IDelUser::SHORTLINK_SUCCESS));
//		$item->setInfo($this->pl->txt('admin_msg_' . IDelUser::SHORTLINK_SUCCESS . '_info'));
//		$this->addItem($item);

	}
}
