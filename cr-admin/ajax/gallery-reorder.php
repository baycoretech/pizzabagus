<?php
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_gallery = new Gallery($pdo);
	$id_array	= explode(",",$_POST['ids']);
	$function_reorder_gallery = $class_gallery->reorder_gallery($id_array);
	if($function_reorder_gallery == true) 
		echo 'true';
	else 
		echo 'false';
?>