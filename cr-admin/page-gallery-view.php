<?php
    $class_gallery  = new Gallery($pdo);
    $function_view_gallery  = $class_gallery->view_gallery($action);
?>
<p>
	<button type="button" class="btn btn-success m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add')) ?>'"><i class="fa fa-plus"></i> Add Picture</button>
    <button type="button" class="btn btn-warning m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'reorder')) ?>'"><i class="fa fa-reorder"></i> Reorder Gallery</button>
    <button type="button" class="btn btn-info m-b-5" data-toggle="modal" data-target="#modal-permalink" data-permalink="<?php echo MURL.$action ?>"><i class="fa fa-link"></i> View Permalink</button>
</p>
<?php
	if($function_view_gallery == false) {
?>
	<div class="alert alert-info fade in m-b-15">
		<strong>Empty!</strong>
		No gallery data found.
		<span class="close" data-dismiss="alert">×</span>
	</div>
<?php
	}
	else {
?>
<div class="superbox">
	<?php
		foreach($function_view_gallery as $data) {
			$gallery_date = date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($data->cr_galleryDate));
			$gallery_image = MURL."cr-editor/images/".$data->cr_galleryThumb;
	?>
	    <div class="superbox-list nailthumb-container square-thumb">
			<img src="<?php echo $gallery_image ?>" data-img="<?php echo $gallery_image ?>" alt="<?php if($data->cr_galleryDesc=="") echo "No Description"; else echo $data->cr_galleryDesc ?>" title="<?php echo $data->cr_galleryTitle ?>" data-galid="<?php echo $data->cr_galleryID ?>" data-galdate="<?php echo $galleryDate ?>" data-galauthor="<?php if($data->cr_adminID == $admin_id_session) echo "you"; else echo $data->cr_adminDisplayName ?>" class="superbox-img"/>
		</div>
	<?php
		}
	?>	
</div>

<div class="modal fade" id="modal-delete-gallery">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <form id="form-delete-gallery" action="" method="post">
                    <input type="hidden" name="gallery_id" value="">
                    <input type="hidden" name="link" value="<?php echo $action ?>">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-delete-gallery" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>
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
                <button type="submit" class="btn btn-success" onclick="window.open('<?php echo $router->generate('specific-page', array('page' => $action)) ?>', '_blank');">View Page</button>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        var thumbnail_width = $('.square-thumb').width();
        $('.square-thumb').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();

        <?php if($function_view_gallery != false) { ?>
	    $('#modal-delete-gallery').on('show.bs.modal', function(e) {
	        $(this).find('input[name=gallery_id]').attr('value', $(e.relatedTarget).data('hapus'));
	        $(this).find('#dn').html($(e.relatedTarget).data('dn'));
	    });

        var delete_gallery;
        $("#form-delete-gallery").submit(function(event){
            if (delete_gallery) {
                delete_gallery.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var gallery_name = $("#modal-delete-gallery").find("#dn").html();
            var serializedData = $form.serialize();
            delete_gallery = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/gallery-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-gallery").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-gallery").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_gallery.done(function (msg){
                if(msg == 'gallery-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-gallery").removeAttr('disabled');
                    $("#button-delete-gallery").html('<i class="fa fa-times"></i> Delete');
                    $.gritter.add({
                        title:"Failed! Gallery is required",
                        text:"Can't delete "+gallery_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:gallery_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-gallery').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => $id)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-gallery").removeAttr('disabled');
                    $("#button-delete-gallery").html('<i class="fa fa-times"></i> Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+gallery_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-gallery").removeAttr('disabled');
                    $("#button-delete-gallery").html('<i class="fa fa-times"></i> Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+gallery_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_gallery.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
        <?php } ?>

        $('#modal-permalink').on('show.bs.modal', function(e) {
            $(this).find('#permalink-view').html($(e.relatedTarget).data('permalink'));
        });
	});
</script>