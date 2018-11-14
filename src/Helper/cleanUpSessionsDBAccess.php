<?php

namespace iLUB\Plugins\CleanUpSessions\Helper;


use ilDB;
use ilCleanUpSessionsPlugin;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class CleanUpSessionsDBAccess {
	/**
	 * @var ilDB
	 */
	protected $db;

	/**
	 * @var $this ->logger
	 */
	protected $logger;

	/**
	 * CleanUpSessionsDBAccess constructor. Initializes Monolog logger. Logs to root directory of the plugin.
	 *
	 * @param null $logger
	 * @throws \Exception
	 */
	public function __construct() {
		global $DIC;
		$this->logger = new Logger("CleanUpSessionsDBAccess");
		$this->logger->pushHandler(new StreamHandler(ilCleanUpSessionsPlugin::LOG_DESTINATION), Logger::DEBUG);

		$this->db = $DIC->database();
	}

	/**
	 * Logs all anonymous sessions to the log ilCleanUpSessionsPlugin::LOG_DESTINATION and returns the number of
	 * all active anonymous sessions
	 *
	 * @return int
	 */
	public function allAnonymousSessions() {
		$this->logger->info("access all anonymous users... ");

		$sql = "SELECT * FROM usr_session WHERE user_id = 13";
		$query = $this->db->query($sql);
		$counter = 1;
		while ($rec = $this->db->fetchAssoc($query)) {
			$msg = '#' . $counter++ . '  id: ' . $rec['user_id'] . ' valid till: ' . date('Y-m-d - H:i:s', $rec['expires']) . "\n";
			$this->logger->info($msg);
		}

		return $counter;
	}

	/**
	 * Logs all exppired anonymous sessions to the log ilCleanUpSessionsPlugin::LOG_DESTINATION and returns the number of
	 * all expired anonymous sessions
	 *
	 * @return int
	 */
	public function expiredAnonymousUsers() {
		$thresholdBoundary = $this->getExpirationValue();
		$sql = "SELECT * FROM usr_session WHERE user_id = 13 AND createtime < %s";
		$set = $this->db->queryF($sql, ['integer'], [$thresholdBoundary]);

		$counter = 1;
		while ($rec = $this->db->fetchAssoc($set)) {
			$msg = 'Expired Users -> #' . $counter++ . '  id: ' . $rec['user_id'] . ' valid till: ' .
				date('Y-m-d - H:i:s', $rec['expires']) . "\n";
			$this->logger->info($msg);
		}

		return $counter;
	}

	/**
	 * Returns the set expiration threshold set in the config
	 *
	 * @return mixed
	 */
	public function getExpirationValue() {
		$sql = "SELECT expiration FROM clean_ses_cron";
		$query = $this->db->query($sql);
		$rec = $this->db->fetchAssoc($query);

		return $rec['expiration'];
	}

	/**
	 * Delets all the expired anonymous sessions from the DB and logs the
	 * remaining non-expired anonymous sessions.
	 */
	public function removeAnonymousSessionsOlderThanExpirationThreshold() {

		$all = $this->allAnonymousSessions();

		$sql = "DELETE FROM usr_session WHERE user_id = 13 AND createtime < %s";
		$this->db->manipulateF($sql, ['integer'], [$this->getThresholdBoundary()]);

		$after = $this->allAnonymousSessions();

		// Only for debugging:
		$this->logger->info($all - $after . " anonymous session(s) have been deleted");
		$this->logger->info("There are " . $after . " non-expired anonymous sessions remaining");
	}

	/**
	 * Returns the latest value in unix system time format, that is considered non-expired. All values
	 * below the returned one are considered expired.
	 *
	 * @return float|int
	 */
	private function getThresholdBoundary() {
		$currentTime = time();
		$expirationThreshold = $this->getExpirationValue();
		return $currentTime - $expirationThreshold * 60;
	}

	/**
	 * Updates an entry determined by id with new information
	 *
	 * @param bool $as_obj
	 */
	public function updateExpirationValue($expiration) {
		$this->db->manipulate('UPDATE ' . ilCleanUpSessionsPlugin::TABLE_NAME . ' SET' .
			' expiration = ' . $this->db->quote($expiration, 'integer') . ';'
		);
	}

	/**
	 * Removes the table from DB after uninstall is triggered.
	 */
	public function removePluginTableFromDB() {
		$sql = "DROP TABLE " . ilCleanUpSessionsPlugin::TABLE_NAME;
		$this->db->query($sql);
	}
}