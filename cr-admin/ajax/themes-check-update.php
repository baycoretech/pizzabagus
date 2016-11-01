<?php
	if(!isset($_SESSION)) {
        session_start();
    }

    require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$themefolder = $_POST['themefolder'];
	$themevers   = $_POST['themevers'];
	$targetfldr  = $_POST['targetfolder'];

	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$root    = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
	if($targetfldr == "withoutfolder") {
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