<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	require_once "include/global-function.php";//all data
	$selected_media = $_POST['media'];
	$media_name  = explode(',', $selected_media);
    $o_get_media = new Media($pdo);

    if(isset($selected_media)) {
?>
	<div class="row">
		<?php
            foreach($media_name as $data) {
            	$v_get_media = $o_get_media->view_selected_media_data($data);
        ?>
		<div class="col-md-1">   
	        <div class="nailthumb-container selected-square-thumb selected-media-image">
	            <img style="width:100%" src="<?php echo MURL."/cr-editor/images/".$v_get_media->cr_mediaName ?>">
	        </div>
		</div>
		<?php } ?>
	</div>
<?php
	}
	else {
		echo 'failed';
	}
?>