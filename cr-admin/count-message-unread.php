<?php
    ini_set('display_errors', 0);
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data

	$o_getMessage     = new message($pdo);
    $v_countMessage   = $o_getMessage->countInboxUnread();

    if($v_countMessage==0) {
   		echo "Message";
    }
    else {
    	echo 'Message <span class="badge badge-danger pull-right">'.$v_countMessage.'</span>';
    }

?>