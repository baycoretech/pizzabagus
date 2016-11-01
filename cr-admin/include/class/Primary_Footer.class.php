<?php
/**
 * Class Primary Footer
 *
 * @author baycore
 */

class Primary_Footer {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_primary_footer_1() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column1'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
	    if(empty($row->cr_footerType)) {
	    	return false;
	    }
	    else {
	    	return $row;
    	}
    }
    public function view_primary_footer_2() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column2'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
	    if(empty($row->cr_footerType)) {
	    	return false;
	    }
	    else {
	    	return $row;
    	}
    }
    public function view_primary_footer_3() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column3'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
	    if(empty($row->cr_footerType)) {
	    	return false;
	    }
	    else {
	    	return $row;
    	}
    }
    public function view_primary_footer_4() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column4'");
	    $row    = $result->fetch(PDO::FETCH_OBJ);
	    if(empty($row->cr_footerType)) {
	    	return false;
	    }
	    else {
	    	return $row;
    	}
    }
    public function view_primary_footer_query($pfid) {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerID = '$pfid'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_primary_footer_portfolio_category($ex1) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID = '$ex1'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_primary_footer_blog_category($ex2) {
    	$result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$ex2'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_primary_footer_blog_page($ex1) {
    	$position  = substr($ex1, 0, 1);
		$blogpid   = substr($ex1, 1);
		if($position == "m") {
			$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$blogpid'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
	    	return $row->cr_menuTitle;
		}
		elseif($position == "s") {
			$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuID = '$blogpid'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
	    	return $row->cr_submenuTitle;
		}
    }
    public function view_primary_footer_tour_page($position, $page) {
		if($position == "menu") {
			$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$page'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
	    	return $row->cr_menuTitle;
		}
		elseif($position == "submenu") {
			$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuID = '$page'");
	    	$row    = $result->fetch(PDO::FETCH_OBJ);
	    	return $row->cr_submenuTitle;
		}
    }
    public function add_primary_footer_1($footer_id, $pftype, $custom_text_title, $custom_text_text, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $custom_text_title);
	    $result->bindParam(3, $custom_text_text);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with custom text type.";
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
    public function add_primary_footer_2($footer_id, $pftype, $latest_portfolio_title, $latest_portfolio_category, $latest_portfolio_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$arr     = array($latest_portfolio_category,$latest_portfolio_total);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $latest_portfolio_title);
	    $result->bindParam(3, $value);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with latest portfolio type.";
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
    public function add_primary_footer_3($footer_id, $pftype, $latest_gallery_title, $latest_gallery_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $latest_gallery_title);
	    $result->bindParam(3, $latest_gallery_total);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with latest gallery type.";
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
    public function add_primary_footer_4($footer_id, $pftype, $social_title, $social_description, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $social_title);
	    $result->bindParam(3, $social_description);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with available social media type.";
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
    public function add_primary_footer_5($footer_id, $pftype, $instafeed_title, $instafeed_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $instafeed_title);
	    $result->bindParam(3, $instafeed_total);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with instagram feed type.";
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
    public function add_primary_footer_6($footer_id, $pftype, $twitterfeed_title, $twitterfeed_text, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $twitterfeed_title);
	    $result->bindParam(3, $twitterfeed_text);
		$result->bindParam(4, $footer_id);
		$result->execute();

		$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$history_detail = " add new data in ".strtolower($fname)." primary footer with twitter feed type.";
		$get_history->bindParam(1, $history_detail);
		$get_history->bindParam(2, $now_date);
		$get_history->bindParam(3, $admin_login_id);
		$get_history->execute();
    }
    public function add_primary_footer_7($footer_id, $pftype, $facebookpage_title, $facebookpage_text, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $facebookpage_title);
	    $result->bindParam(3, $facebookpage_text);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with facebook page type.";
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
    public function add_primary_footer_8($footer_id, $pftype, $blog_title, $blog_page, $blog_category, $blog_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$arr     = array($blog_page,$blog_category,$blog_total);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $blog_title);
	    $result->bindParam(3, $value);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with latest blog in specific page.";
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
    public function add_primary_footer_9($footer_id, $pftype, $tour_title, $tour_page, $tour_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$arr     = array($tour_page,$tour_total);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $tour_title);
	    $result->bindParam(3, $value);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
			$history_detail = " add new data in ".strtolower($fname)." primary footer with latest tour package in specific page.";
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
    public function update_primary_footer_1($footer_id, $custom_text_title, $custom_text_text, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $custom_text_title);
	    $result->bindParam(2, $custom_text_text);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update custom text data in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_2($footer_id, $latest_portfolio_title, $latest_portfolio_category, $latest_portfolio_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$arr     = array($latest_portfolio_category,$latest_portfolio_total);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $latest_portfolio_title);
	    $result->bindParam(2, $value);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update latest portfolio data in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_3($footer_id, $latest_gallery_title, $latest_gallery_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $latest_gallery_title);
	    $result->bindParam(2, $latest_gallery_total);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update latest gallery data in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_4($footer_id, $social_title, $social_description, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $social_title);
	    $result->bindParam(2, $social_description);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update available social media in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_5($footer_id, $instafeed_title, $instafeed_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $instafeed_title);
	    $result->bindParam(2, $instafeed_total);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update instagram feed data in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_6($footer_id, $twitterfeed_title, $twitterfeed_text, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $twitterfeed_title);
	    $result->bindParam(2, $twitterfeed_text);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update twitter feed data in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_7($footer_id, $facebookpage_title, $facebookpage_text, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $facebookpage_title);
	    $result->bindParam(2, $facebookpage_text);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update facebook page data in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_8($footer_id, $blog_title, $blog_page, $blog_category, $blog_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$arr     = array($blog_page,$blog_category,$blog_total);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $blog_title);
	    $result->bindParam(2, $value);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update blogs data for specific page in ".strtolower($fname)." primary footer.";
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
    public function update_primary_footer_9($footer_id, $tour_title, $tour_page, $tour_total, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";

    	$arr     = array($tour_page,$tour_total);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $tour_title);
	    $result->bindParam(2, $value);
		$result->bindParam(3, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
			$history_detail = " update tour package data for specific page in ".strtolower($fname)." primary footer.";
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
    public function view_total_instafeed() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerType = 'instafeed'");
	    $total  = $result->rowCount();
		return $total;
    }
    public function delete_primary_footer($footer_id, $admin_login_id, $now_date) {
    	if($footer_id == "1") 
    		$fname = "First Column";
    	elseif($footer_id == "2")
    		$fname = "Second Column";
    	elseif($footer_id == "3")
    		$fname = "Third Column";
    	elseif($footer_id == "4")
    		$fname = "Fourth Column";
    	$value = "";
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
    		cr_footerType      = ?,
    		cr_footerTitle     = ?,
    		cr_footerContent   = ? 
    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $value);
	    $result->bindParam(2, $value);
	    $result->bindParam(3, $value);
		$result->bindParam(4, $footer_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete $fname Primary Footer Data', ?, ?, ?)");
			$history_detail = " delete ".strtolower($fname)." primary footer data.";
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