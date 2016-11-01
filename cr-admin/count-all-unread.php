<?php
	ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data

	$cradminID_session = $_GET['admin'];

	$o_getMail        = new mail($pdo);
    $v_getTotalUnread = $o_getMail->countInboxUnread($cradminID_session);

    $o_getMessage     = new message($pdo);
    $v_countMessage   = $o_getMessage->countInboxUnread();


	echo '<i class="material-icons">inbox</i>';
	$total = $v_countMessage+$v_getTotalUnread;
	if($total!=0) {
		echo '<span id="totalnotif1" class="label label-notification">'.$total.'</span>';
	}

?>