<?php
	$captcha = $_POST['g-recaptcha-response'];
	$name    = $_POST['name'];
	$email   = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	if(empty($name) || empty($email) || empty($subject) || empty($message)) {
		echo 'empty-field';
	}
	else {
		if(!empty($captcha)) {
			require __DIR__.'/../error-report.php';
		    require __DIR__.'/../database/connection.php';
		    require __DIR__.'/../autoloader.php'; 
		    require __DIR__.'/../setup-function.php'; 
		    require __DIR__.'/../global-function.php';

		    $class_settings     = new Settings($pdo);
            $function_secret    = $class_settings->view_settings_recaptcha_secret();
            $google_url         = "https://www.google.com/recaptcha/api/siteverify";
            $secret             = $function_secret->cr_settingValue;
            $ip                 = $_SERVER['REMOTE_ADDR'];
            $captchaurl         = $google_url."?secret=".$secret."&response=".$captcha."&remoteip=".$ip;

            $curl_init = curl_init();
            curl_setopt($curl_init, CURLOPT_URL, $captchaurl);
            curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl_init, CURLOPT_TIMEOUT, 10);
            $results = curl_exec($curl_init);
            curl_close($curl_init);
			
			$results= json_decode($results, true);
			if($results['success']){
                require __DIR__.'/../phpmailer/PHPMailerAutoload.php';
                $class_general_setting    = new General_Setting($pdo);
			    //Set timezone
			    $v_set_timezone           = $class_general_setting->set_timezone();
			    $get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
			    if(!empty($v_set_timezone->cr_settingValue)) {
			        date_default_timezone_set($get_timezone_city);
			    }
			    $date_for_now = new DateTime();
			    $date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
			    $now_date     = $date_for_now->format('Y-m-d H:i:s');
			    //Same format as NOW(), use to save datetime value to database, without timezone, that will be diffrent datetime insert in database
                
				$class_page     = new Page($pdo);
    			$upper_name     = ucwords($name);
    			$send_contact   = $class_page->send_contact($upper_name, $email, $subject, $message, $now_date);
    			$class_user     = new User($pdo);
                $user_list      = $class_user->user_list();
    			foreach ($user_list as $data) {
	    			$mail = new PHPMailer;
			        //$mail->SMTPDebug = 3;                               // Enable verbose debug output
			        $mail->isSMTP();                                      // Set mailer to use SMTP
			        $mail->Host = 'srv2.niagahoster.co.id';  // Specify main and backup SMTP servers
			        $mail->SMTPAuth = true;                               // Enable SMTP authentication
			        $mail->Username = 'support@creativabali.com';                 // SMTP username
			        $mail->Password = 'aurora27';                           // SMTP password
			        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			        $mail->Port = 587;                                    // TCP port to connect to

			        $mail->From = 'support@creativabali.com';
			        $mail->FromName = 'Support Team Technologia Creativa';
			        $mail->addAddress($data->cr_adminEmail);     // Add a recipient
			        $mail->addReplyTo($email, $upper_name);
			        $mail->isHTML(true);                                  // Set email format to HTML

			        $mail->Subject = 'Contact Message';
			        $mail->Body    = '<table width="100%" border="0" align="center" style="background:#2D353C;" bgcolor="#2D353C" cellspacing="0" cellpadding="0">'.
			                         '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '<tr>'.
			                        '<td width="100%" align="center" style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
			                        '<img src="http://creativabali.com/logo-creatify-small.png" style="display: block" >'.
			                        '</td>'.
			                        '</tr>'.
			                        '<tr><td width="100%" align="center" style="background:#2D353C" bgcolor="#2D353C"><h3><b><font color="#FFFFFF">Create your creative website with Creatify</font></b></h3></td></tr>'.
			                        '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '<tr><td width="100%" style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
			                        '<p><font color="#a8acb1">'.$upper_name.' has sent a contact message. Click the link below to check it.</font></p>'.
			                        '</td></tr>'.
			                        '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
			                        '<font color="#00acac"><a style="color: #00acac" href="'.MADMINURL.'message/">Click here</a></font></td></tr>'.
			                        '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C"><font color="#a8acb1">Thank you for using <b>Creatify</b></font></td></tr>'.
			                        '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '</table>';

			        $mail->send();
			    }
			    echo 'success';
			}
			else {
				echo 'invalid-recaptcha';
			}
		}
		else {
			echo 'reenter-recaptcha';
		}
	}
?>