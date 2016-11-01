<?php
	$function_view_page_general = $class_page->view_page_general($action);
    $featured_image = $function_view_page_general->cr_generalFeaturedImage;
?>
<div class="row">
	<div class="col-md-3">
		<div class="panel-group" id="accordion">
			<div class="panel panel-inverse overflow-hidden">
				<div class="panel-heading">
			    	<h3 class="panel-title">
						<a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
							<i class="fa fa-plus-circle pull-right"></i> 
							Page Information
						</a>
					</h3>
				</div>
				<div style="" aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
					<div class="panel-body">
						<p></p>
						<ul class="fa-ul">
	                        <li><i class="fa-li fa fa-dot-circle-o"></i>This page has <?php if($page_column == 1) echo $page_column.' column'; else echo $page_column.' columns' ?>.</li>
                            <li><i class="fa-li fa fa-dot-circle-o"></i><a href="#" data-toggle="modal" data-target="#modal-permalink" data-permalink="<?php echo MURL.$default_lang_code.'/'.$action ?>">View Permalink</a></li>
	                        <?php
	                            if($function_view_page_general == false) {
	                        ?>
	                        <li><i class="fa-li fa fa-dot-circle-o"></i>You have not entered data on this page.</li>
	                        <?php } ?>
	                    </ul>
					</div>
				</div>
			</div>
			<div class="panel panel-inverse overflow-hidden">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
							<i class="fa fa-plus-circle pull-right"></i> 
							Featured Image
						</a>
					</h3>
				</div>
				<div style="height: 0px;" aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
					<div class="panel-body">
                        <?php
                            if($featured_image == '' || $featured_image == NULL) {
                        ?>
                        No Featured Image.
                        <?php
                            }
                            else {
                        ?>
                        <img width="100%" src="<?php echo MURL.'cr-editor/images/'.$featured_image ?>" alt="Featured Image">
                        <button id="button-remove-image" class="btn btn-danger btn-block m-t-10" data-pageid="<?php echo $function_view_page_general->cr_generalID ?>">Remove Image</button>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
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
				<p class="">
				<?php
					if($function_view_page_general == false) {
				?>
				<button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add')) ?>'">
					<i class="fa fa-plus fa-2x pull-left"></i>
					<span class="f-w-700">Add Data</span><br>
					<small>Add Data to Page</small>
				</button>
				<?php
					}
					else {
				?>
				<button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'edit', 'extra' => $function_view_page_general->cr_generalID)) ?>'">
					<i class="fa fa-pencil fa-2x pull-left"></i>
					<span class="f-w-700">Edit Data</span><br>
					<small>Edit Data Page</small>
				</button>
				<?php } ?>
			    </p>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Content</h4>
            </div>
            <?php
                if($function_view_page_general == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    No data for this page found.
                </p>
            </div> 
            <?php
                }
                else {
            ?>
            <div class="panel-body">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <!-- Tab language panes -->
                <div class="tab-content m-b-0">
                    <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                        <h3><?php echo $function_view_page_general->cr_generalTitle ?></h3>
                        <hr>
                        <div class="row">
                            <?php
                                if($page_column == 1) {
                            ?>
                            <div class="col-md-12">
                                <?php echo $function_view_page_general->cr_generalColumn1 ?>
                            </div>
                            <?php
                                }
                                elseif($page_column == 2) {
                            ?>
                            <div class="col-md-6">
                                <?php echo $function_view_page_general->cr_generalColumn1 ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $function_view_page_general->cr_generalColumn2 ?>
                            </div>
                            <?php
                                }
                                elseif($page_column == 3) {
                            ?>
                            <div class="col-md-4">
                                <?php echo $function_view_page_general->cr_generalColumn1 ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $function_view_page_general->cr_generalColumn2 ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $function_view_page_general->cr_generalColumn3 ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_id">
                        <h3><?php echo $function_view_page_general->cr_generalTitle_id ?></h3>
                        <hr>
                        <div class="row">
                            <?php
                                if($page_column == 1) {
                            ?>
                            <div class="col-md-12">
                                <?php echo $function_view_page_general->cr_generalColumn1_id ?>
                            </div>
                            <?php
                                }
                                elseif($page_column == 2) {
                            ?>
                            <div class="col-md-6">
                                <?php echo $function_view_page_general->cr_generalColumn1_id ?>
                            </div>
                            <div class="col-md-6">
                                <?php echo $function_view_page_general->cr_generalColumn2_id ?>
                            </div>
                            <?php
                                }
                                elseif($page_column == 3) {
                            ?>
                            <div class="col-md-4">
                                <?php echo $function_view_page_general->cr_generalColumn1_id ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $function_view_page_general->cr_generalColumn2_id ?>
                            </div>
                            <div class="col-md-4">
                                <?php echo $function_view_page_general->cr_generalColumn3_id ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
	</div>
</div>
<div class="modal fade" id="modal-permalink">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Permalink</h4>
            </div>
            <div class="modal-body">
                Permalink : <strong id="permalink-view"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="window.open('<?php echo $router->generate('specific-page-lang', array('lang' => $default_lang_code, 'page' => $action)) ?>', '_blank');">View Page</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-page">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <form id="form-delete-page" action="" method="post">
                    <input type="hidden" name="page_id" value="">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-delete-page" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
	$(document).ready(function() {
		$('#modal-delete-page').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
        $('#modal-permalink').on('show.bs.modal', function(e) {
            $(this).find('#permalink-view').html($(e.relatedTarget).data('permalink'));
        });
        $('#button-remove-image').click(function() {
            var pageid     = $(this).data("pageid");
            var dataString = 'page_id='+pageid;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/page-general-delete-featured-image.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $('#button-remove-image').html('<i class="fa fa-spinner fa-pulse"></i> Removing Image...');$('#button-remove-image').attr('disabled','disabled')},
                success: function(msg){
                    if(msg == 'page-empty') {
                        $('#button-remove-image').removeAttr('disabled');
                        $('#button-remove-image').html('Remove Image');
                        $.gritter.add({
                            title:"Failed! Page is required",
                            text:"Can't remove featured image. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Featured image has been removed",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $('#button-remove-image').removeAttr('disabled');
                        $('#button-remove-image').html('Remove Image');
                        $.gritter.add({
                            title:"Failed! Can't delete featured image",
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
                            title:"Error! Can't delete featured image",
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