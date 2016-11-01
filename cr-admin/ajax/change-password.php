<?php
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $emailuser     = $_POST['emailuser'];
    $password      = $_POST['password'];
    $repassword    = $_POST['repassword'];


    if(empty($password) || empty($repassword)) {
        echo "empty-field";
    }
    else {
        if($password == $repassword) {
            require __DIR__.'/../../cr-include/phpmailer/PHPMailerAutoload.php';

            $class_administrator   = new Administrator($pdo);
            $newpassword = generate_hash($password);
            $change_password  = $class_administrator->change_password($emailuser, $newpassword);
            if($change_password == true) {
                $get_username = $class_administrator->get_username($emailuser);

                $mail = new PHPMailer;

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'srv2.niagahoster.co.id';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'noreply@creativabali.com';                 // SMTP username
                $mail->Password = 'aurora27';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->From = 'noreply@creativabali.com';
                $mail->FromName = 'Technologia Creativa';
                $mail->addAddress($emailuser);     // Add a recipient
                $mail->addReplyTo('noreply@creativabali.com', 'Technologia Creativa');
                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'New Password for Creatify';
                $mail->Body    = '<table width="100%" border="0" align="center" style="background:#D9E0E7;" bgcolor="#D9E0E7" cellspacing="0" cellpadding="0">'.
                                 '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                                '<tr>'.
                                '<td width="100%" align="center" style="background:#2D353C" bgcolor="#2D353C">'.
                                '<img src="http://creativabali.com/logo-creatify-small.png" style="display: block" >'.
                                '</td>'.
                                '</tr>'.
                                '<tr><td width="100%" align="center" style="background:#2D353C" bgcolor="#2D353C"><h3><b><font color="#FFFFFF">Create your creative website with Creatify</font></b></h3></td></tr>'.
                                '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                                '<tr><td width="100%" style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
                                '<p><font color="#a8acb1">Your login information :</font></p>'.
                                '</td></tr>'.
                                '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
                                '<font color="#a8acb1">Username : '.$get_username->cr_adminUsername.'</font></td></tr>'.
                                '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
                                '<font color="#a8acb1">Password : '.$password.'</font></td></tr>'.
                                '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                                '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C"><font color="#a8acb1">Please careful with your new login information and do not reply to this email. Thank you for using <b>Creatify</b></font></td></tr>'.
                                '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                                '</table>';

                if(!$mail->send()) {
                    echo "error-email";
                } 
                else { 
                    echo "true";
                }
            }
            else {
                echo 'error';
            }
        }
        else {
            echo "notsame";
        }
    }
?>