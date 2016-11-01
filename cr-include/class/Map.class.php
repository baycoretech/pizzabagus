<?php
/**
 * Class Map
 *
 * @author baycore
 */

class Map {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_map() {
        $result  = $this->pdo->query("SELECT * FROM cr_map, cr_mapmarker WHERE cr_map.cr_mapmarkerID = cr_mapmarker.cr_mapmarkerID ORDER BY cr_map.cr_mapID desc LIMIT 1");
        $get_map = $result->rowCount();
        if($get_map < 1) {
            return false;
        }
        else {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
    }
    public function view_map_marker() {
        $result = $this->pdo->query("SELECT * FROM cr_mapmarker ORDER BY cr_mapmarkerID asc");
        $get_map_marker = $result->rowCount();
        if($get_map_marker < 1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
}
?>