<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$themefolder = $_POST['themefolder'];
	$themevers   = $_POST['themevers'];
	$targetfldr  = $_POST['targetfolder'];
	$adminid     = $_POST['adminid'];

	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$root    = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
	if($targetfldr=="withoutfolder") {
		$txtfile  = file($root."/CR-THEMES/".$themefolder."/version.txt");
	}
	else {
		$txtfile  = file($root."/".$targetfldr."/CR-THEMES/".$themefolder."/version.txt");	
	}
	$newvers  = str_replace('.','',$txtfile[0]);
	if($themevers < $newvers) {
		echo 'available';
	}
	else {
		echo 'unavailable';
	}
?>