<?php 
	
class generalSetting {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function getURL() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'siteURL'");
	    $rows = $result->fetch();
	    return $rows;
    }
    public function getFolderName() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'foldername'");
	    $rows = $result->fetch();
	    return $rows;
    }
    public function setTZ() {
	    $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'timezone'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
	}
	public function getComingsoon() {
	    $result = $this->pdo->query("SELECT * FROM  cr_setting WHERE cr_settingName = 'comingsoon'");
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows->cr_settingValue;
	}
}
class getAppearance {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
	public function getTheme() {
	    $result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'template'");
	    $rows = $result->fetch();
	    return $rows;
	}

}	

?>