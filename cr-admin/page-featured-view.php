<?php
	$function_view_page_featured = $class_page->view_page_featured($action);
    $featured_id    = $function_view_page_featured->cr_featuredID;
    $featured_desc  = $function_view_page_featured->cr_featuredDesc;
    $featured_image = $function_view_page_featured->cr_featuredImage;

    if($page_type == 'spa') {
        $class_spa  = new Featured_Spa($pdo);
        $function_view = $class_spa->view_featured_spa();
    }
    elseif($page_type == 'tour') {
        $class_tour  = new Featured_Tours($pdo);
        $function_view = $class_tour->view_featured_tours();
    }
    elseif($page_type == 'adventure') {
        $class_adventure  = new Featured_Adventure($pdo);
        $function_view = $class_adventure->view_featured_adventure();
    }
    elseif($page_type == 'car-rental') {
        $class_car_rental  = new Featured_Car_Rental($pdo);
        $function_view = $class_car_rental->view_featured_car_rental();
    }
?>
<div class="row">
	<!-- begin col-3 -->
		<div class="col-md-3">
			<!-- begin panel -->
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
                                <li><i class="fa-li fa fa-dot-circle-o"></i><a href="#" data-toggle="modal" data-target="#permalink-modal" data-permalink="<?php echo MURL.$action.'/' ?>">View Permalink</a></li>
		                        <?php
		                            if(count($function_view) == 0) {
		                        ?>
		                        <li><i class="fa-li fa fa-dot-circle-o"></i>You have not entered spa package on this page.</li>
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
                                if($featured_image == '' || empty($featured_image)) {
                            ?>
                            No Featured Image.
                            <?php
                                }
                                else {
                            ?>
                            <img width="100%" src="<?php echo MURL.'cr-editor/images/'.$featured_image ?>" alt="Featured Image">
                            <button id="removefi" class="btn btn-danger btn-block m-t-10" data-pageid="<?php echo $featured_id ?>">Remove Image</button>
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
						if($function_view_page_featured == false) {
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
					<button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'edit', 'extra' => $featured_id)) ?>'">
						<i class="fa fa-pencil fa-2x pull-left"></i>
						<span class="f-w-700">Edit Data</span><br>
						<small>Edit Data Page</small>
					</button>
					<?php } ?>
				    </p>
				</div>
			</div>
			<!-- end panel -->
		</div>
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
                    <h4 class="panel-title">Content</h4>
                </div>
                <?php
                    if($function_view_page_featured == false) {
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
					<?php if($featured_desc == '' || $featured_desc == NULL) echo 'Empty description'; else echo $featured_desc ?>
                </div>
                <?php } ?>
            </div>
			<!-- end panel -->
		</div>
		<!-- end col-9 -->
</div>
<div class="modal fade" id="permalink-modal">
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
                <button type="submit" class="btn btn-success" onclick="window.open('<?php echo MURL.$action.'/' ?>', '_blank');">View Page</button>
            </div>
        </div>
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
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <form action="" method="post">
                    <input type="hidden" name="userID" value="" id="delete">
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
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
        $('#permalink-modal').on('show.bs.modal', function(e) {
            $(this).find('#permalink-view').html($(e.relatedTarget).data('permalink'));
        });
        $('#removefi').click(function() {
            var pageid     = $("#removefi").attr("data-pageid");
            var dataString = 'pageid='+pageid;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/featured-image-delete.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $("#removefi").html('<i class="fa fa-spinner fa-pulse"></i> Removing Image...');},
                success: function(data){
                    if(data!="failed") {
                        $.gritter.add({
                            title:"Success!",
                            text:"Featured image has been deleted.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo MADMINURL.'/page/'.$title ?>";
                        }, 2000);
                    }
                    else {
                        ("#removefi").html('Remove Image');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't delete featured image. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
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