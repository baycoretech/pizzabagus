<?php
    $class_blog_comment = new Blog_Comment($pdo);
    $function_view_comments = $class_blog_comment->view_comments($extra);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="ui-media-object-4">
            <div class="panel-heading">
                 <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Comments</h4>
            </div>
            <?php
                if($function_view_comments == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    No comment found.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <ul class="media-list media-list-with-divider">
                <?php
                    $i=1;
                    foreach ($function_view_comments as $data) {
                        $comment_status = $data->cr_commentStatus;
                        $comment_date   = date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($data->cr_commentDate));
                        if($data->cr_adminID != NULL && $comment_status == 3) {
                            $comment_admin = $class_administrator->profile_administrator($data->cr_adminID);
                        }
                ?>
                    <li class="media media-sm">
                        <a class="media-left" href="javascript:;">
                            <img src="" class="media-object rounded-corner no-admin-photo" data-font-size="36" data-width="50" data-height="50" data-name="<?php echo $data->cr_commentName ?>" alt="<?php echo $data->cr_commentName ?>">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo ucwords($data->cr_commentName) ?></h4>
                            <p><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $data->cr_commentEmail ?>"><?php echo $data->cr_commentEmail ?></a> <?php if($data->cr_commentWebsite == '' || empty($data->cr_commentWebsite)) { echo ''; } else { ?><i class="fa fa-globe m-l-15"></i> <?php echo $data->cr_commentWebsite; } ?> <i class="fa fa-calendar m-l-15"></i> <?php echo $comment_date ?></p>
                            <p>
                                <?php echo $data->cr_commentContent ?>
                            </p>

                            <p>
                                <?php
                                    if($comment_status != 3) { 
                                ?>
                                <button class="btn btn-sm btn-white m-r-5 m-t-5" data-toggle="modal" data-target="#modal-reply-comment" data-cid="<?php echo $data->cr_commentID ?>"><i class="fa fa-reply"></i> Reply</button>
                                <button id="<?php if($comment_status == 1) echo "approvebutton".$i; elseif($comment_status == 2) echo "unapprovebutton".$i ?>" class="btn btn-sm btn-<?php if($comment_status == 1) echo "success"; elseif($comment_status == 2) echo "inverse" ?> m-r-5 m-t-5" data-cid="<?php echo $data->cr_commentID ?>"><?php if($comment_status == 1) echo "Approve"; elseif($comment_status == 2) echo "Unapprove" ?></button>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('#approvebutton<?php echo $i ?>').click(function() {
                                            var commentid  = $("#approvebutton<?php echo $i ?>").data("cid");
                                            var action     = 'approve';
                                            var dataString = 'comment_id='+commentid+'&action='+action;
                                            $.ajax({
                                                type: "POST",
                                                url:  "<?php echo MADMINURL ?>ajax/blog-comment-status.php",
                                                data: dataString,
                                                cache: false,
                                                beforeSend: function(){ $("#approvebutton<?php echo $i ?>").html('<i class="fa fa-spinner fa-pulse"></i>');$("#approvebutton<?php echo $i ?>").attr('disabled','disabled');},
                                                success: function(data){
                                                    if(data == "true") {
                                                        window.location.reload();
                                                    }
                                                    else if(data == "false") {
                                                        $("#approvebutton<?php echo $i ?>").removeAttr('disabled');
                                                        alert("Failed!. Can't approve comment.");
                                                    }
                                                    else {
                                                        $("#approvebutton<?php echo $i ?>").removeAttr('disabled');
                                                        alert("Error!. Can't approve comment.");
                                                    }
                                                }
                                            });
                                            return false;
                                        });

                                        $('#unapprovebutton<?php echo $i ?>').click(function() {
                                            var commentid  = $("#unapprovebutton<?php echo $i ?>").data("cid");
                                            var action     = 'unapprove';
                                            var dataString = 'comment_id='+commentid+'&action='+action;
                                            $.ajax({
                                                type: "POST",
                                                url:  "<?php echo MADMINURL ?>ajax/blog-comment-status.php",
                                                data: dataString,
                                                cache: false,
                                                beforeSend: function(){ $("#unapprovebutton<?php echo $i ?>").html('<i class="fa fa-spinner fa-pulse"></i>');$("#unapprovebutton<?php echo $i ?>").attr('disabled','disabled');},
                                                success: function(data){
                                                    if(data == "true") {
                                                        window.location.reload();
                                                    }
                                                    else if(data == "false") {
                                                        $("#unapprovebutton<?php echo $i ?>").removeAttr('disabled');
                                                        alert("Failed!. Can't unapprove comment.");
                                                    }
                                                    else {
                                                        $("#unapprovebutton<?php echo $i ?>").removeAttr('disabled');
                                                        alert("Error!. Can't unapprove comment.");
                                                    }
                                                }
                                            });
                                            return false;
                                        });
                                    });
                                </script>        
                                <?php
                                    }
                                ?>
                                <button class="btn btn-sm btn-danger m-t-5" data-toggle="modal" data-target="#modal-delete-comment" data-cid="<?php echo $data->cr_commentID ?>" data-cname="<?php echo $data->cr_commentName ?>"><i class="fa fa-times"></i> Delete</button>
                            </p>
                            <?php
                                $function_view_comments_reply = $class_blog_comment->view_comments_reply($extra, $data->cr_commentID);
                                if($function_view_comments_reply != false) {
                                    foreach($function_view_comments_reply as $data) {
                                        $comment_reply_admin = $class_administrator->profile_administrator($data->cr_adminID);
                                        $comment_reply_date   = date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($data->cr_commentDate));


                            ?>
                            <hr>
                            <div class="media">
                                <a class="pull-left" href="javascript:;">
                                    <img src="<?php if($comment_reply_admin->cr_adminPhoto == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$comment_reply_admin->cr_adminPhoto ?>" class="media-object rounded-corner <?php if($comment_reply_admin->cr_adminPhoto == 'assets/img/no-pic.png' || $comment_reply_admin->cr_adminPhoto == '') echo 'no-admin-photo' ?>" data-font-size="36" data-width="50" data-height="50" data-name="<?php echo ucwords($comment_reply_admin->cr_adminDisplayName) ?>" alt="<?php echo ucwords($comment_reply_admin->cr_adminDisplayName) ?>">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $data->cr_commentName ?></h4>
                                    <p><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $comment_reply_admin->cr_adminEmail ?>"><?php echo $comment_reply_admin->cr_adminEmail ?></a> <i class="fa fa-calendar m-l-15"></i> <?php echo $comment_reply_date ?> <i class="fa fa-user m-l-15"></i> <?php if($comment_reply_admin->cr_adminLevel == '1') echo 'Administrator'; elseif($comment_reply_admin->cr_adminLevel == '2') echo 'Editor' ?></p>
                                    <p><?php echo $data->cr_commentContent ?></p>
                                    <p>
                                        <button class="btn btn-sm btn-danger m-t-5" data-toggle="modal" data-target="#modal-delete-comment" data-cid="<?php echo $data->cr_commentID ?>" data-cname="<?php echo $data->cr_commentName ?>"><i class="fa fa-times"></i> Delete</button>
                                    </p>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </li>
                <?php
                        $i++;
                    }
                ?>
                </ul>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-reply-comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Reply Comment</h4>
      </div>
        <div class="modal-body">
            <form id="form-reply-comment" data-parsley-validate action="" method="post">
                <input type="hidden" name="comment_id" value="">
                <input type="hidden" name="blog_id" value="<?php echo $extra ?>">
                <div class="form-group">
                    <label class="control-label">Your Reply</label>
                    <textarea class="form-control" placeholder="Write here..." name="content" rows="6" data-parsley-maxlength="1000" required></textarea>
                </div>

        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-reply-comment" type="submit" class="btn btn-success">Reply</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-delete-comment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
            <p>Are you sure want to delete comment from <span id="cname" class="add-caps"></span>?</p>
            <form id="form-delete-comment" action="" method="post">
                <input type="hidden" name="comment_id" value="">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-delete-comment" type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#replycontent').readmore({
          speed: 100,
          moreLink: '<a href="#" class="btn btn-sm btn-default"><i class="fa fa-angle-double-down"></i></a>',
          collapsedHeight: 50,
          lessLink: '<a href="#" class="btn btn-sm btn-default"><i class="fa fa-angle-double-up"></i></a>'
        });

        $('#modal-reply-comment').on('show.bs.modal', function(e) {
            $(this).find('input[name=comment_id]').attr('value', $(e.relatedTarget).data('cid'));
        });

        $('#modal-delete-comment').on('show.bs.modal', function(e) {
            $(this).find('input[name=comment_id]').attr('value', $(e.relatedTarget).data('cid'));
            $(this).find('#cname').html($(e.relatedTarget).data('cname'));
        });

        var reply_comment;
        $("#form-reply-comment").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (reply_comment) {
                    reply_comment.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                reply_comment = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/blog-comment-reply.php",
                    type: "post",
                    beforeSend: function(){ $("#button-reply-comment").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-reply-comment").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled')},
                    data: serializedData
                });
                reply_comment.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-reply-comment").removeAttr('disabled');
                        $("#button-reply-comment").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't reply comment. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reply-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-reply-comment").removeAttr('disabled');
                        $("#button-reply-comment").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Your reply is too long",
                            text:"Can't reply comment. It should have 1000 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Comment has been replied.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-reply-comment").removeAttr('disabled');
                        $("#button-reply-comment").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't reply comment",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-reply-comment").removeAttr('disabled');
                        $("#button-reply-comment").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't reply comment",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                reply_comment.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_comment;
        $("#form-delete-comment").submit(function(event){
            if (delete_comment) {
                delete_comment.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var comment_name = $("#modal-delete-comment").find("#cname").html();
            var serializedData = $form.serialize();
            delete_comment = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/blog-comment-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-comment").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-comment").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_comment.done(function (msg){
                if(msg == 'comment-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-comment").removeAttr('disabled');
                    $("#button-delete-comment").html('Delete');
                    $.gritter.add({
                        title:"Failed! Comment is required",
                        text:"Can't delete comment from "+comment_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Comment from "+comment_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-comment').modal('hide');
                        window.location.reload();
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-comment").removeAttr('disabled');
                    $("#button-delete-comment").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete comment from "+comment_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-comment").removeAttr('disabled');
                    $("#button-delete-comment").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete comment from "+comment_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_comment.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
    });
</script>