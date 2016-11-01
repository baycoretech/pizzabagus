<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
	require __DIR__.'/../../cr-include/altorouter.php';
    require __DIR__.'/../include/global-function.php';

    $class_general_setting = new General_Setting($pdo);
	$function_folder_name  = $class_general_setting->folder_name();
    $router       = new AltoRouter();
    if($function_folder_name != false) {
        $router->setBasePath('/'.$function_folder_name);
    }
	require __DIR__.'/../../cr-include/routes.php';

    $admin_login_id = $_SESSION['cr_adminID'];

    $class_mail     = new Mail($pdo);
    $function_count_inbox_unread = $class_mail->count_inbox_unread($admin_login_id);

    $class_message  = new Message($pdo);
    $function_count_message_unread = $class_message->count_inbox_unread();

    $function_all_message_inbox  = $class_message->view_all_message_inbox($admin_login_id);
    $total = $function_count_inbox_unread + $function_count_message_unread;

    echo '<li class="dropdown-header bg-indigo text-white">';
    if($total == 0) {
        echo "There is no notification";
    }
    else {
        echo 'Notifications (<span>'.$total.'</span>)';
    }
    echo '</li>';
	
    if($function_all_message_inbox != false) {
    	foreach ($function_all_message_inbox as $data) {
            $date = date('d F Y H:i', strtotime($data->tanggal)); 
?>
<li class="media">
    <a href="<?php
        if($data->tipe == 'inbox') {
        	echo $router->generate('admin-dashboard-action', array('section' => 'inbox', 'action' => $data->idpesan));
        }
        elseif($data->tipe == 'message') {
        	echo $router->generate('admin-dashboard-action', array('section' => 'message', 'action' => $data->idpesan));
        }
    ?>">
        <div class="media-left">
            <?php
                if($data->tipe == "message") {
            ?>
            <img class="media-object no-admin-photo" src="" data-font-size="20" data-width="36" data-height="36" data-name="<?php echo ucwords($data->messagename) ?>" alt="<?php echo ucwords($data->messagename) ?>">
            <?php
                }
                elseif($data->tipe == "inbox") {
                    $function_get_photo = $class_mail->get_photo($data->idpesan);
            ?>
            <img src="<?php if($function_get_photo != 'assets/img/no-pic.png') echo MADMINURL.$function_get_photo ?>" class="media-object <?php if($function_get_photo == 'assets/img/no-pic.png' || $function_get_photo == '') echo 'no-admin-photo' ?>" data-font-size="20" data-width="36" data-height="36" data-name="<?php echo ucwords($data->messagename) ?>" alt="<?php echo ucwords($data->messagename) ?>">
            <?php } ?>
        </div>
        <div class="media-body">
            <h6 class="media-heading"><?php echo ucwords($data->messagename) ?></h6>
                <p>
                    <?php
                        $content    = strip_tags($data->content);
                        $subcontent = strlen($content);
                        if($subcontent <= 35) {
                            echo $content;
                        }
                        else {
                            echo substr($content,0,35)."..."; 
                        }
                    ?>
                </p>
                <div class="text-muted"><?php echo $date ?></div>
            </div>
    </a>
</li>
<?php
        }
    }

    if($total != 0) {
?>
<li class="dropdown-footer text-center">
    <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>">View more</a>
</li>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.no-admin-photo').initial();
    })
</script>