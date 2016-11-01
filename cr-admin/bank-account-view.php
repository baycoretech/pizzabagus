<?php
    $class_bank    = new Bank_Account($pdo);
    $function_view_bank_account = $class_bank->view_bank_account();
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
                <h4 class="panel-title">Bank Account List</h4>
            </div>
            <div class="panel-toolbar">
                <button class="btn btn-success m-b-5 m-r-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => 'add')) ?>'"><i class="fa fa-plus"></i> Add Bank Account</button>
            </div>
            <?php
                if($function_view_bank_account == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    You have no bank account.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <ul class="media-list media-list-with-divider">
                    
                <?php
                    foreach($function_view_bank_account as $bank) {
                        $bank_id     = $bank->cr_banksID;
                        $bank_name   = $bank->cr_banksName;
                        $bank_number = $bank->cr_banksNumber;
                        $bank_owner  = $bank->cr_banksOwner;
                        $bank_image  = $bank->cr_banksImage;
                ?>
                    <li class="media">
                        <a class="media-left" href="javascript:;">
                            <img src="<?php echo MURL.'cr-editor/images/'.$bank_image ?>" alt="<?php echo $bank_name ?>" class="media-object">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $bank_name ?></h4>
                            <dl class="dl-horizontal">
                                <dt>Account</dt>
                                <dd>: <?php echo $bank_number ?></dd>
                                <dt>Owner</dt>
                                <dd>: <?php echo $bank_owner ?></dd>
                            </dl>
                            <p>
                                <button class="btn btn-success btn-sm" type="button" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => 'edit', 'id' => $bank_id)) ?>'"><i class="fa fa-pencil"></i> Edit</button>
                                <button class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#modal-delete-bank" data-name="<?php echo $bank_name ?>" data-delete="<?php echo $bank_id ?>"><i class="fa fa-times"></i> Delete</button>
                            </p>
                        </div>
                    </li>
                <?php
                    }
                ?>
                </ul>
            </div>
            <?php
                }
            ?>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<div class="modal fade" id="modal-delete-bank">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="bank-name"></span> bank account?</p>
                <form id="form-delete-bank" action="" method="post">
                    <input type="hidden" name="bank_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-bank" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $('#modal-delete-bank').on('show.bs.modal', function(e) {
        $(this).find('#delete').attr('value', $(e.relatedTarget).data('delete'));
        $(this).find('#bank-name').html($(e.relatedTarget).data('name'));
    });

    var delete_bank;
        $("#form-delete-bank").submit(function(event){
            if (delete_bank) {
                delete_bank.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var bank_name = $("#modal-delete-bank").find("#bank-name").html();
            var serializedData = $form.serialize();
            delete_bank = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/bank-account-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-bank").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-bank").attr('disabled','disabled');},
                data: serializedData
            });
            delete_bank.done(function (msg){
                if(msg == 'bank-empty') {
                    $("#button-delete-bank").removeAttr('disabled');
                    $("#button-delete-bank").html('Delete');
                    $.gritter.add({
                        title:"Failed! Bank account is required",
                        text:"Can't delete "+bank_name+" bank account. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:bank_name+" bank account has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-bank').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-bank").removeAttr('disabled');
                    $("#button-delete-bank").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+bank_name+" bank account",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-bank").removeAttr('disabled');
                    $("#button-delete-bank").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+bank_name+" bank account",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_bank.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  
});
</script>