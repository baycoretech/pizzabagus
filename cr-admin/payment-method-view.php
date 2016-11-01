<?php
    $o_get_payment_method = new Payment_Method($pdo);
    $v_get_payment_method = $o_get_payment_method->view_payment_method();
?>
<div class="row">
    <!-- begin col-9 -->
    <div class="col-md-9">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">View</h4>
            </div>
            <?php
                if($v_get_payment_method == '0') {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    No payment method data found.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="30" class="text-center">#</th>
                                    <th width="140" class="">Name</th>
                                    <th class="">Description</th>
                                    <th width="100" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=1;
                                foreach ($v_get_payment_method as $data) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="add-caps"><?php echo $data->cr_paymentmethodName ?></td>
                                    <td><?php echo $data->cr_paymentmethodDesc ?></td>
                                    <td class="text-center">
                                        <input id="switchery-elem<?php echo $i ?>" class="switchery-elem" type="checkbox" data-render="switchery" data-theme="default" <?php if($data->cr_paymentmethodStatus == '1') echo 'checked'; else echo ''; ?> />
                                    </td>
                                </tr>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        var elem<?php echo $i ?> = document.querySelector('#switchery-elem<?php echo $i ?>');
                                        var init<?php echo $i ?> = new Switchery(elem<?php echo $i ?>, {color: '#00acac'});
                                        elem<?php echo $i ?>.onchange = function() {
                                            if(elem<?php echo $i ?>.checked==true) {
                                                var payment_id = '<?php echo $data->cr_paymentmethodID ?>';
                                                var status     = '1';
                                                var admin_id   = '<?php echo $cradminID_session ?>';
                                                var data_string = 'admin_id='+admin_id+'&status='+status+'&payment_id='+payment_id;
                                                $.ajax({
                                                    type: "POST",
                                                    url:  "<?php echo MADMINURL ?>/payment-method-status.php",
                                                    data: data_string,
                                                    cache: false,
                                                    success: function(data){
                                                        if(data == "success") {
                                                            $('#alert-dialog').modal('show');
                                                            $('#payment-status').html('Success activate payment method.');
                                                        }
                                                        else {
                                                            alert("Can't activate payment method. Please try again.");
                                                        }
                                                    }
                                                });
                                                return false;
                                            }
                                            else {
                                                var payment_id = '<?php echo $data->cr_paymentmethodID ?>';
                                                var status     = '0';
                                                var admin_id   = '<?php echo $cradminID_session ?>';
                                                var data_string = 'admin_id='+admin_id+'&status='+status+'&payment_id='+payment_id;
                                                $.ajax({
                                                    type: "POST",
                                                    url:  "<?php echo MADMINURL ?>/payment-method-status.php",
                                                    data: data_string,
                                                    cache: false,
                                                    success: function(data){
                                                        if(data=='success') {
                                                            $('#alert-dialog').modal('show');
                                                            $('#payment-status').html('Success deactivate payment method.');
                                                        }
                                                        else {
                                                            alert("Can't deactivate. Please try again.");
                                                        }
                                                    }
                                                });
                                                return false;
                                            }
                                        };
                                    });
                                </script>
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
        <!-- end panel -->
    </div>
    <!-- end col-9 -->
	<!-- begin col-3 -->
	<div class="col-md-3">
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Information
                        </a>
                    </h3>
                </div>
                <div style="" aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <p>
                            Select payment method that should be active in store front.
                        </p>
                    </div>
                </div>
            </div>
        </div>
	    <!-- end panel -->
	</div>
</div>
<div class="modal fade" id="alert-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-white" id="myModalLabel">Alert</h4>
            </div>
            <div class="modal-body">
                <p id="payment-status"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MADMINURL ?>/assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>/assets/plugins/switchery/switchery.min.js"></script>