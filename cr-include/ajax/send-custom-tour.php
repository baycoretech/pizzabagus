<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../error-report.php';
    require __DIR__.'/../database/connection.php';
    require __DIR__.'/../autoloader.php'; 
    require __DIR__.'/../setup-function.php'; 
    require __DIR__.'/../global-function.php';

    $custom_tour_name       = $_POST['custom_tour_name'];
    $custom_tour_email      = $_POST['custom_tour_email'];
    $custom_tour_phone      = $_POST['custom_tour_phone'];
    $custom_tour_address    = $_POST['custom_tour_address'];
    $custom_tour_adult      = $_POST['custom_tour_adult'];
    $custom_tour_kids       = $_POST['custom_tour_kids'];
    $custom_tour_infant     = $_POST['custom_tour_infant'];
    $custom_tour_request    = $_POST['custom_tour_request'];
	$captcha                = $_POST['g-recaptcha-response'];

    if(empty($custom_tour_name) || empty($custom_tour_email) || empty($custom_tour_phone) || empty($custom_tour_address)  || empty($custom_tour_adult) || empty($custom_tour_request)) {
        echo 'empty-field';
    }
    else {
        if(!empty($captcha)) {
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
 
            $results = json_decode($results, true);
            if($results['success']) {
                require __DIR__.'/../phpmailer/PHPMailerAutoload.php';
                $class_user = new User($pdo);
                $user_list  = $class_user->user_list();
                $upper_name = ucwords($custom_tour_name);
                foreach ($user_list as $data) {
                    $mail = new PHPMailer;
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
                    $mail->addReplyTo($custom_tour_email, $upper_name);
                    $mail->isHTML(true);                                  // Set email format to HTML

                    $mail->Subject = 'Custom Tour from '.$upper_name;
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
                                    '<p><font color="#a8acb1">'.$upper_name.' has sent a custom tour. Booking information :</font></p>'.
                                    '<p><font color="#a8acb1">Name : '.$upper_name.'</font><br>'.
                                    '<font color="#a8acb1">Email : '.$custom_tour_email.'</font><br>'.
                                    '<font color="#a8acb1">Phone : '.$custom_tour_phone.'</font><br>'.
                                    '<font color="#a8acb1">Address : '.$custom_tour_address.'</font><br>'.
                                    '<font color="#a8acb1">Adult : '.$custom_tour_adult.'</font><br>'.
                                    '<font color="#a8acb1">Kids : '.$custom_tour_kids.'</font><br>'.
                                    '<font color="#a8acb1">Infant : '.$custom_tour_infant.'</font><br>'.
                                    '<font color="#a8acb1">Request : '.$custom_tour_request.'</font></p>'.
                                    '</td></tr>'.
                                    '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                                    '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C"><font color="#a8acb1">Thank you for using <b>Creatify</b></font></td></tr>'.
                                    '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                                    '</table>';

                    $mail->send();
                }
                echo 'success';
            }
            else {
                echo 'invalid-captcha';
            }
        }
        else {
            echo 'reenter-captcha';
        }
    }
?>