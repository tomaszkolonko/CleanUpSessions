<?php

namespace iLUB\Plugins\TestCron\Jobs;

use Exception;
use ilCronJob;
use iLUB\Plugins\TestCron\Helper\TestCronAccess;
use iLUB\Plugins\TestCron\Jobs\Result\AbstractResult;
use iLUB\Plugins\TestCron\Jobs\Result\ResultFactory;
use iLUB\Plugins\TestCron\Log\Logger;
use iLUB\Plugins\TestCron\Sync\SyncSummaryCron;

/**
 * Class RunSync
 *
 * @package iLUB\Plugins\TestCron\Jobs
 */
class RunSync extends AbstractJob {

	/**
	 * @return string
	 */
	public function getId() {
		return get_class($this);
	}


	/**
	 * @return bool
	 */
	public function hasAutoActivation() {
		return true;
	}


	/**
	 * @return bool
	 */
	public function hasFlexibleSchedule() {
		return true;
	}


	/**
	 * @return int
	 */
	public function getDefaultScheduleType() {
		return ilCronJob::SCHEDULE_TYPE_DAILY;
	}


	/**
	 * @return null
	 */
	public function getDefaultScheduleValue() {
		return 1;
	}


	/**
	 * @return AbstractResult
	 */
	public function run() {
        $this->logger = new Logger("TestCronLogger.log");
        $this->logger->write("Rsync::run() \n");
		try {

            $anonymous = new TestCronAccess();
            $anonymous->allAnonymousUsers();


			return ResultFactory::ok("everything's fine.");
		} catch (Exception $e) {
			return ResultFactory::error("there was an error");
		}
	}
}
