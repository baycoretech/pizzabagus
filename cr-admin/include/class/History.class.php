<?php
/**
 * Class History
 *
 * @author baycore
 */

class History {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_history() {
    	$result = $this->pdo->query("SELECT * FROM  cr_history, cr_admin WHERE cr_history.cr_adminID = cr_admin.cr_adminID ORDER BY cr_history.cr_historyID desc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function delete_history($history_id, $admin_login_id, $now_date) {
    	$check_q = $this->pdo->query("SELECT * FROM cr_history WHERE cr_historyID = '$history_id'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
		$check   = date('F d, Y g:i A', strtotime($check_f->cr_historyDateTime));

    	$result = $this->pdo->prepare("DELETE FROM cr_history WHERE cr_historyID = ?");
    	$result->bindParam(1, $history_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete History', ?, ?, ?)");
			$history_detail = " delete history at ".$check.".";
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
    public function delete_all_history($admin_login_id, $now_date) {
    	$result = $this->pdo->prepare("DELETE FROM cr_history");
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete All History', ?, ?, ?)");
			$history_detail = " delete all history.";
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