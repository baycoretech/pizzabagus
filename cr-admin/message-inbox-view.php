<?php
    $class_message  = new Message($pdo);
    $function_count_inbox  = $class_message->count_inbox();
    $function_count_trash  = $class_message->count_trash();
    $function_count_inbox_unread = $class_message->count_inbox_unread();
    if($action == "read") {
        $function_view_inbox  = $class_message->view_inbox_read();
    }
    elseif($action == "unread") {
        $function_view_inbox  = $class_message->view_inbox_unread();
    }
    else {
        $function_view_inbox  = $class_message->view_inbox_all();
    }
?>
<!-- begin vertical-box -->
<div class="vertical-box">
    <!-- begin vertical-box-column -->
    <div class="vertical-box-column width-250">
        <!-- begin wrapper -->
        <div class="wrapper">
            <p><b>FOLDERS</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm">
                <li class="active"><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'message')) ?>"><i class="fa fa-inbox fa-fw m-r-5"></i> Inbox <?php if($function_count_inbox != 0) { ?><span class="badge badge-square pull-right"><?php echo $function_count_inbox ?></span><?php } ?> <?php if($function_count_inbox_unread != 0) { ?><span class="badge badge-success badge-square pull-right"><?php echo $function_count_inbox_unread ?> unread</span><?php } ?></a></li>
                <li><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'messagetrash')) ?>"><i class="fa fa-trash fa-fw m-r-5"></i> Trash <?php if($function_count_trash != 0) { ?><span class="badge badge-square pull-right"><?php echo $function_count_trash ?></span><?php } ?></a></li>
            </ul>
            <p><b>LABEL</b></p>
            <ul class="nav nav-pills nav-stacked nav-sm m-b-0">
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-success"></i> Read</a></li>
                <li><a><i class="fa fa-fw m-r-5 fa-circle text-warning"></i> Unread</a></li>
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
                        <li <?php if(!isset($action)) echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'message')) ?>"><i class="fa <?php if(!isset($action)) echo 'fa-circle' ?> f-s-10 fa-fw m-r-5"></i> All</a></li>
                        <li <?php if($action == "read") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'message', 'action' => 'read')) ?>"><i class="fa <?php if($action == "read") echo 'fa-circle' ?> f-s-10 fa-fw m-r-5"></i> Read</a></li>
                        <li <?php if($action == "unread") echo 'class="active"' ?>><a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'message', 'action' => 'unread')) ?>"><i class="fa <?php if($action == "unread") echo 'fa-circle' ?> f-s-10 fa-fw m-r-5"></i> Unread</a></li>
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
                if($function_view_inbox == false) {
            ?>
                <div class="alert alert-info no-rounded-corner fade in m-t-15 m-b-15">
                    <strong>Empty!</strong>
                    You have no message right now.
                </div>
            <?php
                }
                else {
                    foreach ($function_view_inbox as $data) {
                        if($data->cr_messageRead == 1) {
                            $label = "success";
                        }
                        elseif($data->cr_messageRead == 0) {
                            $label = "warning";
                        }
            ?>
            <li class="list-group-item <?php echo $label ?>">
                <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'message', 'action' => $data->cr_messageID)) ?>" class="email-user">
                    <img class="no-admin-photo" src="" alt="<?php echo ucwords($data->cr_messageName) ?>" data-font-size="36" data-width="50" data-height="50" data-name="<?php echo ucwords($data->cr_messageName) ?>" />
                </a>
                <div class="email-info">
                    <span class="email-time" data-livestamp="<?php echo $data->cr_messageDate ?>">
                    </span>
                    <h5 class="email-title">
                        <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => 'message', 'action' => $data->cr_messageID)) ?>"><?php echo $data->cr_messageSubject ?></a>
                        <?php if($data->cr_messageRead == 1) { ?>
                            <span class="label label-success f-s-10">Read</span>
                        <?php } else { ?>
                            <span class="label label-warning f-s-10">Unread</span>
                        <?php } ?>
                    </h5>
                    <p class="email-desc">
                        <?php
                            echo short_description($data->cr_messageContent, 150);
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
            if($function_view_inbox != false) {
        ?>
        <div class="wrapper bg-silver-lighter clearfix">
            <div class="m-t-5"><?php if($function_count_inbox == 0) echo "You have no message right now"; elseif($function_count_inbox == 1) echo $function_count_inbox." message"; else echo $function_count_inbox." messages" ?></div>
        </div>
        <?php
            }
        ?>
        <!-- end wrapper -->
    </div>
    <!-- end vertical-box-column -->
</div>
<!-- end vertical-box -->