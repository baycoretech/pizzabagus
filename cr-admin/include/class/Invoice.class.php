<?php
/**
 * Class Invoice
 *
 * @author baycore
 */

class Invoice {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_invoice() {
        $result = $this->pdo->query("SELECT * FROM cr_invoice ORDER BY cr_invoiceID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_invoice_with_filter($month, $year, $delivery, $status) {
        $where = "";
        if($month != '0') {
            $where .= " AND DATE_FORMAT(cr_invoiceDate,'%m') = '$month' ";
        }
        if($year != '0') {
            $where .= " AND DATE_FORMAT(cr_invoiceDate,'%Y') = '$year' ";
        }
        if($status != '0') {
            $where .= " AND cr_invoiceStatus = '$status' ";
        }
        if($delivery != '0') {
            $where .= " AND cr_invoiceDeliverystatus = '$delivery' ";
        }
        $result = $this->pdo->query("SELECT * FROM cr_invoice WHERE cr_invoicePayment = 'cash' $where ORDER BY cr_invoiceID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_invoice_detail_paper($invoice_number) {
        $result = $this->pdo->query("SELECT * FROM cr_invoice WHERE cr_invoiceNumber = '$invoice_number'");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
    }
    public function view_invoice_detail($invoice_number) {
        $result    = $this->pdo->query("SELECT * FROM cr_invoicedetail WHERE cr_invoiceNumber = '$invoice_number' ORDER BY cr_invoicedetailID asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    /*
    public function check_invoice_and_receipt($invoice_id) {
        $result = $this->pdo->query("SELECT * FROM cr_transferreceipt, cr_invoice WHERE cr_invoice.cr_invoiceID = cr_transferreceipt.cr_invoiceID AND cr_invoice.cr_invoiceID = '$invoice_id'");
        $total = $result->rowCount();
        return $total;
    }
    public function view_invoice_receipt($invoice_id) {
        $result = $this->pdo->query("SELECT * FROM cr_transferreceipt, cr_invoice WHERE cr_invoice.cr_invoiceID = cr_transferreceipt.cr_invoiceID AND cr_invoice.cr_invoiceID = '$invoice_id' LIMIT 1");
        if($result->rowCount()<1) {
            return false;
        }
        else {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows;
        }
    }
    public function view_banks_receipt($bank_id) {
        $result = $this->pdo->query("SELECT * FROM cr_banks WHERE cr_banksID = '$bank_id'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    */
    public function change_invoice_status($invoice_id, $status, $admin_login_id, $now_date) {
        $result = $this->pdo->query("SELECT * FROM cr_invoice WHERE cr_invoiceID = '$invoice_id'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        $number = $row->cr_invoiceNumber;
        $old_status = $row->cr_invoiceStatus;
        $result = $this->pdo->prepare("UPDATE cr_invoice SET 
            cr_invoiceStatus = ?
            WHERE cr_invoiceID = ?");
        $result->bindParam(1, $status);
        $result->bindParam(2, $invoice_id);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                        cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Invoice Status', ?, ?, ?)");
            $history_detail = " change invoice status(".$number.") from ".$old_status." to ".$status.".";
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
    public function change_invoice_delivery($invoice_id, $status, $admin_login_id, $now_date) {
        $result = $this->pdo->query("SELECT * FROM cr_invoice WHERE cr_invoiceID = '$invoice_id'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        $number = $row->cr_invoiceNumber;
        $old_status = $row->cr_invoiceDeliverystatus;
        $result = $this->pdo->prepare("UPDATE cr_invoice SET 
            cr_invoiceDeliverystatus = ?
            WHERE cr_invoiceID = ?");
        $result->bindParam(1, $status);
        $result->bindParam(2, $invoice_id);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                        cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Change Invoice Delivery Status', ?, ?, ?)");
            $history_detail = " change invoice delivery status(".$number.") from ".$old_status." to ".$status.".";
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
    public function delete_invoice($invoice_id, $admin_login_id, $now_date) {
        $check       = $this->pdo->query("SELECT * FROM cr_invoice WHERE cr_invoiceID = '$invoice_id'");
        $check_fetch = $check->fetch(PDO::FETCH_OBJ);
        $invoice_number = $check_fetch->cr_invoiceNumber;
        $result = $this->pdo->prepare("DELETE FROM cr_invoice WHERE cr_invoiceID = ?");
        $result->bindParam(1, $invoice_id);
        if($result->execute()) {
            $get_history = $this->pdo->prepare("INSERT INTO cr_history(
                            cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Invoice', ?, ?, ?)");
            $history_detail = " delete invoice #".$invoice_number." from invoice data.";
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