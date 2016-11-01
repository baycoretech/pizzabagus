<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	$themefolder  = $_POST['themefolder'];
	$targetfldr   = $_POST['targetfolder'];
	$adminid      = $_POST['adminid'];

	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$root    = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
	$zipfile = $root."/CR-THEMES/".$themefolder."/update.zip";
	if($targetfldr=="withoutfolder") {
		$targetFolder = $docroot."/cr-content/themes/".$themefolder;
	}
	else {
		$targetFolder = $docroot."/".$targetfldr."/cr-content/themes/".$themefolder;
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