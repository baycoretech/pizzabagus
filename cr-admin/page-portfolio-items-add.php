<?php
    $class_portfolio_category = new Portfolio_Category($pdo);
    $function_view_pc = $class_portfolio_category->view_portfolio_category($action);
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
                <h4 class="panel-title">Portfolio Slider Image</h4>
            </div>
            <div id="panel-slider" class="panel-body">
                <form action="<?php echo MADMINURL ?>ajax/media-select-upload-multiple.php" class="dropzone" id="mediaupload">
                    <div class="dz-message text-center">
                        <h2><i class="fa fa-cloud-upload fa-3x"></i></h2>
                        <h3>Drag and Drop Files</h3>
                    </div>
                </form>
                <div id="dropzone-cover" style="background-color: rgba(0,0,0,.5); position: absolute;"></div>
                <p class="fancy m-t-20"><span>OR</span></p>
                <button id="browse-media-button" data-target="#browse-media-dialog" data-toggle="modal" class="btn btn-success btn-block m-t-15"><i class="fa fa-image"></i> Browse Media</button>
                <div id="show-selected-media" class="row m-t-15"></div>
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
                <h4 class="panel-title">Portfolio Thumbnail</h4>
            </div>
            <?php require "portfolio-items-upload.php" ?>
         </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Portfolio Information</h4>
            </div>
            <div class="panel-body">
                <form id="form-add-portfolio" data-parsley-validate action="" method="POST">
                    <input id="avatarForm" type="hidden" name="photo" value="">
                    <input id="mediafile" type="hidden" name="slider" value="">
                    <div class="form-group">
                        <label class="control-label">Title</label>
                        <input class="form-control" placeholder="Portfolio or Product Title" type="text" name="title" data-parsley-minlength="3" data-parsley-maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category</label>
                        <select class="form-control" name="cat" required>
                            <option value="">Select Category</option>
                        <?php
                            foreach ($function_view_pc as $data) {
                        ?>
                            <option value="<?php echo $data->cr_portfoliocategoryID ?>"><?php echo $data->cr_portfoliocategoryName ?></option>
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
                        <label class="control-label">Description</label>
                        <textarea name="editorportfolio" required></textarea>
                    </div>

                    <legend>SEO</legend>
                    <div id="note-gallery" class="note note-info">
                        Fill the SEO, Meta Keywords and Meta Description for found more easily by search engines.          
                    </div>
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
                <button id="button-add-portfolio" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>'">Cancel</button>
                </form>
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
                <form id="form-media-browse" action="" method="POST">
                    <div class="height-sm" data-scrollbar="true">
                        <div class="form-group m-t-10">
                        <?php
                            foreach($function_view_media_data as $data) {
                        ?>
                            <div class="col-xs-6 col-md-2">   
                                <label class="rwi">
                                    <input class="" type="checkbox" name="mediaselect" value="<?php echo $data->cr_mediaName ?>">
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
<link href="<?php echo MADMINURL ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#dropzone-cover").hide();
        var set_height = setInterval(
            function () {
                var dzh = $("#mediaupload").outerHeight()+"px";
                var dzw = $("#mediaupload").outerWidth()+"px";
                $("#dropzone-cover").css("height", dzh);
                $("#dropzone-cover").css("width", dzw);
                $("#dropzone-cover").css("top", '55px');
            }, 500
        );
        $('#browse-media-dialog').on('show.bs.modal', function(e) {
            var thumbnail_width = $('.modal-square-thumb').width();
            $('.modal-square-thumb').css({'height':thumbnail_width+'px'});
            $('.nailthumb-container').nailthumb();
        });
        Dropzone.options.mediaupload = {
          maxFilesize: 5, // MB
          maxFiles: 20,
          uploadMultiple: true,
          parallelUploads: 20,
          acceptedFiles: "image/*",
          success: function( file, response ){
            $('#mediafile').val(response);
            $('#used-image').attr('src','<?php echo MURL."cr-editor/images/" ?>'+response);
            $('#browse-media-button').attr('disabled','disabled');
            setTimeout(function() {
                $("#dropzone-cover").slideDown(1000);
                $("#show-selected-media").slideUp(1000);
            }, 1500);
          }
        };

        $("#button-media-select").click(function(){
            var media = $('input[name=mediaselect]:checked').map( function() {
                return this.value;
            }).get().join(",");
            $("#button-media-select").attr('disabled','disabled');
            $("#button-media-select").html('<i class="fa fa-spinner fa-pulse"></i>');
            
            var dataString = 'media=' + media;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/media-show-selected.php",
                data: dataString,
                cache: false,
                success: function(data){
                    if(data == "failed") {
                        $.gritter.add({
                            title:"Failed! Something error with media file",
                            text:"Can't select media. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $('#show-selected-media').html(data);
                        var thumbnail_width = $('.selected-square-thumb').width();
                        $('.selected-square-thumb').css({'height':thumbnail_width+'px'});
                        $('.nailthumb-container').nailthumb();
                        setTimeout(function() {
                            $('#browse-media-dialog').modal('hide');
                            $("#button-media-select").removeAttr('disabled');
                            $("#button-media-select").html('Select');
                        }, 2000);
                        $('#mediafile').attr('value', media);
                    }
                }
            });
            return false;
        });

        var auto_refresh = setInterval(
        function () {
            var asd = $('#avatar-view1').find('img').attr('src');
            $('#avatarForm').attr('value', asd);
        }, 500);

        CKEDITOR.replace( 'editorportfolio', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        var add_portfolio;
        $("#form-add-portfolio").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_portfolio) {
                    add_portfolio.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                add_portfolio = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/portfolio-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-portfolio").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-portfolio").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_portfolio.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't add new portfolio. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new portfolio. Portfolio title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Portfolio title is too long",
                            text:"Can't add new portfolio. It should have 200 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Portfolio title is too short",
                            text:"Can't add new portfolio. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-word') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't add new portfolio. Don't use word like 'sort', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'metakey-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Keywords is too long",
                            text:"Can't add new portfolio. It should have 255 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'metadesc-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Meta Description is too long",
                            text:"Can't add new portfolio. It should have 155 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'no-slider') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded a slider image",
                            text:"Can't add new portfolio. You have to upload at least one portfolio slider image. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'no-image') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded a thumbnail",
                            text:"Can't add new portfolio. You have to upload the portfolio thumbnail. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New portfolio has been added.",
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
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new portfolio",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio").removeAttr('disabled');
                        $("#button-add-portfolio").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new portfolio",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                add_portfolio.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>