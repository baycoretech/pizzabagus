<?php
    $class_services  = new Services($pdo);
    $function_view_services  = $class_services->view_services();
    $function_services_menu  = $class_services->view_page_for_services_menu();
    $function_services_submenu  = $class_services->view_page_for_services_submenu();
    $function_services_pageid   = $class_services->view_services_in_page_id();
    $function_services_page     = explode(",", $class_services->view_services_in_page());

    $function_services_title = $class_settings->view_settings_services_title();
?>
<div class="row">
    <div class="col-md-12 ">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Service List</h4>
            </div>
            <div class="panel-toolbar">
                <button class="btn btn-success" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => 'add')) ?>'"><i class="fa fa-plus"></i> Add Services</button>
                <button class="btn btn-info" data-target="#modal-service-title" data-toggle="modal" data-settingid="<?php echo $function_services_title->cr_settingID ?>" data-sc="<?php echo $function_services_title->cr_settingValue ?>"><i class="fa fa-cog"></i> Services Title</button>
            </div>
            <?php
                if($function_view_services == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    No service data found.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30" class="text-center">#</th>
                                <th>Image</th>
                                <th class="">Service Name</th>
                                <th class="">Description</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($function_view_services as $service) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i ?></td>
                                <td class=""><?php if($service->cr_servicesImage == '' || empty($service->cr_servicesImage)) { echo "No Image"; } else { ?><img class="ordinary-photo" src="<?php echo MURL.'cr-editor/images/'.$service->cr_servicesImage ?>"><?php } ?></td>
                                <td class=""><?php echo $service->cr_servicesName ?></td>
                                <td class="add-caps"><?php echo $service->cr_servicesDesc ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-icon btn-circle" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => 'edit', 'id' => $service->cr_servicesID)) ?>'"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#modal-delete-service" data-toggle="modal" data-dn="<?php echo $service->cr_servicesName ?>" data-delete="<?php echo $service->cr_servicesID ?>"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        <?php
                                $i++;
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-service">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="dn"></span>?</p>
                <form id="form-delete-service" action="" method="post">
                    <input type="hidden" name="service_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-service" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-service-title">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Services Title and Page</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    Type what do you want to show in front-end website for quotes title.
                </div>
                <form id="form-service-title" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="settingIDh" value="">
                    <input type="hidden" name="settingname" value="Services Title and Page">
                    <div class="form-group">
                        <label class="control-label">Services Title</label>
                        <input class="form-control" placeholder="Service Title" type="text" name="servicetitle" value="" data-parsley-maxlength="50" autofocus required>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="control-label">Show in Page</label>
                        </div>
                        <div class="col-md-6">
                            <p>Menu(s)</p>
                            <div class="form-group">
                            <?php
                                if($function_services_menu == false) {
                                    echo "<p>No menu found.</p>";
                                }
                                else {
                                    foreach($function_services_menu as $data) {
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="servicepage[]" value="<?php echo $data->cr_menuLink ?>" <?php if(in_array($data->cr_menuLink, $function_services_page) === true) echo 'checked="checked"' ?>>
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
                                if($function_services_submenu == false) {
                                    echo "<p>No submenu found.</p>";
                                }
                                else {
                                    foreach($function_services_submenu as $data) {
                            ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="servicepage[]" value="<?php echo $data->cr_submenuLink ?>" <?php if(in_array($data->cr_submenuLink, $function_services_page) === true) echo 'checked="checked"' ?>>
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
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button id-="button-service-title" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo MADMINURL ?>assets/plugins/DataTables/css/data-table.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
    $(document).ready(function(){
        $("#data-table").DataTable({dom:'C<"clear">lfrtip'});

        $('#modal-delete-service').on('show.bs.modal', function(e) {
            $(this).find('input[name=service_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });

        $('#modal-service-title').on('show.bs.modal', function(e) {
            $(this).find('input[name=settingIDh]').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('input[name=servicetitle]').attr('value', $(e.relatedTarget).data('sc'));
        });

        var service_title;
        $("#form-service-title").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (service_title) {
                    service_title.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                service_title = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/service-title.php",
                    type: "post",
                    beforeSend: function(){ $("#button-service-title").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-service-title").attr('disabled','disabled');},
                    data: serializedData
                });
                service_title.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-service-title").removeAttr('disabled');
                        $("#button-service-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't set service title. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $("#button-service-title").removeAttr('disabled');
                        $("#button-service-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Title is too long",
                            text:"Can't set service title. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Service title has been set.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-service-title").removeAttr('disabled');
                        $("#button-service-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't set service title",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-service-title").removeAttr('disabled');
                        $("#button-service-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't set service title",
                            text:msg,
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                service_title.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_service;
        $("#form-delete-service").submit(function(event){
            if (delete_service) {
                delete_service.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var service_name = $("#modal-delete-service").find("#dn").html();
            var serializedData = $form.serialize();
            delete_service = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/service-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-service").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-service").attr('disabled','disabled');},
                data: serializedData
            });
            delete_service.done(function (msg){
                if(msg == 'service-empty') {
                    $("#button-delete-service").removeAttr('disabled');
                    $("#button-delete-service").html('Delete');
                    $.gritter.add({
                        title:"Failed! Service is required",
                        text:"Can't delete "+service_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:service_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-service').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-service").removeAttr('disabled');
                    $("#button-delete-service").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+service_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-service").removeAttr('disabled');
                    $("#button-delete-service").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+service_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_service.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
    });
</script>