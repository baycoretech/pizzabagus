<?php
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_getSettings = new settings($pdo);
	$settingvalue  = $_POST['settingvalue'];
	$adminid       = $_POST['adminid'];
	$v_getUpdateLayout = $o_getSettings->updateSettingsLayoutMode($settingvalue, $adminid);
	echo "true";
?>