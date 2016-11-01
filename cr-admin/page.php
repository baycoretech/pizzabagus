<?php
	$class_page = new Page($pdo);
    $function_view_page  = $class_page->view_page($action);
    $page_type   = $function_view_page->cr_pagetemplateType;
    $gallery_on  = $function_view_page->cr_option;
    $page_column = $function_view_page->cr_pagetemplateColumn;

    $class_blog  = new Blog($pdo);
    $function_check_blog_type = $class_blog->check_blog_type($extra);
    $blog_type   = $function_check_blog_type->cr_blogtypeName;

    if($page_type == 'general') {
        if($gallery_on == "contact") {
            if($id == 'add') {
                require "page-contact-add.php";
            }
            elseif($id == "edit") {
                require "page-contact-edit.php";
            }
            else
               require "page-contact-view.php";
        }
        else {
            if($id == 'add') {
                require 'page-general-add.php';
            }
            elseif($id == "edit") {
                require 'page-general-edit.php';
            }
            else
        	   require "page-general-view.php";
        }
    }
    elseif($page_type == 'portfolio') {
        if($gallery_on == "gallery") {
            if($id == 'add') {
                if($check_plan == 'allow')
                    require 'page-gallery-add.php';
                else 
                    header("Location: $forbidden_header");
            }
            elseif($id == "edit") {
                if($check_plan == 'allow')
                    require 'page-gallery-edit.php';
                else 
                    header("Location: $forbidden_header");
            }
            elseif($id == 'reorder') {
                require 'page-gallery-reorder.php';
            }
            else
               require "page-gallery-view.php";
        }
        else {
            if($id == 'add') {
                if($check_plan == 'allow')
                    require 'page-portfolio-items-add.php';
                else 
                    header("Location: $forbidden_header");
            }
            elseif($id == "edit") {
                if($check_plan == 'allow')
                    require 'page-portfolio-items-edit.php';
                else 
                    header("Location: $forbidden_header");
            }
            elseif($id == "extra") {
                if($check_plan == 'allow')
                    require 'page-portfolio-items-extra.php';
                else 
                    header("Location: $forbidden_header");
            }
            elseif($id == "view" || $id == "view-name-asc" || $id == "view-name-desc" || $id == "view-date-asc") {
                require "page-portfolio-items-view.php";
            }
            else
        	   require "page-portfolio-view.php";
        }
    }
    elseif($page_type == 'menu') {
        if($id == 'add') {
            if($check_plan == 'allow')
                require 'page-menu-items-add.php';
            else 
                header("Location: $forbidden_header");
        }
        elseif($id == "edit") {
            if($check_plan == 'allow')
                require 'page-menu-items-edit.php';
            else 
                header("Location: $forbidden_header");
        }
        elseif($id == "view" || $id == "view-name-asc" || $id == "view-name-desc" || $id == "view-date-asc") {
            require "page-menu-items-view.php";
        }
        else
           require "page-menu-view.php";
    }
    elseif($page_type == 'blog') {
        if($id == 'add-standard') {
            require 'page-blog-post-add-standard.php';
        }
        elseif($id == 'add-image') {
            if($check_plan == 'allow')
                require 'page-blog-post-add-image.php';
            else 
                header("Location: $forbidden_header");
        }
        elseif($id == 'add-video') {
            require 'page-blog-post-add-video.php';
        }
        elseif($id == 'add-sound') {
            require 'page-blog-post-add-sound.php';
        }
        elseif($id == "edit") {
            if($blog_type == "standard") {
                require 'page-blog-post-edit-standard.php';
            }
            elseif($blog_type == "image") {
                require 'page-blog-post-edit-image.php';
            }
            elseif($blog_type == "video") {
                require 'page-blog-post-edit-video.php';
            }
            elseif($blog_type == "sound") {
                require 'page-blog-post-edit-sound.php';     
            }
        }
        elseif($id == "type") {
            require "page-blog-post-type.php";
        }
        elseif($id == "comment") {
            require "page-blog-post-comment.php";
        }
        elseif($id == "view" || $id == "view-name-asc" || $id == "view-name-desc" || $id == "view-date-asc") {
            require "page-blog-post-view.php";
        }
        else
    	   require "page-blog-view.php";
    }
?>