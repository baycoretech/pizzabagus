<?php
    $o_get_banner  = new Banner($pdo);
    $v_get_banner  = $o_get_banner->view_banner();
?>
<p>
	<button type="button" class="btn btn-success m-b-5" 
        <?php 
            if($v_getUserPlan->cr_settingValue=="basic") { 
                if($v_getDiskSizeBytes>=523239424) { 
                    echo ""; 
                } 
                else { 
        ?> onclick="location.href='<?php echo MADMINURL; ?>/banner/add'" 
        <?php 
                }
            }
            elseif($v_getUserPlan->cr_settingValue=="premium" || $v_getUserPlan->cr_settingValue=="probasic" || $v_getUserPlan->cr_settingValue=="propro" || $v_getUserPlan->cr_settingValue=="prosuper") {  
        ?>
            onclick="location.href='<?php echo MADMINURL; ?>/banner/add'" 
        <?php 
            }
        ?>
        <?php 
            if($v_getUserPlan->cr_settingValue=="basic") { 
                if($v_getDiskSizeBytes>=523239424) 
                    echo "disabled"; 
            } 
        ?>>Add Banner</button>
        <button type="button" class="btn btn-warning m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/banner/reorder'">Reorder Banner</button>
</p>
<?php
	if($v_get_banner == 0) {
?>
		<div class="alert alert-info fade in m-b-15">
			<strong>Empty!</strong>
			No banner data found.
			<span class="close" data-dismiss="alert">×</span>
		</div>
<?php
	}
	else {
?>
<div class="alert alert-info fade in m-b-15">
    Please use image with same dimension each other.
</div>
<div class="superbox">
			<?php
				foreach($v_get_banner as $data) {
					$banner_date = date($v_getDateFormat->cr_settingValue." ".$v_getTimeFormat->cr_settingValue, strtotime($data->cr_bannerDate));
					$banner_image = MURL."/cr-editor/images/".$data->cr_bannerImage;
                    list($image_width, $image_height) = getimagesize($banner_image);
			?>
			    <div class="superbox-list nailthumb-container square-thumb">
					<img src="<?php echo $banner_image ?>" data-img="<?php echo $banner_image ?>" alt="" title="" data-bannerid="<?php echo $data->cr_bannerID ?>" data-link="<?php echo $data->cr_bannerLink ?>" data-width="<?php echo $image_width ?>" data-height="<?php echo $image_height ?>" data-bannerdate="<?php echo $banner_date ?>" data-bannerauthor="<?php if($data->cr_adminID == $cradminID_session) echo "you"; else echo $data->cr_adminDisplayName ?>" class="superbox-img"/>
				</div>
			<?php
				}
			?>	
</div>
<!-- end superbox -->
<?php
        foreach($v_get_banner as $data) {
?>
<!-- #delete-dialog -->
<div class="modal fade" id="delete-dialog-<?php echo $data->cr_bannerID ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this banner?</p>
                <?php
                    if (isset ($_POST['hapus'])) {
                        $banner_id      = $_POST['banner_id'];
                        $admin_login_id = $_POST['admin_login_id'];
                        $v_del_banner   = $o_get_banner->delete_banner($banner_id, $admin_login_id);
                            header("Location: $madinurl/banner"); 
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="banner_id" value="<?php echo $data->cr_bannerID ?>" id="delete">
                    <input type="hidden" name="admin_login_id" value="<?php echo $cradminID_session ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
        }
    }
?>
<link href="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL; ?>/assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        var thumbnail_width = $('.square-thumb').width();
        $('.square-thumb').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();
	});
</script>