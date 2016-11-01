<?php
    $function_edit_page_general = $class_page->edit_page_general($extra);
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
                <h4 class="panel-title">Content</h4>
            </div>
            <div class="panel-body">
                <form id="form-edit-page" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="link" value="<?php echo $action ?>">
                    <input type="hidden" name="page_column" value="<?php echo $page_column ?>">
                    <input type="hidden" name="pagegeneral_idh" value="<?php echo $extra ?>">
                    <input id="mediafile" type="hidden" name="photo" value="<?php echo $function_edit_page_general->cr_generalFeaturedImage ?>">
                    <legend>Page Content</legend>
                    <!-- Nav language tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                        <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                    </ul>

                    <!-- Tab language panes -->
                    <div class="tab-content m-b-0">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                            <div class="form-group">
                                <label class="control-label">Page Title</label>
                                <input class="form-control" placeholder="Page Title" type="text" name="title" value="<?php echo $function_edit_page_general->cr_generalTitle ?>" data-parsley-maxlength="100" required>
                            </div>
                            <?php 
                                if($page_column == 1) {
                            ?>
                            <div class="form-group">
                                <label class="control-label">Column 1</label>
                                <textarea name="editor1" rows="30"><?php echo $function_edit_page_general->cr_generalColumn1 ?></textarea>
                            </div>
                            <?php
                                }
                                elseif($page_column == 2) {
                            ?>
                            <div class="form-group">
                                <label class="control-label">Column 1</label>
                                <textarea name="editor1" rows="30"><?php echo $function_edit_page_general->cr_generalColumn1 ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Column 2</label>
                                <textarea name="editor2" rows="30"><?php echo $function_edit_page_general->cr_generalColumn2 ?></textarea>
                            </div>

                            <?php
                                }
                                elseif($page_column == 3) {
                            ?>
                            <div class="form-group">
                                <label class="control-label">Column 1</label>
                                <textarea id="editor1" name="editor1" rows="30"><?php echo $function_edit_page_general->cr_generalColumn1 ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Column 2</label>
                                <textarea id="editor2" name="editor2" rows="30"><?php echo $function_edit_page_general->cr_generalColumn2 ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Column 3</label>
                                <textarea name="editor3" rows="30"><?php echo $function_edit_page_general->cr_generalColumn3 ?></textarea>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_id">
                            <div class="form-group">
                                <label class="control-label">Page Title</label>
                                <input class="form-control" placeholder="Page Title" type="text" name="title_id" value="<?php echo $function_edit_page_general->cr_generalTitle_id ?>" data-parsley-maxlength="100" required>
                            </div>
                            <?php 
                                if($page_column == 1) {
                            ?>
                            <div class="form-group">
                                <label class="control-label">Column 1</label>
                                <textarea name="editor1_id" rows="30"><?php echo $function_edit_page_general->cr_generalColumn1_id ?></textarea>
                            </div>
                            <?php
                                }
                                elseif($page_column == 2) {
                            ?>
                            <div class="form-group">
                                <label class="control-label">Column 1</label>
                                <textarea name="editor1_id" rows="30"><?php echo $function_edit_page_general->cr_generalColumn1_id ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Column 2</label>
                                <textarea name="editor2_id" rows="30"><?php echo $function_edit_page_general->cr_generalColumn2_id ?></textarea>
                            </div>

                            <?php
                                }
                                elseif($page_column == 3) {
                            ?>
                            <div class="form-group">
                                <label class="control-label">Column 1</label>
                                <textarea id="editor1_id" name="editor1" rows="30"><?php echo $function_edit_page_general->cr_generalColumn1_id ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Column 2</label>
                                <textarea id="editor2_id" name="editor2" rows="30"><?php echo $function_edit_page_general->cr_generalColumn2_id ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Column 3</label>
                                <textarea name="editor3_id" rows="30"><?php echo $function_edit_page_general->cr_generalColumn3_id ?></textarea>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>

                    <legend>SEO</legend>
                    <div class="form-group">
                        <label class="control-label">Meta Keywords</label>
                        <input class="form-control" placeholder="Page Title" type="text" name="metakeywords" value="<?php echo $function_edit_page_general->cr_generalMetaKeywords ?>" data-parsley-maxlength="255">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Meta Description</label>
                        <textarea class="form-control" name="metadesc" rows="5" data-parsley-maxlength="155"><?php echo $function_edit_page_general->cr_generalMetaDescription ?></textarea>
                    </div>
            </div>
            <div class="panel-footer">
                    <button id="button-edit-page" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>'">Cancel</button>
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
                <h4 class="panel-title">Featured Image</h4>
            </div>
            <div class="panel-body">
                <div id="used-image-container">
                    <?php 
                        if($function_edit_page_general->cr_generalFeaturedImage != '') {
                    ?>
                    <img style="width: 100%" class="m-b-15" src="<?php echo MURL."cr-editor/images/".$function_edit_page_general->cr_generalFeaturedImage ?>">
                    <?php } ?>
                </div>
                <form action="<?php echo MADMINURL ?>ajax/media-select-upload.php" class="dropzone" id="myAwesomeDropzone">
                    <div class="dz-message text-center">
                        <h2><i class="fa fa-cloud-upload fa-3x"></i></h2>
                        <h3>Drag and Drop Files</h3>
                    </div>
                </form>
                <p class="fancy m-t-20"><span>OR</span></p>
                <button id="browse-media-button" data-target="#browse-media-dialog" data-toggle="modal" class="btn btn-success btn-block m-t-15"><i class="fa fa-image"></i> Browse Media</button>
            </div>
         </div>
    </div>
</div>
<?php
    $class_media = new Media($pdo);
    $function_view_media_data = $class_media->view_media_data();
?>
<div class="modal fade" id="browse-media-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Browse Media</h4>
            </div>
            <div class="modal-body">
                <div id="error-handling"></div>
                <div class="row">
                    <div class="col-md-9">
                    <form id="form-media-browse" action="" method="POST">
                        <div class="form-group">
                        <?php
                            $i = 1;
                            foreach($function_view_media_data as $data) {
                        ?>
                            <div class="col-md-3">   
                                <label class="rwi">
                                    <input class="" type="radio" name="mediaselect" value="<?php echo $data->cr_mediaName ?>" data-title="<?php if(empty($data->cr_mediaTitle)) echo 'No title'; else echo $data->cr_mediaTitle ?>" data-desc="<?php if(empty($data->cr_mediaDesc)) echo 'No description'; else echo $data->cr_mediaDesc ?>" <?php if($i == 1) echo 'checked="checked"' ?>>
                                    <div class="nailthumb-container modal-square-thumb">
                                        <img style="width:100%" src="<?php echo MURL."cr-editor/images/".$data->cr_mediaName ?>">
                                    </div>
                                </label>
                            </div>
                        <?php
                                $i++;
                            }
                        ?>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-3">
                        <?php
                            $function_view_latest_media_data = $class_media->view_latest_media_data();
                        ?>
                        <legend>Media Information</legend>
                        <dl>
                            <dt>Title</dt>
                            <dd id="media-title-info"><?php if(empty($function_view_latest_media_data->cr_mediaTitle)) echo 'No title'; else echo $function_view_latest_media_data->cr_mediaTitle ?></dd>
                            <dt class="m-t-10">Description</dt>
                            <dd id="media-desc-info"><?php if(empty($function_view_latest_media_data->cr_mediaDesc)) echo 'No title'; else echo $function_view_latest_media_data->cr_mediaDesc ?></dd>
                        </dl>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-media-select" type="button" class="btn btn-success">Select</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Failed to upload the image. Please try again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo MADMINURL; ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL; ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#browse-media-dialog').on('show.bs.modal', function(e) {
            var thumbnail_width = $('.modal-square-thumb').width();
            $('.modal-square-thumb').css({'height':thumbnail_width+'px'});
            $('.nailthumb-container').nailthumb();
        });
        Dropzone.options.myAwesomeDropzone = {
          maxFilesize: 5, // MB
          maxFiles: 1,
          acceptedFiles: "image/*",
          success: function( file, response ){
            $('#mediafile').val(response);
            $('#used-image').attr('src','<?php echo MURL."/cr-editor/images/" ?>'+response);
            $('#browse-media-button').attr('disabled','disabled');
            $('#used-image-container').slideUp(1000);
          }
        };
        $("#button-media-select").click(function(){
            var media = $('input[name=mediaselect]:checked').val();
            $("#button-media-select").attr('disabled','disabled');
            $("#button-media-select").html('<i class="fa fa-spinner fa-pulse"></i>');
            setTimeout(function() {
                $('#browse-media-dialog').modal('hide');
                $("#button-media-select").removeAttr('disabled');
                $("#button-media-select").html('Select');
            }, 2000);
            $('#used-image-container').html('<img style="width: 100%" class="m-b-15" src="<?php echo MURL."cr-editor/images/" ?>'+media+'">');
            $('#mediafile').attr('value', media);
        });
        <?php 
            if($page_column == 1) {
        ?>
        CKEDITOR.replace( 'editor1', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        CKEDITOR.replace( 'editor1_id', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });
        <?php
            }
            elseif($page_column == 2) {
                for($i=1;$i<=2;$i++) {
        ?>
        CKEDITOR.replace( 'editor<?php echo $i ?>', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        CKEDITOR.replace( 'editor<?php echo $i ?>_id', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });
        <?php
                }
            }
            elseif($page_column == 3) {
                for($i=1;$i<=3;$i++) {
        ?>
        CKEDITOR.replace( 'editor<?php echo $i ?>', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        CKEDITOR.replace( 'editor<?php echo $i ?>_id', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });
        <?php
                }
            }
        ?>

        var edit_page;
        $("#form-edit-page").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_page) {
                    edit_page.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                edit_page = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/page-general-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-page").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-page").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled')},
                    data: serializedData
                });
                edit_page.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-page").removeAttr('disabled');
                        $("#button-edit-page").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't update page. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-page").removeAttr('disabled');
                        $("#button-edit-page").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Page title is too long",
                            text:"Can't update page. It should have 100 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Page has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-page").removeAttr('disabled');
                        $("#button-edit-page").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update page",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-page").removeAttr('disabled');
                        $("#button-edit-page").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update page",
                            text:msg,
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_page.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>