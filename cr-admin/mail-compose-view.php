<?php
    $class_mail   = new Mail($pdo);
    $compose_to   = $class_mail->compose_to($admin_id_session);
    $total_inbox  = $class_mail->count_inbox($admin_id_session);
    $total_sent   = $class_mail->count_sent($admin_id_session);
    $total_trash  = $class_mail->count_trash($admin_id_session);
    if(isset($action)) {
        $reply_inbox = $class_mail->reply_inbox($action);
    }
?>
<div class="vertical-box">
    <!-- begin vertical-box-column -->
    <div class="vertical-box-column width-250">
        <!-- begin wrapper -->
        <div class="wrapper bg-silver text-center">
            <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'compose')) ?>" class="btn btn-success p-l-40 p-r-40 btn-sm">
                Compose
            </a>
        </div>
        <!-- end wrapper -->
        <!-- begin wrapper -->
        <div class="wrapper">
            <p><b>FOLDERS</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm">
                <li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <?php if($total_inbox != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_inbox ?></span><?php } ?> <?php if($total_inbox_unread != 0) { ?><span class="badge badge-success badge-square pull-right"><?php echo $total_inbox_unread ?> unread</span><?php } ?></a></li>
                <li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'sent')) ?>"><i class="fa fa-send fa-fw m-r-5"></i> Sent <?php if($total_sent != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_sent ?></span><?php } ?></a></li>
                <li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'trash')) ?>"><i class="fa fa-trash fa-fw m-r-5"></i> Trash <?php if($total_trash != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_trash ?></span><?php } ?></a></li>
            </ul>
            <p><b>LABEL</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Administrator</a></li>
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Editor</a></li>
            </ul>
        </div>
        <!-- end wrapper -->
    </div>
    <!-- end vertical-box-column -->
    <!-- begin vertical-box-column -->
    <div class="vertical-box-column">
        <!-- begin wrapper -->
        <div class="wrapper bg-silver-lighter">
            <!-- begin btn-toolbar -->
            <div class="btn-toolbar">
                <div class="btn-group pull-right">
                    <a onclick="history.go(-1);" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <!-- end btn-toolbar -->
        </div>
        <!-- end wrapper -->
        <!-- begin wrapper -->
        <div class="wrapper">
            <div class="p-30 bg-white">
                <!-- begin email form -->
                <form id="form-compose-mail" data-parsley-validate action="" method="POST">
                    <!-- begin email to -->
                    <label class="control-label">To:</label>
                    <div class="m-b-15">
                        <select id="selectuser" class="form-control selectpicker" data-size="10" data-live-search="true" data-style="btn-white" name="to" required>
                            <option value="">Select User</option>
                            <?php
                                foreach ($compose_to as $data) {
                                    if($data->cr_adminLevel == 1) {
                                        $lev = "success";
                                    }
                                    elseif($data->cr_adminLevel == 2) {
                                        $lev = "warning";
                                    }
                            ?>
                            <option value="<?php echo $data->cr_adminID ?>" data-color="<?php echo $lev ?>" <?php if($reply_inbox->cr_adminID == $data->cr_adminID) { ?> selected <?php } ?>><?php echo ucwords($data->cr_adminDisplayName)  ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <!-- end email to -->
                    <!-- begin email subject -->
                    <label class="control-label">Subject:</label>
                    <div class="m-b-15">
                        <input type="text" class="form-control" name="subject" placeholder="Subject" <?php if(isset($action)) { ?> value="Re: <?php echo $reply_inbox->cr_inboxSubject ?>" <?php } ?>/>
                    </div>
                    <!-- end email subject -->
                    <!-- begin email content -->
                    <label class="control-label">Content:</label>
                    <div class="m-b-15">
                        <textarea class="textarea form-control" id="simple_editor" placeholder="Enter text ..." rows="12" name="content" required><?php
                            if(isset($action)) { 
                        ?>
                            <p><strong>On <?php echo date($function_date_format->cr_settingValue, strtotime($reply_inbox->cr_inboxDate)); ?> at <?php echo date($function_time_format->cr_settingValue, strtotime($reply_inbox->cr_inboxDate)); echo " ".ucwords($reply_inbox->cr_adminDisplayName) ?>  wrote:</strong></p>
                            <blockquote>
                            <?php
                                echo $reply_inbox->cr_inboxContent;
                            ?>
                            </blockquote>
                        <?php } ?></textarea>
                    </div>
                    <!-- end email content -->
                    <button id="button-compose-mail" type="submit" class="btn btn-success p-l-40 p-r-40"><i class="fa fa-paper-plane"></i> Send</button>
                </form>
                <!-- end email form -->
            </div>
        </div>
        <!-- end wrapper -->
    </div>
    <!-- end vertical-box-column -->
</div>

<script>
    $(document).ready(function() {
        var auto_refresh = setInterval(
        function () {
            var asd = $('#selectuser option:selected').data("color");
            $('#selectuser').attr('data-style', "btn-"+asd);
            $('button.selectpicker').addClass("btn-"+asd);
        }, 500);

        CKEDITOR.replace( 'simple_editor', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        var compose_mail;
        $("#form-compose-mail").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (compose_mail) {
                    compose_mail.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                compose_mail = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/mail-compose.php",
                    type: "post",
                    beforeSend: function(){ $("#button-compose-mail").html('<i class="fa fa-spinner fa-pulse"></i> Sending...');$("#button-compose-mail").attr('disabled','disabled');},
                    data: serializedData
                });
                compose_mail.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-compose-mail").removeAttr('disabled');
                        $("#button-compose-mail").html('<i class="fa fa-paper-plane"></i> Send');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't send mail. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Mail has been sent.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-compose-mail").removeAttr('disabled');
                        $("#button-compose-mail").html('<i class="fa fa-paper-plane"></i> Send');
                        $.gritter.add({
                            title:"Failed! Can't send mail",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-compose-mail").removeAttr('disabled');
                        $("#button-compose-mail").html('<i class="fa fa-paper-plane"></i> Send');
                        $.gritter.add({
                            title:"Error! Can't send mail",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                compose_mail.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>