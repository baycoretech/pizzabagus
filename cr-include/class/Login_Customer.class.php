<?php
/**
 * Class Login Customer
 *
 * @author baycore
 */
class Login_Customer {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function login_customer($customer_username) {
     	$result = $this->pdo->prepare("SELECT * FROM cr_customer WHERE cr_customerUsername = ?");
	    $result->bindParam(1, $customer_username);
	    $result->execute();
	    $rows = $result->fetch(PDO::FETCH_OBJ);
	    return $rows;
	}
}
?>