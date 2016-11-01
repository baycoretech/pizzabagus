<?php
    $o_get_banner = new Banner($pdo);
    $banner_id    = $_GET['id'];
    $v_get_edit_banner = $o_get_banner->edit_banner($banner_id);
?>
<div class="row">
    <!-- begin col-8 -->
    <div class="col-md-8">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Banner Information</h4>
            </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form id="formeditbanner" data-parsley-validate action="" method="POST">
                                <input type="hidden" name="banner_idh" value="<?php echo $banner_id ?>">
                                <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                                <input id="mediafile" type="hidden" name="photo" value="<?php echo $v_get_edit_banner->cr_bannerImage ?>">
                                <div class="form-group">
                                    <label class="control-label">Banner Link</label>
                                    <input class="form-control" placeholder="Banner Link" type="text" name="link" value="<?php echo $v_get_edit_banner->cr_bannerLink ?>" data-parsley-minlength="1" data-parsley-maxlength="255" data-parsley-type="url" required>
                                </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Used Image</label>
                                <img id="used-image" style="width: 100%" src="<?php echo MURL."/cr-editor/images/".$v_get_edit_banner->cr_bannerImage ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <div class="panel-footer">
                <button id="submiteditbanner" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/banner'"><i class="fa fa-reply"></i> Cancel</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>

    <div class="col-md-4">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Image</h4>
            </div>
            <div class="panel-body">
                <form action="<?php echo MADMINURL ?>/media-select-upload.php" class="dropzone" id="myAwesomeDropzone">
                    <div class="dz-message text-center">
                        <h2><i class="fa fa-cloud-upload fa-3x"></i></h2>
                        <h3>Drag and Drop Files</h3>
                    </div>
                </form>
                <p class="fancy m-t-20"><span>OR</span></p>
                <button id="browse-media-button" data-target="#browse-media-dialog" data-toggle="modal" class="btn btn-success btn-block m-t-15"><i class="fa fa-image"></i> Browse Media</button>
                <?php //require "gallery-upload.php" ?>
            </div>
         </div>
        <!-- end panel -->
    </div>
</div>
<?php
    $o_get_media = new Media($pdo);
    $v_get_media = $o_get_media->view_media_data();
?>
<div class="modal fade" id="browse-media-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Browse Media</h4>
            </div>
            <div class="modal-body">
                <div id="error-handling"></div>
                <form id="form-media-browse" action="" method="POST">
                    <div class="form-group">
                    <?php
                        foreach($v_get_media as $data) {
                    ?>
                        <div class="col-md-2">   
                            <label class="rwi">
                                <input class="" type="radio" name="mediaselect" value="<?php echo $data->cr_mediaName ?>">
                                <div class="nailthumb-container modal-square-thumb">
                                    <img style="width:100%" src="<?php echo MURL."/cr-editor/images/".$data->cr_mediaName ?>">
                                </div>
                            </label>
                        </div>
                    <?php
                        }
                    ?>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-media-select" type="button" class="btn btn-success">Select</button>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MADMINURL; ?>/assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
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
                $('#used-image').attr('src','<?php echo MURL."/cr-editor/images/" ?>'+media);
                $('#mediafile').attr('value', media);
            });
            var requesteditbanner;
            $("#formeditbanner").submit(function(event){
                if (requesteditbanner) {
                    requesteditbanner.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                requesteditbanner = $.ajax({
                    url: "<?php echo MADMINURL ?>/banner-update-ajax.php",
                    type: "post",
                    beforeSend: function(){ $("#submiteditbanner").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
                    data: serializedData
                });
                requesteditbanner.done(function (msg){
                    if(msg=='link-long') {
                        $("#submiteditbanner").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Banner link is too long",
                            text:"Can't update banner. It should have 255 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='link-short') {
                        $("#submiteditbanner").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Banner link is required",
                            text:"Can't update banner. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='invalid-url') {
                        $("#submiteditbanner").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Banner link is not a valid URL",
                            text:"Can't update banner. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-picture') {
                        $("#submiteditbanner").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded an image",
                            text:"Can't update banner. You have to upload the image. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"Banner has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo MADMINURL ?>/banner";
                        }, 2000);
                    }
                });
                requesteditbanner.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            });
        });
</script>