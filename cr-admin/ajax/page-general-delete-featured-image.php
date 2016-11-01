<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_page     = new Page($pdo);
    $page_id        = $_POST['page_id'];
    $admin_login_id = $_SESSION['cr_adminID'];

    if(empty($page_id)) {
		echo "page-empty";
	}
	else {
	    $function_delete_featured_image = $class_page->delete_featured_image($page_id);
	    if($function_delete_featured_image == true) 
		    echo 'true';
		else 
		  	echo 'false';
	}
?>