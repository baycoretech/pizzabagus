<?php
/**
 * Class Portfolio Extra
 *
 * @author baycore
 */

class Portfolio_Extra {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_portfolio_extra($portfolio_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolioextra WHERE cr_portfolioID = '$portfolio_id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
			return $data;
		}
    }
    public function add_portfolio_extra($name, $content, $portfolio_id, $admin_login_id, $now_date) {
    	$title_uppercase = ucwords($name);
    	$check_q  = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID = '$portfolio_id'");
    	$check_f  = $check_q->fetch(PDO::FETCH_OBJ);
    	$check    = $check_f->cr_portfolioTitle;
	    $result = $this->pdo->prepare("INSERT INTO cr_portfolioextra(
			    		cr_portfolioextraName, cr_portfolioextraContent, cr_portfolioID) VALUES (?, ?, ?)");
		$result->bindParam(1, $title_uppercase);
		$result->bindParam(2, $content);
		$result->bindParam(3, $portfolio_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Extra Content to Portfolio', ?, ?, ?)");

			$history_detail = " add new extra content to ".$check.".";
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
    public function edit_portfolio_extra($portfolio_extra_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolioextra WHERE cr_portfolioextraID = '$portfolio_extra_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function get_slug_portfolio($portfolio_id) {
    	$check = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryID = cr_portfolio.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink AND cr_portfolio.cr_portfolioID = '$portfolio_id'");
    	if($check->rowCount()<1) {
    		$check2 = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_submenu WHERE cr_portfoliocategory.cr_portfoliocategoryID = cr_portfolio.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_submenu.cr_submenuLink AND cr_portfolio.cr_portfolioID='$portfolio_id'");
    		$rows = $check2->fetch(PDO::FETCH_OBJ);
    		$menu_link = $rows->cr_submenuLink;
    		return $menu_link;
    	}
    	else {
    		$rows = $check->fetch(PDO::FETCH_OBJ);
    		$menu_link = $rows->cr_menuLink;
    		return $menu_link;
    	}
    }
    public function update_portfolio_extra($name, $content, $portfolio_id, $admin_login_id, $now_date, $portfolio_extra_idh) {
    	$title_uppercase = ucwords($name);
    	$check_q  = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID = '$portfolio_id'");
    	$check_f  = $check_q->fetch(PDO::FETCH_OBJ);
    	$check    = $check_f->cr_portfolioTitle;
		$result   = $this->pdo->prepare("UPDATE cr_portfolioextra SET 
		    cr_portfolioextraName     = ?, 
		    cr_portfolioextraContent  = ?, 
		    cr_portfolioID            = ?
		    WHERE cr_portfolioextraID = ?");	
		$result->bindParam(1, $title_uppercase);
		$result->bindParam(2, $content);
		$result->bindParam(3, $portfolio_id);
		$result->bindParam(4, $portfolio_extra_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update Extra Content to Portfolio', ?, ?, ?)");
			$history_detail = " update extra content(".$title_uppercase.") in ".$check.".";
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
    public function delete_portfolio_extra($portfolio_extra_id, $admin_login_id, $now_date) {
    	$check   = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfolioextra WHERE cr_portfolioextra.cr_portfolioID = cr_portfolio.cr_portfolioID AND cr_portfolioextra.cr_portfolioextraID = '$portfolio_extra_id'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$pe_name = $check_f->cr_portfolioextraName;
    	$p_name  = $check_f->cr_portfolioTitle;
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_portfolioextra WHERE cr_portfolioextraID = ?");
    	$result->bindParam(1, $portfolio_extra_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Extra Content Portfolio', ?, ?, ?)");
			$history_detail = " delete ".$pe_name."(Extra Content) inside ".$p_name.".";
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