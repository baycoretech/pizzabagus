<?php
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data

	$cradminID_session = $_GET['admin'];

	$o_getMail        = new mail($pdo);
    $v_getTotalUnread = $o_getMail->countInboxUnread($cradminID_session);

    if($v_getTotalUnread==0) {
   		echo "Inbox";
    }
    else {
    	echo 'Inbox <span class="badge badge-danger pull-right">'.$v_getTotalUnread.'</span>';
    }

?>