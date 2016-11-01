<?php
/**
 * Class Mail
 *
 * @author baycore
 */

class Message {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_message_inbox($admin_id) {
    	$result  = $this->pdo->query("SELECT cr_messageID as idpesan, cr_messageName as messagename, cr_messageContent as content, cr_messageDate as tanggal, cr_messageType as tipe FROM cr_message WHERE cr_messageRead='0' AND cr_messageFolder='inbox' UNION SELECT cr_inbox.cr_inboxID as idpesan, cr_admin.cr_adminDisplayName as messagename, cr_inbox.cr_inboxContent as content, cr_inbox.cr_inboxDate as tanggal, cr_inbox.cr_inboxType as tipe FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxRead = '0' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID AND cr_inbox.cr_inboxTo = '$admin_id' AND cr_inbox.cr_inboxToFolder = 'inbox' ORDER BY tanggal desc LIMIT 6");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function get_photo($inbox_id) {
    	$result  = $this->pdo->query("SELECT * FROM cr_admin, cr_inbox WHERE cr_admin.cr_adminID = cr_inbox.cr_inboxFrom AND cr_inbox.cr_inboxID = '$inbox_id'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
    	return $rows->cr_adminPhoto;
    }
    //Inbox
    public function count_inbox() {
    	$check_q = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder = 'inbox'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function count_inbox_unread() {
    	$check_q = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder = 'inbox' AND cr_messageRead = '0'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function view_inbox_all() {
    	$result  = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder = 'inbox' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function view_inbox_read() {
    	$result  = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder = 'inbox' AND cr_messageRead = '1' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function view_inbox_unread() {
    	$result  = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder = 'inbox' AND cr_messageRead = '0' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function view_detail_inbox($message_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageID = '$message_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function reply_inbox($inbox_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID = '$inbox_id' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    //Trash
    public function count_trash() {
    	$check_q = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder = 'trash'");
    	$total   = $check_q->rowCount();
    	return $total;
    }
    public function view_trash_all() {
    	$result  = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageFolder = 'trash' ORDER BY cr_messageDate desc");
    	if($result->rowCount()<1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
				$data[]=$rows;
			return $data;
		}
    }
    public function view_detail_trash($message_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_message WHERE cr_messageID = '$message_id'");
    	$rows   = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function move_inbox_to_trash($message_id, $admin_login_id, $now_date) {
    	$t = "trash";
	    $result = $this->pdo->prepare("UPDATE cr_message SET 
	    		cr_messageFolder = ?
	    		WHERE cr_messageID = ?");	
	    $result->bindParam(1, $t);
		$result->bindParam(2, $message_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Move Message to Trash', ?, ?, ?)");
			$history_detail = " move one message in folder inbox to trash.";
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
    public function update_message_to_read($message_id) {
    	$r = "1";
	    $result = $this->pdo->prepare("UPDATE cr_message SET 
	    		cr_messageRead = ?
	    		WHERE cr_messageID = ?");	
	    $result->bindParam(1, $r);
		$result->bindParam(2, $message_id);
		if($result->execute()) {
			return true;
		}
		else {
			return false;
		}
    }
}
?>