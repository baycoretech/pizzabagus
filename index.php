<?php
    require __DIR__.'/cr-include/error-report.php';
    require __DIR__.'/cr-include/autoloader.php'; 
    require __DIR__.'/cr-include/setup-function.php'; 
    require __DIR__.'/cr-include/altorouter.php';

    ob_start();
    session_start();

    $host         = "$_SERVER[HTTP_HOST]";
    $explode_url  = explode('/', $_SERVER[REQUEST_URI]);
    $router       = new AltoRouter();
    // Online Upload with subfolder
    // if($host == 'localhost' || $host == getHostByName(getHostName()) || isset($explode_url[1])) {
    // Online without subfolder or offline (localhost)
    // if($host == 'localhost' || $host == getHostByName(getHostName())) {
    if($host == 'localhost' || $host == getHostByName(getHostName())) {
        $router->setBasePath('/'.$explode_url[1]);
    }
    require __DIR__.'/cr-include/routes.php';
    $match = $router->match();
    if( $match && is_callable( $match['target'] ) ) {
        call_user_func_array( $match['target'], $match['params'] ); 
    } else {
        // no route was matched
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    }
    ob_end_flush();
?>
