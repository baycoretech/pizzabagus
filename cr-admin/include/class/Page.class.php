<?php
/**
 * Class Page
 *
 * @author baycore
 */

class Page {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_page($title) {
        $check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$title'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$title'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$title'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
    }
    public function view_page_title($title) {
        $check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$title'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$title'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_submenuTitle;
            return $menu_title;
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$title'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_menuTitle;
            return $menu_title;
        }
    }
    public function view_page_general($title) {
        $check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$title'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate, cr_general WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = cr_general.cr_generalLink AND cr_submenu.cr_submenuLink = '$title'");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                $rows = $result->fetch(PDO::FETCH_OBJ);
                return $rows;
            }
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate, cr_general WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = cr_general.cr_generalLink AND cr_menu.cr_menuLink = '$title'");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                $rows = $result->fetch(PDO::FETCH_OBJ);
                return $rows;
            }
        }
    }
    public function add_page_general_1($pagetitle, $pagetitle_id, $column1, $column1_id, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date) {
        $menu_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
        if($menu_query->rowCount() < 1) {
            $submenu_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
            $submenu_fetch = $submenu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $submenu_query->cr_submenuTitle;
        }
        else {
            $menu_fetch = $menu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $menu_fetch->cr_menuTitle;
        }
        $check = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$link'");
        if(($check->rowCount() < 1)) {
            $result = $this->pdo->prepare("INSERT INTO cr_general(
                        cr_generalTitle, cr_generalColumn1, cr_generalFeaturedimage, cr_generalMetakeywords, cr_generalMetadescription, cr_generalPostdate, cr_generalLink, cr_adminID, cr_generalTitle_id, cr_generalColumn1_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $result->bindParam(1, ucwords($pagetitle));
            $result->bindParam(2, $column1);
            $result->bindParam(3, $photo);
            $result->bindParam(4, $metakeywords);
            $result->bindParam(5, $metadesc);
            $result->bindParam(6, $now_date);
            $result->bindParam(7, $link);
            $result->bindParam(8, $admin_login_id);
            $result->bindParam(9, ucwords($pagetitle_id));
            $result->bindParam(10, $column1_id);
            if($result->execute()) {
                $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Data to Page $menu_title', ?, ?, ?)");

                $history_detail = " add data to page ".$menu_title.".";
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
            $same_page = 'same';
            return $same_page;
        }
    }
    public function add_page_general_2($pagetitle, $pagetitle_id, $column1, $column2, $column1_id, $column2_id, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date) {
        $menu_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
        if($menu_query->rowCount()<1) {
            $submenu_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
            $submenu_fetch = $submenu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $submenu_fetch->cr_submenuTitle;
        }
        else {
            $menu_fetch = $menu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $menu_fetch->cr_menuTitle;
        }
        $check = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$link'");
        if(($check->rowCount() < 1)) {
            $result = $this->pdo->prepare("INSERT INTO cr_general(
                        cr_generalTitle, cr_generalColumn1, cr_generalColumn2, cr_generalFeaturedimage, cr_generalMetakeywords, cr_generalMetadescription, cr_generalPostdate, cr_generalLink, cr_adminID, cr_generalTitle_id, cr_generalColumn1_id, cr_generalColumn2_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $result->bindParam(1, ucwords($pagetitle));
            $result->bindParam(2, $column1);
            $result->bindParam(3, $column2);
            $result->bindParam(4, $photo);
            $result->bindParam(5, $metakeywords);
            $result->bindParam(6, $metadesc);
            $result->bindParam(7, $now_date);
            $result->bindParam(8, $link);
            $result->bindParam(9, $admin_login_id);
            $result->bindParam(10, ucwords($pagetitle_id));
            $result->bindParam(11, $column1_id);
            $result->bindParam(12, $column2_id);
            if($result->execute()) {
                $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Data to Page $menu_title', ?, ?, ?)");

                $history_detail = " add data to page ".$menu_title.".";
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
            $same_page = 'same';
            return $same_page;
        }
    }
    public function add_page_general_3($pagetitle, $pagetitle_id, $column1, $column2, $column3, $column1_id, $column2_id, $column3_id, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date) {
        $menu_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
        if($menu_query->rowCount()<1) {
            $submenu_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
            $submenu_fetch = $submenu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $submenu_fetch->cr_submenuTitle;
        }
        else {
            $menu_fetch = $menu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $menu_fetch->cr_menuTitle;
        }
        $check = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$link'");
        if(($check->rowCount() < 1)) {
            $result = $this->pdo->prepare("INSERT INTO cr_general(
                        cr_generalTitle, cr_generalColumn1, cr_generalColumn2, cr_generalColumn3, cr_generalFeaturedimage, cr_generalMetakeywords, cr_generalMetadescription, cr_generalPostdate, cr_generalLink, cr_adminID, cr_generalTitle_id, cr_generalColumn1_id, cr_generalColumn2_id, cr_generalColumn3_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $result->bindParam(1, ucwords($pagetitle));
            $result->bindParam(2, $column1);
            $result->bindParam(3, $column2);
            $result->bindParam(4, $column3);
            $result->bindParam(5, $photo);
            $result->bindParam(6, $metakeywords);
            $result->bindParam(7, $metadesc);
            $result->bindParam(8, $now_date);
            $result->bindParam(9, $link);
            $result->bindParam(10, $admin_login_id);
            $result->bindParam(11, $pagetitle_id);
            $result->bindParam(12, $column1_id);
            $result->bindParam(13, $column2_id);
            $result->bindParam(14, $column3_id);
            if($result->execute()) {
                $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Data to Page $menu_title', ?, ?, ?)");

                $history_detail = " add data to page ".$menu_title.".";
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
            $same_page = 'same';
            return $same_page;
        }
    }
    public function edit_page_general($pagegeneral_id) {
        $result = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID = '$pagegeneral_id'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    public function update_page_general_1($pagetitle, $pagetitle_id, $column1, $column1_id, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date, $pagegeneral_idh) {
        $menu_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'"); 
        if($menu_query->rowCount()<1) {
            $submenu_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
            $submenu_fetch = $submenu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $submenu_fetch->cr_submenuTitle;
        }
        else {
            $menu_fetch = $menu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $menu_fetch->cr_menuTitle;
        }
        
        $result = $this->pdo->prepare("UPDATE cr_general SET 
            cr_generalTitle           = ?, 
            cr_generalColumn1         = ?, 
            cr_generalFeaturedimage   = ?,  
            cr_generalMetakeywords    = ?,
            cr_generalMetadescription = ?,
            cr_generalModifieddate    = ?,
            cr_generalLink            = ?,
            cr_adminID                = ?, 
            cr_generalTitle_id        = ?, 
            cr_generalColumn1_id      = ? 
            WHERE cr_generalID        = ?");    
        $result->bindParam(1, ucwords($pagetitle));
        $result->bindParam(2, $column1);
        $result->bindParam(3, $photo);
        $result->bindParam(4, $metakeywords);
        $result->bindParam(5, $metadesc);
        $result->bindParam(6, $now_date);
        $result->bindParam(7, $link);
        $result->bindParam(8, $admin_login_id);
        $result->bindParam(9, ucwords($pagetitle_id));
        $result->bindParam(10, $column1_id);
        $result->bindParam(11, $pagegeneral_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Data in Page $menu_title', ?, ?, ?)");
            $history_detail = " edit data in page ".$menu_title.".";
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
    public function update_page_general_2($pagetitle, $pagetitle_id,  $column1, $column2, $column1_id, $column2_id, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date, $pagegeneral_idh) {
        $menu_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
        if($menu_query->rowCount()<1) {
            $submenu_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
            $submenu_fetch = $submenu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $submenu_fetch->cr_submenuTitle;
        }
        else {
            $menu_fetch = $menu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $menu_fetch->cr_menuTitle;
        }

        $result = $this->pdo->prepare("UPDATE cr_general SET 
            cr_generalTitle           = ?, 
            cr_generalColumn1         = ?, 
            cr_generalColumn2         = ?, 
            cr_generalFeaturedimage   = ?,  
            cr_generalMetakeywords    = ?,
            cr_generalMetadescription = ?,
            cr_generalModifieddate    = ?,
            cr_generalLink            = ?,
            cr_adminID                = ?, 
            cr_generalTitle_id        = ?, 
            cr_generalColumn1_id      = ?, 
            cr_generalColumn2_id      = ? 
            WHERE cr_generalID        = ?");    
        $result->bindParam(1, ucwords($pagetitle));
        $result->bindParam(2, $column1);
        $result->bindParam(3, $column2);
        $result->bindParam(4, $photo);
        $result->bindParam(5, $metakeywords);
        $result->bindParam(6, $metadesc);
        $result->bindParam(7, $now_date);
        $result->bindParam(8, $link);
        $result->bindParam(9, $admin_login_id);
        $result->bindParam(10, ucwords($pagetitle_id));
        $result->bindParam(11, $column1_id);
        $result->bindParam(12, $column2_id);
        $result->bindParam(13, $pagegeneral_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Data in Page $menu_title', ?, ?, ?)");
            $history_detail = " edit data in page ".$menu_title.".";
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
    public function update_page_general_3($pagetitle, $pagetitle_id, $column1, $column2, $column3, $column1_id, $column2_id, $column3_id, $photo, $metakeywords, $metadesc, $link, $admin_login_id, $now_date, $pagegeneral_idh) {
        $menu_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
        if($menu_query->rowCount()<1) {
            $submenu_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
            $submenu_fetch = $submenu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $submenu_fetch->cr_submenuTitle;
        }
        else {
            $menu_fetch = $menu_query->fetch(PDO::FETCH_OBJ);
            $menu_title = $menu_fetch->cr_menuTitle;
        }

        $result = $this->pdo->prepare("UPDATE cr_general SET 
            cr_generalTitle           = ?, 
            cr_generalColumn1         = ?, 
            cr_generalColumn2         = ?, 
            cr_generalColumn3         = ?, 
            cr_generalFeaturedimage   = ?,  
            cr_generalMetakeywords    = ?,
            cr_generalMetadescription = ?,
            cr_generalModifieddate    = ?,
            cr_generalLink            = ?,
            cr_adminID                = ?, 
            cr_generalTitle_id        = ?, 
            cr_generalColumn1_id      = ?, 
            cr_generalColumn2_id      = ?, 
            cr_generalColumn3_id      = ? 
            WHERE cr_generalID        = ?");    
        $result->bindParam(1, ucwords($pagetitle));
        $result->bindParam(2, $column1);
        $result->bindParam(3, $column2);
        $result->bindParam(4, $column3);
        $result->bindParam(5, $photo);
        $result->bindParam(6, $metakeywords);
        $result->bindParam(7, $metadesc);
        $result->bindParam(8, $now_date);
        $result->bindParam(9, $link);
        $result->bindParam(10, $admin_login_id);
        $result->bindParam(11, ucwords($pagetitle_id));
        $result->bindParam(12, $column1_id);
        $result->bindParam(13, $column2_id);
        $result->bindParam(14, $column3_id);
        $result->bindParam(15, $pagegeneral_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Data in Page $menu_title', ?, ?, ?)");
            $history_detail = " edit data in page ".$menu_title.".";
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
    public function delete_featured_image($page_id) {
        $value  = ''; 
        $result = $this->pdo->prepare("UPDATE cr_general SET 
                    cr_generalFeaturedimage = ? 
                    WHERE cr_generalID      = ?");  
        $result->bindParam(1, $value);
        $result->bindParam(2, $page_id);
        if($result->execute()) {
            return true;
        }
        else {
            return false;
        }
    }
    public function view_page_featured($title) {
        $check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$title'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate, cr_featured WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = cr_featured.cr_featuredPage AND cr_submenu.cr_submenuLink = '$title' AND cr_featured.cr_featuredPage = '$title'");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                $rows = $result->fetch(PDO::FETCH_OBJ);
                return $rows;
            }
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate, cr_featured WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = cr_featured.cr_featuredPage AND cr_menu.cr_menuLink = '$title' AND cr_featured.cr_featuredPage = '$title'");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                $rows = $result->fetch(PDO::FETCH_OBJ);
                return $rows;
            }
        }
    }
    public function add_featured($desc, $photo, $link, $admin_login_id, $now_date) {
        $check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$link'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_submenuTitle;
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$link'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_menuTitle;
        }

        $result = $this->pdo->prepare("INSERT INTO cr_featured(
                        cr_featuredDesc, cr_featuredImage, cr_featuredPage) VALUES (?, ?, ?)");
        $result->bindParam(1, $desc);
        $result->bindParam(2, $photo);
        $result->bindParam(3, $link);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Featured Content', ?, ?, ?)");

            $history_detail = " add new featured content to page ".$menu_title.".";
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
    public function edit_page_featured($page) {
        $result = $this->pdo->query("SELECT * FROM cr_featured WHERE cr_featuredPage = '$page' LIMIT 1");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    public function update_page_featured($desc, $photo, $link, $admin_login_id, $now_date, $page_id) {
        $check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$link'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_submenuTitle;
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$link'");
            $rows = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_menuTitle;
        }

        $result = $this->pdo->prepare("UPDATE cr_featured SET 
            cr_featuredDesc           = ?, 
            cr_featuredImage          = ?
            WHERE cr_featuredID       = ?");    
        $result->bindParam(1, $desc);
        $result->bindParam(2, $photo);
        $result->bindParam(3, $page_id);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Featured Content', ?, ?, ?)");
            $history_detail = " update featured content to page ".$menu_title.".";
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