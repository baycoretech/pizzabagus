<?php
    $function_view_logo = $class_appearance->view_logo();
?>
<div class="row">
    <!-- begin col-9 -->
    <div class="col-md-9">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Current Logo</h4>
            </div>
            <?php
                if($function_view_logo == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    You have no logo.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <?php
                    $logo_image = $function_view_logo->cr_settingValue;
                    //change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
                    $logo_imageGIF  = str_replace(".png",".gif",$logo_image);
                    $logo_imageJPG  = str_replace(".png",".jpg",$logo_image);
                    $logo_imageJPEG = str_replace(".png",".jpeg",$logo_image);
                    //remove "/thumbnails" to get the real image
                    $logo_imagent     = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image;
                    $logo_imageGIFnt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_imageGIF;
                    $logo_imageJPGnt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_imageJPG;
                    $logo_imageJPEGnt = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_imageJPEG;

                    $logo_imageLink     = MURL.'cr-editor/images/'.$logo_image;
                    $logo_imageGIFLink  = MURL.'cr-editor/images/'.$logo_imageGIF;
                    $logo_imageJPGLink  = MURL.'cr-editor/images/'.$logo_imageJPG;
                    $logo_imageJPEGLink = MURL.'cr-editor/images/'.$logo_imageJPEG;

                    if(file_exists($logo_imagent)) { 
                        $image_path =  $logo_imageLink; 
                    } 
                    elseif(file_exists($logo_imageGIFnt)) { 
                        $image_path =  $logo_imageGIFLink; 
                    } 
                    elseif(file_exists($logo_imageJPGnt)) {
                        $image_path =  $logo_imageJPGLink; 
                    } 
                    elseif(file_exists($logo_imageJPEGnt)) { 
                        $image_path =  $logo_imageJPEGLink; 
                    } 
                ?>
                <img src="<?php echo $image_path ?>" alt="Website Logo" width="180">
            </div>
            <?php
                }
            ?>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-9 -->
	<!-- begin col-3 -->
	<div class="col-md-3">
		<!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Action</h4>
            </div>
            <div class="panel-body">
                    <?php
                        if($function_view_logo == false) {
                    ?>
                    <button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => 'logo', 'action' => 'add')) ?>'">
                        <i class="fa fa-plus fa-2x pull-left"></i>
                        <span class="f-w-700">Add Logo</span><br>
                        <small>Add New Logo</small>
                    </button>
                    <?php
                        }
                        else {
                    ?>
                    <button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => 'logo', 'action' => 'edit', 'id' => $function_view_logo->cr_settingID)) ?>'"> 
                        <i class="fa fa-pencil-square-o fa-2x pull-left"></i>
                        <span class="f-w-700">Edit Logo</span><br>
                        <small>Edit Existing Logo</small>
                    </button>   
                    <button id="delete-button" class="btn btn-lg btn-danger btn-block" data-target="#delete-dialog" data-toggle="modal">
                        <i class="fa fa-times fa-2x pull-left"></i>
                        <span class="f-w-700">Delete Logo</span><br>
                        <small>Delete Existing Logo</small>
                    </button> 
                    <?php
                        }
                    ?>
            </div>
        </div>
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Information
                        </a>
                    </h3>
                </div>
                <div style="" aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <p>
                            If you do not have a logo, system will make your Site Name as a logo replacement and it's just a static text.
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Action Button
                        </a>
                    </h3>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p>
                            There are one button above, <strong class="text-success">Add Logo</strong>. Click <strong class="text-success">Add Logo</strong> to add new logo. If you have logo already, there will be two buttons. You can edit existing logo by clicking <strong class="text-success">Edit Logo</strong>, and delete logo by clicking <strong class="text-danger">Delete Logo</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
		<!-- end panel -->
	</div>
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
                <p>Are you sure want to delete current logo?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-delete-logo" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.gritter.add({
            title:"Creatify Tips",
            text:"Upload your logo for best appearance.",
            image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
            sticky:true,
            time:""
        });
        
        $('#button-delete-logo').click(function() {
            $.ajax({
                url: "<?php echo MADMINURL ?>ajax/logo-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-logo").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-logo").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                success: function (msg){
                    if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Logo has been deleted",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-edit-menu').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'logo')) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-delete-logo").removeAttr('disabled');
                        $("#button-delete-logo").html('Delete');
                        $.gritter.add({
                            title:"Failed! Can't delete logo",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-delete-logo").removeAttr('disabled');
                        $("#button-delete-logo").html('Delete');
                        $.gritter.add({
                            title:"Error! Can't delete logo",
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
