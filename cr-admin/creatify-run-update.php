<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$targetfldr   = $_POST['targetfolder'];
	$userplan     = $_POST['userplan'];
	$adminid      = $_POST['adminid'];

	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$root    = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
	$zipfile = $root."/CR-UPDATE/".$userplan."/update.zip";
	if($targetfldr=="withoutfolder") {
		$targetFolder = $docroot."/";
	}
	else {
		$targetFolder = $docroot."/".$targetfldr;
	}
	$zip = new ZipArchive();
	$x = $zip->open($zipfile);
	if ($x === true) {
		$zip->extractTo($targetFolder);
		$zip->close();
	}
	$message = "success";
	echo $message;
?>