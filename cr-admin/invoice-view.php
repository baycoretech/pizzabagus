<?php
    $class_invoice = new Invoice($pdo);
    $function_view_invoice = $class_invoice->view_invoice();
    $function_sitename     = $class_settings->view_settings_sitename();
?>
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
         <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Invoice List</h4>
            </div>
            <?php
                if($function_view_invoice == false) {
            ?>
                <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                    No invoice data found.
                </div>
            <?php
                }
                else {
            ?>  
            <div class="panel-body p-0">
                <div class="vertical-box">
                    <div class="vertical-box-column p-15 bg-grey-100 width-200">
                        <div id="external-events" class="">
                            <form id="form-filter-invoice" data-parsley-validate action="" method="POST">
                                <div class="form-group">
                                    <select name="month" class="form-control selectpicker" data-size="10" data-live-search="true">
                                        <option value="0">Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="year" class="form-control selectpicker" data-size="10" data-live-search="true">
                                        <option value="0">Select Year</option>
                                        <?php $current_year = date('Y'); for($year=2000;$year<=$current_year;$year++) { ?>
                                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="status" class="form-control selectpicker" data-size="10" data-live-search="true">
                                        <option value="0">Select Payment Status</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                        <option value="canceled">Canceled</option>
                                        <option value="expired">Expired</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="delivery" class="form-control selectpicker" data-size="10" data-live-search="true">
                                        <option value="0">Select Delivery Status</option>
                                        <option value="on process">On Proccess</option>
                                        <option value="delivered">Delivered</option>
                                        <option value="undelivered">Undelivered</option>
                                    </select>
                                </div>
                                  
                                <button id="button-filter-invoice" type="submit" class="btn btn-success btn-block">Filter</button>
                            </form>
                        </div>
                    </div>
                    <div id="load-invoice" class="vertical-box-column p-15">
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
                                    foreach($function_view_invoice as $data) {
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
                                            <button type="button" class="btn btn-success btn-sm" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $invoice_number)) ?>'"><i class="fa fa-file-o"></i></button>
                                            <button type="button" class="btn btn-primary btn-sm" data-target="#modal-invoice-status" data-toggle="modal" data-id="<?php echo $invoice_id ?>" data-number="<?php echo $invoice_number ?>" data-status="<?php echo $invoice_status ?>"><i class="fa fa-check-square"></i></button>
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
                                            <!--<button type="button" class="btn btn-primary" data-target="#modal-transfer-receipt" data-toggle="modal" <?php if($check_receipt == 0) { echo 'disabled'; } else { ?>  data-name="<?php echo $function_view_invoice_receipt->cr_transferreceiptFromname ?>" data-date="<?php echo $transfer_date ?>" data-frombank="<?php echo $function_view_invoice_receipt->cr_transferreceiptFrombank ?>" data-tobank="<?php echo $bank_name->cr_banksName ?>" data-total="<?php echo $total_payment ?>" data-photo="<?php echo  MURL.'cr-editor/images/'.$function_view_invoice_receipt->cr_transferreceiptImage ?>" <?php } ?>><i class="fa fa-file-text-o"></i></button>-->
                                            <?php 
                                                    }
                                                }
                                            ?>
                                            <button type="button" class="btn btn-danger btn-sm" data-target="#modal-delete-invoice" data-toggle="modal" data-dn="<?php echo $invoice_number ?>" data-hapus="<?php echo $invoice_id; ?>"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                        $i++;
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-invoice-status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Invoice Status</h4>
      </div>
        <div class="modal-body">
            <form id="form-change-status" data-parsley-validate action="" method="POST">
                <input id="invoice_id" type="hidden" name="invoice_id" value="">
                <div class="form-group">
                    <label class="control-label">Select status for invoice #<span id="invoice_name"></span>?</label>
                    <select id="status-value" class="form-control" name="status" required>
                        <option value="">Select Status</option>
                        <option value="paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                        <option value="expired">Expired</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <button id="button-change-status" type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-invoice-delivery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Invoice Delivery Status</h4>
      </div>
        <div class="modal-body">
            <form id="form-change-delivery" data-parsley-validate action="" method="POST">
                <input type="hidden" name="invoice_id" value="">
                <div class="form-group">
                    <label class="control-label">Select delivery status for invoice #<span id="invoice_name"></span>?</label>
                    <select class="form-control" name="delivery" required>
                        <option value="">Select Status</option>
                        <option value="on process">On Process</option>
                        <option value="delivered">Delivered</option>
                        <option value="undelivered">Undelivered</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
            <button id="button-change-delivery" type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<!--
<div class="modal fade" id="modal-transfer-receipt" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Payment Receipt</h4>
      </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <img class="img-responsive" id="receipt-photo" src="" width="100%">
                </div>
                <div class="col-md-6">
                    <dl>
                        <dt>Name</dt>
                        <dd id="receipt-name"></dd>
                        <dt>From Bank</dt>
                        <dd id="receipt-frombank"></dd>
                        <dt>To Bank</dt>
                        <dd id="receipt-tobank"></dd>
                        <dt>Transfer Date</dt>
                        <dd id="receipt-date"></dd>
                        <dt>Total</dt>
                        <dd id="receipt-total"></dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>
-->
<div class="modal fade" id="modal-delete-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete invoice #<span id="dn"></span>?</p>
                <form id="form-delete-invoice" action="" method="post">
                    <input type="hidden" name="invoice_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-invoice" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".selectpicker").selectpicker("render");

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

        var filter_invoice;
        $("#form-filter-invoice").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (filter_invoice) {
                    filter_invoice.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                filter_invoice = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/invoice-filter.php",
                    type: "post",
                    beforeSend: function(){ $("#button-filter-invoice").html('<i class="fa fa-spinner fa-pulse"></i> Filtering...');$("#button-filter-invoice").attr('disabled','disabled');$('#load-invoice').addClass('text-center');$('#load-invoice').html('<i class="fa fa-spinner fa-pulse fa-2x m-t-20"></i>')},
                    data: serializedData
                });
                filter_invoice.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-filter-invoice").removeAttr('disabled');
                        $("#button-filter-invoice").html('Filter');
                        $.gritter.add({
                            title:"Failed! Please fill one of the select field",
                            text:"Can't filter invoice. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#load-invoice').load('<?php echo MADMINURL ?>ajax/invoice-no-filter.php');
                        }, 2000);
                        setTimeout(function() {
                            $("#error-filter").html('<div class="alert alert-info alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Please fill one of the select field.</div>');
                            $('#load-invoice').removeClass('text-center');
                        }, 2300);
                    }
                    else if(msg == 'false') {
                        $("#button-filter-invoice").removeAttr('disabled');
                        $("#button-filter-invoice").html('Filter');
                        $.gritter.add({
                            title:"No invoice found!",
                            text:"Please try another filter.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#load-invoice').load('<?php echo MADMINURL ?>ajax/invoice-no-filter.php');
                        }, 2000);
                        setTimeout(function() {
                            $("#error-filter").html('<div class="alert alert-info alert-dismissible fade in"  role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>No result found. Please try another filter.</div>');
                            $('#load-invoice').removeClass('text-center');
                        }, 2300);
                    }
                    else {
                        $("#button-filter-invoice").removeAttr('disabled');
                        $("#button-filter-invoice").html('Filter');
                        $.gritter.add({
                            title:"Success!",
                            text:"Invoice will fetch in seconds.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#load-invoice').html(msg);
                        }, 2000);
                        setTimeout(function() {
                            $("#button-filter-invoice").html('Filter');
                            $('#load-invoice').removeClass('text-center');
                        }, 2300);
                    }
                });
                filter_invoice.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        $('#modal-invoice-status').on('show.bs.modal', function(e) {
            $(this).find('#invoice_id').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('#invoice_name').html($(e.relatedTarget).data('number'));
            $(this).find('#status-value').attr('value', $(e.relatedTarget).data('status'));
        })

        $('#modal-invoice-delivery').on('show.bs.modal', function(e) {
            $(this).find('input[name=invoice_id]').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('#invoice_name').html($(e.relatedTarget).data('number'));
            $(this).find('select[name=delivery]').attr('value', $(e.relatedTarget).data('status'));
        })

        /*
        $('#modal-transfer-receipt').on('show.bs.modal', function(e) {
            $(this).find('#receipt-photo').attr('src', $(e.relatedTarget).data('photo'));
            $(this).find('#receipt-name').html($(e.relatedTarget).data('name'));
            $(this).find('#receipt-frombank').html($(e.relatedTarget).data('frombank'));
            $(this).find('#receipt-tobank').html($(e.relatedTarget).data('tobank'));
            $(this).find('#receipt-date').html($(e.relatedTarget).data('date'));
            $(this).find('#receipt-total').html($(e.relatedTarget).data('total'));
        });
        */

        $('#modal-delete-invoice').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });

        var change_invoice_status;
        $("#form-change-status").submit(function(event){
            if (change_invoice_status) {
                change_invoice_status.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var invoice_number = $("#modal-invoice-status").find("#invoice_name").html();
            var invoice_status = $("#modal-invoice-status").find("#status-value").val();
            var serializedData = $form.serialize();
            change_invoice_status = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/invoice-change-status.php",
                type: "post",
                beforeSend: function(){ $("#button-change-status").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-change-status").attr('disabled','disabled');},
                data: serializedData
            });
            change_invoice_status.done(function (msg){
                if(msg=='failed') {
                    $("#button-change-status").html('Save');
                    $("#button-change-status").removeAttr('disabled');
                    $.gritter.add({
                        title:"Failed!",
                        text:"Can't change invoice #"+invoice_number+" status. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg=='field-empty') {
                    $("#button-change-status").html('Save');
                    $("#button-change-status").removeAttr('disabled');
                    $.gritter.add({
                        title:"Failed! Please fill select invoice status",
                        text:"Can't change invoice #"+invoice_number+" status. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $.gritter.add({
                        title:"Success!",
                        text:"Invoice #"+invoice_number+" status has been changed to "+invoice_status+".",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-invoice-status').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
            });
            change_invoice_status.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var change_invoice_delivery;
        $("#form-change-delivery").submit(function(event){
            if (change_invoice_delivery) {
                change_invoice_delivery.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var invoice_number = $("#modal-invoice-delivery").find("#invoice_name").html();
            var invoice_status = $("#modal-invoice-delivery").find("#select[name=delivery]").val();
            var serializedData = $form.serialize();
            change_invoice_delivery = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/invoice-change-delivery.php",
                type: "post",
                beforeSend: function(){ $("#button-change-delivery").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-change-delivery").attr('disabled','disabled');},
                data: serializedData
            });
            change_invoice_delivery.done(function (msg){
                if(msg=='failed') {
                    $("#button-change-delivery").html('Save');
                    $("#button-change-delivery").removeAttr('disabled');
                    $.gritter.add({
                        title:"Failed!",
                        text:"Can't change invoice #"+invoice_number+" delivery status. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg=='field-empty') {
                    $("#button-change-delivery").html('Save');
                    $("#button-change-delivery").removeAttr('disabled');
                    $.gritter.add({
                        title:"Failed! Please fill select invoice status",
                        text:"Can't change invoice #"+invoice_number+" delivery status. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $.gritter.add({
                        title:"Success!",
                        text:"Invoice #"+invoice_number+" delivery status has been changed to "+invoice_status+".",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-invoice-delivery').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
            });
            change_invoice_delivery.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var delete_invoice;
        $("#form-delete-invoice").submit(function(event){
            if (delete_invoice) {
                delete_invoice.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var invoice_number = $("#modal-delete-invoice").find("#dn").html();
            var serializedData = $form.serialize();
            delete_invoice = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/invoice-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-invoice").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-invoice").attr('disabled','disabled');},
                data: serializedData
            });
            delete_invoice.done(function (msg){
                if(msg == 'invoice-empty') {
                    $("#button-delete-invoice").removeAttr('disabled');
                    $("#button-delete-invoice").html('Delete');
                    $.gritter.add({
                        title:"Failed! Invoice is required",
                        text:"Can't delete invoice #"+invoice_number+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Invoice #"+invoice_number+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-invoice').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-invoice").removeAttr('disabled');
                    $("#button-delete-invoice").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete invoice #"+invoice_number,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-invoice").removeAttr('disabled');
                    $("#button-delete-invoice").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete invoice #"+invoice_number,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_invoice.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  
    })
</script>