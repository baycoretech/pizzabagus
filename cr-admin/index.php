<?php
	session_start();
	require_once __DIR__.'/../cr-include/error-report.php';
	require_once __DIR__.'/include/database/connection.php';
    require_once __DIR__.'/include/autoloader.php';

    $class_get_database = new Get_Database($pdo);
    $function_get_db    = $class_get_database->get_db();

    //$dashboard_admin_url   = MADMINURL.'dashboard/';

    //Check if database is exist, redirect to index.php, if not, redirect to setup page
    if($function_get_db == '') {
    	$host = "$_SERVER[HTTP_HOST]";
        $explode_url  = explode('/', $_SERVER[REQUEST_URI]);
        if($host == 'localhost') {
            $redirect_url = "http://".$host.$_SERVER[REQUEST_URI]."setup/";
            header("location: $redirect_url"); 
        }
        else {
            if($explode_url[1] != '') {
                $redirect_url = "http://".$host.$_SERVER[REQUEST_URI]."setup/";
                header("location: $redirect_url"); 
            }
            else {
                $redirect_url = "http://".$host."/setup/";
                header("location: $redirect_url");
            }
        }
    }
    else {
		require_once __DIR__.'/../cr-include/altorouter.php';
		require_once __DIR__.'/include/global-function.php';
		$host         = "$_SERVER[HTTP_HOST]";
	    $explode_url  = explode('/', $_SERVER[REQUEST_URI]);
	    $router       = new AltoRouter();
        if($function_folder_name != false) {
            $router->setBasePath('/'.$function_folder_name);
        }
		require_once __DIR__.'/../cr-include/routes.php';
		$match = $router->match();
		if($match && is_callable($match['target'])) {
		    call_user_func_array($match['target'], $match['params']);
		} else {
		    //No route was matched
		    header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
		}
    }
?>