<?php
/**
 * Class Secondary Footer
 *
 * @author baycore
 */

class Secondary_Footer {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_secondary_footer() {
    	$result = $this->pdo->query("SELECT * FROM cr_setting WHERE cr_settingName = 'secondaryfooter'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
    }
}
?>