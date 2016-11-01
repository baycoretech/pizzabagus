<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$crvers      = $_POST['crvers'];
	$userplan    = $_POST['userplan'];
	$adminid     = $_POST['adminid'];

	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$root    = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
	$txtfile  = file($root."/CR-UPDATE/".$userplan."/version.txt");
	$newvers  = str_replace('.','',$txtfile[0]);
	if($crvers < $newvers) {
		echo 'available';
	}
	else {
		echo 'unavailable';
	}
?>