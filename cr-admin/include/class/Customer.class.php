<?php
/**
 * Class Customer
 *
 * @author baycore
 */

class Customer {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function count_customer() {
    	$result = $this->pdo->query("SELECT * FROM cr_customer ORDER BY cr_customerID asc");
    	$total  = $result->rowCount();
    	return $total;
    }
    public function view_customer() {
    	$result = $this->pdo->query("SELECT * FROM cr_customer ORDER BY cr_customerID asc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function edit_customer($customer_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_customer WHERE cr_customerID = '$customer_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function modified_customer_by_admin($admin_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows->cr_adminDisplayName;
    }
    public function modified_customer_by_customer($customer_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_customer WHERE cr_customerID = '$customer_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows->cr_customerDisplayname;
    }
    public function update_customer($username, $email, $password, $displayname, $hotelvilla, $title, $firstname, $middlename, $lastname, $address1, $address2, $city, $detail, $phone, $status, $modifiedby, $number, $customer_id, $admin_login_id, $now_date) {
    	$password_customer = hash_password($password);
    	if(empty($password)) {
    		$result = $this->pdo->prepare("UPDATE cr_customer SET 
		    		cr_customerUsername    = ?, 
		    		cr_customerEmail       = ?,
		    		cr_customerDisplayName = ?,
		    		cr_customerHotelvilla  = ?,
		    		cr_customerTitle       = ?,
		    		cr_customerFirstname   = ?,
		    		cr_customerMiddlename  = ?,
		    		cr_customerLastname    = ?,  
		    		cr_customerAddress1    = ?,  
		    		cr_customerAddress2    = ?,  
		    		cr_customerCity        = ?,  
		    		cr_customerDetail      = ?,  
		    		cr_customerPhone       = ?,  
		    		cr_customerStatus      = ?,  
		    		cr_customerModified    = ?,  
		    		cr_customerModifiedby  = ?,  
		    		cr_customerNumber      = ?  
		    		WHERE cr_customerID    = ?");	
		    $result->bindParam(1, $username);
			$result->bindParam(2, $email);
			$result->bindParam(3, $displayname);
			$result->bindParam(4, $hotelvilla);
			$result->bindParam(5, $title);
			$result->bindParam(6, $firstname);
			$result->bindParam(7, $middlename);
			$result->bindParam(8, $lastname);
			$result->bindParam(9, $address1);
			$result->bindParam(10, $address2);
			$result->bindParam(11, $city);
			$result->bindParam(12, $detail);
			$result->bindParam(13, $phone);
			$result->bindParam(14, $status);
			$result->bindParam(15, $now_date);
			$result->bindParam(16, $modifiedby);
			$result->bindParam(17, $number);
			$result->bindParam(18, $customer_id);
			if($result->execute()) {
				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
		    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
				$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
    	else {
		    $result = $this->pdo->prepare("UPDATE cr_customer SET 
		    		cr_customerUsername    = ?, 
		    		cr_customerPassword    = ?, 
		    		cr_customerEmail       = ?,
		    		cr_customerDisplayName = ?,
		    		cr_customerHotelvilla  = ?,
		    		cr_customerTitle       = ?,
		    		cr_customerFirstname   = ?,
		    		cr_customerMiddlename  = ?,
		    		cr_customerLastname    = ?,  
		    		cr_customerAddress1    = ?,  
		    		cr_customerAddress2    = ?,  
		    		cr_customerCity        = ?,  
		    		cr_customerDetail      = ?,  
		    		cr_customerPhone       = ?,  
		    		cr_customerStatus      = ?,  
		    		cr_customerModified    = ?,  
		    		cr_customerModifiedby  = ?,  
		    		cr_customerModified    = ?  
		    		WHERE cr_customerID = ?");	
		    $result->bindParam(1, $username);
		    $result->bindParam(2, $password);
			$result->bindParam(3, $email);
			$result->bindParam(4, $displayname);
			$result->bindParam(5, $hotelvilla);
			$result->bindParam(6, $title);
			$result->bindParam(7, $firstname);
			$result->bindParam(8, $middlename);
			$result->bindParam(9, $lastname);
			$result->bindParam(10, $address1);
			$result->bindParam(11, $address2);
			$result->bindParam(12, $city);
			$result->bindParam(13, $detail);
			$result->bindParam(14, $phone);
			$result->bindParam(15, $status);
			$result->bindParam(16, $now_date);
			$result->bindParam(17, $modifiedby);
			$result->bindParam(18, $number);
			$result->bindParam(19, $customer_id);
			if($result->execute()) {
				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
		    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Administrator', ?, ?, ?)");
				$history_detail = " edit ".ucwords($displayname)."'s profile data.";
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
    public function delete_customer($customer_id, $admin_login_id, $now_date) {
    	$check   = $this->pdo->query("SELECT * FROM cr_customer WHERE cr_customerID = '$customer_id'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$name    = $check_f->cr_customerDisplayname;
    	$result  = $this->pdo->prepare("DELETE FROM cr_customer WHERE cr_customerID = ?");
    	$result->bindParam(1, $customer_id);
    	if($result->execute()) {
    		$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Customer', ?, ?, ?)");
			$history_detail = " delete ".ucwords($name)." from customers data.";
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