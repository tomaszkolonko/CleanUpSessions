<#1>
<?php
require_once "Customizing/global/plugins/Services/Cron/CronHook/DelUser/vendor/autoload.php";

iLUB\Plugins\DelUser\Config\ArConfig::updateDB();

$config = new \iLUB\Plugins\DelUser\Config\ArConfig();
$config->save();
?>
