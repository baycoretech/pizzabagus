<?php
    $class_message  = new Message($pdo);
    $function_count_inbox  = $class_message->count_inbox();
    $function_count_trash  = $class_message->count_trash();
    if($section == "message") {
        $function_detail_message = $class_message->view_detail_inbox($action);
        $update_message_to_read  = $class_message->update_message_to_read($action);
    }
    elseif($page == "messagetrash") {
        $function_detail_message = $class_message->view_detail_trash($action);
    }
    $function_count_inbox_unread = $class_message->count_inbox_unread();
?>
<div class="vertical-box">
    <!-- begin vertical-box-column -->
    <div class="vertical-box-column width-250">
        <!-- begin wrapper -->
        <div class="wrapper">
            <p><b>FOLDERS</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm">
                <li <?php if($page == "message") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'message')) ?>"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <?php if($function_count_inbox != 0) { ?><span class="badge badge-square pull-right"><?php echo $function_count_inbox ?></span><?php } ?> <?php if($function_count_inbox_unread != 0) { ?><span class="badge badge-success badge-square pull-right"><?php echo $function_count_inbox_unread ?> unread</span><?php } ?></a></li>
                <li <?php if($page=="messagetrash") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'messagetrash')) ?>"><i class="fa fa-trash fa-fw m-r-5"></i> Trash <?php if($function_count_trash != 0) { ?><span class="badge badge-square pull-right"><?php echo $function_count_trash ?></span><?php } ?></a></li>
            </ul>
            <p><b>LABEL</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Read</a></li>
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Unread</a></li>
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
                if($page != "messagetrash") {
            ?>
            <div class="btn-group m-r-5">
                <button type="button" class="btn btn-white btn-sm" onclick="location.href='mailto:<?php echo $function_detail_message->cr_messageEmail; ?>'"><i class="fa fa-reply"></i></button>
            </div>
            <?php
                }
            ?>
            <?php
                if($page != "messagetrash") {
            ?>
            <div class="btn-group m-r-5">
                <a class="btn btn-white btn-sm p-l-20 p-r-20" data-target="#modal-trash" data-toggle="modal" data-hapus="<?php echo $function_detail_message->cr_messageID ?>"><i class="fa fa-trash"></i></a>
            </div>
            <?php
                }
            ?>
            <div class="pull-right">
                <div class="btn-group m-l-5">
                    <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => $page)) ?>" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
                </div>
            </div>
        </div>
        <!-- end wrapper -->
        <!-- begin wrapper -->
        <div class="wrapper" style="min-height: 350px;">
            <h4 class="m-b-15 m-t-0 p-b-10 underline"><?php echo ucwords($function_detail_message->cr_messageSubject) ?></h4>
            <ul class="media-list underline m-b-20 p-b-15">
                <li class="media media-sm clearfix">
                    <a class="pull-left">
                        <img class="media-object rounded-corner" alt="<?php echo $function_detail_message->cr_messageName."'s Photo" ?>" src="<?php echo MADMINURL."assets/img/no-pic.png" ?>" />
                    </a>
                    <div class="media-body">
                        <span class="email-from text-inverse f-w-600">
                            from <?php echo ucwords($function_detail_message->cr_messageName); ?>
                            
                        </span><span class="text-muted m-l-5"><i class="fa fa-clock-o fa-fw"></i> <?php echo date($function_date_format->cr_settingValue." ".$function_time_format->cr_settingValue, strtotime($function_detail_message->cr_messageDate)); ?></span><br>
                        <span class="email-to">
                            Email: <a href="mailto:<?php echo $function_detail_message->cr_messageEmail; ?>"><?php echo $function_detail_message->cr_messageEmail; ?></a>
                        </span>
                    </div>
                </li>
			</ul>
            <?php echo $function_detail_message->cr_messageContent; ?>
        </div>
        <!-- end wrapper -->
        <!-- begin wrapper -->
        <div class="wrapper bg-silver-lighter text-right clearfix">
            <div class="btn-group m-l-5">
                <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => $page)) ?>" class="btn btn-white btn-sm"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <!-- end wrapper -->
    </div>
    <!-- end vertical-box-column -->
</div>
<!-- end vertical-box -->
<!-- #delete-dialog -->
<div class="modal fade" id="modal-trash">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to move this message to trash?</p>
                <form id="form-move-message" action="" method="post">
                    <input type="hidden" name="message_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-move-message" type="submit" class="btn btn-danger">Move</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#modal-trash').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
        });
        var move_message;
        $("#form-move-message").submit(function(event){
            if (move_message) {
                move_message.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            move_message = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/message-move.php",
                type: "post",
                beforeSend: function(){ $("#button-move-message").html('<i class="fa fa-spinner fa-pulse"></i> Moving...');$("#button-move-message").attr('disabled','disabled');},
                data: serializedData
            });
            move_message.done(function (msg){
                if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Message has been moved",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-trash').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $page)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-move-message").removeAttr('disabled');
                    $("#button-move-message").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't move message",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-move-message").removeAttr('disabled');
                    $("#button-move-message").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't move message",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            move_message.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>