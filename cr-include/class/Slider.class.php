<?php
/**
 * Class Slider
 *
 * @author baycore
 */

class Slider {
	private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function total_slider() {
        $result = $this->pdo->query("SELECT * FROM cr_slider");  
        $total  = $result->rowCount();
        return $total;
    }
    public function view_slider() {
    	$result = $this->pdo->query("SELECT * FROM cr_slider ORDER BY cr_sliderID desc");
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