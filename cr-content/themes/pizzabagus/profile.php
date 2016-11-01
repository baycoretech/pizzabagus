<?php
    if(!isset($lang)) {
        $create_btn      = 'SAVE CHANGE';
        $create_delivery = 'Delivery Address';
        $create_details  = 'Sign In Details';
        $pass_details    = 'Keep new password and confirm password empty if you do not want to change your password.';

        //Placeholder
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
        $ph_old_password = 'Old Password (Required)';
        $ph_new_password = 'New Password (Required)';
        $ph_confirm_password = 'Repeat New Password (Required)';
    }
    else {
        if($lang == $default_language->cr_languageCode) {
        	$create_btn      = 'SAVE CHANGE';
            $create_delivery = 'Delivery Address';
            $create_details  = 'Sign In Details';
        	$pass_details    = 'Keep new password and confirm password empty if you do not want to change your password.';

            //Placeholder
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
            $ph_old_password = 'Old Password (Required)';
	        $ph_new_password = 'New Password (Required)';
	        $ph_confirm_password = 'Repeat New Password (Required)';
        }
        else {
        	$create_btn      = 'SIMPAN PERUBAHAN';
            $create_delivery = 'Alamat Pengiriman';
            $create_details  = 'Rincian Akun';
        	$pass_details    = 'Biarkan sandi baru dan pengulangan sandi kosong jika tidak ingin mengubah sandi.';

            //Placeholder
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
            $ph_old_password = 'Sandi Lama (Wajib)';
	        $ph_new_password = 'Sandi Baru (Wajib)';
	        $ph_confirm_password = 'Ulangi Sandi Baru (Wajib)';
        }
    }
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-title">
				<?php 
					echo $page_title;
				?>
			</h1>
			<div class="page-title-border-left"></div>
			<div class="page-title-border-right"></div>
		</div>

		<div class="col-md-12">
            <div id="error-profile-customer"></div>
			<form id="form-profile-customer" class="m-b-20" data-parsley-validate action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <p><?php echo $create_delivery ?></p>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_hotelvilla" placeholder="<?php echo $ph_hotel ?>" name="hotelvilla" value="<?php echo $customer_logged_in->cr_customerHotelvilla ?>">
                        </div>
                        <div class="form-group">
                            <select class="form-control input-sm" name="title" required>
                                <option value=""><?php echo $ph_title ?></option>
                                <option value="Mr" <?php if($customer_title == 'Mr') echo 'selected="selected"' ?>>Mr</option>
                                <option value="Mrs" <?php if($customer_title == 'Mrs') echo 'selected="selected"' ?>>Mrs</option>
                                <option value="Ms" <?php if($customer_title == 'Ms') echo 'selected="selected"' ?>>Ms</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_firstname" placeholder="<?php echo $ph_firstname ?>" name="firstname" data-parsley-maxlength="100" value="<?php echo $customer_logged_in->cr_customerFirstname ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_middlename" placeholder="<?php echo $ph_middlename ?>" name="middlename" value="<?php echo $customer_logged_in->cr_customerMiddlename ?>" data-parsley-maxlength="100">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_lastname" placeholder="<?php echo $ph_lastname ?>" name="lastname" data-parsley-maxlength="100" value="<?php echo $customer_logged_in->cr_customerLastname ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_address1" placeholder="<?php echo $ph_address1 ?>" name="address1" data-parsley-maxlength="500" value="<?php echo $customer_address1 ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_address2" placeholder="<?php echo $ph_address2 ?>" name="address2" data-parsley-maxlength="500" value="<?php echo $customer_address2 ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_city" placeholder="City (Required)" name="city" value="Ubud, Bali" readonly="readonly" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control input-sm" id="register_details" name="detail" rows="4" placeholder="<?php echo $ph_detail ?>" data-parsley-maxlength="1000"><?php echo $customer_detail ?></textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" class="form-control input-sm" id="register_mobilephone" placeholder="<?php echo $ph_phone ?>" value="<?php echo $customer_phone ?>" readonly="readonly" required>
                            <p class="help-block">You cannot change the phone number.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-register">
                        <p><?php echo $create_details ?></p>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_displayname" placeholder="<?php echo $ph_displayname ?>" name="displayname" data-parsley-maxlength="255" value="<?php echo $customer_displayname ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control input-sm" id="register_email" placeholder="<?php echo $ph_email ?>" name="email" data-parsley-type="email" value="<?php echo $customer_email ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control input-sm" id="register_username" placeholder="<?php echo $ph_create_username ?>" name="username" data-parsley-maxlength="50" value="<?php echo $customer_logged_in->cr_customerUsername ?>" required>
                        </div>
                        <div class="alert alert-info"><?php echo $pass_details ?></div>
                        <div class="form-group">
                            <input type="password" class="form-control input-sm" id="register_new_password" placeholder="<?php echo $ph_new_password ?>" name="new_password" data-parsley-minlength="6" data-parsley-maxlength="50">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control input-sm" id="register_confirm_password" placeholder="<?php echo $ph_confirm_password ?>" name="confirm_password" data-parsley-minlength="6" data-parsley-maxlength="50" data-parsley-equalto="#register_new_password">
                        </div>
                    </div>
                    <div class="col-md-12">
	                    <button id="button-profile-customer" type="submit" class="btn btn-pizzabagus"><?php echo $create_btn ?></button>
	                </div>
                </div>
            </form>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
		<?php
          	if(!isset($lang)) {
              $register_btn           = 'SAVE CHANGE';
              $register_load_btn      = 'SAVING CHANGE ...';
              $register_empty_alert   = 'Please fill all required field.';
              $register_false_alert   = 'Cannot update your account. Please try again.';
              $register_same_alert    = 'Username or email that you have submitted already exists.';
              $register_error_alert   = 'Error. Cannot update your account. Please try again.';
              $register_not_equal_alert = 'Failed. New password and repeat password has to be same. Please try again.';
              $register_success_alert = 'Your account has been successfully updated.';
              $register_logout_alert  = 'Your account has been successfully updated and will logout now.';
          	}
          	else {
              if($lang == $default_language->cr_languageCode) {
                  $register_btn           = 'SAVE CHANGE';
                  $register_load_btn      = 'SAVING CHANGE ...';
                  $register_empty_alert   = 'Please fill all required field.';
                  $register_false_alert   = 'Cannot update your account. Please try again.';
                  $register_same_alert    = 'Username or email that you have submitted already exists.';
                  $register_error_alert   = 'Error. Cannot update your account. Please try again.';
              	  $register_not_equal_alert = 'Failed. New password and repeat password has to be same. Please try again.';
                  $register_success_alert = 'Your account has been successfully updated.';
              	  $register_logout_alert  = 'Your account has been successfully updated and will logout now.';
              }
              else {
                  $register_btn           = 'CREATE ACCOUNT';
                  $register_load_btn      = 'CREATING ACCOUNT ...';
                  $register_empty_alert   = 'Silahkan isi semua form.';
                  $register_false_alert   = 'Tidak bisa memperbaharui akun. Silahkan coba lagi.';
                  $register_same_alert    = 'Nama user atau email yang anda masukkan sudah ada.';
                  $register_error_alert   = 'Kesalahan. Tidak bisa memperbaharui akun. Silahkan coba lagi.';
              	  $register_not_equal_alert = 'Gagal. Sandi baru dan pengulangan sandi baru harus sama. Silahkan coba lagi.';
                  $register_success_alert = 'Akun berhasil diperbaharui.';
                  $register_logout_alert  = 'Akun berhasil diperbaharui dan akan keluar sekarang.';
              }
          	}
        ?>
        var profile_customer;
        $("#form-profile-customer").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (profile_customer) {
                    profile_customer.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                profile_customer = $.ajax({
                    url: "<?php echo MURL ?>cr-include/ajax/update-customer.php",
                    type: "post",
                    beforeSend: function(){ $("#button-profile-customer").html('<i class="fa fa-spinner fa-pulse"></i> <?php echo $register_load_btn ?>');$("#button-profile-customer").attr('disabled','disabled');},
                    data: serializedData
                });
                profile_customer.done(function (msg){
                    if(msg=='empty-field') {
                        $("#button-profile-customer").removeAttr('disabled');
                        $("#button-profile-customer").html('<?php echo $register_btn ?>');
                        $("#error-profile-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_empty_alert ?></div>');
                    }
                    else if(msg=='same-username') {
                        $("#button-profile-customer").removeAttr('disabled');
                        $("#button-profile-customer").html('<?php echo $register_btn ?>');
                        $("#error-profile-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_same_alert ?></div>');

                    }
                    else if(msg=='not-equal-password') {
                        $("#button-profile-customer").removeAttr('disabled');
                        $("#button-profile-customer").html('<?php echo $register_btn ?>');
                        $("#error-profile-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_not_equal_alert ?></div>');

                    }
                    else if(msg == 'false') {
                        $("#button-profile-customer").removeAttr('disabled');
                        $("#button-profile-customer").html('<?php echo $register_btn ?>');
                        $("#error-profile-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_false_alert ?></div>');
                    }
                    else if(msg == 'true') {
                        $("#error-profile-customer").html('<div class="alert alert-success" role="alert"><?php echo $register_success_alert ?></div>');
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000);
                    }
                    else if(msg == 'logout') {
                        $("#error-profile-customer").html('<div class="alert alert-success" role="alert"><?php echo $register_logout_alert ?></div>');
                        setTimeout(function() {
                            window.location="<?php echo MURL.'logout.php' ?>";
                        }, 1000);
                    }
                    else {
                        $("#button-profile-customer").removeAttr('disabled');
                        $("#button-profile-customer").html('<?php echo $register_btn ?>');
                        $("#error-profile-customer").html('<div class="alert alert-danger" role="alert"><?php echo $register_error_alert ?></div>');
                    }
                });
                profile_customer.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>