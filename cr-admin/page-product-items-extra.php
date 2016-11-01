<?php
    $o_get_product_extra = new E_Commerce_Product_Extra($pdo);
    $pID                 = $_GET['eid'];
    $pagelink            = $_GET['s'];
    $v_getPE             = $o_get_product_extra->view_product_extra($pID);
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
                                    <form id="formaddproductextra" data-parsley-validate action="" method="POST">
                                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                                        <input type="hidden" name="productID" value="<?php echo $pID ?>">
                                        <div class="form-group">
                                            <label class="control-label">Extra Content Name</label>
                                            <input class="form-control" placeholder="Extra Content Name" type="text" name="name" data-parsley-minlength="3" data-parsley-maxlength="50" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea name="editorproduct" required></textarea>
                                        </div>
                                </div>
                            <div class="panel-footer">
                                <button id="submitaddproductextra" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                                <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/view'"><i class="fa fa-reply"></i> Cancel</button>
                                </form>
                            </div>
                         </div>

                    <?php
                        if($v_getPE==0) {
                            echo "";
                        }
                        else {
                    ?>
                    <div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-unlimited-tabs-1">
                        <div class="panel-heading p-0">
                            <div class="panel-heading-btn m-r-10 m-t-10">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                            </div>
                            <!-- begin nav-tabs -->
                            <div class="tab-overflow">
                                <ul class="nav nav-tabs nav-tabs-inverse">
                                    <li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-success"><i class="fa fa-arrow-left"></i></a></li>
                                    <?php
                                        $i=1;
                                        foreach ($v_getPE as $data) {
                                    ?>
                                    <li class="<?php if($i==1) echo "active" ?>"><a href="#nav-tab-<?php echo $i ?>" data-toggle="tab"><strong><?php echo $data->cr_productextraName ?></strong></a></li>
                                    <?php
                                            $i++;
                                        }
                                    ?>
                                    <li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-success"><i class="fa fa-arrow-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <?php
                                $i=1;
                                foreach ($v_getPE as $data) {
                            ?>
                            <div class="tab-pane fade <?php if($i==1) echo "active in" ?>" id="nav-tab-<?php echo $i ?>">
                                <?php echo $data->cr_productextraContent ?>
                                <hr>
                                    <button type="button" class="btn btn-success m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/product-extra/<?php echo $data->cr_productID ?>/<?php echo $data->cr_productextraID ?>'"><i class="fa fa-pencil cpointer"></i> Edit</button>
                                    <button type="button" class="btn btn-danger m-r-5 m-b-5" data-target="#delete-dialog" data-toggle="modal" data-nm="<?php echo $data->cr_productextraName; ?>" data-hapus="<?php echo $data->cr_productextraID; ?>"><i class="fa fa-times cpointer"></i> Delete</button>
                            </div>
                            <?php
                                    $i++;
                                }
                            ?>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
			        <!-- end panel -->
			    </div>
			    <!-- end col-9 -->
</div>

<!-- #delete-dialog -->
<div class="modal fade" id="delete-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="nm"></span></span>?</p>
                <?php
                    if (isset ($_POST['hapus'])) {
                        //Delete Handler
                        $deleteit          = sha1("deleteit");
                        $peID               = $_POST['productextraID'];
                        $adminLoginID      = $_POST['adminLoginID'];
                        $v_delPE           = $o_get_product_extra->delete_product_extra($peID, $adminLoginID);
                            header("Location: $madinurl/page/$pagelink/extra/$pID"); 
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="productextraID" value="" id="delete">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function() {
            $('#delete-dialog').on('show.bs.modal', function(e) {
                $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
                $(this).find('#nm').html($(e.relatedTarget).data('nm'));
            });

            CKEDITOR.replace( 'editorproduct', {
                    filebrowserBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html',
                    filebrowserImageBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html?type=Images',
                    filebrowserFlashBrowseUrl : '<?php echo MURL; ?>/cr-include/ckfinder/ckfinder.html?type=Flash',
                    filebrowserUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                    filebrowserImageUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                    filebrowserFlashUploadUrl : '<?php echo MURL; ?>/cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
            });

            var requestaddproductextra;
            $("#formaddproductextra").submit(function(event){
                if (requestaddproductextra) {
                    requestaddproductextra.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                requestaddproductextra = $.ajax({
                    url: "<?php echo MADMINURL ?>/product-extra-add.php",
                    type: "post",
                    beforeSend: function(){ $("#submitaddproductextra").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
                    data: serializedData
                });
                requestaddproductextra.done(function (msg){
                    if(msg=='name-short') {
                        $("#submitaddproductextra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Extra content name is to short",
                            text:"Can't add new extra content. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-long') {
                        $("#submitaddproductextra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Extra content name is to long",
                            text:"Can't add new extra content. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='content-short') {
                        $("#submitaddproductextra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Content is empty",
                            text:"Can't add new extra content. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"New extra content has been added.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/extra/<?php echo $pID ?>";
                        }, 2000);
                    }
                });
                requestaddproductextra.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            });
        });
</script>