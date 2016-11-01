<?php
    $class_customer = new Customer($pdo);
    $function_edit_customer = $class_customer->edit_customer($id);
?>
<div class="row">
    <!-- begin col-8 -->
    <div class="col-md-8">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Customer Information</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="form-edit-customer" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="customer_id" value="<?php echo $function_edit_customer->cr_customerID ?>">
                        <legend>Sign In Information</legend>
                        <div class="note note-info">
                            Keep password field empty if you don't want to change the password.
                        </div>
                        <div class="form-group">
                            <label class="control-label">Username (Required)</label>
                            <input class="form-control" placeholder="Username" type="text" name="username" data-parsley-maxlength="50" value="<?php echo $function_edit_customer->cr_customerUsername; ?>" required>
                        </div>
                        <div id="pwd-container" class="form-group">
                            <label class="control-label">Password</label>
                            <input id="passwordField" class="form-control password-indicator-visible" placeholder="Password" type="password" name="password" data-parsley-minlength="6" data-parsley-maxlength="50" value="">
                            <div class="pwstrength-viewport-progress m-t-15"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email (Required)</label>
                            <input class="form-control" placeholder="Email" type="email" name="email"  value="<?php echo $function_edit_customer->cr_customerEmail; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Display Name (Required)</label>
                            <input class="form-control" placeholder="Display Name" type="text" name="displayname" value="<?php echo $function_edit_customer->cr_customerDisplayname; ?>" data-parsley-maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Manual ID</label>
                            <input class="form-control" placeholder="Manual ID" type="text" name="idmanual" value="<?php echo $function_edit_customer->cr_customerNumber; ?>" data-parsley-type="integer">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Status (Required)</label>
                            <select class="form-control" name="status" required>
                                <option value="">Select Status (Required)</option>
                                <option value="1" <?php if($function_edit_customer->cr_customerStatus == '1') echo 'selected="selected"' ?>>Active</option>
                                <option value="2" <?php if($function_edit_customer->cr_customerStatus == '2') echo 'selected="selected"' ?>>Block</option>
                            </select>
                        </div>

                        <legend>Delivery Address</legend>
                        <div class="form-group">
                            <label class="control-label">Hotel or Villa</label>
                            <input type="text" class="form-control" id="register_hotelvilla" placeholder="Hotel or Villa" name="hotelvilla" value="<?php echo $function_edit_customer->cr_customerHotelvilla; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Title (Required)</label>
                            <select class="form-control" name="title" required>
                                <option value="">Select Title (Required)</option>
                                <option value="Mr" <?php if($function_edit_customer->cr_customerTitle == 'Mr') echo 'selected="selected"' ?>>Mr</option>
                                <option value="Mrs" <?php if($function_edit_customer->cr_customerTitle == 'Mrs') echo 'selected="selected"' ?>>Mrs</option>
                                <option value="Ms" <?php if($function_edit_customer->cr_customerTitle == 'Ms') echo 'selected="selected"' ?>>Ms</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">First Name (Required)</label>
                            <input type="text" class="form-control" id="register_firstname" placeholder="First Name (Required)" name="firstname" data-parsley-maxlength="100" value="<?php echo $function_edit_customer->cr_customerFirstname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Middle Name</label>
                            <input type="text" class="form-control" id="register_middlename" placeholder="Middle Name" name="middlename" data-parsley-maxlength="100" value="<?php echo $function_edit_customer->cr_customerMiddlename; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Last Name (Required)</label>
                            <input type="text" class="form-control" id="register_lastname" placeholder="Last Name (Required)" name="lastname" data-parsley-maxlength="100" value="<?php echo $function_edit_customer->cr_customerLastname; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address 1 (Required)</label>
                            <input type="text" class="form-control" id="register_address1" placeholder="Address 1 (Required)" name="address1" data-parsley-maxlength="500" value="<?php echo $function_edit_customer->cr_customerAddress1; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address 2</label>
                            <input type="text" class="form-control" id="register_address2" placeholder="Address 2" name="address2" data-parsley-maxlength="500" value="<?php echo $function_edit_customer->cr_customerAddress2; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">City (Required)</label>
                            <input type="text" class="form-control" id="register_city" placeholder="City (Required)" name="city" value="Ubud, Bali" readonly="readonly" value="<?php echo $function_edit_customer->cr_customerCity; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Detail</label>
                            <textarea class="form-control" id="register_details" name="detail" rows="4" placeholder="Please add any information you have that will help our driver locate your house or villa, such as nearby landmarks and identifying features!" data-parsley-maxlength="1000"><?php echo $function_edit_customer->cr_customerDetail; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Mobile Phone (Required)</label>
                            <input type="text" name="phone" class="form-control" id="register_mobilephone" placeholder="Mobile Phone (Required)" value="<?php echo $function_edit_customer->cr_customerPhone; ?>" required>
                        </div>

                </div>
            <div class="panel-footer">
                <button id="button-edit-customer" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-white pull-right m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>'">Cancel</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>
    <div class="col-md-4">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">More Information</h4>
            </div>
            <div class="panel-body">
                <dl class="dl-information">
                    <dt>Status</dt>
                    <dd><?php if($function_edit_customer->cr_customerStatus == '1') echo 'Active'; elseif($function_edit_customer->cr_customerStatus == '2') echo 'Block' ?></dd>
                    <dt>Registered Date</dt>
                    <dd><?php echo date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($function_edit_customer->cr_customerRegistered)) ?></dd>
                    <dt>Last Modified Date</dt>
                    <dd><?php if($function_edit_customer->cr_customerModified == '0000-00-00 00:00:00') echo 'None'; else echo date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($function_edit_customer->cr_customerModified)) ?></dd>
                    <dt>Last Modified by</dt>
                    <dd>
                        <?php
                            if($function_edit_customer->cr_customerModifiedby == '')
                                echo 'None';
                            else {
                                $explode_mod_by = explode(',', $function_edit_customer->cr_customerModifiedby);
                                if($explode_mod_by[0] == 'customer') {
                                    $mod_by = $class_customer->modified_customer_by_customer($explode_mod_by[1]);
                                    echo $mod_by .'(Customer)';
                                }
                                elseif($explode_mod_by[0] == 'admin') {
                                    $mod_by = $class_customer->modified_customer_by_admin($explode_mod_by[1]);
                                    echo $mod_by .'(Admin)';
                                }
                            }
                        ?>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#passwordField').hidePassword(true);

        $("#register_mobilephone").mask("(089)9999999?99");

        var edit_customer;
        $("#form-edit-customer").submit(function(event){
            if (edit_customer) {
                edit_customer.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_customer = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/customer-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-customer").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-customer").attr('disabled','disabled');},
                data: serializedData
            });
            edit_customer.done(function (msg){
                if(msg == 'field-empty') {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Please fill the required field",
                        text:"Can't update customer. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'username-long') {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username is too long.",
                        text:"Can't update customer. It should have 50 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-short') {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too short.",
                        text:"Can't update customer. It should have 6 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-long') {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too long.",
                        text:"Can't update customer. It should have 50 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'displayname-long') {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Display name is too long.",
                        text:"Can't update customer. It should have 255 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'email-invalid') {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Email is invalid.",
                        text:"Can't update customer. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Customer has been updated",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update customer",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-customer").removeAttr('disabled');
                    $("#button-edit-customer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update customer"+msg,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_customer.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        "use strict";
        var options = {};
        options.ui = {
            container: "#pwd-container",
            showVerdictsInsideProgressBar: true,
            viewports: {
                progress: ".pwstrength-viewport-progress"
            }
        };
        options.common = {
            debug: true
        };
        $('#passwordField').pwstrength(options);
    });
</script>
