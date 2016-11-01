<?php
/**
 * Class Clients
 *
 * @author baycore
 */

class Clients {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_clients() {
    	$result = $this->pdo->query("SELECT * FROM cr_clients ORDER BY cr_clientsOrder asc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function add_clients($name, $link, $photo, $admin_login_id, $now_date) {
    	$name_upper      = ucwords($name);
    	$check_last_id_q = $this->pdo->query("SELECT * FROM cr_clients");
    	$get_last_id_q   = $this->pdo->query("SELECT LAST_INSERT_ID() FROM cr_clients");
		$get_last_id_f   = $get_last_id_q->fetch(PDO::FETCH_OBJ);
		if($check_last_id_q->rowCount() < 1) {
			$get_last_id = 1;
		}
		else {
			$get_last_id   = $get_last_id_f->cr_clientsID + 1;
		}

	    $result = $this->pdo->prepare("INSERT INTO cr_clients(
			    		cr_clientsName, cr_clientsLink, cr_clientsImage, cr_clientsOrder) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $link);
		$result->bindParam(3, $photo);
		$result->bindParam(4, $get_last_id);
		if($result->execute()) {
			$result = $this->pdo->query("SET @lastID = LAST_INSERT_ID()");
			$result = $this->pdo->query("UPDATE cr_clients SET cr_clientsOrder = @lastID WHERE cr_clientsID = @lastID;");

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Client', ?, ?, ?)");
			
			$history_detail = " add ".$name_upper." as a new client.";
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
    public function edit_clients($client_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_clients WHERE cr_clientsID = '$client_id'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function update_clients($name, $link, $photo, $admin_login_id, $client_idh, $now_date) {
    	$name_upper   = ucwords($name);
	    $result = $this->pdo->prepare("UPDATE cr_clients SET 
	    		cr_clientsName      = ?, 
	    		cr_clientsLink      = ?, 
	    		cr_clientsImage     = ? 
	    		WHERE cr_clientsID  = ?");	
	    $result->bindParam(1, $name_upper);
		$result->bindParam(2, $link);
		$result->bindParam(3, $photo);
		$result->bindParam(4, $client_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Client', ?, ?, ?)");
			$history_detail = " edit ".$name_upper."'s client data.";
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
    public function delete_clients($client_id, $admin_login_id, $now_date) {
    	$check_q     = $this->pdo->query("SELECT * FROM cr_clients WHERE cr_clientsID = '$client_id'");
    	$check_f     = $check_q->fetch(PDO::FETCH_OBJ);
    	$client_name = ucwords($check_f->cr_clientsName);

    	$result = $this->pdo->prepare("DELETE FROM cr_clients WHERE cr_clientsID = ?");
    	$result->bindParam(1, $client_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Client', ?, ?, ?)");
			$history_detail = " delete ".$client_name." from clients data.";
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
    public function reorder_clients($id_array) {
    	$count = 1;
    	foreach ($id_array as $id){
			$update = $this->pdo->query("UPDATE cr_clients SET cr_clientsOrder = $count WHERE cr_clientsID = $id");
			$count ++;	
		}
		return true;
    }
    public function view_page_for_clients_menu() {
    	$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option <> 'customlink' AND cr_menuHasSub = '0' ORDER BY cr_menuOrder asc");
    	if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function view_page_for_client_submenu() {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option <> 'customlink' ORDER BY cr_submenuID asc");
    	if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function view_clients_in_page_id() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'clientspartnersinpage'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_settingID;
    }
    public function view_clients_in_page() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'clientspartnersinpage'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_settingValue;
    }
}
?>