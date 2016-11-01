<?php
/**
 * Class Commerce Settings
 *
 * @author baycore
 */

class Commerce_Settings {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_settings_payment_information() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'paymentinformation'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_payment_information_id() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'paymentinformation_id'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_term_of_service() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'termofservice'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_term_of_service_id() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'termofservice_id'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_custom_homepage_content() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'customhomecontent'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_custom_homepage_content_id() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'customhomecontent_id'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}
?>