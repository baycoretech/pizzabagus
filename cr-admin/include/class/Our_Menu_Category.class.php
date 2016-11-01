<?php
/**
 * Class Our Menu Category
 *
 * @author baycore
 */

class Our_Menu_Category {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_ourmenu_category() {
    	$result  = $this->pdo->query("SELECT * FROM cr_ourmenucategory ORDER BY cr_ourmenucategoryOrder asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function view_ourmenu_category_in_toppings($category_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenucategory WHERE cr_ourmenucategoryID = '$category_id' ORDER BY cr_ourmenucategoryOrder asc");
    	$row = $result->fetch(PDO::FETCH_OBJ);
		return $row;
    }
    public function view_ourmenu_category($page_link) {
    	$check = $this->pdo->query("SELECT * FROM cr_ourmenucategory, cr_menu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_menu.cr_menuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_ourmenucategory, cr_submenu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
    		if($result->rowCount() < 1){
	    		return false;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_ourmenucategory, cr_menu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_menu.cr_menuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
	    	if($result->rowCount() < 1){
	    		return false;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    }
    public function view_total_ourmenu_category($page_link) {
    	$result = $this->pdo->query("SELECT * FROM  cr_ourmenucategory, cr_menu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_menu.cr_menuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
    	if($result->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_ourmenucategory, cr_submenu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
    		$total = $result->rowCount();
	    	return $total;
    	}
    	else {
	    	$total = $result->rowCount();
	    	return $total;
    	}
    }
    public function view_total_ourmenu($page_link) {
    	$result = $this->pdo->query("SELECT * FROM  cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuID desc");
	    $total = $result->rowCount();
	    return $total;
    }
    public function add_ourmenu_category($name, $name_id, $page_link, $admin_login_id, $now_date) {
    	$name_upper = ucwords($name);
	    $result = $this->pdo->prepare("INSERT INTO cr_ourmenucategory(
			    		cr_ourmenucategoryName, cr_ourmenucategoryLink, cr_ourmenucategoryDate, cr_ourmenucategoryName_id) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $page_link);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $name_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Menu  Category', ?, ?, ?)");
			$history_detail = " add ".$name_upper." in menu category.";
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
    public function check_name_ourmenu_category($name) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenucategory WHERE cr_ourmenucategoryName = '$name'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
   	public function check_update_name_ourmenu_category($name, $id) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenucategory WHERE cr_ourmenucategoryName = '$name' AND cr_ourmenucategoryID <> '$id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
    public function update_ourmenu_category($name, $name_id, $name_old, $portfolio_category_idh, $admin_login_id, $now_date) {
    	$name_upper = ucwords($name);
	    $result = $this->pdo->prepare("UPDATE cr_ourmenucategory SET 
	    	cr_ourmenucategoryName = ?,
	    	cr_ourmenucategoryDate = ?,
	    	cr_ourmenucategoryName_id = ? 
	    	WHERE cr_ourmenucategoryID = ?");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $now_date);
		$result->bindParam(3, $name_id);
		$result->bindParam(4, $portfolio_category_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Menu Category', ?, ?, ?)");
			$history_detail = " edit menu category from ".$name_old." to ".$name_upper.".";
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
    public function reorder_ourmenu_category($id_array) {
    	$count = 1;
    	foreach ($id_array as $id){
			$result = $this->pdo->query("UPDATE cr_ourmenucategory SET cr_ourmenucategoryOrder = $count WHERE cr_ourmenucategoryID = $id");
			$count ++;	
		}
		return true;
    }
    public function check_in_ourmenu_category($pc_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenucategoryID = '$pc_id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
   	public function check_in_ourmenu_category_2($pc_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenucategoryID = '$pc_id'");
	    return $result->rowCount();
   	}
   	public function delete_ourmenu_category($pc_id, $admin_login_id, $now_date) {
   		$result   = $this->pdo->query("SELECT * FROM cr_ourmenucategory WHERE cr_ourmenucategoryID = '$pc_id'");
    	$fetch    = $result->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch->cr_ourmenucategoryName;

    	$result = $this->pdo->prepare("DELETE FROM cr_ourmenucategory WHERE cr_ourmenucategoryID = ?");
    	$result->bindParam(1, $pc_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Menu Category', ?, ?, ?)");
			$history_detail = " delete ".$cat_name." in menu category.";
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