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
    public function view_invoice($invoice_number) {
        $result = $this->pdo->query("SELECT * FROM cr_invoice WHERE cr_invoiceNumber = '$invoice_number'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    public function create_invoice($now_date, $status, $invoicetype, $customername, $customeremail, $customeraddress, $customerphone, $customeraddinfo, $customerpayment) {
    	$id_num = str_pad($id_num, 3, "0", STR_PAD_LEFT);
    	$explode_invoice_type = explode(',', $invoicetype);
    	$invoice_type     = $explode_invoice_type[0];
    	$invoice_memberid = $explode_invoice_type[1];
    	$delivery_status  = 'on process';
    	$shipping         = NULL;
    	$shipping_courier_name = NULL;

    	if($invoice_type == 'member') {
    		$result = $this->pdo->prepare("INSERT INTO cr_invoice (cr_invoiceDate, cr_invoiceShipping, cr_invoiceStatus, cr_invoiceType, cr_invoiceCustomeraddinfo, cr_invoicePayment, cr_invoiceDeliverystatus, cr_invoiceCourier) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
	        $result->bindParam(1, $now_date);
	        $result->bindParam(2, $shipping);
	        $result->bindParam(3, $status);
            $result->bindParam(4, $invoicetype);
	        $result->bindParam(5, $customeraddinfo);
	        $result->bindParam(6, $customerpayment);
	        $result->bindParam(7, $delivery_status);
	        $result->bindParam(8, $shipping_courier_name);
	        if($result->execute()) {
		        $last_id = $this->pdo->lastInsertId();
		        $invoice_number_format = str_pad($last_id, 5, "0", STR_PAD_LEFT);
		        $result       = $this->pdo->query("UPDATE cr_invoice SET cr_invoiceNumber = '$invoice_number_format' WHERE cr_invoiceID = '$last_id'");
				return $invoice_number_format;
			}
			else {
				return false;
			}
    	}
    	elseif($invoice_type == 'guest') {
	    	$result = $this->pdo->prepare("INSERT INTO cr_invoice (cr_invoiceDate, cr_invoiceShipping, cr_invoiceStatus, cr_invoiceType, cr_invoiceCustomername, cr_invoiceCustomeremail, cr_invoiceCustomeraddress, cr_invoiceCustomerphone, cr_invoiceCustomeraddinfo, cr_invoicePayment, cr_invoiceDeliverystatus, cr_invoiceCourier) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	        $result->bindParam(1, $now_date);
	        $result->bindParam(2, $shipping);
	        $result->bindParam(3, $status);
	        $result->bindParam(4, $invoicetype);
	        $result->bindParam(5, $customername);
	        $result->bindParam(6, $customeremail);
	        $result->bindParam(7, $customeraddress);
	        $result->bindParam(8, $customerphone);
	        $result->bindParam(9, $customeraddinfo);
	        $result->bindParam(10, $customerpayment);
	        $result->bindParam(11, $delivery_status);
	        $result->bindParam(12, $shipping_courier_name);
	        if($result->execute()) {
		        $last_id = $this->pdo->lastInsertId();
		        $invoice_number_format = str_pad($last_id, 5, "0", STR_PAD_LEFT);
		        $result       = $this->pdo->query("UPDATE cr_invoice SET cr_invoiceNumber = '$invoice_number_format' WHERE cr_invoiceID = '$last_id'");
				return $invoice_number_format;
	    	}
	    	else {
	    		return false;
	    	}
	    }
    }
    public function create_invoice_detail($menu_id, $menu_qty, $menu_toppings, $invoice_number) {
	    $result = $this->pdo->prepare("INSERT INTO cr_invoicedetail (cr_ourmenuID, cr_ourmenuQuantity, cr_ourmenuToppings, cr_invoiceNumber) VALUES(?, ?, ?, ?)");
	    $result->bindParam(1, $menu_id);
	    $result->bindParam(2, $menu_qty);
	    $result->bindParam(3, $menu_toppings);
	    $result->bindParam(4, $invoice_number);
	    $result->execute();
	    //Update product stock in database
	    /*
	    $result = $this->pdo->query("SELECT * FROM cr_product WHERE cr_productID = '$product_id'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        $product_stock = $row->cr_productStock;
        $new_product_stock = $product_stock - $product_qty;

        $result = $this->pdo->prepare("UPDATE cr_product SET cr_productStock = ? WHERE cr_productID = ?");
        $result->bindParam(1, $new_product_stock);
        $result->bindParam(2, $product_id);
	    $result->execute();
	    */
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
    public function send_receipt($now_date, $from_bank, $to_bank, $total, $name, $photo, $invoice_id) {
        $name_upper = ucwords($name);
        $result = $this->pdo->prepare("INSERT INTO cr_transferreceipt(
                        cr_transferreceiptDate, cr_transferreceiptFrombank, cr_transferreceiptTobank, cr_transferreceiptTotal, cr_transferreceiptFromname, cr_transferreceiptImage, cr_invoiceID) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $result->bindParam(1, $now_date);
        $result->bindParam(2, $from_bank);
        $result->bindParam(3, $to_bank);
        $result->bindParam(4, $total);
        $result->bindParam(5, $name_upper);
        $result->bindParam(6, $photo);
        $result->bindParam(7, $invoice_id);
        if($result->execute()) {
        	return true;
        }
        else {
        	return false;
        }
    }
    */
}
?>