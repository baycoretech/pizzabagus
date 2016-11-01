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
        $check      = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$title'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$title'");
            $rows   = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$title'");
            $rows   = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
    }
    public function view_page_title($page) {
        $check      = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$page'");
            $rows   = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_submenuTitle;
            return $menu_title;
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$page'");
            $rows   = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_menuTitle;
            return $menu_title;
        }
    }
    public function view_page_title_id($page) {
        $check      = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page'");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$page'");
            $rows   = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_submenuTitle_id;
            return $menu_title;
        }
        else {
            $result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$page'");
            $rows   = $result->fetch(PDO::FETCH_OBJ);
            $menu_title = $rows->cr_menuTitle_id;
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
            $result    = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate, cr_general WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = cr_general.cr_generalLink AND cr_menu.cr_menuLink = '$title'");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                $rows  = $result->fetch(PDO::FETCH_OBJ);
                return $rows;
            }
        }
    }
    public function view_contact($page) {
        $result    = $this->pdo->query("SELECT * FROM cr_contact WHERE cr_contactLink = '$page' LIMIT 1");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            $rows  = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
    }
    public function send_contact($name, $email, $subject, $message, $now_date) {
        $read    = "0";
        $folder  = "inbox";
        $replied = "0";
        $tipe    = "message";
        $result  = $this->pdo->prepare("INSERT INTO cr_message(
                        cr_messageSubject, 
                        cr_messageContent, 
                        cr_messageName, 
                        cr_messageEmail, 
                        cr_messageDate,
                        cr_messageRead, 
                        cr_messageFolder, 
                        cr_messageReplied, 
                        cr_messageType) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $result->bindParam(1, $subject);
        $result->bindParam(2, $message);
        $result->bindParam(3, $name);
        $result->bindParam(4, $email);
        $result->bindParam(5, $now_date);
        $result->bindParam(6, $read);
        $result->bindParam(7, $folder);
        $result->bindParam(8, $replied);
        $result->bindParam(9, $tipe);
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
            $result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate, cr_featured WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = cr_featured.cr_featuredPage AND cr_submenu.cr_submenuLink = '$title'");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                $rows = $result->fetch(PDO::FETCH_OBJ);
                return $rows;
            }
        }
        else {
            $result    = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate, cr_featured WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = cr_featured.cr_featuredPage AND cr_menu.cr_menuLink = '$title'");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                $rows  = $result->fetch(PDO::FETCH_OBJ);
                return $rows;
            }
        }
    }
}
?>