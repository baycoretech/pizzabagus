<?php
	$class_meta           = new Meta($pdo);
	$meta_keywords        = $class_meta->view_metakeywords($page, $id_link);
	$meta_description     = $class_meta->view_metadescription($page, $id_link);
	$random_gallery_image = $class_meta->view_random_gallery_image($page);
?>