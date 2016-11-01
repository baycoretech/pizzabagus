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
    public function customer_data($cr_customerID_session) {
     	$result = $this->pdo->prepare("SELECT * FROM cr_customer WHERE cr_customerID = ?");
	    $result->bindParam(1, $cr_customerID_session);
	    $result->execute();
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
	}
	public function set_last_login($customer_id, $now_date) {
    	$result = $this->pdo->prepare("UPDATE cr_customer SET 
		    		cr_customerLastlogin = ?  
		    		WHERE cr_customerID  = ?");
		$result->bindParam(1, $now_date);
		$result->bindParam(2, $customer_id);
		$result->execute();
    }
    public function login_customer($customer_username) {
        $status = '1';
     	$result = $this->pdo->prepare("SELECT * FROM cr_customer WHERE cr_customerUsername = ? AND cr_customerStatus = ?");
        $result->bindParam(1, $customer_username);
	    $result->bindParam(2, $status);
	    if($result->execute()) {
    	    $rows = $result->fetch(PDO::FETCH_OBJ);
    	    return $rows;
        }
        else {
            return false;
        }
	}
    public function check_customer_username($username, $email) {
     	$result = $this->pdo->prepare("SELECT * FROM cr_customer WHERE cr_customerUsername = ? OR cr_customerEmail = ?");
	    $result->bindParam(1, $username);
	    $result->bindParam(2, $email);
	    $result->execute();
	    $total = $result->rowCount();
	    if($total > 0) {
	    	return false;
	    }
	    else {
	    	return true;
		}
	}
    public function add_customer($displayname, $email, $username, $password, $hotelvilla, $title, $firstname, $middlename, $lastname, $address1, $address2, $city, $detail, $phone, $now_date) {
    	$status = 1;
    	$hash_password = hash_password($password);
        $result = $this->pdo->prepare("INSERT INTO cr_customer(
                        cr_customerDisplayname, cr_customerEmail, cr_customerUsername, cr_customerPassword, cr_customerHotelvilla, cr_customerTitle, cr_customerFirstname, cr_customerMiddlename, cr_customerLastname, cr_customerAddress1, cr_customerAddress2, cr_customerCity, cr_customerDetail, cr_customerPhone, cr_customerStatus, cr_customerRegistered) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $result->bindParam(1, ucwords($displayname));
        $result->bindParam(2, $email);
        $result->bindParam(3, $username);
        $result->bindParam(4, $hash_password);
        $result->bindParam(5, $hotelvilla);
        $result->bindParam(6, $title);
        $result->bindParam(7, ucwords($firstname));
        $result->bindParam(8, ucwords($middlename));
        $result->bindParam(9, ucwords($lastname));
        $result->bindParam(10, $address1);
        $result->bindParam(11, $address2);
        $result->bindParam(12, $city);
        $result->bindParam(13, $detail);
        $result->bindParam(14, $phone);
        $result->bindParam(15, $status);
        $result->bindParam(16, $now_date);
        if($result->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
    public function check_update_customer_username($username, $email, $customer_id) {
        $result = $this->pdo->prepare("SELECT * FROM cr_customer WHERE (cr_customerUsername = ? OR cr_customerEmail = ?) AND cr_customerID <> ?");
        $result->bindParam(1, $username);
        $result->bindParam(2, $email);
        $result->bindParam(3, $customer_id);
        $result->execute();
        $total = $result->rowCount();
        if($total > 0) {
            return false;
        }
        else {
            return true;
        }
    }
    public function update_customer($displayname, $email, $username, $password, $hotelvilla, $title, $firstname, $middlename, $lastname, $address1, $address2, $city, $detail, $customer_id, $now_date) {
        $status = 1;
        $hash_password = hash_password($password);
        $logout = 'logout';
        $modifiedby = 'customer,'.$customer_id;
        if(empty($password)) {
            $result = $this->pdo->prepare("UPDATE cr_customer SET 
                cr_customerDisplayname  = ?,
                cr_customerEmail        = ?, 
                cr_customerUsername     = ?,
                cr_customerHotelvilla   = ?, 
                cr_customerTitle        = ?, 
                cr_customerFirstname    = ?, 
                cr_customerMiddlename   = ?, 
                cr_customerLastname     = ?, 
                cr_customerAddress1     = ?, 
                cr_customerAddress2     = ?, 
                cr_customerCity         = ?, 
                cr_customerDetail       = ?, 
                cr_customerModified     = ?, 
                cr_customerModifiedby   = ? 
                WHERE cr_customerID     = ?");
            $result->bindParam(1, $displayname);
            $result->bindParam(2, $email);
            $result->bindParam(3, $username);
            $result->bindParam(4, $hotelvilla);
            $result->bindParam(5, $title);
            $result->bindParam(6, $firstname);
            $result->bindParam(7, $middlename);
            $result->bindParam(8, $lastname);
            $result->bindParam(9, $address1);
            $result->bindParam(10, $address2);
            $result->bindParam(11, $city);
            $result->bindParam(12, $detail);
            $result->bindParam(13, $now_date);
            $result->bindParam(14, $modifiedby);
            $result->bindParam(15, $customer_id);
            if($result->execute()) {
                return 'success';
            }
            else {
                return false;
            }
        }
        else {
            $result = $this->pdo->prepare("UPDATE cr_customer SET 
                cr_customerDisplayname  = ?,
                cr_customerEmail        = ?, 
                cr_customerUsername     = ?,
                cr_customerPassword     = ?,
                cr_customerHotelvilla   = ?, 
                cr_customerTitle        = ?, 
                cr_customerFirstname    = ?, 
                cr_customerMiddlename   = ?, 
                cr_customerLastname     = ?, 
                cr_customerAddress1     = ?, 
                cr_customerAddress2     = ?, 
                cr_customerCity         = ?, 
                cr_customerDetail       = ?, 
                cr_customerModified     = ?, 
                cr_customerModifiedby   = ? 
                WHERE cr_customerID     = ?");
            $result->bindParam(1, $displayname);
            $result->bindParam(2, $email);
            $result->bindParam(3, $username);
            $result->bindParam(4, $hash_password);
            $result->bindParam(5, $hotelvilla);
            $result->bindParam(6, $title);
            $result->bindParam(7, $firstname);
            $result->bindParam(8, $middlename);
            $result->bindParam(9, $lastname);
            $result->bindParam(10, $address1);
            $result->bindParam(11, $address2);
            $result->bindParam(12, $city);
            $result->bindParam(13, $detail);
            $result->bindParam(14, $now_date);
            $result->bindParam(15, $modifiedby);
            $result->bindParam(16, $customer_id);
            if($result->execute()) {
                return $logout;
            }
            else {
                return false;
            }
        }   
    }
}
?>