<?php
/**
 * Class Gallery
 *
 * @author baycore
 */

class Gallery {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_gallery($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_gallery WHERE cr_galleryLink = '$page_link' ORDER BY cr_galleryOrder asc");
        if($result->rowCount()<1) {
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