<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_blog_comment = new Blog_Comment($pdo);
    $action         = $_POST['action'];
    $comment_id     = $_POST['comment_id'];
    $admin_login_id = $_SESSION['cr_adminID'];

    if($action == 'approve') {
	    $function_approve_comment = $class_blog_comment->approve_comment($comment_id);
	    if($function_approve_comment == true) 
		    echo 'true';
		else 
		  	echo 'false';
	}
	elseif($action == 'unapprove') {
	    $function_unapprove_comment = $class_blog_comment->unapprove_comment($comment_id);
	    if($function_unapprove_comment == true) 
		    echo 'true';
		else 
		  	echo 'false';
	}
?>