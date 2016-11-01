<?php
/**
 * Class Portfolio Category
 *
 * @author baycore
 */

class Portfolio_Category {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_portfolio_category() {
    	$result  = $this->pdo->query("SELECT * FROM cr_portfoliocategory ORDER BY cr_portfoliocategoryOrder asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function view_portfolio_category($page_link) {
    	$check = $this->pdo->query("SELECT * FROM cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_portfoliocategory, cr_submenu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
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
    		$result = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
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
    public function view_total_portfolio_category($page_link) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
    	if($result->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_submenu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
    		$total = $result->rowCount();
	    	return $total;
    	}
    	else {
	    	$total = $result->rowCount();
	    	return $total;
    	}
    }
    public function view_total_portfolio($page_link) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioID desc");
	    $total = $result->rowCount();
	    return $total;
    }
    public function add_portfolio_category($name, $page_link, $admin_login_id, $now_date) {
    	$name_upper = ucwords($name);
	    $result = $this->pdo->prepare("INSERT INTO cr_portfoliocategory(
			    		cr_portfoliocategoryName, cr_portfoliocategoryLink, cr_portfoliocategoryDate) VALUES (?, ?, ?)");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $page_link);
		$result->bindParam(3, $now_date);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Portfolio  Category', ?, ?, ?)");
			$history_detail = " add ".$name_upper." in portfolio category.";
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
    public function check_name_portfolio_category($name) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryName = '$name'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
   	public function check_update_name_portfolio_category($name, $id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryName = '$name' AND cr_portfoliocategoryID <> '$id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
    public function update_portfolio_category($name, $name_old, $portfolio_category_idh, $admin_login_id, $now_date) {
    	$name_upper = ucwords($name);
	    $result = $this->pdo->prepare("UPDATE cr_portfoliocategory SET 
	    	cr_portfoliocategoryName = ?,
	    	cr_portfoliocategoryDate = ? 
	    	WHERE cr_portfoliocategoryID = ?");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $now_date);
		$result->bindParam(3, $portfolio_category_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Portfolio Category', ?, ?, ?)");
			$history_detail = " edit portfolio category from ".$name_old." to ".$name_upper.".";
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
    public function reorder_portfolio_category($id_array) {
    	$count = 1;
    	foreach ($id_array as $id){
			$result = $this->pdo->query("UPDATE cr_portfoliocategory SET cr_portfoliocategoryOrder = $count WHERE cr_portfoliocategoryID = $id");
			$count ++;	
		}
		return true;
    }
    public function check_in_portfolio_category($pc_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfoliocategoryID = '$pc_id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
   	public function check_in_portfolio_category_2($pc_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfoliocategoryID = '$pc_id'");
	    return $result->rowCount();
   	}
   	public function delete_portfolio_category($pc_id, $admin_login_id, $now_date) {
   		$result   = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID = '$pc_id'");
    	$fetch    = $result->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch->cr_portfoliocategoryName;

    	$result = $this->pdo->prepare("DELETE FROM cr_portfoliocategory WHERE cr_portfoliocategoryID = ?");
    	$result->bindParam(1, $pc_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Portfolio Category', ?, ?, ?)");
			$history_detail = " delete ".$cat_name." in portfolio category.";
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