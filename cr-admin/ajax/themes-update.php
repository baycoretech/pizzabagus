<?php
	if(!isset($_SESSION)) {
        session_start();
    }

    require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	if(isset($_POST['themefolder']) && isset($_POST['targetfolder'])) {
		$themefolder  = $_POST['themefolder'];
		$targetfldr   = $_POST['targetfolder'];

		$docroot = $_SERVER['DOCUMENT_ROOT'];
		$root    = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
		$zipfile = $root."/CR-THEMES/".$themefolder."/update.zip";
		if($targetfldr == "withoutfolder") {
			$targetFolder = $docroot."/cr-content/themes/".$themefolder;
		}
		else {
			$targetFolder = $docroot."/".$targetfldr."/cr-content/themes/".$themefolder;
		}
		$zip = new ZipArchive();
		$x   = $zip->open($zipfile);
		if ($x === true) {
			$zip->extractTo($targetFolder);
			$zip->close();
		}
		echo "success";
	}
	else {
		echo 'failed';
	}
?>