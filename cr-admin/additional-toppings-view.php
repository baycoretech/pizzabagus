<?php
    $class_additional_toppings  = new Additional_Toppings($pdo);
    $function_additional_toppings  = $class_additional_toppings->view_additional_toppings();
    $function_total_additional_toppings = $class_additional_toppings->total_additional_toppings();

    $class_ourmenu_category    = new Our_Menu_Category($pdo);
    $function_ourmenu_category = $class_ourmenu_category->view_all_ourmenu_category();
    $total_ourmenu_category    = count($function_ourmenu_category);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Additional Toppings Ordering</h4>
            </div>
            <div class="panel-toolbar">
                <button type="button" class="btn btn-success m-b-5" data-toggle="modal" data-target="#modal-add-toppings"><i class="fa fa-plus"></i> Add Toppings</button>
                <a href="javascript:void(0);" type="button" class="btn btn-warning m-r-5 m-b-5 btn-reorder reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder Toppings</a>
            </div>
            <?php
                if($function_additional_toppings == false) {
            ?>
            <div id="empty-alert" class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>Empty!</strong>
                    There is no additional toppings.
                </p>
            </div> 
            <?php
                }
            ?>
            <div id="panel-category" class="panel-body">
                <div class="gallery-reorder">
                    <div id="reorder-helper" style="display:none;">
                        <div class="alert alert-info fade in m-b-15">
                            1. Drag toppings to reorder.<br>2. Click 'Save Reordering' when finished.
                        </div>
                    </div>
                    <ul id="list-pc" class="reorder_ul reorder-photos-list">
                        <?php
                            if($function_additional_toppings != false) {
                                foreach ($function_additional_toppings as $data) {
                                    $at_id = $data->cr_toppingsID;
                                    $explode_category = explode(',', $data->cr_ourmenucategoryID);
                        ?>
                        <li id="image_li_<?php echo $at_id ?>" class="ui-sortable-handle">
                            <div class="menu-reorder-wrapper">
                            <a href="javascript:void(0);" style="float:none;" class="image_link">
                                <h4><?php echo $data->cr_toppingsName ?>
                                    <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($check_mc2 == 0) echo "#modal-delete-toppings"; else echo "#modal-alert" ?>" data-dn="<?php echo $data->cr_toppingsName; ?>" data-delete="<?php echo $at_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                    <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-toppings" data-nameid="<?php echo $data->cr_toppingsName_id ?>" data-nameold="<?php echo $data->cr_toppingsName ?>" data-tid="<?php echo $at_id ?>" data-size="<?php echo $data->cr_toppingsSize ?>" data-price="<?php echo $data->cr_toppingsPrice ?>" data-mc="<?php echo $data->cr_ourmenucategoryID ?>"><i class="fa fa-pencil text-success cpointer"></i></span><br><small><em>Applied to <?php foreach($explode_category as $cat) { $category_in_toppings = $class_ourmenu_category->view_ourmenu_category_in_toppings($cat); if(end($explode_category) !== $cat) echo $category_in_toppings->cr_ourmenucategoryName.', '; else echo $category_in_toppings->cr_ourmenucategoryName; } ?><?php if($data->cr_toppingsSize == 'none') echo ''; else echo ' in '.$data->cr_toppingsSize.' size' ?></em></small>
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

<div class="modal fade" id="modal-add-toppings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Add Toppings</h4>
        </div>
        <div class="modal-body">
            <form id="form-add-toppings" data-parsley-validate action="" method="post">
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
                            <label class="control-label">Topping Name</label>
                            <input class="form-control" placeholder="Topping Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="70" autofocus required>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_id">
                        <div class="form-group">
                            <label class="control-label">Topping Name</label>
                            <input class="form-control" placeholder="Topping Name" type="text" name="name_id" value="" data-parsley-minlength="3" data-parsley-maxlength="70" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Topping Price</label>
                    <input class="form-control" placeholder="Topping Price" type="text" name="price" value="" data-parsley-type="integer" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Menu Category</label>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="multiple-select2 form-control" name="menucategory[]" multiple="multiple" style="width: 100%" required>
                            <?php
                                if($total_ourmenu_category != 0) {
                                    foreach($function_ourmenu_category as $data) {
                                        echo '<option value="'.$data->cr_ourmenucategoryID.'">'.$data->cr_ourmenucategoryName.'</option>';
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Menu Size</label>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control" name="size" required>
                                <option value="none" selected="selected">None (All)</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="regular">Regular</option>
                                <option value="large">Large</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-add-toppings" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-toppings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Edit Toppings</h4>
        </div>
        <div class="modal-body">
            <form id="form-edit-toppings" data-parsley-validate action="" method="POST">
                <input type="hidden" name="at_idh" value="">
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
                            <label class="control-label">Topping Name</label>
                            <input class="form-control" placeholder="Topping Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="50" autofocus required>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="edit_tab_id">
                        <div class="form-group">
                            <label class="control-label">Topping Name</label>
                            <input class="form-control" placeholder="Topping Name" type="text" name="name_id" value="" data-parsley-minlength="3" data-parsley-maxlength="50" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Topping Price</label>
                    <input class="form-control" placeholder="Topping Price" type="text" name="price" value="" data-parsley-type="integer" required>
                </div>
                <div class="form-group">
                    <label class="control-label">Menu Category</label>
                    <div class="row">
                        <div class="col-md-12">
                            <select id="multiple-select-menu" class="multiple-select2 form-control" name="menucategory[]" multiple="multiple" style="width: 100%" required>
                            <?php
                                if($total_ourmenu_category != 0) {
                                    foreach($function_ourmenu_category as $data) {
                                        echo '<option value="'.$data->cr_ourmenucategoryID.'">'.$data->cr_ourmenucategoryName.'</option>';
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Menu Size</label>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-control" name="size" required>
                                <option value="none" selected="selected">None (All)</option>
                                <option value="small">Small</option>
                                <option value="medium">Medium</option>
                                <option value="regular">Regular</option>
                                <option value="large">Large</option>
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-edit-toppings" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-delete-toppings" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Alert</h4>
        </div>
        <div class="modal-body">
            <p>Are you sure want to delete <span id="dn" class="add-caps"></span>?</p>
            <form id="form-delete-toppings" action="" method="post">
                <input type="hidden" name="at_id" value="">
                <input type="hidden" name="page" value="<?php echo $action ?>">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-delete-toppings" type="submit" class="btn btn-danger">Delete</button>
            </form>
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
                        url: "<?php echo MADMINURL ?>ajax/additional-toppings-reorder.php",
                        data: {ids: " " + h + "", page: page},
                        success: function(data) {
                            //window.location.reload();
                            if(data == 'false') {
                                $("#save_reorder").removeAttr('disabled');
                                $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Categories');
                                $.gritter.add({
                                    title:"Failed! Can't reorder toppings",
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
                                    text:"Toppings has been reordered.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                                $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                                setTimeout(function() {
                                    $("#save_reorder").removeAttr('disabled');
                                    $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Toppings');
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

        var add_toppings;
        $("#form-add-toppings").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_toppings) {
                    add_toppings.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                add_toppings = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/additional-toppings-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-toppings").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-toppings").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_toppings.done(function (msg){
                    if(msg=='empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-toppings").removeAttr('disabled');
                        $("#button-add-toppings").html('<i class="fa fa-check"></i> Save');
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
                        $("#button-add-toppings").removeAttr('disabled');
                        $("#button-add-toppings").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Topping name is too long",
                            text:"Can't add new topping. It should have 70 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-toppings").removeAttr('disabled');
                        $("#button-add-toppings").html('Save');
                        $.gritter.add({
                            title:"Failed! Topping name is too short",
                            text:"Can't add new topping. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='field-empty') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-toppings").removeAttr('disabled');
                        $("#button-add-toppings").html('<i class="fa fa-check"></i> Save');
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
                        $("#button-add-toppings").removeAttr('disabled');
                        $("#button-add-toppings").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Topping name that you have submitted already exists.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-toppings").removeAttr('disabled');
                        $("#button-add-toppings").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new topping. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"New topping has been added.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        $("#panel-category").removeClass('p-0');
                        $('#modal-add-toppings').modal('hide');
                        $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                        setTimeout(function() {
                            $("#list-pc").html(msg);
                            $("#empty-alert").slideUp();
                            $form.find('input[name=name]').val('');
                            $form.find('input[name=name]').parsley().destroy();
                            $form.find('input[name=name]').removeClass('parsley-success');
                            $('#viewall').removeAttr('disabled');
                            $(".button-cancel").removeAttr('disabled');
                            $(".btn-reorder").show();
                            $("#button-add-toppings").removeAttr('disabled');
                            $("#button-add-toppings").html('<i class="fa fa-check"></i> Save');
                        }, 2000);
                    }
                });
                add_toppings.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var edit_toppings;
        $("#form-edit-toppings").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_toppings) {
                    edit_toppings.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_toppings = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/additional-toppings-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-toppings").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-toppings").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_toppings.done(function (msg){
                    if(msg=='empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-toppings").removeAttr('disabled');
                        $("#button-edit-toppings").html('<i class="fa fa-check"></i> Save');
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
                        $("#button-edit-toppings").removeAttr('disabled');
                        $("#button-edit-toppings").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Topping name is too long",
                            text:"Can't edit topping. It should have 70 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-toppings").removeAttr('disabled');
                        $("#button-edit-toppings").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Topping name is too short",
                            text:"Can't edit topping. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='same-name') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-toppings").removeAttr('disabled');
                        $("#button-edit-toppings").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Topping name that you have submitted already exists.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-toppings").removeAttr('disabled');
                        $("#button-edit-toppings").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't edit topping. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"Topping has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        $('#modal-edit-toppings').modal('hide');
                        $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                        setTimeout(function() {
                            $("#list-pc").html(msg);
                            $('#viewall').removeAttr('disabled');
                            $form.find('input[name=name]').val('');
                            $form.find('input[name=name]').parsley().destroy();
                            $form.find('input[name=name]').removeClass('parsley-success');
                            $(".button-cancel").removeAttr('disabled');
                            $("#button-edit-toppings").removeAttr('disabled');
                            $("#button-edit-toppings").html('<i class="fa fa-check"></i> Save');
                        }, 2000);
                    }
                });
                edit_toppings.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_toppings;
        $("#form-delete-toppings").submit(function(event){
            if (delete_toppings) {
                delete_toppings.abort();
            }
            var $form = $(this);
            var topping =  $('#modal-delete-toppings').find("#dn").text();
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_toppings = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/additional-toppings-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-toppings").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-toppings").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_toppings.done(function (msg){
                if(msg == 'empty-field') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-toppings").removeAttr('disabled');
                    $("#button-delete-toppings").html('Delete');
                    $.gritter.add({
                        title:"Failed! Topping is required",
                        text:"Can't delete "+topping+". Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg=='false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-toppings").removeAttr('disabled');
                    $("#button-delete-toppings").html('Delete');
                    $.gritter.add({
                        title:"Failed!",
                        text:"Can't delete "+topping+". Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $.gritter.add({
                        title:"Success!",
                        text: topping+" has been deleted.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    $('#modal-delete-toppings').modal('hide');
                    $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                    setTimeout(function() {
                        $("#list-pc").html(msg);
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-delete-toppings").removeAttr('disabled');
                        $("#button-delete-toppings").html('Delete');
                    }, 2000);
                }
            });
            delete_toppings.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        $(".multiple-select2").select2();

        $('#modal-add-toppings').on('show.bs.modal', function(e) {
            $('input[name=name]').focus();   
        });

        $('#modal-edit-toppings').on('show.bs.modal', function(e) {
            $(this).find('input[name=nameold], input[name=name]').attr('value', $(e.relatedTarget).data('nameold'));
            $(this).find('input[name=name_id]').attr('value', $(e.relatedTarget).data('nameid'));
            $(this).find('input[name=price]').attr('value', $(e.relatedTarget).data('price'));
            $(this).find('select[name=size]').attr('value', $(e.relatedTarget).data('size'));
            $(this).find('input[name=at_idh]').attr('value', $(e.relatedTarget).data('tid'));
            var menucat = $(e.relatedTarget).data('mc') + ',';
            var arr = menucat.split(",");
            $("#multiple-select-menu").select2().select2('val',arr);
        });

        $('#modal-add-toppings').on('hidden.bs.modal', function(e) {
            $(this).find('#form-add-toppings').parsley().reset();
        });
        
        $('#modal-edit-toppings').on('hidden.bs.modal', function(e) {
            $(this).find('#form-edit-toppings').parsley().reset();
        });

        $('#modal-delete-toppings').on('show.bs.modal', function(e) {
            $(this).find('input[name=at_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
    });
</script>