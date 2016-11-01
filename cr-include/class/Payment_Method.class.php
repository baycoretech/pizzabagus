<?php
/**
 * Class Payment Method
 *
 * @author baycore
 */

class Payment_Method {
    private $pdo;
    protected $alert = 0;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function count_active_payment_method() {
        $result = $this->pdo->query("SELECT * FROM cr_paymentmethod WHERE cr_paymentmethodStatus = '1'");
        $total  = $result->rowCount(); 
        return $total;
    }
    public function view_payment_method() {
        $result = $this->pdo->query("SELECT * FROM cr_paymentmethod WHERE cr_paymentmethodStatus = '1' ORDER BY cr_paymentmethodID asc");
        if($result->rowCount() < 1) {
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
}
?>