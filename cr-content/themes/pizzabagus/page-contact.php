<?php
	$view_contact   = $class_page->view_contact($page);
    $class_contact_header   = new Contact_Header($pdo);
    $social_top             = $class_contact_header->view_social_top();
    $class_map = new Map($pdo);
    $view_map  = $class_map->view_map();
    $view_map_marker = $class_map->view_map_marker();
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-title">
				<?php 
					if(!isset($lang)) {
                        if(empty($view_contact->cr_contactCustomheader) || $view_contact->cr_contactCustomheader == '')
	                        echo $page_title;
	                    else 
	                        echo $view_contact->cr_contactCustomheader; 
                    }
                    else {
                        if($lang == $default_language->cr_languageCode) {
                            if(empty($view_contact->cr_contactCustomheader) || $view_contact->cr_contactCustomheader == '')
		                        echo $page_title;
		                    else 
		                        echo $view_contact->cr_contactCustomheader; 
                        }
                        else {
                            if(empty($view_contact->cr_contactCustomheader_id) || $view_contact->cr_contactCustomheader_id == '')
		                        echo $page_title;
		                    else 
		                        echo $view_contact->cr_contactCustomheader_id;
                        }
                    }
                ?>
			</h1>
			<div class="page-title-border-left"></div>
			<div class="page-title-border-right"></div>
		</div>

		<div class="col-md-8">
			<?php
                if($view_contact == false) {
            ?>
            <div class="alert alert-info alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>Empty!</strong> There is no data found for this page.
            </div>
            <?php
            	}
            	else {
            		if(!isset($lang)) {
                        echo '<p>'.$view_contact->cr_contactCustomDesc.'</p>';
                    	echo $view_contact->cr_contactDesc;
                    }
                    else {
                        if($lang == $default_language->cr_languageCode) {
                            echo '<p>'.$view_contact->cr_contactCustomDesc.'</p>';
                    		echo $view_contact->cr_contactDesc;
                        }
                        else {
                            echo '<p>'.$view_contact->cr_contactCustomDesc_id.'</p>';
                    		echo $view_contact->cr_contactDesc_id;
                        }
                    }
                    
             	} 
            ?>
            <?php
                if($view_contact->cr_contactSocial == 'show') {
                    if($social_top == false) {
                        echo '';
                    }
                	else {
            ?>
            <ul class="page-contact-social">
            <?php
                foreach($social_top as $data) {
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
                }
            ?>
            </ul>
            <?php } ?> 
            <hr>
            <div class="contact-form">
               	<form id="form-send-contact" data-parsley-validate class="margin-clear" role="form" action="">
	                <?php
	                    if(($function_sitekey->cr_settingValue=="" || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue=="" || empty($function_secret->cr_settingValue))) {
	                ?>
	                <div class="alert alert-danger" role="alert">
	                    You have not set up Google reCaptcha Sitekey and Secret Code.
	                </div>
	                <?php
	                    }
	                ?>  
	                <div class="form-group has-feedback">
	                    <label for="name">Name*</label>
	                    <input type="text" class="form-control" id="name" name="name" placeholder="Name (Required)" data-parsley-minlength="4" data-parsley-maxlength="50" required <?php if(($function_sitekey->cr_settingValue == '' || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue == '' || empty($function_secret->cr_settingValue))) { echo 'disabled'; } ?>>
	                    <i class="fa fa-user form-control-feedback"></i>
	                </div>
	                <div class="form-group has-feedback">
	                    <label for="email">Email*</label>
	                    <input type="email" class="form-control" id="email" name="email" placeholder="Email (Required)" data-parsley-type="email" required <?php if(($function_sitekey->cr_settingValue == '' || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue == '' || empty($function_secret->cr_settingValue))) { echo 'disabled'; } ?>>
	                    <i class="fa fa-envelope form-control-feedback"></i>
	                </div>
	                <div class="form-group has-feedback">
	                    <label for="subject">Subject*</label>
	                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" data-parsley-minlength="4" data-parsley-maxlength="100" <?php if(($function_sitekey->cr_settingValue == '' || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue == '' || empty($function_secret->cr_settingValue))) { echo 'disabled'; } ?>>
	                    <i class="fa fa-navicon form-control-feedback"></i>
	                </div>
	                <div class="form-group has-feedback">
	                    <label for="message">Message*</label>
	                    <textarea class="form-control" rows="6" id="message" name="message" placeholder="Enter your message ..." data-parsley-minlength="4" data-parsley-maxlength="1000" required <?php if(($function_sitekey->cr_settingValue == '' || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue == '' || empty($function_secret->cr_settingValue))) { echo 'disabled'; } ?>></textarea>
	                    <i class="fa fa-pencil form-control-feedback"></i>
	                </div>
	                <?php 
	                    if(($function_sitekey->cr_settingValue == '' || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue == '' || empty($function_secret->cr_settingValue))) { 
	                        echo '';
	                    }
	                    else {
	                ?>
	                <div class="row">
	                    <div class="col-sm-12" style="margin-top: 5px; margin-bottom: 5px">
	                        <div class="g-recaptcha" data-sitekey="<?php echo $function_sitekey->cr_settingValue ?>"></div>
	                    </div>
	                </div>
	                <?php } ?>
	                <button id="button-send-contact" type="submit" class="btn btn-pizzabagus" <?php if(($function_sitekey->cr_settingValue == '' || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue == '' || empty($function_secret->cr_settingValue))) { echo 'disabled'; } ?>>SEND MESSAGE</button>
            	</form>
            	<div id="response" style="margin-top: 10px"></div>
        	</div>
		</div>
		<div class="col-md-4">
			
		</div>
	</div>
</div>
<div id="home-map" class="m-t-20"></div>
<?php 
    if(($function_sitekey->cr_settingValue == '' || empty($function_sitekey->cr_settingValue)) || ($function_secret->cr_settingValue == '' || empty($function_secret->cr_settingValue))) { 
        echo ''; 
    } 
    else {
        if(!isset($lang)) {
            $contact_btn           = 'SEND MESSAGE';
            $contact_load_btn      = 'SENDING YOUR MESSAGE...';
            $contact_empty_alert   = '<strong>Error!</strong> Please fill all field.';
            $contact_failed_alert  = '<strong>Failed!</strong> Cannot send your message. Please try again.';
            $contact_invalid_alert = '<strong>Error!</strong> Invalid reCAPTCHA code';
            $contact_reenter_alert = '<strong>Error!</strong> Please re-enter your reCAPTCHA.';
            $contact_error_alert   = '<strong>Error!</strong> Cannot send your message. Please try again.';
            $contact_success_alert = '<strong>Success!</strong> Your message has been sent successfully.';
        }
        else {
            if($lang == $default_language->cr_languageCode) {
                $contact_btn           = 'SEND MESSAGE';
                $contact_load_btn      = 'SENDING YOUR MESSAGE...';
                $contact_empty_alert   = '<strong>Error!</strong> Please fill all field.';
                $contact_failed_alert  = '<strong>Failed!</strong> Cannot send your message. Please try again.';
                $contact_invalid_alert = '<strong>Error!</strong> Invalid reCAPTCHA code';
                $contact_reenter_alert = '<strong>Error!</strong> Please re-enter your reCAPTCHA.';
                $contact_error_alert   = '<strong>Error!</strong> Cannot send your message. Please try again.';
                $contact_success_alert = '<strong>Success!</strong> Your message has been sent successfully.';
            }
            else {
                $contact_btn           = 'KIRIM PESAN';
                $contact_load_btn      = 'MENGIRIM PESAN...';
                $contact_empty_alert   = '<strong>Kesalahan!</strong> Silahkan isi semua form.';
                $contact_failed_alert  = '<strong>Gagal!</strong> Tidak bisa mengirim pesan. Silahkan coba lagi.';
                $contact_invalid_alert = '<strong>Kesalahan!</strong> Kode reCAPTCHA salah';
                $contact_reenter_alert = '<strong>Kesalahan!</strong> Silahkan masukkan ulang kode reCAPTCHA.';
                $contact_error_alert   = '<strong>Kesalahan!</strong> Tidak bisa mengirim pesan. Silahkan coba lagi.';
                $contact_success_alert = '<strong>Berhasil!</strong> Pesan telah terkirim.';
            }
        }
?>
<script type="text/javascript">
    $(document).ready(function() {
        var send_contact;
        $("#form-send-contact").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (send_contact) {
                    send_contact.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                send_contact = $.ajax({
                    url: "<?php echo MURL ?>cr-include/ajax/send-contact.php",
                    type: "post",
                    beforeSend: function(){ $("#button-send-contact").html('<?php echo $contact_load_btn ?>');$("#button-send-contact").attr('disabled','disabled');},
                    data: serializedData
                });
                send_contact.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-send-contact").removeAttr('disabled');
                        $("#button-send-contact").html('<?php echo $contact_btn ?>');
                        $("#response").html('<div class="alert alert-danger fade in"><?php echo $contact_empty_alert ?></div>');
                    }
                    else if(msg == 'invalid-recaptcha') {
                        $("#button-send-contact").removeAttr('disabled');
                        $("#button-send-contact").html('<?php echo $contact_btn ?>');
                        $("#response").html('<div class="alert alert-danger fade in"><?php echo $contact_invalid_alert ?></div>');
                    }
                    else if(msg == 'reenter-recaptcha') {
                        $("#button-send-contact").removeAttr('disabled');
                        $("#button-send-contact").html('<?php echo $contact_btn ?>');
                        $("#response").html('<div class="alert alert-danger fade in"><?php echo $contact_reenter_alert ?></div>');
                    }
                    else if(msg == 'success'){
                        $form.find("input, textarea").val('');
                        $form.find("textarea").html('');
                        $form.parsley().reset();
                        $("#button-send-contact").removeAttr('disabled');
                        $("#button-send-contact").html('<?php echo $contact_btn ?>');
                        $("#response").html('<div class="alert alert-success fade in"><?php echo $contact_success_alert ?></div>');
                    }
                    else if(msg == 'failed') {
                        $("#button-send-contact").removeAttr('disabled');
                        $("#button-send-contact").html('<?php echo $contact_btn ?>');
                        $("#response").html('<div class="alert alert-danger fade in"><?php echo $contact_failed_alert ?></div>');
                    }
                    else {
                        $("#button-send-contact").removeAttr('disabled');
                        $("#button-send-contact").html('<?php echo $contact_btn ?>');
                        $("#response").html('<div class="alert alert-danger fade in"><?php echo $contact_error_alert ?></div>');
                    }
                });
                send_contact.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });  
    });        
</script>
<?php } ?>