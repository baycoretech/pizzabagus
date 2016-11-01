<?php
    $class_blog          = new Blog($pdo);
    $class_blog_category = new Blog_Category($pdo);
    $function_view_blog_category = $class_blog_category->view_blog_category($action);
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
            <div class="panel-body">
                <form id="form-add-post" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="blogtype" value="sound">
                    <legend>Post</legend>
                    <div class="form-group">
                        <label class="control-label">Post Title</label>
                        <input class="form-control" placeholder="Post Title" type="text" name="title" data-parsley-minlength="4" data-parsley-maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category</label>
                        <select class="form-control" name="cat" required>
                            <option value="">Select Category</option>
                        <?php
                            foreach ($function_view_blog_category as $data) {
                        ?>
                            <option value="<?php echo $data->cr_blogcategoryID ?>"><?php echo $data->cr_blogcategoryName ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">Select Status</option>
                            <option value="publish" selected="selected">Publish</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tags (enter, space, tab, or comma after type, <strong>at least 4 letters</strong>)</label>
                        <ul id="jquery-blog-tag" class="success">
                        </ul>
                    </div>
                    <div class="form-group has-feedback">
                        <label class="control-label">Soundcloud Embed Link <a href="#" data-target="#modal-tutorial-soundcloud" data-toggle="modal"><i class="fa fa-question-circle"></i></a></label>
                        <input class="form-control" placeholder="Soundcloud Embed Link" type="text" name="link" data-parsley-minlength="4" data-parsley-maxlength="500" data-parsley-type="url" required>
                        <span class="fa fa-soundcloud form-control-feedback"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Content</label>
                        <textarea name="editorpost" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Comment</label>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="comment" value="on" checked> Allow Comment
                            </label>
                        </div>
                    </div>
                    <legend>SEO</legend>
                    <div class="form-group">
                        <label class="control-label">Meta Keywords</label>
                        <input class="form-control" placeholder="Meta Keywords" type="text" name="metakey" data-parsley-maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Meta Description</label>
                        <textarea class="form-control" rows="5" placeholder="Meta Description" name="metadesc" data-parsley-maxlength="155"></textarea>
                    </div>
            </div>
            <div class="panel-footer">
                    <button id="button-add-post" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-white button-cancel pull-right m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>'">Cancel</button>
                </form>
            </div>
         </div>
    </div>
</div>

<div class="modal fade" id="modal-tutorial-soundcloud">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tutorial</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    Creatify use <a href="https://soundcloud.com/" target="_blank">Soundcloud</a> for embeded audio.
                </div>
                <img class="img-responsive" src="" alt="Tutorial Get Soundcloud Embed Link" width="100%">
            </div>
        </div>
    </div>
</div>

<link href="<?php echo MADMINURL; ?>/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script>
    $(document).ready(function() {
        $('#modal-tutorial-soundcloud').on('show.bs.modal', function(e) {
            $(this).find('img').attr('src','<?php echo MADMINURL.'assets/img/tutorial/totorial_get_soundcloud_embed_link.gif' ?>');
        });

        $('#modal-tutorial-soundcloud').on('hidden.bs.modal', function(e) {
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

        var add_post;
        $("#form-add-post").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_post) {
                    add_post.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                add_post = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/blog-post-sound-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-post").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-post").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_post.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't add new post. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new post. Post title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Post title is too long",
                            text:"Can't add new post. It should have 200 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Post title is too short",
                            text:"Can't add new post. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'no-soundcloud') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Invalid Soundcloud link",
                            text:"Can't add new post. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'metakey-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Keywords is too long",
                            text:"Can't add new post. It should have 255 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'metadesc-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Description is too long",
                            text:"Can't add new post. It should have 155 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New post has been added.",
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
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new post",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-post").removeAttr('disabled');
                        $("#button-add-post").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new post",
                            text:msg,
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                add_post.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>