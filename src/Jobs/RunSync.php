<?php

namespace iLUB\Plugins\TestCron\Jobs;

use Exception;
use ilCronJob;
use iLUB\Plugins\TestCron\Helper\TestCronDBAccess;
use iLUB\Plugins\TestCron\Jobs\Result\AbstractResult;
use iLUB\Plugins\TestCron\Jobs\Result\ResultFactory;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Class RunSync
 *
 * @package iLUB\Plugins\TestCron\Jobs
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
	 * @return AbstractResult
     * @throws
	 */
	public function run() {
        $this->logger = new Logger("CronSyncLogger");
        $this->logger->pushHandler(new StreamHandler(ilTestCronPlugin::LOG_DESTINATION), Logger::DEBUG);
        $this->logger->info("Rsync::run() \n");
		try {

            $anonymous = new TestCronDBAccess($this->logger);
            $anonymous->allAnonymousUsers();
            $expirationThreshold = $anonymous->getExpirationValue();
            if($anonymous->removeAnonymousOlderThan($expirationThreshold)) {
                $this->logger->info("Removal of anonymous successfull) \n");
            } else {
                $this->logger->info("Removal of anonymous un-successfull \n");
            }


			return ResultFactory::ok("everything's fine.");
		} catch (Exception $e) {
			return ResultFactory::error("there was an error");
		}
	}
}
