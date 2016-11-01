<?php
    $function_view_favicon = $class_appearance->view_favicon();
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
                <h4 class="panel-title">Current Favicon</h4>
            </div>
            <?php
                if($function_view_favicon == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    You have no favicon.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
            <?php
                $image = $function_view_favicon->cr_settingValue;
            ?>
                <img src="<?php echo MURL.'cr-editor/_thumbs/Images/'.$image ?>" alt="Website Favicon" width="64">
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
                    if($function_view_favicon == false) {
                ?>
                <button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => 'favicon', 'action' => 'add')) ?>'">
                    <i class="fa fa-plus fa-2x pull-left"></i>
                    <span class="f-w-700">Add Favicon</span><br>
                    <small>Add New Favicon</small>
                </button>
                <?php
                    }
                    else {
                ?>
                <button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => 'favicon', 'action' => 'edit', 'id' => $function_view_logo->cr_settingID)) ?>'">
                    <i class="fa fa-pencil-square-o fa-2x pull-left"></i>
                    <span class="f-w-700">Edit Favicon</span><br>
                    <small>Edit Existing Favicon</small>
                </button>   
                <button id="delete-button" class="btn btn-lg btn-danger btn-block" data-target="#delete-dialog" data-toggle="modal">
                    <i class="fa fa-times fa-2x pull-left"></i>
                    <span class="f-w-700">Delete Favicon</span><br>
                    <small>Delete Existing Favicon</small>
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
                            Favicon is an icon associated with a particular website, usually displayed beside the URL in a web browser.
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
                            There are one button above, <strong class="text-success">Add Favicon</strong>. Click <strong class="text-success">Add Favicon</strong> to add new favicon. If you have favicon already, there will be two buttons. You can edit existing favicon by clicking <strong class="text-success">Edit Favicon</strong>, and delete favicon by clicking <strong class="text-danger">Delete Favicon</strong>.
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
                <p>Are you sure want to delete current favicon?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-favicon" type="button" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $.gritter.add({
            title:"Creatify Tips",
            text:"Upload your favicon if you want your website title looks nice.",
            image:"<?php echo MADMINURL.'/assets/img/cr.png'; ?>",
            sticky:true,
            time:""
        });
        $('#button-delete-favicon').click(function() {
            $.ajax({
                url: "<?php echo MADMINURL ?>ajax/favicon-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-favicon").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-favicon").attr('disabled','disabled');},
                success: function (msg){
                    if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Favicon has been deleted",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-edit-menu').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-delete-favicon").removeAttr('disabled');
                        $("#button-delete-favicon").html('Delete');
                        $.gritter.add({
                            title:"Failed! Can't delete favicon",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-delete-favicon").removeAttr('disabled');
                        $("#button-delete-favicon").html('Delete');
                        $.gritter.add({
                            title:"Error! Can't delete favicon",
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