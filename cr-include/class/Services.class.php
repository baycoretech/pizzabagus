<?php
/**
 * Class Services
 *
 * @author baycore
 */

class Services {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function count_services() {
        $cek   = $this->pdo->query("SELECT * FROM cr_services");
        $total = $cek->rowCount(); 
        return $total;
    }
    public function view_services() {
        $result = $this->pdo->query("SELECT * FROM cr_services ORDER BY cr_servicesID desc");
        if($result->rowCount()<1) {
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