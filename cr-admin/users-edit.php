<?php
    $function_edit_administrator = $class_administrator->edit_administrator($id);
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
                <h4 class="panel-title">User Information</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="form-edit-user" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $function_edit_administrator->cr_adminID ?>">
                        <input id="avatarForm" type="hidden" name="photo" value="<?php echo $function_edit_administrator->cr_adminPhoto ?>">
                        <legend>General Information</legend>
                        <div class="note note-info">
                            Keep password field empty if you don't want to change the password.
                        </div>
                        <div class="form-group">
                            <label class="control-label">Username</label>
                            <input class="form-control" placeholder="Username" type="text" name="username" data-parsley-minlength="4" data-parsley-maxlength="20" value="<?php echo $function_edit_administrator->cr_adminUsername; ?>" required>
                        </div>
                        <div id="pwd-container" class="form-group">
                            <label class="control-label">Password</label>
                            <input id="passwordField" class="form-control password-indicator-visible" placeholder="Password" type="password" name="password" data-parsley-minlength="6" data-parsley-maxlength="20" value="">
                            <div class="pwstrength-viewport-progress m-t-15"></div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input class="form-control" placeholder="Email" type="email" name="email"  value="<?php echo $function_edit_administrator->cr_adminEmail; ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Display Name</label>
                            <input class="form-control" placeholder="Display Name" type="text" name="displayname" value="<?php echo $function_edit_administrator->cr_adminDisplayName; ?>" data-parsley-minlength="4" data-parsley-maxlength="20" required>
                        </div>
                        <?php
                            if($admin_level == 1) {
                        ?>
                        <div class="form-group">
                            <label class="control-label">User Level</label>
                            <select class="form-control" name="level" required>
                                <option value="">Select User Level</option>
                                <option value="1" <?php if($function_edit_administrator->cr_adminLevel == 1) echo 'selected="selected"' ?>>Administrator</option>
                                <option value="2" <?php if($function_edit_administrator->cr_adminLevel == 2) echo 'selected="selected"' ?>>Editor</option>
                            </select>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="form-group">
                            <label class="control-label">About You</label>
                            <textarea id="quotestext" class="form-control" placeholder="Write here..." name="aboutyou" rows="3" data-parsley-maxlength="255"><?php echo $function_edit_administrator->cr_adminAbout; ?></textarea>
                        </div>

                        <legend>Social Media</legend>
                        <div class="form-group has-feedback">
                            <label class="control-label">Facebook</label>
                            <input class="form-control" placeholder="Facebook" type="text" name="facebook" value="<?php echo $function_edit_administrator->cr_adminFacebook; ?>" data-parsley-minlength="4" data-parsley-maxlength="100" data-parsley-type="url">
                            <span class="fa fa-facebook form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label">Google+</label>
                            <input class="form-control" placeholder="Google+" type="text" name="googleplus" value="<?php echo $function_edit_administrator->cr_adminGoogleplus; ?>" data-parsley-minlength="4" data-parsley-maxlength="100" data-parsley-type="url">
                            <span class="fa fa-google-plus form-control-feedback"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="control-label">Twitter</label>
                            <input class="form-control" placeholder="Twitter" type="text" name="twitter" value="<?php echo $function_edit_administrator->cr_adminTwitter; ?>" data-parsley-minlength="4" data-parsley-maxlength="100" data-parsley-type="url">
                            <span class="fa fa-twitter form-control-feedback"></span>
                        </div>
                </div>
            <div class="panel-footer">
                <button id="button-edit-user" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
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
                <h4 class="panel-title">Photo Profile</h4>
            </div>
            <?php require "profile-avatar-upload.php" ?>
         </div>
        <!-- end panel -->
    </div>
</div>

<script>
    $(document).ready(function() {
        var auto_refresh = setInterval(
        function () {
            var asd = $('.avatar-view').find('img').attr('src');
            $('#avatarForm').attr('value', asd);
        }, 500);
        $('#passwordField').hidePassword(true);

        var edit_user;
        $("#form-edit-user").submit(function(event){
            if (edit_user) {
                edit_user.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_user = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/user-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-user").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-user").attr('disabled','disabled');},
                data: serializedData
            });
            edit_user.done(function (msg){
                if(msg == 'field-empty') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Please fill the required field",
                        text:"Can't update user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'username-short') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username is too short.",
                        text:"Can't update user. It should have 4 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'username-long') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username is too long.",
                        text:"Can't update user. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-short') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too short.",
                        text:"Can't update user. It should have 6 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-long') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too long.",
                        text:"Can't update user. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'displayname-short') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Display name is too short.",
                        text:"Can't update user. It should have 4 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'displayname-long') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Display name is too long.",
                        text:"Can't update user. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'aboutyou-long') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! About is too long.",
                        text:"Can't update user. It should have 255 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'email-invalid') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Email is invalid.",
                        text:"Can't update user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'fb-invalid') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Facebook link is invalid.",
                        text:"Can't update your profile. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'gp-invalid') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Google+ link is invalid.",
                        text:"Can't update user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'tw-invalid') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Twitter link is invalid.",
                        text:"Can't update user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"User has been updated",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update user",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-user").removeAttr('disabled');
                    $("#button-edit-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update user",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_user.always(function () {
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
