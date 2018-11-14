<?php

require_once __DIR__ . "/../vendor/autoload.php";

// use iLUB\Plugins\CleanUpSessions\Helper\DIC;

/**
 * Class ilCleanUpSessionsConfigGUI
 *
 */
class ilCleanUpSessionsConfigGUI extends ilPluginConfigGUI {

	# use DIC;

	/**
	 * @inheritdoc
	 * @throws ilCtrlException
	 */
	public function executeCommand() {
		global $DIC;

		parent::executeCommand();
		switch ($DIC->ctrl()->getNextClass()) {
			case strtolower(cleanUpSessionsMainGUI::class):
				$mainGUI = new cleanUpSessionsMainGUI();
				$DIC->ctrl()->forwardCommand($mainGUI);
				return;
		}

		$DIC->ctrl()->redirectByClass([cleanUpSessionsMainGUI::class]);
	}

	/**
	 * @inheritdoc
	 * @param string $cmd
	 */
	public function performCommand($cmd) {
		// nothing to to here
	}
}