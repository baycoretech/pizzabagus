<?php
/**
 * Class Map
 *
 * @author baycore
 */

class Map {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_map() {
    	$result = $this->pdo->query("SELECT * FROM cr_map, cr_mapmarker WHERE cr_map.cr_mapmarkerID = cr_mapmarker.cr_mapmarkerID ORDER BY cr_map.cr_mapID desc LIMIT 1");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    return $rows;
		}
    }
    public function view_map_marker() {
    	$result = $this->pdo->query("SELECT * FROM cr_mapmarker ORDER BY cr_mapmarkerID asc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function add_map($latlong, $mapdesc, $marker, $admin_login_id, $now_date) {
    	if(empty($marker)) {
    		$mapmarker = "1";
    	}
    	else {
    		$mapmarker = $marker;
    	}
	    $result = $this->pdo->prepare("INSERT INTO cr_map(
			    		cr_mapLatLong, cr_mapDesc, cr_mapmarkerID) VALUES (?, ?, ?)");
		$result->bindParam(1, preg_replace('/\s+/', '', $latlong));
		$result->bindParam(2, nl2br($mapdesc));
		$result->bindParam(3, $mapmarker);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Map and Location', ?, ?, ?)");
			$history_detail = " add new map and location data.";
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
    public function update_map($latlong, $mapdesc, $marker, $admin_login_id, $map_idh, $now_date) {
    	if(empty($marker)) {
    		$result = $this->pdo->prepare("UPDATE cr_map SET 
		    		cr_mapLatLong  = ?,
		    		cr_mapDesc     = ?
		    		WHERE cr_mapID = ?");	
		    $result->bindParam(1, preg_replace('/\s+/', '', $latlong));
			$result->bindParam(2, $mapdesc);
			$result->bindParam(3, $map_idh);
			if($result->execute()) {
				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Map and Location', ?, ?, ?)");
				$history_detail = " edit map and location data.";
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
		    $result = $this->pdo->prepare("UPDATE cr_map SET 
		    		cr_mapLatLong  = ?,
		    		cr_mapDesc     = ?,
		    		cr_mapmarkerID = ? 
		    		WHERE cr_mapID = ?");	
		    $result->bindParam(1, $latlong);
			$result->bindParam(2, $mapdesc);
			$result->bindParam(3, $marker);
			$result->bindParam(4, $map_idh);
			if($result->execute()) {
				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Map and Location', ?, ?, ?)");
				$history_detail = " edit map and location data.";
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
    public function delete_map($map_id, $admin_login_id, $now_date) {
    	$result = $this->pdo->prepare("DELETE FROM cr_map WHERE cr_mapID = ?");
    	$result->bindParam(1, $map_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Map', ?, ?, ?)");
			$history_detail = " delete map data.";
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