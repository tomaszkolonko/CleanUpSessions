<?php

require_once __DIR__ . "/../vendor/autoload.php";

use iLUB\Plugins\CleanUpSessions\Helper\CleanUpSessionsDBAccess;
use iLUB\Plugins\CleanUpSessions\Jobs\RunSync;

/**
 * Class ilCleanUpSessionsPlugin
 *
 * @package
 */
class ilCleanUpSessionsPlugin extends ilCronHookPlugin {

	const PLUGIN_ID = 'clean_ses';
	const PLUGIN_NAME = 'CleanUpSessions';
	const TABLE_NAME = 'clean_ses_cron';
	const COLUMN_NAME = 'expiration';
	const DEFAULT_EXPIRATION_VALUE = 240;
	const EXPIRATION_THRESHOLD = 'expiration_threshold';
	# const IL_PLUGIN_TABLE = 'il_plugin';
	const LOG_DESTINATION = './Customizing/global/plugins/Services/Cron/CronHook/CleanUpSessions/app.log';

	/**
	 * @var ilCleanUpSessionsPlugin
	 */
	protected static $instance;
	/**
	 * @var $this ->access
	 */
	protected $access;


	/**
	 * @return string
	 */
	public function getPluginName(): string {
		return self::PLUGIN_NAME;
	}


	/**
	 * @return ilCleanUpSessionsPlugin
	 */
	public static function getInstance(): ilCleanUpSessionsPlugin {
		if (self::$instance === NULL) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * @return ilCronJob[]
	 */
	public function getCronJobInstances(): array {
		return [new RunSync()];
	}


	/**
	 * @param string $a_job_id
	 * @return ilCronJob
	 */
	public function getCronJobInstance($a_job_id): ilCronJob {
		$a_job_id = "\iLUB\Plugins\CleanUpSessions\Jobs\RunSync";
		return new $a_job_id();
	}


	/**
	 * AfterUninstall deletes the tables from the DB
	 */
	protected function afterUninstall() {
		global $DIC;
		$this->access = new CleanUpSessionsDBAccess($DIC);
		$this->access->removePluginTableFromDB();
	}

}
