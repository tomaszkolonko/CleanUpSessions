<?php
require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugings\DelUser\Helper\DIC;

/**
 * Class DelUserMainGUI
 *
 * @package
 *
 * @ilCtrl_IsCalledBy delUserMainGUI: delUserConfigGUI, ilObjComponentSettingsGUI
 * @ilCtrl_calls      delUserMainGUI: delUserConfigOriginsGUI
 * @ilCtrl_calls      delUserMainGUI: delUser2ConfigGUI
 */
class delUserMainGUI {

	use DIC;
	const TAB_PLUGIN_CONFIG = 'tab_plugin_config';
	const TAB_ORIGINS = 'tab_origins';
	const CMD_INDEX = 'index';
	/**
	 * @var ilDelUserPlugin
	 */
	protected $pl;


	/**
	 * DelUserMainGUI constructor.
	 */
	public function __construct() {
	    var_dump("100");
		$this->pl = ilDelUserPlugin::getInstance();
	}


	/**
	 *
	 */
	public function executeCommand() {
	    var_dump("110"); exit;
		$this->initTabs();
		$nextClass = $this->ctrl()->getNextClass();
		switch ($nextClass) {
			case strtolower(delUserConfigGUI::class):
				$this->ctrl()->forwardCommand(new delUserConfigGUI());
				break;
			case strtolower(delUserDataGUI::class):
				break;
			default:
				$cmd = $this->ctrl()->getCmd(self::CMD_INDEX);
				$this->{$cmd}();
		}
	}


	/**
	 *
	 */
	protected function index() {
		$this->ctrl()->redirectByClass(delUserConfigGUI::class);
	}


	/**
	 *
	 */
	protected function initTabs() {
		$this->tabs()->addTab(self::TAB_PLUGIN_CONFIG, $this->pl->txt(self::TAB_PLUGIN_CONFIG), $this->ctrl()
			->getLinkTargetByClass(delUserConfigGUI::class));

	}


	/**
	 *
	 */
	protected function cancel() {
		$this->index();
	}
}
