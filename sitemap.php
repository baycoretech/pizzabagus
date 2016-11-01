<?php
  header('Content-type: application/xml');
  require __DIR__.'/cr-include/error-report.php';
  require __DIR__.'/cr-include/autoloader.php'; 
  require __DIR__.'/cr-include/setup-function.php'; 
  require __DIR__.'/cr-include/altorouter.php';

  $host         = "$_SERVER[HTTP_HOST]";
  $explode_url  = explode('/', $_SERVER[REQUEST_URI]);
  $router       = new AltoRouter();
    // Online Upload 
    // if($host == 'localhost' || $host == getHostByName(getHostName()) || isset($explode_url[1])) {
    // Offline (localhost)
    // if($host == 'localhost' || $host == getHostByName(getHostName())) {
  if($host == 'localhost' || $host == getHostByName(getHostName())) {
      $router->setBasePath('/'.$explode_url[1]);
  }
  require __DIR__.'/cr-include/routes.php';
  require __DIR__.'/cr-include/database/connection.php';
  require __DIR__.'/cr-include/global-function.php';

  $class_appearance    = new Appearance($pdo);
  $function_view_logo  = $class_appearance->view_logo();
  $logo_image  = $function_view_logo->cr_settingValue;
  //change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
  $logo_image_gif  = str_replace(".png",".gif",$logo_image);
  $logo_image_jpg  = str_replace(".png",".jpg",$logo_image);
  $logo_image_jpeg = str_replace(".png",".jpeg",$logo_image);
  //remove "/thumbnails" to get the real image
  $logo_imagent     = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$logo_image);
  $logo_image_gifnt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$logo_image_gif);
  $logo_image_jpgnt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$logo_image_jpg);
  $logo_image_jpegnt = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$logo_image_jpeg);
  $logo_image_link     = str_replace("/thumbnails","",$logo_image);
  $logo_image_gif_link  = str_replace("/thumbnails","",$logo_image_gif);
  $logo_image_jpg_link  = str_replace("/thumbnails","",$logo_image_jpg);
  $logo_image_jpeg_link = str_replace("/thumbnails","",$logo_image_jpeg);
  //menus
  $class_menu = new Menu($pdo);
  $function_view_menu = $class_menu->view_menu();
  //sitemap
  $class_sitemap = new Sitemap($pdo);
  $function_sitemap_portfolio     = $class_sitemap->sitemap_portfolio();
  $function_sitemap_blog_category = $class_sitemap->sitemap_blog_category();
  $function_sitemap_blog          = $class_sitemap->sitemap_blog();
  $function_sitemap_blog_tag      = $class_sitemap->sitemap_blog_tags();
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<url> 
  <loc><?php echo MURL ?></loc>
  <?php
    if($logo_image == "" || empty($logo_image)) {
      echo "";
    }
    else {
  ?>
  <image:image>
      <image:loc>
        <?php 
            if(file_exists($logo_imagent)) { 
                echo MURL.$logo_image_link; 
            } 
            elseif(file_exists($logo_image_gifnt)) { 
                echo MURL.$logo_image_gif_link; 
            } 
            elseif(file_exists($logo_image_jpgnt)) {
                echo MURL.$logo_image_jpg_link; 
            } 
            elseif(file_exists($logo_image_jpegnt)) { 
                echo MURL.$logo_image_jpeg_link; 
            } 
        ?>
      </image:loc> 
  </image:image>
  <?php
    }
  ?>
  <changefreq>weekly</changefreq>
  <priority>0.8</priority>
</url>
<?php
  //Menu Sitemap
  if($function_view_menu == 0) {
    echo "";
  }
  else {
    foreach ($function_view_menu as $data) {

      if($data->cr_menuHasSub != 1) { 
        if($data->cr_option == "customlink") {
          echo "";
        }
        else {
?>
<url>
  <loc><?php echo $router->generate('specific-page', array('page' => $data->cr_menuLink)) ?></loc>
  <changefreq>weekly</changefreq>
  <priority>0.8</priority>
</url>
<?php
        }
      }
      elseif($data->cr_menuHasSub == 1) {
        $menu          =  $data->cr_menuID;
        $function_view_menu_sub = $class_menu->view_menu_sub($menu);
        foreach ($function_view_menu_sub as $data) {
          if($data->cr_option == "customlink") {
            echo "";
          }
          else {
?>
<url>
  <loc><?php echo $router->generate('specific-page', array('page' => $data->cr_submenuLink)) ?></loc>
  <changefreq>weekly</changefreq>
  <priority>0.8</priority>
</url>
<?php
          }
        }
      }
    }
  }
  //Portfolio Sitemap
  if($function_sitemap_portfolio == 0) {
    echo "";
  }
  else {
    foreach ($function_sitemap_portfolio as $data) {
?>
<url>
  <loc><?php echo $router->generate('package', array('page' => $data->cr_portfoliocategoryLink, 'package' => $data->cr_portfolioLink)) ?></loc>
  <changefreq>weekly</changefreq>
  <priority>0.8</priority>
</url>
<?php
    }
  }
  //Blog Category Sitemap
  if($function_sitemap_blog_category == 0) {
    echo "";
  }
  else {
    foreach ($function_sitemap_blog_category as $data) {
?>
<url>
  <loc><?php echo $router->generate('more-link', array('page' => $data->cr_blogcategoryLink, 'package' => 'cat', 'more_link', $data->cr_blogcategorySlug)) ?></loc>
  <changefreq>weekly</changefreq>
  <priority>0.8</priority>
</url>
<?php
    }
  }
  //Blog Sitemap
  if($function_sitemap_blog == 0) {
    echo "";
  }
  else {
    foreach ($function_sitemap_blog as $data) {
?>
<url>
  <loc><?php echo $router->generate('package', array('page' => $data->cr_blogcategoryLink, 'package' => $data->cr_blogLink)) ?></loc>
  <changefreq>weekly</changefreq>
  <priority>0.8</priority>
</url>
<?php
    }
  }
  //Blog Tags
  if($function_sitemap_blog_tag == 0) {
    echo "";
  }
  else {
    foreach ($function_sitemap_blog_tag as $data) {
?>
<url>
  <loc><?php echo $router->generate('package', array('page' => 'tag', 'package' => $data->cr_blogtagsName)) ?></loc>
  <changefreq>weekly</changefreq>
  <priority>0.8</priority>
</url>
<?php
    }
  }
?>
</urlset>