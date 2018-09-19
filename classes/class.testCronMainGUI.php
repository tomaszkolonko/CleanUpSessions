<?php
require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugings\TestCron\Helper\DIC;

/**
 * Class TestCronMainGUI
 *
 * @package
 *
 * @ilCtrl_IsCalledBy TestCronMainGUI: TestCronConfigGUI, ilObjComponentSettingsGUI
 * @ilCtrl_calls      TestCronMainGUI: TestCronConfigOriginsGUI
 * @ilCtrl_calls      TestCronMainGUI: TestCron2ConfigGUI
 */
class TestCronMainGUI {

	use DIC;
	const TAB_PLUGIN_CONFIG = 'tab_plugin_config';
	const TAB_ORIGINS = 'tab_origins';
	const CMD_INDEX = 'index';
	/**
	 * @var ilTestCronPlugin
	 */
	protected $pl;


	/**
	 * TestCronMainGUI constructor.
	 */
	public function __construct() {
	    var_dump("100");
		$this->pl = ilTestCronPlugin::getInstance();
	}


	/**
	 *
	 */
	public function executeCommand() {
	    var_dump("110"); exit;
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
		$this->ctrl()->redirectByClass(TestCronConfigGUI::class);
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
