<?php
	$class_page         = new Page($pdo);
    $function_view_page = $class_page->view_page($page);
    if($page == 'profile')
    	$page_title = 'Profile';
    elseif($page == 'my-order')
    	$page_title = 'My Order';
    elseif($page == 'checkout')
        $page_title = 'Checkout';
    elseif($page == 'checkout-review')
        $page_title = 'Checkout Review';
    elseif($page == 'invoice')
        $page_title = 'Invoice';
    else {
        if(!isset($lang)) {
            $page_title     = $class_page->view_page_title($page);
        }
        else {
            if($lang == $default_language->cr_languageCode) {
                $page_title     = $class_page->view_page_title($page);
            }
            else {
                $page_title     = $class_page->view_page_title_id($page);
            }
        }
    }
    $page_type_id       = $function_view_page->cr_pagetemplateID;//GET PAGE TEMPLATE ID
    $page_type_name     = $function_view_page->cr_pagetemplateName;//GET PAGE TEMPLATE ID
    $page_type          = $function_view_page->cr_pagetemplateType;//CHECK PAGE TEMPLATE TYPE
    $gallery_on         = $function_view_page->cr_option;//CHECK GALLERY IS ON OR OFF
    $page_column        = $function_view_page->cr_pagetemplateColumn;//CHECK COLUMN OF PAGE
?>