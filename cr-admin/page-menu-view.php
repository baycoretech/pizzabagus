<?php
    $class_ourmenu_category  = new Our_Menu_Category($pdo);
    $function_view_mc  = $class_ourmenu_category->view_ourmenu_category($action);
    $function_total_mc = $class_ourmenu_category->view_total_ourmenu_category($action);
    $function_total_ourmenu = $class_ourmenu_category->view_total_ourmenu($action);
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            <h4 class="panel-title">Page Information</h4>
            </div>
            <div class="panel-body">
                <ul class="fa-ul">
                    <li><i class="fa-li fa fa-dot-circle-o"></i>This page has <?php if($function_total_mc == 0) { echo '<span id="count_category">no category</span>'; } else { if($function_total_mc == 1) echo '<span id="count_category">1 category</span> '; else  echo '<span id="count_category">'.$function_total_mc.' category(s)</span>'; } if($function_total_mc == 0) { echo ' and no menu'; } else { if($function_total_ourmenu == 0) echo ' and 0 menu'; elseif($function_total_ourmenu == 1) echo ' and 1 menu '; else  echo ' and '.$function_total_ourmenu.' menus'; } ?>.</li>
                    <li><i class="fa-li fa fa-dot-circle-o"></i><a href="#" data-toggle="modal" data-target="#modal-permalink" data-permalink="<?php echo MURL.$default_lang_code.'/'.$action ?>">View Permalink</a></li>
                </ul>
            </div>
        </div>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            <h4 class="panel-title">Action</h4>
            </div>
            <div class="panel-body">
                <button id="viewall" class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>'" <?php if($function_view_mc == false) { echo "disabled"; } ?>>
                    <i class="fa fa-cutlery fa-2x pull-left"></i>
                    <span class="f-w-700">View All</span><br>
                    <small>Menus</small>
                </button>
                <button id="viewall" class="btn btn-lg btn-brown btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => 'additional-toppings')) ?>'">
                    <i class="fa fa-pie-chart fa-2x pull-left"></i>
                    <span class="f-w-700">View All</span><br>
                    <small>Additional Toppings</small>
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Category Ordering</h4>
            </div>
            <div class="panel-toolbar">
                <button type="button" class="btn btn-success m-b-5" data-toggle="modal" data-target="#modal-add-category"><i class="fa fa-plus"></i> Add Category</button>
                <a href="javascript:void(0);" type="button" class="btn btn-warning m-r-5 m-b-5 btn-reorder reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder Categories</a>
            </div>
            <?php
                if($function_view_mc == false) {
            ?>
            <div id="empty-alert" class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>Empty!</strong>
                    There is no menu category.
                </p>
            </div> 
            <?php
                }
            ?>
            <div id="panel-category" class="panel-body">
                <div class="gallery-reorder">
                    <div id="reorder-helper" style="display:none;">
                        <div class="alert alert-info fade in m-b-15">
                            1. Drag categories to reorder.<br>2. Click 'Save Reordering' when finished.
                        </div>
                    </div>
                    <ul id="list-pc" class="reorder_ul reorder-photos-list">
                        <?php
                            if($function_view_mc != false) {
                                foreach ($function_view_mc as $data) {
                                    $mc_id     = $data->cr_ourmenucategoryID;
                                    $check_mc2 = $class_ourmenu_category->check_in_ourmenu_category_2($mc_id);
                        ?>
                        <li id="image_li_<?php echo $mc_id ?>" class="ui-sortable-handle">
                            <div class="menu-reorder-wrapper">
                            <a href="javascript:void(0);" style="float:none;" class="image_link">
                                <h4><?php echo $data->cr_ourmenucategoryName ?> <?php if($check_mc2 == 0) echo ""; else echo "($check_mc2)" ?>
                                    <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($check_mc2 == 0) echo "#modal-delete-category"; else echo "#modal-alert" ?>" data-dn="<?php echo $data->cr_ourmenucategoryName; ?>" data-delete="<?php echo $mc_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                    <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-category" data-nameid="<?php echo $data->cr_ourmenucategoryName_id ?>" data-nameold="<?php echo $data->cr_ourmenucategoryName ?>" data-pid="<?php echo $mc_id ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                                </h4>
                            </a>
                            </div>
                        </li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
         </div>
    </div>
</div>

<div class="modal fade" id="modal-add-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Category</h4>
        </div>
        <div class="modal-body">
            <form id="form-add-category" data-parsley-validate action="" method="post">
                <input type="hidden" name="page" value="<?php echo $action ?>">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <!-- Tab language panes -->
                <div class="tab-content m-b-0">
                    <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                        <div class="form-group">
                            <label class="control-label">Category Name</label>
                            <input class="form-control" placeholder="Category Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="70" autofocus required>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_id">
                        <div class="form-group">
                            <label class="control-label">Category Name</label>
                            <input class="form-control" placeholder="Category Name" type="text" name="name_id" value="" data-parsley-minlength="3" data-parsley-maxlength="70" required>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-add-category" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
        </div>
        <div class="modal-body">
            <form id="form-edit-category" data-parsley-validate action="" method="POST">
                <input type="hidden" name="mc_idh" value="">
                <input type="hidden" name="nameold" value="">
                <input type="hidden" name="page" value="<?php echo $action ?>">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#edit_tab_en" aria-controls="edit_tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#edit_tab_id" aria-controls="edit_tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <!-- Tab language panes -->
                <div class="tab-content m-b-0">
                    <div role="tabpanel" class="tab-pane fade in active" id="edit_tab_en">
                        <div class="form-group">
                            <label class="control-label">Category Name</label>
                            <input class="form-control" placeholder="Category Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="50" required>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="edit_tab_id">
                        <div class="form-group">
                            <label class="control-label">Category Name</label>
                            <input class="form-control" placeholder="Category Name" type="text" name="name_id" value="" data-parsley-minlength="3" data-parsley-maxlength="50" required>
                        </div>
                    </div>
                </div>

                
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-edit-category" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-delete-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Alert</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete <span id="dn" class="add-caps"></span>?</p>
            <form id="form-delete-category" action="" method="post">
                <input type="hidden" name="mc_id" value="">
                <input type="hidden" name="page" value="<?php echo $action ?>">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-delete-category" type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
            <p>
                You can not delete a category if there are menu(s) in it.
            </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-permalink">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Permalink</h4>
            </div>
            <div class="modal-body">
                Permalink : <strong id="permalink-view"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="window.open('<?php echo $router->generate('specific-page-lang', array('lang' => $default_lang_code, 'page' => $action)) ?>', '_blank');">View Page</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function(){
        var totallistpc = $("#list-pc li").length;
        if(totallistpc < 1) {
            $("#panel-category").addClass('p-0');
            $("#empty-alert").show();
            $(".btn-reorder").hide();
        }

        $('.reorder_link').on('click',function(){
            $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
            $('.reorder_link').html('Save Reordering');
            $('.reorder_link').attr("id","save_reorder");
            //$('#reorder-helper').slideDown('slow');
            $('.image_link').attr("href","javascript:void(0);");
            $('.image_link').css("cursor","move");
            $("#save_reorder").click(function( e ){
                if( !$("#save_reorder i").length ) {
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-photos-list").sortable('destroy');
                    //$("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Categories</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
                    var h = [];
                    var page = '<?php echo $action ?>';
                    $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                    $.ajax({
                        type: "POST",
                        beforeSend: function(){ $("#save_reorder").html('<i class="fa fa-spinner fa-pulse"></i> Reordering...');$("#save_reorder").attr('disabled','disabled');},
                        url: "<?php echo MADMINURL ?>ajax/ourmenu-category-reorder.php",
                        data: {ids: " " + h + "", page: page},
                        success: function(data) {
                            //window.location.reload();
                            if(data == 'false') {
                                $("#save_reorder").removeAttr('disabled');
                                $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Categories');
                                $.gritter.add({
                                    title:"Failed! Can't reorder category",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $("#panel-category").removeClass('p-0');
                                $("#reorder-helper").slideUp('slow');
                                $.gritter.add({
                                    title:"Success!",
                                    text:"Categories has been reordered.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                                $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                                setTimeout(function() {
                                    $("#save_reorder").removeAttr('disabled');
                                    $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Categories');
                                    $("#list-pc").html(data);
                                }, 2000);
                                $('.reorder_link').html('Save Reordering');
                                $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
                                //$('.reorder_link').removeAttr("id");
                            }
                        }
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });

        var add_category;
        $("#form-add-category").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_category) {
                    add_category.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                add_category = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/ourmenu-category-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-category").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-category").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_category.done(function (msg){
                    if(msg=='empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Please fill all required field.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Category name is too long",
                            text:"Can't add new category. It should have 70 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('Save');
                        $.gritter.add({
                            title:"Failed! Category name is too short",
                            text:"Can't add new category. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='field-empty') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Please fill all fields in the form.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='same-name') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Category name that you have submitted already exists.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new category. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"New category has been added.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        $("#panel-category").removeClass('p-0');
                        $('#modal-add-category').modal('hide');
                        $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                        setTimeout(function() {
                            $("#list-pc").html(msg);
                            $("#empty-alert").slideUp();
                            var totallist = $("#list-pc li").length;
                            $form.find('input[name=name]').val('');
                            $form.find('input[name=name]').parsley().destroy();
                            $form.find('input[name=name]').removeClass('parsley-success');
                            $('#viewall').removeAttr('disabled');
                            $(".button-cancel").removeAttr('disabled');
                            $(".btn-reorder").show();
                            $("#button-add-category").removeAttr('disabled');
                            $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                            if(totallist == 0) {
                                $('#count_category').html('no category');
                            }
                            else if(totallist == 1) {
                                $('#count_category').html('1 category');
                            }
                            else if(totallist > 1) {
                                $('#count_category').html(totallist+' category(s)');
                            }
                        }, 2000);
                    }
                });
                add_category.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var edit_category;
        $("#form-edit-category").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_category) {
                    edit_category.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_category = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/ourmenu-category-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-category").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-category").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_category.done(function (msg){
                    if(msg=='empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Please fill all required field.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Category name is too long",
                            text:"Can't edit category. It should have 70 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Category name is too short",
                            text:"Can't edit category. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='same-name') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Category name that you have submitted already exists.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't edit category. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"Category has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        $('#modal-edit-category').modal('hide');
                        $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                        setTimeout(function() {
                            $("#list-pc").html(msg);
                            var totallist = $("#list-pc li").length;
                            $('#viewall').removeAttr('disabled');
                            $form.find('input[name=name]').val('');
                            $form.find('input[name=name]').parsley().destroy();
                            $form.find('input[name=name]').removeClass('parsley-success');
                            $(".button-cancel").removeAttr('disabled');
                            $("#button-edit-category").removeAttr('disabled');
                            $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                            if(totallist == 0) {
                                $('#count_category').html('no category');
                            }
                            else if(totallist == 1) {
                                $('#count_category').html('1 category');
                            }
                            else if(totallist > 1) {
                                $('#count_category').html(totallist+' category(s)');
                            }
                        }, 2000);
                    }
                });
                edit_category.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_category;
        $("#form-delete-category").submit(function(event){
            if (delete_category) {
                delete_category.abort();
            }
            var $form = $(this);
            var category =  $('#modal-delete-category').find("#dn").text();
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_category = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/ourmenu-category-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-category").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-category").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_category.done(function (msg){
                if(msg == 'empty-field') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-category").removeAttr('disabled');
                    $("#button-delete-category").html('Delete');
                    $.gritter.add({
                        title:"Failed! Category is required",
                        text:"Can't delete "+category+". Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg=='false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-category").removeAttr('disabled');
                    $("#button-delete-category").html('Delete');
                    $.gritter.add({
                        title:"Failed!",
                        text:"Can't delete menu category. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $.gritter.add({
                        title:"Success!",
                        text: category+" has been deleted.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    $('#modal-delete-category').modal('hide');
                    $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                    setTimeout(function() {
                        $("#list-pc").html(msg);
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-delete-category").removeAttr('disabled');
                        $("#button-delete-category").html('Delete');
                        var totallist2 = $("#list-pc li").length;
                        $('#count_category').html(totallist2);
                        if(totallist2 < 1) {
                            $("#empty-alert").show();
                            $(".btn-reorder").hide();
                            $("#viewall").attr('disabled','disabled');
                        }
                        if(totallist2 == 0) {
                            $('#count_category').html('no category');
                        }
                        else if(totallist2 == 1) {
                            $('#count_category').html('1 category');
                        }
                        else if(totallist2 > 1) {
                            $('#count_category').html(totallist2+' category(s)');
                        }
                    }, 2000);
                }
            });
            delete_category.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        $('#modal-add-category').on('show.bs.modal', function(e) {
            $('input[name=name]').focus();         
        });

        $('#modal-edit-category').on('show.bs.modal', function(e) {
            $(this).find('input[name=nameold], input[name=name]').attr('value', $(e.relatedTarget).data('nameold'));
            $(this).find('input[name=name_id]').attr('value', $(e.relatedTarget).data('nameid'));
            $(this).find('input[name=mc_idh]').attr('value', $(e.relatedTarget).data('pid'));
        });

        $('#modal-add-category').on('hidden.bs.modal', function(e) {
            $(this).find('#form-add-category').parsley().reset();
        });
        
        $('#modal-edit-category').on('hidden.bs.modal', function(e) {
            $(this).find('#form-edit-category').parsley().reset();
        });

        $('#modal-permalink').on('show.bs.modal', function(e) {
            $(this).find('#permalink-view').html($(e.relatedTarget).data('permalink'));
        });

        $('#modal-delete-category').on('show.bs.modal', function(e) {
            $(this).find('input[name=mc_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
    });
</script>