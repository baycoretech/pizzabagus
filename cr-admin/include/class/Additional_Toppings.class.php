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
    public function total_additional_toppings() {
        $result = $this->pdo->query("SELECT * FROM cr_toppings ORDER BY cr_toppingsOrder asc");
        $total  = $result->rowCount();
        return $total;
    }
    public function view_additional_toppings_order($topping_id) {
        $result = $this->pdo->query("SELECT * FROM cr_toppings WHERE cr_toppingsID = '$topping_id'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function add_additional_toppings($name, $name_id, $price, $menu_category, $size, $admin_login_id, $now_date) {
        $name_upper = ucwords($name);
        $result = $this->pdo->prepare("INSERT INTO cr_toppings(
                        cr_toppingsName, cr_toppingsPrice, cr_ourmenucategoryID, cr_toppingsSize, cr_toppingsName_id) VALUES (?, ?, ?, ?, ?)");
        $result->bindParam(1, $name_upper);
        $result->bindParam(2, $price);
        $result->bindParam(3, $menu_category);
        $result->bindParam(4, $size);
        $result->bindParam(5, $name_id);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Additional Toppings', ?, ?, ?)");
            $history_detail = " add ".$name_upper." in additional toppings.";
            $get_history->bindParam(1, $history_detail);
            $get_history->bindParam(2, $now_date);
            $get_history->bindParam(3, $admin_login_id);
            $get_history->execute();
            return true;
        }
        else {
            return false;
        }
    }
    public function check_name_additional_toppings($name) {
        $result = $this->pdo->query("SELECT * FROM cr_toppings WHERE cr_toppingsName = '$name'");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            return true;
        }
    }
    public function check_update_name_additional_toppings($name, $id) {
        $result = $this->pdo->query("SELECT * FROM cr_toppings WHERE cr_toppingsName = '$name' AND cr_toppingsID <> '$id'");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            return true;
        }
    }
    public function update_additional_toppings($name, $name_id, $name_old, $price, $menu_category, $size, $additional_toppings_idh, $admin_login_id, $now_date) {
        $name_upper = ucwords($name);
        $result = $this->pdo->prepare("UPDATE cr_toppings SET 
            cr_toppingsName  = ?,
            cr_toppingsPrice = ?, 
            cr_ourmenucategoryID = ?,
            cr_toppingsSize  = ?,
            cr_toppingsName_id = ? 
            WHERE cr_toppingsID  = ?");
        $result->bindParam(1, $name_upper);
        $result->bindParam(2, $price);
        $result->bindParam(3, $menu_category);
        $result->bindParam(4, $size);
        $result->bindParam(5, $name_id);
        $result->bindParam(6, $additional_toppings_idh);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Additional Toppings', ?, ?, ?)");
            $history_detail = " edit additional toppings from ".$name_old." to ".$name_upper.".";
            $get_history->bindParam(1, $history_detail);
            $get_history->bindParam(2, $now_date);
            $get_history->bindParam(3, $admin_login_id);
            $get_history->execute();
            return true;
        }
        else {
            return false;
        }
    }
    public function reorder_additional_toppings($id_array) {
        $count = 1;
        foreach ($id_array as $id){
            $result = $this->pdo->query("UPDATE cr_toppings SET cr_toppingsOrder = $count WHERE cr_toppingsID = $id");
            $count ++;  
        }
        return true;
    }
    public function delete_additional_toppings($at_id, $admin_login_id, $now_date) {
        $result   = $this->pdo->query("SELECT * FROM cr_toppings WHERE cr_toppingsID = '$at_id'");
        $fetch    = $result->fetch(PDO::FETCH_OBJ);
        $at_name  = $fetch->cr_toppingsName;

        $result = $this->pdo->prepare("DELETE FROM cr_toppings WHERE cr_toppingsID = ?");
        $result->bindParam(1, $at_id);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Additional Toppings', ?, ?, ?)");
            $history_detail = " delete ".$at_name." in additional toppings.";
            $get_history->bindParam(1, $history_detail);
            $get_history->bindParam(2, $now_date);
            $get_history->bindParam(3, $admin_login_id);
            $get_history->execute();
            return true;
        }
        else {
            return false;
        }
    }
}
?>