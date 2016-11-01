<?php
    require __DIR__.'/error-report.php';
    require __DIR__.'/autoloader.php';

    if($_SERVER['SERVER_NAME'] == 'localhost') {
        $database_name     = $_POST['database_name'];
        $database_username = $_POST['database_username'];
        $database_password = $_POST['database_password'];

        if(empty($database_name) || empty($database_username)){
            echo 'empty-field';                           
        }
        else {
            $class_setup_page          = new Setup_Page($pdo);
            $function_collect_database = $class_setup_page->collect_database($database_name, $database_username, $database_password);
            if($function_collect_database == true) {
                echo 'success';
            }   
            else {
                echo 'failed';
            }
        }
    }
    else {
        $database_name     = $_POST['database_name'];
        $database_username = 'c'.substr(rand(1000,9999),rand(0,2),5);
        $database_password = 'cr_'.uniqid();

        if(empty($database_name)) {
            echo 'empty-field';                           
        }
        else {
            require __DIR__.'/xmlapi.php';

            $opts = [
                "user"   => "u3617261",      //+++ Replace UserUserName
                "pass"   => "HO8oP-GfJ_",      //+++ Replace UserPassword
                "dbpass" => $database_password,  //+++ Replace DatabasePassword
            ];

            $xmlapi = new xmlapi("creativabali.com");   
            $xmlapi->set_port( 2083 );   
            $xmlapi->password_auth($opts['user'],$opts['pass']);    
            $xmlapi->set_debug(1);//output actions in the error log 1 for true and 0 false 

            $cpaneluser=$opts['user'];
            $databasename = uniqid().$database_name;
            $databaseuser = $database_username;
            $databasepass = $opts['dbpass'];

            //create database    
            $createdb = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));   
            //create user 
            $usr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduser", array($databaseuser, $databasepass));   
            //add user 
            $addusr = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array("".$cpaneluser."_".$databasename."", "".$cpaneluser."_".$databaseuser."", 'all'));

            $class_setup_page          = new Setup_Page($pdo);
            $function_collect_database = $class_setup_page->collect_database('u3617261_'.$databasename, 'u3617261_'.$databaseuser, $databasepass);
            if($function_collect_database == true) {
                echo 'success';
            }   
            else {
                echo 'failed';
            }
        }
    }
?>