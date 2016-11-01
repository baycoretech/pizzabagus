<?php
    $o_get_product_extra = new E_Commerce_Product_Extra($pdo);
    $productID           = $_GET['s'];
    $productextraID      = $_GET['id'];
    $v_getEditPE         = $o_get_product_extra->edit_product_extra($productextraID);
    $v_getSlugP          = $o_get_product_extra->get_slug_product($productID);
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
                    <h4 class="panel-title">Extra Content for E-Commerce Product</h4>
                </div>
                <div id="" class="panel-body">
                    <form id="formeditproductextra" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <input type="hidden" name="productID" value="<?php echo $productID ?>">
                        <input type="hidden" name="productextraIDh" value="<?php echo $productextraID ?>">
                        <div class="form-group">
                            <label class="control-label">Extra Content Name</label>
                            <input class="form-control" placeholder="Extra Content Name" type="text" name="name" value="<?php echo $v_getEditPE->cr_productextraName ?>" data-parsley-minlength="3" data-parsley-maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="editorproduct" required><?php echo $v_getEditPE->cr_productextraContent ?></textarea>
                        </div>
                </div>
                <div class="panel-footer">
                    <button id="submiteditproductextra" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $v_getSlugP ?>/extra/<?php echo $productID ?>'"><i class="fa fa-reply"></i> Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function() {
            CKEDITOR.replace( 'editorproduct', {
                    filebrowserBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });

            var requesteditproductextra;
            $("#formeditproductextra").submit(function(event){
                if (requesteditproductextra) {
                    requesteditproductextra.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                requesteditproductextra = $.ajax({
                    url: "<?php echo MADMINURL ?>/product-extra-edit.php",
                    type: "post",
                    beforeSend: function(){ $("#submiteditproductextra").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
                    data: serializedData
                });
                requesteditproductextra.done(function (msg){
                    if(msg=='name-short') {
                        $("#submiteditproductextra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Extra content name is to short",
                            text:"Can't update extra content. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-long') {
                        $("#submiteditproductextra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Extra content name is to long",
                            text:"Can't update extra content. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='content-short') {
                        $("#submiteditproductextra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Content is empty",
                            text:"Can't update extra content. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"Extra content has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo MADMINURL ?>/page/<?php echo $v_getSlugP ?>/extra/<?php echo $productID ?>";
                        }, 2000);
                    }
                });
                requesteditproductextra.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            });
        });
</script>