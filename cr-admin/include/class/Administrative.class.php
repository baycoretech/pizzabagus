<?php
/**
 * Class Administrative
 *
 * @author baycore
 */

class Administrative {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function site_url() {
     	$result = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'siteurl'");
	    $result->execute();
	    $site_url_f = $result->fetch(PDO::FETCH_OBJ);
	    $site_url   = $site_url_f->cr_settingValue . $_SERVER['SERVER_NAME'];
	    return $site_url;
	}
	public function folder_name() {
     	$result = $this->pdo->prepare("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
	    $result->execute();
	    $folder_name_f = $result->fetch(PDO::FETCH_OBJ);
	    $folder_name   = $folder_name_f->cr_settingValue;
	    if($folder_name == "") {
	    	return false;
	    }
	    else {
	    	return $folder_name;
	    }
	}
	public function total_visitor() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor ORDER BY cr_visitorDate desc");
		$total  = $result->rowCount();
		return $total;
	}
	public function total_publish_post() {
		$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogStatus = 'publish'");
		$total  = $result->rowCount();
		return $total;
	}
	public function total_draft_post() {
		$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogStatus = 'draft'");
		$total  = $result->rowCount();
		return $total;
	}
	public function total_portfolio() {
		$result = $this->pdo->query("SELECT * FROM cr_portfolio");
		$total  = $result->rowCount();
		return $total;
	}
	public function total_visitor_1($min1date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min1date'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_2($min2date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min2date'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_3($min3date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min3date'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_4($min4date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min4date'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_5($min5date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min5date'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_6($min6date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min6date'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_7($min7date) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE DATE_FORMAT(cr_visitorDate,'%Y-%m-%d')='$min7date'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_browser_chrome() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE cr_visitorBrowser = 'Google Chrome'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_browser_firefox() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE cr_visitorBrowser = 'Mozilla Firefox'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_browser_safari() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE cr_visitorBrowser = 'Apple Safari'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_browser_opera() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE cr_visitorBrowser = 'Opera'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_browser_netscape() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE cr_visitorBrowser = 'Netscape'");
		$total = $result->rowCount();
		return $total;
	}
	public function total_visitor_browser_ie() {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE cr_visitorBrowser = 'Internet Explorer'");
		$total = $result->rowCount();
		return $total;
	}
	public function precentage_visitor($month, $year) {
		$result = $this->pdo->query("SELECT * FROM cr_visitor WHERE YEAR(cr_visitorDate) = '$year' AND MONTH(cr_visitorDate) = '$month'");
		$total = $result->rowCount();
		return $total;
	}
}
?>