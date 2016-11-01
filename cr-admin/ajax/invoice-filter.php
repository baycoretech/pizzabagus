<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_general_setting = new General_Setting($pdo);
    $function_folder_name  = $class_general_setting->folder_name();
    $host         = "$_SERVER[HTTP_HOST]";
    $explode_url  = explode('/', $_SERVER[REQUEST_URI]);
    $router       = new AltoRouter();
    if($function_folder_name != false) {
        $router->setBasePath('/'.$function_folder_name);
    }
    require __DIR__.'/../../cr-include/routes.php';

    $class_settings = new Settings($pdo);
    $function_date_format        = $class_settings->view_settings_date_format();
    $function_time_format        = $class_settings->view_settings_time_format();

    $class_invoice = new Invoice($pdo);
	$month         = $_POST['month'];
    $year          = $_POST['year'];
    $status        = $_POST['status'];
    $delivery      = $_POST['delivery'];

	if($month == '0' && $year == '0' && $delivery == '0' && $status == '0') {
    	echo "empty-field";
    }
    else {
		$function_view_invoice_with_filter = $class_invoice->view_invoice_with_filter($month, $year, $delivery, $status);
		if($function_view_invoice_with_filter != false) {
?>
<div class="table-responsive">
    <table id="data-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Date Created</th>
                <th>Payment</th>
                <th>Payment Status</th>
                <th>Delivery Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            foreach($function_view_invoice_with_filter as $data) {
                $invoice_id       = $data->cr_invoiceID;
                $invoice_date     =  date($function_date_format->cr_settingValue." ".$function_time_format->cr_settingValue, strtotime($data->cr_invoiceDate));
                $invoice_number   = $data->cr_invoiceNumber;
                $invoice_status   = $data->cr_invoiceStatus;
                $invoice_type     = explode(',',$data->cr_invoiceType);
                if($data->cr_invoicePayment == 'bank') {
                    $invoice_payment = 'Bank Transfer';
                }
                elseif($data->cr_invoicePayment == 'cash') {
                    $invoice_payment = 'Cash';
                }
                if($data->cr_invoiceDeliverystatus == 'on process') {
                    $delivery_status = 'On Process';
                }
                elseif($data->cr_invoiceDeliverystatus == 'delivered') {
                    $delivery_status = 'Delivered';
                }
                elseif($data->cr_invoiceDeliverystatus == 'undelivered') {
                    $delivery_status = 'Undelivered';
                }
                //$check_receipt = $class_invoice->check_invoice_and_receipt($invoice_id);
        ?>
            <tr class="odd gradeX">
                <td><?php echo $i ?></td>
                <td><?php echo $invoice_number ?></td>
                <td><?php echo $invoice_date ?></td>
                <td><?php echo $invoice_payment ?></td>
                <td class="<?php if($invoice_status == 'unpaid') echo 'text-warning'; elseif($invoice_status == 'expired') echo 'text-danger'; elseif($invoice_status == 'canceled') echo 'text-info'; ?>"><?php echo ucwords($invoice_status) ?></td>
                <td><?php echo $delivery_status ?></td>
                <td class="text-center">
                    <button type="button" class="btn btn-success" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => 'invoice', 'action' => $invoice_number)) ?>'"><i class="fa fa-file-o"></i></button>
                    <button type="button" class="btn btn-primary" data-target="#modal-invoice-status" data-toggle="modal" data-id="<?php echo $invoice_id ?>" data-number="<?php echo $invoice_number ?>" data-status="<?php echo $invoice_status ?>"><i class="fa fa-check-square"></i></button>
                    <button type="button" class="btn btn-brown btn-sm" data-target="#modal-invoice-delivery" data-toggle="modal" data-id="<?php echo $invoice_id ?>" data-number="<?php echo $invoice_number ?>" data-status="<?php echo $data->cr_invoiceDeliverystatus ?>"><i class="fa fa-motorcycle"></i></button>
                    <?php
                        if($data->cr_invoicePayment == 'bank') {
                            if($invoice_type[0] == 'guest') {
                                $function_view_invoice_receipt = $class_invoice->view_invoice_receipt($invoice_id);
                                $transfer_date = date($function_date_format->cr_settingValue." ".$function_time_format->cr_settingValue, strtotime($function_view_invoice_receipt->cr_transferreceiptDate));
                                $bank_name = $class_invoice->view_banks_receipt($function_view_invoice_receipt->cr_transferreceiptTobank);
                                if($function_price_format->cr_settingValue == 'idr')
                                    $total_payment = format_idr($function_view_invoice_receipt->cr_transferreceiptTotal);
                                elseif($function_price_format->cr_settingValue == 'rp') 
                                    $total_payment = format_rupiah($function_view_invoice_receipt->cr_transferreceiptTotal);
                    ?>
                    <!--
                    <button type="button" class="btn btn-primary" data-target="#modal-transfer-receipt" data-toggle="modal" <?php if($check_receipt == 0) { echo 'disabled'; } else { ?>  data-name="<?php echo $function_view_invoice_receipt->cr_transferreceiptFromname ?>" data-date="<?php echo $transfer_date ?>" data-frombank="<?php echo $function_view_invoice_receipt->cr_transferreceiptFrombank ?>" data-tobank="<?php echo $bank_name->cr_banksName ?>" data-total="<?php echo $total_payment ?>" data-photo="<?php echo  MURL.'cr-editor/images/'.$function_view_invoice_receipt->cr_transferreceiptImage ?>" <?php } ?>><i class="fa fa-file-text-o"></i></button>
                    -->
                    <?php 
                            }
                        }
                    ?>
                    <button type="button" class="btn btn-danger" data-target="#modal-delete-invoice" data-toggle="modal" data-dn="<?php echo $invoice_number ?>" data-hapus="<?php echo $invoice_id; ?>"><i class="fa fa-times"></i></button>
                </td>
            </tr>
        <?php
                $i++;
            }
        ?>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#data-table").DataTable({
            dom:'Bfrtip',
            buttons:[
                {extend:"copy", text: '<i class="fa fa-copy"></i> Copy', className:"btn-success btn-sm"},
                {extend:"excel", text: '<i class="fa fa-file-excel-o"></i> Excel', className:"btn-success btn-sm"},
                {extend:"pdf", text: '<i class="fa fa-file-pdf-o"></i> PDF', filename: "<?php echo $function_sitename->cr_settingValue ?> - Invoice", className:"btn-success btn-sm"},
                {extend:"print", text: '<i class="fa fa-print"></i> Print', className:"btn-success btn-sm", exportOptions:{columns: ':visible'}},
                {extend:"colvis", text: '<i class="fa fa-eye-slash"></i> Column Visibility', className:"btn-success btn-sm"},
            ],
            responsive:!0
        });
    });
</script>
<?php
	    }
		else 
		    echo 'false';
	}
?>