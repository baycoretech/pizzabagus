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
    public function update_commerce_settings($value, $setting_name, $admin_login_id, $setting_idh, $now_date) {
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingID = ?");   
        $result->bindParam(1, $value);
        $result->bindParam(2, $setting_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Setting Value', ?, ?, ?)");
            $history_detail = " edit ".strtolower($settingname)." setting value to ".$value.".";
            $get_history->bindParam(1, $history_detail);
            $get_history->bindParam(2, $now_date);
            $get_history->bindParam(3, $admin_login_id);
            $get_history->execute();
            return true;
        }
        else {
            return false;
        }
    }
}
?>