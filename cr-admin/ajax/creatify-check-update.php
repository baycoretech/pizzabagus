<?php
  	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$crvers      = $_POST['crvers'];

	$class_settings     = new Settings($pdo);
	$function_user_plan = $class_settings->user_plan();

	$docroot  = $_SERVER['DOCUMENT_ROOT'];
	$root     = substr($docroot, 0, strpos($docroot, 'public_html/')).'public_html';
	$txtfile  = file($root."/CR-UPDATE/".$function_user_plan."/version.txt");
	$newvers  = str_replace('.','',$txtfile[0]);
	if($crvers < $newvers) {
		echo 'available';
	}
	else {
		echo 'unavailable';
	}
?>