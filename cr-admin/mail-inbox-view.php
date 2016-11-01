<?php
    $class_mail  = new Mail($pdo);
    $total_inbox  = $class_mail->count_inbox($admin_id_session);
    $total_sent   = $class_mail->count_sent($admin_id_session);
    $total_trash  = $class_mail->count_trash($admin_id_session);
    $total_inbox_unread = $class_mail->count_inbox_unread($admin_id_session);
    if($action == "read") {
        $view_inbox  = $class_mail->view_inbox_read($admin_id_session);
    }
    elseif($action == "unread") {
        $view_inbox  = $class_mail->view_inbox_unread($admin_id_session);
    }
    else {
        $view_inbox  = $class_mail->view_inbox_all($admin_id_session);
    }
?>
<!-- begin vertical-box -->
<div class="vertical-box">
    <!-- begin vertical-box-column -->
    <div class="vertical-box-column width-250">
        <!-- begin wrapper -->
        <div class="wrapper bg-silver text-center">
            <a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'compose')) ?>" class="btn btn-success p-l-40 p-r-40 btn-sm">
                Compose
            </a>
        </div>
        <!-- end wrapper -->
        <!-- begin wrapper -->
        <div class="wrapper">
            <p><b>FOLDERS</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm">
                <li class="active"><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <?php if($total_inbox != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_inbox ?></span><?php } ?> <?php if($total_inbox_unread != 0) { ?><span class="badge badge-success badge-square pull-right"><?php echo $total_inbox_unread ?> unread</span><?php } ?></a></li>
                <li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'sent')) ?>"><i class="fa fa-send fa-fw m-r-5"></i> Sent <?php if($total_sent != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_sent ?></span><?php } ?></a></li>
                <li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'trash')) ?>"><i class="fa fa-trash fa-fw m-r-5"></i> Trash <?php if($total_trash != 0) { ?><span class="badge badge-square pull-right"><?php echo $total_trash ?></span><?php } ?></a></li>
            </ul>
            <p><b>LABEL</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Administrator</a></li>
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Editor</a></li>
            </ul>
        </div>
        <!-- end wrapper -->
    </div>
    <!-- end vertical-box-column -->
    <!-- begin vertical-box-column -->
    <div class="vertical-box-column">
        <!-- begin wrapper -->
        <div class="wrapper bg-silver-lighter">
            <!-- begin btn-toolbar -->
            <div class="btn-toolbar">
                <!-- begin btn-group -->
                <div class="btn-group dropdown">
                    <button class="btn btn-white btn-sm dropdown-toggle" data-toggle="dropdown">
                        <?php
                            if($action == "read")
                                echo "Read";
                            elseif($action == "unread")
                                echo "Unread";
                            else
                                echo "View All";
                        ?> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu text-left text-sm">
                        <li <?php if(!isset($action)) echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'inbox')) ?>"><i class="fa <?php if(!isset($action)) echo 'fa-circle' ?> f-s-10 fa-fw m-r-5"></i> All</a></li>
                        <li <?php if($action == "read") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'inbox', 'action' => 'read')) ?>"><i class="fa <?php if($action == "read") echo 'fa-circle' ?> f-s-10 fa-fw m-r-5"></i> Read</a></li>
                        <li <?php if($action == "unread") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'inbox', 'action' => 'unread')) ?>"><i class="fa <?php if($s=="unread") echo 'fa-circle' ?> f-s-10 fa-fw m-r-5"></i> Unread</a></li>
                    </ul>
                </div>
                <!-- end btn-group -->
                <!-- begin btn-group -->
                <div class="btn-group">
                    <button class="btn btn-sm btn-white" data-toggle="tooltip" data-placement="top" data-title="Refresh" data-original-title="" title="" onClick="window.location.reload()"><i class="fa fa-refresh"></i></button>
                </div>
                <!-- end btn-group -->
            </div>
            <!-- end btn-toolbar -->
        </div>
        <!-- end wrapper -->
        <!-- begin list-email -->
        <ul class="list-group list-group-lg no-radius list-email">
            <?php
                if($view_inbox == false) {
            ?>
                <div class="alert alert-info no-rounded-corner fade in m-t-15 m-b-15">
                    <strong>Empty!</strong>
                    You have no message right now.
                </div>
            <?php
                }
                else {
                    foreach ($view_inbox as $data) {
                        if($data->cr_adminLevel == 1) {
                            $label = "success";
                            $level = "Administrator";
                        }
                        elseif($data->cr_adminLevel == 2) {
                            $label = "warning";
                            $level = "Editor";
                        }
            ?>
            <li class="list-group-item <?php echo $label ?>">
                <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'inbox', 'action' => $data->cr_inboxID)) ?>" class="email-user">
                    <img src="<?php if($data->cr_adminPhoto == '') echo MADMINURL."assets/img/no-pic.png"; else echo MADMINURL.$data->cr_adminPhoto ?>" class="media-object rounded-corner <?php if($data->cr_adminPhoto == 'assets/img/no-pic.png' || $data->cr_adminPhoto == '') echo 'no-admin-photo' ?>" data-font-size="36" data-width="50" data-height="50" data-name="<?php echo ucwords($data->cr_adminDisplayName) ?>" alt="<?php echo ucwords($data->cr_adminDisplayName) ?>">
                </a>
                <div class="email-info">
                    <span class="email-time" data-livestamp="<?php echo $data->cr_inboxDate ?>">
                    </span>
                    <h5 class="email-title">
                        <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'inbox', 'action' => $data->cr_inboxID)) ?>"><?php echo ucwords($data->cr_adminDisplayName) ?> - <em><?php echo $data->cr_inboxSubject ?></em></a>
                        <span class="label label-<?php echo $label ?> f-s-10"><?php echo $level ?></span> <?php if($data->cr_inboxRead == 1) { ?><span class="label label-primary f-s-10">Read</span><?php } ?>
                    </h5>
                    <p class="email-desc">
                        <?php
                            echo short_description($data->cr_inboxContent, 150);
                        ?>
                    </p>
                </div>
            </li>
            <?php
                    }
                }
            ?>
            
        </ul>
        <!-- end list-email -->
        <!-- begin wrapper -->
        <?php
            if($view_inbox != false) {
        ?>
        <div class="wrapper bg-silver-lighter clearfix">
            <div class="m-t-5"><?php if($total_inbox == 0) echo "You have no message right now"; elseif($total_inbox == 1) echo $total_inbox." message"; else echo $total_inbox." messages" ?></div>
        </div>
        <?php
            }
        ?>
        <!-- end wrapper -->
    </div>
    <!-- end vertical-box-column -->
</div>
<!-- end vertical-box -->