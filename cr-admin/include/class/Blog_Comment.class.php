<?php
/**
 * Class Blog Comment
 *
 * @author baycore
 */

class Blog_Comment {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function total_comments($blog_id) {
    	$result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID = '$blog_id'");
    	$total = $result->rowCount();
		return $total;
    }
    public function view_comments($blog_id) {
    	$result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID = '$blog_id' AND cr_commentReply = '0' ORDER BY cr_commentDate asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			   	$data[]=$rows;
			return $data;
		}
    }
    public function view_comments_reply($blog_id, $comment_id) {
    	$result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID = '$blog_id' AND cr_commentReply = '$comment_id' AND cr_commentStatus = '3' ORDER BY cr_commentDate asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			   	$data[]=$rows;
			return $data;
		}
    }
    public function view_reply($reply_id) {
    	$result  = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentID = '$reply_id'");
    	$rows = $result->fetch(PDO::FETCH_OBJ);
		return $rows;
    }
    public function reply_comment($comment_id, $content, $blog_id, $admin_login_id, $now_date) {
    	$admin_q = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$admin_login_id'");
    	$admin_f = $admin_q->fetch(PDO::FETCH_OBJ);
    	$admin_display_name = ucwords($admin_f->cr_adminDisplayName);
    	$admin_email        = $admin_f->cr_adminEmail;
    	$status  = "3";

    	$cname_q = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentID = '$comment_id'");
    	$cname_f = $cname_q->fetch(PDO::FETCH_OBJ);
    	$cname   = ucwords($cname_f->cr_commentName);

	    $result = $this->pdo->prepare("INSERT INTO cr_comment(
			    		cr_commentName, cr_commentEmail, cr_commentContent, cr_commentDate, cr_commentStatus, cr_commentReply, cr_adminID, cr_blogID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $admin_display_name);
		$result->bindParam(2, $admin_email);
		$result->bindParam(3, nl2br($content));
		$result->bindParam(4, $now_date);
		$result->bindParam(5, $status);
		$result->bindParam(6, $comment_id);
		$result->bindParam(7, $admin_login_id);
		$result->bindParam(8, $blog_id);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Reply Post Comment', ?, ?, ?)");
			$history_detail = " reply comment from ".$cname.".";
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
    public function approve_comment($comment_id) {
    	$status = 2;
		$result = $this->pdo->prepare("UPDATE cr_comment SET cr_commentStatus = ? WHERE cr_commentID = ?");
		$result->bindParam(1, $status);
		$result->bindParam(2, $comment_id);
		if($result->execute()) {
			return true;
 		}
 		else {
 			return false;
 		}
    }
    public function unapprove_comment($comment_id) {
    	$status = 1;
		$result = $this->pdo->prepare("UPDATE cr_comment SET cr_commentStatus = ? WHERE cr_commentID = ?");
		$result->bindParam(1, $status);
		$result->bindParam(2, $comment_id);
		if($result->execute()) {
			return true;
 		}
 		else {
 			return false;
 		}
    }
    public function delete_comment($comment_id, $admin_login_id, $now_date) {
    	$check_q = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentID = '$comment_id'");
    	$check_f = $check_q->fetch(PDO::FETCH_OBJ);
		$check   = $check_f->cr_commentName;

		$reply_q = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_commentReply = '$comment_id'");
		if($reply_q->rowCount() >= 1){
		    $reply_d = $this->pdo->prepare("DELETE FROM cr_comment WHERE cr_commentReply = ?");
		    $reply_d->bindParam(1, $comment_id);
    		$reply_d->execute();
		}

    	$result = $this->pdo->prepare("DELETE FROM cr_comment WHERE cr_commentID = ?");
    	$result->bindParam(1, $comment_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Comment', ?, ?, ?)");
			$history_detail = " delete comment from ".$check.".";
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