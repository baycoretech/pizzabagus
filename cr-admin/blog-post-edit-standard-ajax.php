<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 

	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//global function

	$o_getBlog       = new blog($pdo);
    $title           = $_POST['title'];
    $content         = $_POST['editorpost'];
    $blogtype        = $_POST['blogtype'];
    $tags            = implode(', ', $_POST['tags']);
    $noimplodetags   = $_POST['tags'];
    $comment         = $_POST['comment'];
    $metakey         = $_POST['metakey'];
    $metadesc        = $_POST['metadesc'];
    $cat             = $_POST['cat'];
    $status          = $_POST['status'];
    $blogIDh         = $_POST['blogIDh'];
    $adminLoginID    = $_POST['adminLoginID'];

    if(strlen($title)<4) {
		echo "title-short";
	}
	elseif(strlen($title)>200) {
		echo "title-long";
	}
	elseif(empty($cat)) {
		echo "cat-empty";
	}
	elseif(empty($content)) {
		echo "content-empty";
	}
	elseif(strlen($metakey)>255) {
		echo "metakey-long";
 	}
	elseif(strlen($metadesc)>155) {
		echo "metadesc-long";
	}
	else {
		$v_checkBlogTitle = $o_getBlog->checkBlogNameEdit($blogIDh, $title);
		if($v_checkBlogTitle==0) {
    		$v_getUpdateStandardPost = $o_getBlog->updateBlogStandard($title, $content, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blogIDh, $adminLoginID);
    		echo "success";
    	}
    	else {
    		echo "same-title";
    	}
    }
?>