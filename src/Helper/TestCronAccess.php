<?php

namespace iLUB\Plugins\TestCron\Helper;


use ilDB;
use iLUB\Plugins\TestCron\Log\Logger;


class TestCronAccess {
    /**
     * @var ilDB
     */
    protected $db;

    /**
     * @var $this->logger
     */
    protected $logger;

    use DIC;

    /**
     *
     * @throws
     */
    public function __construct() {
        $this->logger = new Logger("TestCronLogger.log");
        $this->logger->write("TestCronAccess::__construct() \n");
        $this->db = $this->dic()->database();

    }

    /**
     * @inheritdoc
     */
    public function allAnonymousUsers() {
        $this->logger->write("TestCronAccess::allAnonymousUsers() \n");
        $sql = "SELECT * FROM usr_session WHERE user_id = 13";
        $query = $this->db->query($sql);

        while ($rec = $this->db->fetchAssoc($query)) {
            $msg = 'id: ' . $rec['user_id'] . ' valid till: ' . date('Y-m-d - H:i:s', $rec['ctime']) . "\n";
            $this->logger->write($msg);
        }

        return ($this->db->numRows($query) > 0);
    }
}