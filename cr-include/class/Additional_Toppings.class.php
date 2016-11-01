<?php
/**
 * Class Additional Toppings
 *
 * @author baycore
 */

class Additional_Toppings {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_additional_toppings() {
    	$result  = $this->pdo->query("SELECT * FROM cr_toppings ORDER BY cr_toppingsOrder asc");
        if($result->rowCount() < 1) {
            return false;
        }
        else {
        	while($rows = $result->fetch(PDO::FETCH_OBJ))
    			$data[]=$rows;
    		return $data;
        }
    }
    public function view_additional_toppings_order($topping_id) {
        $result = $this->pdo->query("SELECT * FROM cr_toppings WHERE cr_toppingsID = '$topping_id'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}
?>