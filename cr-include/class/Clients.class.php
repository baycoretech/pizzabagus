<?php
/**
 * Class Clients
 *
 * @author baycore
 */

class Clients {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_clients() {
        $result = $this->pdo->query("SELECT * FROM cr_clients ORDER BY cr_clientsOrder asc");
        if($result->rowCount() < 1){
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