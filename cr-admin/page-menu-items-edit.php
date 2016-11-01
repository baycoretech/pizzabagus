<?php
    $class_ourmenu_category = new Our_Menu_Category($pdo);
    $function_view_mc = $class_ourmenu_category->view_ourmenu_category($action);
    $class_ourmenu    = new Our_Menu($pdo);
    $ingredients      = $class_ourmenu->all_ingredients();
    $ingredients_id   = $class_ourmenu->all_ingredients_id();
    $function_edit_ourmenu  = $class_ourmenu->edit_ourmenu($extra);
    $function_count_selected_ourmenu = $class_ourmenu->count_selected_ourmenu();
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
                <form id="form-edit-ourmenu" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="ourmenu_idh" value="<?php echo $extra ?>">
                    <input id="avatarForm" type="hidden" name="photo" value="">
                    <input id="photourlnc" type="hidden" name="photourlnc" value="<?php echo $function_edit_ourmenu->cr_ourmenuThumb ?>">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input class="form-control" placeholder="Menu Name" type="text" name="title" data-parsley-minlength="3" data-parsley-maxlength="200" value="<?php echo $function_edit_ourmenu->cr_ourmenuTitle ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Category</label>
                        <select class="form-control" name="cat" required>
                            <option value="">Select Category</option>
                        <?php
                            foreach ($function_view_mc as $data) {
                        ?>
                            <option value="<?php echo $data->cr_ourmenucategoryID ?>" <?php if($function_edit_ourmenu->cr_ourmenucategoryID == $data->cr_ourmenucategoryID) echo 'selected="selected"' ?>><?php echo $data->cr_ourmenucategoryName ?></option>
                        <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">Select Status</option>
                            <option value="publish" <?php if($function_edit_ourmenu->cr_ourmenuStatus == 'publish') echo 'selected="selected"' ?>>Publish</option>
                            <option value="draft" <?php if($function_edit_ourmenu->cr_ourmenuStatus == 'draft') echo 'selected="selected"' ?>>Draft</option>
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
                                <label class="control-label">Ingredients (enter, tab, or comma after type)</label>
                                <ul id="jquery-ingredients" class="success">
                                    <?php 
                                        $explode_ingredients = explode(', ', $function_edit_ourmenu->cr_ourmenuIngredients);
                                        foreach ($explode_ingredients as $array) {
                                            echo '<li>'.$array.'</li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="editorourmenu" required><?php echo $function_edit_ourmenu->cr_ourmenuDesc ?></textarea>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_id">
                            <div class="form-group">
                                <label class="control-label">Ingredients (enter, tab, or comma after type)</label>
                                <ul id="jquery-ingredients-id" class="success">
                                    <?php 
                                        $explode_ingredients_id = explode(', ', $function_edit_ourmenu->cr_ourmenuIngredients_id);
                                        foreach ($explode_ingredients_id as $array) {
                                            echo '<li>'.$array.'</li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <textarea name="editorourmenu_id" required><?php echo $function_edit_ourmenu->cr_ourmenuDesc_id ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Price</label>
                        <input class="form-control" placeholder="Price" type="text" name="price" data-parsley-type="integer" value="<?php echo $function_edit_ourmenu->cr_ourmenuPrice ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control" name="type" required>
                            <option value="">Select Type</option>
                            <option value="none" <?php if($function_edit_ourmenu->cr_ourmenuType == 'none') echo 'selected="selected"' ?>>None</option>
                            <option value="vegetarian" <?php if($function_edit_ourmenu->cr_ourmenuType == 'vegetarian') echo 'selected="selected"' ?>>Vegetarian</option>
                            <option value="fish" <?php if($function_edit_ourmenu->cr_ourmenuType == 'fish') echo 'selected="selected"' ?>>Fish</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Size</label>
                        <select class="form-control" name="size" required>
                            <option value="">Select Size</option>
                            <option value="none" <?php if($function_edit_ourmenu->cr_ourmenuSize == 'none') echo 'selected="selected"' ?>>None</option>
                            <option value="small" <?php if($function_edit_ourmenu->cr_ourmenuSize == 'small') echo 'selected="selected"' ?>>Small</option>
                            <option value="medium" <?php if($function_edit_ourmenu->cr_ourmenuSize == 'medium') echo 'selected="selected"' ?>>Medium</option>
                            <option value="regular" <?php if($function_edit_ourmenu->cr_ourmenuSize == 'regular') echo 'selected="selected"' ?>>Regular</option>
                            <option value="large" <?php if($function_edit_ourmenu->cr_ourmenuSize == 'large') echo 'selected="selected"' ?>>Large</option>
                        </select>
                    </div>
            </div>
            <div class="panel-footer">
                <button id="button-edit-ourmenu" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
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

         <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Special Menu</h4>
            </div>
            <div id="" class="panel-body">
                <?php
                    if($function_edit_ourmenu->cr_ourmenuSelected == "yes") {
                ?>
                    <div class="alert alert-info fade in m-b-15">
                        This menu is already set as special menu.
                    </div>
                <?php
                    }
                    if($function_edit_ourmenu->cr_ourmenuSelected == "") {
                ?>
                <form id="form-selected-ourmenu" action="" method="POST">
                    <input type="hidden" name="action" value="select">
                    <input type="hidden" name="selected_ourmenu_id" value="<?php echo $extra ?>">
                    <button id="button-selected-ourmenu" type="submit" class="btn btn-success btn-block" <?php if($function_edit_ourmenu->cr_ourmenuSelected == "yes") echo "disabled" ?>>Set As Special Menu
                    </button>
                </form>
                <?php
                    }
                    elseif($function_edit_ourmenu->cr_ourmenuSelected == "yes") {
                ?>
                <form id="form-selected-ourmenu" action="" method="POST">
                    <input type="hidden" name="action" value="unselect">
                    <input type="hidden" name="selected_menu_id" value="<?php echo $extra ?>">
                    <button id="button-selected-ourmenu" type="submit" class="btn btn-danger btn-block m-t-10">Unselect Menu</button>
                </form>
                <?php
                    }
                ?>
            </div>
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

        var edit_ourmenu;
        $("#form-edit-ourmenu").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_ourmenu) {
                    edit_ourmenu.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                edit_ourmenu = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/ourmenu-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-ourmenu").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-ourmenu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_ourmenu.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't update menu. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't update menu. Menu is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Name is too long",
                            text:"Can't update menu. It should have 200 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Name is too short",
                            text:"Can't update menu. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-word') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't update menu. Don't use word like 'sort', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'no-image') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not uploaded a thumbnail",
                            text:"Can't update menu. You have to upload the menu thumbnail. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Menu has been updated.",
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
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-ourmenu").removeAttr('disabled');
                        $("#button-edit-ourmenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_ourmenu.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var selected_ourmenu;
        $("#form-selected-ourmenu").submit(function(event){
            if (selected_ourmenu) {
                selected_ourmenu.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var $action = $form.find("input[name=action]").val();
            var serializedData = $form.serialize();
            selected_ourmenu = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/ourmenu-selected.php",
                type: "post",
                beforeSend: function(){ 
                    $("#button-selected-ourmenu").html('<i class="fa fa-spinner fa-pulse"></i>');
                    $("#button-selected-ourmenu").attr('disabled','disabled');
                },
                data: serializedData
            });
            selected_ourmenu.done(function (msg){
                if(msg == 'select,empty-menu') {
                    $("#button-selected-ourmenu").removeAttr('disabled');
                    $("#button-selected-ourmenu").html('Set As Special Menu');
                    $.gritter.add({
                        title:"Failed!",
                        text:"No menu selected. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'unselect,empty-menu') {
                    $("#button-selected-ourmenu").removeAttr('disabled');
                    $("#button-selected-ourmenu").html('Unselect Menu');
                    $.gritter.add({
                        title:"Failed!",
                        text:"No menu selected. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'select,true') {
                    $.gritter.add({
                        title:"Success!",
                        text:"This menu has been set as special menu.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => $id, 'extra' => $extra)) ?>";
                    }, 2000);
                }
                else if(msg == 'select,false') {
                    $("#button-selected-ourmenu").removeAttr('disabled');
                    $("#button-selected-ourmenu").html('Set As Special Menu');
                    $.gritter.add({
                        title:"Failed! Can't set this menu as selected menu",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'unselect,true') {
                    $.gritter.add({
                        title:"Success!",
                        text:"This menu has been unset as special menu.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => $id, 'extra' => $extra)) ?>";
                    }, 2000);
                }
                else if(msg == 'unselect,false') {
                    $("#button-selected-ourmenu").removeAttr('disabled');
                    $("#button-selected-ourmenu").html('Unselect Menu');
                    $.gritter.add({
                        title:"Failed! Can't remove this menu from selected menu",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-selected-ourmenu").removeAttr('disabled');
                    if($action == 'select') {
                        $("#button-selected-ourmenu").html('Set As Special menu');
                    }
                    else if($action == 'unselect') {
                        $("#button-selected-ourmenu").html('Unselect Portfolio');
                    }
                    $.gritter.add({
                        title:"Error!",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            selected_ourmenu.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        $('#button-remove-image').click(function() {
            var menuid     = $(this).data("menuid");
            var dataString = 'menuid='+menuid;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/ourmenu-remove-image.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $('#button-remove-image').html('<i class="fa fa-spinner fa-pulse"></i> Removing Image...');$('#button-remove-image').attr('disabled','disabled')},
                success: function(msg){
                    if(msg == 'menu-empty') {
                        $('#button-remove-image').removeAttr('disabled');
                        $('#button-remove-image').html('Remove Image');
                        $.gritter.add({
                            title:"Failed! Menu is required",
                            text:"Can't remove image. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Image has been removed",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => $id, 'extra' => $extra)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $('#button-remove-image').removeAttr('disabled');
                        $('#button-remove-image').html('Remove Image');
                        $.gritter.add({
                            title:"Failed! Can't delete image",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $('#button-remove-image').removeAttr('disabled');
                        $('#button-remove-image').html('Remove Image');
                        $.gritter.add({
                            title:"Error! Can't delete image",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                }
            });
        return false;
        });
    });
</script>