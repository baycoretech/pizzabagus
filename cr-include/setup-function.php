<?php
function get_started_subfolder() {
	$server_name  = "$_SERVER[SERVER_NAME]";
	if($server_name == 'localhost') {
		$explode_url  = explode('/', $_SERVER['REQUEST_URI']);
    	$subfolder    = $explode_url[1];
		return "http://$_SERVER[SERVER_NAME]".'/'.$subfolder;
	}
	else {
		if(dirname($_SERVER['PHP_SELF']) == '/') {
			return "http://$_SERVER[SERVER_NAME]";
        }
        else {
        	$subfolder = str_replace("/", "", dirname($_SERVER['PHP_SELF']));
			return "http://$_SERVER[SERVER_NAME]".'/'.$subfolder;
        }
	}
}
function script_namespace() {
	$server_name  = "$_SERVER[SERVER_NAME]";
	if($server_name == 'localhost') {
		$explode_url  = explode('/', $_SERVER['REQUEST_URI']);
    	$subfolder    = $explode_url[1];
		return "http://$_SERVER[SERVER_NAME]".'/'.$subfolder;
	}
	else {
		if(dirname($_SERVER['PHP_SELF']) == '/') {
			return "http://$_SERVER[SERVER_NAME]";
        }
        else {
        	$subfolder = str_replace("/", "", dirname($_SERVER['PHP_SELF']));
			return "http://$_SERVER[SERVER_NAME]".'/'.$subfolder;
        }
	}
}
function generate_hash($password) {
	if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
		$salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
		return crypt($password, $salt);
	}
}
?>