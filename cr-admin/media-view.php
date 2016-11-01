<p>
	<button type="button" class="btn btn-success m-b-5" data-toggle="modal" data-target="#media-add-dialog">Add Media</button>
</p>
<?php
    $function_folder_name = $class_administrative->folder_name();
    if($function_folder_name == false) {
        $target_folder = $_SERVER['DOCUMENT_ROOT']."/cr-editor/images/";
    }
    else {
        $target_folder = $_SERVER['DOCUMENT_ROOT']."/".$function_folder_name."/cr-editor/images/";
    }
    $o_get_media = new Media($pdo);
    $v_get_media = $o_get_media->view_media_data();
    if($v_get_media == false) {
?>
<div class="alert alert-info fade in m-b-15">
    <strong>Empty!</strong>
    No media found.
    <span class="close" data-dismiss="alert">×</span>
</div>
<?php
    }
    else {
?>
<div class="superbox">
	<?php
        //$images = glob($target_folder."*.{jpg,jpeg,gif,png}", GLOB_BRACE);
        foreach($v_get_media as $media) {
            //$image_name = str_replace($target_folder,"",$image);
            $image_date = date($function_date_format->cr_settingValue." ".$function_time_format->cr_settingValue, strtotime($media->cr_mediaDate));
            $image_path = $target_folder.$media->cr_mediaName;
            list($image_width, $image_height) = getimagesize($image_path);
	?>
		<div class="superbox-list nailthumb-container square-thumb">
			<img src="<?php echo MURL."/cr-editor/images/".$media->cr_mediaName ?>" data-img="<?php echo MURL."/cr-editor/images/".$media->cr_mediaName ?>" data-width="<?php echo $image_width ?>" data-height="<?php echo $image_height ?>" alt="<?php echo $media->cr_mediaName ?>" title="<?php echo $media->cr_mediaName ?>" data-mediaid="<?php echo $media->cr_mediaID ?>" data-title="<?php if($media->cr_mediaTitle == '') echo 'No Title'; else echo $media->cr_mediaTitle ?>" data-desc="<?php if($media->cr_mediaDesc == '') echo 'No Description'; else echo $media->cr_mediaDesc ?>" data-imagepath="<?php echo MURL."/cr-editor/images/".$media->cr_mediaName ?>" data-mediadate="<?php echo $image_date ?>" data-mediaauthor="<?php echo ucwords($media->cr_adminDisplayName) ?>" class="superbox-img"/>
		</div>
	<?php
        }
	?>	
</div>
<?php
    }
?>
<!-- end superbox -->
<div class="modal fade" id="media-add-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div id="error-handling"></div>
                <form action="<?php echo MADMINURL ?>ajax/media-upload.php" class="dropzone" id="myAwesomeDropzone" style="">
                    <div class="dz-message text-center">
                        <h2><i class="fa fa-cloud-upload fa-5x"></i></h2>
                        <h3>Drag and Drop Files</h3>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    if($v_get_media != false) {
        foreach($v_get_media as $media) {
?>
        <div class="modal fade" id="media-edit-dialog<?php echo $media->cr_mediaID ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Edit Media</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <img class="img-responsive" style="width: 100%" src="<?php echo MURL."/cr-editor/images/".$media->cr_mediaName ?>">
                            </div>
                            <div class="col-md-4">
                                <form id="form-edit-media<?php echo $media->cr_mediaID ?>" data-parsley-validate action="" method="post">
                                    <input type="hidden" name="media_id" value="<?php echo $media->cr_mediaID ?>">
                                    <legend>Media Information</legend>
                                    <div class="form-group">
                                        <label class="control-label">Title</label>
                                        <input class="form-control" placeholder="Title" type="text" name="media_title" value="<?php echo $media->cr_mediaTitle ?>" data-parsley-maxlength="255">
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label">Description</label>
                                        <textarea class="form-control" placeholder="Description" name="media_desc" rows="5" data-parsley-maxlength="750"><?php echo $media->cr_mediaDesc ?></textarea>
                                    </div>  
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button id="button-edit-media<?php echo $media->cr_mediaID ?>" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="media-delete-dialog<?php echo $media->cr_mediaID ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Alert</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete <?php echo $media->cr_mediaName ?>?</p>
                        <?php
                        ?>
                        <form id="form-delete-media<?php echo $media->cr_mediaID ?>" action="" method="post">
                            <input type="hidden" name="media_id" value="<?php echo $media->cr_mediaID ?>">
                            <input type="hidden" name="media_name" value="<?php echo $media->cr_mediaName ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                        <button id="button-delete-media<?php echo $media->cr_mediaID ?>" type="submit" class="btn btn-danger" name="hapus">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php
        }
    }
?>
<link href="<?php echo MADMINURL; ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL; ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        var thumbnail_width = $('.square-thumb').width();
        $('.square-thumb').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();
        Dropzone.options.myAwesomeDropzone = {
            maxFilesize: 5, // MB
            maxFiles: 20,
            acceptedFiles: "image/*",
            success: function( file, response ){
                if(response == 'true') {
                    $('#error-handling').html('<div class="alert alert-info fade in"><p><strong>Success!</strong> This page will now refresh.</p></div> ');
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'media')) ?>";
                    }, 2000);
                }
                else if(response == 'false') {
                    $('#error-handling').html('<div class="alert alert-warning fade in"><p><strong>Failed!</strong> Upload files failed. Please try again.</p></div>');
                }
                else {
                    $('#error-handling').html('<div class="alert alert-danger fade in"><p><strong>Error!</strong> There is an error with files upload system. Please try again.</p></div>');
                }
            }
        };
    <?php
        if($v_get_media != false) {
            foreach($v_get_media as $media) {
    ?>
                var update_media_<?php echo $media->cr_mediaID ?>;    
                $("#form-edit-media<?php echo $media->cr_mediaID ?>").submit(function(event){
                    if (update_media_<?php echo $media->cr_mediaID ?>) {
                         update_media_<?php echo $media->cr_mediaID ?>.abort();
                    }
                    var $form = $(this);
                    var $inputs = $form.find("input, button");
                    var serializedData = $form.serialize();
                    update_media_<?php echo $media->cr_mediaID ?> = $.ajax({
                        url: "<?php echo MADMINURL ?>ajax/media-update.php",
                        type: "post",
                        beforeSend: function(){ $("#button-edit-media<?php echo $media->cr_mediaID ?>").html('<i class="fa fa-spinner fa-pulse"></i> Saving...'); $("#button-edit-media<?php echo $media->cr_mediaID ?>").attr('disabled','disabled');},
                        data: serializedData
                    });
                    update_media_<?php echo $media->cr_mediaID ?>.done(function (msg){
                        if(msg == 'false') {
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").removeAttr('disabled');
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! Can't update media",
                                text:"Can't update media. Please try again.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'title-long') {
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").removeAttr('disabled');
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! Can't update media",
                                text:"Media title is too long. It should have 255 characters or less Please try again.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'desc-long') {
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").removeAttr('disabled');
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! Can't update media",
                                text:"Media description is too long. It should have 750 characters or less Please try again.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'true') {
                            $.gritter.add({
                                    title:"Success!",
                                    text:"Media has been updated.",
                                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                            });
                            setTimeout(function() {
                                window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'media')) ?>";
                            }, 2000);
                        }
                        else {
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").removeAttr('disabled');
                            $("#button-edit-media<?php echo $media->cr_mediaID ?>").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Error! Can't update media",
                                text:"Can't update media. There is something error when updating. Please try again.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    });
                    update_media_<?php echo $media->cr_mediaID ?>.always(function () {
                        $inputs.prop("disabled", false);
                    });
                    event.preventDefault();
                });
                var delete_media_<?php echo $media->cr_mediaID ?>;    
                $("#form-delete-media<?php echo $media->cr_mediaID ?>").submit(function(event){
                    if (delete_media_<?php echo $media->cr_mediaID ?>) {
                         delete_media_<?php echo $media->cr_mediaID ?>.abort();
                    }
                    var $form = $(this);
                    var $inputs = $form.find("input, button");
                    var serializedData = $form.serialize();
                    delete_media_<?php echo $media->cr_mediaID ?> = $.ajax({
                        url: "<?php echo MADMINURL ?>ajax/media-delete.php",
                        type: "post",
                        beforeSend: function(){ $("#button-delete-media<?php echo $media->cr_mediaID ?>").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...'); $("#button-delete-media<?php echo $media->cr_mediaID ?>").attr('disabled','disabled');},
                        data: serializedData
                    });
                    delete_media_<?php echo $media->cr_mediaID ?>.done(function (msg){
                        if(msg == 'failed') {
                            $("#button-delete-media<?php echo $media->cr_mediaID ?>").removeAttr('disabled');
                            $("#button-delete-media<?php echo $media->cr_mediaID ?>").html('Delete');
                            $.gritter.add({
                                title:"Failed! Can't delete media",
                                text:"Can't delete media. Please try again.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'true') {
                            $.gritter.add({
                                title:"Success!",
                                text:"Media has been deleted.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                            setTimeout(function() {
                                window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'media')) ?>";
                            }, 2000);
                        }
                        else {
                            $("#button-delete-media<?php echo $media->cr_mediaID ?>").removeAttr('disabled');
                            $("#button-delete-media<?php echo $media->cr_mediaID ?>").html('Delete');
                            $.gritter.add({
                                title:"Error! Can't delete media",
                                text:"Can't delete media. There is something error when deleting. Please try again.",
                                image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    });
                    delete_media_<?php echo $media->cr_mediaID ?>.always(function () {
                        $inputs.prop("disabled", false);
                    });
                    event.preventDefault();
                });
    <?php
            }
        }
    ?>
	});
</script>