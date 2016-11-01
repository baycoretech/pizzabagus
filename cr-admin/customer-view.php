<?php
    $class_customer = new Customer($pdo);
    $function_view_customer = $class_customer->view_customer();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Customer List</h4>
            </div>
            <!--
            <div class="panel-toolbar">
                <button class="btn btn-success" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => 'add')) ?>'"><i class="fa fa-user-plus"></i> Add Customer</button>
            </div>
            -->
            <?php
                if($function_view_customer == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <strong>Empty!</strong>
                No customer data found.
                <span class="close" data-dismiss="alert">×</span>
            </div>
            <?php
                }
                else {
            ?>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th class="">No</th>
                                <th class="">Manual ID</th>
                                <th class="">Display</th>
                                <th class="">First Name</th>
                                <th class="">Last Name</th>
                                <th class="">Email</th>
                                <th class="">Address</th>
                                <th class="">Phone</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($function_view_customer as $customer) {
                                $display_name = ucwords($customer->cr_customerDisplayname);
                        ?>
                            <tr>
                                <td class="text-right"><?php echo $i ?></td>
                                <td class="text-right"><?php if($customer->cr_customerNumber == 0) echo ''; else echo $customer->cr_customerNumber ?></td>
                                <td class="text-center">
                                    <img class="rounded-corner no-admin-photo" data-name="<?php echo ucwords($display_name); ?>" data-font-size="36" data-width="50" data-height="50" alt="<?php echo ucwords($display_name); ?>" />

                                    <p class="text-center m-t-5 add-caps"><?php echo $display_name ?></p>
                                </td>
                                <td class="add-caps"><?php echo $customer->cr_customerFirstname ?></td>
                                <td class="add-caps"><?php echo $customer->cr_customerLastname ?></td>
                                <td>
                                    <?php 
                                        echo "<a href='mailto:$customer->cr_customerEmail'>".$customer->cr_customerEmail."</a>" 
                                    ?>
                                </td>
                                <td class="">
                                    <p><strong>Address 1</strong><br>
                                    <?php if($customer->cr_customerAddress1 == '') echo 'None'; else echo $customer->cr_customerAddress1 ?></p>
                                    <p><strong>Address 2</strong><br>
                                    <?php if($customer->cr_customerAddress2 == '') echo 'None'; else echo $customer->cr_customerAddress2 ?></p>
                                </td>
                                <td class=""><?php echo $customer->cr_customerPhone ?></td>
                                <td width="100" class="text-center">
                                    <?php
                                        if($admin_level == 1) {
                                    ?>
                                    <button type="button" class="btn btn-success btn-icon btn-circle" data-toggle="tooltip" data-placement="bottom" title="Edit <?php echo $display_name."'s" ?>  Profile" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => 'edit', 'id' => $customer->cr_customerID)) ?>'"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon btn-circle" title="Delete <?php echo $display_name ?>" data-target="#modal-delete-customer" data-toggle="modal" data-dn="<?php echo $display_name; ?>" data-delete="<?php echo $customer->cr_customerID; ?>"><i class="fa fa-times"></i></button>
                                    <?php
                                        }
                                    ?>
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
            <?php
                }
            ?>
        </div>
    </div>
</div>

<?php
    if($admin_level == 1) {
?>
<div class="modal fade" id="modal-delete-customer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <form id="form-delete-customer" action="" method="post">
                    <input type="hidden" name="customer_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-delete-customer" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<link href="<?php echo MADMINURL ?>assets/plugins/DataTables/css/data-table.css" type="text/css" rel="stylesheet" />
<script>
    $(document).ready(function() {
        $("#data-table").DataTable({dom:'C<"clear">lfrtip'});

        $('#modal-delete-customer').on('show.bs.modal', function(e) {
            $(this).find('input[name=customer_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });

        var delete_customer;
        $("#form-delete-customer").submit(function(event){
            if (delete_customer) {
                delete_customer.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var customer_name = $("#modal-delete-customer").find("#dn").html();
            var serializedData = $form.serialize();
            delete_customer = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/customer-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-customer").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-customer").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_customer.done(function (msg){
                if(msg == 'customer-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-customer").removeAttr('disabled');
                    $("#button-delete-customer").html('Delete');
                    $.gritter.add({
                        title:"Failed! Customer is required",
                        text:"Can't delete "+customer_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:customer_name+" has been deleted.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-customer').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-customer").removeAttr('disabled');
                    $("#button-delete-customer").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+customer_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-customer").removeAttr('disabled');
                    $("#button-delete-customer").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+customer_name+msg,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_customer.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
    });
</script>