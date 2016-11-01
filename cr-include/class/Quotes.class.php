<?php
/**
 * Class Quotes
 *
 * @author baycore
 */

class Quotes {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function count_quotes() {
        $result = $this->pdo->query("SELECT * FROM cr_quotes");
        $total  = $result->rowCount(); 
        return $total;
    }
    public function view_quotes() {
        $result = $this->pdo->query("SELECT * FROM cr_quotes ORDER BY cr_quotesID desc");
        if($result->rowCount() < 1) {
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