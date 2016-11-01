<?php
/**
 * Class Contact Header
 *
 * @author baycore
 */

class Contact_Header {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_contact_header() {
    	$check = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'contactheader'");
    	$rows  = $check->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
    public function view_social_top() {
        $result = $this->pdo->query("SELECT * FROM cr_social WHERE cr_socialLink <> 'Empty' AND cr_socialLink <> '' ORDER BY cr_socialOrder asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function get_google_plus_author() {
        $result = $this->pdo->query("SELECT * FROM cr_social WHERE cr_socialName = 'google-plus'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}
?>