<?php
/**
 * Class Contact Header
 *
 * @author baycore
 */

class Contact_Header {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_contact_header() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'contactheader'");
    	$row    = $result->fetch(PDO::FETCH_OBJ);
	    return $row;
    }
    public function update_contact_header($value, $admin_login_id, $setting_idh, $now_date) {
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue      = ? 
	    		WHERE cr_settingID   = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $setting_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Contact Header', ?, ?, ?)");
			$history_detail = " edit contact header data.";
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