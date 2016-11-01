<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_message = new Message($pdo);
    $function_count_inbox_unread = $class_message->count_inbox_unread();

    if($function_count_inbox_unread == 0) {
   		echo "Message";
    }
    else {
    	echo 'Message <span class="badge badge-danger pull-right">'.$function_count_inbox_unread.'</span>';
    }

?>