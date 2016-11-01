<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    if($meta_keywords == '' || empty($meta_keywords)) {
                        echo $function_metak->cr_settingValue;
                    }
                    else {
                        echo $meta_keywords;
                    }
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $function_metak->cr_settingValue;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $function_metak->cr_settingValue;
                                }
                                else {
                                    echo $function_metak->cr_settingValue;
                                }
                            }
                            else {
                                if($meta_keywords == '' || empty($meta_keywords)) {
                                    echo $function_metak->cr_settingValue;
                                }
                                else {
                                    echo $meta_keywords;
                                }
                            }
                        }
                        else {
                            echo $function_metak->cr_settingValue;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $function_metak->cr_settingValue;
                        }
                        else {
                            if($meta_keywords == '' || empty($meta_keywords)) {
                                echo $function_metak->cr_settingValue;
                            }
                            else {
                                echo $meta_keywords;
                            }
                        }
                    }
                    else {
                        echo $function_metak->cr_settingValue;
                    }
                }
            }
            else {
                echo $function_metak->cr_settingValue;
            } ?>">
    <meta name="description" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    if($meta_description == '' || empty($meta_description)) {
                        echo $function_metad->cr_settingValue;
                    }
                    else {
                        echo $meta_description;
                    }
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $function_metad->cr_settingValue;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $function_metad->cr_settingValue;
                                }
                                else {
                                    echo $function_metad->cr_settingValue;
                                }
                            }
                            else {
                                if($meta_description == '' || empty($meta_description)) {
                                    echo $function_metad->cr_settingValue;
                                }
                                else {
                                    echo $meta_description;
                                }
                            }
                        }
                        else {
                            echo $function_metad->cr_settingValue;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $function_metad->cr_settingValue;
                        }
                        else {
                            if($meta_description == '' || empty($meta_description)) {
                                echo $function_metad->cr_settingValue;
                            }
                            else {
                                echo $meta_description;
                            }
                        }
                    }
                    else {
                        echo $function_metad->cr_settingValue;
                    }
                }
            }
            else {
                echo $function_metad->cr_settingValue;
            } ?>">
    <meta name="author" content="<?php echo $function_sitename->cr_settingValue ?>">
    <meta property="og:locale" content="en_US">
    <meta property="og:title" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    echo $page_title;
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $page_title;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $page_title;
                                }
                                else {
                                    echo $page_title;
                                }
                            }
                            else {
                                echo $portfolio_detail->cr_portfolioTitle;
                            }
                        }
                        else {
                            echo $page_title;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $page_title;
                        }
                        else {
                            echo $blog_detail->cr_blogTitle;
                        }
                    }
                    else {
                        echo $page_title;
                    }
                }
            }
            else {
                echo $function_sitename->cr_settingValue;
            }
            if($function_tagline->cr_settingValue == "" || empty($function_tagline->cr_settingValue)) echo ""; else echo " | ".$function_tagline->cr_settingValue; ?>">
    <meta property="og:type" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    echo 'website';
                }
                elseif($page_type == 'portfolio') {
                    echo 'article';
                }
                elseif($page_type == 'blog') {
                    echo 'blog';
                }
            }
            else {
                echo 'website';
            } ?>">
    <meta property="og:image" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    if($page_general_fi == '' || empty($page_general_fi)) {
                        echo $image_path;
                    }
                    else {
                        echo MURL.'cr-editor/images/'.$page_general_fi;
                    }
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo MURL.'cr-editor/images/'.$random_gallery_image->cr_galleryThumb;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $image_path;
                                }
                                else {
                                    echo $image_path;
                                }
                            }
                            else {
                                echo MURL.$portfolio_detail->cr_portfolioThumb;
                            }
                        }
                        else {
                            echo $image_path;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $image_path;
                        }
                        else {
                            $get_video_id = str_replace("https://www.youtube.com/embed/", "", $blog_detail->cr_blogFeatured);
                            $blog_image  = "https://img.youtube.com/vi/".$get_video_id."/hqdefault.jpg";
                            if($blog_detail->cr_blogtypeID=="1") echo MURL."/cr-include/images/default-post-image.png"; elseif($blog_detail->cr_blogtypeID=="2") echo MURL.$blog_detail->cr_blogFeatured; elseif($blog_detail->cr_blogtypeID=="5") echo $blog_image; elseif($blog_detail->cr_blogtypeID=="6") echo MURL."/cr-include/images/default-post-sound.png";
                        }
                    }
                    else {
                        echo $image_path; 
                    }
                }
            }
            else {
                echo $image_path;
            } ?>">
    <?php 
        if(isset($page)) {
            if($page_type == 'blog' && $blog_detail->cr_blogtypeID == "5") {
    ?>
    <meta property="og:video" content="<?php echo $v_getBlogDetail->cr_blogFeatured ?>" />
    <?php
            }
            else {
                echo '';
            }
        }
        else {
            echo '';
        }
    ?>
    <meta property="og:url" content="<?php echo "http" . (($_SERVER["HTTPS"] == "on") ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:description" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    if($meta_description == '' || empty($meta_description)) {
                        echo $function_metad->cr_settingValue;
                    }
                    else {
                        echo $meta_description;
                    }
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $function_metad->cr_settingValue;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $function_metad->cr_settingValue;
                                }
                                else {
                                    echo $function_metad->cr_settingValue;
                                }
                            }
                            else {
                                if($meta_description == '' || empty($meta_description)) {
                                    echo $function_metad->cr_settingValue;
                                }
                                else {
                                    echo $meta_description;
                                }
                            }
                        }
                        else {
                            echo $function_metad->cr_settingValue;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $function_metad->cr_settingValue;
                        }
                        else {
                            if($meta_description == '' || empty($meta_description)) {
                                echo $function_metad->cr_settingValue;
                            }
                            else {
                                echo $meta_description;
                            }
                        }
                    }
                    else {
                        echo $function_metad->cr_settingValue;
                    }
                }
            }
            else {
                echo $function_metad->cr_settingValue;
            } ?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="<?php echo "http" . (($_SERVER["HTTPS"] == "on") ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta name="twitter:title" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    echo $page_title;
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $page_title;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $page_title;
                                }
                                else {
                                    echo $page_title;
                                }
                            }
                            else {
                                echo $portfolio_detail->cr_portfolioTitle;
                            }
                        }
                        else {
                            echo $page_title;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $page_title;
                        }
                        else {
                            echo $blog_detail->cr_blogTitle;
                        }
                    }
                    else {
                        echo $page_title;
                    }
                }
            }
            else {
                echo $function_sitename->cr_settingValue;
            } ?>">
    <meta name="twitter:description" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    if($meta_description=='' || empty($meta_description)) {
                        echo $function_metad->cr_settingValue;
                    }
                    else {
                        echo $meta_description;
                    }
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $function_metad->cr_settingValue;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $function_metad->cr_settingValue;
                                }
                                else {
                                    echo $function_metad->cr_settingValue;
                                }
                            }
                            else {
                                if($meta_description == '' || empty($meta_description)) {
                                    echo $function_metad->cr_settingValue;
                                }
                                else {
                                    echo $meta_description;
                                }
                            }
                        }
                        else {
                            echo $function_metad->cr_settingValue;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $function_metad->cr_settingValue;
                        }
                        else {
                            if($meta_description == '' || empty($meta_description)) {
                                echo $function_metad->cr_settingValue;
                            }
                            else {
                                echo $meta_description;
                            }
                        }
                    }
                    else {
                        echo $function_metad->cr_settingValue;
                    }
                }
            }
            else {
                echo $function_metad->cr_settingValue;
            } ?>">
    <meta name="twitter:image" content="<?php
            if(isset($page)) {
                if($page_type == 'general') {
                    if($page_general_fi == '' || empty($page_general_fi)) {
                        echo $image_path;
                    }
                    else {
                        echo MURL.$page_general_fi;
                    }
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $random_gallery_image->cr_galleryThumb;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $image_path;
                                }
                                else {
                                    echo $image_path;
                                }
                            }
                            else {
                                echo $portfolio_detail->cr_portfolioThumb;
                            }
                        }
                        else {
                            echo $image_path;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $image_path; 
                        }
                        else {
                            $get_video_id = str_replace("https://www.youtube.com/embed/", "", $blog_detail->cr_blogFeatured);
                            $blog_image  = "https://img.youtube.com/vi/".$getVideoID."/hqdefault.jpg";
                            if($blog_detail->cr_blogtypeID=="1") echo MURL."/cr-include/images/default-post-image.png"; elseif($blog_detail->cr_blogtypeID=="2") echo MURL.$blog_detail->cr_blogFeatured; elseif($blog_detail->cr_blogtypeID=="5") echo $blog_image; elseif($blog_detail->cr_blogtypeID=="6") echo MURL."/cr-include/images/default-post-sound.png";
                        }
                    }
                    else {
                        echo $image_path; 
                    }
                }
            }
            else {
                echo $image_path; 
            } ?>">
    <meta property="og:site_name" content="<?php echo $function_sitename->cr_settingValue; ?>">
    <title><?php
            if(isset($page)) {
                if($page_type == 'general') {
                    echo $page_title;
                }
                elseif($page_type == 'portfolio') {
                    if($gallery_on == "gallery") {
                        echo $page_title;
                    }
                    else {
                        if(isset($id_link)) {
                            if($id_link == "sort") {
                                if(strlen($more_link) == 1) {
                                    echo $page_title;
                                }
                                else {
                                    echo $page_title;
                                }
                            }
                            else {
                                echo $portfolio_detail->cr_portfolioTitle;
                            }
                        }
                        else {
                            echo $page_title;
                        }
                    }
                }
                elseif($page_type == 'blog') {
                    if(isset($id_link)) {
                        if($id_link == "cat" || $id_link == "page") {
                            echo $page_title;
                        }
                        else {
                            echo $blog_detail->cr_blogTitle;
                        }
                    }
                    else {
                        echo $page_title;
                    }
                }
                elseif($page_type == 'menu') {
                    echo $page_title;
                }
                elseif($page == 'tag') {
                    echo 'Post Tags';
                }
                elseif($page == 'my-order') {
                    echo 'My Order';
                }
                elseif($page == 'checkout') {
                    echo 'Checkout';
                }
                elseif($page == 'checkout-review') {
                    echo 'Checkout Review';
                }
                elseif($page == 'invoice') {
                    echo 'Invoice';
                }
                elseif($page == 'profile') {
                    echo 'Profile';
                }
            }
            else {
                echo $function_sitename->cr_settingValue;
            }
            if($function_tagline->cr_settingValue == "" || empty($function_tagline->cr_settingValue)) echo ""; else echo " | ".$function_tagline->cr_settingValue;
        ?></title>
    <?php
        if($v_get_google_plus->cr_socialLink != '') {
    ?>
    <!-- Google+ Author -->
    <link rel="author" href="<?php echo $v_get_google_plus->cr_socialLink ?>">
    <?php
        }
        if($function_view_default_fonts == false) {
    ?>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <?php
        }
        else { 
            echo $function_view_default_fonts->cr_fontsLink;
        } 
        if($function_view_fonts != false) {
            foreach($function_view_fonts as $font) {
                echo $font->cr_fontsLink;
            }
        }
    ?>
    <link href='https://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Tauri" rel="stylesheet">

    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/css/font-awesome.min.css" rel="stylesheet">

    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/css/animate.css" rel="stylesheet" media="screen" />
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/fotorama/fotorama.css" rel="stylesheet" media="screen" />
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/icheck/skins/all.css" rel="stylesheet" media="screen">
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/parsley/src/parsley.css" rel="stylesheet" media="screen">
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/autocomplete/easy-autocomplete.min.css" rel="stylesheet" media="screen">       
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/autocomplete/easy-autocomplete.themes.min.css" rel="stylesheet" media="screen">   
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" media="screen">    
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" media="screen">   
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/owl-carousel/owl.carousel.css" rel="stylesheet" media="screen">   
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">   
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/css/custom.css" rel="stylesheet" media="screen">
    <link href="<?php echo MURL."cr-editor/css/custom.css" ?>" rel="stylesheet">
    <?php
        if($page == 'invoice') {
    ?>
    <link href="<?php echo MURL."cr-content/themes/".$v_themes?>/css/invoice-print.min.css" rel="stylesheet" media="print">
    <?php } ?>
    <!-- Flag Icon Plugin -->
    <link href="<?php echo MURL ?>cr-include/plugins/flag-icon/css/flag-icon.css" rel="stylesheet" media="screen">   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Favicon -->
    <?php
        if($function_favicon->cr_settingValue != "") {
    ?>
    <link rel="shortcut icon" href="<?php echo MURL.'cr-editor/_thumbs/Images/'.$function_favicon->cr_settingValue ?>">
    <?php
        }
        else {
    ?>
    <link rel="shortcut icon" href="<?php echo MURL.'cr-include/images/favicon.png' ?>">
    <?php } ?>

    <style type="text/css">
    <?php
        if($function_view_default_fonts == false) {
    ?>
        body, h1, h2, h3, h4, h5 {
            font-family: 'Roboto', arial, helvetica, sans-serif!important;
        }
    <?php
        }
        else {
    ?>
        body {
            font-family: <?php echo $function_view_default_fonts->cr_fontsFamily ?>!important;
        }
    <?php
        }
        if($function_view_fonts != false) {
            foreach($function_view_fonts as $font_family) {
                if($font_family->cr_fontsApplied == 'navigation') {
    ?>
        .navbar-default .navbar-nav>li>a {
            font-family: <?php echo $font_family->cr_fontsFamily ?>!important
        }
    <?php
                }
                elseif($font_family->cr_fontsApplied == 'page-heading') {
    ?>
        .page-title {
            font-family: <?php echo $font_family->cr_fontsFamily ?>!important
        }
    <?php
                }
                elseif($font_family->cr_fontsApplied == 'heading') {
    ?>
        h1, h2, h3, h4, h5, .media-heading {
            font-family: <?php echo $font_family->cr_fontsFamily ?>!important
        }
    <?php
                }
                elseif($font_family->cr_fontsApplied == 'content') {
    ?>
        p {
            font-family: <?php echo $font_family->cr_fontsFamily ?>!important
        }
    <?php
                }
            }
        }
        if(isset($page)) {
    ?>
        @media(min-width: 768px) {
            .dropdown-navbar-master {
                top: 70%;
            }
        }
    <?php } ?>
    </style>
</head>