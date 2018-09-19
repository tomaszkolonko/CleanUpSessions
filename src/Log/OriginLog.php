<?php

namespace iLUB\Plugins\TestCron\Log;

use iLUB\Plugins\TestCron\Origin\IOrigin;

/**
 * Class OriginLog
 *
 *
 * @package iLUB\ILIAS\Plugins\Log
 */
class OriginLog implements ILog {

	/**
	 * @var IOrigin
	 */
	protected $origin;
	/**
	 * @var Logger
	 */
	protected $log;
	/**
	 * @var array
	 */
	protected static $ilLogInstances = [];


	/**
	 * @param IOrigin $origin
	 */
	public function __construct(IOrigin $origin) {
		$this->origin = $origin;
		$this->log = $this->getLogInstance($origin);
	}


	/**
	 * @param string $message
	 * @param int    $level
	 */
	public function write($message, $level = self::LEVEL_INFO) {
		$this->log->write($message);
	}


	/**
	 * @param IOrigin $origin
	 *
	 * @return Logger
	 * @throws \ILIAS\Filesystem\Exception\IOException
	 */
	private function getLogInstance(IOrigin $origin) {
		if (isset(self::$ilLogInstances[$origin->getId()])) {
			return self::$ilLogInstances[$origin->getId()];
		}
		$filename = implode('-', [
			\ilTestCronPlugin::PLUGIN_ID,
			'origin',
			$origin->getObjectType(),
			$origin->getId(),
		]);

		$logger = new Logger('TestCron/' . $filename . '.log');
		self::$ilLogInstances[$origin->getId()] = $logger;

		return $logger;
	}
}
