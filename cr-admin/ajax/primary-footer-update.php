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
    $pftype          = $_POST['pftype2'];
    //custom text
    $customtexttitle = ucwords($_POST['ct-pf-title']);
    $customtexttext  = $_POST['ct-pf-text'];
    //latest portfolio
    $latestportfoliotitle    = ucwords($_POST['lp-pf-title']);
    $latestportfoliocategory = $_POST['lp-pf-category'];
    $latestportfoliototal    = $_POST['lp-pf-showing'];
    //blogs
    $blogtitle               = ucwords($_POST['lb-pf-title']);
    $blogpage                = $_POST['lb-pf-page'];
    $blogcategory            = $_POST['lb-pf-category'];
    $blogtotal               = $_POST['lb-pf-showing'];
    //latest tour package
    $latesttourtitle         = ucwords($_POST['lt-pf-title']);
    $latesttourpage          = $_POST['lt-pf-page'];
    $latesttourtotal         = $_POST['lt-pf-total'];
    //latest gallery
    $latestgallerytitle      = ucwords($_POST['lg-pf-title']);
    $latestgallerytotal      = $_POST['lg-pf-showing'];
    //available social media
    $socialtitle             = ucwords($_POST['sc-pf-title']);
    $socialdescription       = $_POST['sc-pf-desc'];
    //instagram feed
    $instafeedtitle          = ucwords($_POST['if-pf-title']);
    $instafeedtotal          = $_POST['if-pf-showing'];
    //twitter feed
    $twitterfeedtitle        = ucwords($_POST['tf-pf-title']);
    $twitterfeedtext         = $_POST['tf-pf-text'];
    //facebook page box
    $facebookpagetitle       = ucwords($_POST['fp-pf-title']);
    $facebookpagetext        = $_POST['fp-pf-text'];

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
	        $function_update_footer = $class_primary_footer->update_primary_footer_1($footer_id, $customtexttitle, $customtexttext, $admin_login_id, $now_date);
	    }
	    elseif($pftype == "portfolio") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_2($footer_id, $latestportfoliotitle, $latestportfoliocategory, $latestportfoliototal, $admin_login_id, $now_date);
	    }
	    elseif($pftype == "gallery") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_3($footer_id, $latestgallerytitle, $latestgallerytotal, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "social") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_4($footer_id, $socialtitle, $socialdescription, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "instafeed") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_5($footer_id, $instafeedtitle, $instafeedtotal, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "twitter") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_6($footer_id, $twitterfeedtitle, $twitterfeedtext, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "facebookpage") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_7($footer_id, $facebookpagetitle, $facebookpagetext, $admin_login_id, $now_date);
	    } 
	    elseif($pftype == "blog") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_8($footer_id, $blogtitle, $blogpage, $blogcategory, $blogtotal, $admin_login_id, $now_date);
	    }
	    elseif($pftype == "tour") {
	        $function_update_footer = $class_primary_footer->update_primary_footer_9($footer_id, $latesttourtitle, $latesttourpage, $latesttourtotal, $admin_login_id, $now_date);
	    }
    	if($function_update_footer == true) 
	    	echo 'true';
	    else 
	    	echo 'false';
	}
?>