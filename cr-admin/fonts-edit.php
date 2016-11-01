<?php
    $function_edit_font = $class_appearance->edit_font($id);
?>
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Font Information</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="form-edit-font" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="font_idh" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label class="control-label">Font Name</label>
                            <input class="form-control" placeholder="Font Name" type="text" name="name" data-parsley-maxlength="100" value="<?php echo $function_edit_font->cr_fontsName ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Font Link</label>
                            <input class="form-control" placeholder="Font Link" type="text" name="link" data-parsley-maxlength="255" value="<?php echo htmlentities($function_edit_font->cr_fontsLink) ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Font Family</label>
                            <input class="form-control" placeholder="Font Family" type="text" name="family" data-parsley-maxlength="100" value="<?php echo $function_edit_font->cr_fontsFamily ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Applied to</label>
                            <select class="form-control" name="applied" required>
                                <option value="">Select Target</option>
                                <option value="default" <?php if($function_edit_font->cr_fontsApplied == 'default') echo 'selected="selected"' ?>>Default</option>
                                <option value="navigation" <?php if($function_edit_font->cr_fontsApplied == 'navigation') echo 'selected="selected"' ?>>Navigation</option>
                                <option value="page-heading" <?php if($function_edit_font->cr_fontsApplied == 'page-heading') echo 'selected="selected"' ?>>Page Heading</option>
                                <option value="heading" <?php if($function_edit_font->cr_fontsApplied == 'heading') echo 'selected="selected"' ?>>Heading</option>
                                <option value="content" <?php if($function_edit_font->cr_fontsApplied == 'content') echo 'selected="selected"' ?>>Content</option>
                            </select>
                        </div>
                </div>
            <div class="panel-footer">
                <button id="button-edit-font" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>'">Cancel</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>
</div>

<script>
    $(document).ready(function() {
        var edit_font;
        $("#form-edit-font").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_font) {
                    edit_font.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_font = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/font-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-font").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-font").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_font.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-font").removeAttr('disabled');
                        $("#button-edit-font").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't update font. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-font").removeAttr('disabled');
                        $("#button-edit-font").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Font name is too long",
                            text:"Can't update font. It should have 100 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'link-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-font").removeAttr('disabled');
                        $("#button-edit-font").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Font link is too long",
                            text:"Can't update font. It should have 255 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'family-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-font").removeAttr('disabled');
                        $("#button-edit-font").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Font family is too long",
                            text:"Can't update font. It should have 100 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'applied-exist') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-font").removeAttr('disabled');
                        $("#button-edit-font").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Another font is already applied to target",
                            text:"Can't update font. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Font has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-font").removeAttr('disabled');
                        $("#button-edit-font").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update font",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-font").removeAttr('disabled');
                        $("#button-edit-font").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update font",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_font.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>