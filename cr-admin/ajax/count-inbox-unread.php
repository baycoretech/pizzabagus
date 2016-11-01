<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_mail = new Mail($pdo);
    $admin_login_id  = $_SESSION['cr_adminID'];

    $function_count_inbox_unread = $class_mail->count_inbox_unread($admin_login_id);

    if($function_count_inbox_unread == 0) {
   		echo "Inbox";
    }
    else {
    	echo 'Inbox <span class="badge badge-danger pull-right">'.$function_count_inbox_unread.'</span>';
    }

?>