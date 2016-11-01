<?php
    //Logo
    $function_view_logo = $class_appearance->view_logo();
    $logo_image = $function_view_logo->cr_settingValue;
    //change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
    $logo_image_gif  = str_replace(".png",".gif",$logo_image);
    $logo_image_jpg  = str_replace(".png",".jpg",$logo_image);
    $logo_image_jpeg = str_replace(".png",".jpeg",$logo_image);
    //remove "/thumbnails" to get the real image
    $logo_image_nt     = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image;
    $logo_image_gif_nt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image_gif;
    $logo_image_jpg_nt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image_jpg;
    $logo_image_jpeg_nt = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image_jpeg;

    $logo_image_link     = MURL.'cr-editor/images/'.$logo_image;
    $logo_image_gif_link  = MURL.'cr-editor/images/'.$logo_image_gif;
    $logo_image_jpg_link  = MURL.'cr-editor/images/'.$logo_image_jpg;
    $logo_image_jpeg_link = MURL.'cr-editor/images/'.$logo_image_jpeg;

    if(file_exists($logo_image_nt)) { 
        $image_path =  $logo_image_link; 
    } 
    elseif(file_exists($logo_image_gif_nt)) { 
        $image_path =  $logo_image_gif_link; 
    } 
    elseif(file_exists($logo_image_jpg_nt)) {
        $image_path =  $logo_image_jpg_link; 
    } 
    elseif(file_exists($logo_image_jpeg_nt)) { 
        $image_path =  $logo_image_jpeg_link; 
    } 

    $function_view_fonts = $class_appearance->view_fonts();
    $function_view_default_fonts = $class_appearance->view_default_font();
?>