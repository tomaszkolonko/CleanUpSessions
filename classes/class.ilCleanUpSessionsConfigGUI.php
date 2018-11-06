<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\CleanUpSessions\Helper\DIC;

/**
 * Class ilCleanUpSessionsConfigGUI
 *
 */
class ilCleanUpSessionsConfigGUI extends ilPluginConfigGUI {

	use DIC;

    /**
     * @inheritdoc
     * @throws ilCtrlException
     */
	public function executeCommand() {

		parent::executeCommand();
		switch ($this->ctrl()->getNextClass()) {
			case strtolower(cleanUpSessionsMainGUI::class):
				$h = new cleanUpSessionsMainGUI();
				$this->ctrl()->forwardCommand($h);
				return;
		}

        $this->ctrl()->redirectByClass([ cleanUpSessionsMainGUI::class ]);
	}

	/**
     * @inheritdoc
	 * @param string $cmd
	 */
	public function performCommand($cmd) {
		// nothing to to here
	}
}