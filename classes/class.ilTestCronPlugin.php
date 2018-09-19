<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\TestCron\Config\ArConfig;
use iLUB\Plugins\TestCron\Helper\DIC;
use iLUB\Plugins\TestCron\Jobs\RunSync;
use iLUB\Plugins\TestCron\Object\Category\ARCategory;
use iLUB\Plugins\TestCron\Object\Course\ARCourse;
use iLUB\Plugins\TestCron\Object\CourseMembership\ARCourseMembership;
use iLUB\Plugins\TestCron\Object\Group\ARGroup;
use iLUB\Plugins\TestCron\Object\GroupMembership\ARGroupMembership;
use iLUB\Plugins\TestCron\Object\OrgUnit\AROrgUnit;
use iLUB\Plugins\TestCron\Object\OrgUnitMembership\AROrgUnitMembership;
use iLUB\Plugins\TestCron\Object\Session\ARSession;
use iLUB\Plugins\TestCron\Object\SessionMembership\ARSessionMembership;
use iLUB\Plugins\TestCron\Object\User\ARUser;
use iLUB\Plugins\TestCron\Origin\User\ARUserOrigin;

/**
 * Class ilTestCronPlugin
 *
 * @package
 */
class ilTestCronPlugin extends ilCronHookPlugin {

	use DIC;
	const PLUGIN_ID = 'tcron';
	const PLUGIN_NAME = 'TestCron';
	/**
	 * @var ilTestCronPlugin
	 */
	protected static $instance;


	/**
	 * @return string
	 */
	public function getPluginName(): string {
		return self::PLUGIN_NAME;
	}


	/**
	 * @return ilTestCronPlugin
	 */
	public static function getInstance(): ilTestCronPlugin {
		if (self::$instance === NULL) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * @return ilCronJob[]
	 */
	public function getCronJobInstances(): array {
		return [ new RunSync() ];
	}


	/**
	 * @param string $a_job_id
	 *
	 * @return ilCronJob
	 */
	public function getCronJobInstance($a_job_id): ilCronJob {
		return new $a_job_id();
	}


	/**
	 *
	 */
	protected function removeTestCronData() {
		// TODO: remove tables from DB
	}

}
