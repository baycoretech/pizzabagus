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
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    if(empty($rows->cr_footerType)) {
	    	return false;
	    }
	    else {
	    	return $rows;
    	}
    }
    public function view_primary_footer_2() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column2'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    if(empty($rows->cr_footerType)) {
	    	return false;
	    }
	    else {
	    	return $rows;
    	}
    }
    public function view_primary_footer_3() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column3'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    if(empty($rows->cr_footerType)) {
	    	return false;
	    }
	    else {
	    	return $rows;
    	}
    }
    public function view_primary_footer_4() {
        $result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column4'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        if(empty($rows->cr_footerType)) {
            return false;
        }
        else {
            return $rows;
        }
    }
    public function view_latest_portfolio($pc_id, $limit) {
        if($pc_id == 0) {
            $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfolioStatus='publish' AND cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID ORDER BY cr_portfolio.cr_portfolioDate desc LIMIT $limit");
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = '$pc_id' AND cr_portfolio.cr_portfolioStatus='publish' AND cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID ORDER BY cr_portfolio.cr_portfolioDate desc LIMIT $limit");
        }
	    if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_latest_gallery($limit) {
    	$result = $this->pdo->query("SELECT * FROM cr_gallery ORDER BY cr_galleryDate desc LIMIT $limit");
	    if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_blogs_in_menu_and_submenu($page, $cat, $limit) {
        $position  = substr($page, 0, 1);
        $blogpid   = substr($page, 1);
        if($position == "m") {
            if($cat == 0) {
                $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_menu WHERE cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_menu.cr_menuID = '$blogpid' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blog.cr_blogID desc LIMIT $limit ");
            }
            else {
                $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_menu WHERE cr_blog.cr_blogcategoryID = '$cat' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_menu.cr_menuID = '$blogpid' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blog.cr_blogID desc LIMIT $limit ");
            }
        }
        elseif($position == "s") {
            if($cat == 0) {
                $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_submenu WHERE cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_submenu.cr_submenuID = '$blogpid'  AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_blog.cr_blogID desc LIMIT $limit ");
            }
            else {
                $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_submenu WHERE cr_blog.cr_blogcategoryID = '$cat' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_submenu.cr_submenuID = '$blogpid' AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_blog.cr_blogID desc LIMIT $limit ");
            }
        }
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_primary_footer_tour_page($position, $page) {
        if($position == "menu") {
            $result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$page'");
            $row    = $result->fetch(PDO::FETCH_OBJ);
            return $row->cr_menuLink;
        }
        elseif($position == "submenu") {
            $result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuID = '$page'");
            $row    = $result->fetch(PDO::FETCH_OBJ);
            return $row->cr_submenuLink;
        }
    }
    public function view_tours_in_menu_and_submenu($position, $page, $limit) {
        $tour_page = $position.','.$page;
        if($position == "menu") {
            $result = $this->pdo->query("SELECT * FROM cr_tour, cr_menu WHERE cr_tour.cr_tourPage = '$tour_page' AND cr_menu.cr_menuID = '$page' ORDER BY cr_tour.cr_tourID desc LIMIT $limit ");
        }
        elseif($position == "submenu") {
            $result = $this->pdo->query("SELECT * FROM cr_tour, cr_submenu WHERE cr_tour.cr_tourPage = '$tour_page' AND cr_submenu.cr_submenuID = '$page' ORDER BY cr_tour.cr_tourID desc LIMIT $limit ");
        }
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_settings_fourth_column_pf() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'footer-column4'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}
?>