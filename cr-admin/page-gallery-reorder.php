<?php
    $class_gallery  = new Gallery($pdo);
    $function_view_gallery  = $class_gallery->view_gallery($action);
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Gallery Reordering</h4>
            </div>
            <div class="panel-body">
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
                <div class="gallery-reorder">
                    <p>
                        <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>" type="button" class="btn btn-success m-b-5"><i class="fa fa-arrow-left"></i></a>
                        <a href="javascript:void(0);" type="button" class="btn btn-warning m-b-5 reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder Gallery</a>
                    </p>
                    <div id="reorder-helper" style="display:none;">
                        <div class="alert alert-info fade in m-b-15">
                            1. Drag image to reorder.<br>2. Click 'Save Reordering' when finished.
                        </div>
                    </div>

                    <div class="row">
                        <ul class="reorder_ul reorder-social-list">
                        	<?php
                                $i=1;
                                foreach ($function_view_gallery as $data) {
                                    $gallery_id    = $data->cr_galleryID;
                                    $gallery_image = MURL."cr-editor/images/".$data->cr_galleryThumb;
                            ?>
                        		<li id="image_li_<?php echo $gallery_id; ?>" class="ui-sortable-handle col-xs-6 col-md-2">
                        			<a tabindex="0" role="button" data-trigger="hover focus" href="javascript:void(0);" style="float:none;" class="image_link" data-toggle="popover" data-container="body" title="<?php echo $data->cr_galleryTitle ?>" data-placement="bottom" data-content="<?php echo $data->cr_galleryDesc ?>">
                        				<div class="nailthumb-container get-width" style="width: 100%">
                                            <img src="<?php echo $gallery_image ?>">
                                        </div>
                        			</a>
                        		</li>
                        	<?php
                                    $i++;
                        		}
                        	?>
                        </ul>
                    </div>
                </div>
                <?php
                	}
                ?>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var thumbnail_width = $('.get-width').width();
        $('.get-width').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();

        $('.reorder_link').on('click',function(){
            $("ul.reorder-social-list").sortable({ tolerance: 'pointer' });
            $('.reorder_link').html('Save Reordering');
            $('.reorder_link').attr("id","save_reorder");
            $('#reorder-helper').slideDown('slow');
            $('.image_link').attr("href","javascript:void(0);");
            $('.image_link').css("cursor","move");
            $("#save_reorder").click(function( e ){
                if( !$("#save_reorder i").length ) {
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-social-list").sortable('destroy');
                    $("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Gallery</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
        
                    var h = [];
                    $("ul.reorder-social-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo MADMINURL ?>ajax/gallery-reorder.php",
                        data: {ids: " " + h + ""},
                        success: function(data) {
                            if(data == 'false') {
                                $("#save_reorder").removeAttr('disabled');
                                $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Gallery');
                                $.gritter.add({
                                    title:"Failed! Can't reorder gallery",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $.gritter.add({
                                    title:"Success!",
                                    text:"Gallery has been reordered.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            }
                        }
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });
    });
</script>