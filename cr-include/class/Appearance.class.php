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
	public function view_logo() {
    	$check = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'websitelogo'");
    	$rows  = $check->fetch(PDO::FETCH_OBJ);
    	if($rows->cr_settingValue == "" || empty($rows->cr_settingValue)) {
    		$alert = 0;
    		return $alert;
    	}
    	else {
    		return $rows;	
    	}
    }
    public function view_invoice_logo() {
        $check = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'invoicelogo'");
        $rows  = $check->fetch(PDO::FETCH_OBJ);
        if($rows->cr_settingValue == "" || empty($rows->cr_settingValue)) {
            $alert = 0;
            return $alert;
        }
        else {
            return $rows;   
        }
    }
    public function view_fonts() {
        $result = $this->pdo->query("SELECT * FROM cr_fonts WHERE cr_fontsApplied <> 'default' ORDER BY cr_fontsID asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_default_font() {
        $result = $this->pdo->query("SELECT * FROM cr_fonts WHERE cr_fontsApplied = 'default'");
        $rows  = $result->fetch(PDO::FETCH_OBJ);
        if($result->rowCount() < 1){
            return false;
        }
        else {
            return $rows;   
        }
    }
}
?>