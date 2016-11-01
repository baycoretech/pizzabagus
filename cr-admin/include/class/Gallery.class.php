<?php
/**
 * Class Gallery
 *
 * @author baycore
 */

class Gallery {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_gallery() {
    	$result = $this->pdo->query("SELECT * FROM cr_gallery, cr_admin WHERE cr_gallery.cr_adminID = cr_admin.cr_adminID ORDER BY cr_gallery.cr_galleryOrder asc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function add_gallery($title, $desc, $photo, $link, $admin_login_id, $now_date) {
    	$check_last_id_q = $this->pdo->query("SELECT * FROM cr_gallery");
    	$get_last_id_q   = $this->pdo->query("SELECT LAST_INSERT_ID() FROM cr_gallery");
		$get_last_id_f   = $get_last_id_q->fetch(PDO::FETCH_OBJ);
		if($check_last_id_q->rowCount() < 1) {
			$get_last_id = 1;
		}
		else {
			$get_last_id   = $get_last_id_f->cr_galleryID + 1;
		}

		$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
		    $page_name = $row->cr_submenuTitle;
    	}
    	else {
	    	$row = $check->fetch(PDO::FETCH_OBJ);
		    $page_name = $row->cr_menuTitle;
    	} 

	    $result = $this->pdo->prepare("INSERT INTO cr_gallery(
			    		cr_galleryTitle, cr_galleryDesc, cr_galleryDate, cr_galleryThumb, cr_galleryLink, cr_galleryOrder, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, ucwords($title));
		$result->bindParam(2, $desc);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $photo);
		$result->bindParam(5, $link);
		$result->bindParam(6, $get_last_id);
		$result->bindParam(7, $admin_login_id);
		if($result->execute()) {
			$result = $this->pdo->query("SET @lastID = LAST_INSERT_ID()");
			$result = $this->pdo->query("UPDATE cr_gallery SET cr_galleryOrder = @lastID WHERE cr_galleryID = @lastID;");

			$history_title  = 'Add New Photo in '.$page_name.'(Gallery) menu.'; 
			$get_history    = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES (?, ?, ?, ?)");
			$history_detail = " add ".ucwords($title)." to ".$page_name."(gallery) menu.";
			$get_history->bindParam(1, $history_title);
			$get_history->bindParam(2, $history_detail);
			$get_history->bindParam(3, $now_date);
			$get_history->bindParam(4, $admin_login_id);
			$get_history->execute();
			return true;
		}
		else {
			return false;
		}
    }
    public function edit_gallery($gallery_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_gallery WHERE cr_galleryID = '$gallery_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function update_gallery($title, $desc, $photo, $link, $admin_login_id, $gallery_idh, $now_date) {
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
		    $page_name = $row->cr_submenuTitle;
    	}
    	else {
	    	$row = $check->fetch(PDO::FETCH_OBJ);
		    $page_name = $row->cr_menuTitle;
    	} 

    	$result = $this->pdo->prepare("UPDATE cr_gallery SET 
		    cr_galleryTitle      = ?, 
		    cr_galleryDesc       = ?, 
		    cr_galleryDate       = ?,  
		    cr_galleryThumb      = ?,
		    cr_galleryLink       = ?,
		    cr_adminID           = ?
		    WHERE cr_galleryID   = ?");	
		$result->bindParam(1, ucwords($title));
		$result->bindParam(2, $desc);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $photo);
		$result->bindParam(5, $link);
		$result->bindParam(6, $admin_login_id);
		$result->bindParam(7, $gallery_idh);
		if($result->execute()) {
			$history_title  = 'Edit Photo in '.$page_name.'(Gallery) menu.'; 
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES (?, ?, ?, ?)");
			$history_detail = " edit ".ucwords($title)." in ".$pagename."(gallery) menu.";
			$get_history->bindParam(1, $history_title);
			$get_history->bindParam(2, $history_detail);
			$get_history->bindParam(3, $now_date);
			$get_history->bindParam(4, $admin_login_id);
			$get_history->execute();
			return true;
		}
		else {
			return false;
		}
    }
    public function reorder_gallery($id_array) {
    	$count = 1;
    	foreach ($id_array as $id){
			$update = $this->pdo->query("UPDATE cr_gallery SET cr_galleryOrder = '$count' WHERE cr_galleryID = '$id'");
			$count ++;	
		}
		return true;
    }
    public function delete_gallery($gallery_id, $link, $admin_login_id, $now_date) {
    	$check   = $this->pdo->query("SELECT * FROM cr_gallery WHERE cr_galleryID = '$gallery_id'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$gallery_title = $check_f->cr_galleryTitle;
    	
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
		    $page_name = $row->cr_submenuTitle;
    	}
    	else {
	    	$row = $check->fetch(PDO::FETCH_OBJ);
		    $page_name = $row->cr_menuTitle;
    	} 
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_gallery WHERE cr_galleryID = ?");
    	$result->bindParam(1, $gallery_id);
    	if($result->execute()) {
			$history_title  = 'Delete Photo in '.$page_name.'(Gallery) menu.'; 
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES (?, ?, ?, ?)");
			$history_detail = " delete ".$gallery_title." in ".$page_name."(gallery) menu.";
			$get_history->bindParam(1, $history_title);
			$get_history->bindParam(2, $history_detail);
			$get_history->bindParam(3, $now_date);
			$get_history->bindParam(4, $admin_login_id);
			$get_history->execute();
			return true;
		}
		else {
			return false;
		}
    }
}
?>