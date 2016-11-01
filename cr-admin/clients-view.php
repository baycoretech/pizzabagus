<?php
    $class_clients   = new Clients($pdo);
    $function_view_clients   = $class_clients->view_clients();
    $function_clients_menu    = $class_clients->view_page_for_clients_menu();
    $function_clients_submenu = $class_clients->view_page_for_client_submenu();
    $function_clients_pageid = $class_clients->view_clients_in_page_id();
    $function_clients_page   = explode(",", $class_clients->view_clients_in_page());

    $function_clients_title = $class_settings->view_settings_clients_title();
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
                <h4 class="panel-title">View</h4>
            </div>
            <div class="panel-toolbar">
                <button class="btn btn-success" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => 'add')) ?>'"><i class="fa fa-plus"></i> Add Clients</button>
                <button class="btn btn-info" data-target="#modal-clients-title" data-toggle="modal" data-settingid="<?php echo $function_clients_title->cr_settingID ?>" data-cps="<?php echo $function_clients_title->cr_settingValue ?>"><i class="fa fa-cog"></i> Clients Title</button>
                <a href="javascript:void(0);" type="button" class="btn btn-warning reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder Clients</a>

            </div>
            <?php
                if($function_view_clients == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    You have no client yet.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <div class="gallery-reorder">
                    <div id="reorder-helper" style="display:none;">
                        <div class="alert alert-info fade in m-b-15">
                            1. Drag client or partner to reorder.<br>2. Click 'Save Reordering' when finished.
                        </div>
                    </div>

                    <div class="row">
                    <ul class="reorder_ul reorder-social-list">
                    	<?php
                            foreach ($function_view_clients as $data) {
                                $client_id    = $data->cr_clientsID;
                                $client_name  = ucwords($data->cr_clientsName);
                                $client_image = MURL."cr-editor/images/".$data->cr_clientsImage;
                        ?>
                    		<li id="image_li_<?php echo $client_id; ?>" class="ui-sortable-handle col-md-2 square-thumb">
                    			<a tabindex="0" role="button"  data-trigger="hover focus" href="javascript:void(0);" style="float:none;" class="image_link" data-toggle="popover" data-container="body" title="<?php echo $client_name; ?>" data-placement="bottom" data-content="<?php if($data->cr_clientsLink == '') echo "None"; else echo $data->cr_clientsLink; ?>">
                                    <div class="nailthumb-container ">
                    				    <img src="<?php echo $client_image ?>">
                                    </div>
                                    <span><i class="fa fa-pencil text-success" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => 'edit', 'id' => $client_id)) ?>'"></i> <i class="fa fa-times text-danger m-l-5" data-target="#modal-delete-clients" data-toggle="modal" data-dn="<?php echo $client_name ?>" data-delete="<?php echo $client_id; ?>"></i></span>
                    			</a>
                    		</li>
                    	<?php
                    		}
                    	?>
                    </ul>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-clients-title">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Clients Title and Page</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                   Type what do you want to show in front-end website for clients title.          
                </div>
                <form id="form-clients-title" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="settingIDh" value="">
                    <input type="hidden" name="settingname" value="Showing Clients Title">
                    <div class="form-group">
                        <label class="control-label">Clients or Partners Title</label>
                        <input class="form-control" placeholder="Clients or Partners Title" type="text" name="clientstitle" value="" data-parsley-maxlength="50" autofocus required>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Show in Page</label>
                        </div>
                        <div class="col-md-6">
                            <p>Menu(s)</p>
                            <div class="form-group">
                            <?php
                                if($function_clients_menu == false) {
                                    echo "<p>No menu found.</p>";
                                }
                                else {
                                    foreach($function_clients_menu as $data) {
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="cppage[]" value="<?php echo $data->cr_menuLink ?>" <?php if(in_array($data->cr_menuLink, $function_clients_page) === true) echo 'checked="checked"' ?>>
                                        <?php echo $data->cr_menuTitle ?>
                                    </label>
                                </div>
                            <?php
                                    }
                                }
                            ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Submenu(s)</p>
                            <div class="form-group">
                            <?php
                                if($function_clients_submenu == false) {
                                    echo "<p>No submenu found.</p>";
                                }
                                else {
                                    foreach($function_clients_submenu as $data) {
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="cppage[]" value="<?php echo $data->cr_submenuLink ?>" <?php if(in_array($data->cr_submenuLink, $function_clients_page) === true) echo 'checked="checked"' ?>>
                                        <?php echo $data->cr_submenuTitle ?>
                                    </label>
                                </div>
                            <?php
                                    }
                                }
                            ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-white button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-clients-title" type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-clients">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <form id="form-delete-client" action="" method="post">
                    <input type="hidden" name="client_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white button-cancel" data-dismiss="modal">Cancel</button>
                <button id="form-delete-client" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var thumbnail_width = $('.square-thumb').width();
        $('.nailthumb-container').css({'height':thumbnail_width+'px'});
        $('.nailthumb-container').nailthumb();

        $('.reorder_link').on('click',function(){
            $("ul.reorder-social-list").sortable({ tolerance: 'pointer' });
            $('.reorder_link').html('Save Reordering');
            $('.reorder_link').attr("id","save_reorder");
            $('#reorder-helper').slideDown('slow');
            $('.image_link').attr("href","javascript:void(0);");
            $('.image_link').css("cursor","move");
            $("#save_reorder").click(function(e){
                if(!$("#save_reorder i").length){
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-social-list").sortable('destroy');
                    $("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
                    var h = [];
                    $("ul.reorder-social-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo MADMINURL ?>ajax/clients-reorder.php",
                        data: {ids: " " + h + ""},
                        success: function(data) {
                            if(data == 'false') {
                                $("#save_reorder").removeAttr('disabled');
                                $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Clients');
                                $.gritter.add({
                                    title:"Failed! Can't reorder clients",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $.gritter.add({
                                    title:"Success!",
                                    text:"Clients has been reordered.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                                setTimeout(function() {
                                    window.location.reload();
                                }, 2000);
                            }
                        }
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });

        var clients_title;
        $("#form-clients-title").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (clients_title) {
                    clients_title.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                clients_title = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/clients-title.php",
                    type: "post",
                    beforeSend: function(){ $("#button-clients-title").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-clients-title").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled')},
                    data: serializedData
                });
                clients_title.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-clients-title").removeAttr('disabled');
                        $("#button-clients-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't set clients title. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-clients-title").removeAttr('disabled');
                        $("#button-clients-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Title is too long",
                            text:"Can't set clients title. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Clients title has been set.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-clients-title").removeAttr('disabled');
                        $("#button-clients-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't set clients title",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-clients-title").removeAttr('disabled');
                        $("#button-clients-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't set clients title",
                            text:msg,
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                clients_title.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_client;
        $("#form-delete-client").submit(function(event){
            if (delete_client) {
                delete_client.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var client_name = $("#modal-delete-client").find("#dn").html();
            var serializedData = $form.serialize();
            delete_client = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/client-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-client").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-client").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled')},
                data: serializedData
            });
            delete_client.done(function (msg){
                if(msg == 'client-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-client").removeAttr('disabled');
                    $("#button-delete-client").html('Delete');
                    $.gritter.add({
                        title:"Failed! Client is required",
                        text:"Can't delete "+client_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:client_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-client').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-client").removeAttr('disabled');
                    $("#button-delete-client").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+client_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-client").removeAttr('disabled');
                    $("#button-delete-client").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+client_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_client.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 

        $('#modal-clients-title').on('show.bs.modal', function(e) {
            $(this).find('input[name=settingIDh]').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('input[name=clientstitle]').attr('value', $(e.relatedTarget).data('cps'));
        });
        $('#modal-delete-clients').on('show.bs.modal', function(e) {
            $(this).find('input[name=client_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });
    });
</script>