<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\CleanUpSessions\Helper\DIC;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class cleanUpSessionsMainGUI
 *
 * @package
 *
 * @ilCtrl_IsCalledBy cleanUpSessionsMainGUI: ilCleanUpSessionsConfigGUI, ilObjComponentSettingsGUI
 * @ilCtrl_calls      cleanUpSessionsMainGUI: cleanUpSessionsConfigGUI
 */
class cleanUpSessionsMainGUI {

	use DIC;

	const TAB_PLUGIN_CONFIG = 'tab_plugin_config';
	const TAB_ORIGINS = 'tab_origins';
	const CMD_INDEX = 'index';

	/**
	 * @var ilCleanUpSessionsPlugin
	 */
	protected $pl;

    /**
     * @var $this->logger
     */
    protected $logger;


    /**
     * cleanUpSessionsMainGUI constructor.
     * @throws Exception
     */
	public function __construct() {
		$this->pl = ilCleanUpSessionsPlugin::getInstance();

        $this->logger = new Logger("CleanUpSessionsMainGUI");
        $this->logger->pushHandler(new StreamHandler(ilCleanUpSessionsPlugin::LOG_DESTINATION), Logger::DEBUG);
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
			case strtolower(cleanUpSessionsConfigGUI::class):
				$this->ctrl()->forwardCommand(new cleanUpSessionsConfigGUI());
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
		$this->ctrl()->redirectByClass(cleanUpSessionsConfigGUI::class);
	}


    /**
     * Add tabs to the main Config GUI
     */
	protected function initTabs() {
		$this->tabs()->addTab(self::TAB_PLUGIN_CONFIG, $this->pl->txt(self::TAB_PLUGIN_CONFIG), $this->ctrl()
			->getLinkTargetByClass(cleanUpSessionsConfigGUI::class));

	}


	/**
	 *
	 */
	protected function cancel() {
		$this->index();
	}
}
