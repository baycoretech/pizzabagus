<?php
    $o_getJumbotron = new jumbotron($pdo);
    $v_getEditBGjumbotron = $o_getJumbotron->editBackgroundjumbotron();
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
                <h4 class="panel-title">Background Jumbotron Information</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="formaddjumbotron" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <input id="mediafile" type="hidden" name="photo" value="<?php echo $v_getEditBGjumbotron->cr_jumbotronImage ?>">
                        <input id="photourlnc" type="hidden" name="photourlnc" value="<?php echo $v_getEditBGjumbotron->cr_jumbotronImage ?>">
                        <div class="form-group">
                            <label class="control-label">Caption</label>
                            <input class="form-control" placeholder="Background Jumbotron Caption" type="text" name="caption" value="<?php echo $v_getEditBGjumbotron->cr_jumbotronCaption ?>" data-parsley-minlength="2" data-parsley-maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="desc" class="form-control" rows="3" placeholder="Background Jumbotron Description"  data-parsley-minlength="2" required><?php echo $v_getEditBGjumbotron->cr_jumbotronDesc ?></textarea>
                        </div>
                        <div class="form-group">
                            <div class="note note-info">
                                <p>
                                    Fill Button Text and Button Link fields if you want to add a button to background jumbotron.          
                                </p>
                            </div>
                            <label class="control-label">Button Text</label>
                            <input class="form-control" placeholder="Background Jumbotron Button Text" type="text" name="btext" value="<?php echo $v_getEditBGjumbotron->cr_jumbotronButtontext ?>" data-parsley-maxlength="50">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Button Link</label>
                            <input class="form-control" placeholder="Background Jumbotron Button Link" type="text" name="blink" value="<?php echo $v_getEditBGjumbotron->cr_jumbotronButtonLink ?>" data-parsley-type="url" data-parsley-maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Text Position</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="textposition" value="left" <?php if($v_getEditBGjumbotron->cr_jumbotronTextposition=="left") echo "checked" ?>>
                                    Left
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="textposition" value="center" <?php if($v_getEditBGjumbotron->cr_jumbotronTextposition=="center") echo "checked" ?>>
                                    Center
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="textposition" value="right" <?php if($v_getEditBGjumbotron->cr_jumbotronTextposition=="right") echo "checked" ?>>
                                    Right
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="note note-info">
                                <p>
                                    Select what overlay effect do you want to add to jumbotron.
                                </p>
                            </div>
                            <label class="control-label">Overlay Effect</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="matchcs" value="light-bg" <?php if($v_getEditBGjumbotron->cr_jumbotronColorscheme=="light-bg") echo "checked" ?>>
                                    Light Background
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="matchcs" value="dark-bg" <?php if($v_getEditBGjumbotron->cr_jumbotronColorscheme=="dark-bg") echo "checked" ?>>
                                    Dark Background
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="matchcs" value="tint-bg" <?php if($v_getEditBGjumbotron->cr_jumbotronColorscheme=="tint-bg") echo "checked" ?>>
                                    Match with Color Scheme
                                </label>
                            </div>
                        </div>
                </div>
            <div class="panel-footer">
                <button id="submitaddjumbotron" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/background-jumbotron ?>'"><i class="fa fa-reply"></i> Cancel</button>
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
                <h4 class="panel-title">Background Jumbotron Image</h4>
            </div>
            <div class="panel-body">
                <div id="used-image-container">
                    <?php 
                        if($v_getEditBGjumbotron->cr_jumbotronImage != '') {
                    ?>
                    <img style="width: 100%" class="m-b-15" src="<?php echo MURL."/cr-editor/images/".$v_getEditBGjumbotron->cr_jumbotronImage ?>">
                    <?php } ?>
                </div>
                 <form action="<?php echo MADMINURL ?>/media-select-upload.php" class="dropzone" id="myAwesomeDropzone">
                    <div class="dz-message text-center">
                        <h2><i class="fa fa-cloud-upload fa-3x"></i></h2>
                        <h3>Drag and Drop Files</h3>
                    </div>
                </form>
                <p class="fancy m-t-20"><span>OR</span></p>
                <button id="browse-media-button" data-target="#browse-media-dialog" data-toggle="modal" class="btn btn-success btn-block m-t-15"><i class="fa fa-image"></i> Browse Media</button>
            </div>
            <?php //require "jumbotron-upload.php" ?>
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
                $('#used-image-container').html('<img style="width: 100%" class="m-b-15" src="<?php echo MURL."/cr-editor/images/" ?>'+media+'">');
                $('#mediafile').attr('value', media);
            });

            var requestaddjumbotron;
            $("#formaddjumbotron").submit(function(event){
                if (requestaddjumbotron) {
                    requestaddjumbotron.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                requestaddjumbotron = $.ajax({
                    url: "<?php echo MADMINURL ?>/background-jumbotron-edit-ajax.php",
                    type: "post",
                    beforeSend: function(){ $("#submitaddjumbotron").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
                    data: serializedData
                });
                requestaddjumbotron.done(function (msg){
                    if(msg=='caption-short') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Jumbotron caption is too short",
                            text:"Can't add new background jumbotron. It should have 2 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='caption-long') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Jumbotron caption is too long",
                            text:"Can't add new background jumbotron. It should have 100 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='desc-short') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Jumbotron description is too short",
                            text:"Can't add new background jumbotron. It should have 2 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='btext-long') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Button text is too long",
                            text:"Can't add new background jumbotron. It should have 50 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='blink-long') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Button link is too long",
                            text:"Can't add new background jumbotron. It should have 255 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-tp') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not selected the text position",
                            text:"Can't add new plain jumbotron. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-cs') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not selected the overlay effect",
                            text:"Can't add new background jumbotron. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-image') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded an image",
                            text:"Can't add new background jumbotron. You have to upload the background jumbotron image. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='invalid-url') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Invalid button URL link",
                            text:"Can't add new background jumbotron. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='success'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Background jumbotron has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo MADMINURL ?>/background-jumbotron";
                        }, 2000);
                    }
                    else {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Something wrong",
                            text:"Can't add new background jumbotron. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                requestaddjumbotron.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            });
        });
</script>