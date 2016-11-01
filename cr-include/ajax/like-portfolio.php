<?php
	if (!isset($_SESSION)) {
	    session_start();
	}

	require __DIR__.'/../error-report.php';
    require __DIR__.'/../database/connection.php';
    require __DIR__.'/../autoloader.php'; 
    require __DIR__.'/../setup-function.php'; 
    require __DIR__.'/../global-function.php';

    if(isset($_POST['portfolioid'])) {
		$portfolioid = abs($_POST['portfolioid']);
		$ip = get_real_ip();

		$class_portfolio = new Portfolio($pdo);
		$check_ip_likes = $class_portfolio->check_ip_likes($portfolioid, $ip);

		if($check_ip_likes == 0) {
			$class_general_setting    = new General_Setting($pdo);
		    //Set timezone
		    $v_set_timezone           = $class_general_setting->set_timezone();
		    $get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
		    if(!empty($v_set_timezone->cr_settingValue)) {
		        date_default_timezone_set($get_timezone_city);
		    }
		    $date_for_now = new DateTime();
		    $date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
		    $now_date     = $date_for_now->format('Y-m-d H:i:s');
		    //Same format as NOW(), use to save datetime value to database, without timezone, that will be diffrent datetime insert in database

			$add_likes = $class_portfolio->add_likes($portfolioid, $ip, $now_date);
			$count_likes = $class_portfolio->count_likes($portfolioid);
			echo "true!".$count_likes;
		} 
		else {
			echo "exist";
		}
	}
	else {
		echo 'false';
	}
?>