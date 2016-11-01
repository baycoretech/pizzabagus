<?php
/**
 * Class Bank Account
 *
 * @author baycore
 */

class Bank_Account {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_bank_account() {
    	$result = $this->pdo->query("SELECT * FROM cr_banks ORDER BY cr_banksID desc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function add_bank_account($name, $number, $owner, $image, $admin_login_id, $now_date) {
	    $result = $this->pdo->prepare("INSERT INTO cr_banks(
			    		cr_banksName, cr_banksNumber, cr_banksOwner, cr_banksImage) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $name);
		$result->bindParam(2, $number);
		$result->bindParam(3, $owner);
		$result->bindParam(4, $image);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Bank Account', ?, ?, ?)");

			$history_detail = " add $name - $number($owner) to bank account.";
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
    public function edit_bank_account($bank_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_banks WHERE cr_banksID = '$bank_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
     public function update_bank_account($name, $number, $owner, $image, $admin_login_id, $now_date, $bank_idh) {
		$result = $this->pdo->prepare("UPDATE cr_banks SET 
	    		cr_banksName        = ?, 
	    		cr_banksNumber      = ?, 
	    		cr_banksOwner       = ?,  
	    		cr_banksImage       = ?
	    		WHERE cr_banksID    = ?");	
	    $result->bindParam(1, $name);
		$result->bindParam(2, $number);
		$result->bindParam(3, $owner);
		$result->bindParam(4, $image);
		$result->bindParam(5, $bank_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
		    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Bank Account', ?, ?, ?)");
			$history_detail = " edit $name - $number($owner) in bank account.";
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
    public function delete_bank_account($bank_id, $admin_login_id, $now_date) {
    	$check_query = $this->pdo->query("SELECT * FROM cr_banks WHERE cr_banksID = '$bank_id'");
    	$check_fetch = $check_query->fetch(PDO::FETCH_OBJ);
    	$bank_name   = $check_fetch->cr_banksName;
    	$bank_number = $check_fetch->cr_banksNumber;
    	$bank_owner  = $check_fetch->cr_banksOwner;
    	$result = $this->pdo->prepare("DELETE FROM cr_banks WHERE cr_banksID = ?");
    	$result->bindParam(1, $bank_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Bank Account', ?, ?, ?)");
			$history_detail = " delete $bank_name - $bank_number($bank_owner) in bank account.";
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