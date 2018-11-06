<?php

namespace iLUB\Plugins\CleanUpSessions\Jobs;

use Exception;
use ilCronJob;
use iLUB\Plugins\CleanUpSessions\Helper\CleanUpSessionsDBAccess;
use iLUB\Plugins\CleanUpSessions\Jobs\Result\AbstractResult;
use iLUB\Plugins\CleanUpSessions\Jobs\Result\ResultFactory;
use ilCleanUpSessionsPlugin;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class RunSync
 *
 * @package iLUB\Plugins\CleanUpSessions\Jobs
 */
class RunSync extends AbstractJob {

    /**
     * @var $this->logger
     */
    protected $logger;

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
	 * @return \ilCronJobResult
     * @throws
	 */
	public function run() {
        $this->logger = new Logger("CronSyncLogger");
        $this->logger->pushHandler(new StreamHandler(ilCleanUpSessionsPlugin::LOG_DESTINATION), Logger::DEBUG);
        $jobResult = new \ilCronJobResult();

        $this->logger->info("Rsync::run() \n");
		try {

            $tc = new CleanUpSessionsDBAccess();
            $tc->allAnonymousSessions();
            $tc->removeAnonymousSessionsOlderThanExpirationThreshold();

			$jobResult->setStatus($jobResult::STATUS_OK);
			$jobResult->setMessage("Everything worked fine.");
			return $jobResult;
		} catch (Exception $e) {
		    $jobResult->setStatus($jobResult::STATUS_CRASHED);
		    $jobResult->setMessage("There was an error.");
			return $jobResult;
		}
	}
}
