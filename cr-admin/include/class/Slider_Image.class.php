<?php
/**
 * Class Slider Image
 *
 * @author baycore
 */

class Slider_Image {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_slider_image() {
    	$result = $this->pdo->query("SELECT * FROM cr_slider, cr_admin WHERE cr_slider.cr_adminID = cr_admin.cr_adminID ORDER BY cr_slider.cr_sliderID asc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function add_slider_image($photo, $caption, $desc, $blink, $textposition, $admin_login_id, $now_date) {
    	if(empty($textposition)) {
    		$textposition = "center";
    	}
	    $result = $this->pdo->prepare("INSERT INTO cr_slider(
			    		cr_sliderImage, cr_sliderCaption, cr_sliderDesc, cr_sliderButtonlink, cr_sliderTextposition, cr_adminID) VALUES (?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $photo);
		$result->bindParam(2, $caption);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $blink);
		$result->bindParam(5, $textposition);
		$result->bindParam(6, $admin_login_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Slider Image', ?, ?, ?)");

			$history_detail = " add new slider image in slider image section";
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
    public function edit_slider_image($slider_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_slider WHERE cr_sliderID = '$slider_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
     public function update_slider_image($photo, $caption, $desc, $blink, $textposition, $slider_idh, $admin_login_id, $now_date) {
    	if(empty($textposition)) {
    		$textposition = "center";
    	}
		$result = $this->pdo->prepare("UPDATE cr_slider SET 
	    		cr_sliderImage        = ?, 
	    		cr_sliderCaption      = ?, 
	    		cr_sliderDesc         = ?,  
	    		cr_sliderButtonlink   = ?,
	    		cr_sliderTextposition = ?,
	    		cr_adminID            = ?
	    		WHERE cr_sliderID     = ?");	
	    $result->bindParam(1, $photo);
		$result->bindParam(2, $caption);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $blink);
		$result->bindParam(5, $textposition);
		$result->bindParam(6, $admin_login_id);
		$result->bindParam(7, $slider_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
		    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Slider Image', ?, ?, ?)");
			$history_detail = " edit slider image in slider image section.";
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
    public function delete_slider_image($slider_id, $admin_login_id, $now_date) {
    	$result = $this->pdo->prepare("DELETE FROM cr_slider WHERE cr_sliderID = ?");
    	$result->bindParam(1, $slider_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Slider Image', ?, ?, ?)");
			$history_detail = " delete one slider image in slider image section.";
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