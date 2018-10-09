<?php

namespace iLUB\Plugins\TestCron\UI;

use ilCtrl;
use ilTabsGUI;
use ilTemplate;
use iLUB\Plugins\TestCron\Helper\DIC;

/**
 * Class AbstractGUI
 *
 * @package iLUB\Plugins\TestCron\UI
 * @deprecated
 */
abstract class AbstractGUI {

	use DIC;
	/**
	 * @var ilTemplate
	 */
	protected $tpl;
	/**
	 * @var ilTabsGUI
	 */
	protected $tabs;
	/**
	 * @var ilCtrl
	 */
	protected $ctrl;


	public function __construct() {
		$this->tpl = $this->ui()->mainTemplate();
		$this->tabs = $this->tabs();
		$this->ctrl = $this->ctrl();
	}
}
