<#1>
<?php
require_once "Customizing/global/plugins/Services/Cron/CronHook/TestCron/vendor/autoload.php";

iLUB\Plugins\TestCron\Config\ArConfig::updateDB();

$config = new \iLUB\Plugins\TestCron\Config\ArConfig();
$config->save();
?>
