<?php

use iLUB\Plugins\TestCron\Helper\DIC;


require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Class ilTestCronConfigGUI
 *
 *
 * @package
 */
class ilTestCronConfigGUI extends ilPluginConfigGUI {

	use DIC;

	/**
	 * @inheritDoc
	 */
	public function executeCommand() {

		parent::executeCommand();
		switch ($this->ctrl()->getNextClass()) {
			case strtolower(testCronMainGUI::class):
				$h = new testCronMainGUI();
				$this->ctrl()->forwardCommand($h);

				return;
		}

        $this->ctrl()->redirectByClass([ testCronMainGUI::class ]);
	}

	/**
	 * @param string $cmd
	 */
	public function performCommand($cmd) {
		// nothing to to here
	}
}