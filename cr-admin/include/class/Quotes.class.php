<?php
/**
 * Class Quotes
 *
 * @author baycore
 */

class Quotes {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function count_quotes() {
    	$check = $this->pdo->query("SELECT * FROM cr_quotes ORDER BY cr_quotesID desc");
    	$total = $check->rowCount(); 
    	return $total;
    }
    public function view_quotes() {
    	$cek = $this->pdo->query("SELECT * FROM cr_quotes ORDER BY cr_quotesID desc");
    	if($cek->rowCount()<1) {
    		return false;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function add_quotes($name, $text, $status, $photo, $admin_login_id, $now_date) {
    	$result = $this->pdo->prepare("INSERT INTO cr_quotes(
			    		cr_quotesName, cr_quotesPhoto, cr_quotesText, cr_quotesStatus) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $name);
		$result->bindParam(2, $photo);
		$result->bindParam(3, $text);
		$result->bindParam(4, $status);
		if($result->execute()) {
			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Quote', ?, ?, ?)");
			$historyDetail = " add new quote from .".ucwords($name)."(".ucfirst($status).").";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $now_date);
			$getHistory->bindParam(3, $admin_login_id);
			$getHistory->execute();
			return true;
		}
		else {
			return false;
		}
    }
    public function update_quotes($name, $text, $status, $photo, $quotes_idh, $admin_login_id, $now_date) {
	    $result = $this->pdo->prepare("UPDATE cr_quotes SET 
	    		cr_quotesName     = ?,
	    		cr_quotesPhoto    = ?,
	    		cr_quotesText     = ?,
	    		cr_quotesStatus   = ?
	    		WHERE cr_quotesID = ?");	
	    $result->bindParam(1, $name);
		$result->bindParam(2, $photo);
		$result->bindParam(3, $text);
		$result->bindParam(4, $status);
		$result->bindParam(5, $quotes_idh);
		if($result->execute()) {
			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Quote', ?, ?, ?)");
			$historyDetail = " edit quote from .".ucwords($name)."(".ucfirst($status).").";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $now_date);
			$getHistory->bindParam(3, $admin_login_id);
			$getHistory->execute();
			return true;
		}
		else {
			return false;
		}
    }
    public function delete_quotes($quotes_id, $admin_login_id, $now_date) {
    	$check = $this->pdo->query("SELECT * FROM cr_quotes WHERE cr_quotesID = '$quotes_id'");
    	$row   = $check->fetch(PDO::FETCH_OBJ);
    	$name  = $row->cr_quotesName;

    	$result = $this->pdo->prepare("DELETE FROM cr_quotes WHERE cr_quotesID = ?");
    	$result->bindParam(1, $quotes_id);
    	if($result->execute()) {
	    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Quotes', ?, ?, ?)");
			$historyDetail = " delete quote from .".ucwords($name).".";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $now_date);
			$getHistory->bindParam(3, $admin_login_id);
			$getHistory->execute();
			return true;
		}
		else {
			return false;
		}
    }
    public function view_page_for_quotes_menu() {
    	$check = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option <> 'customlink' AND cr_menuHasSub = '0' ORDER BY cr_menuOrder asc");
    	if($check->rowCount() < 1) {
    		return false;
    	}
    	else {
	    	while($rows = $check->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function view_page_for_quotes_submenu() {
    	$check = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option <> 'customlink' ORDER BY cr_submenuID asc");
    	if($check->rowCount() < 1) {
    		return false;
    	}
    	else {
	    	while($rows = $check->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function view_quotes_in_page_id() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'quotesinpage'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_settingID;
    }
    public function view_quotes_in_page() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'quotesinpage'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_settingValue;
    }
}
?>