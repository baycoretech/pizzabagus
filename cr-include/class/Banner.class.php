<?php
/**
 * Class Banner
 *
 * @author baycore
 */

class Banner {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_banner() {
        $result    = $this->pdo->query("SELECT * FROM cr_banner ORDER BY cr_bannerOrder asc");
        if($result->rowCount()<1) {
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
?>