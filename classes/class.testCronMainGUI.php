<?php
require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\TestCron\Helper\DIC;

/**
 * Class testCronMainGUI
 *
 * @package
 *
 * @ilCtrl_IsCalledBy testCronMainGUI: ilTestCronConfigGUI, ilObjComponentSettingsGUI
 * @ilCtrl_calls      testCronMainGUI: testCronConfigGUI
 */
class testCronMainGUI {

	use DIC;
	const TAB_PLUGIN_CONFIG = 'tab_plugin_config';
	const TAB_ORIGINS = 'tab_origins';
	const CMD_INDEX = 'index';

	/**
	 * @var ilTestCronPlugin
	 */
	protected $pl;


	/**
	 * testCronMainGUI constructor.
	 */
	public function __construct() {
		$this->pl = ilTestCronPlugin::getInstance();
	}


	/**
	 *
	 */
	public function executeCommand() {
		$this->initTabs();
		$nextClass = $this->ctrl()->getNextClass();
		switch ($nextClass) {
			case strtolower(TestCronConfigGUI::class):
				$this->ctrl()->forwardCommand(new TestCronConfigGUI());
				break;
			case strtolower(TestCronDataGUI::class):
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
		$this->ctrl()->redirectByClass(testCronConfigGUI::class);
	}


	/**
	 *
	 */
	protected function initTabs() {
		$this->tabs()->addTab(self::TAB_PLUGIN_CONFIG, $this->pl->txt(self::TAB_PLUGIN_CONFIG), $this->ctrl()
			->getLinkTargetByClass(TestCronConfigGUI::class));

	}


	/**
	 *
	 */
	protected function cancel() {
		$this->index();
	}
}
