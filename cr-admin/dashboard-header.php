<?php
    $class_mail        = new Mail($pdo);
    $function_count_inbox_unread = $class_mail->count_inbox_unread($admin_id_session);

    $class_message     = new Message($pdo);
    $function_count_inbox_unread_message = $class_message->count_inbox_unread();
    $function_view_all_message_inbox     = $class_message->view_all_message_inbox($admin_id_session);
    $total = $function_count_inbox_unread_message + $function_count_inbox_unread;

?>
<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed navbar-toggle-left" data-click="sidebar-minify">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="<?php echo $router->generate('admin-dashboard') ?>" class="navbar-brand"><img src="<?php echo MADMINURL; ?>assets/img/logo-creatify.png" height="35"></a>
		</div>
		<!-- end mobile sidebar expand / collapse button -->
				
		<!-- begin header navigation right -->
		<ul class="nav navbar-nav navbar-right">
		    <li>
                <a href="<?php echo $router->generate('home') ?>" class="icon waves-effect waves-light" target="_blank"><i class="material-icons">public</i></a>
            </li>
			<li class="dropdown">
                <a id="totalnotif1" href="javascript:;" class="icon notification waves-effect waves-light" data-toggle="dropdown">
                </a>
				<ul id="notification-master" class="dropdown-menu media-list pull-right animated fadeInDown">
                    <li id="totalnotif2" class="dropdown-header bg-indigo text-white"></li>
                    <?php
                        if($function_view_all_message_inbox != false) {
                        foreach($function_view_all_message_inbox as $inbox) {
                    ?>
                    <li class="media">
                        <a href="<?php if($inbox->tipe == 'inbox') echo $router->generate('admin-dashboard-action', array('section' => 'inbox', 'action' => $inbox->idpesan)); elseif($inbox->tipe == 'message') echo $router->generate('admin-dashboard-action', array('section' => 'message', 'action' => $inbox->idpesan)) ?>">
                            <div class="media-left"><img src="<?php if($inbox->tipe == "message") { echo MADMINURL."assets/img/no-pic.png"; } elseif($inbox->tipe == "inbox") { $function_get_photo = $class_message->get_photo($inbox->idpesan); if($function_get_photo == "" || empty($function_get_photo)) echo MADMINURL."/ssets/img/no-pic.png"; else echo MADMINURL.$function_get_photo; } ?>" class="media-object" alt="<?php echo ucwords($inbox->messagename) ?>" /></div>
                            <div class="media-body">
                                <h6 class="media-heading"><?php echo ucwords($inbox->messagename) ?></h6>
                                <p>
                                    <?php
                                        $content     = strip_tags($inbox->content);
                                        $sub_content = strlen($content);
                                        if($sub_content <= 35) {
                                            echo $content;
                                        }
                                        else {
                                            echo substr($content,0,35)."..."; 
                                        }
                                    ?>
                                </p>
                                <div class="text-muted f-s-11"><?php echo $inbox->tanggal ?></div>
                            </div>
                        </a>
                    </li>
                    <?php }} ?>
                    <li class="dropdown-footer text-center">
                        <?php
                            if($total == 0) {
                                echo "&nbsp;";
                            }
                            else {
                        ?>
                        <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>">View more</a>
                        <?php
                            }
                        ?>
                    </li>
				</ul>
			</li>
			<li class="dropdown navbar-user">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                    <img <?php if($admin_photo == 'assets/img/no-pic.png' || $admin_photo == '') echo 'class="no-admin-photo"' ?> <?php if($admin_photo != 'assets/img/no-pic.png' || $admin_photo == '') { ?> src="<?php if($admin_photo == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$admin_photo ?>" <?php } else { ?> data-name="<?php echo ucwords($admin_display); ?>" data-font-size="28" data-width="36" data-height="36" <?php } ?> alt="<?php echo ucwords($admin_display); ?>" />
					<span class="hidden-xs"><?php echo ucwords($admin_display); ?></span>
				</a>
				<ul class="dropdown-menu animated fadeInLeft">
					<li class="arrow"></li>
                    <li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'profile')) ?>">Profile</a></li>
					<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'history')) ?>">History</a></li>
					<li><a id="totalinboxdrop" href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>"></a></li>
					<li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'settings')) ?>">Settings</a></li>
                    <li><a role="button" data-target="#modal-about-creatify" data-toggle="modal">About Creatify</a></li>
					<li class="divider"></li>
					<li><a href="<?php echo MADMINURL ?>logout.php">Log Out</a></li>
				</ul>
			</li>
		</ul>
		<!-- end header navigation right -->
	</div>
	<!-- end container-fluid -->
</div>
<!-- end #header -->