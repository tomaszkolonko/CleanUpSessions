<#1>
<?php
/** @var ilDB $ilDB */
global $ilDB;
$db = $ilDB;
require_once('Customizing/global/plugins/Services/Cron/CronHook/TestCron/classes/class.ilTestCronPlugin.php');

if (! $db->tableExists(ilTestCronPlugin::TABLE_NAME)) {
    $fields = array(
        'expiration' => array(
            'type' => 'integer',
            'length' => 4,
            'notnull' => TRUE
        )
    );
    $db->createTable(ilTestCronPlugin::TABLE_NAME, $fields);
    $db->insert(ilTestCronPlugin::TABLE_NAME, array(
            ilTestCronPlugin::COLUMN_NAME => array(
                    'integer', ilTestCronPlugin::DEFAULT_EXPIRATION_VALUE
            )
    ));
}
?>