<?php
/**
 * Class Contact
 *
 * @author baycore
 */

class Contact {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_contact($link) {
    	$result = $this->pdo->query("SELECT * FROM cr_contact WHERE cr_contactLink = '$link' LIMIT 1");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		    $row = $result->fetch(PDO::FETCH_OBJ);
			return $row;
		}
    }
    public function add_contact($desc, $desc_id, $social, $customheader, $customheader_id, $customdesc, $customdesc_id, $link, $admin_login_id, $now_date) {
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $row->cr_submenuTitle;
    	}
    	else {
	    	$row = $check->fetch(PDO::FETCH_OBJ);
		    $pagename = $row->cr_menuTitle;
    	} 

	    $result = $this->pdo->prepare("INSERT INTO cr_contact(
			    		cr_contactCustomheader, cr_contactCustomDesc, cr_contactDesc, cr_contactSocial, cr_contactLink, cr_adminID, cr_contactCustomheader_id, cr_contactCustomDesc_id, cr_contactDesc_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $customheader);
		$result->bindParam(2, $customdesc);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $social);
		$result->bindParam(5, $link);
		$result->bindParam(6, $admin_login_id);
		$result->bindParam(7, $customheader_id);
		$result->bindParam(8, $customdesc_id);
		$result->bindParam(9, $desc_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Contact Information', ?, ?, ?)");
			$history_detail = " add contact information in page ".$pagename.".";
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
    public function edit_contact($contact_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_contact WHERE cr_contactID = '$contact_id'");
		$row    = $result->fetch(PDO::FETCH_OBJ);
		return $row;
    }
    public function update_contact($desc, $desc_id, $social, $customheader, $customheader_id, $customdesc, $customdesc_id, $link, $contact_idh, $admin_login_id, $now_date) {
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $row->cr_submenuTitle;
    	}
    	else {
	    	$row = $check->fetch(PDO::FETCH_OBJ);
		    $pagename = $row->cr_menuTitle;
    	} 

	    $result = $this->pdo->prepare("UPDATE cr_contact SET 
	    		cr_contactCustomheader  = ?,
	    		cr_contactCustomDesc    = ?,
	    		cr_contactDesc          = ?,
	    		cr_contactSocial        = ?,
	    		cr_contactLink          = ?,
	    		cr_adminID              = ?,
	    		cr_contactCustomheader_id = ?,
	    		cr_contactCustomDesc_id   = ?,
	    		cr_contactDesc_id         = ?
	    		WHERE cr_contactID = ?");	
	    $result->bindParam(1, $customheader);
		$result->bindParam(2, $customdesc);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $social);
		$result->bindParam(5, $link);
		$result->bindParam(6, $admin_login_id);
		$result->bindParam(7, $customheader_id);
		$result->bindParam(8, $customdesc_id);
		$result->bindParam(9, $desc_id);
		$result->bindParam(10, $contact_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Contact Information', ?, ?, ?)");
			$history_detail = " edit contact information in page ".$pagename.".";
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
   	public function delete_contact($contact_id, $link, $admin_login_id, $now_date) {
   		$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $row->cr_submenuTitle;
    	}
    	else {
	    	$row = $check->fetch(PDO::FETCH_OBJ);
		    $pagename = $row->cr_menuTitle;
    	} 

    	$result = $this->pdo->prepare("DELETE FROM cr_contact WHERE cr_contactID = ?");
    	$result->bindParam(1, $contact_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Contact Information', ?, ?, ?)");
			$history_detail = " delete contact information in page ".$pagename.".";
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