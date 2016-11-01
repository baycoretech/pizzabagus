<?php
/**
 * Class Portfolio
 *
 * @author baycore
 */

class Portfolio {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_portfolio($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioID desc");
    	if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_portfolio_date_asc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioDate asc");
	    if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_portfolio_name_asc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle asc");
	    if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_portfolio_name_desc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle desc");
	    if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
    	}
    }
    public function view_portfolio_extra($portfolio_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfolioextra WHERE cr_portfolio.cr_portfolioID = cr_portfolioextra.cr_portfolioID AND cr_portfolioextra.cr_portfolioID = '$portfolio_id'");
	    $total = $result->rowCount();
	    return $total;
    }
    public function count_likes($portfolio_id) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliolikes WHERE cr_portfolioID = '$portfolio_id'");
        $total  = $result->rowCount();
        return $total;
    }
    public function count_visitor($portfolio_id) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliovisitor WHERE cr_portfolioID = '$portfolio_id'");
        $total  = $result->rowCount();
        return $total;
    }
    public function add_portfolio($title, $desc, $photo, $slider_image, $cat, $status, $metakey, $metadesc, $admin_login_id, $now_date) {
    	$title_uppercase = ucwords($title);
    	$url_slug = create_slug($title);
    	$cekpc_q  = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID = '$cat'");
    	$cekpc_f  = $cekpc_q->fetch(PDO::FETCH_OBJ);
    	$cat_name = $cekpc_f->cr_portfoliocategoryName;
    	$image    = str_replace(MADMINURL."../","",$photo);
	    $result   = $this->pdo->prepare("INSERT INTO cr_portfolio(
			    		cr_portfolioTitle, cr_portfolioLink, cr_portfolioDesc, cr_portfolioDate, cr_portfolioSliderimage, cr_portfolioThumb, cr_portfoliocategoryID, cr_portfolioMetaKeywords, cr_portfolioMetaDescription, cr_portfolioStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $title_uppercase);
		$result->bindParam(2, $url_slug);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $now_date);
		$result->bindParam(5, $slider_image);
		$result->bindParam(6, $image);
		$result->bindParam(7, $cat);
		$result->bindParam(8, $metakey);
		$result->bindParam(9, $metadesc);
		$result->bindParam(10, $status);
		$result->bindParam(11, $admin_login_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Portfolio', ?, ?, ?)");

			$history_detail = " add ".$title_uppercase." (".ucwords($status).") as a new portfolio in ".$cat_name." category.";
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
    public function edit_portfolio($portfolio_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID = '$portfolio_id'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function update_portfolio($title, $desc, $photo, $photourlnc, $slider_image, $cat, $status, $metakey, $metadesc, $admin_login_id, $now_date, $portfolio_idh) {
    	$title_uppercase = ucwords($title);
    	$url_slug   = create_slug($title);
    	$photoca    = str_replace(MADMINURL."../","",$photo);
    	$photocb    = str_replace(MURL,"",$photo);
    	$cekp_q  = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID = '$portfolio_idh'");
    	$cekp_f  = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname  = $cekp_f->cr_portfolioThumb;

    	$cekpc_q = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID = '$cat'");
    	$cekpc_f = $cekpc_q->fetch(PDO::FETCH_OBJ);
    	$cat_name = $cekpc_f->cr_portfoliocategoryName;

    	if($photocb != $photourlnc) {
    		$result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    	cr_portfolioTitle           = ?, 
		    	cr_portfolioLink            = ?,
		    	cr_portfolioDesc            = ?, 
		    	cr_portfolioDate            = ?, 
		    	cr_portfolioSliderimage     = ?, 
		    	cr_portfolioThumb           = ?,
		    	cr_portfoliocategoryID      = ?,
		    	cr_portfolioMetaKeywords    = ?,
		    	cr_portfolioMetaDescription = ?,
		    	cr_portfolioStatus          = ?,
		    	cr_adminID                  = ?
		    	WHERE cr_portfolioID        = ?");	
			$result->bindParam(1, $title_uppercase);
			$result->bindParam(2, $url_slug);
			$result->bindParam(3, $desc);
			$result->bindParam(4, $now_date);
			$result->bindParam(5, $slider_image);
			$result->bindParam(6, $photoca);
			$result->bindParam(7, $cat);
			$result->bindParam(8, $metakey);
			$result->bindParam(9, $metadesc);
			$result->bindParam(10, $status);
			$result->bindParam(11, $admin_login_id);
			$result->bindParam(12, $portfolio_idh);
			if($result->execute()) {
				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Portfolio', ?, ?, ?)");
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
    		$result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    	cr_portfolioTitle           = ?, 
		    	cr_portfolioLink            = ?,
		    	cr_portfolioDesc            = ?, 
		    	cr_portfolioDate            = ?, 
		    	cr_portfolioSliderimage     = ?, 
		    	cr_portfoliocategoryID      = ?,
		    	cr_portfolioMetaKeywords    = ?,
		    	cr_portfolioMetaDescription = ?,
		    	cr_portfolioStatus          = ?,
		    	cr_adminID                  = ?
		    	WHERE cr_portfolioID        = ?");	
			$result->bindParam(1, $title_uppercase);
			$result->bindParam(2, $url_slug);
			$result->bindParam(3, $desc);
			$result->bindParam(4, $now_date);
			$result->bindParam(5, $slider_image);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $metakey);
			$result->bindParam(8, $metadesc);
			$result->bindParam(9, $status);
			$result->bindParam(10, $admin_login_id);
			$result->bindParam(11, $portfolio_idh);
			if($result->execute()) {
				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Portfolio', ?, ?, ?)");
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
    public function check_name_portfolio($title) {
    	$url_slug = create_slug($title);
    	$result   = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioTitle = '$title' OR cr_portfolioLink = '$url_slug'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
   	public function check_update_name_portfolio($title, $portfolio_id) {
    	$url_slug = create_slug($title);
    	$result   = $this->pdo->query("SELECT * FROM cr_portfolio WHERE (cr_portfolioTitle = '$title' OR cr_portfolioLink = '$url_slug') AND cr_portfolioID <> '$portfolio_id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
    public function count_selected_portfolio() {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioSelected = 'yes'");
    	$total = $result->rowCount();
    	return $total;
    }
    public function set_selected_portfolio($admin_login_id, $portfolio_idh, $now_date) {
    	$selected = "yes";
	    $result   = $this->pdo->prepare("UPDATE cr_portfolio SET 
	    		cr_portfolioSelected   = ?
	    		WHERE cr_portfolioID   = ?");	
	    $result->bindParam(1, $selected);
		$result->bindParam(2, $portfolio_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Set Portfolio as Selected', ?, ?, ?)");
			$history_detail = " edit portfolio as selected portfolio to show at homepage.";
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
    public function unset_selected_portfolio($admin_login_id, $portfolio_idh, $now_date) {
    	$selected = "";
	    $result   = $this->pdo->prepare("UPDATE cr_portfolio SET 
	    		cr_portfolioSelected   = ?
	    		WHERE cr_portfolioID   = ?");	
	    $result->bindParam(1, $selected);
		$result->bindParam(2, $portfolio_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Unset Portfolio as Selected', ?, ?, ?)");
			$history_detail = " edit portfolio from selected to unselected.";
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
    public function delete_portfolio($portfolio_id, $admin_login_id, $now_date) {
    	$check   = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfolio.cr_portfolioID = '$portfolio_id'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$portfolio_title = $check_f->cr_portfolioTitle;
    	$portfolio_cat   = $check_f->cr_portfoliocategoryName;
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_portfolio WHERE cr_portfolioID = ?");
    	$result->bindParam(1, $portfolio_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Portfolio', ?, ?, ?)");
			$history_detail = " delete ".$portfolio_title." in ".$portfolio_cat." category.";
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