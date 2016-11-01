<?php
    $o_getSettings = new settings($pdo);
    $v_getSettingsSitekey  = $o_getSettings->viewSettingsreCaptchaSitekey();
    $v_getSettingsSecret   = $o_getSettings->viewSettingsreCaptchaSecret();
?>
<div class="row">
    <!-- begin col-8 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Feedback Form</h4>
            </div>
                <div id="" class="panel-body">
                    <div id="response"></div>
                    <?php
                        if(($v_getSettingsSitekey->cr_settingValue=="" || empty($v_getSettingsSitekey->cr_settingValue)) || ($v_getSettingsSecret->cr_settingValue=="" || empty($v_getSettingsSecret->cr_settingValue))) {
                    ?>
                    <div class="alert alert-danger fade in">You have not set up Google reCaptcha Sitekey and Secret Code. Click here to <a href="<?php echo MADMINURL."/settings" ?>"><strong>setup</strong></a></div>
                    <?php
                        }
                    ?>  
                    <form id="feedback-form" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="subject" value="<?php if(isset($_POST['upgrade'])) echo "Upgrade Creatify to Premium at ".MURL; else echo "Feedback for Creatify"; ?>">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input class="form-control" placeholder="Your Name" type="text" name="name" data-parsley-minlength="4" data-parsley-maxlength="100" required <?php if(($v_getSettingsSitekey->cr_settingValue=="" || empty($v_getSettingsSitekey->cr_settingValue)) || ($v_getSettingsSecret->cr_settingValue=="" || empty($v_getSettingsSecret->cr_settingValue))) { echo "disabled"; } ?>>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input class="form-control" placeholder="Your Email" type="email" name="email" data-parsley-type="email" required <?php if(($v_getSettingsSitekey->cr_settingValue=="" || empty($v_getSettingsSitekey->cr_settingValue)) || ($v_getSettingsSecret->cr_settingValue=="" || empty($v_getSettingsSecret->cr_settingValue))) { echo "disabled"; } ?>>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Feedback</label>
                            <textarea class="form-control" placeholder="Your Feedback" name="feedback" rows="6" required <?php if(($v_getSettingsSitekey->cr_settingValue=="" || empty($v_getSettingsSitekey->cr_settingValue)) || ($v_getSettingsSecret->cr_settingValue=="" || empty($v_getSettingsSecret->cr_settingValue))) { echo "disabled"; } ?>><?php
                                if(isset($_POST['upgrade'])) {
                                    $typecreatify = $_POST['type'];
                                    echo "Upgrade Creatify to Premium at ".MURL;
                                }
                            ?></textarea>
                        </div>
                         <?php 
                            if(($v_getSettingsSitekey->cr_settingValue=="" || empty($v_getSettingsSitekey->cr_settingValue)) || ($v_getSettingsSecret->cr_settingValue=="" || empty($v_getSettingsSecret->cr_settingValue))) { 
                                echo "";
                            }
                            else {
                        ?>
                        <div class="row">
                            <div class="col-sm-12" style="margin-top: 5px">
                                <div class="g-recaptcha" data-sitekey="<?php echo $v_getSettingsSitekey->cr_settingValue ?>"></div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                </div>
            <div class="panel-footer">
                <button id="submit-feedback" type="submit" class="btn btn-success m-r-5 m-b-5" <?php if(($v_getSettingsSitekey->cr_settingValue=="" || empty($v_getSettingsSitekey->cr_settingValue)) || ($v_getSettingsSecret->cr_settingValue=="" || empty($v_getSettingsSecret->cr_settingValue))) { echo "disabled"; } ?>><i class="fa fa-mail-forward"></i> Send Feedback</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
        $(document).ready(function() {
            $.gritter.add({
                title:"Creatify Tips",
                text:"We need your feedback to make Creatify more better.",
                image:"<?php echo MADMINURL.'/assets/img/cr.png'; ?>",
                sticky:true,
                time:""
            });

            var request;
                
            // Bind to the submit event of our form
            $("#feedback-form").submit(function(event){
                        
                // Abort any pending request
                if (request) {
                    request.abort();
                }
                // setup some local variables
                var $form = $(this);
                        
                // Serialize the data in the form
                var serializedData = $form.serialize();
                        
                // Let's disable the inputs for the duration of the Ajax request.
                // Note: we disable elements AFTER the form data has been serialized.
                // Disabled form elements will not be serialized.
                // $inputs.prop("disabled", true);
                        
                // Fire off the request to /form.php
                request = $.ajax({
                    url: "<?php echo MADMINURL ?>/feedback-send.php",
                    type: "post",
                    beforeSend: function(){ $("#submit-feedback").html('<i class="fa fa-spinner fa-pulse"></i> Sending feedback...');},
                    data: serializedData
                });
                        
                // Callback handler that will be called on success
                request.done(function (msg){
                        $("#response").html(msg);
                        $("#submit-feedback").html('<i class="fa fa-mail-forward"></i> Send Feedback');
                });
                        
                // Prevent default posting of form
                event.preventDefault();
            });
        });
    
</script>
    