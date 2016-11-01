<?php
    $router       = new AltoRouter();
    if($v_get_folder_name != '0') {
        $router->setBasePath('/'.$v_get_folder_name);
    }
    require __DIR__.'/../../../cr-include/routes.php';
    $not_found_page = MURL.'404.php';

    if(!isset($_SESSION['order'])) {
        $_SESSION['order'] = array();
    }

    if(!empty($_SESSION['cr_adminID']) && !empty($_SESSION['cr_adminPassword'])) {
        $class_user      = new User($pdo);
        $admin_logged_in = $class_user->admin_self($_SESSION['cr_adminID']);
    }

    if(!empty($_SESSION['cr_customerID']) && !empty($_SESSION['cr_customerPassword'])) {
        $class_customer       = new Customer($pdo);
        $customer_logged_in   = $class_customer->customer_data($_SESSION['cr_customerID']);
        $customer_displayname = $customer_logged_in->cr_customerDisplayname;
        $customer_title       = $customer_logged_in->cr_customerTitle;
        $customer_email       = $customer_logged_in->cr_customerEmail;
        $customer_phone       = $customer_logged_in->cr_customerPhone;
        $customer_address1    = $customer_logged_in->cr_customerAddress1;
        $customer_address2    = $customer_logged_in->cr_customerAddress2;
        $customer_detail      = $customer_logged_in->cr_customerDetail;
        $customer_fullname    = $customer_logged_in->cr_customerFirstname.' '.$customer_logged_in->cr_customerLastname;
    }

    require 'settings.php';
    require 'appearance.php';
    require 'meta.php';
    require 'page.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>">
  <?php require 'head.php' ?>
  <body>
    <?php require 'section-contact-header.php' ?>
    <?php require 'navbar.php' ?>
    <main class="">
            <?php
                if(isset($page)) {
                    if($page_type == 'general') {
                        if($gallery_on == "contact") {
                            require "page-contact.php";
                        }
                        else {
                            require "page-general.php";
                        }
                    }
                    elseif($page_type == 'portfolio') {
                        if($gallery_on == "gallery") {
                            require "page-gallery.php";
                        }
                        else {
                            if(isset($id_link)) {
                                if(isset($more_link)) {
                                    if($id_link == 'sort') {
                                        require "page-portfolio.php";
                                    }
                                    else {
                                        require "page-portfolio-detail.php";
                                    }
                                }
                                else {
                                    require "page-portfolio-detail.php";
                                }
                            }
                            else {
                                require "page-portfolio.php";
                            }
                        }
                    }
                    elseif($page_type == 'menu') {
                        if(isset($id_link)) {
                            if(isset($more_link)) {
                                if($id_link == 'sort') {
                                    require "page-menu.php";
                                }
                                else {
                                    require "page-menu-detail.php";
                                }
                            }
                            else {
                                require "page-menu-detail.php";
                            }
                        }
                        else {
                            require "page-menu.php";
                        }
                    }
                    elseif($page_type == 'blog') {
                        if(isset($id_link)) {
                            if($id_link == "cat") {
                                require "page-blog-category.php";
                            }
                            elseif($id_link == "page") {
                                require "page-blog.php";
                            }
                            else {
                                require "page-blog-detail.php";
                            }
                        }
                        else {
                            require "page-blog.php";
                        }
                    }
                    elseif($page == 'tag') {
                        require "tag.php";
                    }
                    elseif($page == 'my-order') {
                        require "my-order.php";
                    }
                    elseif($page == 'checkout') {
                        require "checkout.php";
                    }
                    elseif($page == 'checkout-review') {
                        require "checkout-review.php";
                    }
                    elseif($page == 'invoice') {
                        require "invoice.php";
                    }
                    elseif($page == 'profile') {
                        require "profile.php";
                    }
                    else {
                        header("location:$not_found_page");
                    }
                    if(in_array($page, explode(',', $function_sip->cr_settingValue)) === true) {
                        require "section-services.php";
                    }
                    if(in_array($page, explode(',', $function_cip->cr_settingValue)) === true) {
                        require "section-clients.php";
                    }
                    if(in_array($page, explode(',', $function_qip->cr_settingValue)) === true) {
                        require "section-home-quotes.php";
                    }
                }
                else {
                    require 'section-home-order.php';
                    require 'section-home-content.php';
                    require 'section-home-quotes.php';
                    require 'section-home-map.php';
                }
            ?>
    </main>
    <?php
        if(!isset($lang)) {
            $signin_button   = 'SIGN IN';
            $signin_question = 'Already have account?';
            $signin_text     = 'Sign in to make your order';
            $create_button   = 'CREATE ACCOUNT';
            $create_question = 'Don\'t have account?';
            $create_text     = 'Create your Pizza Bagus Online ordering account';
            $create_delivery = 'Delivery Address';
            $create_details  = 'Sign In Details';

            //Placeholder
            $ph_username     = 'Username';
            $ph_password     = 'Password';
            $ph_hotel        = 'Hotel or Villa';
            $ph_title        = 'Select Title (Required)';
            $ph_firstname    = 'First Name (Required)';
            $ph_middlename   = 'Middle Name (Required)';
            $ph_lastname     = 'Last Name (Required)';
            $ph_address1     = 'Address 1 (Required)';
            $ph_address2     = 'Address 2';
            $ph_detail       = 'Please add any information you have that will help our driver locate your house or villa, such as nearby landmarks and identifying features!';
            $ph_phone        = 'Mobile Phone (Required)';
            $ph_displayname  = 'Display Name (Required)';
            $ph_email        = 'Email (Required)';
            $ph_create_username = 'Username (Required)';
            $ph_create_password = 'Password (Required)';
            $ph_check        = 'I agree with term of service';
        }
        else {
            if($lang == $default_language->cr_languageCode) {
                $signin_button   = 'SIGN IN';
                $signin_question = 'Already have account?';
                $signin_text     = 'Sign in to make your order';
                $create_button   = 'CREATE ACCOUNT';
                $create_question = 'Don\'t have account?';
                $create_text     = 'Create your Pizza Bagus Online ordering account';
                $create_delivery = 'Delivery Address';
                $create_details  = 'Sign In Details';

                //Placeholder
                $ph_username     = 'Username';
                $ph_password     = 'Password';
                $ph_hotel        = 'Hotel or Villa';
                $ph_title        = 'Select Title (Required)';
                $ph_firstname    = 'First Name (Required)';
                $ph_middlename   = 'Middle Name (Required)';
                $ph_lastname     = 'Last Name (Required)';
                $ph_address1     = 'Address 1 (Required)';
                $ph_address2     = 'Address 2';
                $ph_detail       = 'Please add any information you have that will help our driver locate your house or villa, such as nearby landmarks and identifying features!';
                $ph_phone        = 'Mobile Phone (Required)';
                $ph_displayname  = 'Display Name (Required)';
                $ph_email        = 'Email (Required)';
                $ph_create_username = 'Username (Required)';
                $ph_create_password = 'Password (Required)';
                $ph_check        = 'I agree with term of service';
            }
            else {
                $signin_button   = 'MASUK';
                $signin_question = 'Sudah punya akun?';
                $signin_text     = 'Masuk untuk memesan';
                $create_button   = 'BUAT AKUN';
                $create_question = 'Belum punya akun?';
                $create_text     = 'Buat akun pemesanan online Pizza Bagus';
                $create_delivery = 'Alamat Pengiriman';
                $create_details  = 'Rincian Akun';

                //Placeholder
                $ph_username     = 'Name Pengguna';
                $ph_password     = 'Sandi';
                $ph_hotel        = 'Hotel atau Vila';
                $ph_title        = 'Pilih Gelar (Wajib)';
                $ph_firstname    = 'Nama Depan (Wajib)';
                $ph_middlename   = 'Nama Tengah (Wajib)';
                $ph_lastname     = 'Nama Belakang (Wajib)';
                $ph_address1     = 'Alamat 1 (Wajib)';
                $ph_address2     = 'Alamat 2';
                $ph_detail       = 'Silahkan tambahkan informasi yang bisa menolong pengantar kami menemukan lokasi rumah atau vila anda.';
                $ph_phone        = 'Telepon (Wajib)';
                $ph_displayname  = 'Tampilan Nama (Wajib)';
                $ph_email        = 'Email (Wajib)';
                $ph_create_username = 'Nama Pengguna (Wajib)';
                $ph_create_password = 'Sandi (Wajib)';
                $ph_check        = 'Saya setuju dengan persyaratan layanan';
            }
        }
    ?>
    <div id="modal-signin-customer" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center"><?php echo $signin_question ?></h3>
                    <p class="text-center"><?php echo $signin_text ?></p>
                    <div class="row">
                        <div class="col-md-12 p-h-80">
                            <div id="error-signin-customer"></div>
                            <form id="form-signin-customer" class="m-b-20" data-parsley-validate action="" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="signin_username" name="username" placeholder="<?php echo $ph_username ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="signin_password" name="password" placeholder="<?php echo $ph_password ?>" required>
                                </div>
                                <button id="button-signin-customer" type="submit" class="btn btn-pizzabagus btn-block"><?php echo $signin_button ?></button>
                                <button id="button-register-from-signin" type="button" class="btn btn-default btn-block"><?php echo $create_button ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php
        if(empty($_SESSION['cr_customerID']) && empty($_SESSION['cr_customerPassword'])) {
    ?>
    <div id="modal-register-customer" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center"><?php echo $create_question ?></h3>
                    <p class="text-center"><?php echo $create_text ?></p>
                    <div id="error-register-customer"></div>
                    <form id="form-register-customer" class="m-b-20" data-parsley-validate action="" method="post">
                        <div class="row">
                            <div class="col-md-6 p-h-40">
                                <p><?php echo $create_delivery ?></p>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_hotelvilla" placeholder="<?php echo $ph_hotel ?>" name="hotelvilla">
                                </div>
                                <div class="form-group">
                                    <select class="form-control input-sm" name="title" required>
                                        <option value=""><?php echo $ph_title ?></option>
                                        <option value="Mr">Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_firstname" placeholder="<?php echo $ph_firstname ?>" name="firstname" data-parsley-maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_middlename" placeholder="<?php echo $ph_middlename ?>" name="middlename" data-parsley-maxlength="100">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_lastname" placeholder="<?php echo $ph_lastname ?>" name="lastname" data-parsley-maxlength="100" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_address1" placeholder="<?php echo $ph_address1 ?>" name="address1" data-parsley-maxlength="500" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_address2" placeholder="<?php echo $ph_address2 ?>" name="address2" data-parsley-maxlength="500">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_city" placeholder="City (Required)" name="city" value="Ubud, Bali" readonly="readonly" required>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control input-sm" id="register_details" name="detail" rows="4" placeholder="<?php echo $ph_detail ?>" data-parsley-maxlength="1000"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phone" class="form-control input-sm" id="register_mobilephone" placeholder="<?php echo $ph_phone ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-register p-h-40">
                                <p><?php echo $create_details ?></p>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_displayname" placeholder="<?php echo $ph_displayname ?>" name="displayname" data-parsley-maxlength="255" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control input-sm" id="register_email" placeholder="<?php echo $ph_email ?>" name="email" data-parsley-type="email" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input-sm" id="register_username" placeholder="<?php echo $ph_create_username ?>" name="username" data-parsley-maxlength="50" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control input-sm" id="register_password" placeholder="<?php echo $ph_create_password ?>" name="password" data-parsley-minlength="6" data-parsley-maxlength="50" required>
                                </div>

                                <div class="panel panel-default panel-term-of-services">
                                    <div class="panel-heading">Terms of service</div>
                                    <div class="panel-body">
                                        <?php echo $function_term_of_service->cr_settingValue ?>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="agree" name="term" required>
                                        <?php echo $ph_check ?> 
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-20">
                            <div class="col-md-6">
                                <button id="button-signin-from-register" type="button" class="btn btn-default btn-block hidden-xs hidden-sm"><?php echo $signin_button ?></button>
                            </div>
                            <div class="col-md-6">
                                <button id="button-register-customer" type="submit" class="btn btn-pizzabagus btn-block"><?php echo $create_button ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php
        }
        if(!isset($page)) {
            if($order_status == false) {
    ?>
    <div class="modal fade" id="modal-close-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body text-center">
            <?php
                if($logo_image == "" || empty($logo_image)) {
                    echo '<h3>'.$function_sitename->cr_settingValue."</h3>";
                }
                 else {
            ?>
            <img src="<?php echo MURL.'cr-editor/images/'.$logo_image ?>" style="height: 120px;" alt="<?php echo $function_sitename->cr_settingValue ?>">
            <?php
                }
            ?>
            <h1>Sorry, We Are Closed</h1>
            <p>Open order at <strong><?php echo substr($function_open_order->cr_settingValue, 0, 5) ?></strong> and close order at <strong><?php echo substr($function_close_order->cr_settingValue, 0, 5) ?></strong></p>
          </div>
        </div>
      </div>
    </div>
    <?php }} require 'section-secondary-footer.php' ?>
    <?php require 'script.php' ?>
  </body>
</html>