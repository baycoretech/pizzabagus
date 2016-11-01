<?php
    $class_slider  = new Slider_Image($pdo);
    $function_view_slider_image  = $class_slider->view_slider_image();
?>
<p>
	<button type="button" class="btn btn-success m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => 'slider', 'action' => 'add')) ?>'">Add Slider Image</button>
</p>
<?php
	if($function_view_slider_image == false) {
?>
		<div class="alert alert-info fade in m-b-15">
			<strong>Empty!</strong>
			No slider image data found.
			<span class="close" data-dismiss="alert">×</span>
		</div>
<?php
	}
	else {
?>
<div class="superbox">
	<?php
		foreach($function_view_slider_image as $slider) {
            list($width, $height) = getimagesize(MURL."cr-editor/images/".$slider->cr_sliderImage);
	?>
		<div class="superbox-list nailthumb-container square-thumb">
		    <img src="<?php echo MURL."cr-editor/images/".$slider->cr_sliderImage ?>" data-img="<?php echo MURL."cr-editor/images/".$slider->cr_sliderImage ?>" alt="<?php if($slider->cr_sliderDesc == '') echo 'No Description'; else echo $slider->cr_sliderDesc ?>" title="<?php echo $slider->cr_sliderCaption ?>" data-sliderid="<?php echo $slider->cr_sliderID ?>" data-sliderauthor="<?php if($slider->cr_adminID==$cradminID_session) echo "you"; else echo $slider->cr_adminDisplayName ?>" data-sliderwidth="<?php echo $width ?>" data-sliderheight="<?php echo $height ?>" class="superbox-img"/>
				</div>
	<?php
		}
	?>	
</div>
<!-- end superbox -->

<?php
    if($function_view_slider_image != false) {
        foreach($function_view_slider_image as $data) {
?>
<div class="modal fade" id="modal-delete-slider<?php echo $data->cr_sliderID ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this slider image?</p>
                <form id="form-delete-slider<?php echo $data->cr_sliderID ?>" action="" method="post">
                    <input type="hidden" name="slider_id" value="<?php echo $data->cr_sliderID ?>" id="delete<?php echo $data->cr_sliderID ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-slider<?php echo $data->cr_sliderID ?>" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
        }
    }
?>
<link href="<?php echo MADMINURL; ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL; ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        var thumbnail_width = $('.square-thumb').width();
        $('.square-thumb').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();
	    
        <?php
            if($function_view_slider_image != false) {
                foreach($function_view_slider_image as $data) {
        ?>

        var delete_slider_image;
        $("#form-delete-slider<?php echo $data->cr_sliderID ?>").submit(function(event){
            if (delete_slider_image) {
                delete_slider_image.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_slider_image = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/slider-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-slider<?php echo $data->cr_sliderID ?>").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-slider<?php echo $data->cr_sliderID ?>").attr('disabled','disabled');},
                data: serializedData
            });
            delete_slider_image.done(function (msg){
                if(msg == 'slider-empty') {
                    $("#button-delete-slider<?php echo $data->cr_sliderID ?>").removeAttr('disabled');
                    $("#button-delete-slider<?php echo $data->cr_sliderID ?>").html('Delete');
                    $.gritter.add({
                        title:"Failed! Slider image is required",
                        text:"Can't delete slider image. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Slider image has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-slider<?php echo $data->cr_sliderID ?>').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'slider')) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-slider<?php echo $data->cr_sliderID ?>").removeAttr('disabled');
                    $("#button-delete-slider<?php echo $data->cr_sliderID ?>").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete slider image",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-slider<?php echo $data->cr_sliderID ?>").removeAttr('disabled');
                    $("#button-delete-slider<?php echo $data->cr_sliderID ?>").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete slider image",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_slider_image.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  
        <?php
                }
            }
        ?>
	});
</script>
<?php } ?>