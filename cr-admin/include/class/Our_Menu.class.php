<?php
/**
 * Class Our Menu
 *
 * @author baycore
 */

class Our_Menu {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_ourmenu($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuID desc");
    	if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_ourmenu_date_asc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuDate asc");
	    if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_ourmenu_name_asc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuTitle asc");
	    if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_ourmenu_name_desc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuTitle desc");
	    if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_ourmenu_detail_order($menu_id) {
        $result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuID = '$menu_id'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function all_ingredients() {
    	$result  = $this->pdo->query("SELECT * FROM cr_ourmenuingredients ORDER BY cr_ourmenuingredientsID asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			   	$data[]=$rows;
			return $data;
		}
    }
    public function all_ingredients_id() {
    	$result  = $this->pdo->query("SELECT * FROM cr_ourmenuingredients_id ORDER BY cr_ourmenuingredients_idID asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			   	$data[]=$rows;
			return $data;
		}
    }
    public function add_ourmenu($title, $ingredients, $ingredients_id, $noimplodeingredients, $noimplodeingredients_id, $desc, $desc_id, $photo, $cat, $status, $price, $size, $type, $admin_login_id, $now_date) {
    	$title_uppercase = ucwords($title);
    	$url_slug = create_slug($title);
    	$cekpc_q  = $this->pdo->query("SELECT * FROM cr_ourmenucategory WHERE cr_ourmenucategoryID = '$cat'");
    	$cekpc_f  = $cekpc_q->fetch(PDO::FETCH_OBJ);
    	$cat_name = $cekpc_f->cr_ourmenucategoryName;

    	if($photo == MADMINURL."assets/img/no-pic-items.png") 
			$image = '';
    	else 
    		$image    = str_replace(MADMINURL."../","",$photo);

	    $result   = $this->pdo->prepare("INSERT INTO cr_ourmenu(
			    		cr_ourmenuTitle, cr_ourmenuIngredients, cr_ourmenuLink, cr_ourmenuDesc, cr_ourmenuDate, cr_ourmenuThumb, cr_ourmenucategoryID, cr_ourmenuStatus, cr_ourmenuPrice, cr_ourmenuSize, cr_adminID, cr_ourmenuType, cr_ourmenuIngredients_id, cr_ourmenuDesc_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $title_uppercase);
		$result->bindParam(2, $ingredients);
		$result->bindParam(3, $url_slug);
		$result->bindParam(4, $desc);
		$result->bindParam(5, $now_date);
		$result->bindParam(6, $image);
		$result->bindParam(7, $cat);
		$result->bindParam(8, $status);
		$result->bindParam(9, $price);
		$result->bindParam(10, $size);
		$result->bindParam(11, $admin_login_id);
		$result->bindParam(12, $type);
		$result->bindParam(13, $ingredients_id);
		$result->bindParam(14, $desc_id);
		if($result->execute()) {
			if($noimplodeingredients != NULL) {
				foreach($noimplodeingredients as $ingredientsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_ourmenuingredients(
					    		cr_ourmenuingredientsName) VALUES (?)");
					$result->bindParam(1, $ingredientsname);
					$result->execute();
				}
			}

			if($noimplodeingredients_id != NULL) {
				foreach($noimplodeingredients_id as $ingredientsname_id) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_ourmenuingredients_id(
					    		cr_ourmenuingredientsName_id) VALUES (?)");
					$result->bindParam(1, $ingredientsname_id);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Menu', ?, ?, ?)");

			$history_detail = " add ".$title_uppercase." (".ucwords($status).") as a new menu in ".$cat_name." category.";
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
    public function edit_ourmenu($ourmenu_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenuID = '$ourmenu_id'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function update_ourmenu($title, $ingredients, $ingredients_id, $noimplodeingredients, $noimplodeingredients_id, $desc, $desc_id, $photo, $photourlnc, $cat, $status, $price, $size, $type, $admin_login_id, $now_date, $ourmenu_idh) {
    	$title_uppercase = ucwords($title);
    	$url_slug   = create_slug($title);
    	$photoca    = str_replace(MADMINURL."../","",$photo);
    	$photocb    = str_replace(MURL,"",$photo);
    	$cekp_q  = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenuID = '$ourmenu_idh'");
    	$cekp_f  = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname  = $cekp_f->cr_ourmenuThumb;

    	if($photo == MADMINURL."assets/img/no-pic-items.png") 
			$photoca = '';
    	else 
    		$photoca = str_replace(MADMINURL."../","",$photo);

    	$cekpc_q = $this->pdo->query("SELECT * FROM cr_ourmenucategory WHERE cr_ourmenucategoryID = '$cat'");
    	$cekpc_f = $cekpc_q->fetch(PDO::FETCH_OBJ);
    	$cat_name = $cekpc_f->cr_ourmenucategoryName;

    	if($photocb != $photourlnc) {
    		$result = $this->pdo->prepare("UPDATE cr_ourmenu SET 
		    	cr_ourmenuTitle           = ?, 
		    	cr_ourmenuIngredients     = ?, 
		    	cr_ourmenuLink            = ?,
		    	cr_ourmenuDesc            = ?, 
		    	cr_ourmenuDate            = ?, 
		    	cr_ourmenuThumb           = ?,
		    	cr_ourmenucategoryID      = ?,
		    	cr_ourmenuStatus          = ?,
		    	cr_ourmenuPrice           = ?,
		    	cr_ourmenuSize            = ?,
		    	cr_adminID                = ?,
		    	cr_ourmenuType            = ?,
		    	cr_ourmenuIngredients_id  = ?,
		    	cr_ourmenuDesc_id         = ?
		    	WHERE cr_ourmenuID        = ?");	
			$result->bindParam(1, $title_uppercase);
			$result->bindParam(2, $ingredients);
			$result->bindParam(3, $url_slug);
			$result->bindParam(4, $desc);
			$result->bindParam(5, $now_date);
			$result->bindParam(6, $photoca);
			$result->bindParam(7, $cat);
			$result->bindParam(8, $status);
			$result->bindParam(9, $price);
			$result->bindParam(10, $size);
			$result->bindParam(11, $admin_login_id);
			$result->bindParam(12, $type);
			$result->bindParam(13, $ingredients_id);
			$result->bindParam(14, $desc_id);
			$result->bindParam(15, $ourmenu_idh);
			if($result->execute()) {
				if($noimplodeingredients != NULL) {
					foreach($noimplodeingredients as $ingredientsname) {
						$result = $this->pdo->prepare("INSERT IGNORE INTO cr_ourmenuingredients(
						    		cr_ourmenuingredientsName) VALUES (?)");
						$result->bindParam(1, $ingredientsname);
						$result->execute();
					}
				}
				if($noimplodeingredients_id != NULL) {
					foreach($noimplodeingredients_id as $ingredientsname_id) {
						$result = $this->pdo->prepare("INSERT IGNORE INTO cr_ourmenuingredients_id(
						    		cr_ourmenuingredientsName_id) VALUES (?)");
						$result->bindParam(1, $ingredientsname_id);
						$result->execute();
					}
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Menu', ?, ?, ?)");
				$history_detail = " edit ".$title_uppercase." (".ucwords($status).") in ".$cat_name." category.";
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
    		$result = $this->pdo->prepare("UPDATE cr_ourmenu SET 
		    	cr_ourmenuTitle           = ?, 
		    	cr_ourmenuLink            = ?,
		    	cr_ourmenuDesc            = ?, 
		    	cr_ourmenuDate            = ?, 
		    	cr_ourmenucategoryID      = ?,
		    	cr_ourmenuStatus          = ?,
		    	cr_ourmenuPrice           = ?,
		    	cr_ourmenuSize            = ?,
		    	cr_adminID                = ?,
		    	cr_ourmenuType            = ?,
		    	cr_ourmenuIngredients_id  = ?,
		    	cr_ourmenuDesc_id         = ?
		    	WHERE cr_ourmenuID        = ?");	
			$result->bindParam(1, $title_uppercase);
			$result->bindParam(2, $url_slug);
			$result->bindParam(3, $desc);
			$result->bindParam(4, $now_date);
			$result->bindParam(5, $cat);
			$result->bindParam(6, $status);
			$result->bindParam(7, $price);
			$result->bindParam(8, $size);
			$result->bindParam(9, $admin_login_id);
			$result->bindParam(10, $type);
			$result->bindParam(11, $ingredients_id);
			$result->bindParam(12, $desc_id);
			$result->bindParam(13, $ourmenu_idh);
			if($result->execute()) {
				if($noimplodeingredients != NULL) {
					foreach($noimplodeingredients as $ingredientsname) {
						$result = $this->pdo->prepare("INSERT IGNORE INTO cr_ourmenuingredients(
						    		cr_ourmenuingredientsName) VALUES (?)");
						$result->bindParam(1, $ingredientsname);
						$result->execute();
					}
				}
				if($noimplodeingredients_id != NULL) {
					foreach($noimplodeingredients_id as $ingredientsname_id) {
						$result = $this->pdo->prepare("INSERT IGNORE INTO cr_ourmenuingredients_id(
						    		cr_ourmenuingredientsName_id) VALUES (?)");
						$result->bindParam(1, $ingredientsname_id);
						$result->execute();
					}
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Menu', ?, ?, ?)");
				$history_detail = " edit ".$title_uppercase." (".ucwords($status).") in ".$cat_name." category.";
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
    public function check_name_ourmenu($title) {
    	$url_slug = create_slug($title);
    	$result   = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenuTitle = '$title' OR cr_ourmenuLink = '$url_slug'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
   	public function check_update_name_ourmenu($title, $ourmenu_id) {
    	$url_slug = create_slug($title);
    	$result   = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE (cr_ourmenuTitle = '$title' OR cr_ourmenuLink = '$url_slug') AND cr_ourmenuID <> '$ourmenu_id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
    public function count_selected_ourmenu() {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenuSelected = 'yes'");
    	$total = $result->rowCount();
    	return $total;
    }
    public function set_selected_ourmenu($admin_login_id, $ourmenu_idh, $now_date) {
    	$selected = "yes";
	    $result   = $this->pdo->prepare("UPDATE cr_ourmenu SET 
	    		cr_ourmenuSelected   = ?
	    		WHERE cr_ourmenuID   = ?");	
	    $result->bindParam(1, $selected);
		$result->bindParam(2, $ourmenu_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Set Menu as Special Menu', ?, ?, ?)");
			$history_detail = " edit menu as special ourmenu.";
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
    public function unset_selected_ourmenu($admin_login_id, $ourmenu_idh, $now_date) {
    	$selected = "";
	    $result   = $this->pdo->prepare("UPDATE cr_ourmenu SET 
	    		cr_ourmenuSelected   = ?
	    		WHERE cr_ourmenuID   = ?");	
	    $result->bindParam(1, $selected);
		$result->bindParam(2, $ourmenu_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Unset Menu as Special Menu', ?, ?, ?)");
			$history_detail = " edit menu from selected to unselected.";
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
    public function delete_ourmenu($ourmenu_id, $admin_login_id, $now_date) {
    	$check   = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuID = '$ourmenu_id'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$ourmenu_title = $check_f->cr_ourmenuTitle;
    	$ourmenu_cat   = $check_f->cr_ourmenucategoryName;
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_ourmenu WHERE cr_ourmenuID = ?");
    	$result->bindParam(1, $ourmenu_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Menu', ?, ?, ?)");
			$history_detail = " delete ".$ourmenu_title." in ".$ourmenu_cat." category.";
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
    public function delete_menu_image($menu_id) {
        $value  = ''; 
        $result = $this->pdo->prepare("UPDATE cr_ourmenu SET 
                    cr_ourmenuThumb    = ? 
                    WHERE cr_ourmenuID = ?");  
        $result->bindParam(1, $value);
        $result->bindParam(2, $menu_id);
        if($result->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
}
?>