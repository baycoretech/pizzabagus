<?php
	$view_page_general = $class_page->view_page_general($page);
	$image         = $view_page_general->cr_generalFeaturedImage;
	
	if(!isset($lang)) {
		if($view_page_general->cr_generalTitle == '' || empty($view_page_general->cr_generalTitle))
			$page_general_title = $page_title;
		else 
			$page_general_title =  $view_page_general->cr_generalTitle;
        $column1       = $view_page_general->cr_generalColumn1;
		$column2       = $view_page_general->cr_generalColumn2;
		$column3       = $view_page_general->cr_generalColumn3;
    }
    else {
        if($lang == $default_language->cr_languageCode) {
        	if($view_page_general->cr_generalTitle == '' || empty($view_page_general->cr_generalTitle))
				$page_general_title = $page_title;
			else 
				$page_general_title =  $view_page_general->cr_generalTitle;
            $column1       = $view_page_general->cr_generalColumn1;
			$column2       = $view_page_general->cr_generalColumn2;
			$column3       = $view_page_general->cr_generalColumn3;
        }
        else {
        	if($view_page_general->cr_generalTitle == '' || empty($view_page_general->cr_generalTitle))
				$page_general_title = $page_title;
			else 
				$page_general_title =  $view_page_general->cr_generalTitle_id;
            $column1       = $view_page_general->cr_generalColumn1_id;
			$column2       = $view_page_general->cr_generalColumn2_id;
			$column3       = $view_page_general->cr_generalColumn3_id;
        }
    }
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-title">
				<?php 
					echo $page_general_title;
				?>
			</h1>
			<div class="page-title-border-left"></div>
			<div class="page-title-border-right"></div>
		</div>

		<div class="col-md-12">
		<?php
			if($view_page_general == false) {
		?>
			<div class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<strong>Empty!</strong> There is no data found for this page.
			</div>
		<?php
			}
			else {
		?>
			<div class="row">
				<?php
					if($page_column == 1) {
				?>
				<div id="general-content-1" class="col-md-12">
					<?php echo $column1 ?>
				</div>
				<?php
					}
					elseif($page_column == 2) {
				?>
				<div id="general-content-1" class="col-md-6">
					<?php echo $column1 ?>
				</div>
				<div id="general-content-2" class="col-md-6">
					<?php echo $column2 ?>
				</div>
				<?php
					}
					elseif($page_column == 3) {
				?>
				<div id="general-content-1" class="col-md-4">
					<?php echo $column1 ?>
				</div>
				<div id="general-content-2" class="col-md-4">
					<?php echo $column2 ?>
				</div>
				<div id="general-content-3" class="col-md-4">
					<?php echo $column3 ?>
				</div>
				<?php } ?>
			</div>	
		<?php } ?>

		</div>
	</div>
</div>