<?php
/**
 * Data Class
 *
 * @author baycore
 */

require_once "global-function.php";//global function
require_once "class-db.php";//global function

$o_getTimezone = new setTimezone($pdo);
$v_setTimezone = $o_getTimezone->setTimezone();

//set default timezone
$getCity       = substr($v_setTimezone->cr_settingValue, 12);
if(!empty($v_setTimezone->cr_settingValue)) {
    date_default_timezone_set($getCity);
}
$dateforNow = new DateTime();
$dateforNow->setTimezone(new DateTimeZone($getCity));

global $NowDate;
$NowDate = $dateforNow->format('Y-m-d H:i:s'); // same format as NOW()

class settings {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewSettingsUserplan() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'userplan'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function diskSizebytes() {
    	$getfoldername_q = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
	    $getfoldername_q->execute();
	    $getfoldername_f = $getfoldername_q->fetch(PDO::FETCH_OBJ);
	    $getfoldername   = $getfoldername_f->cr_settingValue;
	    if($getfoldername_f->cr_settingValue == "") {
	    	$bytessize = GetDirectorySize($_SERVER['DOCUMENT_ROOT']);
	    	return $bytessize; 
	    }
	    else {
	    	$bytessize = GetDirectorySize($_SERVER['DOCUMENT_ROOT']."/".$getfoldername);
	    	return $bytessize; 
	    }
    }
    public function diskSize() {
    	$getfoldername_q = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
	    $getfoldername_q->execute();
	    $getfoldername_f = $getfoldername_q->fetch(PDO::FETCH_OBJ);
	    $getfoldername   = $getfoldername_f->cr_settingValue;
	    if($getfoldername_f->cr_settingValue == "") {
	    	$bytessize = GetDirectorySize($_SERVER['DOCUMENT_ROOT']);
	    	$totalsize = formatBytes($bytessize);
	    	return $totalsize; 
	    }
	    else {
	    	$bytessize = GetDirectorySize($_SERVER['DOCUMENT_ROOT']."/".$getfoldername);
	    	$totalsize = formatBytes($bytessize);
	    	return $totalsize; 
	    }
    }
    public function viewSettingsTotalpage() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'totalpage'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsSitename() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'sitename'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsTagline() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'tagline'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsEmail() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'email'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsPhone() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'phone'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsAddress() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'address'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsMetakeywords() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'metakeywords'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsMetadesc() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'metadescription'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsQuotestitle() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'quotestitle'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsServicestitle() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'servicestitle'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsCP() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'clientspartners'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsTZ() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'timezone'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsDateformat() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'dateformat'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsTimeformat() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'timeformat'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsComingsoon() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'comingsoon'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsDatetimeMM() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'datetimemaintenance'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_settings_e_commerce() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'e-commerce'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsHomelink() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'homepagelink'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsreCaptchaSitekey() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'recaptchasitekey'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsreCaptchaSecret() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'recaptchasecret'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsAPIMap() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'googlemapapi'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsAnalyticsCode() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'googleanalyticscode'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsFourthColumnPF() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'footer-column4'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateSettings($value, $settingname, $adminLoginID, $settingIDh) {
    	global $NowDate;
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingID = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Setting Value', ?, ?, ?)");
		$historyDetail = " edit ".$settingname." setting value.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function enableMaintenance($adminLoginID, $settingIDh) {
    	global $NowDate;
    	$value  = "enable";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingID = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Setting Value', ?, ?, ?)");
		$historyDetail = " edit maintenance mode setting value.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateGoogleAnalyticsCode($value, $settingname, $adminLoginID, $settingIDh) {
    	global $NowDate;
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingID = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Google Analytics Code', ?, ?, ?)");
		$historyDetail = " edit Google Analytics Code setting value.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateSettingsHomepagelink($value, $adminLoginID) {
    	global $NowDate;
    	$settingname = "homepagelink";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Show/Hide Home Page Link  ', ?, ?, ?)");
		$historyDetail = " change home page link to $value.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    //Appearance
    public function viewSettingsUsedTheme() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'template'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsColorscheme() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'colorscheme'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsCustomPrimary() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'customprimary'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsCustomSecondary() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'customsecondary'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateSettingsColorscheme($value, $customprimary, $customsecondary, $adminLoginID) {
    	global $NowDate;
    	if(empty($customprimary)) {
    		$customprimary == 'none';
    	}

    	if(empty($customsecondary)) {
    		$customsecondary == 'none';
    	}

    	$settingname = "colorscheme";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname);
		$result->execute();

		$settingprimary   = "customprimary";
		$settingsecondary = "customsecondary";

		$result2 = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result2->bindParam(1, $customprimary);
		$result2->bindParam(2, $settingprimary);
		$result2->execute();

		$result3 = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result3->bindParam(1, $customsecondary);
		$result3->bindParam(2, $settingsecondary);
		$result3->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Color Scheme', ?, ?, ?)");
		$historyDetail = " change color scheme to ".$value.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function viewSettingsFontcolor() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'fontcolor'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateSettingsFontcolor($value, $adminLoginID) {
    	global $NowDate;
    	$settingname = "fontcolor";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Font Color', ?, ?, ?)");
		$historyDetail = " change font color to $value.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateSettingsTheme($themefolder, $themename, $adminLoginID) {
    	global $NowDate;
    	$settingname = "template";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $themefolder);
		$result->bindParam(2, $settingname);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Font Color', ?, ?, ?)");
		$historyDetail = " change website theme to ".$themename.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function viewSettingsHomepage() {
    	$result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'homepagestyle'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateSettingsHomepage($value, $adminLoginID) {
    	global $NowDate;
    	$settingname = "homepagestyle";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Homepage Style', ?, ?, ?)");
		$historyDetail = " change homepage style to $value style.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function viewSettingsLayoutmode() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'layoutmode'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsBgtemplate() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundtemplate'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsBgrepeat() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundrepeat'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsBgposition() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundposition'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsBgattachment() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundattachment'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewSettingsBgsize() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'backgroundsize'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateSettingsLayoutMode($value, $adminLoginID) {
    	global $NowDate;
    	$settingname = "layoutmode";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Layout Mode', ?, ?, ?)");
		$historyDetail = " change layout mode to $value.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editBgtemplate() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='backgroundtemplate'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateBgtemplate($photo, $adminLoginID) {
    	global $NowDate;
    	$cekValue_q  = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='backgroundtemplate'"); 
    	$cekValue_f  = $cekValue_q->fetch(PDO::FETCH_OBJ);
    	$cekValue    = $cekValue_f->cr_settingValue;
    	$settingname = "backgroundtemplate";
    	if($cekValue=="" || empty($cekValue)) {
    		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue    = ?
	    		WHERE cr_settingName = ?");	
		    $result->bindParam(1, $photo);
			$result->bindParam(2, $settingname);
			$result->execute();

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Background Image', ?, ?, ?)");
			$historyDetail = " add new background image to your website.";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
    	}
    	else {
	    	$check   = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='backgroundtemplate'");
	    	$check_f = $check->fetch(PDO::FETCH_OBJ);
	    	$namaPhoto  = $check_f->cr_settingValue;

	    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
	        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
	        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

	        $namaPhotoLink     = str_replace("/thumbnails","",$namaPhoto);
	        $namaPhotoGIFLink  = str_replace("/thumbnails","",$namaPhotoGIF);
	        $namaPhotoJPGLink  = str_replace("/thumbnails","",$namaPhotoJPG);
	        $namaPhotoJPEGLink = str_replace("/thumbnails","",$namaPhotoJPEG);

	    	$newbgimage = str_replace(MURL,"",$photo);
	    	if($namaPhoto!=$newbgimage) {
	    		if($namaPhoto!="/assets/img/no-pic-items.png") {
		    		//unlink thumbnail
		    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhoto);
		    		//unlink real image
		    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoLink);
		    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoGIFLink);
		    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPGLink);
		    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPEGLink);
		    	}
	    		$result = $this->pdo->prepare("UPDATE cr_setting SET 
		    		cr_settingValue    = ?
		    		WHERE cr_settingName = ?");	
			    $result->bindParam(1, $photo);
				$result->bindParam(2, $settingname);
				$result->execute();
	    	}

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Background Image', ?, ?, ?)");
			$historyDetail = " change the background image.";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
		}
    }
    public function removeBgtemplate($adminLoginID) {
    	global $NowDate;
    	$settingname  = "backgroundtemplate";
    	$settingname2 = "backgroundrepeat";
    	$settingname3 = "backgroundposition";
    	$settingname4 = "backgroundattachment";
    	$settingname5 = "backgroundsize";
    	$value       = "";
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname2);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname3);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname4);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue  = ?
	    		WHERE cr_settingName = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingname5);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Remove Background Image', ?, ?, ?)");
		$historyDetail = " remove current background image.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class globalFunction {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function siteURL() {
     	$getsiteurl_q = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'siteurl'");
	    $getsiteurl_q->execute();
	    $getsiteurl_f = $getsiteurl_q->fetch(PDO::FETCH_OBJ);
	    $getsiteurl   = $getsiteurl_f->cr_settingValue . $_SERVER['SERVER_NAME'];
	    return $getsiteurl;
	}
	public function folderName() {
     	$getfoldername_q = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
	    $getfoldername_q->execute();
	    $getfoldername_f = $getfoldername_q->fetch(PDO::FETCH_OBJ);
	    $getfoldername   = $getfoldername_f->cr_settingValue;
	    if($getfoldername_f->cr_settingValue == "") {
	    	$call = "0";
	    	return $call;
	    }
	    else {
	    	return $getfoldername;
	    }
	}
	public function totalVisitor() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor ORDER BY cr_visitorDate desc");
		$total = $result->rowCount();
		return $total;
	}
	public function totalPost() {
		$result = $this->pdo->query("SELECT * FROM cr_blog");
		$total = $result->rowCount();
		return $total;
	}
	public function totalPortpro() {
		$result = $this->pdo->query("SELECT * FROM cr_portfolio");
		$total = $result->rowCount();
		return $total;
	}
	public function totalVisitor1($min1date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min1date'");
		$total = $result->rowCount();
		return $total;
	}
	public function totalVisitor2($min2date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min2date'");
		$total = $result->rowCount();
		return $total;
	}
	public function totalVisitor3($min3date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min3date'");
		$total = $result->rowCount();
		return $total;
	}
	public function totalVisitor4($min4date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min4date'");
		$total = $result->rowCount();
		return $total;
	}
	public function totalVisitor5($min5date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min5date'");
		$total = $result->rowCount();
		return $total;
	}
	public function totalVisitor6($min6date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min6date'");
		$total = $result->rowCount();
		return $total;
	}
	public function totalVisitor7($min7date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min7date'");
		$total = $result->rowCount();
		return $total;
	}
}

class menu {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewMenu() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_menu ORDER BY cr_menuOrder asc");
    	if($cek->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_menu ORDER BY cr_menuOrder asc");
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewSubmenuinMenu($menu_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$menu_id'");
    	$total  = $result->rowCount();
		return $total;
    }
    public function viewMenuforParent() {
    	$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option <> 'customlink' ORDER BY cr_menuOrder asc");
    	if($result->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewSubmenu($menu) {
    	$menutitle_q = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$menu'");
    	$menutitle_f = $menutitle_q->fetch(PDO::FETCH_OBJ);
    	$menutitle   = $menutitle_f->cr_menuID;
    	$cek = $this->pdo->query("SELECT * FROM  cr_submenu WHERE cr_menuID = '$menutitle' ORDER BY cr_submenuID asc");
    	if($cek->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_submenu WHERE cr_menuID = '$menutitle' ORDER BY cr_submenuID asc");
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewMenusub($menu) {
    	$result = $this->pdo->query("SELECT * FROM  cr_submenu WHERE cr_menuID = '$menu' ORDER BY cr_submenuID asc");
    	if($result->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function viewPageTemplate() {
    	$result = $this->pdo->query("SELECT * FROM  cr_pagetemplate ORDER BY cr_pagetemplateID asc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    $data[]=$rows;
		return $data;
		
    }
    public function addMenu($title, $parent, $status, $pagetemplate, $option, $adminLoginID) {
    	global $NowDate;
    	$titleupper  = ucwords($title);
    	$titlelower  = create_slug($title); 
    	if(empty($option)) {
    		$option = "";
    	}
    	if(empty($parent)) {
	    	$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title'");
    		$checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title'");

	    	if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
		    	$getLastID_q = $this->pdo->query("SELECT LAST_INSERT_ID() FROM cr_menu");
		    	$getLastID_f = $getLastID_q->fetch(PDO::FETCH_OBJ);
		    	$getLastID   = $getLastID_f->cr_menuID+1;

			    $result = $this->pdo->prepare("INSERT INTO cr_menu(cr_menuTitle, cr_menuLink, cr_menuOrder, cr_menuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?)");
				$result->bindParam(1, $titleupper);
				$result->bindParam(2, $titlelower);
				$result->bindParam(3, $getLastID);
				$result->bindParam(4, $status);
				$result->bindParam(5, $pagetemplate);
				$result->bindParam(6, $option);
				$result->execute();

				$result = $this->pdo->query("SET @lastID = LAST_INSERT_ID()");
				$result = $this->pdo->query("UPDATE cr_menu SET cr_menuOrder = @lastID WHERE cr_menuID = @lastID;");

				if($status==1) {
					$str = "Publish";
				}
				elseif($status==0) {
					$str = "Unpublish";
				}

				$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Menu', ?, ?, ?)");
				$historyDetail = " add menu $titleupper ($str) to your website.";
				$getHistory->bindParam(1, $historyDetail);
				$getHistory->bindParam(2, $NowDate);
				$getHistory->bindParam(3, $adminLoginID);
				$getHistory->execute();
			}
			else {
		    	$samename = 1;
		    	return $samename;
		    }
		}
		else {
			$getMenuTitle_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$parent'");
		    $getMenuTitle_f = $getMenuTitle_q->fetch(PDO::FETCH_OBJ);
		    $getMenuTitle   = $getMenuTitle_f->cr_menuTitle;

			$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title'");
	    	$checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title'");

		    if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
			    $result = $this->pdo->prepare("INSERT INTO cr_submenu(cr_submenuTitle, cr_submenuLink, cr_menuID, cr_submenuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?)");
				$result->bindParam(1, $titleupper);
				$result->bindParam(2, $titlelower);
				$result->bindParam(3, $parent);
				$result->bindParam(4, $status);
				$result->bindParam(5, $pagetemplate);
				$result->bindParam(6, $option);
				$result->execute();

				$updateMenu = $this->pdo->query("UPDATE cr_menu SET cr_menuHasSub = '1' WHERE cr_menuID = '$parent'");

				if($status==1) {
					$str = "Publish";
				}
				elseif($status==0) {
					$str = "Unpublish";
				}

				$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Submenu', ?, ?, ?)");
				$historyDetail = " add submenu $titleupper ($str) under $getMenuTitle to your website.";
				$getHistory->bindParam(1, $historyDetail);
				$getHistory->bindParam(2, $NowDate);
				$getHistory->bindParam(3, $adminLoginID);
				$getHistory->execute();
			}
			else {
		    	$samename = 1;
		    	return $samename;
		    }
		}

    }
    public function addCustomlink($title, $link, $parent, $status, $option, $adminLoginID) {
    	global $NowDate;
    	$titleupper   = ucwords($title);
    	$pagetemplate = "0";
    	if(empty($parent)) {
	    	$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title'");
    		$checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title'");

	    	if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
		    	$getLastID_q = $this->pdo->query("SELECT LAST_INSERT_ID() FROM cr_menu");
		    	$getLastID_f = $getLastID_q->fetch(PDO::FETCH_OBJ);
		    	$getLastID   = $getLastID_f->cr_menuID+1;

			    $result = $this->pdo->prepare("INSERT INTO cr_menu(cr_menuTitle, cr_menuLink, cr_menuOrder, cr_menuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?)");
				$result->bindParam(1, $titleupper);
				$result->bindParam(2, $link);
				$result->bindParam(3, $getLastID);
				$result->bindParam(4, $status);
				$result->bindParam(5, $pagetemplate);
				$result->bindParam(6, $option);
				$result->execute();

				$result = $this->pdo->query("SET @lastID = LAST_INSERT_ID()");
				$result = $this->pdo->query("UPDATE cr_menu SET cr_menuOrder = @lastID WHERE cr_menuID = @lastID;");

				if($status==1) {
					$str = "Publish";
				}
				elseif($status==0) {
					$str = "Unpublish";
				}

				$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Custom Link', ?, ?, ?)");
				$historyDetail = " add custom link <a href='$link' target='_blank'>$titleupper</a> ($str) to your website.";
				$getHistory->bindParam(1, $historyDetail);
				$getHistory->bindParam(2, $NowDate);
				$getHistory->bindParam(3, $adminLoginID);
				$getHistory->execute();
			}
			else {
		    	$samename = 1;
		    	return $samename;
		    }
		}
		else {
			$getMenuTitle_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$parent'");
		    $getMenuTitle_f = $getMenuTitle_q->fetch(PDO::FETCH_OBJ);
		    $getMenuTitle   = $getMenuTitle_f->cr_menuTitle;

			$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title'");
	    	$checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title'");

		    if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
			    $result = $this->pdo->prepare("INSERT INTO cr_submenu(cr_submenuTitle, cr_submenuLink, cr_menuID, cr_submenuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?)");
				$result->bindParam(1, $titleupper);
				$result->bindParam(2, $link);
				$result->bindParam(3, $parent);
				$result->bindParam(4, $status);
				$result->bindParam(5, $pagetemplate);
				$result->bindParam(6, $option);
				$result->execute();

				$updateMenu = $this->pdo->query("UPDATE cr_menu SET cr_menuHasSub = '1' WHERE cr_menuID = '$parent'");

				if($status==1) {
					$str = "Publish";
				}
				elseif($status==0) {
					$str = "Unpublish";
				}

				$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Custom Link', ?, ?, ?)");
				$historyDetail = " add custom link <a href='$link' target='_blank'>$titleupper</a> ($str) under $getMenuTitle to your website.";
				$getHistory->bindParam(1, $historyDetail);
				$getHistory->bindParam(2, $NowDate);
				$getHistory->bindParam(3, $adminLoginID);
				$getHistory->execute();
			}
			else {
		    	$samename = 1;
		    	return $samename;
		    }
		}

    }
    public function updateMenus($title, $status, $menuIDh, $adminLoginID) {
    	global $NowDate;

    	$checkmenutype_q = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID=cr_pagetemplate.cr_pagetemplateID AND cr_menuID='$menuIDh'");
    	$checkmenutype_f = $checkmenutype_q->fetch(PDO::FETCH_OBJ);
    	$menutype        = $checkmenutype_f->cr_pagetemplateType;
    	$oldlink         = $checkmenutype_f->cr_menuLink;
    	$menuoption      = $checkmenutype_f->cr_option;

    	$titleupper   = ucwords($title);
    	$titlelower   = create_slug($title); 

    	$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE (cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title') AND cr_menuID<>'$menuIDh'");
    	$checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title'");

	    if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_menu SET 
			cr_menuTitle  = ?,
			cr_menuLink   = ?,
			cr_menuStatus = ? 
			WHERE cr_menuID = ?");
			$result->bindParam(1, $titleupper);
			$result->bindParam(2, $titlelower);
			$result->bindParam(3, $status);
			$result->bindParam(4, $menuIDh);
			$result->execute();

			if($menutype=="blog") {
				$updatelink = $this->pdo->prepare("UPDATE cr_blogcategory SET 
					cr_blogcategoryLink  = ?
					WHERE cr_blogcategoryLink = ?");
				$updatelink->bindParam(1, $titlelower);
				$updatelink->bindParam(2, $oldlink);
				$updatelink->execute();
			}
			elseif($menutype=="general") {
				$updatelink = $this->pdo->prepare("UPDATE cr_general SET 
					cr_generalLink  = ?
					WHERE cr_generalLink = ?");
				$updatelink->bindParam(1, $titlelower);
				$updatelink->bindParam(2, $oldlink);
				$updatelink->execute();
			}
			elseif($menutype=="portfolio") {
				if($menuoption=="gallery") {
					$updatelink = $this->pdo->prepare("UPDATE cr_gallery SET 
						cr_galleryLink  = ?
						WHERE cr_galleryLink = ?");
					$updatelink->bindParam(1, $titlelower);
					$updatelink->bindParam(2, $oldlink);
					$updatelink->execute();
				}
				else {
					$updatelink = $this->pdo->prepare("UPDATE cr_portfoliocategory SET 
						cr_portfoliocategoryLink  = ?
						WHERE cr_portfoliocategoryLink = ?");
					$updatelink->bindParam(1, $titlelower);
					$updatelink->bindParam(2, $oldlink);
					$updatelink->execute();
				}
			}

			if($status==1) {
				$str = "Publish";
			}
			elseif($status==0) {
				$str = "Unpublish";
			}

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
						    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Menu', ?, ?, ?)");
			$historyDetail = " edit menu $titleupper ($str).";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
	    }
	    else {
	    	$samename = 1;
		    return $samename;
	    }
    }
    public function updateCustomlink($title, $link, $status, $option, $menuIDh, $adminLoginID) {
    	global $NowDate;

    	$titleupper   = ucwords($title); 
    	$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE (cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title') AND cr_menuID<>'$menuIDh'");
    	$checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title'");

	    if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_menu SET 
			cr_menuTitle  = ?,
			cr_menuLink   = ?,
			cr_menuStatus = ? 
			WHERE cr_menuID = ?");
			$result->bindParam(1, $titleupper);
			$result->bindParam(2, $link);
			$result->bindParam(3, $status);
			$result->bindParam(4, $menuIDh);
			$result->execute();

			if($status==1) {
				$str = "Publish";
			}
			elseif($status==0) {
				$str = "Unpublish";
			}

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
						    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Custom Link', ?, ?, ?)");
			$historyDetail = " edit custom link <a href='$link' target='_blank'>$titleupper</a> ($str).";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
	    }
	    else {
	    	$samename = 1;
		    return $samename;
	    }
    }
    public function updateSubCustomlink($title, $link, $status, $option, $submenuIDh, $adminLoginID) {
    	global $NowDate;

    	$titleupper  = ucwords($title);

    	$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title'");
	    $checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE (cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title') AND cr_submenuID<>'$submenuIDh'");

	    if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_submenu SET 
			cr_submenuTitle  = ?,
			cr_submenuLink   = ?,
			cr_submenuStatus = ? 
			WHERE cr_submenuID = ?");
			$result->bindParam(1, $titleupper);
			$result->bindParam(2, $link);
			$result->bindParam(3, $status);
			$result->bindParam(4, $submenuIDh);
			$result->execute();

			if($status==1) {
				$str = "Publish";
			}
			elseif($status==0) {
				$str = "Unpublish";
			}

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
						    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Custom Link', ?, ?, ?)");
			$historyDetail = " edit custom link <a href='$link' target='_blank'>$titleupper</a> ($str).";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
	    }
	    else {
	    	$samename = 1;
		    return $samename;
	    }

    }
    public function updateSubmenus($title, $status, $submenuIDh, $adminLoginID) {
    	global $NowDate;

    	$checkmenutype_q = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID=cr_pagetemplate.cr_pagetemplateID AND cr_submenuID='$submenuIDh'");
    	$checkmenutype_f = $checkmenutype_q->fetch(PDO::FETCH_OBJ);
    	$menutype        = $checkmenutype_f->cr_pagetemplateType;
    	$oldlink         = $checkmenutype_f->cr_submenuLink;
    	$menuoption      = $checkmenutype_f->cr_option;

    	$titleupper  = ucwords($title);
    	$titlelower  = create_slug($title); 

    	$checkmenu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$titleupper' OR cr_menuTitle = '$title'");
	    $checksubmenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE (cr_submenuTitle = '$titleupper' OR cr_submenuTitle = '$title') AND cr_submenuID<>'$submenuIDh'");

	    if(($checkmenu->rowCount() < 1) && $checksubmenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_submenu SET 
			cr_submenuTitle  = ?,
			cr_submenuLink   = ?,
			cr_submenuStatus = ? 
			WHERE cr_submenuID = ?");
			$result->bindParam(1, $titleupper);
			$result->bindParam(2, $titlelower);
			$result->bindParam(3, $status);
			$result->bindParam(4, $submenuIDh);
			$result->execute();

			if($menutype=="blog") {
				$updatelink = $this->pdo->prepare("UPDATE cr_blogcategory SET 
					cr_blogcategoryLink  = ?
					WHERE cr_blogcategoryLink = ?");
				$updatelink->bindParam(1, $titlelower);
				$updatelink->bindParam(2, $oldlink);
				$updatelink->execute();
			}
			elseif($menutype=="general") {
				$updatelink = $this->pdo->prepare("UPDATE cr_general SET 
					cr_generalLink  = ?
					WHERE cr_generalLink = ?");
				$updatelink->bindParam(1, $titlelower);
				$updatelink->bindParam(2, $oldlink);
				$updatelink->execute();
			}
			elseif($menutype=="portfolio") {
				if($menuoption=="gallery") {
					$updatelink = $this->pdo->prepare("UPDATE cr_gallery SET 
						cr_galleryLink  = ?
						WHERE cr_galleryLink = ?");
					$updatelink->bindParam(1, $titlelower);
					$updatelink->bindParam(2, $oldlink);
					$updatelink->execute();
				}
				else {
					$updatelink = $this->pdo->prepare("UPDATE cr_portfoliocategory SET 
						cr_portfoliocategoryLink  = ?
						WHERE cr_portfoliocategoryLink = ?");
					$updatelink->bindParam(1, $titlelower);
					$updatelink->bindParam(2, $oldlink);
					$updatelink->execute();
				}
			}

			if($status==1) {
				$str = "Publish";
			}
			elseif($status==0) {
				$str = "Unpublish";
			}

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
						    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Submenu', ?, ?, ?)");
			$historyDetail = " edit submenu $titleupper ($str).";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
	    }
	    else {
	    	$samename = 1;
		    return $samename;
	    }

    }
    public function updateMenu($idArray) {
    	$count = 1;
    	foreach ($idArray as $id){
			$update = $this->pdo->query("UPDATE cr_menu SET cr_menuOrder = $count WHERE cr_menuID = $id");
			$count ++;	
		}
		return true;
    }
    public function countshowcasePortfolio($pagelink) {
    	$check = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option='showcase'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option='showcase'");
    		$total = $result->rowCount();
    		return $total;
    	} 
    	else {
    		$total = $check->rowCount();
    		return $total;
    	}
    }
    public function disabledshowcasePortfolio($pagelink) {
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$pagelink'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$pagelink'");
    	} 
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$pagelink'");
    	}
    	$rows = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function setshowcasePortfolio($adminLoginID, $pagelink) {
    	global $NowDate;
    	$showcase = "showcase";
    	$pageName = urlDcode($pagelink);
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$pagelink'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->prepare("UPDATE cr_submenu SET 
		    		cr_option            = ?
		    		WHERE cr_submenuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $pagelink);
			$result->execute();
    	} 
    	else {
    		$result = $this->pdo->prepare("UPDATE cr_menu SET 
		    		cr_option            = ?
		    		WHERE cr_menuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $pagelink);
			$result->execute();
    	}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Set Portfolios/Products as Showcase', ?, ?, ?)");
		$historyDetail = " set portfolios/products in page $pageName as selected portfolio/product to show at homepage.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function unshowcasePortfolio($adminLoginID, $pagelink) {
    	global $NowDate;
    	$showcase = "";
    	$pageName = urlDcode($pagelink);
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$pagelink'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->prepare("UPDATE cr_submenu SET 
		    		cr_option            = ?
		    		WHERE cr_submenuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $pagelink);
			$result->execute();
    	} 
    	else {
    		$result = $this->pdo->prepare("UPDATE cr_menu SET 
		    		cr_option            = ?
		    		WHERE cr_menuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $pagelink);
			$result->execute();
    	}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Unset Portfolios/Products as Showcase', ?, ?, ?)");
		$historyDetail = " remove portfolios/products in page $pageName from showcase.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteSubmenu($submenuID, $adminLoginID) {
    	global $NowDate;
		$getSubMenuTitle_q = $this->pdo->query("SELECT * FROM cr_submenu, cr_menu, cr_pagetemplate WHERE cr_submenu.cr_submenuID = '$submenuID' AND cr_submenu.cr_menuID = cr_menu.cr_menuID AND cr_submenu.cr_pagetemplateID=cr_pagetemplate.cr_pagetemplateID");
		$getSubMenuTitle_f = $getSubMenuTitle_q->fetch(PDO::FETCH_OBJ);
		$getSubMenuTitle   = $getSubMenuTitle_f->cr_submenuTitle;
		$getSubMenuLink    = $getSubMenuTitle_f->cr_submenuLink;
		$getSubMenuType    = $getSubMenuTitle_f->cr_pagetemplateType;
		$getMenuTitle      = $getSubMenuTitle_f->cr_menuTitle;
		$getMenuID         = $getSubMenuTitle_f->cr_menuID;

		$cekTotalsub = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$getMenuID'");
    	$totalsub    = $cekTotalsub->rowCount();
    	if($totalsub==1) {
    		$updateMenu = $this->pdo->query("UPDATE cr_menu SET cr_menuHasSub = '0' WHERE cr_menuID = '$getMenuID'");
    	} 

    	if($getSubMenuType=="general") {
    		$result2 = $this->pdo->prepare("DELETE FROM cr_general WHERE cr_generalLink = ?");
	    	$result2->bindParam(1, $getSubMenuLink);
	    	$result2->execute();
    	}

    	$result = $this->pdo->prepare("DELETE FROM cr_submenu WHERE cr_submenuID = ?");
    	$result->bindParam(1, $submenuID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Sub Menu', ?, ?, ?)");
		$historyDetail = " delete submenu $getSubMenuTitle under $getMenuTitle.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteMenu($menuID, $adminLoginID) {
    	global $NowDate;
		$getMenuTitle_q = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_menuID = '$menuID' AND cr_menu.cr_pagetemplateID=cr_pagetemplate.cr_pagetemplateID");
		$getMenuTitle_f = $getMenuTitle_q->fetch(PDO::FETCH_OBJ);
		$getMenuTitle   = $getMenuTitle_f->cr_menuTitle;
		$getMenuLink    = $getMenuTitle_f->cr_menuLink;
		$getMenuType    = $getMenuTitle_f->cr_pagetemplateType;

    	$result = $this->pdo->prepare("DELETE FROM cr_menu WHERE cr_menuID = ?");
    	$result->bindParam(1, $menuID);
    	$result->execute();

    	if($getMenuType=="general") {
    		$result = $this->pdo->prepare("DELETE FROM cr_general WHERE cr_generalLink = ?");
	    	$result->bindParam(1, $getMenuLink);
	    	$result->execute();
    	}

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Menu', ?, ?, ?)");
		$historyDetail = " delete menu $getMenuTitle.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function count_total_page() {
    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuHasSub <> '1'");
    	$total_menu    = $check_menu->rowCount();
		$check_submenu = $this->pdo->query("SELECT * FROM cr_submenu");
    	$total_submenu = $check_submenu->rowCount();
    	return $total_menu+$total_submenu;
	}
}

class user {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function countUser() {
    	$cek   = $this->pdo->query("SELECT * FROM  cr_admin ORDER BY cr_adminID asc");
    	$total = $cek->rowCount();
    	return $alert;
    }
    public function viewUser() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_admin ORDER BY cr_adminID asc");
    	if($cek->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_admin ORDER BY cr_adminID asc");
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function profileUser($cradminID_session) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID='$cradminID_session'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function addUser($username, $password, $email, $photo, $displayname, $position, $level, $aboutyou, $fb, $gp, $tw, $adminLoginID) {
    	global $NowDate;
    	$checkusername = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminUsername = '$username' OR cr_adminDisplayName = '$displayname'");
    	if(($checkusername->rowCount() < 1)) {
	    	$result = $this->pdo->prepare("INSERT INTO cr_admin(
			    		cr_adminUsername, cr_adminPassword, cr_adminEmail, cr_adminPhoto, cr_adminRegistered, cr_adminDisplayName, cr_adminPosition, cr_adminLevel, cr_adminAbout, cr_adminFacebook, cr_adminGoogleplus, cr_adminTwitter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		    $result->bindParam(1, $username);
		    $result->bindParam(2, $password);
		    $result->bindParam(3, $email);
		    $result->bindParam(4, $photo);
		    $result->bindParam(5, $NowDate);
		    $result->bindParam(6, $displayname);
		    $result->bindParam(7, $position);
		    $result->bindParam(8, $level);
		    $result->bindParam(9, $aboutyou);
		    $result->bindParam(10, $fb);
		    $result->bindParam(11, $gp);
		    $result->bindParam(12, $tw);
		    $result->execute();

		    $getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add User', ?, ?, ?)");
		    if($level==1) {
		    	$leveluser = "Administrator";
		    }
		    elseif($level==2) {
		    	$leveluser = "Editor";
		    }
		    $displaynameCaps = ucwords($displayname);
		    $historyDetail = " add ".$displaynameCaps." as an ".$leveluser.".";
		    $getHistory->bindParam(1, $historyDetail);
		    $getHistory->bindParam(2, $NowDate);
		    $getHistory->bindParam(3, $adminLoginID);
		    $getHistory->execute();
	    }
	    else {
	    	$samename = 1;
	    	return $samename;
	    }
    }
    public function editUser($adminID) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID='$adminID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateUser($username, $password, $email, $photo, $displayname, $position, $level, $aboutyou, $fb, $gp, $tw, $adminLoginID, $adminIDh) {
    	global $NowDate;
    	$passworduser = generateHash($password);

    	$ceku_q = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID='$adminIDh'");
    	$ceku_f = $ceku_q->fetch(PDO::FETCH_OBJ);
    	$thname = $ceku_f->cr_adminPhoto;

    	if($thname!=$photo) {
	    	$userPhotoGIF  = str_replace(".png",".gif",$thname);
	        $userPhotoJPG  = str_replace(".png",".jpg",$thname);
	        $userPhotoJPEG = str_replace(".png",".jpeg",$thname);

	        $userPhotoLink     = str_replace("/avatar","/upload",$thname);
	        $userPhotoGIFLink  = str_replace("/avatar","/upload",$userPhotoGIF);
	        $userPhotoJPGLink  = str_replace("/avatar","/upload",$userPhotoJPG);
	        $userPhotoJPEGLink = str_replace("/avatar","/upload",$userPhotoJPEG);

	    	//unlink old thumbnail
	    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$thname);
	    	//unlink old real image
	    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$userPhotoLink);
	    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$userPhotoGIFLink);
	    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$userPhotoJPGLink);
	    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$userPhotoJPEGLink);

	    	if(empty($password)) {
	    		$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminEmail       = ?,
			    		cr_adminPhoto       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminPosition    = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $email);
				$result->bindParam(3, $photo);
				$result->bindParam(4, $displayname);
				$result->bindParam(5, $position);
				$result->bindParam(6, $level);
				$result->bindParam(7, $aboutyou);
				$result->bindParam(8, $fb);
				$result->bindParam(9, $gp);
				$result->bindParam(10, $tw);
				$result->bindParam(11, $adminIDh);
				$result->execute();
	    	}
	    	else {
			    $result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminPassword    = ?,  
			    		cr_adminEmail       = ?,
			    		cr_adminPhoto       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminPosition    = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $passworduser);
				$result->bindParam(3, $email);
				$result->bindParam(4, $photo);
				$result->bindParam(5, $displayname);
				$result->bindParam(6, $position);
				$result->bindParam(7, $level);
				$result->bindParam(8, $aboutyou);
				$result->bindParam(9, $fb);
				$result->bindParam(10, $gp);
				$result->bindParam(11, $tw);
				$result->bindParam(12, $adminIDh);
				$result->execute();
			}
		}
		else {
			if(empty($password)) {
				$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminEmail       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminPosition    = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $email);
				$result->bindParam(3, $displayname);
				$result->bindParam(4, $position);
				$result->bindParam(5, $level);
				$result->bindParam(6, $aboutyou);
				$result->bindParam(7, $fb);
				$result->bindParam(8, $gp);
				$result->bindParam(9, $tw);
				$result->bindParam(10, $adminIDh);
				$result->execute();
			}
			else {
				$result = $this->pdo->prepare("UPDATE cr_admin SET 
			    		cr_adminUsername    = ?, 
			    		cr_adminPassword    = ?,  
			    		cr_adminEmail       = ?,
			    		cr_adminDisplayName = ?,
			    		cr_adminPosition    = ?,
			    		cr_adminLevel       = ?,
			    		cr_adminAbout       = ?,
			    		cr_adminFacebook    = ?,
			    		cr_adminGoogleplus  = ?,
			    		cr_adminTwitter     = ?  
			    		WHERE cr_adminID = ?");	
			    $result->bindParam(1, $username);
				$result->bindParam(2, $passworduser);
				$result->bindParam(3, $email);
				$result->bindParam(4, $displayname);
				$result->bindParam(5, $position);
				$result->bindParam(6, $level);
				$result->bindParam(7, $aboutyou);
				$result->bindParam(8, $fb);
				$result->bindParam(9, $gp);
				$result->bindParam(10, $tw);
				$result->bindParam(11, $adminIDh);
				$result->execute();
			}
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit User', ?, ?, ?)");
		$displaynameCaps = ucwords($displayname);
		$historyDetail = " edit ".$displaynameCaps."'s profile data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteUser($adminID, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID='$adminID'");
    	$check_f = $check->fetch();
    	$namaPhoto = $check_f['cr_adminPhoto'];
    	$namaAdmin = $check_f['cr_adminDisplayName'];

    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

        $namaPhotoLink     = str_replace("/avatar","/upload",$namaPhoto);
        $namaPhotoGIFLink  = str_replace("/avatar","/upload",$namaPhotoGIF);
        $namaPhotoJPGLink  = str_replace("/avatar","/upload",$namaPhotoJPG);
        $namaPhotoJPEGLink = str_replace("/avatar","/upload",$namaPhotoJPEG);

    	if($namaPhoto!="/assets/img/no-pic.png") {
    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$namaPhoto);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$namaPhotoLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$namaPhotoGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$namaPhotoJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATHADMIN.$namaPhotoJPEGLink);
    	}
    	$result = $this->pdo->prepare("DELETE FROM cr_admin WHERE cr_adminID = ?");
    	$result->bindParam(1, $adminID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete User', ?, ?, ?)");
    	$displaynameCaps = ucwords($namaAdmin);
		$historyDetail = " delete ".$displaynameCaps." from users data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function setLastlogin($adminID) {
    	global $NowDate;
    	$result = $this->pdo->prepare("UPDATE cr_admin SET 
		    		cr_adminLastlogin = ?  
		    		WHERE cr_adminID  = ?");
		$result->bindParam(1, $NowDate);
		$result->bindParam(2, $adminID);
		$result->execute();
    }
    public function checkFP($email) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminEmail = '$email'");
    	if($result->rowCount() < 1){
    		$notfound = "kosong";
    		return $notfound;
    	}
    	else {
    		$found = "ada";
    		return $found;
    	}
    }
    public function insertToken($email, $token) {
    	$result = $this->pdo->prepare("UPDATE cr_admin SET 
		    		cr_adminToken       = ?
		    		WHERE cr_adminEmail = ?");
		$result->bindParam(1, $token);
		$result->bindParam(2, $email);
		$result->execute();
    }
    public function verifyUser($token) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminToken = '$token' LIMIT 1");
    	if($result->rowCount() < 1){
    		return 0;
    	}
    	else {
    		$rows = $result->fetch(PDO::FETCH_OBJ);
		    return $rows;
    	}
    }
    public function changePassword($email, $password) {
    	$token  = "";
    	$result = $this->pdo->prepare("UPDATE cr_admin SET 
		    		cr_adminPassword    = ?,
		    		cr_adminToken       = ?
		    		WHERE cr_adminEmail = ?");
		$result->bindParam(1, $password);
		$result->bindParam(2, $$token);
		$result->bindParam(3, $email);
		$result->execute();
    }
    public function getUsername($email) {
    	$result = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminEmail = '$email'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows;
    }
}

class page {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewPage($title) {
    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$title'");
    	if($cek->rowCount() < 1){
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
    public function viewPageTitle($title) {
    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$title'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = '$title'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    	$menuTitle = $rows->cr_submenuTitle;
		    return $menuTitle;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = '$title'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    	$menuTitle = $rows->cr_menuTitle;
		    return $menuTitle;
    	}
    }
    public function viewPageGeneral($title) {
    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$title'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate, cr_general WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuLink = cr_general.cr_generalLink AND cr_submenu.cr_submenuLink = '$title'");
    		if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    	return $rows;
			}
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate, cr_general WHERE cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuLink = cr_general.cr_generalLink AND cr_menu.cr_menuLink = '$title'");
    		if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    	return $rows;
			}
    	}
    }
    public function addPageGeneral1($pagetitle, $column1, $photo, $metakeywords, $metadesc, $link, $adminLoginID) {
    	//$getpage  = ucwords(str_replace("-", " ", $link));
    	global $NowDate;
    	$getMenu_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
    	if($getMenu_q->rowCount()<1) {
    		$getSubmenu_q = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
    		$getSubmenu_f = $getSubmenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getSubmenu_f->cr_submenuTitle;
    	}
    	else {
    		$getMenu_f = $getMenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getMenu_f->cr_menuTitle;
    	}

    	$defaultfeaturedimage = MADMINURL."/assets/img/no-pic-items.png";
    	if($photo==$defaultfeaturedimage) {
    		$featuredImage = "";
    	}
    	else {
    		$featuredImage = $photo;	
    	}
    	$check = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$link'");
    	if(($check->rowCount() < 1)) {
	    	$result = $this->pdo->prepare("INSERT INTO cr_general(
			    		cr_generalTitle, cr_generalColumn1, cr_generalFeaturedImage, cr_generalMetaKeywords, cr_generalMetaDescription, cr_generalDate, cr_generalLink, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		    $result->bindParam(1, $pagetitle);
		    $result->bindParam(2, $column1);
		    $result->bindParam(3, $featuredImage);
		    $result->bindParam(4, $metakeywords);
		    $result->bindParam(5, $metadesc);
		    $result->bindParam(6, $NowDate);
		    $result->bindParam(7, $link);
		    $result->bindParam(8, $adminLoginID);
		    $result->execute();

		    $getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Data to Page $menuTitle', ?, ?, ?)");

		    $historyDetail = " add data to page ".$menuTitle.".";
		    $getHistory->bindParam(1, $historyDetail);
		    $getHistory->bindParam(2, $NowDate);
		    $getHistory->bindParam(3, $adminLoginID);
		    $getHistory->execute();
	    }
	    else {
	    	$samepage = 1;
	    	return $samepage;
	    }
    }
    public function addPageGeneral2($pagetitle, $column1, $column2, $photo, $metakeywords, $metadesc, $link, $adminLoginID) {
    	global $NowDate;
    	//$getpage  = ucwords(str_replace("-", " ", $link)); 
    	$getMenu_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
    	if($getMenu_q->rowCount()<1) {
    		$getSubmenu_q = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
    		$getSubmenu_f = $getSubmenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getSubmenu_f->cr_submenuTitle;
    	}
    	else {
    		$getMenu_f = $getMenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getMenu_f->cr_menuTitle;
    	}

    	$defaultfeaturedimage = MADMINURL."/assets/img/no-pic-items.png";
    	if($photo==$defaultfeaturedimage) {
    		$featuredImage = "";
    	}
    	else {
    		$featuredImage = $photo;	
    	}
    	$check = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$link'");
    	if(($check->rowCount() < 1)) {
	    	$result = $this->pdo->prepare("INSERT INTO cr_general(
			    		cr_generalTitle, cr_generalColumn1, cr_generalColumn2, cr_generalFeaturedImage, cr_generalMetaKeywords, cr_generalMetaDescription, cr_generalDate, cr_generalLink, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
		    $result->bindParam(1, $pagetitle);
		    $result->bindParam(2, $column1);
		    $result->bindParam(3, $column2);
		    $result->bindParam(4, $featuredImage);
		    $result->bindParam(5, $metakeywords);
		    $result->bindParam(6, $metadesc);
		    $result->bindParam(7, $NowDate);
		    $result->bindParam(8, $link);
		    $result->bindParam(9, $adminLoginID);
		    $result->execute();

		    $getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Data to Page $menuTitle', ?, ?, ?)");

		    $historyDetail = " add data to page ".$menuTitle.".";
		    $getHistory->bindParam(1, $historyDetail);
		    $getHistory->bindParam(2, $NowDate);
		    $getHistory->bindParam(3, $adminLoginID);
		    $getHistory->execute();
	    }
	    else {
	    	$samepage = 1;
	    	return $samepage;
	    }
    }
    public function addPageGeneral3($pagetitle, $column1, $column2, $column3, $photo, $metakeywords, $metadesc, $link, $adminLoginID) {
    	global $NowDate;
    	//$getpage  = ucwords(str_replace("-", " ", $link)); 
    	$getMenu_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
    	if($getMenu_q->rowCount()<1) {
    		$getSubmenu_q = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
    		$getSubmenu_f = $getSubmenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getSubmenu_f->cr_submenuTitle;
    	}
    	else {
    		$getMenu_f = $getMenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getMenu_f->cr_menuTitle;
    	}

    	$defaultfeaturedimage = MADMINURL."/assets/img/no-pic-items.png";
    	if($photo==$defaultfeaturedimage) {
    		$featuredImage = "";
    	}
    	else {
    		$featuredImage = $photo;	
    	}
    	$check = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$link'");
    	if(($check->rowCount() < 1)) {
	    	$result = $this->pdo->prepare("INSERT INTO cr_general(
			    		cr_generalTitle, cr_generalColumn1, cr_generalColumn2, cr_generalColumn3, cr_generalFeaturedImage, cr_generalMetaKeywords, cr_generalMetaDescription, cr_generalDate, cr_generalLink, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		    $result->bindParam(1, $pagetitle);
		    $result->bindParam(2, $column1);
		    $result->bindParam(3, $column2);
		    $result->bindParam(4, $column3);
		    $result->bindParam(5, $featuredImage);
		    $result->bindParam(6, $metakeywords);
		    $result->bindParam(7, $metadesc);
		    $result->bindParam(8, $NowDate);
		    $result->bindParam(9, $link);
		    $result->bindParam(10, $adminLoginID);
		    $result->execute();

		    $getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Data to Page $menuTitle', ?, ?, ?)");

		    $historyDetail = " add data to page ".$menuTitle.".";
		    $getHistory->bindParam(1, $historyDetail);
		    $getHistory->bindParam(2, $NowDate);
		    $getHistory->bindParam(3, $adminLoginID);
		    $getHistory->execute();
	    }
	    else {
	    	$samepage = 1;
	    	return $samepage;
	    }
    }
    public function editPageGeneral($pagegeneralID) {
    	$result = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID='$pagegeneralID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updatePageGeneral1($pagetitle, $column1, $photo, $photourlnc, $metakeywords, $metadesc, $link, $adminLoginID, $pagegeneralIDh) {
    	//$getpage  = ucwords(str_replace("-", " ", $link));
    	global $NowDate;
    	$getMenu_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'"); 
    	if($getMenu_q->rowCount()<1) {
    		$getSubmenu_q = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
    		$getSubmenu_f = $getSubmenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getSubmenu_f->cr_submenuTitle;
    	}
    	else {
    		$getMenu_f = $getMenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getMenu_f->cr_menuTitle;
    	}

    	$defaultfeaturedimage = MADMINURL."/assets/img/no-pic-items.png";
    	if($photo==$defaultfeaturedimage) {
    		$featuredImage = "";
    	}
    	else {
    		$featuredImage = $photo;	
    	}

    	$cek_q  = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID='$pagegeneralIDh'");
    	$cek_f  = $cek_q->fetch(PDO::FETCH_OBJ);
    	$pagefi = $cek_f->cr_generalFeaturedImage;

    	$photoca     = str_replace(MADMINURL."/..","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekp_q = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID='$pagegeneralIDh'");
    	$cekp_f = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekp_f->cr_generalFeaturedImage;

    	if($photocb!=$photourlnc) {
    		if($photo==$defaultfeaturedimage) {
    			$result = $this->pdo->prepare("UPDATE cr_general SET 
		    		cr_generalTitle           = ?, 
		    		cr_generalColumn1         = ?, 
		    		cr_generalMetaKeywords    = ?,
		    		cr_generalMetaDescription = ?,
		    		cr_generalDate            = ?,
		    		cr_generalLink            = ?,
		    		cr_adminID                = ? 
		    		WHERE cr_generalID        = ?");	
			    $result->bindParam(1, $pagetitle);
				$result->bindParam(2, $column1);
				$result->bindParam(3, $metakeywords);
				$result->bindParam(4, $metadesc);
				$result->bindParam(5, $NowDate);
				$result->bindParam(6, $link);
				$result->bindParam(7, $adminLoginID);
				$result->bindParam(8, $pagegeneralIDh);
				$result->execute();
    		}
    		else {
    			$fiPhotoGIF  = str_replace(".png",".gif",$pagefi);
		        $fiPhotoJPG  = str_replace(".png",".jpg",$pagefi);
		        $fiPhotoJPEG = str_replace(".png",".jpeg",$pagefi);

		        $fiPhotoLink     = str_replace("/thumbnails","",$pagefi);
		        $fiPhotoGIFLink  = str_replace("/thumbnails","",$fiPhotoGIF);
		        $fiPhotoJPGLink  = str_replace("/thumbnails","",$fiPhotoJPG);
		        $fiPhotoJPEGLink = str_replace("/thumbnails","",$fiPhotoJPEG);

		    	//unlink old thumbnail
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$pagefi);
		    	//unlink old real image
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoGIFLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoJPGLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoJPEGLink);

			    $result = $this->pdo->prepare("UPDATE cr_general SET 
			    		cr_generalTitle           = ?, 
			    		cr_generalColumn1         = ?, 
			    		cr_generalFeaturedImage   = ?,  
			    		cr_generalMetaKeywords    = ?,
			    		cr_generalMetaDescription = ?,
			    		cr_generalDate            = ?,
			    		cr_generalLink            = ?,
			    		cr_adminID                = ? 
			    		WHERE cr_generalID        = ?");	
			    $result->bindParam(1, $pagetitle);
				$result->bindParam(2, $column1);
				$result->bindParam(3, $photoca);
				$result->bindParam(4, $metakeywords);
				$result->bindParam(5, $metadesc);
				$result->bindParam(6, $NowDate);
				$result->bindParam(7, $link);
				$result->bindParam(8, $adminLoginID);
				$result->bindParam(9, $pagegeneralIDh);
				$result->execute();
    		}
	    	
		}
		else {
			$result = $this->pdo->prepare("UPDATE cr_general SET 
		    		cr_generalTitle           = ?, 
		    		cr_generalColumn1         = ?, 
		    		cr_generalMetaKeywords    = ?,
		    		cr_generalMetaDescription = ?,
		    		cr_generalDate            = ?,
		    		cr_generalLink            = ?,
		    		cr_adminID                = ? 
		    		WHERE cr_generalID        = ?");	
		    $result->bindParam(1, $pagetitle);
			$result->bindParam(2, $column1);
			$result->bindParam(3, $metakeywords);
			$result->bindParam(4, $metadesc);
			$result->bindParam(5, $NowDate);
			$result->bindParam(6, $link);
			$result->bindParam(7, $adminLoginID);
			$result->bindParam(8, $pagegeneralIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Data in Page $menuTitle', ?, ?, ?)");
		$historyDetail = " edit data in page ".$menuTitle.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePageGeneral2($pagetitle, $column1, $column2, $photo, $photourlnc, $metakeywords, $metadesc, $link, $adminLoginID, $pagegeneralIDh) {
    	//$getpage  = ucwords(str_replace("-", " ", $link)); 
    	global $NowDate;
    	$getMenu_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
    	if($getMenu_q->rowCount()<1) {
    		$getSubmenu_q = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
    		$getSubmenu_f = $getSubmenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getSubmenu_f->cr_submenuTitle;
    	}
    	else {
    		$getMenu_f = $getMenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getMenu_f->cr_menuTitle;
    	}

    	$defaultfeaturedimage = MADMINURL."/assets/img/no-pic-items.png";
    	if($photo==$defaultfeaturedimage) {
    		$featuredImage = "";
    	}
    	else {
    		$featuredImage = $photo;	
    	}

    	$cek_q  = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID='$pagegeneralIDh'");
    	$cek_f  = $cek_q->fetch(PDO::FETCH_OBJ);
    	$pagefi = $cek_f->cr_generalFeaturedImage;

    	$photoca     = str_replace(MADMINURL."/..","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekp_q = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID='$pagegeneralIDh'");
    	$cekp_f = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekp_f->cr_generalFeaturedImage;

    	if($photocb!=$photourlnc) {
    		if($photo==$defaultfeaturedimage) {
    			$result = $this->pdo->prepare("UPDATE cr_general SET 
		    		cr_generalTitle           = ?, 
		    		cr_generalColumn1         = ?, 
		    		cr_generalColumn2         = ?, 
		    		cr_generalMetaKeywords    = ?,
		    		cr_generalMetaDescription = ?,
		    		cr_generalDate            = ?,
		    		cr_generalLink            = ?,
		    		cr_adminID                = ? 
		    		WHERE cr_generalID        = ?");	
			    $result->bindParam(1, $pagetitle);
				$result->bindParam(2, $column1);
				$result->bindParam(3, $column2);
				$result->bindParam(4, $metakeywords);
				$result->bindParam(5, $metadesc);
				$result->bindParam(6, $NowDate);
				$result->bindParam(7, $link);
				$result->bindParam(8, $adminLoginID);
				$result->bindParam(9, $pagegeneralIDh);
				$result->execute();
    		}
    		else {
    			$fiPhotoGIF  = str_replace(".png",".gif",$pagefi);
		        $fiPhotoJPG  = str_replace(".png",".jpg",$pagefi);
		        $fiPhotoJPEG = str_replace(".png",".jpeg",$pagefi);

		        $fiPhotoLink     = str_replace("/thumbnails","",$pagefi);
		        $fiPhotoGIFLink  = str_replace("/thumbnails","",$fiPhotoGIF);
		        $fiPhotoJPGLink  = str_replace("/thumbnails","",$fiPhotoJPG);
		        $fiPhotoJPEGLink = str_replace("/thumbnails","",$fiPhotoJPEG);

		    	//unlink old thumbnail
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$pagefi);
		    	//unlink old real image
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoGIFLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoJPGLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoJPEGLink);

			    $result = $this->pdo->prepare("UPDATE cr_general SET 
			    		cr_generalTitle           = ?, 
			    		cr_generalColumn1         = ?, 
			    		cr_generalColumn2         = ?, 
			    		cr_generalFeaturedImage   = ?,  
			    		cr_generalMetaKeywords    = ?,
			    		cr_generalMetaDescription = ?,
			    		cr_generalDate            = ?,
			    		cr_generalLink            = ?,
			    		cr_adminID                = ? 
			    		WHERE cr_generalID        = ?");	
			    $result->bindParam(1, $pagetitle);
				$result->bindParam(2, $column1);
				$result->bindParam(3, $column2);
				$result->bindParam(4, $photoca);
				$result->bindParam(5, $metakeywords);
				$result->bindParam(6, $metadesc);
				$result->bindParam(7, $NowDate);
				$result->bindParam(8, $link);
				$result->bindParam(9, $adminLoginID);
				$result->bindParam(10, $pagegeneralIDh);
				$result->execute();
    		}
		}
		else {
			$result = $this->pdo->prepare("UPDATE cr_general SET 
		    		cr_generalTitle           = ?, 
		    		cr_generalColumn1         = ?, 
		    		cr_generalColumn2         = ?, 
		    		cr_generalMetaKeywords    = ?,
		    		cr_generalMetaDescription = ?,
		    		cr_generalDate            = ?,
		    		cr_generalLink            = ?,
		    		cr_adminID                = ? 
		    		WHERE cr_generalID        = ?");	
		    $result->bindParam(1, $pagetitle);
			$result->bindParam(2, $column1);
			$result->bindParam(3, $column2);
			$result->bindParam(4, $metakeywords);
			$result->bindParam(5, $metadesc);
			$result->bindParam(6, $NowDate);
			$result->bindParam(7, $link);
			$result->bindParam(8, $adminLoginID);
			$result->bindParam(9, $pagegeneralIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Data in Page $menuTitle', ?, ?, ?)");
		$historyDetail = " edit data in page ".$menuTitle.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePageGeneral3($pagetitle, $column1, $column2, $column3, $photo, $photourlnc, $metakeywords, $metadesc, $link, $adminLoginID, $pagegeneralIDh) {
    	//$getpage  = ucwords(str_replace("-", " ", $link)); 
    	global $NowDate;
    	$getMenu_q = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink='$link'");
    	if($getMenu_q->rowCount()<1) {
    		$getSubmenu_q = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink='$link'");
    		$getSubmenu_f = $getSubmenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getSubmenu_f->cr_submenuTitle;
    	}
    	else {
    		$getMenu_f = $getMenu_q->fetch(PDO::FETCH_OBJ);
    		$menuTitle = $getMenu_f->cr_menuTitle;
    	}

    	$defaultfeaturedimage = MADMINURL."/assets/img/no-pic-items.png";
    	if($photo==$defaultfeaturedimage) {
    		$featuredImage = "";
    	}
    	else {
    		$featuredImage = $photo;	
    	}

    	$cek_q  = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID='$pagegeneralIDh'");
    	$cek_f  = $cek_q->fetch(PDO::FETCH_OBJ);
    	$pagefi = $cek_f->cr_generalFeaturedImage;

    	$photoca     = str_replace(MADMINURL."/..","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekp_q = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalID='$pagegeneralIDh'");
    	$cekp_f = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekp_f->cr_generalFeaturedImage;

    	if($photocb!=$photourlnc) {
    		if($photo==$defaultfeaturedimage) {
    			$result = $this->pdo->prepare("UPDATE cr_general SET 
		    		cr_generalTitle           = ?, 
		    		cr_generalColumn1         = ?, 
		    		cr_generalColumn2         = ?, 
		    		cr_generalColumn3         = ?,   
		    		cr_generalMetaKeywords    = ?,
		    		cr_generalMetaDescription = ?,
		    		cr_generalDate            = ?,
		    		cr_generalLink            = ?,
		    		cr_adminID                = ? 
		    		WHERE cr_generalID        = ?");	
			    $result->bindParam(1, $pagetitle);
				$result->bindParam(2, $column1);
				$result->bindParam(3, $column2);
				$result->bindParam(4, $column3);
				$result->bindParam(5, $metakeywords);
				$result->bindParam(6, $metadesc);
				$result->bindParam(7, $NowDate);
				$result->bindParam(8, $link);
				$result->bindParam(9, $adminLoginID);
				$result->bindParam(10, $pagegeneralIDh);
				$result->execute();
    		}
    		else {
    			$fiPhotoGIF  = str_replace(".png",".gif",$pagefi);
		        $fiPhotoJPG  = str_replace(".png",".jpg",$pagefi);
		        $fiPhotoJPEG = str_replace(".png",".jpeg",$pagefi);

		        $fiPhotoLink     = str_replace("/thumbnails","",$pagefi);
		        $fiPhotoGIFLink  = str_replace("/thumbnails","",$fiPhotoGIF);
		        $fiPhotoJPGLink  = str_replace("/thumbnails","",$fiPhotoJPG);
		        $fiPhotoJPEGLink = str_replace("/thumbnails","",$fiPhotoJPEG);

		    	//unlink old thumbnail
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$pagefi);
		    	//unlink old real image
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoGIFLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoJPGLink);
		    	unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$fiPhotoJPEGLink);

			    $result = $this->pdo->prepare("UPDATE cr_general SET 
			    		cr_generalTitle           = ?, 
			    		cr_generalColumn1         = ?, 
			    		cr_generalColumn2         = ?, 
			    		cr_generalColumn3         = ?, 
			    		cr_generalFeaturedImage   = ?,  
			    		cr_generalMetaKeywords    = ?,
			    		cr_generalMetaDescription = ?,
			    		cr_generalDate            = ?,
			    		cr_generalLink            = ?,
			    		cr_adminID                = ? 
			    		WHERE cr_generalID        = ?");	
			    $result->bindParam(1, $pagetitle);
				$result->bindParam(2, $column1);
				$result->bindParam(3, $column2);
				$result->bindParam(4, $column3);
				$result->bindParam(5, $photoca);
				$result->bindParam(6, $metakeywords);
				$result->bindParam(7, $metadesc);
				$result->bindParam(8, $NowDate);
				$result->bindParam(9, $link);
				$result->bindParam(10, $adminLoginID);
				$result->bindParam(11, $pagegeneralIDh);
				$result->execute();
    		}
		}
		else {
			$result = $this->pdo->prepare("UPDATE cr_general SET 
		    		cr_generalTitle           = ?, 
		    		cr_generalColumn1         = ?, 
		    		cr_generalColumn2         = ?, 
		    		cr_generalColumn3         = ?,   
		    		cr_generalMetaKeywords    = ?,
		    		cr_generalMetaDescription = ?,
		    		cr_generalDate            = ?,
		    		cr_generalLink            = ?,
		    		cr_adminID                = ? 
		    		WHERE cr_generalID        = ?");	
		    $result->bindParam(1, $pagetitle);
			$result->bindParam(2, $column1);
			$result->bindParam(3, $column2);
			$result->bindParam(4, $column3);
			$result->bindParam(5, $metakeywords);
			$result->bindParam(6, $metadesc);
			$result->bindParam(7, $NowDate);
			$result->bindParam(8, $link);
			$result->bindParam(9, $adminLoginID);
			$result->bindParam(10, $pagegeneralIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Data in Page $menuTitle', ?, ?, ?)");
		$historyDetail = " edit data in page ".$menuTitle.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteFeaturedImage($page_id) {
    	global $NowDate;
    	$value  = ''; 
    	$result = $this->pdo->prepare("UPDATE cr_general SET 
		    		cr_generalFeaturedImage = ? 
		    		WHERE cr_generalID      = ?");	
		$result->bindParam(1, $value);
		$result->bindParam(2, $page_id);
		$result->execute();
    }
}

class contact {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewContact($link) {
    	$result = $this->pdo->query("SELECT * FROM cr_contact WHERE cr_contactLink='$link' LIMIT 1");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		    $rows = $result->fetch(PDO::FETCH_OBJ);
			return $rows;
		}
    }
    public function addContact($desc, $social, $customheader, $customdesc, $linkcontact, $adminLoginID) {
    	global $NowDate;
    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$linkcontact'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$linkcontact'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_submenuTitle;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$linkcontact'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_menuTitle;
    	} 

	    $result = $this->pdo->prepare("INSERT INTO cr_contact(
			    		cr_contactCustomheader, cr_contactCustomDesc, cr_contactDesc, cr_contactSocial, cr_contactLink, cr_adminID) VALUES (?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $customheader);
		$result->bindParam(2, $customdesc);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $social);
		$result->bindParam(5, $linkcontact);
		$result->bindParam(6, $adminLoginID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Contact Information', ?, ?, ?)");
		$historyDetail = " add contact information in page ".$pagename.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editContact($contactID) {
    	$result = $this->pdo->query("SELECT * FROM cr_contact WHERE cr_contactID='$contactID'");
		$rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows;
    }
    public function updateContact($desc, $social, $customheader, $customdesc, $linkcontact, $contactIDh, $adminLoginID) {
    	global $NowDate;
    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$linkcontact'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$linkcontact'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_submenuTitle;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$linkcontact'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_menuTitle;
    	} 

	    $result = $this->pdo->prepare("UPDATE cr_contact SET 
	    		cr_contactCustomheader  = ?,
	    		cr_contactCustomDesc    = ?,
	    		cr_contactDesc          = ?,
	    		cr_contactSocial        = ?,
	    		cr_contactLink          = ?,
	    		cr_adminID              = ?
	    		WHERE cr_contactID = ?");	
	    $result->bindParam(1, $customheader);
		$result->bindParam(2, $customdesc);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $social);
		$result->bindParam(5, $linkcontact);
		$result->bindParam(6, $adminLoginID);
		$result->bindParam(7, $contactIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Contact Information', ?, ?, ?)");
		$historyDetail = " edit contact information in page ".$pagename.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
   	public function deleteContact($contactID, $linkcontact, $adminLoginID) {
   		global $NowDate;
   		$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$linkcontact'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$linkcontact'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_submenuTitle;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$linkcontact'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_menuTitle;
    	}

    	$result = $this->pdo->prepare("DELETE FROM cr_contact WHERE cr_contactID = ?");
    	$result->bindParam(1, $contactID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Contact Information', ?, ?, ?)");
		$historyDetail = " delete contact information in page ".$pagename.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class blogcategory {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewAllBlogcategory() {
    	$result  = $this->pdo->query("SELECT * FROM  cr_blogcategory ORDER BY cr_blogcategoryOrder asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function viewBlogcategory($pagelink) {
    	$cek  = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_submenu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    		if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
	    	if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    }
    public function viewTotalBlogcategory($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    	if($result->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_submenu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    		$total = $result->rowCount();
    		return $total;
    	}
    	else {
    		$total = $result->rowCount();
    		return $total;
    	}
    }
    public function viewTotalBlog($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogID desc");
    	$total = $result->rowCount();
    	return $total;
    }
    public function addBlogcategory($name, $pagelink, $adminLoginID) {
    	global $NowDate;
    	$nameUpper = ucwords($name);
    	$slug      = create_slug($name);
	    $result = $this->pdo->prepare("INSERT INTO cr_blogcategory(
			    		cr_blogcategoryName, cr_blogcategorySlug, cr_blogcategoryLink, cr_blogcategoryDate) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $nameUpper);
		$result->bindParam(2, $slug);
		$result->bindParam(3, $pagelink);
		$result->bindParam(4, $NowDate);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Blog Category', ?, ?, ?)");
		$historyDetail = " add ".$nameUpper." in blog category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateBlogcategory($name, $nameold, $blogcategoryIDh, $adminLoginID) {
    	global $NowDate;
    	$nameUpper = ucwords($name);
    	$slug      = create_slug($name);
	    $result = $this->pdo->prepare("UPDATE cr_blogcategory SET 
	    	cr_blogcategoryName = ?,
	    	cr_blogcategorySlug = ?,
	    	cr_blogcategoryDate = ? 
	    	WHERE cr_blogcategoryID = ?");
		$result->bindParam(1, $nameUpper);
		$result->bindParam(2, $slug);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $blogcategoryIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog Category', ?, ?, ?)");
		$historyDetail = " edit blog category from ".$nameold." to ".$nameUpper.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function checkNameBC($name) {
    	$result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryName = '$name'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
    public function reorderBlogcategory($idArray) {
    	$count = 1;
    	foreach ($idArray as $id){
			$update = $this->pdo->query("UPDATE cr_blogcategory SET cr_blogcategoryOrder = $count WHERE cr_blogcategoryID = $id");
			$count ++;	
		}
		return true;
    }
    public function checkInBC($bcID) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogcategoryID = '$bcID'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
   	public function checkInBC2($bcID) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogcategoryID = '$bcID'");
	    return $result->rowCount();
   	}
   	public function deleteBC($bcID, $adminLoginID) {
   		global $NowDate;
   		$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$bcID'");
    	$cekbc_f = $cekbc_q->fetch(PDO::FETCH_OBJ);
    	$catName = $cekbc_f->cr_blogcategoryName;

    	$result = $this->pdo->prepare("DELETE FROM cr_blogcategory WHERE cr_blogcategoryID = ?");
    	$result->bindParam(1, $bcID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Blog Category', ?, ?, ?)");
		$historyDetail = " delete ".$catName." in blog category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class blog {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewBlogLikes($blogID) {
    	$result = $this->pdo->query("SELECT * FROM cr_bloglikes WHERE cr_blogID='$blogID'");
    	$total  = $result->rowCount();
    	return $total;
    }
    public function countVisitor($blogID) {
        $result = $this->pdo->query("SELECT * FROM cr_blogvisitor WHERE cr_blogID='$blogID'");
        $total = $result->rowCount();
        return $total;
    }
    public function viewBlog($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogID desc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewBlognameASC($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogTitle asc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewBlognameDESC($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogTitle desc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewBlogdateASC($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogDate asc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewBlogPageinMenu() {
    	$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_pagetemplateID='4' OR cr_pagetemplateID='5' ORDER BY cr_menuTitle asc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewBlogPageinSubmenu() {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_pagetemplateID='4' OR cr_pagetemplateID='5' ORDER BY cr_submenuTitle asc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function viewBlogPageMenuCategory($id) {
    	$result = $this->pdo->query("SELECT * FROM cr_menu, cr_blogcategory WHERE cr_menu.cr_menuID='$id' AND cr_blogcategory.cr_blogcategoryLink=cr_menu.cr_menuLink");
		while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function viewBlogPageSubmenuCategory($id) {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu, cr_blogcategory WHERE cr_submenu.cr_submenuID='$id' AND cr_blogcategory.cr_blogcategoryLink=cr_submenu.cr_submenuLink");
		while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function viewBlogCurrentCat($catID) {
    	$result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$catID'");
		$rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_blogcategoryName;
    }
    public function checkBlogName($title) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogTitle='$title'");
    	$total = $result->rowCount();
    	if($total < 1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$alert = 1;
    		return $alert;
    	}
    }
    public function checkBlogNameEdit($id, $title) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogID<>'$id' AND cr_blogTitle='$title'");
    	$total = $result->rowCount();
    	if($total < 1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$alert = 1;
    		return $alert;
    	}
    }
    public function addBlogStandard($title, $content, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = ucwords($cekbt_f['cr_blogtypeName']);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogDate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogMetaKeywords, cr_blogMetaDescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $metakey);
		$result->bindParam(10, $metadesc);
		$result->bindParam(11, $status);
		$result->bindParam(12, $adminLoginID);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " add new post($btName, ".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addBlogImage($title, $content, $blogtype, $tags, $noimplodetags, $photo, $cat, $status, $comment, $metakey, $metadesc, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = ucwords($cekbt_f['cr_blogtypeName']);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogDate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogFeatured, cr_blogMetaKeywords, cr_blogMetaDescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $photo);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $adminLoginID);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " add new post($btName, ".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addBlogVideo($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = ucwords($cekbt_f['cr_blogtypeName']);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogDate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogFeatured, cr_blogMetaKeywords, cr_blogMetaDescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $link);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $adminLoginID);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " add new post($btName, ".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addBlogQuote($from, $quotetext, $blogtype, $tags, $noimplodetags, $cat, $status, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($from);
    	$urllink    = create_slug($from);
    	$comment    = "off";
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = ucwords($cekbt_f['cr_blogtypeName']);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogDate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $quotetext);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $status);
		$result->bindParam(10, $adminLoginID);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " add new post($btName, ".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addBlogLink($title, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	$comment    = "off";
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = ucwords($cekbt_f['cr_blogtypeName']);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogDate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $link);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $status);
		$result->bindParam(10, $adminLoginID);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " add new post($btName, ".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addBlogSound($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = ucwords($cekbt_f['cr_blogtypeName']);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogDate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogFeatured, cr_blogMetaKeywords, cr_blogMetaDescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $link);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $adminLoginID);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " add new post($btName, ".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editBlog($blogID) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogID='$blogID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function checkBlogType($blogID) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogtype WHERE cr_blog.cr_blogID='$blogID' AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateBlogImage($title, $content, $blogtype, $tags, $noimplodetags, $photo, $photourlnc, $cat, $status, $comment, $metakey, $metadesc, $blogIDh, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	$photoca     = str_replace(MADMINURL."/..","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekb_q = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogID='$blogIDh'");
    	$cekb_f = $cekb_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekb_f->cr_blogFeatured;

    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	if($photocb!=$photourlnc) {
    		$blogImageGIF  = str_replace(".png",".gif",$thname);
        	$blogImageJPG  = str_replace(".png",".jpg",$thname);
        	$blogImageJPEG = str_replace(".png",".jpeg",$thname);

        	$blogImageLink     = str_replace("/thumbnails","",$thname);
        	$blogImageGIFLink  = str_replace("/thumbnails","",$blogImageGIF);
        	$blogImageJPGLink  = str_replace("/thumbnails","",$blogImageJPG);
        	$blogImageJPEGLink = str_replace("/thumbnails","",$blogImageJPEG);

    		//unlink old thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$thname);
    		//unlink old real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageJPEGLink);

    		$result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogDate            = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogFeatured        = ?,
		    		cr_blogMetaKeywords    = ?,
		    		cr_blogMetaDescription = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $content);
			$result->bindParam(3, $NowDate);
			$result->bindParam(4, $urllink);
			$result->bindParam(5, $blogtype);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $tags);
			$result->bindParam(8, $comment);
			$result->bindParam(9, $photoca);
			$result->bindParam(10, $metakey);
			$result->bindParam(11, $metadesc);
			$result->bindParam(12, $status);
			$result->bindParam(13, $adminLoginID);
			$result->bindParam(14, $blogIDh);
			$result->execute();
    	}
    	else {
		    $result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogDate            = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogMetaKeywords    = ?,
		    		cr_blogMetaDescription = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $content);
			$result->bindParam(3, $NowDate);
			$result->bindParam(4, $urllink);
			$result->bindParam(5, $blogtype);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $tags);
			$result->bindParam(8, $comment);
			$result->bindParam(9, $metakey);
			$result->bindParam(10, $metadesc);
			$result->bindParam(11, $status);
			$result->bindParam(12, $adminLoginID);
			$result->bindParam(13, $blogIDh);
			$result->execute();
		}

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
		$historyDetail = " edit ".$titleupper." (".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateBlogStandard($title, $content, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blogIDh, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}

    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];
    	
		    $result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogDate            = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogMetaKeywords    = ?,
		    		cr_blogMetaDescription = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $content);
			$result->bindParam(3, $NowDate);
			$result->bindParam(4, $urllink);
			$result->bindParam(5, $blogtype);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $tags);
			$result->bindParam(8, $comment);
			$result->bindParam(9, $metakey);
			$result->bindParam(10, $metadesc);
			$result->bindParam(11, $status);
			$result->bindParam(12, $adminLoginID);
			$result->bindParam(13, $blogIDh);
			$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
		$historyDetail = " edit ".$titleupper." (".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateBlogVideo($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blogIDh, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}

    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];
    	
		    $result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogDate            = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogFeatured        = ?,
		    		cr_blogMetaKeywords    = ?,
		    		cr_blogMetaDescription = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $content);
			$result->bindParam(3, $NowDate);
			$result->bindParam(4, $urllink);
			$result->bindParam(5, $blogtype);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $tags);
			$result->bindParam(8, $comment);
			$result->bindParam(9, $link);
			$result->bindParam(10, $metakey);
			$result->bindParam(11, $metadesc);
			$result->bindParam(12, $status);
			$result->bindParam(13, $adminLoginID);
			$result->bindParam(14, $blogIDh);
			$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
		$historyDetail = " edit ".$titleupper." (".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateBlogQuote($from, $quotetext, $blogtype, $tags, $noimplodetags, $cat, $status, $blogIDh, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($from);
    	$urllink    = create_slug($from);
    	$comment    = "off";
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = $cekbt_f['cr_blogtypeName'];

    	$result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogDate            = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $quotetext);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $status);
		$result->bindParam(10, $adminLoginID);
		$result->bindParam(11, $blogIDh);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " edit quote from ".$titleupper." (".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateBlogLink($title, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $blogIDh, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	$comment    = "off";
    	
    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];

    	$cekbt_q = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID='$blogtype'");
    	$cekbt_f = $cekbt_q->fetch();
    	$btName  = $cekbt_f['cr_blogtypeName'];

    	$result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogDate            = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $link);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $status);
		$result->bindParam(10, $adminLoginID);
		$result->bindParam(11, $blogIDh);
		$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

		$historyDetail = " edit link for ".$titleupper." (".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $adminLoginID);
		$getHistory->bindParam(3, $NowDate);
		$getHistory->execute();
    }
    public function updateBlogSound($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blogIDh, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}

    	$cekbc_q = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID='$cat'");
    	$cekbc_f = $cekbc_q->fetch();
    	$catName = $cekbc_f['cr_blogcategoryName'];
    	
		    $result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogDate            = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogFeatured        = ?,
		    		cr_blogMetaKeywords    = ?,
		    		cr_blogMetaDescription = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $content);
			$result->bindParam(3, $NowDate);
			$result->bindParam(4, $urllink);
			$result->bindParam(5, $blogtype);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $tags);
			$result->bindParam(8, $comment);
			$result->bindParam(9, $link);
			$result->bindParam(10, $metakey);
			$result->bindParam(11, $metadesc);
			$result->bindParam(12, $status);
			$result->bindParam(13, $adminLoginID);
			$result->bindParam(14, $blogIDh);
			$result->execute();

		foreach($noimplodetags as $tagsname) {
			$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
			    		cr_blogtagsName) VALUES (?)");
			$result->bindParam(1, $tagsname);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
		$historyDetail = " edit ".$titleupper." (".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteBlog($blogID, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogID = '$blogID'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$blogImage = $check_f->cr_blogFeatured;
    	$blogTitle = $check_f->cr_blogTitle;
    	$blogCat   = $check_f->cr_blogcategoryName;

    	$blogImageGIF  = str_replace(".png",".gif",$blogImage);
        $blogImageJPG  = str_replace(".png",".jpg",$blogImage);
        $blogImageJPEG = str_replace(".png",".jpeg",$blogImage);

        $blogImageLink     = str_replace("/thumbnails","",$blogImage);
        $blogImageGIFLink  = str_replace("/thumbnails","",$blogImageGIF);
        $blogImageJPGLink  = str_replace("/thumbnails","",$blogImageJPG);
        $blogImageJPEGLink = str_replace("/thumbnails","",$blogImageJPEG);

        if(!empty($blogImage) || $blogImage!="") { 
    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImage);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$blogImageJPEGLink);
    	}
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_blog WHERE cr_blogID = ?");
    	$result->bindParam(1, $blogID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Post', ?, ?, ?)");
		$historyDetail = " delete ".$blogTitle." in ".$blogCat." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function allBlogTags() {
    	$result  = $this->pdo->query("SELECT * FROM cr_blogtags ORDER BY cr_blogtagsID asc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			   	$data[]=$rows;
			return $data;
		}
    }
}

class comment {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewTotalComments($blogID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID='$blogID'");
    	$total = $result->rowCount();
		return $total;
    }
    public function viewComments($blogID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID='$blogID' ORDER BY cr_commentDate asc");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			   	$data[]=$rows;
			return $data;
		}
    }
    public function viewReply($replyID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentID='$replyID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows;
    }
    public function getAdmindata($displayname) {
    	$display = strtolower($displayname);
    	$result  = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminDisplayName='$display' LIMIT 1");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function replyComment($commentID, $content, $blogID, $adminLoginID) {
    	global $NowDate;
    	$admin_q = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID='$adminLoginID'");
    	$admin_f = $admin_q->fetch(PDO::FETCH_OBJ);
    	$adminDisplayName = ucwords($admin_f->cr_adminDisplayName);
    	$adminEmail       = $admin_f->cr_adminEmail;
    	$status  = "3";

    	$cname_q = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentID='$commentID'");
    	$cname_f = $cname_q->fetch(PDO::FETCH_OBJ);
    	$cname   = ucwords($cname_f->cr_commentName);

	    $result = $this->pdo->prepare("INSERT INTO cr_comment(
			    		cr_commentName, cr_commentEmail, cr_commentContent, cr_commentDate, cr_commentStatus, cr_commentReply, cr_blogID) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $adminDisplayName);
		$result->bindParam(2, $adminEmail);
		$result->bindParam(3, $content);
		$result->bindParam(4, $NowDate);
		$result->bindParam(5, $status);
		$result->bindParam(6, $commentID);
		$result->bindParam(7, $blogID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Reply Post Comment', ?, ?, ?)");
		$historyDetail = " reply comment from ".$cname.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function approveComment($commentID) {
    	$status = 2;
		$result = $this->pdo->prepare("UPDATE cr_comment SET cr_commentStatus = ? WHERE cr_commentID = ?");
		$result->bindParam(1, $status);
		$result->bindParam(2, $commentID);
		$result->execute();
    }
    public function unapproveComment($commentID) {
    	$status = 1;
		$result = $this->pdo->prepare("UPDATE cr_comment SET cr_commentStatus = ? WHERE cr_commentID = ?");
		$result->bindParam(1, $status);
		$result->bindParam(2, $commentID);
		$result->execute();
    }
    public function deleteComment($commentID, $adminLoginID) {
    	global $NowDate;
    	$check_q = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentID='$commentID'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
		$check   = $check_f->cr_commentName;

    	$result = $this->pdo->prepare("DELETE FROM cr_comment WHERE cr_commentID = ?");
    	$result->bindParam(1, $commentID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Comment', ?, ?, ?)");
		$historyDetail = " delete comment from ".$check.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class E_Commerce_Product_Category {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_product_category() {
    	$result  = $this->pdo->query("SELECT * FROM cr_productcategory ORDER BY cr_portfoliocategoryOrder asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[] = $rows;
		return $data;
    }
    public function view_product_category($page_link) {
    	$cek  = $this->pdo->query("SELECT * FROM cr_productcategory, cr_menu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_menu.cr_menuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_productcategory, cr_submenu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
    		if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[] = $rows;
			    return $data;
			}
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_productcategory, cr_menu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_menu.cr_menuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
	    	if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[] = $rows;
			    return $data;
			}
    	}
    }
    public function view_total_product_category($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_productcategory, cr_menu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_menu.cr_menuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
    	if($result->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_productcategory, cr_submenu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
    		$total = $result->rowCount();
	    	return $total;
    	}
    	else {
	    	$total = $result->rowCount();
	    	return $total;
    	}
    }
    public function view_total_product($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productID desc");
	    $total = $result->rowCount();
	    return $total;
    }
    public function add_product_category($name, $page_link, $admin_login_id) {
    	global $NowDate;
    	$name_upper = ucwords($name);
	    $result = $this->pdo->prepare("INSERT INTO cr_productcategory(
			    		cr_productcategoryName, cr_productcategoryLink, cr_productcategoryDate) VALUES (?, ?, ?)");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $page_link);
		$result->bindParam(3, $NowDate);
		$result->execute();

		$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add E-Commerce Product Category', ?, ?, ?)");
		$history_detail = " add ".$name_upper." in e-commerce product category.";
		$get_history->bindParam(1, $history_detail);
		$get_history->bindParam(2, $NowDate);
		$get_history->bindParam(3, $admin_login_id);
		$get_history->execute();
    }
    public function check_name_proc($name) {
    	$result = $this->pdo->query("SELECT * FROM cr_productcategory WHERE cr_productcategoryName = '$name'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
   	public function check_update_name_proc($name, $id) {
    	$result = $this->pdo->query("SELECT * FROM cr_productcategory WHERE cr_productcategoryName = '$name' AND cr_productcategoryID <> '$id'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
    public function update_product_category($name, $name_old, $product_category_idh, $admin_login_id) {
    	global $NowDate;
    	$name_upper = ucwords($name);
	    $result = $this->pdo->prepare("UPDATE cr_productcategory SET 
	    	cr_productcategoryName = ?,
	    	cr_productcategoryDate = ? 
	    	WHERE cr_productcategoryID = ?");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $NowDate);
		$result->bindParam(3, $product_category_idh);
		$result->execute();

		$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit E-Commerce Product Category', ?, ?, ?)");
		$history_detail = " edit e-commerce product category from ".$name_old." to ".$name_upper.".";
		$get_history->bindParam(1, $history_detail);
		$get_history->bindParam(2, $NowDate);
		$get_history->bindParam(3, $admin_login_id);
		$get_history->execute();
    }
    public function reorder_product_category($id_array) {
    	$count = 1;
    	foreach ($id_array as $id){
			$update = $this->pdo->query("UPDATE cr_productcategory SET cr_productcategoryOrder = $count WHERE cr_productcategoryID = $id");
			$count ++;	
		}
		return true;
    }
    public function check_in_proc($pcid) {
    	$result = $this->pdo->query("SELECT * FROM cr_product WHERE cr_productcategoryID = '$pcid'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
   	public function check_in_proc2($pcid) {
    	$result = $this->pdo->query("SELECT * FROM cr_product WHERE cr_productcategoryID = '$pcid'");
	    return $result->rowCount();
   	}
   	public function delete_proc($pcid, $admin_login_id) {
   		global $NowDate;
   		$checkproc_query = $this->pdo->query("SELECT * FROM cr_productcategory WHERE cr_productcategoryID = '$pcid'");
    	$checkproc_fetch = $checkproc_query->fetch(PDO::FETCH_OBJ);
    	$cat_name = $checkproc_fetch->cr_productcategoryName;

    	$result = $this->pdo->prepare("DELETE FROM cr_productcategory WHERE cr_productcategoryID = ?");
    	$result->bindParam(1, $pcid);
    	$result->execute();

    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete E-Commerce Product Category', ?, ?, ?)");
		$history_detail = " delete ".$cat_name." in e-commerce product category.";
		$get_history->bindParam(1, $history_detail);
		$get_history->bindParam(2, $NowDate);
		$get_history->bindParam(3, $admin_login_id);
		$get_history->execute();
    }
}

class E_Commerce_Product {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_product($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productID desc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function view_product_date_asc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productDate asc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function view_product_name_asc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productTitle asc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function view_product_name_desc($page_link) {
    	$result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productTitle desc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function view_product_extra($pid) {
    	$result = $this->pdo->query("SELECT * FROM cr_product, cr_productextra WHERE cr_product.cr_productID = cr_productextra.cr_productID AND cr_productextra.cr_productID = '$pid'");
	    $alert = $result->rowCount();
	    return $alert;
    }
    public function count_likes($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_productlikes WHERE cr_productID = '$pid'");
        $total = $result->rowCount();
        return $total;
    }
    public function count_visitor($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_productvisitor WHERE cr_productID = '$pid'");
        $total = $result->rowCount();
        return $total;
    }
    public function add_product($title, $desc, $photo, $sliderimage, $slidercap, $price, $cat, $status, $filepdf, $metakey, $metadesc, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	$cekpc_q = $this->pdo->query("SELECT * FROM cr_productcategory WHERE cr_productcategoryID='$cat'");
    	$cekpc_f = $cekpc_q->fetch(PDO::FETCH_OBJ);
    	$catName = $cekpc_f->cr_productcategoryName;
	    $result = $this->pdo->prepare("INSERT INTO cr_product(
			    		cr_productTitle, cr_productLink, cr_productDesc, cr_productSliderimage, cr_productSlidercaption, cr_productPrice, cr_productDate, cr_productThumb, cr_productcategoryID, cr_productPDF,  cr_productMetaKeywords, cr_productMetaDescription, cr_productStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $urllink);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $sliderimage);
		$result->bindParam(5, $slidercap);
		$result->bindParam(6, $price);
		$result->bindParam(7, $NowDate);
		$result->bindParam(8, $photo);
		$result->bindParam(9, $cat);
		$result->bindParam(10, $filepdf);
		$result->bindParam(11, $metakey);
		$result->bindParam(12, $metadesc);
		$result->bindParam(13, $status);
		$result->bindParam(14, $adminLoginID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add E-Commerce Product', ?, ?, ?)");

		$historyDetail = " add ".$titleupper." (".ucwords($status).") as a new e-commerce product in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function check_name_product($title) {
    	$result = $this->pdo->query("SELECT * FROM cr_product WHERE cr_productTitle = '$title'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
    public function delete_product($pid, $admin_login_id) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_product.cr_productID = '$pid'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$productImage = $check_f->cr_productThumb;
    	$productTitle = $check_f->cr_productTitle;
    	$productCat   = $check_f->cr_productcategoryName;

    	$productImageGIF  = str_replace(".png",".gif",$productImage);
        $productImageJPG  = str_replace(".png",".jpg",$productImage);
        $productImageJPEG = str_replace(".png",".jpeg",$productImage);

        $productImageLink     = str_replace("/thumbnails","",$productImage);
        $productImageGIFLink  = str_replace("/thumbnails","",$productImageGIF);
        $productImageJPGLink  = str_replace("/thumbnails","",$productImageJPG);
        $productImageJPEGLink = str_replace("/thumbnails","",$productImageJPEG);

    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$productImage);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$productImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$productImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$productImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$productImageJPEGLink);
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_product WHERE cr_portfolioproductID = ?");
    	$result->bindParam(1, $pid);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete E-Commerce Product', ?, ?, ?)");
		$historyDetail = " delete ".$portfolioTitle." in ".$portfolioCat." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $admin_login_id);
		$getHistory->execute();
    }
}

class portfoliocategory {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewAllPortfoliocategory() {
    	$result  = $this->pdo->query("SELECT * FROM  cr_portfoliocategory ORDER BY cr_portfoliocategoryOrder asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function viewPortfoliocategory($pagelink) {
    	$cek  = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_submenu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
    		if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
	    	if($result->rowCount() < 1){
	    		$alert = 0;
	    		return $alert;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    }
    public function viewTotalPortfoliocategory($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
    	if($result->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_portfoliocategory, cr_submenu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
    		$total = $result->rowCount();
	    	return $total;
    	}
    	else {
	    	$total = $result->rowCount();
	    	return $total;
    	}
    }
    public function viewTotalPortfolio($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioID desc");
	    $total = $result->rowCount();
	    return $total;
    }
    public function addPortfoliocategory($name, $pagelink, $adminLoginID) {
    	global $NowDate;
    	$nameUpper = ucwords($name);
	    $result = $this->pdo->prepare("INSERT INTO cr_portfoliocategory(
			    		cr_portfoliocategoryName, cr_portfoliocategoryLink, cr_portfoliocategoryDate) VALUES (?, ?, ?)");
		$result->bindParam(1, $nameUpper);
		$result->bindParam(2, $pagelink);
		$result->bindParam(3, $NowDate);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Portfolio/Product Category', ?, ?, ?)");
		$historyDetail = " add ".$nameUpper." in portfolio category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function checkNamePC($name) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryName = '$name'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
   	public function checkUpdateNamePC($name, $id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryName = '$name' AND cr_portfoliocategoryID<>'$id'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
    public function updatePortfoliocategory($name, $nameold, $portfoliocategoryIDh, $adminLoginID) {
    	global $NowDate;
    	$nameUpper = ucwords($name);
	    $result = $this->pdo->prepare("UPDATE cr_portfoliocategory SET 
	    	cr_portfoliocategoryName = ?,
	    	cr_portfoliocategoryDate = ? 
	    	WHERE cr_portfoliocategoryID = ?");
		$result->bindParam(1, $nameUpper);
		$result->bindParam(2, $NowDate);
		$result->bindParam(3, $portfoliocategoryIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Portfolio Category', ?, ?, ?)");
		$historyDetail = " edit portfolio category from ".$nameold." to ".$nameUpper.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function reorderPortfoliocategory($idArray) {
    	$count = 1;
    	foreach ($idArray as $id){
			$update = $this->pdo->query("UPDATE cr_portfoliocategory SET cr_portfoliocategoryOrder = $count WHERE cr_portfoliocategoryID = $id");
			$count ++;	
		}
		return true;
    }
    public function checkInPC($pcID) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfoliocategoryID = '$pcID'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
   	public function checkInPC2($pcID) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfoliocategoryID = '$pcID'");
	    return $result->rowCount();
   	}
   	public function deletePC($pcID, $adminLoginID) {
   		global $NowDate;
   		$cekpc_q = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID='$pcID'");
    	$cekpc_f = $cekpc_q->fetch(PDO::FETCH_OBJ);
    	$catName = $cekpc_f->cr_portfoliocategoryName;

    	$result = $this->pdo->prepare("DELETE FROM cr_portfoliocategory WHERE cr_portfoliocategoryID = ?");
    	$result->bindParam(1, $pcID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Portfolio/Product Category', ?, ?, ?)");
		$historyDetail = " delete ".$catName." in portfolio category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class portfolio {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewPortfolio($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioID desc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function viewPortfoliodateASC($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioDate asc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function viewPortfolionameASC($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle asc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function viewPortfolionameDESC($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$pagelink' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle desc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		return $data;
    }
    public function viewPortfolioExtra($pID) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfolioextra WHERE cr_portfolio.cr_portfolioID=cr_portfolioextra.cr_portfolioID AND cr_portfolioextra.cr_portfolioID='$pID'");
	    $alert = $result->rowCount();
	    return $alert;
    }
    public function countLikes($pID) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliolikes WHERE cr_portfolioID='$pID'");
        $total = $result->rowCount();
        return $total;
    }
    public function countVisitor($pID) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliovisitor WHERE cr_portfolioID='$pID'");
        $total = $result->rowCount();
        return $total;
    }
    public function addPortfolio($title, $desc, $photo, $photoct, $cat, $status, $metakey, $metadesc, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	$cekpc_q = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID='$cat'");
    	$cekpc_f = $cekpc_q->fetch();
    	$catName = $cekpc_f['cr_portfoliocategoryName'];
	    $result = $this->pdo->prepare("INSERT INTO cr_portfolio(
			    		cr_portfolioTitle, cr_portfolioLink, cr_portfolioDesc, cr_portfolioDate, cr_portfolioThumb, cr_portfolioCustomthumb, cr_portfoliocategoryID, cr_portfolioMetaKeywords, cr_portfolioMetaDescription, cr_portfolioStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $urllink);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $NowDate);
		$result->bindParam(5, $photo);
		$result->bindParam(6, $photoct);
		$result->bindParam(7, $cat);
		$result->bindParam(8, $metakey);
		$result->bindParam(9, $metadesc);
		$result->bindParam(10, $status);
		$result->bindParam(11, $adminLoginID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Portfolio', ?, ?, ?)");

		$historyDetail = " add ".$titleupper." (".ucwords($status).") as a new portfolio in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editPortfolio($portfolioID) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID='$portfolioID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updatePortfolio($title, $desc, $photo, $photoct, $photourlnc, $photocturlnc, $customthumbnail, $cat, $status, $metakey, $metadesc, $adminLoginID, $portfolioIDh) {
    	global $NowDate;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	$photoca    = str_replace(MADMINURL."/..","",$photo);
    	$photocb    = str_replace(MURL,"",$photo);
    	$photocact  = str_replace(MADMINURL."/..","",$photoct);
    	$photocbct  = str_replace(MURL,"",$photoct);
    	$cekp_q  = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID='$portfolioIDh'");
    	$cekp_f  = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname  = $cekp_f->cr_portfolioThumb;
    	$cthname = $cekp_f->cr_portfolioCustomthumb;

    	$cekpc_q = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID='$cat'");
    	$cekpc_f = $cekpc_q->fetch();
    	$catName = $cekpc_f['cr_portfoliocategoryName'];

    	if($photocb!=$photourlnc) {
    		$portfolioImageGIF  = str_replace(".png",".gif",$thname);
        	$portfolioImageJPG  = str_replace(".png",".jpg",$thname);
        	$portfolioImageJPEG = str_replace(".png",".jpeg",$thname);

        	$portfolioImageLink     = str_replace("/thumbnails","",$thname);
        	$portfolioImageGIFLink  = str_replace("/thumbnails","",$portfolioImageGIF);
        	$portfolioImageJPGLink  = str_replace("/thumbnails","",$portfolioImageJPG);
        	$portfolioImageJPEGLink = str_replace("/thumbnails","",$portfolioImageJPEG);

    		//unlink old thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$thname);
    		//unlink old real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageJPEGLink);

    		if($photocbct!=$photocturlnc) {
    			$ctportfolioImageGIF  = str_replace(".png",".gif",$cthname);
	        	$ctportfolioImageJPG  = str_replace(".png",".jpg",$cthname);
	        	$ctportfolioImageJPEG = str_replace(".png",".jpeg",$cthname);

	        	$ctportfolioImageLink     = str_replace("/thumbnails","",$cthname);
	        	$ctportfolioImageGIFLink  = str_replace("/thumbnails","",$ctportfolioImageGIF);
	        	$ctportfolioImageJPGLink  = str_replace("/thumbnails","",$ctportfolioImageJPG);
	        	$ctportfolioImageJPEGLink = str_replace("/thumbnails","",$ctportfolioImageJPEG);

	    		//unlink old thumbnail
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$cthname);
	    		//unlink old real image
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$ctportfolioImageLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$ctportfolioImageGIFLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$ctportfolioImageJPGLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$ctportfolioImageJPEGLink);
    			$result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    		cr_portfolioTitle           = ?, 
		    		cr_portfolioLink            = ?,
		    		cr_portfolioDesc            = ?, 
		    		cr_portfolioDate            = ?,  
		    		cr_portfolioThumb           = ?,
		    		cr_portfolioCustomthumb     = ?,
		    		cr_portfoliocategoryID      = ?,
		    		cr_portfolioMetaKeywords    = ?,
		    		cr_portfolioMetaDescription = ?,
		    		cr_portfolioStatus          = ?,
		    		cr_adminID                  = ?
		    		WHERE cr_portfolioID        = ?");	
			    $result->bindParam(1, $titleupper);
			    $result->bindParam(2, $urllink);
				$result->bindParam(3, $desc);
				$result->bindParam(4, $NowDate);
				$result->bindParam(5, $photoca);
				$result->bindParam(6, $photocact);
				$result->bindParam(7, $cat);
				$result->bindParam(8, $metakey);
				$result->bindParam(9, $metadesc);
				$result->bindParam(10, $status);
				$result->bindParam(11, $adminLoginID);
				$result->bindParam(12, $portfolioIDh);
				$result->execute();
    		}
    		else {
    			$result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    		cr_portfolioTitle           = ?, 
		    		cr_portfolioLink            = ?,
		    		cr_portfolioDesc            = ?, 
		    		cr_portfolioDate            = ?,  
		    		cr_portfolioThumb           = ?,
		    		cr_portfoliocategoryID      = ?,
		    		cr_portfolioMetaKeywords    = ?,
		    		cr_portfolioMetaDescription = ?,
		    		cr_portfolioStatus          = ?,
		    		cr_adminID                  = ?
		    		WHERE cr_portfolioID        = ?");	
			    $result->bindParam(1, $titleupper);
			    $result->bindParam(2, $urllink);
				$result->bindParam(3, $desc);
				$result->bindParam(4, $NowDate);
				$result->bindParam(5, $photoca);
				$result->bindParam(6, $cat);
				$result->bindParam(7, $metakey);
				$result->bindParam(8, $metadesc);
				$result->bindParam(9, $status);
				$result->bindParam(10, $adminLoginID);
				$result->bindParam(11, $portfolioIDh);
				$result->execute();
    		}
    	}
    	else {
    		if($photocbct!=$photocturlnc) {
    			$result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    		cr_portfolioTitle           = ?, 
		    		cr_portfolioLink            = ?, 
		    		cr_portfolioDesc            = ?, 
		    		cr_portfolioDate            = ?,
		    		cr_portfolioCustomthumb     = ?,
		    		cr_portfoliocategoryID      = ?,
		    		cr_portfolioMetaKeywords    = ?,
		    		cr_portfolioMetaDescription = ?,
		    		cr_portfolioStatus          = ?,
		    		cr_adminID                  = ?
		    		WHERE cr_portfolioID        = ?");	
			    $result->bindParam(1, $titleupper);
			    $result->bindParam(2, $urllink);
				$result->bindParam(3, $desc);
				$result->bindParam(4, $NowDate);
				$result->bindParam(5, $photocact);
				$result->bindParam(6, $cat);
				$result->bindParam(7, $metakey);
				$result->bindParam(8, $metadesc);
				$result->bindParam(9, $status);
				$result->bindParam(10, $adminLoginID);
				$result->bindParam(11, $portfolioIDh);
				$result->execute();
    		}
    		else {
    			$result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    		cr_portfolioTitle           = ?, 
		    		cr_portfolioLink            = ?, 
		    		cr_portfolioDesc            = ?, 
		    		cr_portfolioDate            = ?,  
		    		cr_portfoliocategoryID      = ?,
		    		cr_portfolioMetaKeywords    = ?,
		    		cr_portfolioMetaDescription = ?,
		    		cr_portfolioStatus          = ?,
		    		cr_adminID                  = ?
		    		WHERE cr_portfolioID        = ?");	
			    $result->bindParam(1, $titleupper);
			    $result->bindParam(2, $urllink);
				$result->bindParam(3, $desc);
				$result->bindParam(4, $NowDate);
				$result->bindParam(5, $cat);
				$result->bindParam(6, $metakey);
				$result->bindParam(7, $metadesc);
				$result->bindParam(8, $status);
				$result->bindParam(9, $adminLoginID);
				$result->bindParam(10, $portfolioIDh);
				$result->execute();
    		}
		}
		if($customthumbnail=='no') {
			$nocustomthumb = '';
			$result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    		cr_portfolioCustomthumb = ?
		    		WHERE cr_portfolioID    = ?");	
			$result->bindParam(1, $nocustomthumb);
			$result->bindParam(2, $portfolioIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Portfolio', ?, ?, ?)");
		$historyDetail = " edit ".$titleupper." (".ucwords($status).") in ".$catName." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function checkNamePortfolio($title) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioTitle = '$title'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
   	public function checkUpdateNamePortfolio($title, $id) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioTitle = '$title' AND cr_portfolioID <> '$id'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	$alert = 1;
	    	return $alert;
	    }
   	}
    public function countselectedPortfolio() {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioSelected='yes'");
    	$total = $result->rowCount();
    	return $total;
    }
    public function setselectedPortfolio($adminLoginID, $portfolioIDh) {
    	global $NowDate;
    	$selected = "yes";
		    $result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    		cr_portfolioSelected   = ?
		    		WHERE cr_portfolioID   = ?");	
		    $result->bindParam(1, $selected);
			$result->bindParam(2, $portfolioIDh);
			$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Set Portfolio/Product as Selected', ?, ?, ?)");
		$historyDetail = " edit portfolio/product as selected portfolio/product to show at homepage.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function unsetselectedPortfolio($adminLoginID, $portfolioIDh) {
    	global $NowDate;
    	$selected = "";
		    $result = $this->pdo->prepare("UPDATE cr_portfolio SET 
		    		cr_portfolioSelected   = ?
		    		WHERE cr_portfolioID   = ?");	
		    $result->bindParam(1, $selected);
			$result->bindParam(2, $portfolioIDh);
			$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Unset Portfolio/Product as Selected', ?, ?, ?)");
		$historyDetail = " edit portfolio/product from selected to unselected.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deletePortfolio($portfolioID, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfolio.cr_portfolioID = '$portfolioID'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$portfolioImage = $check_f->cr_portfolioThumb;
    	$portfolioTitle = $check_f->cr_portfolioTitle;
    	$portfolioCat   = $check_f->cr_portfoliocategoryName;

    	$portfolioImageGIF  = str_replace(".png",".gif",$portfolioImage);
        $portfolioImageJPG  = str_replace(".png",".jpg",$portfolioImage);
        $portfolioImageJPEG = str_replace(".png",".jpeg",$portfolioImage);

        $portfolioImageLink     = str_replace("/thumbnails","",$portfolioImage);
        $portfolioImageGIFLink  = str_replace("/thumbnails","",$portfolioImageGIF);
        $portfolioImageJPGLink  = str_replace("/thumbnails","",$portfolioImageJPG);
        $portfolioImageJPEGLink = str_replace("/thumbnails","",$portfolioImageJPEG);

    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImage);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$portfolioImageJPEGLink);
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_portfolio WHERE cr_portfolioID = ?");
    	$result->bindParam(1, $portfolioID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Portfolio', ?, ?, ?)");
		$historyDetail = " delete ".$portfolioTitle." in ".$portfolioCat." category.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class portfolioextra {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewPortfolioExtra($pID) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolioextra WHERE cr_portfolioID='$pID'");
    	if($result->rowCount() < 1){
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
			return $data;
		}
    }
    public function addPortfolioExtra($name, $content, $portfolioID, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($name);
    	$check_q  = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID='$portfolioID'");
    	$check_f  = $check_q->fetch(PDO::FETCH_OBJ);
    	$check    = $check_f->cr_portfolioTitle;
	    $result = $this->pdo->prepare("INSERT INTO cr_portfolioextra(
			    		cr_portfolioextraName, cr_portfolioextraContent, cr_portfolioID) VALUES (?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $portfolioID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Extra Content to Portfolio/Product', ?, ?, ?)");

		$historyDetail = " add new extra content to ".$check.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editPortfolioExtra($portfolioextraID) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfolioextra WHERE cr_portfolioextraID='$portfolioextraID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function getSlugPortfolio($portfolioID) {
    	$chek = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryID=cr_portfolio.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink=cr_menu.cr_menuLink AND cr_portfolio.cr_portfolioID='$portfolioID'");
    	if($chek->rowCount()<1) {
    		$chek2 = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_submenu WHERE cr_portfoliocategory.cr_portfoliocategoryID=cr_portfolio.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink=cr_submenu.cr_submenuLink AND cr_portfolio.cr_portfolioID='$portfolioID'");
    		$rows = $chek2->fetch(PDO::FETCH_OBJ);
    		$menuLink = $rows->cr_submenuLink;
    		return $menuLink;
    	}
    	else {
    		$rows = $chek->fetch(PDO::FETCH_OBJ);
    		$menuLink = $rows->cr_menuLink;
    		return $menuLink;
    	}
    }
    public function updatePortfolioExtra($name, $content, $portfolioID, $adminLoginID, $portfolioextraIDh) {
    	global $NowDate;
    	$titleupper = ucwords($name);
    	$check_q  = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioID='$portfolioID'");
    	$check_f  = $check_q->fetch(PDO::FETCH_OBJ);
    	$check    = $check_f->cr_portfolioTitle;
		$result = $this->pdo->prepare("UPDATE cr_portfolioextra SET 
		    cr_portfolioextraName     = ?, 
		    cr_portfolioextraContent  = ?, 
		    cr_portfolioID            = ?
		    WHERE cr_portfolioextraID = ?");	
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $portfolioID);
		$result->bindParam(4, $portfolioextraIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update Extra Content to Portfolio/Product', ?, ?, ?)");
		$historyDetail = " update extra content(".$titleupper.") in ".$check.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deletePortfolioExtra($peID, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfolioextra WHERE cr_portfolioextra.cr_portfolioID = cr_portfolio.cr_portfolioID AND cr_portfolioextra.cr_portfolioextraID='$peID'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$peName  = $check_f->cr_portfolioextraName;
    	$pName   = $check_f->cr_portfolioTitle;
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_portfolioextra WHERE cr_portfolioextraID = ?");
    	$result->bindParam(1, $peID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Extra Content Portfolio/Product', ?, ?, ?)");
		$historyDetail = " delete ".$peName."(Extra Content) inside ".$pName.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class gallery {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewGallery($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_gallery, cr_admin WHERE cr_gallery.cr_galleryLink = '$pagelink' AND cr_gallery.cr_adminID = cr_admin.cr_adminID ORDER BY cr_gallery.cr_galleryID desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
		}
    }
    public function addGallery($title, $desc, $photo, $link, $adminLoginID) {
    	global $NowDate;
    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$link'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_submenuTitle;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_menuTitle;
    	}

    	$titleupper = ucwords($title);
	    $result = $this->pdo->prepare("INSERT INTO cr_gallery(
			    		cr_galleryTitle, cr_galleryDesc, cr_galleryDate, cr_galleryThumb, cr_galleryLink, cr_adminID) VALUES (?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $desc);
		$result->bindParam(3, $NowDate);
		$result->bindParam(4, $photo);
		$result->bindParam(5, $link);
		$result->bindParam(6, $adminLoginID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Photo in Gallery', ?, ?, ?)");

		$historyDetail = " add ".$titleupper." to page ".$pagename.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editGallery($galleryID) {
    	$result = $this->pdo->query("SELECT * FROM cr_gallery WHERE cr_galleryID='$galleryID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateGallery($title, $desc, $photo, $photourlnc, $link, $adminLoginID, $galleryIDh) {
    	global $NowDate;
    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$link'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_submenuTitle;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_menuTitle;
    	} 

    	$titleupper = ucwords($title);
    	$photoca     = str_replace(MADMINURL."/..","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekp_q = $this->pdo->query("SELECT * FROM cr_gallery WHERE cr_galleryID='$galleryIDh'");
    	$cekp_f = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekp_f->cr_galleryThumb;

    	if($photocb!=$photourlnc) {
    		$galleryImageGIF  = str_replace(".png",".gif",$thname);
        	$galleryImageJPG  = str_replace(".png",".jpg",$thname);
        	$galleryImageJPEG = str_replace(".png",".jpeg",$thname);

        	$galleryImageLink     = str_replace("/thumbnails","",$thname);
        	$galleryImageGIFLink  = str_replace("/thumbnails","",$galleryImageGIF);
        	$galleryImageJPGLink  = str_replace("/thumbnails","",$galleryImageJPG);
        	$galleryImageJPEGLink = str_replace("/thumbnails","",$galleryImageJPEG);

    		//unlink old thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$thname);
    		//unlink old real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageJPEGLink);

    		$result = $this->pdo->prepare("UPDATE cr_gallery SET 
		    		cr_galleryTitle      = ?, 
		    		cr_galleryDesc       = ?, 
		    		cr_galleryDate       = ?,  
		    		cr_galleryThumb      = ?,
		    		cr_galleryLink       = ?,
		    		cr_adminID           = ?
		    		WHERE cr_galleryID   = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $desc);
			$result->bindParam(3, $NowDate);
			$result->bindParam(4, $photoca);
			$result->bindParam(5, $link);
			$result->bindParam(6, $adminLoginID);
			$result->bindParam(7, $galleryIDh);
			$result->execute();
    	}
    	else {
		    $result = $this->pdo->prepare("UPDATE cr_gallery SET 
		    		cr_galleryTitle      = ?, 
		    		cr_galleryDesc       = ?, 
		    		cr_galleryDate       = ?,  
		    		cr_galleryLink       = ?,
		    		cr_adminID           = ?
		    		WHERE cr_galleryID   = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $desc);
			$result->bindParam(3, $NowDate);
			$result->bindParam(4, $link);
			$result->bindParam(5, $adminLoginID);
			$result->bindParam(6, $galleryIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Gallery', ?, ?, ?)");
		$historyDetail = " edit ".$titleupper." in page ".$pagename.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteGallery($galleryID, $link, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_gallery WHERE cr_galleryID = '$galleryID'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$galleryImage = $check_f->cr_galleryThumb;
    	$galleryTitle = $check_f->cr_galleryTitle;

    	$cek  = $this->pdo->query("SELECT * FROM  cr_menu WHERE cr_menuLink = '$link'");
    	if($cek->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$link'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_submenuTitle;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$link'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
		    $pagename = $rows->cr_menuTitle;
    	} 

    	$galleryImageGIF  = str_replace(".png",".gif",$galleryImage);
        $galleryImageJPG  = str_replace(".png",".jpg",$galleryImage);
        $galleryImageJPEG = str_replace(".png",".jpeg",$galleryImage);

        $galleryImageLink     = str_replace("/thumbnails","",$galleryImage);
        $galleryImageGIFLink  = str_replace("/thumbnails","",$galleryImageGIF);
        $galleryImageJPGLink  = str_replace("/thumbnails","",$galleryImageJPG);
        $galleryImageJPEGLink = str_replace("/thumbnails","",$galleryImageJPEG);

    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImage);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$galleryImageJPEGLink);
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_gallery WHERE cr_galleryID = ?");
    	$result->bindParam(1, $galleryID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Gallery', ?, ?, ?)");
		$historyDetail = " delete ".$galleryTitle." in page ".$pagename.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class social {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewSocial() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_social ORDER BY cr_socialOrder asc");
    	if($cek->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_social ORDER BY cr_socialOrder asc");
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function editSocial() {
    	$result = $this->pdo->query("SELECT * FROM cr_social order by cr_socialID asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    $data[]=$rows;
		return $data;
    }
    public function updateSocial($facebook, $twitter, $instagram, $tumblr, $pinterest, $youtube, $behance, $dribbble, $github, $soundcloud, $skype, $googleplus) {

	    $result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'facebook'");	
	    $result->bindParam(1, $facebook);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'twitter'");	
	    $result->bindParam(1, $twitter);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'instagram'");	
	    $result->bindParam(1, $instagram);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'tumblr'");	
	    $result->bindParam(1, $tumblr);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'pinterest'");	
	    $result->bindParam(1, $pinterest);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'youtube'");	
	    $result->bindParam(1, $youtube);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'behance'");	
	    $result->bindParam(1, $behance);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'dribbble'");	
	    $result->bindParam(1, $dribbble);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'github'");	
	    $result->bindParam(1, $github);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'soundcloud'");	
	    $result->bindParam(1, $soundcloud);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'skype'");	
	    $result->bindParam(1, $skype);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'google-plus'");	
	    $result->bindParam(1, $googleplus);
		$result->execute();
    }
    public function clearSocial($empty) {
	    $result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'facebook'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'twitter'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'instagram'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'tumblr'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'pinterest'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'youtube'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'behance'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'dribbble'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'github'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'soundcloud'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'skype'");	
	    $result->bindParam(1, $empty);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_social SET 
	    		cr_socialLink    = ? 
	    		WHERE cr_socialName = 'google-plus'");	
	    $result->bindParam(1, $empty);
		$result->execute();
    }
    public function reorderSocial($idArray) {
    	$count = 1;
    	foreach ($idArray as $id){
			$update = $this->pdo->query("UPDATE cr_social SET cr_socialOrder = $count WHERE cr_socialID = $id");
			$count ++;	
		}
		return true;
    }
    public function viewInstafeeduserID() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='instafeeduserid'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows;
    }
    public function viewInstafeedaccessToken() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='instafeedaccesstoken'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows;
    }
    public function editInstafeeduserID() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='instafeeduserid'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingValue;
    }
    public function editInstafeedaccessToken() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='instafeedaccesstoken'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingValue;
    }
    public function updateInstafeed($userid, $accesstoken, $adminLoginID) {
    	global $NowDate;
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue      = ? 
	    		WHERE cr_settingName = 'instafeeduserid'");	
	    $result->bindParam(1, $userid);
		$result->execute();

		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue      = ? 
	    		WHERE cr_settingName = 'instafeedaccesstoken'");	
	    $result->bindParam(1, $accesstoken);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update Instafeed User ID and Token', ?, ?, ?)");
		$historyDetail = " change user ID and access token for your Instafeed.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(2, $from);
		$getHistory->execute();
    }
}

class mail {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    //compose
    public function composeTo($adminID) {
    	$result  = $this->pdo->query("SELECT * FROM  cr_admin WHERE cr_adminID <> '$adminID' ORDER BY cr_adminID asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function sendMail($to, $from, $subject, $content) {
    	global $NowDate;
    	$checkuser_q = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID='$to'");
    	$checkuser_f = $checkuser_q->fetch(PDO::FETCH_OBJ);
    	$checkuser   = ucwords($checkuser_f->cr_adminDisplayName);

    	$fromFolder = "sent";
    	$toFolder   = "inbox";
    	$tmstamp    = time();
    	$tipe       = "inbox";
    	if(empty($subject)) {
    		$subjct = "No Subject";
    	}
    	else {
    		$subjct = ucwords($subject);
    	}
    	$read       = 0;
    	$result = $this->pdo->prepare("INSERT INTO cr_inbox(
			    		cr_inboxSubject, cr_inboxContent, cr_inboxFrom, cr_inboxTo, cr_inboxDate, cr_inboxRead, cr_inboxTimestamp, cr_inboxFromFolder, cr_inboxToFolder, cr_inboxType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $subjct);
		$result->bindParam(2, $content);
		$result->bindParam(3, $from);
		$result->bindParam(4, $to);
		$result->bindParam(5, $NowDate);
		$result->bindParam(6, $read);
		$result->bindParam(7, $tmstamp);
		$result->bindParam(8, $fromFolder);
		$result->bindParam(9, $toFolder);
		$result->bindParam(10, $tipe);
		$result->execute();

		if(strlen($content)<100) {
			$shortcontent = strip_tags($content);
		}
		else {
			$shortcontent = strip_tags(substr($content, 0, 100))."...";
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Send mail to $checkuser', ?, ?, ?)");
		$historyDetail = " send mail to ".$checkuser."<br>"."Content <i class='fa fa-arrow-right'></i> ".$shortcontent;
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(2, $from);
		$getHistory->execute();
    }
    //Inbox
    public function countInbox($adminID) {
    	$check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxTo='$adminID' AND cr_inboxToFolder='inbox'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function countInboxUnread($adminID) {
    	$check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxTo='$adminID' AND cr_inboxToFolder='inbox' AND cr_inboxRead='0'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function viewInboxAll($adminID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo='$adminID' AND cr_inbox.cr_inboxToFolder='inbox' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewInboxRead($adminID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo='$adminID' AND cr_inbox.cr_inboxToFolder='inbox' AND cr_inbox.cr_inboxRead='1' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewInboxUnread($adminID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo='$adminID' AND cr_inbox.cr_inboxToFolder='inbox' AND cr_inbox.cr_inboxRead='0' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewDetailInbox($messageID) {
    	$result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID='$messageID' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function replyInbox($inboxID) {
    	$result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID='$inboxID' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    //Sent
    public function countSent($adminID) {
    	$check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxFrom='$adminID' AND cr_inboxFromFolder='sent'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function viewSentAll($adminID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxFrom='$adminID' AND cr_inbox.cr_inboxFromFolder='sent' AND cr_inbox.cr_inboxTo=cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewDetailSent($messageID) {
    	$result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID='$messageID' AND cr_inbox.cr_inboxTo=cr_admin.cr_adminID");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    //Trash
    public function countTrash($adminID) {
    	$check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxTo='$adminID' AND cr_inboxToFolder='trash'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function viewTrashAll($adminID) {
    	$result  = $this->pdo->query("SELECT * FROM  cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo='$adminID' AND cr_inbox.cr_inboxToFolder='trash' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewDetailTrash($messageID) {
    	$result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID='$messageID' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function moveInboxToTrash($messageID, $adminLoginID) {
    	global $NowDate;
    	$t = "trash";
	    $result = $this->pdo->prepare("UPDATE cr_inbox SET 
	    		cr_inboxToFolder = ?
	    		WHERE cr_inboxID = ?");	
	    $result->bindParam(1, $t);
		$result->bindParam(2, $messageID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Move Message to Trash', ?, ?, ?)");
		$historyDetail = " move one message in folder inbox to trash.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateMessagetoRead($messageID) {
    	$r = "1";
	    $result = $this->pdo->prepare("UPDATE cr_inbox SET 
	    		cr_inboxRead = ?
	    		WHERE cr_inboxID = ?");	
	    $result->bindParam(1, $r);
		$result->bindParam(2, $messageID);
		$result->execute();
    }
}

class message {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewAllMessageInbox($adminID) {
    	$result  = $this->pdo->query("SELECT cr_messageID as idpesan, cr_messageName as messagename, cr_messageContent as content, cr_messageDate as tanggal, cr_messageType as tipe FROM cr_message WHERE cr_messageRead='0' AND cr_messageFolder='inbox' UNION SELECT cr_inbox.cr_inboxID as idpesan, cr_admin.cr_adminDisplayName as messagename, cr_inbox.cr_inboxContent as content, cr_inbox.cr_inboxDate as tanggal, cr_inbox.cr_inboxType as tipe FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxRead='0' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID AND cr_inbox.cr_inboxTo='$adminID' AND cr_inbox.cr_inboxToFolder='inbox' ORDER BY tanggal desc LIMIT 6");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function getPhoto($inboxID) {
    	$result  = $this->pdo->query("SELECT * FROM cr_admin, cr_inbox WHERE cr_admin.cr_adminID=cr_inbox.cr_inboxFrom AND cr_inbox.cr_inboxID='$inboxID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
    	return $rows->cr_adminPhoto;
    }
    //Inbox
    public function countInbox() {
    	$check_q = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder='inbox'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function countInboxUnread() {
    	$check_q = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder='inbox' AND cr_messageRead='0'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function viewInboxAll() {
    	$result  = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder='inbox' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewInboxRead() {
    	$result  = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder='inbox' AND cr_messageRead='1' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewInboxUnread() {
    	$result  = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder='inbox' AND cr_messageRead='0' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewDetailInbox($messageID) {
    	$result = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageID='$messageID'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function replyInbox($inboxID) {
    	$result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID='$inboxID' AND cr_inbox.cr_inboxFrom=cr_admin.cr_adminID");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    //Trash
    public function countTrash() {
    	$check_q = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder='trash'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function viewTrashAll() {
    	$result  = $this->pdo->query("SELECT * FROM  cr_message WHERE cr_messageFolder='trash' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function viewDetailTrash($messageID) {
    	$result = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageID='$messageID'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function moveInboxToTrash($messageID, $adminLoginID) {
    	global $NowDate;
    	$t = "trash";
	    $result = $this->pdo->prepare("UPDATE cr_message SET 
	    		cr_messageFolder = ?
	    		WHERE cr_messageID = ?");	
	    $result->bindParam(1, $t);
		$result->bindParam(2, $messageID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Move Message to Trash', ?, ?, ?)");
		$historyDetail = " move one message in folder inbox to trash.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateMessagetoRead($messageID) {
    	$r = "1";
	    $result = $this->pdo->prepare("UPDATE cr_message SET 
	    		cr_messageRead = ?
	    		WHERE cr_messageID = ?");	
	    $result->bindParam(1, $r);
		$result->bindParam(2, $messageID);
		$result->execute();
    }
}

class history {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewHistory($cradminID_session) {
    	$cek = $this->pdo->query("SELECT * FROM  cr_history, cr_admin WHERE cr_history.cr_adminID = cr_admin.cr_adminID ORDER BY cr_history.cr_historyID desc");
    	if($cek->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_history, cr_admin WHERE cr_history.cr_adminID = cr_admin.cr_adminID ORDER BY cr_history.cr_historyID desc");
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function deleteHistory($historyID, $adminLoginID) {
    	global $NowDate;
    	$check_q = $this->pdo->query("SELECT * FROM cr_history WHERE cr_historyID='$historyID'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
		$check   = date('F d, Y g:i A', strtotime($check_f->cr_historyDateTime));

    	$result = $this->pdo->prepare("DELETE FROM cr_history WHERE cr_historyID = ?");
    	$result->bindParam(1, $historyID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete History', ?, ?, ?)");
		$historyDetail = " delete history at ".$check.".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteAllHistory($adminLoginID) {
    	global $NowDate;
    	$result = $this->pdo->prepare("DELETE FROM cr_history");
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete History', ?, ?, ?)");
		$historyDetail = " delete all history.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class logo {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewLogo() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName='websitelogo'");
    	$rows = $cek->fetch(PDO::FETCH_OBJ);
    	if($rows->cr_settingValue=="" || empty($rows->cr_settingValue)) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		return $rows;	
    	}
    }
    public function editLogo() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='websitelogo'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateLogo($photo, $adminLoginID) {
    	global $NowDate;
    	$cekValue_q  = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='websitelogo'"); 
    	$cekValue_f  = $cekValue_q->fetch(PDO::FETCH_OBJ);
    	$cekValue    = $cekValue_f->cr_settingValue;
    	$settingname = "websitelogo";
    	if($cekValue=="" || empty($cekValue)) {
    		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue    = ?
	    		WHERE cr_settingName = ?");	
		    $result->bindParam(1, $photo);
			$result->bindParam(2, $settingname);
			$result->execute();

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Website Logo', ?, ?, ?)");
			$historyDetail = " add new logo to your website.";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
    	}
    	else {
	    	$check   = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='websitelogo'");
	    	$check_f = $check->fetch(PDO::FETCH_OBJ);
	    	$namaPhoto  = $check_f->cr_settingValue;

	    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
	        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
	        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

	        $namaPhotoLink     = str_replace("/thumbnails","",$namaPhoto);
	        $namaPhotoGIFLink  = str_replace("/thumbnails","",$namaPhotoGIF);
	        $namaPhotoJPGLink  = str_replace("/thumbnails","",$namaPhotoJPG);
	        $namaPhotoJPEGLink = str_replace("/thumbnails","",$namaPhotoJPEG);

	        if($namaPhoto!="/assets/img/no-pic-items.png") {
	    		//unlink thumbnail
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhoto);
	    		//unlink real image
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoGIFLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPGLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPEGLink);
	    	}

		    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue    = ?
	    		WHERE cr_settingName = ?");	
		    $result->bindParam(1, $photo);
			$result->bindParam(2, $settingname);
			$result->execute();

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Website Logo', ?, ?, ?)");
			$historyDetail = " change the website logo.";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
		}
    }
    public function deleteLogo($adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='websitelogo'");
    	$check_f      = $check->fetch();
    	$namaPhoto    = $check_f['cr_settingValue'];
    	$settingvalue = "";
    	$settingname  = "websitelogo";

    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

        $namaPhotoLink     = str_replace("/thumbnails","",$namaPhoto);
        $namaPhotoGIFLink  = str_replace("/thumbnails","",$namaPhotoGIF);
        $namaPhotoJPGLink  = str_replace("/thumbnails","",$namaPhotoJPG);
        $namaPhotoJPEGLink = str_replace("/thumbnails","",$namaPhotoJPEG);

    	if($namaPhoto!="/assets/img/no-pic-items.png") {
    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhoto);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPEGLink);
    	}

    	$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue    = ?
	    		WHERE cr_settingName = ?");	
		$result->bindParam(1, $settingvalue);
		$result->bindParam(2, $settingname);
		$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Logo', ?, ?, ?)");
		$historyDetail = " delete the website logo.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class favicon {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewFavicon() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName='favicon'");
    	$rows = $cek->fetch(PDO::FETCH_OBJ);
    	if($rows->cr_settingValue=="" || empty($rows->cr_settingValue)) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		return $rows;	
    	}
    }
    public function editFavicon() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='favicon'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateFavicon($photo, $adminLoginID) {
    	global $NowDate;
    	$cekValue_q  = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='favicon'"); 
    	$cekValue_f  = $cekValue_q->fetch(PDO::FETCH_OBJ);
    	$cekValue    = $cekValue_f->cr_settingValue;
    	$settingname = "favicon";
    	if($cekValue=="" || empty($cekValue)) {
    		$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue    = ?
	    		WHERE cr_settingName = ?");	
		    $result->bindParam(1, $photo);
			$result->bindParam(2, $settingname);
			$result->execute();

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Favicon', ?, ?, ?)");
			$historyDetail = " add new favicon to your website.";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
    	}
    	else {
	    	$check   = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='favicon'");
	    	$check_f = $check->fetch(PDO::FETCH_OBJ);
	    	$namaPhoto  = $check_f->cr_settingValue;

	    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
	        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
	        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

	        $namaPhotoLink     = str_replace("/thumbnails","",$namaPhoto);
	        $namaPhotoGIFLink  = str_replace("/thumbnails","",$namaPhotoGIF);
	        $namaPhotoJPGLink  = str_replace("/thumbnails","",$namaPhotoJPG);
	        $namaPhotoJPEGLink = str_replace("/thumbnails","",$namaPhotoJPEG);

	        if($namaPhoto!="/assets/img/no-pic-items.png") {
	    		//unlink thumbnail
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhoto);
	    		//unlink real image
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoGIFLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPGLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPEGLink);
	    	}

		    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue    = ?
	    		WHERE cr_settingName = ?");	
		    $result->bindParam(1, $photo);
			$result->bindParam(2, $settingname);
			$result->execute();

			$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Website Favicon', ?, ?, ?)");
			$historyDetail = " change the website favicon.";
			$getHistory->bindParam(1, $historyDetail);
			$getHistory->bindParam(2, $NowDate);
			$getHistory->bindParam(3, $adminLoginID);
			$getHistory->execute();
		}
    }
    public function deleteFavicon($adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='favicon'");
    	$check_f      = $check->fetch();
    	$namaPhoto    = $check_f['cr_settingValue'];
    	$settingvalue = "";
    	$settingname  = "favicon";

    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

        $namaPhotoLink     = str_replace("/thumbnails","",$namaPhoto);
        $namaPhotoGIFLink  = str_replace("/thumbnails","",$namaPhotoGIF);
        $namaPhotoJPGLink  = str_replace("/thumbnails","",$namaPhotoJPG);
        $namaPhotoJPEGLink = str_replace("/thumbnails","",$namaPhotoJPEG);

    	if($namaPhoto!="/assets/img/no-pic-items.png") {
    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhoto);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPEGLink);
    	}

    	$result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue    = ?
	    		WHERE cr_settingName = ?");	
		$result->bindParam(1, $settingvalue);
		$result->bindParam(2, $settingname);
		$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Favicon', ?, ?, ?)");
		$historyDetail = " delete the website favicon.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

//SECTION CLASS

class slider {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewSlider() {
    	$result = $this->pdo->query("SELECT * FROM  cr_slider, cr_admin WHERE cr_slider.cr_adminID = cr_admin.cr_adminID ORDER BY cr_slider.cr_sliderID desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
		}
    }
    public function addSlider($photo, $caption, $desc, $btext, $blink, $textposition, $adminLoginID) {
    	global $NowDate;
    	if(empty($textposition)) {
    		$textposition = "center";
    	}

    	$titleupper = ucwords($caption);
	    $result = $this->pdo->prepare("INSERT INTO cr_slider(
			    		cr_sliderImage, cr_sliderCaption, cr_sliderDesc, cr_sliderButtontext, cr_sliderButtonlink, cr_sliderTextposition, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $photo);
		$result->bindParam(2, $caption);
		$result->bindParam(3, $desc);
		$result->bindParam(4, $btext);
		$result->bindParam(5, $blink);
		$result->bindParam(6, $textposition);
		$result->bindParam(7, $adminLoginID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Slider Image', ?, ?, ?)");

		$historyDetail = " add new slider image in slider section";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editSlider($sliderID) {
    	$result = $this->pdo->query("SELECT * FROM cr_slider WHERE cr_sliderID='$sliderID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateSlider($photo, $photourlnc, $caption, $desc, $btext, $blink, $textposition, $adminLoginID, $sliderIDh) {
    	global $NowDate;
    	if(empty($textposition)) {
    		$textposition = "center";
    	}

    	$titleupper = ucwords($caption);
    	$photoca     = str_replace(MADMINURL."/..","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekp_q = $this->pdo->query("SELECT * FROM cr_slider WHERE cr_sliderID='$sliderIDh'");
    	$cekp_f = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekp_f->cr_sliderImage;

    	if($photocb!=$photourlnc) {
    		$sliderImageGIF  = str_replace(".png",".gif",$thname);
        	$sliderImageJPG  = str_replace(".png",".jpg",$thname);
        	$sliderImageJPEG = str_replace(".png",".jpeg",$thname);

        	$sliderImageLink     = str_replace("/thumbnails","",$thname);
        	$sliderImageGIFLink  = str_replace("/thumbnails","",$sliderImageGIF);
        	$sliderImageJPGLink  = str_replace("/thumbnails","",$sliderImageJPG);
        	$sliderImageJPEGLink = str_replace("/thumbnails","",$sliderImageJPEG);

    		//unlink old thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$thname);
    		//unlink old real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageJPEGLink);

    		$result = $this->pdo->prepare("UPDATE cr_slider SET 
		    		cr_sliderImage        = ?, 
		    		cr_sliderCaption      = ?, 
		    		cr_sliderDesc         = ?,  
		    		cr_sliderButtontext   = ?,
		    		cr_sliderButtonlink   = ?,
		    		cr_sliderTextposition = ?,
		    		cr_adminID            = ?
		    		WHERE cr_sliderID     = ?");	
		    $result->bindParam(1, $photoca);
			$result->bindParam(2, $caption);
			$result->bindParam(3, $desc);
			$result->bindParam(4, $btext);
			$result->bindParam(5, $blink);
			$result->bindParam(6, $textposition);
			$result->bindParam(7, $adminLoginID);
			$result->bindParam(8, $sliderIDh);
			$result->execute();
    	}
    	else {
		    $result = $this->pdo->prepare("UPDATE cr_slider SET 
		    		cr_sliderCaption      = ?, 
		    		cr_sliderDesc         = ?,  
		    		cr_sliderButtontext   = ?,
		    		cr_sliderButtonlink   = ?,
		    		cr_sliderTextposition = ?,
		    		cr_adminID            = ?
		    		WHERE cr_sliderID     = ?");
			$result->bindParam(1, $caption);
			$result->bindParam(2, $desc);
			$result->bindParam(3, $btext);
			$result->bindParam(4, $blink);
			$result->bindParam(5, $textposition);
			$result->bindParam(6, $adminLoginID);
			$result->bindParam(7, $sliderIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Slider Image', ?, ?, ?)");
		$historyDetail = " edit slider image in slider section.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteSlider($sliderID, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_slider WHERE cr_sliderID = '$sliderID'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$sliderImage = $check_f->cr_sliderImage;

    	$sliderImageGIF  = str_replace(".png",".gif",$sliderImage);
        $sliderImageJPG  = str_replace(".png",".jpg",$sliderImage);
        $sliderImageJPEG = str_replace(".png",".jpeg",$sliderImage);

        $sliderImageLink     = str_replace("/thumbnails","",$sliderImage);
        $sliderImageGIFLink  = str_replace("/thumbnails","",$sliderImageGIF);
        $sliderImageJPGLink  = str_replace("/thumbnails","",$sliderImageJPG);
        $sliderImageJPEGLink = str_replace("/thumbnails","",$sliderImageJPEG);

    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImage);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$sliderImageJPEGLink);
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_slider WHERE cr_sliderID = ?");
    	$result->bindParam(1, $sliderID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Slider Image', ?, ?, ?)");
		$historyDetail = " delete one slider image in slider section.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class jumbotron {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewPlainjumbotron() {
    	$result = $this->pdo->query("SELECT * FROM  cr_jumbotron, cr_admin WHERE cr_jumbotron.cr_adminID = cr_admin.cr_adminID AND cr_jumbotron.cr_jumbotronName = 'plainjumbotron'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
    	if($rows->cr_jumbotronCaption=="" || empty($rows->cr_jumbotronCaption)) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
			return $rows;
		}
    }
    public function viewBackgroundjumbotron() {
    	$result = $this->pdo->query("SELECT * FROM  cr_jumbotron, cr_admin WHERE cr_jumbotron.cr_adminID = cr_admin.cr_adminID AND cr_jumbotron.cr_jumbotronName = 'backgroundjumbotron' LIMIT 1");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
    	if($rows->cr_jumbotronCaption=="" || empty($rows->cr_jumbotronCaption)) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
			return $rows;
		}
    }
    public function updateBackgroundjumbotron($photo, $photourlnc, $caption, $desc, $btext, $blink, $textposition, $matchcs, $adminLoginID) {
    	global $NowDate;
    	if(empty($matchcs)) {
    		$matchcs = "";
    	}

    	$titleupper = ucwords($caption);

    	$check_q = $this->pdo->query("SELECT * FROM cr_jumbotron WHERE cr_jumbotronName = 'backgroundjumbotron'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
    	$jumbotronImage = $check_f->cr_jumbotronImage;
    	$jumbotronName  = "backgroundjumbotron";
    	$photoca        = str_replace(MADMINURL."/..","",$photo);
    	$photocb        = str_replace(MURL,"",$photo);
    	if($jumbotronImage=="" || empty($jumbotronImage)) {
		    $result = $this->pdo->prepare("UPDATE cr_jumbotron SET 
			    		cr_jumbotronImage        = ?, 
			    		cr_jumbotronCaption      = ?, 
			    		cr_jumbotronDesc         = ?,  
			    		cr_jumbotronButtontext   = ?,
			    		cr_jumbotronButtonLink   = ?,
			    		cr_jumbotronTextposition = ?,
			    		cr_jumbotronColorscheme  = ?,
			    		cr_adminID               = ?
			    		WHERE cr_jumbotronName   = ?");
			$result->bindParam(1, $photoca);
			$result->bindParam(2, $caption);
			$result->bindParam(3, $desc);
			$result->bindParam(4, $btext);
			$result->bindParam(5, $blink);
			$result->bindParam(6, $textposition);
			$result->bindParam(7, $matchcs);
			$result->bindParam(8, $adminLoginID);
			$result->bindParam(9, $jumbotronName);
			$result->execute();
		}
		else {
			if($photocb!=$photourlnc) {
				$jumbotronImageGIF  = str_replace(".png",".gif",$jumbotronImage);
	        	$jumbotronImageJPG  = str_replace(".png",".jpg",$jumbotronImage);
	        	$jumbotronImageJPEG = str_replace(".png",".jpeg",$jumbotronImage);

	        	$jumbotronImageLink     = str_replace("/thumbnails","",$jumbotronImage);
	        	$jumbotronImageGIFLink  = str_replace("/thumbnails","",$jumbotronImageGIF);
	        	$jumbotronImageJPGLink  = str_replace("/thumbnails","",$jumbotronImageJPG);
	        	$jumbotronImageJPEGLink = str_replace("/thumbnails","",$jumbotronImageJPEG);

	    		//unlink old thumbnail
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImage);
	    		//unlink old real image
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageGIFLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageJPGLink);
	    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageJPEGLink);

	    		$result = $this->pdo->prepare("UPDATE cr_jumbotron SET 
			    		cr_jumbotronImage        = ?, 
			    		cr_jumbotronCaption      = ?, 
			    		cr_jumbotronDesc         = ?,  
			    		cr_jumbotronButtontext   = ?,
			    		cr_jumbotronButtonLink   = ?,
			    		cr_jumbotronTextposition = ?,
			    		cr_jumbotronColorscheme  = ?,
			    		cr_adminID               = ?
			    		WHERE cr_jumbotronName   = ?");	
			    $result->bindParam(1, $photoca);
				$result->bindParam(2, $caption);
				$result->bindParam(3, $desc);
				$result->bindParam(4, $btext);
				$result->bindParam(5, $blink);
				$result->bindParam(6, $textposition);
				$result->bindParam(7, $matchcs);
				$result->bindParam(8, $adminLoginID);
				$result->bindParam(9, $jumbotronName);
				$result->execute();
			}
			else {
			    $result = $this->pdo->prepare("UPDATE cr_jumbotron SET 
			    		cr_jumbotronCaption      = ?, 
			    		cr_jumbotronDesc         = ?,  
			    		cr_jumbotronButtontext   = ?,
			    		cr_jumbotronButtonLink   = ?,
			    		cr_jumbotronTextposition = ?,
			    		cr_jumbotronColorscheme  = ?,
			    		cr_adminID               = ?
			    		WHERE cr_jumbotronName   = ?");
				$result->bindParam(1, $caption);
				$result->bindParam(2, $desc);
				$result->bindParam(3, $btext);
				$result->bindParam(4, $blink);
				$result->bindParam(5, $textposition);
				$result->bindParam(6, $matchcs);
				$result->bindParam(7, $adminLoginID);
				$result->bindParam(8, $jumbotronName);
				$result->execute();
			}

		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Setup Background Jumbotron', ?, ?, ?)");

		$historyDetail = " setup background jumbotron.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePlainjumbotron($caption, $desc, $btext, $blink, $textposition, $matchcs, $adminLoginID) {
    	global $NowDate;
    	if(empty($matchcs)) {
    		$matchcs = "";
    	}

    	$titleupper = ucwords($caption);
    	$jumbotronName  = "plainjumbotron";
    	
		$result = $this->pdo->prepare("UPDATE cr_jumbotron SET 
			    		cr_jumbotronCaption      = ?, 
			    		cr_jumbotronDesc         = ?,  
			    		cr_jumbotronButtontext   = ?,
			    		cr_jumbotronButtonLink   = ?,
			    		cr_jumbotronTextposition = ?,
			    		cr_jumbotronColorscheme  = ?,
			    		cr_adminID               = ?
			    		WHERE cr_jumbotronName   = ?");
		$result->bindParam(1, $caption);
		$result->bindParam(2, $desc);
		$result->bindParam(3, $btext);
		$result->bindParam(4, $blink);
		$result->bindParam(5, $textposition);
		$result->bindParam(6, $matchcs);
		$result->bindParam(7, $adminLoginID);
		$result->bindParam(8, $jumbotronName);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Setup Plain Jumbotron', ?, ?, ?)");

		$historyDetail = " setup plain jumbotron.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editBackgroundjumbotron() {
    	$result = $this->pdo->query("SELECT * FROM cr_jumbotron WHERE cr_jumbotronName='backgroundjumbotron'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function editPlainjumbotron() {
    	$result = $this->pdo->query("SELECT * FROM cr_jumbotron WHERE cr_jumbotronName='plainjumbotron'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function deleteBackgroundjumbotron($adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_jumbotron WHERE cr_jumbotronName = 'backgroundjumbotron'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$jumbotronImage = $check_f->cr_jumbotronImage;
    	$jumbotronName  = "backgroundjumbotron";

    	$jumbotronImageGIF  = str_replace(".png",".gif",$jumbotronImage);
        $jumbotronImageJPG  = str_replace(".png",".jpg",$jumbotronImage);
        $jumbotronImageJPEG = str_replace(".png",".jpeg",$jumbotronImage);

        $jumbotronImageLink     = str_replace("/thumbnails","",$jumbotronImage);
        $jumbotronImageGIFLink  = str_replace("/thumbnails","",$jumbotronImageGIF);
        $jumbotronImageJPGLink  = str_replace("/thumbnails","",$jumbotronImageJPG);
        $jumbotronImageJPEGLink = str_replace("/thumbnails","",$jumbotronImageJPEG);

    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImage);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$jumbotronImageJPEGLink);

    	$kosong = "";
    	$result = $this->pdo->prepare("UPDATE cr_jumbotron SET 
    					cr_jumbotronImage		 = ?,
			    		cr_jumbotronCaption      = ?, 
			    		cr_jumbotronDesc         = ?,  
			    		cr_jumbotronButtontext   = ?,
			    		cr_jumbotronButtonLink   = ?,
			    		cr_jumbotronTextposition = ?,
			    		cr_jumbotronColorscheme  = ?,
			    		cr_adminID               = ?
			    		WHERE cr_jumbotronName   = ?");
    	$result->bindParam(1, $kosong);
    	$result->bindParam(2, $kosong);
    	$result->bindParam(3, $kosong);
    	$result->bindParam(4, $kosong);
    	$result->bindParam(5, $kosong);
    	$result->bindParam(6, $kosong);
    	$result->bindParam(7, $kosong);
    	$result->bindParam(8, $adminLoginID);
    	$result->bindParam(9, $jumbotronName);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Background Jumbotron', ?, ?, ?)");
		$historyDetail = " delete background jumbotron.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deletePlainjumbotron($adminLoginID) {
    	global $NowDate;
    	$jumbotronName  = "plainjumbotron";

    	$kosong = "";
    	$result = $this->pdo->prepare("UPDATE cr_jumbotron SET 
			    		cr_jumbotronCaption      = ?, 
			    		cr_jumbotronDesc         = ?,  
			    		cr_jumbotronButtontext   = ?,
			    		cr_jumbotronButtonLink   = ?,
			    		cr_jumbotronTextposition = ?,
			    		cr_jumbotronColorscheme  = ?,
			    		cr_adminID               = ?
			    		WHERE cr_jumbotronName   = ?");
    	$result->bindParam(1, $kosong);
    	$result->bindParam(2, $kosong);
    	$result->bindParam(3, $kosong);
    	$result->bindParam(4, $kosong);
    	$result->bindParam(5, $kosong);
    	$result->bindParam(6, $kosong);
    	$result->bindParam(7, $adminLoginID);
    	$result->bindParam(8, $jumbotronName);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Plain Jumbotron', ?, ?, ?)");
		$historyDetail = " delete plain jumbotron.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class services {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function countServices() {
    	$cek   = $this->pdo->query("SELECT * FROM  cr_services ORDER BY cr_servicesID desc");
    	$total = $cek->rowCount(); 
    	return $total;
    }
    public function viewServices() {
    	$result = $this->pdo->query("SELECT * FROM  cr_services, cr_admin WHERE cr_services.cr_adminID = cr_admin.cr_adminID ORDER BY cr_services.cr_servicesID desc");
    	if($result->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			return $data;
		}
    }
    public function addServices($photo, $name, $desc, $adminLoginID) {
    	global $NowDate;
    	$titleupper = ucwords($name);
    	if($photo==MADMINURL."/assets/img/no-pic-items.png") {
    		$photo = "";
    	}
	    $result = $this->pdo->prepare("INSERT INTO cr_services(
			    		cr_servicesName, cr_servicesDesc, cr_servicesImage, cr_adminID) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $desc);
		$result->bindParam(3, $photo);
		$result->bindParam(4, $adminLoginID);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Service', ?, ?, ?)");

		$historyDetail = " add new service data to services section.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editServices($serviceID) {
    	$result = $this->pdo->query("SELECT * FROM cr_services WHERE cr_servicesID='$serviceID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateServices($photo, $photourlnc, $name, $desc, $adminLoginID, $serviceIDh) {
    	global $NowDate;
    	$titleupper = ucwords($name);

    	$photoca     = str_replace(MADMINURL."/..","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekp_q = $this->pdo->query("SELECT * FROM cr_services WHERE cr_servicesID='$serviceIDh'");
    	$cekp_f = $cekp_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekp_f->cr_servicesImage;

    	if($photocb!=$photourlnc) {
    		$serviceImageGIF  = str_replace(".png",".gif",$thname);
        	$serviceImageJPG  = str_replace(".png",".jpg",$thname);
        	$serviceImageJPEG = str_replace(".png",".jpeg",$thname);

        	$serviceImageLink     = str_replace("/thumbnails","",$thname);
        	$serviceImageGIFLink  = str_replace("/thumbnails","",$serviceImageGIF);
        	$serviceImageJPGLink  = str_replace("/thumbnails","",$serviceImageJPG);
        	$serviceImageJPEGLink = str_replace("/thumbnails","",$serviceImageJPEG);

    		//unlink old thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$thname);
    		//unlink old real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageJPEGLink);

    		$result = $this->pdo->prepare("UPDATE cr_services SET 
		    		cr_servicesName       = ?, 
		    		cr_servicesDesc       = ?, 
		    		cr_servicesImage      = ?,
		    		cr_adminID            = ?
		    		WHERE cr_servicesID     = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $desc);
			$result->bindParam(3, $photoca);
			$result->bindParam(4, $adminLoginID);
			$result->bindParam(5, $serviceIDh);
			$result->execute();
    	}
    	else {
		    $result = $this->pdo->prepare("UPDATE cr_services SET 
		    		cr_servicesName       = ?, 
		    		cr_servicesDesc       = ?,  
		    		cr_adminID            = ?
		    		WHERE cr_servicesID   = ?");
			$result->bindParam(1, $titleupper);
			$result->bindParam(2, $desc);
			$result->bindParam(3, $adminLoginID);
			$result->bindParam(4, $serviceIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Service', ?, ?, ?)");
		$historyDetail = " edit service in services section.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteServices($serviceID, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_services WHERE cr_servicesID = '$serviceID'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$serviceImage = $check_f->cr_servicesImage;

    	$serviceImageGIF  = str_replace(".png",".gif",$serviceImage);
        $serviceImageJPG  = str_replace(".png",".jpg",$serviceImage);
        $serviceImageJPEG = str_replace(".png",".jpeg",$serviceImage);

        $serviceImageLink     = str_replace("/thumbnails","",$serviceImage);
        $serviceImageGIFLink  = str_replace("/thumbnails","",$serviceImageGIF);
        $serviceImageJPGLink  = str_replace("/thumbnails","",$serviceImageJPG);
        $serviceImageJPEGLink = str_replace("/thumbnails","",$serviceImageJPEG);

    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImage);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$serviceImageJPEGLink);
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_services WHERE cr_servicesID = ?");
    	$result->bindParam(1, $serviceID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Service', ?, ?, ?)");
		$historyDetail = " delete one service in services section.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function viewPageforServicesMenu() {
    	$cek = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option<>'customlink' AND cr_menuHasSub='0' ORDER BY cr_menuOrder asc");
    	if($cek->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function viewPageforServicesSubmenu() {
    	$cek = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option<>'customlink' ORDER BY cr_submenuID asc");
    	if($cek->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function viewServicesinpageID() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='servicesinpage'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingID;
    }
    public function viewServicesinpage() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='servicesinpage'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingValue;
    }
}

class clients {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewClients() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_clients ORDER BY cr_clientsOrder asc");
    	if($cek->rowCount() < 1){
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_clients ORDER BY cr_clientsOrder asc");
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function addClients($name, $link, $photo, $adminLoginID) {
    	global $NowDate;
    	$nameUpper   = ucwords($name);
    	$cekLastID_q = $this->pdo->query("SELECT * FROM cr_clients");
    	$getLastID_q = $this->pdo->query("SELECT LAST_INSERT_ID() FROM cr_clients");
		$getLastID_f = $getLastID_q->fetch(PDO::FETCH_OBJ);
		if($cekLastID_q->rowCount() < 1) {
			$getLastID = 1;
		}
		else {
			$getLastID   = $getLastID_f->cr_clientsID+1;
		}

	    $result = $this->pdo->prepare("INSERT INTO cr_clients(
			    		cr_clientsName, cr_clientsLink, cr_clientsImage, cr_clientsOrder) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $nameUpper);
		$result->bindParam(2, $link);
		$result->bindParam(3, $photo);
		$result->bindParam(4, $getLastID);
		$result->execute();

		$result = $this->pdo->query("SET @lastID = LAST_INSERT_ID()");
		$result = $this->pdo->query("UPDATE cr_clients SET cr_clientsOrder = @lastID WHERE cr_clientsID = @lastID;");

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Clients', ?, ?, ?)");
		
		$historyDetail = " add ".$nameUpper." as a new client.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function editClients($clientID) {
    	$result = $this->pdo->query("SELECT * FROM cr_clients WHERE cr_clientsID='$clientID'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateClients($name, $link, $photo, $adminLoginID, $clientIDh) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_clients WHERE cr_clientsID='$clientIDh'");
    	$check_f = $check->fetch(PDO::FETCH_OBJ);
    	$namaPhoto  = $check_f->cr_clientsImage;

    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

        $namaPhotoLink     = str_replace("/thumbnails","",$namaPhoto);
        $namaPhotoGIFLink  = str_replace("/thumbnails","",$namaPhotoGIF);
        $namaPhotoJPGLink  = str_replace("/thumbnails","",$namaPhotoJPG);
        $namaPhotoJPEGLink = str_replace("/thumbnails","",$namaPhotoJPEG);

        if($namaPhoto!="/assets/img/no-pic-items.png") {
    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhoto);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPEGLink);
    	}

    	$nameUpper   = ucwords($name);
	    $result = $this->pdo->prepare("UPDATE cr_clients SET 
	    		cr_clientsName      = ?, 
	    		cr_clientsLink      = ?, 
	    		cr_clientsImage     = ? 
	    		WHERE cr_clientsID  = ?");	
	    $result->bindParam(1, $nameUpper);
		$result->bindParam(2, $link);
		$result->bindParam(3, $photo);
		$result->bindParam(4, $clientIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Client', ?, ?, ?)");
		$historyDetail = " edit ".$nameUpper."'s client data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteClients($clientID, $adminLoginID) {
    	global $NowDate;
    	$check   = $this->pdo->query("SELECT * FROM cr_clients WHERE cr_clientsID='$clientID'");
    	$check_f = $check->fetch();
    	$namaPhoto  = $check_f['cr_clientsImage'];
    	$namaClient = $check_f['cr_clientsName'];

    	$namaPhotoGIF  = str_replace(".png",".gif",$namaPhoto);
        $namaPhotoJPG  = str_replace(".png",".jpg",$namaPhoto);
        $namaPhotoJPEG = str_replace(".png",".jpeg",$namaPhoto);

        $namaPhotoLink     = str_replace("/thumbnails","",$namaPhoto);
        $namaPhotoGIFLink  = str_replace("/thumbnails","",$namaPhotoGIF);
        $namaPhotoJPGLink  = str_replace("/thumbnails","",$namaPhotoJPG);
        $namaPhotoJPEGLink = str_replace("/thumbnails","",$namaPhotoJPEG);

    	if($namaPhoto!="/assets/img/no-pic-items.png") {
    		//unlink thumbnail
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhoto);
    		//unlink real image
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoGIFLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPGLink);
    		unlink($_SERVER['DOCUMENT_ROOT'].ABSPATH.$namaPhotoJPEGLink);
    	}

    	$result = $this->pdo->prepare("DELETE FROM cr_clients WHERE cr_clientsID = ?");
    	$result->bindParam(1, $clientID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Client', ?, ?, ?)");
    	$clientCaps = ucwords($namaClient);
		$historyDetail = " delete ".$clientCaps." from clients data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function reorderClients($idArray) {
    	$count = 1;
    	foreach ($idArray as $id){
			$update = $this->pdo->query("UPDATE cr_clients SET cr_clientsOrder = $count WHERE cr_clientsID = $id");
			$count ++;	
		}
		return true;
    }
    public function viewPageforClientspartnersMenu() {
    	$cek = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option<>'customlink' AND cr_menuHasSub='0' ORDER BY cr_menuOrder asc");
    	if($cek->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function viewPageforClientspartnersSubmenu() {
    	$cek = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option<>'customlink' ORDER BY cr_submenuID asc");
    	if($cek->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function viewClientspartnersinpageID() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='clientspartnersinpage'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingID;
    }
    public function viewClientspartnersinpage() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='clientspartnersinpage'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingValue;
    }
}

class pfooter {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewPFooter1() {
    	$cek = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column1'");
	    $rows = $cek->fetch(PDO::FETCH_OBJ);
	    if(empty($rows->cr_footerType)) {
	    	$alert = 0;
	    	return $alert;
	    }
	    else {

	    	return $rows;
    	}
    }
    public function viewPFooter2() {
    	$cek = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column2'");
	    $rows = $cek->fetch(PDO::FETCH_OBJ);
	    if(empty($rows->cr_footerType)) {
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	return $rows;
    	}
    }
    public function viewPFooter3() {
    	$cek = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column3'");
	    $rows = $cek->fetch(PDO::FETCH_OBJ);
	    if(empty($rows->cr_footerType)) {
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	return $rows;
    	}
    }
    public function viewPFooter4() {
    	$cek = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerName = 'footer-column4'");
	    $rows = $cek->fetch(PDO::FETCH_OBJ);
	    if(empty($rows->cr_footerType)) {
	    	$alert = 0;
	    	return $alert;
	    }
	    else {
	    	return $rows;
    	}
    }
    public function viewPFooterquery($pfid) {
    	$cek = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerID = '$pfid'");
	    $rows = $cek->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewPFooterPC($ex1) {
    	$result = $this->pdo->query("SELECT * FROM cr_portfoliocategory WHERE cr_portfoliocategoryID = '$ex1'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewPFooterBC($ex2) {
    	$result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$ex2'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function viewPFooterBlogPage($ex1) {
    	$position  = substr($ex1, 0, 1);
		$blogpid   = substr($ex1, 1);
		if($position=="m") {
			$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$blogpid'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    	return $rows->cr_menuTitle;
		}
		elseif($position=="s") {
			$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuID = '$blogpid'");
	    	$rows = $result->fetch(PDO::FETCH_OBJ);
	    	return $rows->cr_submenuTitle;
		}
    }
    public function addPFooter1($footerid, $pftype, $customtexttitle, $customtexttext, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $customtexttitle);
	    $result->bindParam(3, $customtexttext);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with custom text type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addPFooter2($footerid, $pftype, $latestportfoliotitle, $latestportfoliocategory, $latestportfoliototal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$arr     = array($latestportfoliocategory,$latestportfoliototal);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $latestportfoliotitle);
	    $result->bindParam(3, $value);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with latest portfolio type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addPFooter3($footerid, $pftype, $latestgallerytitle, $latestgallerytotal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $latestgallerytitle);
	    $result->bindParam(3, $latestgallerytotal);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with latest gallery type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addPFooter4($footerid, $pftype, $socialtitle, $socialdescription, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $socialtitle);
	    $result->bindParam(3, $socialdescription);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with available social media type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addPFooter5($footerid, $pftype, $instafeedtitle, $instafeedtotal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $instafeedtitle);
	    $result->bindParam(3, $instafeedtotal);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with instagram feed type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addPFooter6($footerid, $pftype, $twitterfeedtitle, $twitterfeedtext, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $twitterfeedtitle);
	    $result->bindParam(3, $twitterfeedtext);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with twitter feed type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addPFooter7($footerid, $pftype, $facebookpagetitle, $facebookpagetext, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $facebookpagetitle);
	    $result->bindParam(3, $facebookpagetext);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with facebook page type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function addPFooter8($footerid, $pftype, $blogtitle, $blogpage, $blogcategory, $blogtotal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$arr     = array($blogpage,$blogcategory,$blogtotal);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $pftype);
	    $result->bindParam(2, $blogtitle);
	    $result->bindParam(3, $value);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " add new data in ".strtolower($fname)." primary footer with latest portfolio type.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter1($footerid, $customtexttitle, $customtexttext, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $customtexttitle);
	    $result->bindParam(2, $customtexttext);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update custom text data in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter2($footerid, $latestportfoliotitle, $latestportfoliocategory, $latestportfoliototal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$arr     = array($latestportfoliocategory,$latestportfoliototal);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $latestportfoliotitle);
	    $result->bindParam(2, $value);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update latest portfolio data in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter3($footerid, $latestgallerytitle, $latestgallerytotal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $latestgallerytitle);
	    $result->bindParam(2, $latestgallerytotal);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update latest gallery data in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter4($footerid, $socialtitle, $socialdescription, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $socialtitle);
	    $result->bindParam(2, $socialdescription);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update available social media in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter5($footerid, $instafeedtitle, $instafeedtotal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $instafeedtitle);
	    $result->bindParam(2, $instafeedtotal);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update instagram feed data in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter6($footerid, $twitterfeedtitle, $twitterfeedtext, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $twitterfeedtitle);
	    $result->bindParam(2, $twitterfeedtext);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update twitter feed data in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter7($footerid, $facebookpagetitle, $facebookpagetext, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $facebookpagetitle);
	    $result->bindParam(2, $facebookpagetext);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update facebook page data in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updatePFooter8($footerid, $blogtitle, $blogpage, $blogcategory, $blogtotal, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$arr     = array($blogpage,$blogcategory,$blogtotal);
		$value   = implode(",", $arr);
    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID  = ?");	
	    $result->bindParam(1, $blogtitle);
	    $result->bindParam(2, $value);
		$result->bindParam(3, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Update $fname Primary Footer', ?, ?, ?)");
		$historyDetail = " update blogs data in ".strtolower($fname)." primary footer.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function viewTotalInstafeed() {
    	$result = $this->pdo->query("SELECT * FROM cr_footer WHERE cr_footerType='instafeed'");
	    $total = $result->rowCount();
		return $total;
    }
    public function deletePFooter($footerid, $adminLoginID) {
    	global $NowDate;
    	if($footerid == "1") 
    		$fname = "First Column";
    	elseif($footerid == "2")
    		$fname = "Second Column";
    	elseif($footerid == "3")
    		$fname = "Third Column";
    	elseif($footerid == "4")
    		$fname = "Fourth Column";

    	$kosong = "";

    	$result = $this->pdo->prepare("UPDATE cr_footer SET 
	    		cr_footerType      = ?,
	    		cr_footerTitle     = ?,
	    		cr_footerContent   = ? 
	    		WHERE cr_footerID   = ?");	
	    $result->bindParam(1, $kosong);
	    $result->bindParam(2, $kosong);
	    $result->bindParam(3, $kosong);
		$result->bindParam(4, $footerid);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete $fname Primary Footer Data', ?, ?, ?)");
		$historyDetail = " delete ".strtolower($fname)." primary footer data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class sfooter {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewSFooter() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'secondaryfooter'");
    	$rows = $cek->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateSFooter($value, $adminLoginID, $settingIDh) {
    	global $NowDate;
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue      = ? 
	    		WHERE cr_settingID   = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Secondary Footer', ?, ?, ?)");
		$historyDetail = " edit secondary footer data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class quotes {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function countQuotes() {
    	$cek   = $this->pdo->query("SELECT * FROM  cr_quotes ORDER BY cr_quotesID desc");
    	$total = $cek->rowCount(); 
    	return $total;
    }
    public function viewQuotes() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_quotes ORDER BY cr_quotesID desc");
    	if($cek->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function addQuotes($name, $text, $adminLoginID) {
    	global $NowDate;
    	$result = $this->pdo->prepare("INSERT INTO cr_quotes(
			    		cr_quotesName, cr_quotesText) VALUES (?, ?)");
		$result->bindParam(1, $name);
		$result->bindParam(2, $text);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Quote', ?, ?, ?)");
		$historyDetail = " add new quote from .".ucwords($name).".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateQuotes($uname, $utext, $quotesIDh, $adminLoginID) {
    	global $NowDate;
	    $result = $this->pdo->prepare("UPDATE cr_quotes SET 
	    		cr_quotesName     = ?,
	    		cr_quotesText     = ?
	    		WHERE cr_quotesID = ?");	
	    $result->bindParam(1, $uname);
		$result->bindParam(2, $utext);
		$result->bindParam(3, $quotesIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Quote', ?, ?, ?)");
		$historyDetail = " edit quote from .".ucwords($uname).".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteQuotes($quotesID, $adminLoginID) {
    	global $NowDate;
    	$getname = $this->pdo->query("SELECT * FROM cr_quotes WHERE cr_quotesID = '$quotesID'");
    	$rows    = $getname->fetch(PDO::FETCH_OBJ);
    	$name    = $rows->cr_quotesName;

    	$result = $this->pdo->prepare("DELETE FROM cr_quotes WHERE cr_quotesID = ?");
    	$result->bindParam(1, $quotesID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Quotes', ?, ?, ?)");
		$historyDetail = " delete quote from .".ucwords($name).".";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function viewPageforQuotesMenu() {
    	$cek = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option<>'customlink' AND cr_menuHasSub='0' ORDER BY cr_menuOrder asc");
    	if($cek->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function viewPageforQuotesSubmenu() {
    	$cek = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option<>'customlink' ORDER BY cr_submenuID asc");
    	if($cek->rowCount()<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $cek->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function viewQuotesinpageID() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='quotesinpage'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingID;
    }
    public function viewQuotesinpage() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName='quotesinpage'");
	    $rows   = $result->fetch(PDO::FETCH_OBJ);
		return $rows->cr_settingValue;
    }
}

class contactheader {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewContactHeader() {
    	$cek = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'contactheader'");
    	$rows = $cek->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function updateContactHeader($value, $adminLoginID, $settingIDh) {
    	global $NowDate;
	    $result = $this->pdo->prepare("UPDATE cr_setting SET 
	    		cr_settingValue      = ? 
	    		WHERE cr_settingID   = ?");	
	    $result->bindParam(1, $value);
		$result->bindParam(2, $settingIDh);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Contact Header', ?, ?, ?)");
		$historyDetail = " edit contact header data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

class map {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function viewMap() {
    	$chek = $this->pdo->query("SELECT * FROM  cr_map, cr_mapmarker WHERE cr_map.cr_mapmarkerID = cr_mapmarker.cr_mapmarkerID ORDER BY cr_map.cr_mapID desc LIMIT 1");
    	$getmap = $chek->rowCount();
    	if($getmap<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	$rows = $chek->fetch(PDO::FETCH_OBJ);
		    return $rows;
		}
    }
    public function viewMapMarker() {
    	$result = $this->pdo->query("SELECT * FROM  cr_mapmarker ORDER BY cr_mapmarkerID asc");
    	$getmapmarker = $result->rowCount();
    	if($getmapmarker<1) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function addMap($latlong, $mapdesc, $marker, $adminLoginID) {
    	global $NowDate;
    	if(empty($marker)) {
    		$mapmarker = "4";
    	}
    	else {
    		$mapmarker = $marker;
    	}
	    $result = $this->pdo->prepare("INSERT INTO cr_map(
			    		cr_mapLatLong, cr_mapDesc, cr_mapmarkerID) VALUES (?, ?, ?)");
		$result->bindParam(1, $latlong);
		$result->bindParam(2, $mapdesc);
		$result->bindParam(3, $mapmarker);
		$result->execute();

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Map', ?, ?, ?)");
		$historyDetail = " add new map data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function updateMap($latlong, $mapdesc, $marker, $adminLoginID, $mapIDh) {
    	global $NowDate;
    	if(empty($marker)) {
    		$result = $this->pdo->prepare("UPDATE cr_map SET 
		    		cr_mapLatLong  = ?,
		    		cr_mapDesc     = ?
		    		WHERE cr_mapID = ?");	
		    $result->bindParam(1, $latlong);
			$result->bindParam(2, $mapdesc);
			$result->bindParam(3, $mapIDh);
			$result->execute();
    	}
    	else {
		    $result = $this->pdo->prepare("UPDATE cr_map SET 
		    		cr_mapLatLong  = ?,
		    		cr_mapDesc     = ?,
		    		cr_mapmarkerID = ? 
		    		WHERE cr_mapID = ?");	
		    $result->bindParam(1, $latlong);
			$result->bindParam(2, $mapdesc);
			$result->bindParam(3, $marker);
			$result->bindParam(4, $mapIDh);
			$result->execute();
		}

		$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Map', ?, ?, ?)");
		$historyDetail = " edit map data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
    public function deleteMap($mapID, $adminLoginID) {
    	global $NowDate;
    	$result = $this->pdo->prepare("DELETE FROM cr_map WHERE cr_mapID = ?");
    	$result->bindParam(1, $mapID);
    	$result->execute();

    	$getHistory = $this->pdo->prepare("INSERT INTO cr_history(
			    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Map', ?, ?, ?)");
		$historyDetail = " delete map data.";
		$getHistory->bindParam(1, $historyDetail);
		$getHistory->bindParam(2, $NowDate);
		$getHistory->bindParam(3, $adminLoginID);
		$getHistory->execute();
    }
}

?>