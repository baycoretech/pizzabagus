<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getMenu      = new menu($pdo);
    $submenuID      = $_POST['submenuID'];
    $adminLoginID   = $_POST['adminLoginID'];
    $delete_submenu = $o_getMenu->deleteSubmenu($submenuID, $adminLoginID);
	echo "success"; 
?>