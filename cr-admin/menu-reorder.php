<?php
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_getMenu       = new menu($pdo);
	$idArray	     = explode(",",$_POST['ids']);
	$v_getUpdateMenu = $o_getMenu->updateMenu($idArray);
?>