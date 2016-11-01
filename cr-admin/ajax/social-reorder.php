<?php
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$class_social      = new Social($pdo);
	$id_array	       = explode(",",$_POST['ids']);
	$function_reorder_social = $class_social->reorder_social($id_array);
	if($function_reorder_social == true) 
		echo 'true';
	else 
		echo 'false';
?>