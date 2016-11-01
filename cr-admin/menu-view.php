<?php
    $function_homepage_link = $class_settings->view_settings_homepage_link();
    $function_view_menu_for_parent = $class_menu->view_menu_for_parent();
?>
<div class="row">
    <div class="col-md-7">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Menu Ordering</h4>
            </div>
            <div class="panel-toolbar">
                <button type="button" class="btn btn-success m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => 'add')) ?>'"><i class="fa fa-plus"></i> Add Menu</button>
                <button type="button" class="btn btn-success m-b-5" data-toggle="modal" data-target="#modal-add-customlink"><i class="fa fa-link"></i> Add Custom Link</button>
                <?php if($function_homepage_link->cr_settingValue == "show") { ?>
                    <button id="button-hide-home" type="button" class="btn btn-success m-b-5" data-toggle="tooltip" data-placement="bottom" title="Home link is visible" data-status="hide"><i class="fa fa-eye-slash"></i> Hide Home</button>
                <?php } elseif($function_homepage_link->cr_settingValue == "hide") { ?>
                    <button id="button-hide-home" type="button" class="btn btn-success m-b-5" data-toggle="tooltip" data-placement="bottom" title="Home link is invisible" data-status="show"><i class="fa fa-eye"></i> Show Home</button>
                <?php } if($function_view_menu != false) { ?>
                    <a href="javascript:void(0);" type="button" class="btn btn-warning m-r-5 m-b-5 reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder Menu</a>
                <?php } ?>
            </div>
            <div class="panel-body <?php if($function_view_menu == false) echo 'p-0' ?>">
                <div class="gallery-reorder">
                    <?php if($function_view_menu != false) { ?>
                    <div id="reorder-helper" style="display:none;">
                        <div class="alert alert-info fade in m-b-15">
                            1. Drag menus to reorder.<br>2. Click 'Save Reordering' when finished.
                        </div>
                    </div>
                    <?php } if($function_view_menu == false) { ?>
                        <div class="alert alert-info no-rounded-corner fade in m-b-0">
                            <strong>Empty!</strong>
                            No menu found.
                            <span class="close" data-dismiss="alert">×</span>
                        </div>
                    <?php } else { ?>
                    <ul class="reorder_ul reorder-photos-list">
                    <?php
                        foreach ($function_view_menu as $menu) {
                            $menu_id       = $menu->cr_menuID;
                            $menu_title    = $menu->cr_menuTitle;
                            $menu_title_id = $menu->cr_menuTitle_id;
                            $menu_slug     = $menu->cr_menuLink;
                            $menu_status   = $menu->cr_menuStatus;
                            $menu_sub      = $menu->cr_menuHasSub;
                            $menu_opt      = $menu->cr_option;
                            $menu_templ    = $menu->cr_pagetemplateID;
                            $function_view_submenu_in_menu = $class_menu->view_submenu_in_menu($menu_id);
                    ?>
                        <li id="image_li_<?php echo $menu_id; ?>" class="ui-sortable-handle">
                            <div class="menu-reorder-wrapper">
                                <a href="javascript:void(0);" style="float:none;" class="image_link">
                                    <h4 <?php if($menu_status == '0') echo 'class="unpublish-border"' ?> <?php if($action == $menu_slug) echo 'style="background-color: #D9E0E7!important; font-weight: bold;"'; ?>><?php echo $menu_title; ?>
                                        <?php
                                            if($menu_sub == '1') {
                                                if($function_view_submenu_in_menu == '0') {
                                        ?>
                                        <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-delete-menu" data-dm="<?php echo $menu_title; ?>" data-deletemenu="<?php echo $menu_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                        <?php
                                                }
                                                else {
                                        ?>
                                        <span class="pull-right m-l-10" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $menu_slug)) ?>'"><i class="fa fa-<?php if($action == $menu_slug) echo "chevron-right"; else echo "th-list"; ?> text-warning"></i></span>
                                        <?php
                                                }
                                            }
                                            else {
                                        ?>
                                        <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-delete-menu" data-dm="<?php echo $menu_title; ?>" data-deletemenu="<?php echo $menu_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                        <?php
                                            }
                                            if($menu_opt == "customlink") {
                                        ?>
                                        <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-customlink" data-dm="<?php echo $menu_title; ?>" data-id="<?php echo $menu_id; ?>" data-cltitle="<?php echo $menu_title; ?>" data-cltitleid="<?php echo $menu_title_id; ?>" data-clink="<?php echo $menu_slug; ?>" data-clstate="<?php echo $menu_status; ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                                        <?php
                                            }
                                            else {
                                        ?>
                                        <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-menu" data-pt="<?php echo $menu_templ; ?>" data-dm="<?php echo $menu_title; ?>" data-menutitleid="<?php echo $menu_title_id; ?>" data-id="<?php echo $menu_id; ?>" data-menutitle="<?php echo $menu_title; ?>" data-state="<?php echo $menu_status; ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                                        <?php
                                            }
                                        ?>
                                        <span class="pull-right m-l-10">
                                        <?php 
                                            if($menu_status == 0)
                                                echo '<i class="fa fa-globe text-inverse" data-toggle="tooltip" data-placement="bottom" title="Unpublish"></i>';
                                            elseif($menu_status == 1)
                                                echo '<i class="fa fa-globe text-success"data-toggle="tooltip" data-placement="bottom" title="Publish"></i>'; 
                                        ?>
                                        </span>
                                        <?php
                                            if($menu_templ == "10") {
                                        ?>
                                        <span class="pull-right">
                                            <i class="fa fa-cutlery text-success cpointer" data-toggle="tooltip" data-placement="bottom" title="Food or Drinks Menu"></i>
                                        </span>
                                        <?php
                                            }
                                            if($menu_opt == "gallery") {
                                        ?>
                                        <span class="pull-right">
                                            <i class="fa fa-picture-o text-success cpointer" data-toggle="tooltip" data-placement="bottom" title="Set as Gallery"></i>
                                        </span>
                                        <?php
                                            }
                                            elseif($menu_opt == "customlink") {
                                        ?>
                                        <span class="pull-right">
                                            <i class="fa fa-link text-success cpointer" data-toggle="tooltip" data-placement="bottom" title="Custom Link"></i>
                                        </span>
                                        <?php
                                            }
                                        ?>
                                    </h4>
                                </a>
                            </div>
                        </li>
                    <?php } ?>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php 
        if(isset($action)) {
            $function_view_submenu = $class_menu->view_submenu($action);
    ?>
    <div class="col-md-5">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Submenu Ordering</h4>
            </div>
            <div class="panel-toolbar">
                <?php if($function_view_submenu == false) { echo ""; } else { ?>
                    <a href="javascript:void(0);" type="button" class="btn btn-warning m-r-5 m-b-5 reorder_submenu" id="save_submenu_reorder"><i class="fa fa-reorder"></i> Reorder Submenu</a>
                <?php } ?>
            </div>
            <div class="panel-body">
                <?php if($function_view_submenu == false) { ?>
                    <div class="alert alert-info fade in m-b-15">
                        <strong>Empty!</strong>
                        No submenu found.
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                <?php } else { ?>
                <div class="gallery-reorder">
                    <?php if($function_view_submenu == false) { echo ""; } else { ?>
                    <div id="reorder-submenu-helper" style="display:none;">
                        <div class="alert alert-info fade in m-b-15">
                            1. Drag submenus to reorder.<br>2. Click 'Save Reordering' when finished.
                        </div>
                    </div>
                    <?php } ?>
                    <ul class="reorder_ul reorder-submenu-list">
                    <?php 
                        foreach ($function_view_submenu as $submenu) {
                            $submenu_id       = $submenu->cr_submenuID;
                            $submenu_title    = $submenu->cr_submenuTitle;
                            $submenu_title_id = $submenu->cr_submenuTitle_id;
                            $submenu_slug     = $submenu->cr_submenuLink;
                            $submenu_status   = $submenu->cr_submenuStatus;
                            $submenu_templ    = $submenu->cr_pagetemplateID;
                            $submenu_opt      = $submenu->cr_option;
                    ?>
                        <li id="submenu_li_<?php echo $submenu_id; ?>" class="ui-sortable-handle">
                            <div class="menu-reorder-wrapper">
                            <a style="float:none;" class="image_submenu_link">
                                <h4><?php echo $submenu_title; ?>
                                    <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-delete-submenu" data-dn="<?php echo $submenu_title; ?>" data-deletesubmenu="<?php echo $submenu_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                    <?php if($submenu_opt == "customlink") { ?>
                                    <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-subcustomlink" data-dm="<?php echo $submenu_title; ?>" data-id="<?php echo $submenu_id; ?>" data-cltitle="<?php echo $submenu_title; ?>" data-cltitleid="<?php echo $submenu_title_id; ?>" data-clink="<?php echo $submenu_slug; ?>" data-clstate="<?php echo $submenu_status; ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                                    <?php } else { ?>
                                    <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-submenu" data-dm="<?php echo $submenu_title; ?>" data-id="<?php echo $submenu_id; ?>" data-submenutitle="<?php echo $submenu_title; ?>" data-submenutitleid="<?php echo $submenu_title_id; ?>" data-state="<?php echo $submenu_status; ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                                    <?php } if($submenu_opt == "gallery") { ?>
                                    <span class="pull-right">
                                        <i class="fa fa-picture-o text-success cpointer m-l-10" data-toggle="tooltip" data-placement="bottom" title="Set as Gallery"></i>
                                    </span>
                                    <?php } elseif($submenu_opt == "customlink") { ?>
                                    <span class="pull-right">
                                        <i class="fa fa-link text-success cpointer m-l-10" data-toggle="tooltip" data-placement="bottom" title="Custom Link"></i>
                                    </span>
                                    <?php } ?>
                                    <span class="pull-right">
                                        <?php 
                                            if($submenu_status == 0)
                                                echo '<i class="fa fa-globe text-inverse" data-toggle="tooltip" data-placement="bottom" title="Unpublish"></i>';
                                            elseif($submenu_status == 1)
                                                echo '<i class="fa fa-globe text-success"data-toggle="tooltip" data-placement="bottom" title="Publish"></i>'; 
                                        ?>
                                    </span>
                                </h4>       
                            </a>
                            </div>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<div class="modal fade" id="modal-edit-menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
            </div>
            <div class="modal-body">
                <form id="form-edit-menu" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="menu_idh" value="" id="modal-menu-id">
                    <!-- Nav language tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                        <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                    </ul>

                    <!-- Tab language panes -->
                    <div class="tab-content m-b-0">
                        <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input id="modal-menu-title" class="form-control" placeholder="Menu Title" type="text" name="title" value="" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_id">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input id="modal-menu-title-id" class="form-control" placeholder="Menu Title" type="text" name="title_id" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">State</label>
                        <select id="modal-menu-status" class="form-control" name="status" required>
                            <option value="">Select State</option>
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-edit-menu" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-submenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Submenu</h4>
            </div>
            <div class="modal-body">
                <form id="form-edit-submenu" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="submenu_idh" value="" id="modal-submenu-id">
                    <!-- Nav language tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#submenu_tab_en" aria-controls="submenu_tab_en" role="tab" data-toggle="tab">English</a></li>
                        <li role="presentation"><a href="#submenu_tab_id" aria-controls="submenu_tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                    </ul>

                    <!-- Tab language panes -->
                    <div class="tab-content m-b-0">
                        <div role="tabpanel" class="tab-pane fade in active" id="submenu_tab_en">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input id="modal-submenu-title" class="form-control" placeholder="Submenu Title" type="text" name="title" value="" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="submenu_tab_id">
                            <div class="form-group">
                                <label class="control-label">Title</label>
                                <input id="modal-submenu-title-id" class="form-control" placeholder="Submenu Title" type="text" name="title_id" value="" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">State</label>
                        <select id="modal-submenu-status" class="form-control" name="status" required>
                            <option value="">Select State</option>
                            <option value="1">Publish</option>
                            <option value="0">Unpublish</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="submiteditsubmenu" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-menu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
            <p>Are you sure want to delete menu <span id="delete-menu-title" class="add-caps"></span>?</p>
            <form id="form-delete-menu" action="" method="post">
                <input type="hidden" name="menu_id" value="" id="delete-menu">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
            <button id="button-delete-menu" type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-delete-submenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
            <p>Are you sure want to delete submenu <span id="delete-submenu-title" class="add-caps"></span>?</p>
            <form id="form-delete-submenu" action="" method="post">
                <input type="hidden" name="submenu_id" value="" id="delete-submenu">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
            <button id="button-delete-submenu" type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-add-customlink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Custom Link</h4>
      </div>
        <div class="modal-body">
            <form id="form-add-customlink" data-parsley-validate action="" method="POST">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#customlink_add_tab_en" aria-controls="customlink_add_tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#customlink_add_tab_id" aria-controls="customlink_add_tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <!-- Tab language panes -->
                <div class="tab-content m-b-0">
                    <div role="tabpanel" class="tab-pane fade in active" id="customlink_add_tab_en">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" placeholder="Title" type="text" name="title" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="customlink_add_tab_id">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" placeholder="Title" type="text" name="title_id" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Link</label>
                    <input class="form-control" placeholder="Link" type="text" name="link" data-parsley-minlength="3" data-parsley-maxlength="500" data-parsley-type="url" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Parent</label>
                    <select class="form-control" name="parent">
                        <option value="">Select Parent</option>
                        <?php
                            foreach ($function_view_menu_for_parent as $data) {
                        ?> 
                        <option value="<?php echo $data->cr_menuID ?>"><?php echo $data->cr_menuTitle ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">State</label>
                    <select class="form-control" name="status" required>
                        <option value="">Select State</option>
                        <option value="1">Publish</option>
                        <option value="0">Unpublish</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-add-customlink" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-customlink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Custom Link</h4>
      </div>
        <div class="modal-body">
            <form id="form-edit-customlink" data-parsley-validate action="" method="POST">
                <input type="hidden" name="menu_idh" value="">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#customlink_edit_tab_en" aria-controls="customlink_edit_tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#customlink_edit_tab_id" aria-controls="customlink_edit_tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <!-- Tab language panes -->
                <div class="tab-content m-b-0">
                    <div role="tabpanel" class="tab-pane fade in active" id="customlink_edit_tab_en">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" placeholder="Title" type="text" name="title" value="" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="customlink_edit_tab_id">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" placeholder="Title" type="text" name="title_id" value="" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Link</label>
                    <input class="form-control" placeholder="Link" type="text" name="link" value="" data-parsley-maxlength="500" data-parsley-type="url" required>
                </div>
                <div class="form-group">
                    <label class="control-label">State</label>
                    <select class="form-control" name="status" required>
                        <option value="">Select State</option>
                        <option value="1">Publish</option>
                        <option value="0">Unpublish</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="button-edit-customlink" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-subcustomlink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Custom Link</h4>
      </div>
        <div class="modal-body">
            <form id="form-edit-subcustomlink" data-parsley-validate action="" method="POST">
                <input type="hidden" name="submenu_idh" value="">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#subcustomlink_edit_tab_en" aria-controls="subcustomlink_edit_tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#subcustomlink_edit_tab_id" aria-controls="subcustomlink_edit_tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <!-- Tab language panes -->
                <div class="tab-content m-b-0">
                    <div role="tabpanel" class="tab-pane fade in active" id="subcustomlink_edit_tab_en">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" placeholder="Title" type="text" name="title" value="" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="subcustomlink_edit_tab_id">
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input class="form-control" placeholder="Title" type="text" name="title_id" value="" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Link</label>
                    <input class="form-control" placeholder="Link" type="text" name="link" value="" data-parsley-minlength="3" data-parsley-maxlength="500" data-parsley-type="url" required>
                </div>
                <div class="form-group">
                    <label class="control-label">State</label>
                    <select class="form-control" name="status" required>
                        <option value="">Select State</option>
                        <option value="1">Publish</option>
                        <option value="0">Unpublish</option>
                    </select>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-subcustomlink" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.reorder_link').on('click',function(){
            $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
            $('.reorder_link').html('Save Reordering');
            $('.reorder_link').attr("id","save_reorder");
            $('#reorder-helper').slideDown('slow');
            $('.image_link').attr("href","javascript:void(0);");
            $('.image_link').css("cursor","move");
            $("#save_reorder").click(function( e ){
                if( !$("#save_reorder i").length ) {
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-photos-list").sortable('destroy');
                    $("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Menus</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
        
                    var h = [];
                    $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo MADMINURL ?>ajax/menu-reorder.php",
                        data: {ids: " " + h + ""},
                        success: function(data) {
                            if(data == 'true') {
                                window.location.reload();
                            }
                            else if(data == 'false') {
                                $.gritter.add({
                                    title:"Failed! Can't reorder menus",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $.gritter.add({
                                    title:"Error! Can't reorder menus",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                        }
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });

        $('.reorder_submenu').on('click',function(){
            $("ul.reorder-submenu-list").sortable({ tolerance: 'pointer' });
            $('.reorder_submenu').html('Save Reordering');
            $('.reorder_submenu').attr("id","save_submenu_reorder");
            $('#reorder-submenu-helper').slideDown('slow');
            $('.image_submenu_link').attr("href","javascript:void(0);");
            $('.image_submenu_link').css("cursor","move");
            $("#save_submenu_reorder").click(function( e ){
                if( !$("#save_submenu_reorder i").length )
                {
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-submenu-list").sortable('destroy');
                    $("#reorder-submenu-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Submenus</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
        
                    var h = [];
                    var menu = '<?php echo $action ?>';
                    $("ul.reorder-submenu-list li").each(function() {  h.push($(this).attr('id').substr(11));  });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo MADMINURL ?>ajax/submenu-reorder.php",
                        data: {ids: " " + h + "", menu: menu},
                        success: function(data) {
                            if(data == 'true') {
                                window.location.reload();
                            }
                            else if(data == 'false') {
                                $.gritter.add({
                                    title:"Failed! Can't reorder submenus",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $.gritter.add({
                                    title:"Error! Can't reorder submenus",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                        }
                        
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });

        $('#modal-edit-menu').on('show.bs.modal', function(e) {
            $(this).find('#modal-menu-id').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('#modal-menu-title').attr('value', $(e.relatedTarget).data('menutitle'));
            $(this).find('#modal-menu-title-id').attr('value', $(e.relatedTarget).data('menutitleid'));
            $(this).find('#modal-menu-status').attr('value', $(e.relatedTarget).data('state'));
        });

        $('#modal-edit-submenu').on('show.bs.modal', function(e) {
            $(this).find('#modal-submenu-id').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('#modal-submenu-title').attr('value', $(e.relatedTarget).data('submenutitle'));
            $(this).find('#modal-submenu-title-id').attr('value', $(e.relatedTarget).data('submenutitleid'));
            $(this).find('#modal-submenu-status').attr('value', $(e.relatedTarget).data('state'));
        });

        $('#modal-delete-menu').on('show.bs.modal', function(e) {
            $(this).find('#delete-menu').attr('value', $(e.relatedTarget).data('deletemenu'));
            $(this).find('#delete-menu-title').html($(e.relatedTarget).data('dm'));
        });

        $('#modal-delete-submenu').on('show.bs.modal', function(e) {
            $(this).find('#delete-submenu').attr('value', $(e.relatedTarget).data('deletesubmenu'));
            $(this).find('#delete-submenu-title').html($(e.relatedTarget).data('dn'));
        });

        $('#modal-edit-customlink').on('show.bs.modal', function(e) {
            $(this).find('input[name=menu_idh]').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('input[name=title]').attr('value', $(e.relatedTarget).data('cltitle'));
            $(this).find('input[name=title_id]').attr('value', $(e.relatedTarget).data('cltitleid'));
            $(this).find('input[name=link]').attr('value', $(e.relatedTarget).data('clink'));
            $(this).find('select[name=status]').attr('value', $(e.relatedTarget).data('clstate'));
        });
        $('#modal-edit-subcustomlink').on('show.bs.modal', function(e) {
            $(this).find('input[name=submenu_idh]').attr('value', $(e.relatedTarget).data('id'));
            $(this).find('input[name=title]').attr('value', $(e.relatedTarget).data('cltitle'));
            $(this).find('input[name=title_id]').attr('value', $(e.relatedTarget).data('cltitleid'));
            $(this).find('input[name=link]').attr('value', $(e.relatedTarget).data('clink'));
            $(this).find('select[name=status]').attr('value', $(e.relatedTarget).data('clstate'));
        });

        var edit_menu;
        $("#form-edit-menu").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_menu) {
                    edit_menu.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_menu = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/menu-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-menu").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-menu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_menu.done(function (msg){
                    if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-menu").removeAttr('disabled');
                        $("#button-edit-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Menu title is too long",
                            text:"Can't update menu. It should have 25 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-menu").removeAttr('disabled');
                        $("#button-edit-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Menu title is too short",
                            text:"Can't update menu. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-text') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-menu").removeAttr('disabled');
                        $("#button-edit-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't update menu. Don't use word like 'cr-admin', 'cr-content', 'cr-include', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                            $("#button-edit-menu").removeAttr('disabled');
                            $("#button-edit-menu").html('<i class="fa fa-check"></i> Save');
                            $.gritter.add({
                                title:"Failed!",
                                text:"Can't update menu. Menu title is already exist. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    else if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Menu has been updated",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-edit-menu').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-menu").removeAttr('disabled');
                        $("#button-edit-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-menu").removeAttr('disabled');
                        $("#button-edit-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_menu.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var edit_submenu;
        $("#form-edit-submenu").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_submenu) {
                    edit_submenu.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_submenu = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/submenu-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-submenu").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-submenu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_submenu.done(function (msg){
                    if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-submenu").removeAttr('disabled');
                        $("#button-edit-submenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Submenu title is too long",
                            text:"Can't update submenu. It should have 25 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-submenu").removeAttr('disabled');
                        $("#button-edit-submenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Submenu title is too short",
                            text:"Can't update submenu. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-text') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-submenu").removeAttr('disabled');
                        $("#button-edit-submenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't update submenu. Don't use word like 'cr-admin', 'cr-content', 'cr-include', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-submenu").removeAttr('disabled');
                        $("#button-edit-submenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't update submenu. Submenu title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Submenu has been updated",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-edit-submenu').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-submenu").removeAttr('disabled');
                        $("#button-edit-submenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update submenu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-submenu").removeAttr('disabled');
                        $("#button-edit-submenu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update submenu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_submenu.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_menu;
        $("#form-delete-menu").submit(function(event){
            if (delete_menu) {
                delete_menu.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var menu_title = $("#modal-delete-menu").find("#delete-menu-title").html();
            var serializedData = $form.serialize();
            delete_menu = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/menu-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-menu").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-menu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_menu.done(function (msg){
                if(msg == 'menu-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-menu").removeAttr('disabled');
                    $("#button-delete-menu").html('Delete');
                    $.gritter.add({
                        title:"Failed! Menu is required",
                        text:"Can't delete "+menu_title+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:menu_title+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-menu').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-menu").removeAttr('disabled');
                    $("#button-delete-menu").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+menu_title,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-menu").removeAttr('disabled');
                    $("#button-delete-menu").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+menu_title,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_menu.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var delete_submenu;
        $("#form-delete-submenu").submit(function(event){
            if (delete_submenu) {
                delete_submenu.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var submenu_title = $("#modal-delete-submenu").find("#delete-submenu-title").html();
            var serializedData = $form.serialize();
            delete_submenu = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/submenu-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-submenu").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-submenu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_submenu.done(function (msg){
                if(msg == 'submenu-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-submenu").removeAttr('disabled');
                    $("#button-delete-submenu").html('Delete');
                    $.gritter.add({
                        title:"Failed! Submenu is required",
                        text:"Can't delete "+submenu_title+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:submenu_title+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-submenu').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-submenu").removeAttr('disabled');
                    $("#button-delete-submenu").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+submenu_title,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-submenu").removeAttr('disabled');
                    $("#button-delete-submenu").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+submenu_title,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_submenu.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  

        var add_customlink;
        $("#form-add-customlink").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_customlink) {
                    add_customlink.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                add_customlink = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/menu-customlink-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-customlink").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-customlink").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_customlink.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't add new menu. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add custom link. The title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link title is too long",
                            text:"Can't add custom link. It should have 25 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link title is too short",
                            text:"Can't add custom link. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'link-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link is too long",
                            text:"Can't add custom link. It should have 500 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'link-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link is too short",
                            text:"Can't add custom link. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-text') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't add custom link. Don't use word like 'tag', 'cr-admin', 'cr-content', 'cr-include', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'invalid-url') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Invalid URL link",
                            text:"Can't add custom link. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        }
                    else if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Custom Link has been added.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-add-customlink').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add custom link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-customlink").removeAttr('disabled');
                        $("#button-add-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add custom link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                 });
                add_customlink.always(function () {
                    $inputs.prop("disabled", false);
                });
                 event.preventDefault();
            }
        }); 

        var edit_customlink;
        $("#form-edit-customlink").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_customlink) {
                    edit_customlink.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_customlink = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/menu-customlink-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-customlink").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-customlink").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_customlink.done(function (msg){
                    if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't update custom link. The title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link title is too long",
                            text:"Can't update custom link. It should have 25 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link title is too short",
                            text:"Can't update custom link. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'link-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link is too long",
                            text:"Can't update custom link. It should have 500 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'link-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link is too short",
                            text:"Can't update custom link. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-text') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't update custom link. Don't use word like 'tag', 'cr-admin', 'cr-content', 'cr-include', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'invalid-url') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Invalid URL link",
                            text:"Can't update custom link. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        }
                    else if(msg == 'true'){
                        $.gritter.add({
                            title:"Success!",
                            text:"Custom Link has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-edit-customlink').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update custom link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-customlink").removeAttr('disabled');
                        $("#button-edit-customlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update custom link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                 });
                edit_customlink.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        }); 

        var edit_subcustomlink;
        $("#form-edit-subcustomlink").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_subcustomlink) {
                    edit_subcustomlink.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_subcustomlink = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/submenu-customlink-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-subcustomlink").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-subcustomlink").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_subcustomlink.done(function (msg){
                    if(msg == 'same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't update custom link. The title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link title is too long",
                            text:"Can't update custom link. It should have 25 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link title is too short",
                            text:"Can't update custom link. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'link-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link is too long",
                            text:"Can't update custom link. It should have 500 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'link-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Custom link is too short",
                            text:"Can't update custom link. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'reserved-text') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't update custom link. Don't use word like 'tag', 'cr-admin', 'cr-content', 'cr-include', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'invalid-url') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Invalid URL link",
                            text:"Can't update custom link. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Custom Link has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-edit-subcustomlink').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update custom link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-subcustomlink").removeAttr('disabled');
                        $("#button-edit-subcustomlink").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update custom link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                 });
                edit_subcustomlink.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
             }
        }); 

        $('#button-hide-home').click(function() {
            var status  = $("#button-hide-home").data("status");
            var dataString = 'status='+status;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>/ajax/menu-home-link.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $("#button-hide-home").html('<i class="fa fa-spinner fa-pulse"></i>');$("#button-hide-home").attr('disabled','disabled');},
                success: function(data){
                    if(data == 'true') {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }
                    else if(data == 'false') {
                        $.gritter.add({
                            title:"Failed! Can't hide/show home link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Error! Can't hide/show home link",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                }
            });
            return false;
        });
    });
</script>