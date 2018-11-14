<?php

namespace iLUB\Plugins\CleanUpSessions\UI;

use CleanUpSessionsConfigGUI;
use ilCleanUpSessionsConfigGUI;
use ilCleanUpSessionsPlugin;
use ilPropertyFormGUI;
use ilTextInputGUI;
use iLUB\Plugins\CleanUpSessions\Helper\CleanUpSessionsDBAccess;
use iLUB\Plugins\CleanUpSessions\Helper\DIC;

/**
 * Class ConfigFOrmGUI
 *
 * @package iLUB\Plugins\CleanUpSessions\UI
 */
class ConfigFormGUI extends ilPropertyFormGUI {

	# use DIC;
	/**
	 * @var ilCleanUpSessionsConfigGUI
	 */
	protected $parent_gui;
	/**
	 * @var ICleanUpSessions
	 */
	protected $config;
	/**
	 * @var ilCleanUpSessionsPlugin
	 */
	protected $pl;
	/**
	 * @var CleanUpSessionsDBAccess
	 */
	protected $access;


	/**
	 * @param CleanUpSessionsConfigGUI $parent_gui
	 */
	public function __construct($parent_gui) {
		global $DIC;
		$this->parent_gui = $parent_gui;
		$this->access = new CleanUpSessionsDBAccess();
		$this->pl = ilCleanUpSessionsPlugin::getInstance();
		$this->setFormAction($DIC->ctrl()->getFormAction($this->parent_gui));
		$this->initForm();
		$this->addCommandButton(cleanUpSessionsConfigGUI::CMD_SAVE_CONFIG, $this->pl->txt('button_save'));
		$this->addCommandButton(cleanUpSessionsConfigGUI::CMD_CANCEL, $this->pl->txt('button_cancel'));
		parent::__construct();
	}


	/**
	 *
	 */
	protected function initForm() {
		$this->setTitle($this->pl->txt('admin_form_title'));

		$item = new ilTextInputGUI($this->pl->txt('expiration_threshold'), ilCleanUpSessionsPlugin::EXPIRATION_THRESHOLD);
		$item->setInfo($this->pl->txt('expiration_info'));
		$item->setValue($this->access->getExpirationValue());
		$this->addItem($item);
	}
}
