<?php

use iLUB\Plugins\TestCron\Helper\DIC;

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Class ilTestCronConfigGUI
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
			case strtolower(TestCronMainGUI::class):
				$h = new TestCronMainGUI();
				$this->ctrl()->forwardCommand($h);

				return;
		}
		$this->ctrl()->redirectByClass([ TestCronMainGUI::class ]);
	}


	/**
	 * @param string $cmd
	 */
	public function performCommand($cmd) {
		// noting to to here
	}
}
