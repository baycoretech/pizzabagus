<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$selected_media = $_POST['media'];
	$media_name  = explode(',', $selected_media);
    $class_media = new Media($pdo);

    if(isset($selected_media)) {
        foreach($media_name as $media) {
        	$function_selected_media = $class_media->view_selected_media_data($media);
    ?>
	<div class="col-md-1">   
        <div class="nailthumb-container selected-square-thumb selected-media-image">
            <img style="width:100%" src="<?php echo MURL."/cr-editor/images/".$function_selected_media->cr_mediaName ?>">
        </div>
	</div>
<?php
		} 
	}
	else {
		echo 'failed';
	}
?>