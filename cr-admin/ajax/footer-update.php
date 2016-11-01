<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $firstcolumn     = $_POST['firstcolumn'];
    $secondcolumn    = $_POST['secondcolumn'];
    $setting_idh     = $_POST['setting_idh'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(strlen($firstcolumn)>700) {
		echo "firstcolumn-long";
	}
	elseif(strlen($secondcolumn)>700) {
		echo "secondcolumn-long";
	}
	else {
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

	    if(empty($firstcolumn))
            $arr = array('NULL',$secondcolumn);
        elseif(empty($secondcolumn)) 
            $arr = array($firstcolumn,'NULL');
        elseif(empty($secondcolumn) && empty($firstcolumn)) 
            $arr = array('NULL','NULL');
        else
            $arr = array($firstcolumn,$secondcolumn);

        $value   = implode(",", $arr);

    	$class_footer = new Footer($pdo);
		$function_update_footer = $class_footer->update_footer($value, $admin_login_id, $setting_idh, $now_date);
		if($function_update_footer == true) {
		    echo 'true';
		}
		else {
			echo 'false';
		}
	}
?>