<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_page  = new Page($pdo);
	$pagetitle       = $_POST['title'];
	$page_column     = $_POST['page_column'];
    $column1         = $_POST['editor1'];
    $column2         = $_POST['editor2'];
    $column3         = $_POST['editor3'];
    $metakeywords    = $_POST['metakeywords'];
    $metadesc        = $_POST['metadesc'];
    $link            = $_POST['link'];
	if(empty($_POST['photo']))
    	$photo = NULL;
    else {
    	$photo = $_POST['photo'];
    }
    $admin_login_id  = $_SESSION['cr_adminID'];

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

    if($page_column == 1) {
    	if(empty($pagetitle) || empty($column1)) {
	    	echo 'empty-field';
	    }
	    else {
	    	if(!empty($pagetitle) && strlen($pagetitle) > 100) {
				echo "name-long";
			}
			else {
		    	$function_add_page = $class_page->add_page_general_1($pagetitle, $column1, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date);
		    	if($function_add_page == true) 
			    	echo 'true';
			    else 
			    	echo 'false';
			}
	    }
    }
    elseif($page_column == 2) {
    	if(empty($pagetitle) || empty($column1) || empty($column2)) {
	    	echo 'empty-field';
	    }
	    else {
	    	if(!empty($pagetitle) && strlen($pagetitle) > 100) {
				echo "name-long";
			}
			else {
				$function_add_page = $class_page->add_page_general_2($pagetitle, $column1, $column2, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date);
		    	if($function_add_page == true) 
			    	echo 'true';
			    else 
			    	echo 'false';
	    	}
	    }
    }
    elseif($page_column == 3) {
    	if(empty($pagetitle) || empty($column1) || empty($column2) || empty($column3)) {
	    	echo 'empty-field';
	    }
	    else {
	    	if(!empty($pagetitle) && strlen($pagetitle) > 100) {
				echo "name-long";
			}
			else {
				$function_add_page = $class_page->add_page_general_3($pagetitle, $column1, $column2, $column3, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date);
		    	if($function_add_page == true) 
			    	echo 'true';
			    else 
			    	echo 'false';
	    	}
	    }
    }
?>