<?php
    $o_get_banner  = new Banner($pdo);
    $v_get_banner  = $o_get_banner->view_banner();
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
                <h4 class="panel-title">Banner List</h4>
            </div>
            <div class="panel-body">
		        <div class="gallery-reorder">
		            <p>
		                <a href="<?php echo MADMINURL ?>/banner" type="button" class="btn btn-success m-b-5"> Back</a>
		                <a href="javascript:void(0);" type="button" class="btn btn-warning m-b-5 reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder</a>
		            </p>
		            <div id="reorder-helper" style="display:none;">
		                <div class="alert alert-info fade in m-b-15">
		                    1. Drag image to reorder.<br>2. Click 'Save Reordering' when finished.
		                </div>
		            </div>
		            <ul class="reorder_ul reorder-social-list">
		                <?php
                            $i=1;
	                        foreach ($v_get_banner as $data) {
	                        	$banner_image = MURL."/cr-editor/images/".$data->cr_bannerImage;
	                    ?>
		                <li id="image_li_<?php echo $data->cr_bannerID; ?>" class="ui-sortable-handle col-xs-6 col-md-2">
		                    <a tabindex="0" role="button" href="javascript:void(0);" style="float:none;" class="image_link">
		                        <div class="nailthumb-container get-width" style="width: 100%">
		                        	<img src="<?php echo $banner_image ?>">
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
        </div>
		<!-- end panel -->
	</div>
</div>
<link href="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
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
                if( !$("#save_reorder i").length )
                {
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-social-list").sortable('destroy');
                    $("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Banner</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
        
                    var h = [];
                    $("ul.reorder-social-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo MADMINURL ?>/banner-reorder-ajax.php",
                        data: {ids: " " + h + ""},
                        success: function(html) {
                            window.location="<?php echo MADMINURL ?>/banner";
                        }
                        
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });
    });
</script>
