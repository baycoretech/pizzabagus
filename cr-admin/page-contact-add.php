<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Contact Information</h4>
            </div>
            <div class="panel-body">
                <form id="form-add-contact" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="link" value="<?php echo $action ?>">
                    <legend>Contact Information</legend>
                    <!-- Nav language tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                        <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                    </ul>

                    <!-- Tab language panes -->
                    <div class="tab-content m-b-0">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="ckeditor" name="desc" rows="30"></textarea>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_id">
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea class="ckeditor" name="desc_id" rows="30"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Social</label>
                        <select class="form-control selectpicker" data-size="10" data-live-search="false" data-style="btn-white" name="social" data-parsley-errors-container="#error-social" required>
                            <option value="">Select Social Media show or not shown</option>
                            <option value="show">Show</option>
                            <option value="not shown">Not Shown</option>
                        </select>
                        <div id="error-social" class="error-selectpicker-container"></div>
                    </div>
                    <legend>Page Information</legend>
                    <!-- Nav language tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#custom_tab_en" aria-controls="custom_tab_en" role="tab" data-toggle="tab">English</a></li>
                        <li role="presentation"><a href="#custom_tab_id" aria-controls="custom_tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                    </ul>

                    <!-- Tab language panes -->
                    <div class="tab-content m-b-0">
                        <div role="tabpanel" class="tab-pane fade in active" id="custom_tab_en">
                            <div class="form-group">
                                <label class="control-label">Custom Page Header</label>
                                <input class="form-control" placeholder="Custom Page Header" type="text" name="customheader" data-parsley-maxlength="100">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Custom Page Description</label>
                                <textarea class="form-control" placeholder="Custom Page Description" name="customdesc" rows="4" data-parsley-maxlength="500"></textarea>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="custom_tab_id">
                            <div class="form-group">
                                <label class="control-label">Custom Page Header</label>
                                <input class="form-control" placeholder="Custom Page Header" type="text" name="customheader_id" data-parsley-maxlength="100">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Custom Page Description</label>
                                <textarea class="form-control" placeholder="Custom Page Description" name="customdesc_id" rows="4" data-parsley-maxlength="500"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="panel-footer">
                    <button id="button-add-contact" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>'">Cancel</button>
                </form>
            </div>
         </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".selectpicker").selectpicker("render");
        
        CKEDITOR.replace( 'desc', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        CKEDITOR.replace( 'desc_id', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        var add_contact;
        $("#form-add-contact").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_contact) {
                    add_contact.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                add_contact = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/page-contact-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-contact").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-contact").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled')},
                    data: serializedData
                });
                add_contact.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-contact").removeAttr('disabled');
                        $("#button-add-contact").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't add new content. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'cheader-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-page").removeAttr('disabled');
                        $("#button-add-page").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom page header is too long",
                            text:"Can't add new content. It should have 100 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'cdesc-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-page").removeAttr('disabled');
                        $("#button-add-page").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom page description is too long",
                            text:"Can't add new content. It should have 500 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New content has been added.",
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
                        $("#button-add-contact").removeAttr('disabled');
                        $("#button-add-contact").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new content",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-contact").removeAttr('disabled');
                        $("#button-add-contact").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new content",
                            text:msg,
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                add_contact.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>