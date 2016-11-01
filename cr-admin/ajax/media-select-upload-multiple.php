<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	if (!empty($_FILES)) {
		$admin_login_id = $_SESSION['cr_adminID']; 
	    $class_media = new Media($pdo);

	    //Set timezone
		$class_general_setting    = new General_Setting($pdo);
		$v_set_timezone           = $class_general_setting->set_timezone();
		$get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
		if(!empty($v_set_timezone->cr_settingValue)) {
		    date_default_timezone_set($get_timezone_city);
		}
		$date_for_now = new DateTime();
		$date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
		$now_date     = $date_for_now->format('Y-m-d H:i:s');
		//Same format as NOW(), use to save datetime value to database

	    foreach($_FILES['file']['name'] as $index=>$name){
	    	$target_path = '../../cr-editor/images/'; 
	    	$temp_file = $_FILES['file']['tmp_name']; 
	    	$extension = end(explode(".", $name));
		    $file_name = md5(uniqid(rand(), true));
		    $target_file =  $target_path.$file_name; 
	    	move_uploaded_file($temp_file[$index],$target_file.'.'.$extension);
	    	$function_add_media = $class_media->add_media($file_name.'.'.$extension, $admin_login_id, $now_date);
	    	$result[] = $file_name.'.'.$extension;
	    }
	    header('Content-type: text/json');              //3
	    header('Content-type: application/json');
	    echo json_encode($result);
	}
?>