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
                <?php
                    if (isset ($_POST['save'])) {
                            //Success and Error handle
                            $sc              = sha1("addsuccess");
                            $er              = sha1("adderror");
                            $username        = $_POST['username'];
                            $password        = generateHash($_POST['password']);
                            $email           = $_POST['email'];
                            $photourl        = $_POST['photo'];
                            $photo           = str_replace(MADMINURL,"",$photourl);
                            $displayname     = strtolower($_POST['displayname']);
                            $position        = $_POST['position'];
                            $level           = $_POST['level'];
                            $aboutyou        = $_POST['aboutyou'];
                            $fb              = $_POST['facebook'];
                            $gp              = $_POST['googleplus'];
                            $tw              = $_POST['twitter'];
                            $adminLoginID    = $_POST['adminLoginID'];

                        if(empty($username) || empty($password) || empty($email) || empty($displayname) || empty($position) || empty($level) || empty($adminLoginID)){
                                   header("Location: $madinurl/users/add/");             
                        }
                        else {
                                $v_getAddUser = $o_getUser->addUser($username, $password, $email, $photo, $displayname, $position, $level, $aboutyou, $fb, $gp, $tw, $adminLoginID);
                                if($v_getAddUser==1) {
                                    header("Location: $madinurl/users/add/sm/");
                                }
                                else {
                                   header("Location: $madinurl/users/"); 
                                }
                        } 
                    }
                ?>
                <form id="form-add-user" data-parsley-validate action="" method="POST">
                    <input id="avatarForm" type="hidden" name="photo" value="">
                    <legend>General Information</legend>
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <input class="form-control" placeholder="Username" type="text" name="username" data-parsley-minlength="4" data-parsley-maxlength="20" required>
                    </div>
                    <div id="pwd-container" class="form-group">
                        <label class="control-label">Password</label>
                        <input id="passwordField" class="form-control password-indicator-visible" placeholder="Password" type="password" name="password" data-parsley-minlength="6" data-parsley-maxlength="20">
                        <div class="pwstrength-viewport-progress m-t-15"></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input class="form-control" placeholder="Email" type="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Display Name</label>
                        <input class="form-control" placeholder="Display Name" type="text" name="displayname" data-parsley-minlength="4" data-parsley-maxlength="20" required>
                    </div>
                    <?php
                        if($admin_level == 1) {
                    ?>
                    <div class="form-group">
                        <label class="control-label">User Level</label>
                        <select class="form-control" name="level" required>
                            <option value="">Select User Level</option>
                            <option value="1">Administrator</option>
                            <option value="2">Editor</option>
                        </select>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="form-group">
                        <label class="control-label">About You</label>
                        <textarea id="quotestext" class="form-control" placeholder="Write here..." name="aboutyou" rows="3" data-parsley-maxlength="255"></textarea>
                    </div>

                    <legend>Social Media</legend>
                    <div class="form-group has-feedback">
                        <label class="control-label">Facebook</label>
                        <input class="form-control" placeholder="Facebook" type="text" name="facebook" data-parsley-minlength="4" data-parsley-maxlength="100" data-parsley-type="url">
                        <span class="fa fa-facebook form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label">Google+</label>
                        <input class="form-control" placeholder="Google+" type="text" name="googleplus" data-parsley-minlength="4" data-parsley-maxlength="100" data-parsley-type="url">
                        <span class="fa fa-google-plus form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label">Twitter</label>
                        <input class="form-control" placeholder="Twitter" type="text" name="twitter" data-parsley-minlength="4" data-parsley-maxlength="100" data-parsley-type="url">
                        <span class="fa fa-twitter form-control-feedback"></span>
                    </div>
            </div>
            <div class="panel-footer">
                <button id="button-add-user" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-white pull-right m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>'">Cancel</button>
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
            <?php require "users-avatar-upload.php" ?>
         </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var auto_refresh = setInterval(
        function () {
            var image_name = $('.avatar-view').find('img').attr('src');
            $('#avatarForm').attr('value', image_name);
        }, 500);

        $('#passwordField').hidePassword(true);

        var add_user;
        $("#form-add-user").submit(function(event){
            if (add_user) {
                add_user.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            add_user = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/user-add.php",
                type: "post",
                beforeSend: function(){ $("#button-add-user").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-user").attr('disabled','disabled');},
                data: serializedData
            });
            add_user.done(function (msg){
                if(msg == 'field-empty') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Please fill the required field",
                        text:"Can't add new user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'username-short') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username is too short.",
                        text:"Can't add new user. It should have 4 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'username-long') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username is too long.",
                        text:"Can't add new user. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-short') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too short.",
                        text:"Can't add new user. It should have 6 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'password-long') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Password is too long.",
                        text:"Can't add new user. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'displayname-short') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Display name is too short.",
                        text:"Can't add new user. It should have 4 characters or more Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'displayname-long') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Display name is too long.",
                        text:"Can't add new user. It should have 20 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'aboutyou-long') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! About is too long.",
                        text:"Can't add new user. It should have 255 characters or less Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'email-invalid') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Email is invalid.",
                        text:"Can't add new user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'fb-invalid') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Facebook link is invalid.",
                        text:"Can't add new user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'gp-invalid') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Google+ link is invalid.",
                        text:"Can't add new user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'tw-invalid') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Twitter link is invalid.",
                        text:"Can't add new user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'same-name') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Username or display name is already exist.",
                        text:"Can't add new user. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"New user has been added",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't add new user",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-add-user").removeAttr('disabled');
                    $("#button-add-user").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't add new user",
                        text:msg,
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            add_user.always(function () {
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

    