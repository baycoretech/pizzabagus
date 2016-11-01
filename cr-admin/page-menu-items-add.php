<?php
    $class_ourmenu_category = new Our_Menu_Category($pdo);
    $function_view_mc = $class_ourmenu_category->view_ourmenu_category($action);
    $class_ourmenu    = new Our_Menu($pdo);
    $ingredients      = $class_ourmenu->all_ingredients();
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
                <h4 class="panel-title">Menu Information</h4>
            </div>
            <div class="panel-body">
                <form id="form-add-ourmenu" data-parsley-validate action="" method="POST">
                    <input id="avatarForm" type="hidden" name="photo" value="">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input class="form-control" placeholder="Menu Name" type="text" name="title" data-parsley-minlength="3" data-parsley-maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category</label>
                        <select class="form-control" name="cat" required>
                            <option value="">Select Category</option>
                        <?php
                            foreach ($function_view_mc as $data) {
                        ?>
                            <option value="<?php echo $data->cr_ourmenucategoryID ?>"><?php echo $data->cr_ourmenucategoryName ?></option>
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
                    <!-- Nav language tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                        <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                    </ul>

                    <!-- Tab language panes -->
                    <div class="tab-content m-b-0">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                            <div class="form-group">
                                <label class="control-label">Ingredients (enter, space, tab, or comma after type)</label>
                                <ul id="jquery-ingredients" class="success">
                                </ul>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="editorourmenu" required></textarea>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_id">
                            <div class="form-group">
                                <label class="control-label">Ingredients (enter, space, tab, or comma after type)</label>
                                <ul id="jquery-ingredients-id" class="success">
                                </ul>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="editorourmenu_id" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Price</label>
                        <input class="form-control" placeholder="Price" type="text" name="price" data-parsley-type="integer" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control" name="type" required>
                            <option value="">Select Type</option>
                            <option value="none" selected="selected">None</option>
                            <option value="vegetarian">Vegetarian</option>
                            <option value="fish">Fish</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Size</label>
                        <select class="form-control" name="size" required>
                            <option value="">Select Size</option>
                            <option value="none" selected="selected">None</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="regular">Regular</option>
                            <option value="large">Large</option>
                        </select>
                    </div>
            </div>
            <div class="panel-footer">
                <button id="button-add-ourmenu" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>'">Cancel</button>
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
                <h4 class="panel-title">Menu Thumbnail</h4>
            </div>
            <?php require "menu-items-upload.php" ?>
         </div>
    </div>
</div>
<link href="<?php echo MADMINURL ?>assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
<script>
    $(document).ready(function() {
        var auto_refresh = setInterval(
        function () {
            var asd = $('#avatar-view1').find('img').attr('src');
            $('#avatarForm').attr('value', asd);
        }, 500);

        CKEDITOR.replace( 'editorourmenu', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        CKEDITOR.replace( 'editorourmenu_id', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        var add_ourmenu;
        $("#form-add-ourmenu").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_ourmenu) {
                    add_ourmenu.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                add_ourmenu = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/ourmenu-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-ourmenu").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-ourmenu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_ourmenu.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't add new menu. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new menu. Menu is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Name is too long",
                            text:"Can't add new menu. It should have 200 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Name is too short",
                            text:"Can't add new menu. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-word') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't add new menu. Don't use word like 'sort', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'no-image') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded a thumbnail",
                            text:"Can't add new menu. You have to upload the menu thumbnail. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New menu has been added.",
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
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-ourmenu").removeAttr('disabled');
                        $("#button-add-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                add_ourmenu.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>