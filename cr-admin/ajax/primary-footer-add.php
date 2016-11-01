<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_primary_footer = new Primary_Footer($pdo);
	$footer_id       = $_POST['footer_id'];
    $pftype          = $_POST['pftype'];
    //custom text
    $customtexttitle = ucwords($_POST['customtexttitle']);
    $customtexttext  = $_POST['customtexttext'];
    //latest portfolio
    $latestportfoliotitle    = ucwords($_POST['latestportfoliotitle']);
    $latestportfoliocategory = $_POST['latestportfoliocategory'];
    $latestportfoliototal    = $_POST['latestportfoliototal'];
    //blogs
    $blogtitle               = ucwords($_POST['blogtitle']);
    $blogpage                = $_POST['blogpage'];
    $blogcategory            = $_POST['blogcategory'];
    $blogtotal               = $_POST['blogtotal'];
    //latest tour package
    $latesttourtitle         = ucwords($_POST['latesttourtitle']);
    $latesttourpage          = $_POST['latesttourpage'];
    $latesttourtotal         = $_POST['latesttourtotal'];
    //latest gallery
    $latestgallerytitle      = ucwords($_POST['latestgallerytitle']);
    $latestgallerytotal      = $_POST['latestgallerytotal'];
    //available social media
    $socialtitle             = ucwords($_POST['socialtitle']);
    $socialdescription       = $_POST['socialdescription'];
    //instagram feed
    $instafeedtitle          = ucwords($_POST['instafeedtitle']);
    $instafeedtotal          = $_POST['instafeedtotal'];
    //twitter feed
    $twitterfeedtitle        = ucwords($_POST['twitterfeedtitle']);
    $twitterfeedtext         = $_POST['twitterfeedtext'];
    //facebook page box
    $facebookpagetitle       = ucwords($_POST['facebookpagetitle']);
    $facebookpagetext        = $_POST['facebookpagetext'];

    $admin_login_id  = $_SESSION['cr_adminID'];

    if(empty($footer_id) || empty($pftype)){
    	echo "empty-field";
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

		if($pftype == "customtext") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_1($footer_id, $pftype, $customtexttitle, $customtexttext, $admin_login_id, $now_date);
	    }
	    elseif($pftype == "portfolio") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_2($footer_id, $pftype, $latestportfoliotitle, $latestportfoliocategory, $latestportfoliototal, $admin_login_id, $now_date);
	    }
	    elseif($pftype == "gallery") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_3($footer_id, $pftype, $latestgallerytitle, $latestgallerytotal, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "social") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_4($footer_id, $pftype, $socialtitle, $socialdescription, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "instafeed") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_5($footer_id, $pftype, $instafeedtitle, $instafeedtotal, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "twitter") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_6($footer_id, $pftype, $twitterfeedtitle, $twitterfeedtext, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "facebookpage") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_7($footer_id, $pftype, $facebookpagetitle, $facebookpagetext, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "blog") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_8($footer_id, $pftype, $blogtitle, $blogpage, $blogcategory, $blogtotal, $admin_login_id, $now_date);
	    }
	    elseif($pftype == "tour") {
	        $function_add_footer = $class_primary_footer->add_primary_footer_9($footer_id, $pftype, $latesttourtitle, $latesttourpage, $latesttourtotal, $admin_login_id, $now_date);
	    }
    	if($function_add_footer == true) 
	    	echo 'true';
	    else 
	    	echo 'false';
	}
?>