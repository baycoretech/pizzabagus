<?php
    $class_portfolio_extra = new Portfolio_Extra($pdo);
    $function_edit_portfolio_extra = $class_portfolio_extra->edit_portfolio_extra($id);
    $function_get_slug_portfolio   = $class_portfolio_extra->get_slug_portfolio($action);
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
                    <h4 class="panel-title">Extra Content for Portfolio</h4>
                </div>
                <div id="" class="panel-body">
                    <form id="form-edit-portfolio-extra" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="portfolio_id" value="<?php echo $action ?>">
                        <input type="hidden" name="portfolio_extra_idh" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label class="control-label">Extra Content Name</label>
                            <input class="form-control" placeholder="Extra Content Name" type="text" name="name" value="<?php echo $function_edit_portfolio_extra->cr_portfolioextraName ?>" data-parsley-maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="editorportfolio" required><?php echo $function_edit_portfolio_extra->cr_portfolioextraContent ?></textarea>
                        </div>
                </div>
                <div class="panel-footer">
                    <button id="button-edit-portfolio-extra" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => 'page', 'action' => $function_get_slug_portfolio, 'id' => 'extra', 'extra' => $action)) ?>'">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        CKEDITOR.replace( 'editorportfolio', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        var edit_portfolio_extra;
        $("#form-edit-portfolio-extra").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_portfolio_extra) {
                    edit_portfolio_extra.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                edit_portfolio_extra = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/portfolio-extra-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-portfolio-extra").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-portfolio-extra").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_portfolio_extra.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't update portfolio extra content. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Extra content name is to long",
                            text:"Can't update portfolio extra content. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'content-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Content is empty",
                            text:"Can't update portfolio extra content. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Portfolio extra content has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-extra', array('section' => 'page', 'action' => $function_get_slug_portfolio, 'id' => 'extra', 'extra' => $action)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update portfolio extra content",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").removeAttr('disabled');
                        $("#button-edit-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update portfolio extra content",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_portfolio_extra.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>