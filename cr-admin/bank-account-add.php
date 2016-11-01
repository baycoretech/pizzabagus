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
                <h4 class="panel-title">Bank Account Information</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="form-add-bank" data-parsley-validate action="" method="POST">
                        <input id="mediafile" type="hidden" name="image" value="">
                        <div class="form-group">
                            <label class="control-label">Bank Name</label>
                            <input class="form-control" placeholder="Bank Name" type="text" name="name" data-parsley-maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Account Number</label>
                            <input class="form-control" placeholder="Account Number" type="text" name="number" data-parsley-maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Owner</label>
                            <input class="form-control" placeholder="Owner" type="text" name="owner" data-parsley-maxlength="255" required>
                        </div>
                </div>
            <div class="panel-footer">
                <button id="button-add-bank" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-white pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>'">Cancel</button>
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
                <h4 class="panel-title">Bank Image</h4>
            </div>
            <div class="panel-body">
                <div id="used-image-container"></div>
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
        <!-- end panel -->
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
<script src="<?php echo MADMINURL; ?>assets/plugins/dropzone/dropzone.js"></script>
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
                if(response != false) {
                    $('#mediafile').val(response);
                    $('#used-image').attr('src','<?php echo MURL."cr-editor/images/" ?>'+response);
                    $('#browse-media-button').attr('disabled','disabled');
                    $('#used-image-container').slideUp(1000);
                }
                else {
                    $('#modal-alert').modal('show');
                }
              }
            };
            var selected_media_title = $('input[name=mediaselect]:checked').attr('data-title');
            var selected_media_desc  = $('input[name=mediaselect]:checked').data('desc');
            $('#media-title-info').html(selected_media_title);
            $('#media-desc-info').html(selected_media_desc);
            $('input[name=mediaselect]').click(function() {
                var selected_media_title = $(this).data('title');
                var selected_media_desc  = $(this).data('desc');
                $('#media-title-info').html(selected_media_title);
                $('#media-desc-info').html(selected_media_desc);
            })
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

            var add_bank;
            $("#form-add-bank").submit(function(event){
                if ($(this).parsley().isValid()) {
                    if (add_bank) {
                        add_bank.abort();
                    }
                    var $form = $(this);
                    var $inputs = $form.find("input, button");
                    var serializedData = $form.serialize();
                    add_bank = $.ajax({
                        url: "<?php echo MADMINURL ?>ajax/bank-account-add.php",
                        type: "post",
                        beforeSend: function(){ $("#button-add-bank").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-bank").attr('disabled','disabled');},
                        data: serializedData
                    });
                    add_bank.done(function (msg){
                        if(msg == 'name-long') {
                            $("#button-add-bank").removeAttr('disabled');
                            $("#button-add-bank").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! Bank name is too long",
                                text:"Can't add new bank account. It should have 100 characters or less. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'number-long') {
                            $("#button-add-bank").removeAttr('disabled');
                            $("#button-add-bank").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! Account number is too long",
                                text:"Can't add new bank account. It should have 100 characters or more. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'owner-long') {
                            $("#button-add-bank").removeAttr('disabled');
                            $("#button-add-bank").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! Owner is too long",
                                text:"Can't add new bank account. It should have 255 characters or more. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'no-image') {
                            $("#button-add-slider").removeAttr('disabled');
                            $("#button-add-slider").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! You have not uploaded an image",
                                text:"Can't add new bank account. You have to upload the bank image. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(msg == 'true') {
                            $.gritter.add({
                                title:"Success!",
                                text:"New bank account has been added.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                            setTimeout(function() {
                                window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                            }, 2000);
                        }
                        else if(msg == 'false') {
                            $("#button-add-bank").removeAttr('disabled');
                            $("#button-add-bank").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed! Can't add new bank account",
                                text:"Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else {
                            $("#button-add-bank").removeAttr('disabled');
                            $("#button-add-bank").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Error! Can't add new bank account",
                                text:"Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    });
                    add_bank.always(function () {
                        $inputs.prop("disabled", false);
                    });
                    event.preventDefault();
                }
            });
        });
</script>