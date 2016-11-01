<?php
/**
 * Class Media
 *
 * @author baycore
 */ 

class Media {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_media_data() {
    	$result = $this->pdo->query("SELECT * FROM cr_media, cr_admin WHERE cr_media.cr_adminID = cr_admin.cr_adminID ORDER BY cr_media.cr_mediaDate desc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function view_selected_media_data($media_name) {
    	$result = $this->pdo->query("SELECT * FROM cr_media WHERE cr_mediaName = '$media_name' ORDER BY cr_mediaDate desc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
			return $rows;
		}
    }
    public function view_latest_media_data() {
    	$result = $this->pdo->query("SELECT * FROM cr_media ORDER BY cr_mediaDate desc LIMIT 1");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
			return $rows;
		}
    }
    public function add_media($media_name, $admin_login_id, $now_date) {
	    $result = $this->pdo->prepare("INSERT INTO cr_media(
			    		cr_mediaName, cr_mediaDate, cr_adminID) VALUES (?, ?, ?)");
		$result->bindParam(1, $media_name);
		$result->bindParam(2, $now_date);
		$result->bindParam(3, $admin_login_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Media', ?, ?, ?)");
			
			$history_detail = " upload ".$media_name." as a new media.";
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
    public function update_media($title, $desc, $admin_login_id, $media_idh, $now_date) {
    	global $now_date;
    	$check   = $this->pdo->query("SELECT * FROM cr_media WHERE cr_mediaID = '$media_idh'");
    	$check_fetch = $check->fetch(PDO::FETCH_OBJ);
    	$media_name  = $check_fetch->cr_mediaName;
	    $result = $this->pdo->prepare("UPDATE cr_media SET 
	    		cr_mediaTitle     = ?, 
	    		cr_mediaDesc      = ? 
	    		WHERE cr_mediaID  = ?");	
	    $result->bindParam(1, $title);
		$result->bindParam(2, $desc);
		$result->bindParam(3, $media_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Media', ?, ?, ?)");
			$history_detail = " edit ".$media_name." in media.";
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
    public function delete_media($media_id, $media_name, $admin_login_id, $now_date) {
    	global $now_date;
    	$result = $this->pdo->prepare("DELETE FROM cr_media WHERE cr_mediaID = ?");
    	$result->bindParam(1, $media_id);
    	if($result->execute()) {
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$media_name);
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Media', ?, ?, ?)");
			$history_detail = " delete ".$media_name." from media.";
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