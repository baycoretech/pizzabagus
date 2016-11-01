<?php
	require_once "include/database.php";//database
    require_once "include/class-db.php";//cek database
    require_once "include/class-login.php";//cek database
    require_once "include/class-data.php";//class data
	session_start();

	$o_getDatabase = new getDatabase($pdo);
    $v_getDatabase = $o_getDatabase->getdb();

    $crusername   = $_POST['crusername'];
    $crpassword   = $_POST['crpassword'];

    $o_adminLogin = new adminLogin($pdo);
    $v_adminLogin = $o_adminLogin->loginAdmin($crusername);
    $user_password = $v_adminLogin['cr_adminPassword'];

    $check_password = crypt($crpassword, $user_password) == $user_password;
    if($check_password == true && $v_adminLogin == true) {
		$_SESSION['cr_adminID']       = $v_adminLogin['cr_adminID'];
		$_SESSION['cr_adminPassword'] = $v_adminLogin['cr_adminPassword']; 
        $o_getUser         = new user($pdo);
        $v_setLastlogin    = $o_getUser->setLastlogin($_SESSION['cr_adminID']);
        if(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/setup-page.php')) {  
            unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/setup-page.php');
        }
		echo "true";
	}
	else {
		echo "false";
	}
    
?>