<?php
    $class_blog          = new Blog($pdo);
    $class_blog_category = new Blog_Category($pdo);
    $function_view_blog_category = $class_blog_category->view_blog_category($action);
    $function_edit_blog  = $class_blog->edit_blog($extra);
    $blog_tags = $class_blog->all_blog_tags();
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Write Here</h4>
            </div>
            <div class="panel-toolbar">
                <a href="<?php echo $router->generate('id-link', array('page' => $action, 'id_link' => $function_edit_blog->cr_blogLink)) ?>" class="btn btn-success btn-block hidden-sm hidden-md hidden-lg" target="_blank"><i class="fa fa-globe"></i> View Post</a>
                <a href="<?php echo $router->generate('id-link', array('page' => $action, 'id_link' => $function_edit_blog->cr_blogLink)) ?>" class="btn btn-success" target="_blank"><i class="fa fa-globe"></i> View Post</a>
            </div>
            <div class="panel-body">
                <form id="form-edit-post" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="blogtype" value="video">
                    <input type="hidden" name="blog_idh" value="<?php echo $extra ?>">
                    <legend>Post</legend>
                    <div class="form-group">
                        <label class="control-label">Post Title</label>
                        <input class="form-control" placeholder="Post Title" type="text" name="title" value="<?php echo $function_edit_blog->cr_blogTitle ?>" data-parsley-minlength="4" data-parsley-maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category</label>
                        <select class="form-control" name="cat" required>
                            <option value="">Select Category</option>
                        <?php
                            foreach ($function_view_blog_category as $data) {
                        ?>
                            <option <?php if($function_edit_blog->cr_blogcategoryID==$data->cr_blogcategoryID) echo "selected" ?> value="<?php echo $data->cr_blogcategoryID ?>"><?php echo $data->cr_blogcategoryName ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">Select Status</option>
                            <option value="publish" <?php if($function_edit_blog->cr_blogStatus=="publish") echo "selected" ?>>Publish</option>
                            <option value="draft" <?php if($function_edit_blog->cr_blogStatus=="draft") echo "selected" ?>>Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tags (enter, space, tab, or comma after type, <strong>at least 4 letters</strong>)</label>
                        <ul id="jquery-blog-tag" class="success">
                            <?php 
                                $explodetags = explode(', ', $function_edit_blog->cr_blogTags);
                                foreach ($explodetags as $arraytags) {
                                    echo '<li>'.$arraytags.'</li>';
                                }
                            ?>
                        </ul>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label">Youtube Embed Video Link <a href="#" data-target="#modal-tutorial-youtube" data-toggle="modal"><i class="fa fa-question-circle"></i></a></label>
                        <input class="form-control" placeholder="Youtube Embed Video Link" type="text" name="link" value="<?php echo $function_edit_blog->cr_blogFeatured ?>" data-parsley-minlength="4" data-parsley-maxlength="500" data-parsley-type="url" required>
                        <span class="fa fa-youtube form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Content</label>
                        <textarea name="editorpost" required><?php echo $function_edit_blog->cr_blogContent ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Comment</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="comment" value="on" <?php if($function_edit_blog->cr_blogComment=="on") echo "checked"; else echo ""; ?>> Allow Comment
                            </label>
                        </div>
                    </div>
                    <legend>SEO</legend>
                    <div class="form-group">
                        <label class="control-label">Meta Keywords</label>
                        <input class="form-control" placeholder="Meta Keywords" type="text" name="metakey" value="<?php echo $function_edit_blog->cr_blogMetaKeywords ?>" data-parsley-maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Meta Description</label>
                        <textarea class="form-control" rows="5" placeholder="Meta Description" name="metadesc" data-parsley-maxlength="155"><?php echo $function_edit_blog->cr_blogMetaDescription ?></textarea>
                    </div>
            </div>
            <div class="panel-footer">
                    <button id="button-edit-post" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-white button-cancel pull-right m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>'">Cancel</button>
                </form>
            </div>
         </div>
    </div>
</div>

<div class="modal fade" id="modal-tutorial-youtube">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tutorial</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    Creatify use <a href="https://youtube.com/" target="_blank">Youtube</a> for embeded video. Just paste the url inside src attribute.
                </div>
                <img class="img-responsive" src="" alt="Tutorial Get Youtube Embed Video Link" width="100%">
            </div>
        </div>
    </div>
</div>

<link href="<?php echo MADMINURL ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script>
    $(document).ready(function() {
        $('#modal-tutorial-youtube').on('show.bs.modal', function(e) {
            $(this).find('img').attr('src','<?php echo MADMINURL.'assets/img/tutorial/totorial_get_youtube_embed_video_link.gif' ?>');
        });

        $('#modal-tutorial-youtube').on('hidden.bs.modal', function(e) {
            $(this).find('img').attr('src','');
        });

        CKEDITOR.replace( 'editorpost', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        var edit_post;
        $("#form-edit-post").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_post) {
                    edit_post.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                edit_post = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/blog-post-video-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-post").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-post").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_post.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't update post. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't update post. Post title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Post title is too long",
                            text:"Can't update post. It should have 200 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Post title is too short",
                            text:"Can't update post. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'no-youtube') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Invalid Youtube link",
                            text:"Can't update post. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'metakey-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Keywords is too long",
                            text:"Can't update post. It should have 255 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'metadesc-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Description is too long",
                            text:"Can't update post. It should have 155 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Post has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update post",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-post").removeAttr('disabled');
                        $("#button-edit-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update post",
                            text:msg,
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_post.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>