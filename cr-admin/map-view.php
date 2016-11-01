<?php
    $class_map = new Map($pdo);
    $function_view_map = $class_map->view_map();
    $function_view_map_marker = $class_map->view_map_marker();
    if($action == 'preview') {
        require 'map-preview.php';
    }
    else {
?>
<div class="row">
    <!-- begin col-9 -->
    <div class="col-md-9">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Map Information</h4>
            </div>
            <div class="panel-toolbar">
                <?php 
                    if($function_view_map == false) {
                ?>
                <button class="btn btn-success" data-target="#modal-add-map" data-toggle="modal"><i class="fa fa-plus"></i> Add Map</button>
                <?php
                    }
                    else {
                ?>
                <button class="btn btn-info" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => 'map', 'action' => 'preview')) ?>'"><i class="fa fa-map-marker"></i> Preview Map</button>
                <button class="btn btn-success" data-target="#modal-edit-map" data-toggle="modal" data-mapid="<?php echo $function_view_map->cr_mapID ?>" data-latlong="<?php echo $function_view_map->cr_mapLatLong ?>" data-mapdesc="<?php echo $function_view_map->cr_mapDesc ?>" data-mapmarker="<?php echo $function_view_map->cr_mapmarkerName ?>" data-mapmarkerimage="<?php echo MURL.$function_view_map->cr_mapmarkerImage ?>"><i class="fa fa-pencil-square-o"></i> Edit Map</button>
                <button class="btn btn-danger" data-target="#modal-delete-map" data-toggle="modal" data-delete="<?php echo $function_view_map->cr_mapID ?>"><i class="fa fa-times"></i> Delete Map</button>
                <?php } ?> 
            </div>
            <?php
                if($function_view_map == false) {
            ?>
                <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                    <p>
                    <strong>Empty!</strong>
                    No map data found.
                    </p>
                </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <dl class="dl-horizontal m-t-10">
                    <dt>Latitude Longitude</dt>
                    <dd>
                        <?php echo $function_view_map->cr_mapLatLong ?>
                    </dd>
                    <hr>
                    <dt>Map Description</dt>
                    <dd>
                    <?php
                        if($function_view_map->cr_mapDesc == NULL || empty($function_view_map->cr_mapDesc))
                            echo "Empty";
                        else
                            echo $function_view_map->cr_mapDesc;
                    ?>
                    </dd>
                    <hr>
                    <dt>Map Marker</dt>
                    <dd>
                        <img width="32" src="<?php echo MURL.$function_view_map->cr_mapmarkerImage ?>" alt="<?php echo MURL.$function_view_map->cr_mapmarkerName ?>" >
                    </dd>
                </dl>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
	<div class="col-md-3">
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Information
                        </a>
                    </h3>
                </div>
                <div style="" aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <p>
                            Map contains information about your location and it's description. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Action Button
                        </a>
                    </h3>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p>
                        There are one button above, <strong class="text-success">Add Map</strong>. Click <strong class="text-success">Add Map</strong> to add new map data and location. If you have map data and location already, there will be three buttons. You can preview the map data by clicking <strong class="text-warning">Preview Map</strong>, edit existing map data by clicking <strong class="text-success">Edit Map</strong>, and delete map data by clicking <strong class="text-danger">Delete Map</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<div class="modal fade" id="modal-add-map">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Map</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    <p>
                       You can find <strong>Latitude</strong> and <strong>Longitude</strong> in <a href="www.map.google.com"><strong>Google Map</strong></a>. Find for Latitude and Longitude in the url, the format is like this, -8.6827176,115.2541232, just for example. It's different for each location.
                    </p>
                </div>
                <form id="form-add-map" data-parsley-validate action="" method="POST">
                    <div class="form-group">
                        <label class="control-label">Latitude Longitude</label>
                        <input class="form-control" placeholder="Latitude Longitude" type="text" name="latlong" value="" data-parsley-minlength="5" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Map Description</label>
                        <textarea class="form-control" name="mapdesc" placeholder="Map Description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <p><label class="control-label">Map Marker</label></p>
                        <?php
                            foreach ($function_view_map_marker as $marker) {
                        ?> 
                        <div class="col-md-2">   
                            <label class="rwi">
                                <input type="radio" name="marker" value="<?php echo $marker->cr_mapmarkerID ?>">
                                <img style="width:50%" src="<?php echo MURL.$marker->cr_mapmarkerImage ?>">
                                <?php echo $marker->cr_mapmarkerName ?>
                            </label>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="clearfix"></div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-add-map" type="submit" class="btn btn-success" name="savemap"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit-map">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Map</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                   You can find <strong>Latitude</strong> and <strong>Longitude</strong> in <a href="www.map.google.com"><strong>Google Map</strong></a>. Find for Latitude and Longitude in the url, the format is like this, -8.6827176,115.2541232, just for example.  It's different for each location.      
                </div>
                <form id="form-edit-map" data-parsley-validate action="" method="POST">
                    <input id="mapid" type="hidden" name="map_idh" value="">
                    <div class="form-group">
                        <label class="control-label">Latitude Longitude</label>
                        <input id="latlong" class="form-control" placeholder="Latitude Longitude" type="text" name="latlong" value="" data-parsley-minlength="5" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Map Description</label>
                        <textarea id="mapdesc" class="form-control" name="mapdesc" placeholder="Map Description" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <p><label class="control-label">Map Marker</label></p>
                        <p>Currently used : <span id="mapmarkername"></span> <img width="30" id="mapmarkerimage" src=""></p>
                        <?php
                            foreach ($function_view_map_marker as $marker) {
                        ?> 
                        <div class="col-md-2">   
                            <label class="rwi">
                                <input type="radio" name="marker" value="<?php echo $marker->cr_mapmarkerID ?>">
                                <img style="width:50%" src="<?php echo MURL.$marker->cr_mapmarkerImage ?>">
                                <?php echo $marker->cr_mapmarkerName ?>
                            </label>
                        </div>
                        <?php
                            }
                        ?>
                        <div class="clearfix"></div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-map" type="submit" class="btn btn-success" name="editmap"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-delete-map">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete current map data?</p>
                <form id="form-delete-map" action="" method="post">
                    <input type="hidden" name="map_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-map" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-edit-map').on('show.bs.modal', function(e) {
            $(this).find('#mapid').attr('value', $(e.relatedTarget).data('mapid'));
            $(this).find('#latlong').attr('value', $(e.relatedTarget).data('latlong'));
            $(this).find('#mapdesc').html($(e.relatedTarget).data('mapdesc'));
            $(this).find('#mapmarkername').html($(e.relatedTarget).data('mapmarker'));
            $(this).find('#mapmarkerimage').attr('src',$(e.relatedTarget).data('mapmarkerimage'));
        });
        $('#modal-delete-map').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('delete'));
        });

        var add_map;
        $("#form-add-map").submit(function(event){
            if (add_map) {
                add_map.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            add_map = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/map-add.php",
                type: "post",
                beforeSend: function(){ $("#button-add-map").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-map").attr('disabled','disabled');},
                data: serializedData
            });
            add_map.done(function (msg){
                if(msg == 'latlong-empty') {
                    $("#button-add-map").removeAttr('disabled');
                    $("#button-add-map").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Latitude longitude is required",
                        text:"Can't add new map and location. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Map and location has been added",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-add-map').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'map')) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-add-map").removeAttr('disabled');
                    $("#button-add-map").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't add new map and location",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-add-map").removeAttr('disabled');
                    $("#button-add-map").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't add new map and location",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            add_map.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var edit_map;
        $("#form-edit-map").submit(function(event){
            if (edit_map) {
                edit_map.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_map = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/map-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-map").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-map").attr('disabled','disabled');},
                data: serializedData
            });
            edit_map.done(function (msg){
                if(msg == 'latlong-empty') {
                    $("#button-edit-map").removeAttr('disabled');
                    $("#button-edit-map").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Latitude longitude is required",
                        text:"Can't update map and location. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Map and location has been updated",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-edit-map').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'map')) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-edit-map").removeAttr('disabled');
                    $("#button-edit-map").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update map and location",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-map").removeAttr('disabled');
                    $("#button-edit-map").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update map and location",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_map.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var delete_map;
        $("#form-delete-map").submit(function(event){
            if (delete_map) {
                delete_map.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_map = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/map-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-map").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-map").attr('disabled','disabled');},
                data: serializedData
            });
            delete_map.done(function (msg){
                if(msg == 'map-empty') {
                    $("#button-delete-map").removeAttr('disabled');
                    $("#button-delete-map").html('Delete');
                    $.gritter.add({
                        title:"Failed! Map is required",
                        text:"Can't delete map and location. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Map and location has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-map').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'map')) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-map").removeAttr('disabled');
                    $("#button-delete-map").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete map and location",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-map").removeAttr('disabled');
                    $("#button-delete-map").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete map and location",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_map.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>
<?php } ?>