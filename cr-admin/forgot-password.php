<?php
	require_once "include/database.php";//database
    require_once "include/class-db.php";//cek database
    require_once "include/class-login.php";//cek database
    require_once "include/class-data.php";//class data
    require_once "include/global-function.php";//global function
    require_once ("../cr-include/phpmailer/PHPMailerAutoload.php");//PHP Mailer

	$o_getDatabase = new getDatabase($pdo);
    $v_getDatabase = $o_getDatabase->getdb();

    $emailforgot   = $_POST['email'];

    $o_user    = new user($pdo);
    $v_checkFP = $o_user->checkFP($_POST['email']);

    if($v_checkFP == "ada") {
        $md5email      = md5($emailforgot);
        $token         = generateHash("iforgotthepassword");
        $v_insertToken = $o_user->insertToken($emailforgot, $token);

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
        $mail->addAddress($emailforgot);     // Add a recipient
        $mail->addReplyTo('noreply@creativabali.com', 'Technologia Creativa');
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Change Password for Creatify';
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
                        '<p><font color="#a8acb1">Click the link below to change your password</font></p>'.
                        '</td></tr>'.
                        '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
                        '<font color="#00acac"><a style="color: #00acac" href="'.MADMINURL.'/verify.php?e='.$md5email."&amp;".'token='.$token.'">Click here</a></font></td></tr>'.
                        '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                        '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C"><font color="#a8acb1">Please careful with your login information and do not reply to this email. Thank you for using <b>Creatify</b></font></td></tr>'.
                        '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                        '</table>';

        if(!$mail->send()) {
            echo "fail";
        } else { 
            echo "true";
        }
	}
	else {
		echo "false";
	}
    
?>