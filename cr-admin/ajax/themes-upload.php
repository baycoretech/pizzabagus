<?php
  	if(!isset($_SESSION)) {
        session_start();
    }

	if($_FILES["ziptheme"]["name"] == "") {
		echo "empty";
	}
	else {
		if($_FILES["ziptheme"]["name"]) {
			$filename = $_FILES["ziptheme"]["name"];
			$source   = $_FILES["ziptheme"]["tmp_name"];
			$type     = $_FILES["ziptheme"]["type"];
			
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
				require __DIR__.'/../../cr-include/error-report.php';
			    require __DIR__.'/../include/database/connection.php';
			    require __DIR__.'/../include/autoloader.php';
			    require __DIR__.'/../include/global-function.php';

				$class_general_setting = new General_Setting($pdo);
				$function_folder_name  = $class_general_setting->folder_name();
				
				if($function_folder_name == "0") {
					$target_folder = $_SERVER['DOCUMENT_ROOT']."/cr-content/themes/";
				}
				else {
					$target_folder = $_SERVER['DOCUMENT_ROOT']."/".$function_folder_name."/cr-content/themes/";
				}

				$target_path = $target_folder.$filename;  // change this to the correct site path
				if(move_uploaded_file($source, $target_path)) {
					$zip = new ZipArchive();
					$x   = $zip->open($target_path);
					if ($x === true) {
						$zip->extractTo($target_folder); // change this to the correct site path
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