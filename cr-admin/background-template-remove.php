<?php
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_getSettings = new settings($pdo);
	$adminid       = $_POST['adminid'];
	$v_getRemoveBg = $o_getSettings->removeBgtemplate($adminid);
	echo "true";
?>