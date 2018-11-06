<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\TestCron\Helper\DIC;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

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
     * @throws Exception
     */
	public function __construct() {
		$this->pl = ilTestCronPlugin::getInstance();

        $this->logger = new Logger("TestCronMainGUI");
        $this->logger->pushHandler(new StreamHandler(ilTestCronPlugin::LOG_DESTINATION), Logger::DEBUG);
        $this->logger->info("Logger has been registered");
	}


    /**
     * @throws \ILIAS\Filesystem\Exception\IOException
     * @throws ilCtrlException
     */
	public function executeCommand() {
	    $this->logger->info("executeCommand()");
		$this->initTabs();
		$nextClass = $this->ctrl()->getNextClass();
		switch ($nextClass) {
			case strtolower(testCronConfigGUI::class):
				$this->ctrl()->forwardCommand(new testCronConfigGUI());
				break;
			default:
				$cmd = $this->ctrl()->getCmd(self::CMD_INDEX);
				$this->{$cmd}();
		}

	}


    /**
     * Redirect to the Config GUI of the Plugin
     */
	protected function index() {
		$this->ctrl()->redirectByClass(testCronConfigGUI::class);
	}


    /**
     * Add tabs to the main Config GUI
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
