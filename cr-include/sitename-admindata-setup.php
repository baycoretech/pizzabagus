<?php
    require __DIR__.'/error-report.php';
    require __DIR__.'/database/connection.php';
    require __DIR__.'/autoloader.php';
    require __DIR__.'/setup-function.php';

    $site_name        = $_POST['site_name'];
    $site_url         = $_POST['site_url'];
    $folder_name      = $_POST['folder_name'];
    $admin_username   = $_POST['admin_username'];
    $admin_password   = $_POST['admin_password'];
    $repeat_password  = $_POST['repeat_password'];
    $admin_email      = $_POST['admin_email'];
    $link_url         = $_SERVER['HTTP_HOST'];
    $get_creativabali = strpos($link_url, "creativabali.com");
    if($get_creativabali !== false) {
        $url_value = "1"; 
    }
    else {
        $url_value = "0"; 
    }
    $admin_password_encrypt = generate_hash($admin_password);

    if(empty($site_name) || empty($site_url) || empty($admin_username) || empty($admin_password) || empty($repeat_password) || empty($admin_email)){
        echo 'empty-field';                 
    }
    else {
        if($admin_password !== $repeat_password) {
            echo 'mismatch-password';
        }
        else {
            $class_setup_page = new Setup_Page($pdo);
            $function_create_database_table = $class_setup_page->create_database_table($site_name, $site_url, $folder_name, $admin_username, $admin_password_encrypt, $admin_password, $admin_email, $url_value);
            if($function_create_database_table == true) {
                /*
                require __DIR__.'/phpmailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;
                $mail->isSMTP();  
                $mail->Host = 'srv2.niagahoster.co.id';  
                $mail->SMTPAuth = true;   
                $mail->Username = 'noreply@creativabali.com'; 
                $mail->Password = 'aurora27';     
                $mail->SMTPSecure = 'tls';       
                $mail->Port = 587;   
                $mail->From = 'noreply@creativabali.com';
                $mail->FromName = 'Technologia Creativa';
                $mail->addAddress($adminEmail);   
                $mail->addReplyTo('noreply@creativabali.com.com', 'Technologia Creativa');
                $mail->isHTML(true);   
                $mail->Subject = 'Welcome to Creatify';
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
                    '<p><font color="#a8acb1">Your login information :</font></p>'.
                    '</td></tr>'.
                    '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
                    '<font color="#a8acb1">Username : '.$adminUsername.'</font></td></tr>'.
                                    '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C">'.
                    '<font color="#a8acb1">Password : '.$adminPassword.'</font></td></tr>'.
                    '<tr><td width="100%" height="15" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                    '<tr><td style="background:#2D353C;padding-left:20px;padding-right:20px;" bgcolor="#2D353C"><font color="#a8acb1">Please save the login information above and do not reply to this email. Thank you for using <b>Creatify</b></font></td></tr>'.
                    '<tr><td width="100%" height="30" style="background:#2D353C" bgcolor="#2D353C"></td></tr>'.
                    '</table>';
                    $mail->AltBody = 'Create your creative website with Creatify. Your login information : Username: '.$adminUsername.' Password: '.$adminPassword.'. Please save the login information and do not reply to this email. Thank you for using Creatify';
                if(!$mail->send()) {
                    echo 'mail-failed';
                } else {
                    echo 'success';
                }
                */
                echo 'success';
            }
            else {
                echo 'failed';
            }
        } 
    }
?>