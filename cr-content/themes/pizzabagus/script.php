<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/js/modernizr.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/animate-plus/animate-plus.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/isotope/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/cycle2/jquery.cycle2.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/fotorama/fotorama.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/icheck/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/backstretch/jquery.backstretch.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/parsley/dist/parsley.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/masked-input/masked-input.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."/cr-content/themes/".$v_themes?>/plugin/autocomplete/jquery.easy-autocomplete.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."/cr-content/themes/".$v_themes?>/plugin/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo MURL."/cr-content/themes/".$v_themes?>/plugin/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/initial/initial.js"></script>
<script type="text/javascript" src="<?php echo MURL."cr-content/themes/".$v_themes?>/plugin/number-updown/updown.js"></script>
<?php
  $class_map = new Map($pdo);
  $view_map  = $class_map->view_map();
  $view_map_marker = $class_map->view_map_marker();
  if($view_map == false || ($function_api_map->cr_settingValue == '' || empty($function_api_map->cr_settingValue))) {
    echo '';
  }
  else {
?>  
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $function_api_map->cr_settingValue ?>"></script>
<?php } ?>
    
<script type="text/javascript">
    <?php
      if(!isset($page)) {
        if($order_status == false) {
    ?>
    $(window).load(function(){
        $('#modal-close-order').modal('show');
    });
    <?php
        }
      }
    ?>

    $(document).ready(function(){
        $('#button-register-from-signin').click(function() {
          setTimeout(function() {
              $('#modal-signin-customer').modal('hide');
          }, 500);
          setTimeout(function() {
              $('#modal-register-customer').modal('show');
          }, 1500);
        });

        $('#button-signin-from-register').click(function() {
          setTimeout(function() {
              $('#modal-register-customer').modal('hide');
          }, 500);
          setTimeout(function() {
              $('#modal-signin-customer').modal('show');
          }, 1500);
        });

        $("#register_mobilephone").mask("0899999999?99");

        $('.initial-photo').initial();

        $(".home-order").backstretch([
          <?php
            $class_slider   = new Slider($pdo);
            $view_slider    = $class_slider->view_slider();
            $total_slider   = $class_slider->total_slider();
            if($view_slider == false) {
          ?>
            "<?php echo MURL."cr-content/themes/".$v_themes?>/images/slider.jpg"
          <?php
            }
            else {
              foreach($view_slider as $data) {
                $slider_image = $data->cr_sliderImage;
          ?>
            "<?php echo MURL.'cr-editor/images/'.$slider_image ?>",
          <?php
              }
            }
          ?>
            ], {duration: 3000, fade: 750});

        $('.owl-carousel').owlCarousel({
            items:1,
            loop:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true
        });

        <?php
          if($view_map == false || ($function_api_map->cr_settingValue == '' || empty($function_api_map->cr_settingValue))) {
            echo '';
          }
          else {
        ?> 
        function initialize() {
          latLng = new google.maps.LatLng(<?php if($view_map->cr_mapLatLong == '' || empty($view_map->cr_mapLatLong)) echo '-8.5222512,115.2627883'; else echo $view_map->cr_mapLatLong ?>)
          var mapOptions = {
            center: latLng,
            zoom: 15,
            disableDefaultUI:true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("home-map"), mapOptions);
          var contentString = '<div id="map-content">'+
          '<div id="siteNotice">'+
          '</div>'+
          '<div id="bodyContent">'+
          '<img src="<?php echo MURL."cr-content/themes/".$v_themes?>/images/pizza-bagus-place.jpg">' +
          '<p>' +
          '<?php echo str_replace(array("\r","\n"),"",$view_map->cr_mapDesc) ?>'+
          '</p>'+
          '</div>'+
          '</div>';
          var infowindow = new google.maps.InfoWindow({
              content: contentString
          });   
          var image = '<?php echo MURL.$view_map->cr_mapmarkerImage ?>';
          var marker = new google.maps.Marker({
              position: latLng,
              title:"Location",
              visible: true,
              icon: image
          });
            $('#map-content').parent().addClass('brown-bg');
          marker.setMap(map);
          google.maps.event.addListener(marker, 'click', function() {
               infowindow.open(map,marker);
                // Reference to the DIV which receives the contents of the infowindow using jQuery
               var iwOuter = $('.gm-style-iw');
               /* The DIV we want to change is above the .gm-style-iw DIV.
                * So, we use jQuery and create a iwBackground variable,
                * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
                */
               var iwBackground = iwOuter.prev();
               // Remove the background shadow DIV
               iwBackground.children(':nth-child(2)').css({'display' : 'none'});
               // Remove the white background DIV
               iwBackground.children(':nth-child(4)').css({'display' : 'none'});
               iwOuter.css({'top' : '20px'});
               var iwCloseBtn = iwOuter.next();

                // Apply the desired effect to the close button
                iwCloseBtn.css({
                  opacity: '1', // by default the close button has an opacity of 0.7
                  right: '42px', top: '24px', // button repositioning
                  border: '2px solid #ffffff', // increasing button border and new color
                  'padding': '3px',
                  width: '16px',
                  height: '16px',
                  });

                // The API automatically applies 0.7 opacity to the button after the mouseout event.
                // This function reverses this event to the desired value.
                iwCloseBtn.mouseout(function(){
                  $(this).css({opacity: '1'});
                });
          });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
        <?php } ?>

        <?php
          if(!isset($lang)) {
              $register_btn           = 'CREATE ACCOUNT';
              $register_load_btn      = 'CREATING ACCOUNT ...';
              $register_empty_alert   = 'Please fill all required field.';
              $register_false_alert   = 'Cannot create your account. Please try again.';
              $register_same_alert    = 'Username or email that you have submitted already exists.';
              $register_error_alert   = 'Error. Cannot create your account. Please try again.';
              $register_success_alert = 'Your account has been successfully created.';
          }
          else {
              if($lang == $default_language->cr_languageCode) {
                  $register_btn           = 'CREATE ACCOUNT';
                  $register_load_btn      = 'CREATING ACCOUNT ...';
                  $register_empty_alert   = 'Please fill all required field.';
                  $register_false_alert   = 'Cannot create your account. Please try again.';
                  $register_same_alert    = 'Username or email that you have submitted already exists.';
                  $register_error_alert   = 'Error. Cannot create your account. Please try again.';
                  $register_success_alert = 'Your account has been successfully created.';
              }
              else {
                  $register_btn           = 'CREATE ACCOUNT';
                  $register_load_btn      = 'CREATING ACCOUNT ...';
                  $register_empty_alert   = 'Silahkan isi semua form.';
                  $register_false_alert   = 'Tidak bisa membuat akun. Silahkan coba lagi.';
                  $register_same_alert    = 'Nama user atau email yang anda masukkan sudah ada.';
                  $register_error_alert   = 'Kesalahan. Tidak bisa membuat akun. Silahkan coba lagi.';
                  $register_success_alert = 'Akun berhasil dibuat.';
              }
          }
        ?>
        var register_customer;
        $("#form-register-customer").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (register_customer) {
                    register_customer.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                register_customer = $.ajax({
                    url: "<?php echo MURL ?>cr-include/ajax/register-customer.php",
                    type: "post",
                    beforeSend: function(){ $("#button-register-customer").html('<i class="fa fa-spinner fa-pulse"></i> <?php echo $register_load_btn ?>');$("#button-register-customer").attr('disabled','disabled');},
                    data: serializedData
                });
                register_customer.done(function (msg){
                    if(msg=='empty-field') {
                        $("#button-register-customer").removeAttr('disabled');
                        $("#button-register-customer").html('<?php echo $register_btn ?>');
                        $("#error-register-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_empty_alert ?></div>');
                    }
                    else if(msg=='same-username') {
                        $("#button-register-customer").removeAttr('disabled');
                        $("#button-register-customer").html('<?php echo $register_btn ?>');
                        $("#error-register-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_same_alert ?></div>');

                    }
                    else if(msg == 'false') {
                        $("#button-register-customer").removeAttr('disabled');
                        $("#button-register-customer").html('<?php echo $register_btn ?>');
                        $("#error-register-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_false_alert ?></div>');
                    }
                    else if(msg == 'true') {
                        $("#error-register-customer").html('<div class="alert alert-success" role="alert"><?php echo $register_success_alert ?></div>');
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('home') ?>";
                        }, 1000);
                    }
                    else {
                        $("#button-register-customer").removeAttr('disabled');
                        $("#button-register-customer").html('<?php echo $register_btn ?>');
                        $("#error-register-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_error_alert ?></div>');
                    }
                });
                register_customer.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        <?php
          if(!isset($lang)) {
              $signin_btn           = 'SIGN IN';
              $signin_load_btn      = 'SIGNING IN ...';
              $signin_empty_alert   = 'Please fill all required field.';
              $signin_false_alert   = 'Wrong username or password. Please try again.';
              $signin_invalid_alert = 'Cannot sign in. Username is not exist or has been blocked.';
              $signin_error_alert   = 'Error. Cannot sign in now. Please try again.';
          }
          else {
              if($lang == $default_language->cr_languageCode) {
                  $signin_btn           = 'SIGN IN';
                  $signin_load_btn      = 'SIGNING IN ...';
                  $signin_empty_alert   = 'Please fill all required field.';
                  $signin_false_alert   = 'Wrong username or password. Please try again.';
                  $signin_invalid_alert = 'Cannot sign in. Username is not exist or has been blocked.';
                  $signin_error_alert   = 'Error. Cannot sign in now. Please try again.';
              }
              else {
                  $signin_btn           = 'SIGN IN';
                  $signin_load_btn      = 'SIGNING IN ...';
                  $signin_empty_alert   = 'Silahkan isi semua form.';
                  $signin_false_alert   = 'Nama user atau kata sandi salah. Silahkan coba lagi.';
                  $signin_invalid_alert = 'Tidak bisa masuk. Nama user tidak terdaftar atau telah diblok.';
                  $signin_error_alert   = 'Kesalahan. Tidak bisa masuk. Silahkan coba lagi.';
              }
          }
        ?>
        var signin_customer;
        $("#form-signin-customer").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (signin_customer) {
                    signin_customer.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                signin_customer = $.ajax({
                    url: "<?php echo MURL ?>cr-include/ajax/login-customer.php",
                    type: "post",
                    beforeSend: function(){ $("#button-signin-customer").html('<i class="fa fa-spinner fa-pulse"></i> <?php echo $signin_load_btn ?>');$("#button-signin-customer").attr('disabled','disabled');},
                    data: serializedData
                });
                signin_customer.done(function (msg){
                    if(msg=='empty-field') {
                        $("#button-signin-customer").removeAttr('disabled');
                        $("#button-signin-customer").html('<?php echo $signin_btn ?>');
                        $("#error-signin-customer").html('<div class="alert alert-danger" role="alert"><?php echo $signin_empty_alert ?></div>');
                    }
                    else if(msg == 'false') {
                        $("#button-signin-customer").removeAttr('disabled');
                        $("#button-signin-customer").html('<?php echo $signin_btn ?>');
                        $("#error-signin-customer").html('<div class="alert alert-danger" role="alert"><?php echo $signin_false_alert ?></div>');
                    }
                    else if(msg == 'invalid') {
                        $("#button-signin-customer").removeAttr('disabled');
                        $("#button-signin-customer").html('<?php echo $signin_btn ?>');
                        $("#error-signin-customer").html('<div class="alert alert-danger" role="alert"><?php echo $signin_invalid_alert ?></div>');
                    }
                    else if(msg == 'true') {
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('home') ?>";
                        }, 1000);
                    }
                    else {
                        $("#button-signin-customer").removeAttr('disabled');
                        $("#button-signin-customer").html('<?php echo $signin_btn ?>');
                        $("#error-signin-customer").html('<div class="alert alert-danger" role="alert"><?php echo $signin_error_alert ?></div>');
                    }
                });
                signin_customer.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        }); 

        var signin_home;
        $("#form-home-signin").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (signin_home) {
                    signin_home.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                signin_home = $.ajax({
                    url: "<?php echo MURL ?>cr-include/ajax/login-customer.php",
                    type: "post",
                    beforeSend: function(){ $("#button-home-signin").html('<i class="fa fa-spinner fa-pulse"></i>');$("#button-home-signin").attr('disabled','disabled');},
                    data: serializedData
                });
                signin_home.done(function (msg){
                    if(msg=='empty-field') {
                        $("#button-home-signin").removeAttr('disabled');
                        $("#button-home-signin").html('<?php echo $signin_btn ?>');
                        $("#error-home-signin").html('<div class="alert alert-danger" role="alert"><?php echo $signin_empty_alert ?></div>');
                    }
                    else if(msg == 'false') {
                        $("#button-home-signin").removeAttr('disabled');
                        $("#button-home-signin").html('<?php echo $signin_btn ?>');
                        $("#error-home-signin").html('<div class="alert alert-danger" role="alert"><?php echo $signin_false_alert ?></div>');
                    }
                    else if(msg == 'invalid') {
                        $("#button-signin-customer").removeAttr('disabled');
                        $("#button-signin-customer").html('<?php echo $signin_btn ?>');
                        $("#error-signin-customer").html('<div class="alert alert-danger" role="alert"><?php echo $signin_invalid_alert ?></div>');
                    }
                    else if(msg == 'true') {
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('home') ?>";
                        }, 1000);
                    }
                    else {
                        $("#button-home-signin").removeAttr('disabled');
                        $("#button-home-signin").html('<?php echo $signin_btn ?>');
                        $("#error-home-signin").html('<div class="alert alert-danger" role="alert"><?php echo $signin_error_alert ?></div>');
                    }
                });
                signin_home.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        }); 
        <?php 
          if(!empty($_SESSION['cr_customerID']) && !empty($_SESSION['cr_customerPassword'])) { 
        ?>
        var auto_refresh_total_qty = setInterval(
            function () {
                <?php
                    if($page == 'invoice') {
                ?>
                var total_qty = 0;
                <?php } else { ?>
                var total_qty = $('#tc-cart-navbar-qty-get').html();
                <?php } ?>
                $('#total-items').html(total_qty);
        }, 1000);
        <?php
          }
        ?>
    });    
</script>