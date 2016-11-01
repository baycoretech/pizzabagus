<?php
/**
 * Class Bank Account
 *
 * @author baycore
 */

class Bank_Account {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_bank_account() {
        $result = $this->pdo->query("SELECT * FROM cr_banks ORDER BY cr_banksID asc");
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