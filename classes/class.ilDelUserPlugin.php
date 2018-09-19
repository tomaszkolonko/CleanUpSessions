<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\DelUser\Config\ArConfig;
use iLUB\Plugins\DelUser\Helper\DIC;
use iLUB\Plugins\DelUser\Jobs\RunSync;
use iLUB\Plugins\DelUser\Object\Category\ARCategory;
use iLUB\Plugins\DelUser\Object\Course\ARCourse;
use iLUB\Plugins\DelUser\Object\CourseMembership\ARCourseMembership;
use iLUB\Plugins\DelUser\Object\Group\ARGroup;
use iLUB\Plugins\DelUser\Object\GroupMembership\ARGroupMembership;
use iLUB\Plugins\DelUser\Object\OrgUnit\AROrgUnit;
use iLUB\Plugins\DelUser\Object\OrgUnitMembership\AROrgUnitMembership;
use iLUB\Plugins\DelUser\Object\Session\ARSession;
use iLUB\Plugins\DelUser\Object\SessionMembership\ARSessionMembership;
use iLUB\Plugins\DelUser\Object\User\ARUser;
use iLUB\Plugins\DelUser\Origin\User\ARUserOrigin;

/**
 * Class ilDelUserPlugin
 *
 * @package
 */
class ilDelUserPlugin extends ilCronHookPlugin {

	use DIC;
	const PLUGIN_ID = 'del';
	const PLUGIN_NAME = 'DelUser';
	/**
	 * @var ilDelUserPlugin
	 */
	protected static $instance;


	/**
	 * @return string
	 */
	public function getPluginName(): string {
		return self::PLUGIN_NAME;
	}


	/**
	 * @return ilDelUserPlugin
	 */
	public static function getInstance(): ilDelUserPlugin {
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
	protected function removeDelUserData() {
		// TODO: remove tables from DB
	}

}
