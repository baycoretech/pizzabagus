<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getBlog       = new blog($pdo);
    $from            = $_POST['from'];
    $quotetext       = $_POST['quotetext'];
    $blogtype        = $_POST['blogtype'];
    $tags            = implode(', ', $_POST['tags']);
    $noimplodetags   = $_POST['tags'];
    $cat             = $_POST['cat'];
    $status          = $_POST['status'];
    $blogIDh         = $_POST['blogIDh'];
    $adminLoginID    = $_POST['adminLoginID'];

    if(strlen($from)<2) {
		echo "quote-short";
	}
	elseif(strlen($from)>200) {
		echo "quote-long";
	}
	elseif(strlen($quotetext)<1) {
		echo "text-short";
	}
	elseif(empty($cat)) {
		echo "cat-empty";
	}
	else {
    	$v_getUpdateQuotePost = $o_getBlog->updateBlogQuote($from, $quotetext, $blogtype, $tags, $noimplodetags, $cat, $status, $blogIDh, $adminLoginID);
    	echo "success";
    }
?>