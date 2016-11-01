<?php
    $class_mail  = new Mail($pdo);
    $total_inbox  = $class_mail->count_inbox($admin_id_session);
    $total_sent   = $class_mail->count_sent($admin_id_session);
    $total_trash  = $class_mail->count_trash($admin_id_session);
    if($section == "inbox") {
        $detail_inbox = $class_mail->view_detail_inbox($action);
        $update_message   = $class_mail->update_message_to_read($action);
    }
    elseif($section == "sent") {
        $detail_inbox = $class_mail->view_detail_sent($action);
    }
    elseif($section == "trash") {
        $detail_inbox = $class_mail->view_detail_trash($action);
    }
    $view_inbox_unread  = $class_mail->view_inbox_unread($admin_id_session);
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
                <li class="<?php if($section == "inbox") echo "active" ?>"><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <?php if($total_inbox != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_inbox ?></span><?php } ?> <?php if($total_inbox_unread != 0) { ?><span class="badge badge-success badge-square pull-right"><?php echo $total_inbox_unread ?> unread</span><?php } ?></a></li>
                <li class="<?php if($section == "sent") echo "active" ?>"><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'sent')) ?>"><i class="fa fa-send fa-fw m-r-5"></i> Sent <?php if($total_sent != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_sent ?></span><?php } ?></a></li>
                <li class="<?php if($section == "trash") echo "active" ?>"><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'trash')) ?>"><i class="fa fa-trash fa-fw m-r-5"></i> Trash <?php if($total_trash != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_trash ?></span><?php } ?></a></li>
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
    <div class="vertical-box-column bg-white">
        <!-- begin wrapper -->
        <div class="wrapper bg-silver-lighter clearfix">
            <?php
                if($section != "trash" && $section != "sent") {
            ?>
            <div class="btn-group m-r-5">
                <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'compose', 'action' => $detail_inbox->cr_inboxID)) ?>" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></a>
            </div>
            <?php
                }
            ?>
            <?php
                if($section != "trash" && $section != "sent") {
            ?>
            <div class="btn-group m-r-5">
                <a class="btn btn-white btn-sm p-l-20 p-r-20" data-target="#modal-to-trash" data-toggle="modal" data-delete="<?php echo $detail_inbox->cr_inboxID ?>"><i class="fa fa-trash"></i></a>
            </div>
            <?php
                }
            ?>
            <div class="pull-right">
                <div class="btn-group m-l-5">
                    <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
                </div>
            </div>
        </div>
        <!-- end wrapper -->
        <!-- begin wrapper -->
        <div class="wrapper" style="min-height: 350px; border-left: solid 5px #<?php if($detail_inbox->cr_adminLevel == 1) echo "00acac"; elseif($detail_inbox->cr_adminLevel == 2) echo "f59c1a"; ?>">
            <h4 class="m-b-15 m-t-0 p-b-10 underline"><?php echo ucwords($detail_inbox->cr_inboxSubject) ?></h4>
            <ul class="media-list underline m-b-20 p-b-15">
                <li class="media media-sm clearfix">
                    <a class="pull-left">
                        <img src="<?php if($detail_inbox->cr_adminPhoto == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$detail_inbox->cr_adminPhoto ?>" class="media-object rounded-corner <?php if($detail_inbox->cr_adminPhoto == 'assets/img/no-pic.png' || $detail_inbox->cr_adminPhoto == '') echo 'no-admin-photo' ?>" data-font-size="36" data-width="50" data-height="50" data-name="<?php echo ucwords($detail_inbox->cr_adminDisplayName) ?>" alt="<?php echo ucwords($detail_inbox->cr_adminDisplayName) ?>">

                    </a>
                    <div class="media-body">
                        <span class="email-from text-inverse f-w-600">
                            <?php if($section == 'sent') echo 'to '; elseif($section == 'inbox') echo 'from '; echo ucwords($detail_inbox->cr_adminDisplayName); ?>
                            
                        </span><span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> <?php echo date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($detail_inbox->cr_inboxDate)); ?></span><br>
                        <span class="email-to">
                            Email: <a href="mailto:<?php echo $detail_inbox->cr_adminEmail ?>"><?php echo $detail_inbox->cr_adminEmail ?></a>
                        </span>
                    </div>
                </li>
			</ul>
            <?php echo $detail_inbox->cr_inboxContent ?>
        </div>
        <!-- end wrapper -->
        <!-- begin wrapper -->
        <div class="wrapper bg-silver-lighter text-right clearfix">
            <div class="btn-group m-l-5">
                <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- end wrapper -->
    </div>
    <!-- end vertical-box-column -->
</div>
<!-- end vertical-box -->

<div class="modal fade" id="modal-to-trash">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to move this message to trash?</p>
                <form id="form-to-trash" action="" method="post">
                    <input type="hidden" name="message_id" value="">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-to-trash" type="submit" class="btn btn-danger">Move</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#modal-to-trash').on('show.bs.modal', function(e) {
            $(this).find('input[name=message_id]').attr('value', $(e.relatedTarget).data('delete'));
        });

        var delete_mail;
        $("#form-to-trash").submit(function(event){
            if (delete_mail) {
                delete_mail.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_mail = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/mail-trash.php",
                type: "post",
                beforeSend: function(){ $("#button-to-trash").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-to-trash").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_mail.done(function (msg){
                if(msg == 'mail-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-to-trash").removeAttr('disabled');
                    $("#button-to-trash").html('Move');
                    $.gritter.add({
                        title:"Failed! Mail is required",
                        text:"Can't delete message. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Message has been moved to trash",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>";

                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-to-trash").removeAttr('disabled');
                    $("#button-to-trash").html('Move');
                    $.gritter.add({
                        title:"Failed! Can't delete message",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-to-trash").removeAttr('disabled');
                    $("#button-to-trash").html('Move');
                    $.gritter.add({
                        title:"Error! Can't delete message",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_mail.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
    });
</script>