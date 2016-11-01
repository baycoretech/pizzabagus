<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $admin_login_id = $_SESSION['cr_adminID'];

    $class_mail     = new Mail($pdo);
    $function_count_inbox_unread = $class_mail->count_inbox_unread($admin_login_id);

    $class_message  = new Message($pdo);
    $function_count_message_unread = $class_message->count_inbox_unread();

    echo '<i class="material-icons">inbox</i>';
	$total = $function_count_inbox_unread + $function_count_message_unread;
	if($total != 0) {
		echo '<span id="totalnotif1" class="label label-notification">'.$total.'</span>';
	}
?>