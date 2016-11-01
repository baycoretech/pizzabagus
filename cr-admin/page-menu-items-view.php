<?php
    $class_ourmenu_category = new Our_Menu_Category($pdo);
    $function_view_mc = $class_ourmenu_category->view_ourmenu_category($action);
    $class_ourmenu  = new Our_Menu($pdo);
    if($id == 'view') {
        $function_view_ourmenu  = $class_ourmenu->view_ourmenu($action);
    }
    elseif($id == 'view-name-asc') {
        $function_view_ourmenu  = $class_ourmenu->view_ourmenu_name_asc($action);
    }
    elseif($id == 'view-name-desc') {
        $function_view_ourmenu  = $class_ourmenu->view_ourmenu_name_desc($action);
    }
    elseif($id == 'view-date-asc') {
        $function_view_ourmenu  = $class_ourmenu->view_ourmenu_date_asc($action);
    }
?>
<div id="options" class="m-b-10">
    <span class="gallery-option-set" id="filter" data-option-key="filter">
        <a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
            Show All
        </a>
        <?php
            foreach ($function_view_mc as $data) {
                $mc_slug = create_slug($data->cr_ourmenucategoryName);
        ?>
        <a href="#<?php echo $mc_slug ?>" class="btn btn-default btn-xs" data-option-value=".<?php echo $mc_slug ?>">
            <?php echo $data->cr_ourmenucategoryName; ?>
        </a>
        <?php
            }
        ?>
        <a href="#vegetarian-ourmenu" class="btn btn-light-green btn-xs" data-option-value=".vegetarian-type">
            Vegetarian
        </a>
        <a href="#fish-ourmenu" class="btn btn-light-green btn-xs" data-option-value=".fish-type">
            Fish
        </a>
        <a href="#draft-ourmenu" class="btn btn-light-blue btn-xs" data-option-value=".draft-ourmenu">
            Draft
        </a>
        <a href="#publish-ourmenu" class="btn btn-inverse btn-xs" data-option-value=".publish-ourmenu">
            Publish
        </a>
    </span>
    <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>" class="btn btn-warning m-t-15"><i class="fa fa-arrow-left"></i></a>
    <button type="button" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add')) ?>'" class="btn btn-success m-t-15">
        <strong>Add Menu</strong>
    </button>
    <div class="btn-group m-t-15">
        <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="button-delete-checked-portfolio" href="javascript:;">Delete Checked Menu(s)</a></li>
        </ul>
    </div>

    <?php if($function_view_ourmenu != false) { ?>
    <div class="btn-group m-t-15 m-r-15 btn-sorting">
        <a id="sort-asc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-name-asc')) ?>" class="btn btn-inverse <?php if($id == 'view-name-asc') echo 'active' ?>" title="Sort by name (ascending)"><i class="fa fa-sort-alpha-asc"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-name-desc')) ?>" class="btn btn-inverse <?php if($id == 'view-name-desc') echo 'active' ?>" title="Sort by name (descending)"><i class="fa fa-sort-alpha-desc"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-date-asc')) ?>" class="btn btn-inverse <?php if($id == 'view-date-asc') echo 'active' ?>" title="Sort by date (ascending)"><i class="fa fa-long-arrow-up"></i> <i class="fa fa-calendar"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>" class="btn btn-inverse <?php if($id == 'view') echo 'active' ?>" title="Sort by date (descending)"><i class="fa fa-long-arrow-down"></i> <i class="fa fa-calendar"></i></a>
    </div>
    <?php } ?>
</div>
<div id="gallery" class="gallery">
    <?php
        if($function_view_ourmenu != false) {
            $i = 1;
            foreach ($function_view_ourmenu as $data) {
                $ourmenu_id       = $data->cr_ourmenuID;
                if($data->cr_ourmenuThumb == '')
                    $ourmenu_image    = MADMINURL.'assets/img/no-menu-items.png';
                else
                    $ourmenu_image    = MURL.$data->cr_ourmenuThumb;
                $mc_slug          = create_slug($data->cr_ourmenucategoryName);
                $ourmenu_status   = $data->cr_ourmenuStatus;
                $ourmenu_type     = $data->cr_ourmenuType;
                $ourmenu_date     = date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($data->cr_ourmenuDate));
    ?>
            <div class="image <?php echo $mc_slug ?> <?php if($ourmenu_type == "vegetarian") echo "vegetarian-type "; elseif($ourmenu_type == "fish") echo "fish-type "; if($ourmenu_status == "draft") echo "draft-ourmenu"; elseif($ourmenu_status == "publish") echo "publish-ourmenu"; ?>">
                <div class="image-inner">
                    <a href="<?php echo $ourmenu_image ?>" data-lightbox="<?php echo $mc_slug; ?>">
                        <img src="<?php echo $ourmenu_image ?>" alt="<?php echo $data->cr_ourmenuTitle ?>" />
                    </a>
                    <p class="image-caption <?php if($ourmenu_status == "draft") echo "bg-aqua"; elseif($ourmenu_status == "publish") echo "bg-black"; ?>">
                        #<?php echo $i ?> - <?php echo $data->cr_ourmenucategoryName ?>
                    </p>
                    <span class="text-center portfolio-actbutton">
                        <button type="button" class="btn btn-success btn-icon btn-circle" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'edit', 'extra' => $ourmenu_id)) ?>'"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-indigo btn-icon btn-circle btn-edit" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Ingredients" data-placement="bottom" data-content="<?php if(empty($data->cr_ourmenuIngredients) || $data->cr_ourmenuIngredients == "") echo "No tag"; else echo $data->cr_ourmenuIngredients ?>"><i class="fa fa-cutlery"></i></button>
                        <button type="button" class="btn btn-light-green btn-icon btn-circle btn-edit" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Price" data-placement="bottom" data-content="<?php echo format_rupiah($data->cr_ourmenuPrice) ?>"><i class="fa fa-money"></i></button>
                        <button type="button" class="btn btn-brown btn-icon btn-circle btn-edit" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Size" data-placement="bottom" data-content="<?php echo ucwords($data->cr_ourmenuSize) ?>"><i class="fa fa-arrows"></i></button>
                        <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#modal-delete-ourmenu" data-toggle="modal" data-nm="<?php echo $data->cr_ourmenuTitle; ?>" data-mc="<?php echo $data->cr_ourmenucategoryName; ?>" data-delete="<?php echo $ourmenu_id; ?>"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <div class="image-info getheight">
                        <h5 class="title name" <?php if($ourmenu_status == "draft") echo 'style="color: #49B6D6"'; ?>><input value="<?php echo $ourmenu_id ?>" type="checkbox" name="delete-ourmenu[]" class="checkbox-action"> <?php echo $data->cr_ourmenuTitle ?></h5>
                        <div class="pull-right">
                            <small>by</small> <a><?php echo ucwords($data->cr_adminDisplayName) ?></a>
                        </div>
                        <div class="rating">
                            <i class="fa fa-calendar"> <?php echo $ourmenu_date ?></i>
                        </div>
                        <div class="desc">
                            <?php
                                echo short_description($data->cr_ourmenuDesc, 60);
                            ?>
                        </div>
                </div>
            </div>
    <?php
                $i++;
            }
        }
    ?>
    <div class="image <?php foreach ($function_view_mc as $data) { echo create_slug($data->cr_ourmenucategoryName)." "; } ?> draft-ourmenu publish-ourmenu">
        <div class="image-inner">
            <a href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add')) ?>">
                <img src="<?php echo MADMINURL ?>assets/img/add.png" alt="Add Portfolio" />
            </a>
        </div>
        <div class="image-info applyheight">
            <h5 class="title">Add New Menu</h5>
            <div class="desc">
                Click here to add new menu.
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-ourmenu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="nm"></span> in <span id="mc"></span> category?</p>
                <form id="form-delete-ourmenu" action="" method="post">
                    <input type="hidden" name="ourmenu_id" value="">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-white button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-delete-ourmenu" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        <?php
            if($function_view_ourmenu != false) {
        ?>
        var set_height = setInterval(
            function () {
                var ert = $(".getheight").outerHeight()+"px";
                $(".applyheight").css("height", ert);
            }, 500
        );
        <?php } ?>

        $('#modal-delete-ourmenu').on('show.bs.modal', function(e) {
            $(this).find('input[name=ourmenu_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#nm').html($(e.relatedTarget).data('nm'));
            $(this).find('#mc').html($(e.relatedTarget).data('mc'));
        });

        var delete_ourmenu;
        $("#form-delete-ourmenu").submit(function(event){
            if (delete_ourmenu) {
                delete_ourmenu.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var ourmenu_name = $("#modal-delete-ourmenu").find("#nm").html();
            var serializedData = $form.serialize();
            delete_ourmenu = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/ourmenu-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-ourmenu").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-ourmenu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_ourmenu.done(function (msg){
                if(msg == 'portfolio-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-ourmenu").removeAttr('disabled');
                    $("#button-delete-ourmenu").html('Delete');
                    $.gritter.add({
                        title:"Failed! Portfolio is required",
                        text:"Can't delete "+ourmenu_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:ourmenu_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-portfolio').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => $id)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-ourmenu").removeAttr('disabled');
                    $("#button-delete-ourmenu").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+ourmenu_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-ourmenu").removeAttr('disabled');
                    $("#button-delete-ourmenu").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+ourmenu_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_ourmenu.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  

        $("#button-delete-checked-ourmenu").click(function(){
            var count_checked = $("input[name='delete-ourmenu[]']:checked").length;
            if(count_checked == 0) {
                alert("Please select menu(s) to delete.");
                return false;
            }
            else {
                if(confirm('Are you sure you want to delete the selected menu(s) ?')) {
                    var dataString = $("input[name='delete-ourmenu[]']:checked").serialize();
                    $.ajax({
                        type: "POST",
                        url:  "<?php echo MADMINURL ?>ajax/ourmenu-checked-delete.php",
                        data: dataString,
                        cache: false,
                        success: function(msg){
                            if(msg == 'true'){
                                $.gritter.add({
                                    title:"Success!",
                                    text:"Menu(s) has been deleted",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                                setTimeout(function() {
                                    window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => $id)) ?>";
                                }, 2000);
                            }
                            else if(msg == 'false') {
                                $.gritter.add({
                                    title:"Failed! Can't delete menu(s)",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $.gritter.add({
                                    title:"Error! Can't delete menu(s)",
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
            }         
        });
    });
</script>