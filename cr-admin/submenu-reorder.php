<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_getMenu       = new menu($pdo);
	$idArray	     = explode(",",$_POST['ids']);
	$menu_link       = $_GET['menu'];
	$v_getReordersubmenu = $o_getMenu->reorderSubmenu($idArray, $menu_link);
?>