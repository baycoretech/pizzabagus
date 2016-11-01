<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_social    = new Social($pdo);
    if(empty($_POST['facebook'])) 
    	$facebook = NULL;
    else 
    	$facebook = $_POST['facebook'];

    if(empty($_POST['twitter'])) 
    	$twitter = NULL;
    else 
    	$twitter = $_POST['twitter'];

    if(empty($_POST['instagram'])) 
    	$instagram = NULL;
    else 
    	$instagram = $_POST['instagram'];

    if(empty($_POST['tumblr'])) 
    	$tumblr = NULL;
    else 
    	$tumblr = $_POST['tumblr'];

    if(empty($_POST['pinterest'])) 
    	$pinterest = NULL;
    else 
    	$pinterest = $_POST['pinterest'];

    if(empty($_POST['youtube'])) 
    	$youtube = NULL;
    else 
    	$youtube = $_POST['youtube'];

    if(empty($_POST['behance'])) 
    	$behance = NULL;
    else 
    	$behance = $_POST['behance'];

    if(empty($_POST['dribbble'])) 
    	$dribbble = NULL;
    else 
    	$dribbble = $_POST['dribbble'];

    if(empty($_POST['github'])) 
    	$github = NULL;
    else 
    	$github = $_POST['github'];

    if(empty($_POST['soundcloud'])) 
    	$soundcloud = NULL;
    else 
    	$soundcloud = $_POST['soundcloud'];

    if(empty($_POST['skype'])) 
    	$skype = NULL;
    else 
    	$skype = $_POST['skype'];

    if(empty($_POST['google-plus'])) 
    	$googleplus = NULL;
    else 
    	$googleplus = $_POST['google-plus'];

    $function_update_social_link = $class_social->update_social_link($facebook, $twitter, $instagram, $tumblr, $pinterest, $youtube, $behance, $dribbble, $github, $soundcloud, $skype, $googleplus);
    if($function_update_social_link == true) 
    	echo 'true';
    else 
    	echo 'false';
?>