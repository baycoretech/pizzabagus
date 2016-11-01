<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    require __DIR__.'/cr-include/error-report.php';
    require __DIR__.'/cr-include/database/connection.php';
    require __DIR__.'/cr-include/autoloader.php'; 

    $class_get_database = new Get_Database($pdo);
    $function_get_db    = $class_get_database->get_db();
    //check if admin is exist, redirect to index.php, if not, redirect to setup page
    if($function_get_db == '') {
        header('location: setup-page.php'); 
    }
    else {
        //save visitor ip
        $o_general_setting = new General_Setting($pdo);
        //Set timezone
        $v_set_timezone           = $o_general_setting->set_timezone();
        $get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
        if(!empty($v_set_timezone->cr_settingValue)) {
            date_default_timezone_set($get_timezone_city);
        }
        $date_for_now = new DateTime();
        $date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
        $now_date     = $date_for_now->format('Y-m-d H:i:s');
        //Same format as NOW(), use to save datetime value to database, without timezone, that will be diffrent datetime insert in database
        $visitor_ip        = get_real_ip();
        $visitor_browser   = get_visitor_browser();
        $v_save_visitor_ip = $o_general_setting->save_visitor($visitor_ip, $visitor_browser['name'], $visitor_browser['platform'], $now_date);

        //set timezone
        $get_city          = substr($v_set_timezone->cr_settingValue, 12);
        $get_plus_minus    = substr($v_set_timezone->cr_settingValue, 4,3);
        $get_comma         = substr($v_set_timezone->cr_settingValue, 8,2);
        if($get_comma == 30) {
            $timezone_comma = ".5";
        }
        elseif($get_comma == 45) {
            $timezone_comma = ".75";
        }
        elseif($get_comma == 00) {
            $timezone_comma = "";
        }
        if(strpos($get_plus_minus,'0') !== false) {
            if($get_plus_minus == 10) {
                $final_timezone = $get_plus_minus;
            }
            elseif($get_plus_minus==00) {
                $final_timezone = 0;
            }
            else {
                $final_timezone = str_replace('0','',$get_plus_minus).$timezone_comma;
            }
        }
        else {
            $final_timezone = $get_plus_minus.$timezone_comma;
        }
        if(!empty($v_set_timezone->cr_settingValue)) {
            date_default_timezone_set($get_city);
        }

        $class_settings       = new Settings($pdo);
        $function_sitename    = $class_settings->view_settings_sitename();
        $function_tagline     = $class_settings->view_settings_tagline();
        $function_metak       = $class_settings->view_settings_metakeywords();
        $function_metad       = $class_settings->view_settings_metadesc();
        $function_maintenance = $class_settings->view_settings_date_time_maintenance();
        $function_maintenance = $class_settings->view_settings_date_time_maintenance();
        $function_bg_login    = $class_settings->view_settings_background_login();
        $function_favicon     = $class_settings->view_settings_favicon();

        //LOGO
        $class_appearance   = new Appearance($pdo);
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
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6 ie-lt10 ie-lt9 ie-lt8 ie-lt7 no-js" lang="en"><![endif]-->
<!--[if IE 7 ]><html class="ie ie7 ie-lt10 ie-lt9 ie-lt8 no-js" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8 ie-lt10 ie-lt9 no-js" lang="en"><![endif]-->
<!--[if IE 9 ]><html class="ie ie9 ie-lt10 no-js" lang="en"><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
  <title>Under Maintenance | <?php echo $function_sitename->cr_settingValue ?></title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keyword" content="<?php echo $function_metak->cr_settingValue ?>">
  <meta name="description" content="<?php echo $function_metad->cr_settingValue ?>">
  <meta name="author" content="<?php echo $function_sitename->cr_settingValue ?>">
  <link rel='stylesheet' href='<?php echo MURL."cr-include/coming-soon/" ?>css/bootstrap.min.css' type='text/css' media='all' />
  <link rel='stylesheet' href='<?php echo MURL."cr-include/coming-soon/" ?>css/style.css' type='text/css' media='all' />
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <![endif]-->
  <!-- Favicon -->
    <?php
        if($function_favicon == false) {
    ?>
    <link rel="shortcut icon" href="<?php echo MURL.'cr-include/images/favicon.png' ?>">
    <?php
        }
        else {
    ?>
    <link rel="shortcut icon" href="<?php echo MURL.'cr-editor/_thumbs/Images/'.$function_favicon->cr_settingValue ?>">
    <?php } ?>
  </head>
  <body>
  <!-- preloader -->
  <div id="preloader">
    <div id="preloader-img"></div>
  </div>
  <!-- /preloader -->
  <!-- page wrapper -->
  <div class="page-wrapper">
    <!-- header -->
    <header id="intro">
      <div class="pattern"></div> <!-- pattern -->
      <div class="overlay"></div> <!-- /overlay -->
      <!-- video control -->
      <div id="video-control">
        <i id="play" class="fa fa-fw fa-pause"></i>
        <i id="volume" class="fa fa-fw"></i>
      </div>
      <!-- /video control -->
      <div class="container">
        <div class="row">
          <div class="col-xs-12 intro-wrapper">
            <?php if($logo_image != '') { ?>
            <img src="<?php echo $image_path ?>" class="header-logo" alt="logo"> <!-- logo image -->
            <?php } ?>
            <!-- intro text -->
            <!--<h1 class="intro-title">Fully Responsive With <span class="main-color">IE9+</span> Support</h1>-->
            <div class="owl-carousel" id="text-rotate">
              <!-- text rotate -->
              <h2 class="intro-sub-title">Under <span class="main-color">Maintenance</span></h2>
              <h2 class="intro-sub-title">Will be <span class="main-color">Online</span> Soon</h2>
              <!-- /text rotate -->
            </div>
              <div id="DateCountdown" data-date="2015-11-28 12:00:00"></div><!-- Circle Countdown here you can set up time to countdown just simply change atribute data-date="yyyy-mm-dd time" -->
            <h3 class="intro-desc"><?php echo $function_sitename->cr_settingValue ?></h3>
            <!-- /intro text -->
          </div>
        </div>
      </div>
      <!-- countdown -->
      <div class="countdown-wrapper container">
        <div class="row">
          <span class="countdown-desc">Will be online in</span>
          <div class="col-xs-12" id="countdown"></div>
        </div>
      </div>
      <!-- /countdown -->
    </header>
    <!-- /header -->
  </div>
  <!-- /page wrapper -->
  <!-- script -->
  <script type='text/javascript' src='<?php echo MURL."cr-include/coming-soon/" ?>js/jquery-1.11.2.min.js'></script>
  <script type='text/javascript' src='<?php echo MURL."cr-include/coming-soon/" ?>js/bootstrap.min.js'></script>
  <script type='text/javascript' src='<?php echo MURL."cr-include/coming-soon/" ?>js/plugin.js'></script>
  <script type='text/javascript' src='<?php echo MURL."cr-include/coming-soon/" ?>js/variable.js'></script>
  <script type='text/javascript'>
      <?php
            $dt_mm_year  = date('Y', strtotime($function_maintenance->cr_settingValue));
            $dt_mm_month = date('n', strtotime($function_maintenance->cr_settingValue));
            $dt_mm_day   = date('d', strtotime($function_maintenance->cr_settingValue));
            $dt_mm_hour  = date('G', strtotime($function_maintenance->cr_settingValue));
            $dt_mm_mnt   = date('i', strtotime($function_maintenance->cr_settingValue));
      ?>
      var __countdown = true; // countdown function, false to disable
      var __countdownDate = new Date(<?php echo $dt_mm_year ?>,<?php echo $dt_mm_month ?>-1,<?php echo $dt_mm_day ?>,<?php echo $dt_mm_hour ?>,<?php echo $dt_mm_mnt ?>); // count date, ie.
      // new Date(2016, 12 - 1, 24) mean 2016-12-24 Christmas Eve
      // new Date(2016, 12 - 1, 24, 15) mean 2016-12-24 Christmas Eve 3:00 PM
      var __countdownTimezone = <?php echo $final_timezone ?>; // countdown timezone
      var __countdownDesc = ''; // text under countdown
      <?php require __DIR__.'/cr-include/coming-soon/mainjs.php' ?>
  </script>
  <!-- /script -->
</body>
</html>
<?php } ?>