<?php

use iLUB\Plugins\DelUser\Helper\DIC;

require_once __DIR__ . "/../vendor/autoload.php";

/**
 * Class ilDelUserConfigGUI
 *
 * @package
 */
class ilDelUserConfigGUI extends ilPluginConfigGUI {

	use DIC;


	/**
	 * @inheritDoc
	 */
	public function executeCommand() {
		parent::executeCommand();
		switch ($this->ctrl()->getNextClass()) {
			case strtolower(delUserMainGUI::class):
				$h = new delUserMainGUI();
				$this->ctrl()->forwardCommand($h);

				return;
		}
		$this->ctrl()->redirectByClass([ delUserMainGUI::class ]);
	}


	/**
	 * @param string $cmd
	 */
	public function performCommand($cmd) {
		// noting to to here
	}
}
