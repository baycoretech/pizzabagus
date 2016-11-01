<?php
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_menu      = new Menu($pdo);
	$id_array	     = explode(",",$_POST['ids']);
	$function_reorder_menu = $class_menu->reorder_menu($id_array);
	if($function_reorder_menu == true) 
		echo 'true';
	else 
		echo 'false';
?>