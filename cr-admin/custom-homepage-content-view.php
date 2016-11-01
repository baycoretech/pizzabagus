<?php
    $class_commerce_settings = new Commerce_Settings($pdo);
    $function_custom_homepage_content    = $class_commerce_settings->view_settings_custom_homepage_content();
    $function_custom_homepage_content_id = $class_commerce_settings->view_settings_custom_homepage_content_id();
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
                <h4 class="panel-title">Content</h4>
            </div>
            
            <div class="panel-body">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <form id="form-edit-customhomepagecontent" data-parsley-validate action="" method="POST">
                    <!-- Tab language panes -->
                    <div class="tab-content m-b-0">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                            <?php
                                if($function_custom_homepage_content->cr_settingValue == '') {
                            ?>
                            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                                <p>
                                    <strong>Empty!</strong>
                                    No custom home page content data found.
                                </p>
                            </div> 
                            <?php
                                }
                                else {
                                    echo $function_custom_homepage_content->cr_settingValue;
                                }
                            ?>
                            <hr>
                                <input type="hidden" name="settingIDh" value="<?php echo $function_custom_homepage_content->cr_settingID ?>">
                                <input type="hidden" name="settingname" value="Custom Home Page Content">
                                <div class="form-group">
                                    <textarea class="form-control" name="customhomepagecontent"><?php echo $function_custom_homepage_content->cr_settingValue ?></textarea>
                                </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_id">
                            <?php
                                if($function_custom_homepage_content_id->cr_settingValue == '') {
                            ?>
                            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                                <p>
                                    <strong>Empty!</strong>
                                    No custom home page content data found.
                                </p>
                            </div> 
                            <?php
                                }
                                else {
                                    echo $function_custom_homepage_content_id->cr_settingValue;
                                }
                            ?>
                            <hr>
                                <input type="hidden" name="settingIDh_id" value="<?php echo $function_custom_homepage_content_id->cr_settingID ?>">
                                <div class="form-group">
                                    <textarea class="form-control" name="customhomepagecontent_id"><?php echo $function_custom_homepage_content_id->cr_settingValue ?></textarea>
                                </div>
                        </div>
                        <hr>
                        <button id="button-edit-customhomepagecontent" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>
<script>
	$(document).ready(function() {
        CKEDITOR.replace( 'customhomepagecontent', {
            toolbar: [
                { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],      // Line break - next group will be placed in new line.
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                '/',
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                { name: 'others', items: [ '-' ] }
            ]
        });

        CKEDITOR.replace( 'customhomepagecontent_id', {
            toolbar: [
                { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],      // Line break - next group will be placed in new line.
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                '/',
                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
                { name: 'others', items: [ '-' ] }
            ]
        });

        var edit_custom_home_page_content;
        $("#form-edit-customhomepagecontent").submit(function(event){
            if (edit_custom_home_page_content) {
                edit_custom_home_page_content.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            for ( instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();
            var serializedData = $form.serialize();
            edit_custom_home_page_content = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/custom-homepage-content-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-customhomepagecontent").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-customhomepagecontent").attr('disabled','disabled');},
                data: serializedData
            });
            edit_custom_home_page_content.done(function (msg){
                var message = msg.split('!')[0];
                var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-edit-customhomepagecontent").removeAttr('disabled');
                    $("#button-edit-customhomepagecontent").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! No custom home page content selected",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-edit-customhomepagecontent").removeAttr('disabled');
                    $("#button-edit-customhomepagecontent").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update custom home page content",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-customhomepagecontent").removeAttr('disabled');
                    $("#button-edit-customhomepagecontent").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update custom home page content",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_custom_home_page_content.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
	});	
</script>