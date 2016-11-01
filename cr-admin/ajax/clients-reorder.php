<?php
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_clients   = new Clients($pdo);
	$id_array	     = explode(",",$_POST['ids']);
	$function_reorder_clients = $class_clients->reorder_clients($id_array);
	if($function_reorder_clients == true) 
		echo 'true';
	else 
		echo 'false';
?>