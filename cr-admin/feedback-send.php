<?php
		$name     = $_POST['name'];
		$subject  = $_POST['subject'];
		$emailto  = $_POST['email'];
		$feedback = $_POST['feedback'];
		$captcha  = $_POST['g-recaptcha-response'];

		if(empty($name) || empty($emailto) || empty($feedback) || empty($captcha)) {
			$errMsg='<div class="alert alert-danger fade in"><strong>Error!</strong> Please fill all field.<span class="close" data-dismiss="alert">×</span></div>';
		}
		else {
			if(!empty($captcha)) {
				require_once "include/database.php";//database
			    require_once "include/class-db.php";//cek database
			    require_once "include/class-data.php";//class data
			    require_once "include/global-function.php";//global function
			    require_once ("../cr-include/phpmailer/PHPMailerAutoload.php");//PHP Mailer

				$o_getSettings       = new settings($pdo);
			    $v_getSettingsSecret = $o_getSettings->viewSettingsreCaptchaSecret();
				$google_url="https://www.google.com/recaptcha/api/siteverify";
				$secret=$v_getSettingsSecret->cr_settingValue;
				$ip=$_SERVER['REMOTE_ADDR'];
				$captchaurl=$google_url."?secret=".$secret."&response=".$captcha."&remoteip=".$ip;

				$curl_init = curl_init();
				curl_setopt($curl_init, CURLOPT_URL, $captchaurl);
				curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl_init, CURLOPT_TIMEOUT, 10);
				$results = curl_exec($curl_init);
				curl_close($curl_init);
				
				$results= json_decode($results, true);

		        if($results['success']){
					$mail = new PHPMailer;

			        //$mail->SMTPDebug = 3;                               // Enable verbose debug output

			        $mail->isSMTP();                                      // Set mailer to use SMTP
			        $mail->Host = 'srv2.niagahoster.co.id';  // Specify main and backup SMTP servers
			        $mail->SMTPAuth = true;                               // Enable SMTP authentication
			        $mail->Username = 'support@creativabali.com';                 // SMTP username
			        $mail->Password = 'aurora27';                           // SMTP password
			        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			        $mail->Port = 587;                                    // TCP port to connect to

			        $mail->From = "$emailto";
			        $mail->FromName = "$name";
			        $mail->addAddress('support@creativabali.com');     // Add a recipient
			        $mail->addReplyTo("$emailto", "$name");
			        $mail->isHTML(true);                                  // Set email format to HTML

			        $mail->Subject = "$subject";
			        $mail->Body    = '<table width="100%" border="0" align="center" style="background:#2D353C;" bgcolor="#2D353C" cellspacing="0" cellpadding="0">'.
			                         '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '<tr>'.
			                        '<td width="100%" align="center" style="background:#2D353C" bgcolor="#2D353C">'.
			                        '<img src="http://creativabali.com/logo-creatify-small.png" style="display: block" >'.
			                        '</td>'.
			                        '</tr>'.
			                        '<tr><td width="100%" align="center" style="background:#2D353C" bgcolor="#2D353C"><h3><b><font color="#FFFFFF">Create your creative website with Creatify</font></b></h3></td></tr>'.
			                        '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '<tr><td width="100%" style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
			                        '<p><font color="#a8acb1">Here is feedback from '.$name.': </font></p>'.
			                        '</td></tr>'.
			                        '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
			                        '<p><font color="#a8acb1">'.$feedback.'</font></p></td></tr>'.
			                        '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
			                        '</table>';

			        if(!$mail->send()) {
			            echo '<div class="alert alert-danger fade in"><strong>Error!</strong> There was a problem sending your feedback.<span class="close" data-dismiss="alert">×</span></div>';
			        } else { 
			            echo '<div class="alert alert-success fade in"><strong>Success!</strong> Your feedback has been successfully sent.<span class="close" data-dismiss="alert">×</span></div>';
			        }
				}else{
					echo '<div class="alert alert-danger fade in"><strong>Error!</strong> Invalid reCAPTCHA code.<span class="close" data-dismiss="alert">×</span></div>';
				}
		    }
		    else{
				echo '<div class="alert alert-danger fade in"><strong>Error!</strong> Please re-enter your reCAPTCHA.<span class="close" data-dismiss="alert">×</span></div>';
			}
		}
?>