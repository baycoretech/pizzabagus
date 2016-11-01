<?php
    $function_edit_administrator = $class_administrator->edit_administrator($admin_id_session);
?>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">User Information</h4>
            </div>
            <div class="panel-body">
                <form id="form-edit-profile" data-parsley-validate action="" method="POST">
                    <input id="avatarForm" type="hidden" name="photo" value="<?php echo $function_edit_administrator->cr_adminPhoto; ?>">
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
                <button id="button-edit-profile" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-white m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>'">Cancel</button>
                </form>
            </div>
         </div>
    </div>
    <div class="col-md-4">
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

        var edit_profile;
        $("#form-edit-profile").submit(function(event){
            if (edit_profile) {
                edit_profile.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_profile = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/profile-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-profile").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-profile").attr('disabled','disabled');},
                data: serializedData
            });
            edit_profile.done(function (msg){
                if(msg == 'field-empty') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Please fill the required field",
                        text:"Can't update your profile. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'username-short') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username is too short.",
                        text:"Can't update your profile. It should have 4 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'username-long') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username is too long.",
                        text:"Can't update your profile. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-short') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too short.",
                        text:"Can't update your profile. It should have 6 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-long') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too long.",
                        text:"Can't update your profile. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'displayname-short') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Display name is too short.",
                        text:"Can't update your profile. It should have 4 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'displayname-long') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Display name is too long.",
                        text:"Can't update your profile. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'aboutyou-long') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! About is too long.",
                        text:"Can't update your profile. It should have 255 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'email-invalid') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Email is invalid.",
                        text:"Can't update your profile. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'fb-invalid') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Facebook link is invalid.",
                        text:"Can't update your profile. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'gp-invalid') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Google+ link is invalid.",
                        text:"Can't update your profile. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'tw-invalid') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Twitter link is invalid.",
                        text:"Can't update your profile. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Your profile has been updated",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'logout'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Your profile has been updated and will logout now",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo MADMINURL.'logout.php' ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update your profile",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-profile").removeAttr('disabled');
                    $("#button-edit-profile").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update your profile",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_profile.always(function () {
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
    