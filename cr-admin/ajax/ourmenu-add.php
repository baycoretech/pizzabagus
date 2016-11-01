<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';
    $class_ourmenu   = new Our_Menu($pdo);
    $title           = $_POST['title'];
    if(isset($_POST['ingredients'])) {
    	$noimplodeingredients = $_POST['ingredients'];
    	$ingredients          = implode(', ', $_POST['ingredients']);
    }
    else {
    	$noimplodeingredients = NULL;
    	$ingredients          = NULL;
    }
    if(isset($_POST['ingredients_id'])) {
    	$noimplodeingredients_id = $_POST['ingredients_id'];
    	$ingredients_id          = implode(', ', $_POST['ingredients_id']);
    }
    else {
    	$noimplodeingredients_id = NULL;
    	$ingredients_id          = NULL;
    }
    $desc            = $_POST['editorourmenu'];
    $desc_id         = $_POST['editorourmenu_id'];
    $price           = $_POST['price'];
    $size            = $_POST['size'];
    $type            = $_POST['type'];
    $photo           = $_POST['photo'];
    $cat             = $_POST['cat'];
    $status          = $_POST['status'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($title) || empty($cat) || empty($status) || empty($price) || empty($size)) {
    	echo 'empty-field';
    }
    else {
    	/*
    	if($photo == MADMINURL."assets/img/no-pic-items.png") {
			echo "no-image";
		}
		else {
		*/
			if(strlen($title) > 200) {
	        	echo "title-long";
		    }
		    elseif(strlen($title) < 3) {
	        	echo "title-short";
		    }
		    elseif($title == "sort" || $title == "Sort") {
	        	echo "reserved-word";
		    }
		    else {
		      	$function_check_name_ourmenu = $class_ourmenu->check_name_ourmenu($title);
		        if($function_check_name_ourmenu == true) {
		        	echo "same-title";
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

			        $function_add_ourmenu = $class_ourmenu->add_ourmenu($title, $ingredients, $ingredients_id, $noimplodeingredients, $noimplodeingredients_id, $desc, $desc_id, $photo, $cat, $status, $price, $size, $type, $admin_login_id, $now_date);
			        if($function_add_ourmenu == true) 
				    	echo 'true';
				    else 
				    	echo 'false';
			    }
			}
		//}
	}
?>