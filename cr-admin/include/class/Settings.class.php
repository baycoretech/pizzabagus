<?php
/**
 * Class Settings
 *
 * @author baycore
 */

class Settings {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function user_plan() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'userplan'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows->cr_settingValue;
    }
    public function disk_size_bytes() {
        $get_folder_name_q = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
        $get_folder_name_q->execute();
        $get_folder_name_f = $get_folder_name_q->fetch(PDO::FETCH_OBJ);
        $get_folder_name   = $get_folder_name_f->cr_settingValue;
        if($get_folder_name_f->cr_settingValue == '') {
            $bytes_size = get_directory_size($_SERVER['DOCUMENT_ROOT']);
            return $bytes_size; 
        }
        else {
            $bytes_size = get_directory_size($_SERVER['DOCUMENT_ROOT']."/".$get_folder_name);
            return $bytes_size; 
        }
    }
    public function disk_size() {
        $get_folder_name_q = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
        $get_folder_name_q->execute();
        $get_folder_name_f = $get_folder_name_q->fetch(PDO::FETCH_OBJ);
        $get_folder_name   = $get_folder_name_f->cr_settingValue;
        if($get_folder_name_f->cr_settingValue == "") {
            $bytes_size = get_directory_size($_SERVER['DOCUMENT_ROOT']);
            $totalsize = format_bytes($bytes_size);
            return $totalsize; 
        }
        else {
            $bytes_size = get_directory_size($_SERVER['DOCUMENT_ROOT']."/".$get_folder_name);
            $totalsize = format_bytes($bytes_size);
            return $totalsize; 
        }
    }
    public function disk_size_specific_folder($path) {
        $get_folder_name_q = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
        $get_folder_name_q->execute();
        $get_folder_name_f = $get_folder_name_q->fetch(PDO::FETCH_OBJ);
        $get_folder_name   = $get_folder_name_f->cr_settingValue;
        if($get_folder_name_f->cr_settingValue == "") {
            $bytes_size = get_directory_size($_SERVER['DOCUMENT_ROOT']."/".$path);
            $totalsize = format_bytes($bytes_size);
            return $totalsize; 
        }
        else {
            $bytes_size = get_directory_size($_SERVER['DOCUMENT_ROOT']."/".$get_folder_name."/".$path);
            $totalsize = format_bytes($bytes_size);
            return $totalsize; 
        }
    }
    public function view_settings_sitename() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'sitename'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_tagline() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'tagline'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_email() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'email'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_phone() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'phone'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_address() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'address'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_metakeywords() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'metakeywords'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_metadesc() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'metadescription'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_timezone() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'timezone'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_date_format() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'dateformat'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_time_format() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'timeformat'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_recaptcha_sitekey() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'recaptchasitekey'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_recaptcha_secret() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'recaptchasecret'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_apimap() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'googlemapapi'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_analytics() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'googleanalyticscode'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_homepage_link() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'homepagelink'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_date_time_maintenance() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'datetimemaintenance'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_open_order() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'openorder'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_close_order() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'closeorder'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_gosmsgateway_username() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'gosmsgatewayusername'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_gosmsgateway_password() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'gosmsgatewaypassword'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    //Appearance
    public function view_settings_homepage_style() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'homepagestyle'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_color_scheme() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'colorscheme'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_custom_primary() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'customprimary'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_custom_secondary() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'customsecondary'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_fourth_column_pf() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'footer-column4'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_quotes_title() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'quotestitle'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_services_title() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'servicestitle'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_clients_title() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'clientstitle'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_login() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundlogin'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_template() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundtemplate'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_repeat() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundrepeat'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_position() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundposition'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_attachment() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundattachment'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_size() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundsize'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_favicon() {
        $check = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'favicon'");
        $rows  = $check->fetch(PDO::FETCH_OBJ);
        if($rows->cr_settingValue == "" || empty($rows->cr_settingValue)) {
            $alert = 0;
            return $alert;
        }
        else {
            return $rows;   
        }
    }
    public function view_settings_layout_mode() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'layoutmode'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_coming_soon() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'comingsoon'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_maintenance() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'datetimemaintenance'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function update_settings($value, $setting_name, $admin_login_id, $setting_idh, $now_date) {
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingID = ?");   
        $result->bindParam(1, $value);
        $result->bindParam(2, $setting_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Setting Value', ?, ?, ?)");
            $history_detail = " edit ".strtolower($settingname)." setting value to ".$value.".";
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
    public function enable_maintenance($admin_login_id, $setting_idh, $now_date) {
        $value  = "enable";
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingID = ?");   
        $result->bindParam(1, $value);
        $result->bindParam(2, $setting_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Setting Value', ?, ?, ?)");
            $history_detail = " edit maintenance mode setting value to ".$value.".";
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
    public function update_google_analytics_code($value, $setting_name, $admin_login_id, $setting_idh, $now_date) {
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingID = ?");   
        $result->bindParam(1, $value);
        $result->bindParam(2, $setting_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Google Analytics Code', ?, ?, ?)");
            $history_detail = " edit Google Analytics Code setting value to ".$value.".";
            $get_history->bindParam(1, $history_detail);
            $get_history->bindParam(2, $NowDate);
            $get_history->bindParam(3, $admin_login_idd);
            $get_history->execute();
            return true;
        }
        else {
            return false;
        }
    }
    public function update_settings_homepage_link($value, $admin_login_id, $now_date) {
        $setting_name = "homepagelink";
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result->bindParam(1, $value);
        $result->bindParam(2, $setting_name);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                                cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Show/Hide Home Page Link  ', ?, ?, ?)");
            $history_detail = " change home page link to ".$value.".";
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
    public function update_settings_theme($theme_folder, $theme_name, $admin_login_id, $now_date) {
        $setting_name = "template";
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result->bindParam(1, $theme_folder);
        $result->bindParam(2, $setting_name);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Website Theme', ?, ?, ?)");
            $history_detail = " change website theme to ".$theme_name.".";
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
    public function update_settings_layout_mode($mode, $admin_login_id, $now_date) {
        $setting_name = "layoutmode";
        $result = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result->bindParam(1, $mode);
        $result->bindParam(2, $setting_name);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Website Layout Mode', ?, ?, ?)");
            $history_detail = " change website layout mode to ".$mode.".";
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
    public function update_settings_background_option($bg_repeat, $bg_position, $bg_attachment, $bg_size, $admin_login_id, $now_date) {
        $setting_bg_repeat     = "backgroundrepeat";
        $setting_bg_position   = "backgroundposition";
        $setting_bg_attachment = "backgroundattachment";
        $setting_bg_size       = "backgroundsize";

        $result_bg_repeat = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result_bg_repeat->bindParam(1, $bg_repeat);
        $result_bg_repeat->bindParam(2, $setting_bg_repeat);

        $result_bg_position = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result_bg_position->bindParam(1, $bg_position);
        $result_bg_position->bindParam(2, $setting_bg_position);

        $result_bg_attachment = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result_bg_attachment->bindParam(1, $bg_attachment);
        $result_bg_attachment->bindParam(2, $setting_bg_attachment);

        $result_bg_size = $this->pdo->prepare("UPDATE cr_setting SET 
                cr_settingValue  = ?
                WHERE cr_settingName = ?"); 
        $result_bg_size->bindParam(1, $bg_size);
        $result_bg_size->bindParam(2, $setting_bg_size);

        if($result_bg_repeat->execute() && $result_bg_position->execute() && $result_bg_attachment->execute() && $result_bg_size->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Website Background Image Option', ?, ?, ?)");
            $history_detail = " change website background image option.";
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