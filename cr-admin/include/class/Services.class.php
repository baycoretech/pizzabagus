<?php
/**
 * Class Services
 *
 * @author baycore
 */

class Services {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function count_services() {
    	$check = $this->pdo->query("SELECT * FROM cr_services ORDER BY cr_servicesID desc");
    	$total = $check->rowCount(); 
    	return $total;
    }
    public function view_services() {
    	$result = $this->pdo->query("SELECT * FROM cr_services, cr_admin WHERE cr_services.cr_adminID = cr_admin.cr_adminID ORDER BY cr_services.cr_servicesID desc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
		}
    }
    public function add_services($photo, $name, $desc, $admin_login_id, $now_date) {
    	$title_upper = ucwords($name);
	    $result = $this->pdo->prepare("INSERT INTO cr_services(
			    		cr_servicesName, cr_servicesDesc, cr_servicesImage, cr_adminID) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $title_upper);
		$result->bindParam(2, $desc);
		$result->bindParam(3, $photo);
		$result->bindParam(4, $admin_login_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Service', ?, ?, ?)");

			$history_detail = " add new service data to services section.";
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
    public function edit_services($service_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_services WHERE cr_servicesID = '$service_id'");
    	$row    = $result->fetch(PDO::FETCH_OBJ);
	    return $row;
    }
    public function update_services($photo, $name, $desc, $service_idh, $admin_login_id, $now_date) {
    	$title_upper = ucwords($name);
		$result = $this->pdo->prepare("UPDATE cr_services SET 
	    		cr_servicesName       = ?, 
	    		cr_servicesDesc       = ?, 
	    		cr_servicesImage      = ?,
	    		cr_adminID            = ?
	    		WHERE cr_servicesID     = ?");	
	    $result->bindParam(1, $title_upper);
		$result->bindParam(2, $desc);
		$result->bindParam(3, $photo);
		$result->bindParam(4, $admin_login_id);
		$result->bindParam(5, $service_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Service', ?, ?, ?)");
			$history_detail = " edit service in services section.";
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
    public function delete_services($service_id, $admin_login_id, $now_date) {
    	$check_q = $this->pdo->query("SELECT * FROM cr_services WHERE cr_servicesID = '$service_id'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
    	$service_name = $check_f->cr_servicesName;
    	$result = $this->pdo->prepare("DELETE FROM cr_services WHERE cr_servicesID = ?");
    	$result->bindParam(1, $service_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Service', ?, ?, ?)");
			$history_detail = " delete ".$service_name." in services section.";
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
    public function view_page_for_services_menu() {
    	$check = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option <> 'customlink' AND cr_menuHasSub = '0' ORDER BY cr_menuOrder asc");
    	if($check->rowCount() < 1) {
    		return false;
    	}
    	else {
	    	while($rows = $check->fetch(PDO::FETCH_OBJ))
			    $data[] = $rows;
			return $data;
		}
    }
    public function view_page_for_services_submenu() {
    	$check = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option <> 'customlink' ORDER BY cr_submenuID asc");
    	if($check->rowCount() < 1) {
    		return false;
    	}
    	else {
	    	while($rows = $check->fetch(PDO::FETCH_OBJ))
			    $data[] = $rows;
			return $data;
		}
    }
    public function view_services_in_page_id() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'servicesinpage'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_settingID;
    }
    public function view_services_in_page() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'servicesinpage'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_settingValue;
    }
}
?>