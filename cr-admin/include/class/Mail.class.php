<?php
/**
 * Class Mail
 *
 * @author baycore
 */

class Mail {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    //compose
    public function compose_to($admin_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID <> '$admin_id' ORDER BY cr_adminID asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[]=$rows;
        return $data;
    }
    public function get_photo($inbox_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_admin, cr_inbox WHERE cr_admin.cr_adminID = cr_inbox.cr_inboxFrom AND cr_inbox.cr_inboxID = '$inbox_id'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows->cr_adminPhoto;
    }
    public function send_mail($to, $from, $subject, $content, $now_date) {
        $checkuser_q = $this->pdo->query("SELECT * FROM cr_admin WHERE cr_adminID = '$to'");
        $checkuser_f = $checkuser_q->fetch(PDO::FETCH_OBJ);
        $checkuser   = ucwords($checkuser_f->cr_adminDisplayName);

        $from_folder = "sent";
        $to_folder   = "inbox";
        $tmstamp     = time();
        $tipe        = "inbox";
        if(empty($subject)) {
            $subjct = "No Subject";
        }
        else {
            $subjct = ucwords($subject);
        }
        $read       = 0;
        $result = $this->pdo->prepare("INSERT INTO cr_inbox(
                        cr_inboxSubject, cr_inboxContent, cr_inboxFrom, cr_inboxTo, cr_inboxDate, cr_inboxRead, cr_inboxTimestamp, cr_inboxFromFolder, cr_inboxToFolder, cr_inboxType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $result->bindParam(1, $subjct);
        $result->bindParam(2, $content);
        $result->bindParam(3, $from);
        $result->bindParam(4, $to);
        $result->bindParam(5, $now_date);
        $result->bindParam(6, $read);
        $result->bindParam(7, $tmstamp);
        $result->bindParam(8, $from_folder);
        $result->bindParam(9, $to_folder);
        $result->bindParam(10, $tipe);
        if($result->execute()) {
            if(strlen($content)<100) {
                $short_content = strip_tags($content);
            }
            else {
                $short_content = strip_tags(substr($content, 0, 100))."...";
            }
            $history_title = 'Send mail to '.$checkuser;
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES (?, ?, ?, ?)");
            $history_detail = " send mail to ".$checkuser."<br>"."Content <i class='fa fa-arrow-right'></i> ".$short_content;
            $get_history->bindParam(1, $history_title);
            $get_history->bindParam(2, $history_detail);
            $get_history->bindParam(3, $now_date);
            $get_history->bindParam(4, $from);
            $get_history->execute();
            return true;
        }
        else {
            return false;
        }
    }
    //Inbox
    public function count_inbox($admin_id) {
        $check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxTo = '$admin_id' AND cr_inboxToFolder = 'inbox'");
        $total   = $check_q->rowCount();
        return $total;
    }
    public function count_inbox_unread($admin_id) {
        $check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxTo = '$admin_id' AND cr_inboxToFolder = 'inbox' AND cr_inboxRead = '0'");
        $total   = $check_q->rowCount();
        return $total;
    }
    public function view_inbox_all($admin_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo = '$admin_id' AND cr_inbox.cr_inboxToFolder = 'inbox' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_inbox_read($admin_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo = '$admin_id' AND cr_inbox.cr_inboxToFolder = 'inbox' AND cr_inbox.cr_inboxRead = '1' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_inbox_unread($admin_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo = '$admin_id' AND cr_inbox.cr_inboxToFolder = 'inbox' AND cr_inbox.cr_inboxRead = '0' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
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
        $result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID = '$message_id' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function reply_inbox($inbox_id) {
        $result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID = '$inbox_id' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    //Sent
    public function count_sent($admin_id) {
        $check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxFrom = '$admin_id' AND cr_inboxFromFolder = 'sent'");
        $total   = $check_q->rowCount();
        return $total;
    }
    public function view_sent_all($admin_id) {
        $result  = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxFrom = '$admin_id' AND cr_inbox.cr_inboxFromFolder = 'sent' AND cr_inbox.cr_inboxTo = cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_detail_sent($message_id) {
        $result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID = '$message_id' AND cr_inbox.cr_inboxTo = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    //Trash
    public function count_trash($admin_id) {
        $check_q = $this->pdo->query("SELECT * FROM cr_inbox WHERE cr_inboxTo = '$admin_id' AND cr_inboxToFolder = 'trash'");
        $total   = $check_q->rowCount();
        return $total;
    }
    public function view_trash_all($admin_id) {
        $result  = $this->pdo->query("SELECT * FROM  cr_inbox, cr_admin WHERE cr_inbox.cr_inboxTo = '$admin_id' AND cr_inbox.cr_inboxToFolder = 'trash' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID ORDER BY cr_inbox.cr_inboxDate desc");
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
        $result = $this->pdo->query("SELECT * FROM cr_inbox, cr_admin WHERE cr_inbox.cr_inboxID = '$message_id' AND cr_inbox.cr_inboxFrom = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function move_inbox_to_trash($message_id, $admin_login_id, $now_date) {
        $t = "trash";
        $result = $this->pdo->prepare("UPDATE cr_inbox SET 
                cr_inboxToFolder = ?
                WHERE cr_inboxID = ?"); 
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
        $result = $this->pdo->prepare("UPDATE cr_inbox SET 
                cr_inboxRead = ?
                WHERE cr_inboxID = ?"); 
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