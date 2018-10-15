<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\TestCron\Helper\DIC;
use iLUB\Plugins\TestCron\Log\Logger;

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
     * @var $this->logger
     */
    protected $logger;


    /**
     * testCronMainGUI constructor.
     * @throws \ILIAS\Filesystem\Exception\IOException
     */
	public function __construct() {
		$this->pl = ilTestCronPlugin::getInstance();
        $this->logger = new Logger("TestCronLogger.log");
	}


    /**
     * @throws \ILIAS\Filesystem\Exception\IOException
     * @throws ilCtrlException
     */
	public function executeCommand() {
	    $this->logger->write("testCronMainGUI::executeCommand() \n");
		$this->initTabs();
		$nextClass = $this->ctrl()->getNextClass();
		switch ($nextClass) {
			case strtolower(testCronConfigGUI::class):
				$this->ctrl()->forwardCommand(new testCronConfigGUI());
				break;
			case strtolower(testCronDataGUI::class):
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
			->getLinkTargetByClass(testCronConfigGUI::class));

	}


	/**
	 *
	 */
	protected function cancel() {
		$this->index();
	}
}
