<?php
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_getClients       = new clients($pdo);
	$idArray	        = explode(",",$_POST['ids']);
	$v_getUpdateClients = $o_getClients->reorderClients($idArray);
?>