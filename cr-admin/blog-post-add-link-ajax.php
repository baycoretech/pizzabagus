<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getBlog       = new blog($pdo);
    $title           = $_POST['title'];
    $link            = $_POST['link'];
    $blogtype        = $_POST['blogtype'];
    $tags            = implode(', ', $_POST['tags']);
    $noimplodetags   = $_POST['tags'];
    $cat             = $_POST['cat'];
    $status          = $_POST['status'];
    $adminLoginID    = $_POST['adminLoginID'];

    if(strlen($title)<2) {
		echo "title-short";
	}
	elseif(strlen($title)>200) {
		echo "title-long";
	}
	elseif(strlen($link)<1) {
		echo "link-short";
	}
	elseif(strlen($link)>500) {
		echo "link-long";
	}
	elseif(filter_var($link, FILTER_VALIDATE_URL) === false) {
		echo "invalid-url";
	}
	elseif(empty($cat)) {
		echo "cat-empty";
	}
	else {
    	$v_getAddLinkPost = $o_getBlog->addBlogLink($title, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $adminLoginID);
    	echo "success";
    }
?>