<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';
    $class_blog      = new Blog($pdo);
    $title           = $_POST['title'];
    $content         = $_POST['editorpost'];
    $blogtype        = $_POST['blogtype'];
    if(isset($_POST['tags'])) {
    	$noimplodetags = $_POST['tags'];
    	$tags          = implode(', ', $_POST['tags']);
    }
    else {
    	$noimplodetags = NULL;
    	$tags        = NULL;
    }
    $noimplodetags   = $_POST['tags'];
    $comment         = $_POST['comment'];
    $metakey         = $_POST['metakey'];
    $metadesc        = $_POST['metadesc'];
    $cat             = $_POST['cat'];
    $status          = $_POST['status'];
    $blog_idh        = $_POST['blog_idh'];
    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($title) || empty($content) || empty($cat) || empty($status)) {
    	echo 'empty-field';
    }
    else {
		if(strlen($title) > 200) {
        	echo "title-long";
	    }
	    elseif(strlen($title) < 4) {
        	echo "title-short";
	    }
	    elseif(strlen($metakey) > 255) {
        	echo "metakey-long";
	    }
	    elseif(strlen($metadesc) > 155) {
        	echo "metadesc-long";
	    }
	    else {
			$function_check_blog_name_edit = $class_blog->check_blog_name_edit($blog_idh, $title);
	        if($function_check_blog_name_edit == true) {
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

				$blog_type_id = $class_blog->check_blog_type_name($blogtype);
		        $function_update_blog_standard = $class_blog->update_blog_standard($title, $content, $blog_type_id, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blog_idh, $admin_login_id, $now_date);
		        if($function_update_blog_standard == true) 
			    	echo 'true';
			    else 
			    	echo 'false';
		    }
		}
	}
?>