<?php
    $class_contact_header    = new Contact_Header($pdo);
    $function_contact_header = $class_contact_header->view_contact_header();
    $function_social_top     = $class_contact_header->view_social_top();
    $explode_contact_header  = explode(',', $function_contact_header->cr_settingValue);
    $first_value  = $explode_contact_header[0];
    $second_value = $explode_contact_header[1];
    $third_value  = $explode_contact_header[2];

    $function_view_language = $class_language->view_language();

    if($function_contact_header->cr_settingValue != '0,0,0') {
?>
<div class="contact-header">
    <div class="container">
        <div class="row">
            <div class="col-xs-6">
            <?php
                if($function_social_top != false && $third_value != 0) { 
            ?>
                <ul class="contact-header-social hidden-xs hidden-sm">
                <?php
                    foreach($function_social_top as $data) {
                        $social_link     = $data->cr_socialLink;
                        $check_www       = strpos($social_link, "www.");
                        $check_www_http  = strpos($social_link, "http://www.");
                        $check_www_https = strpos($social_link, "https://www.");
                        if($checkwww!==false) {
                            $newsl = str_replace("www.","",$social_link);
                            $check_http = strpos($newsl, "http");
                            if($check_http!==false) {
                                $true_link = $newsl;
                            }
                            else {
                                $true_link = "http://".$newsl;
                            }
                        }
                        else {
                            $true_link = $data->cr_socialLink;
                        }
                ?>
                    <li class="<?php echo $data->cr_socialName ?>"><a target="_blank" href="<?php echo $true_link ?>"><i class="fa fa-<?php echo $data->cr_socialName ?>"></i></a></li>
                <?php
                    }
                ?>
                </ul>
                <ul class="contact-header-social hidden-md hidden-lg">
                    <li><i class="fa fa-share-alt" data-target="#modal-header-social" data-toggle="modal"></i></li>
                <?php
                    if($second_value != 0) {
                ?>
                    <li><i class="fa fa-phone" data-target="#modal-header-phone" data-toggle="modal"></i> <span class="hidden-xs hidden-sm"><?php echo $function_phone->cr_settingValue ?></span></li>
                <?php
                    }
                    if($first_value != 0) {
                ?>
                    <li><i class="fa fa-envelope" data-target="#modal-header-mail" data-toggle="modal"></i> <span class="hidden-xs hidden-sm"><?php echo $function_email->cr_settingValue ?></span></li>
                <?php } ?>
                </ul>
            <?php
                }
            ?>
            </div>
            <div class="col-xs-6">
                <ul class="contact-header-social hidden-xs hidden-sm text-right">
                <?php
                    if($second_value != 0) {
                ?>
                    <li><i class="fa fa-phone"></i> <?php echo $function_phone->cr_settingValue ?></li>
                <?php
                    }
                    if($first_value != 0) {
                ?>
                    <li><i class="fa fa-envelope"></i> <?php echo $function_email->cr_settingValue ?></li>
                <?php
                    }
                    if($function_view_language != false) {
                ?>
                    <li>|</li>
                <?php
                        foreach($function_view_language as $language) {
                            $lang_code = $language->cr_languageCode;
                            $flag_icon = substr($language->cr_languageFlag, 0, 2);
                ?>
                    <li><a class="flag-icon flag-icon-<?php echo $flag_icon ?>" href="<?php echo $router->generate('home-lang', array('lang' => $lang_code)); ?>"></a></li>
                <?php 
                        } 
                ?>
                </ul>
                <ul class="contact-header-social hidden-md hidden-lg text-right">
                <?php
                        foreach($function_view_language as $language) {
                            $flag_icon = substr($language->cr_languageFlag, 0, 2);
                ?>
                    <li><a class="flag-icon flag-icon-<?php echo $flag_icon ?>" href=""></a></li>
                <?php 
                        }
                ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
    if($function_social_top != 0 && $third_value != 0) { 
?>
<div id="modal-header-social" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Social</h4>
      </div>
      <div class="modal-body text-center">
        <ul class="modal-social">
            <?php
                foreach($function_social_top as $data) {
                    $social_link     = $data->cr_socialLink;
                    $check_www       = strpos($social_link, "www.");
                    $check_www_http  = strpos($social_link, "http://www.");
                    $check_www_https = strpos($social_link, "https://www.");
                    if($checkwww!==false) {
                        $newsl = str_replace("www.","",$social_link);
                        $check_http = strpos($newsl, "http");
                        if($check_http!==false) {
                            $true_link = $newsl;
                        }
                        else {
                            $true_link = "http://".$newsl;
                        }
                    }
                    else {
                        $true_link = $data->cr_socialLink;
                    }
            ?>
            <li><a target="_blank" href="<?php echo $true_link ?>"><i class="fa fa-<?php echo $data->cr_socialName ?>"></i></a></li>
            <?php } ?>
        </ul>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
    }
    if($first_value != 0) {
?>
<div id="modal-header-mail" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Email</h4>
      </div>
      <div class="modal-body">
        <a href="mailto:<?php echo $function_email->cr_settingValue ?>"><?php echo $function_email->cr_settingValue ?></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
    }
    if($second_value != 0) {
?>
<div id="modal-header-phone" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Phone</h4>
      </div>
      <div class="modal-body">
        <a href="tel:<?php echo $function_phone->cr_settingValue ?>"><?php echo $function_phone->cr_settingValue ?></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
        } 
?>
<?php
    } 
?>