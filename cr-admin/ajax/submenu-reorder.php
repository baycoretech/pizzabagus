<?php
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_menu = new Menu($pdo);
	$id_array	= explode(",",$_POST['ids']);
	$menu       = $_POST['menu'];
	$function_reorder_submenu = $class_menu->reorder_submenu($id_array, $menu);
	if($function_reorder_submenu == true) 
		echo 'true';
	else 
		echo 'false';
?>