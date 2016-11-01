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
    public function view_settings_clients_partners() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'clientspartners'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_quotes_title() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'quotestitle'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_services_title() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'servicestitle'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_clients_title() {
        $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'clientstitle'");
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
    public function view_settings_quotes_in_page() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'quotesinpage'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_services_in_page() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'servicesinpage'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_clients_partners_in_page() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'clientspartnersinpage'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
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
    public function view_settings_fourth_column_pf() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'footer-column4'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_e_commerce() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'e-commerce'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_custom_home_content() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'customhomecontent'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_tax_payment() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'taxpayment'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_shipping_origin() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'shippingorigin'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_featured_product_system() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'featuredproductsystem'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_topseller_product_system() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'topsellerproductsystem'");
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
    public function view_settings_price_format() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'priceformat'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_font_color() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'fontcolor'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
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
    public function view_settings_homepage_style() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'homepagestyle'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_layout_mode() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'layoutmode'");
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
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_position() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundposition'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_attachment() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundattachment'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_size() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundsize'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_background_login() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundlogin'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_instafeed_user_id() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'instafeeduserid'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_instafeed_access_token() {
        $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'instafeedaccesstoken'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_settings_instafeed_limit() {
        $result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerType = 'instafeed' LIMIT 1");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows->cr_footerContent;
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
    public function view_settings_order_status() {
        $open_q = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'openorder'");
        $open_r = $open_q->fetch(PDO::FETCH_OBJ);
        $open_time = $open_r->cr_settingValue;

        $close_q = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'closeorder'");
        $close_r = $close_q->fetch(PDO::FETCH_OBJ);
        $close_time = $close_r->cr_settingValue;

        $open  = str_replace(":", "", substr($open_time, 0, 5));
        $close = str_replace(":", "", substr($close_time, 0, 5));
        return $open.','.$close;
    }
}
?>