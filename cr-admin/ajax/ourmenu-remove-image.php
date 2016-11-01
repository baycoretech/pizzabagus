<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_ourmenu  = new Our_Menu($pdo);
    $menu_id        = $_POST['menuid'];
    $admin_login_id = $_SESSION['cr_adminID'];

    if(empty($menu_id)) {
		echo "menu-empty";
	}
	else {
	    $function_delete_menu_image = $class_ourmenu->delete_menu_image($menu_id);
	    if($function_delete_menu_image == true) 
		    echo 'true';
		else 
		  	echo 'false';
	}
?>