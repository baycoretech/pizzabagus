<?php
/**
 * Class Appearance
 *
 * @author baycore
 */

class Appearance {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
	public function get_theme() {
	    $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'template'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
	}
    public function view_fonts() {
        $result = $this->pdo->query("SELECT * FROM cr_fonts ORDER BY cr_fontsID asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_favicon() {
        $check = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'favicon'");
        $rows  = $check->fetch(PDO::FETCH_OBJ);
        if($rows->cr_settingValue == '' || empty($rows->cr_settingValue)) {
            return false;
        }
        else {
            return $rows;   
        }
    }
    public function view_logo() {
        $check = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'websitelogo'");
        $rows = $check->fetch(PDO::FETCH_OBJ);
        if($rows->cr_settingValue=="" || empty($rows->cr_settingValue)) {
            return false;
        }
        else {
            return $rows;   
        }
    }
    public function edit_logo() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'websitelogo'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function update_logo($photo, $admin_login_id, $now_date) {
        $cekValue_q  = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'websitelogo'"); 
        $cekValue_f  = $cekValue_q->fetch(PDO::FETCH_OBJ);
        $cekValue    = $cekValue_f->cr_settingValue;
        $settingname = "websitelogo";
        $image       = str_replace(MADMINURL."../cr-editor/_thumbs/Images/","",$photo);
        if($cekValue=="" || empty($cekValue)) {
            $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue    = ?
                WHERE cr_settingName = ?"); 
            $result->bindParam(1, $image);
            $result->bindParam(2, $settingname);
            if($result->execute()) {
                $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                                cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Website Logo', ?, ?, ?)");
                $history_detail = " add new logo to your website.";
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
            $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue    = ?
                WHERE cr_settingName = ?"); 
            $result->bindParam(1, $image);
            $result->bindParam(2, $settingname);
            if($result->execute()) {
                $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                                cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Website Logo', ?, ?, ?)");
                $history_detail = " change the website logo.";
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
    public function delete_logo($admin_login_id, $now_date) {
        $setting_value = "";
        $setting_name  = "websitelogo";

        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue    = ?
                WHERE cr_settingName = ?"); 
        $result->bindParam(1, $setting_value);
        $result->bindParam(2, $setting_name);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                        cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Website Logo', ?, ?, ?)");
            $history_detail = " delete the website logo.";
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
    public function view_invoice_logo() {
        $check = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'invoicelogo'");
        $rows = $check->fetch(PDO::FETCH_OBJ);
        if($rows->cr_settingValue=="" || empty($rows->cr_settingValue)) {
            return false;
        }
        else {
            return $rows;   
        }
    }
    public function delete_invoice_logo($admin_login_id, $now_date) {
        $setting_value = "";
        $setting_name  = "invoicelogo";

        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue    = ?
                WHERE cr_settingName = ?"); 
        $result->bindParam(1, $setting_value);
        $result->bindParam(2, $setting_name);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                        cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Invoice Logo', ?, ?, ?)");
            $history_detail = " delete the invoice logo.";
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
    public function edit_favicon() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'favicon'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function update_favicon($photo, $admin_login_id, $now_date) {
        $check_q  = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'favicon'"); 
        $check_f  = $check_q->fetch(PDO::FETCH_OBJ);
        $check    = $check_f->cr_settingValue;
        $setting_name = "favicon";
        $image        = str_replace(MADMINURL."../cr-editor/_thumbs/Images/","",$photo);
        if($check == '' || empty($check)) {
            $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue      = ?
                WHERE cr_settingName = ?"); 
            $result->bindParam(1, $image);
            $result->bindParam(2, $setting_name);
            if($result->execute()) {
                $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                                cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Favicon', ?, ?, ?)");
                $history_detail = " add new favicon to your website.";
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
            $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue      = ?
                WHERE cr_settingName = ?"); 
            $result->bindParam(1, $image);
            $result->bindParam(2, $setting_name);
            if($result->execute()) {
                $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                                cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Website Favicon', ?, ?, ?)");
                $history_detail = " change the website favicon.";
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
    public function delete_favicon($admin_login_id, $now_date) {
        $setting_value = '';
        $setting_name  = 'favicon';

        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue    = ?
                WHERE cr_settingName = ?"); 
        $result->bindParam(1, $setting_value);
        $result->bindParam(2, $setting_name);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Favicon', ?, ?, ?)");
            $history_detail = " delete the website favicon.";
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
    public function check_fonts($applied) {
        $result = $this->pdo->query("SELECT * FROM cr_fonts WHERE cr_fontsApplied = '$applied' ORDER BY cr_fontsID asc");
        $total  = $result->rowCount();
        return $total;
    }
    public function check_update_fonts($applied, $font_id) {
        $result = $this->pdo->query("SELECT * FROM cr_fonts WHERE cr_fontsApplied = '$applied' AND cr_fontsID <> '$font_id' ORDER BY cr_fontsID asc");
        $total  = $result->rowCount();
        return $total;
    }
    public function add_font($name, $link, $family, $applied, $admin_login_id, $now_date) {
        $result = $this->pdo->prepare("INSERT INTO cr_fonts(
                        cr_fontsName, cr_fontsLink, cr_fontsFamily, cr_fontsApplied) VALUES (?, ?, ?, ?)");
        $result->bindParam(1, $name);
        $result->bindParam(2, $link);
        $result->bindParam(3, $family);
        $result->bindParam(4, $applied);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Font', ?, ?, ?)");

            $history_detail = " add $name to font list.";
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
    public function edit_font($font_id) {
        $result = $this->pdo->query("SELECT * FROM cr_fonts WHERE cr_fontsID = '$font_id'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
     public function update_font($name, $link, $family, $applied, $admin_login_id, $now_date, $font_idh) {
        $result = $this->pdo->prepare("UPDATE cr_fonts SET 
                cr_fontsName        = ?, 
                cr_fontsLink        = ?, 
                cr_fontsFamily      = ?,
                cr_fontsApplied     = ?  
                WHERE cr_fontsID    = ?");  
        $result->bindParam(1, $name);
        $result->bindParam(2, $link);
        $result->bindParam(3, $family);
        $result->bindParam(4, $applied);
        $result->bindParam(5, $font_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                    cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Font', ?, ?, ?)");
            $history_detail = " edit $name in font list.";
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
    public function delete_font($font_id, $admin_login_id, $now_date) {
        $check_query = $this->pdo->query("SELECT * FROM cr_fonts WHERE cr_fontsID = '$font_id'");
        $check_fetch = $check_query->fetch(PDO::FETCH_OBJ);
        $font_name   = $check_fetch->cr_fontsName;
        $result = $this->pdo->prepare("DELETE FROM cr_fonts WHERE cr_fontsID = ?");
        $result->bindParam(1, $font_id);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Font', ?, ?, ?)");
            $history_detail = " delete $font_name from font list.";
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
    public function update_color_scheme($value, $custom_primary, $custom_secondary, $admin_login_id, $now_date) {
        if(empty($custom_primary)) {
            $custom_primary == 'none';
        }

        if(empty($custom_secondary)) {
            $custom_secondary == 'none';
        }

        $settingname = "colorscheme";
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result->bindParam(1, $value);
        $result->bindParam(2, $settingname);

        $settingprimary   = "customprimary";
        $settingsecondary = "customsecondary";

        $result2 = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result2->bindParam(1, $custom_primary);
        $result2->bindParam(2, $settingprimary);

        $result3 = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result3->bindParam(1, $custom_secondary);
        $result3->bindParam(2, $settingsecondary);

        if($result->execute() && $result2->execute() && $result3->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Color Scheme', ?, ?, ?)");
            $history_detail = " change color scheme to ".$value.".";
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