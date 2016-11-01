<?php
  	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$targetfldr         = $_POST['targetfolder'];

	$class_settings     = new Settings($pdo);
	$function_user_plan = $class_settings->user_plan();

	$docroot = $_SERVER['DOCUMENT_ROOT'];
	$root    = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
	$zipfile = $root."/CR-UPDATE/".$function_user_plan."/update.zip";
	if($targetfldr == "withoutfolder") {
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