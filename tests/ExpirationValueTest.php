<?php
/**
 * Created by PhpStorm.
 * User: thomaskolonko
 * Date: 15.10.18
 * Time: 13:13
 */

require_once __DIR__ . "/../vendor/autoload.php";


use PHPUnit\Framework\TestCase;

class ExpirationValueTest extends TestCase {

	const TESTDB_NAME = "testDB_CleanUpSessions";

	/**
	 * @var $conn
	 */
	protected $conn;

	public function setUp() {
		try {
			$this->conn = new PDO("mysql:host=localhost", "ilias", "asdf");
			print("\nConnected successfully");
			$sql = "CREATE DATABASE IF NOT EXISTS testDB_CleanUpSessions";
			$this->conn->query($sql);
			$this->conn = null;
			$this->conn = new PDO("mysql:host=localhost;dbname=testDB_CleanUpSessions", "ilias", "asdf");
		}
		catch(PDOException $e) {
			echo "Connection failed: " . $e->getTraceAsString();
		}

		$login_time = time() - 7200;
		$expire_time = time() + 7200;
		print("\n");
		print($login_time);
		print("\n");
		print($expire_time);

		$this->createTableForTesting();
		$this->populateTableForTesting();

		// TODO: construct the plugin with it's constructor passing in the new db

	}

	private function createTableForTesting() {
		$sql = "CREATE TABLE IF NOT EXISTS `usr_session` (
			`session_id` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT ' ',
			`expires` int(11) NOT NULL DEFAULT '0',
			`data` longtext COLLATE utf8_unicode_ci,
			`ctime` int(11) NOT NULL DEFAULT '0',
			`user_id` int(11) NOT NULL DEFAULT '0',
			`last_remind_ts` int(11) NOT NULL DEFAULT '0',
			`type` int(11) DEFAULT NULL,
			`createtime` int(11) DEFAULT NULL,
			`remote_addr` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
			  `context` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
			PRIMARY KEY (`session_id`),
			KEY `expires` (`expires`),
			KEY `ctime` (`ctime`),
			KEY `user_id` (`user_id`),
			KEY `user_id_2` (`user_id`,`expires`)
		) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
		$this->conn->query($sql);
}

	private function populateTableForTesting() {
		$data = "_authsession_authenticated|b:1;_authsession_user_id|i:13;_authsession_expired|i:0;";

		$min_time_value = time() - 14400;
		$user_id = 13;
		$last_remind_ts = 0;
		$type = 0;
		$remote_addr = null;
		$context = "ilContextWeb";

		for($i = 0; $i <= 100; $i++) {
			$session_id = substr(md5(mt_rand()), 0, 20);
			$ctime = rand($min_time_value, time());
			$expires = $ctime + 14400;
			$createtime = $ctime;

			$sql = "INSERT INTO `usr_session` (`session_id`, `expires`, `data`, `ctime`, `user_id`, `last_remind_ts`, `type`, `createtime`, `remote_addr`, `context`)
			VALUES ('$session_id', '$expires', '$data', '$ctime', '$user_id', '$last_remind_ts', '$type', '$createtime', '$remote_addr', '$context');";
			$this->conn->query($sql);
		}

	}

	public function tearDown() {
		//$sql = "DROP DATABASE IF EXISTS testDB_CleanUpSessions";
		//$this->conn->query($sql);
		$this->conn = null;
}

	public function testNothing() {
		$this->assertEquals(3, 2+1);
	}
}