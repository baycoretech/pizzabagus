<?php
/**
 * Class General Setting
 *
 * @author baycore
 */

class General_Setting {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function get_url() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'siteURL'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function site_url() {
     	$get_site_url_query = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'siteurl'");
	    $get_site_url_query->execute();
	    $get_site_url_fetch = $get_site_url_query->fetch(PDO::FETCH_OBJ);
	    $get_site_url       = $get_site_url_fetch->cr_settingValue . $_SERVER['SERVER_NAME'];
	    return $get_site_url;
	}
    public function get_folder_name() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function folder_name() {
     	$get_folder_name_query = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
	    $get_folder_name_query->execute();
	    $get_folder_name_fetch = $get_folder_name_query->fetch(PDO::FETCH_OBJ);
	    $get_folder_name       = $get_folder_name_fetch->cr_settingValue;
	    if($get_folder_name == "") {
	    	$call = "0";
	    	return $call;
	    }
	    else {
	    	return $get_folder_name;
	    }
	}
    public function set_timezone() {
	    $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'timezone'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
	}
	public function get_coming_soon() {
	    $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'comingsoon'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows->cr_settingValue;
	}
	public function save_visitor($visitor_ip, $visitor_browser, $visitor_platform, $now_date) {
        $check_ip  = $this->pdo->query("SELECT * FROM cr_visitor WHERE cr_visitorIP = '$visitor_ip'");
        $insert_ip = $this->pdo->prepare("INSERT INTO cr_visitor (cr_visitorIP, cr_visitorBrowser, cr_visitorPlatform, cr_visitorDate) VALUES(?, ?, ?, ?)");
        $insert_ip->bindParam(1, $visitor_ip);
        $insert_ip->bindParam(2, $visitor_browser);
        $insert_ip->bindParam(3, $visitor_platform);
        $insert_ip->bindParam(4, $now_date);
        if($check_ip->rowCount() == 0) {
            $insert_ip->execute();
        }
    }
}
?>