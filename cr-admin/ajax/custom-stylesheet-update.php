<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';

 	$target = $_POST['target'];
 	$line   = $_POST['line'];

    if(!file_exists($target)){
        echo 'false';
    }
    else {
	    $file = fopen($target,"w+");
        while(!feof($file)){
            $old = $old . fgets($file);
        }
        file_put_contents($target, $old . $line);
        fclose($file);
	    echo 'true';
	}
?>
