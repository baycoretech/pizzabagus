<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 

if($_FILES["ziptheme"]["name"]=="") {
	echo "empty";
}
else {
	if($_FILES["ziptheme"]["name"]) {
		$filename = $_FILES["ziptheme"]["name"];
		$source = $_FILES["ziptheme"]["tmp_name"];
		$type = $_FILES["ziptheme"]["type"];
		
		$name = explode(".", $filename);
		$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
		foreach($accepted_types as $mime_type) {
			if($mime_type == $type) {
				$okay = true;
				break;
			} 
		}
		
		$continue = strtolower($name[1]) == 'zip' ? true : false;
		if(!$continue) {
			//$message = "The file you are trying to upload is not a .zip file. Please try again.";
			$message = "notzip";
			echo $message;
		}
		else {

			require_once "include/database.php";//database
			require_once "include/class-data.php";//all data

			$o_getGF = new globalFunction($pdo);
			$v_getGF = $o_getGF->folderName();
			
			if($v_getGF=="0") {
				$targetFolder = $_SERVER['DOCUMENT_ROOT']."/cr-content/themes/";
			}
			else {
				$targetFolder = $_SERVER['DOCUMENT_ROOT']."/".$v_getGF."/cr-content/themes/";
			}

			$target_path = $targetFolder.$filename;  // change this to the correct site path
			if(move_uploaded_file($source, $target_path)) {
				$zip = new ZipArchive();
				$x = $zip->open($target_path);
				if ($x === true) {
					$zip->extractTo($targetFolder); // change this to the correct site path
					$zip->close();
			
					unlink($target_path);
				}
				//$message = "Your .zip file was uploaded and unpacked.";
				$message = "success";
				echo $message;
			} else {	
				//$message = "There was a problem with the upload. Please try again.";
				$message = "failed";
				echo $message;
			}
		}
	}
}
?>