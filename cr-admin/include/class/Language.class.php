<?php
/**
 * Class Language
 *
 * @author baycore
 */

class Language {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function default_language() {
        $result = $this->pdo->query("SELECT * FROM cr_language WHERE cr_languageDefault = 'yes'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    public function view_language() {
        $result = $this->pdo->query("SELECT * FROM cr_language WHERE cr_languageStatus = '1' ORDER BY cr_languageID asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
}
?>