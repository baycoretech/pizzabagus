<?php
    $class_portfolio_extra = new Portfolio_Extra($pdo);
    $function_view_portfolio_extra = $class_portfolio_extra->view_portfolio_extra($extra);
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
                <h4 class="panel-title">Extra Content for Portfolio</h4>
            </div>
            <div class="panel-body">
                <form id="form-add-portfolio-extra" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="portfolio_id" value="<?php echo $extra ?>">
                    <div class="form-group">
                        <label class="control-label">Extra Content Name</label>
                        <input class="form-control" placeholder="Extra Content Name" type="text" name="name" data-parsley-maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea name="editorportfolio" required></textarea>
                    </div>
            </div>
            <div class="panel-footer">
                <button id="button-add-portfolio-extra" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>'">Cancel</button>
                </form>
            </div>
         </div>

        <?php
            if($function_view_portfolio_extra != false) {
        ?>
        <div class="panel panel-inverse panel-with-tabs" data-sortable-id="ui-unlimited-tabs-1">
            <div class="panel-heading p-0">
                <div class="panel-heading-btn m-r-10 m-t-10">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                </div>
                <div class="tab-overflow">
                    <ul class="nav nav-tabs nav-tabs-inverse">
                        <li class="prev-button"><a href="javascript:;" data-click="prev-tab" class="text-success"><i class="fa fa-arrow-left"></i></a></li>
                        <?php
                            $i = 1;
                            foreach ($function_view_portfolio_extra as $data) {
                        ?>
                        <li class="<?php if($i == 1) echo "active" ?>"><a href="#nav-tab-<?php echo $i ?>" data-toggle="tab"><strong><?php echo $data->cr_portfolioextraName ?></strong></a></li>
                        <?php
                                $i++;
                            }
                        ?>
                        <li class="next-button"><a href="javascript:;" data-click="next-tab" class="text-success"><i class="fa fa-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <?php
                    $i = 1;
                    foreach ($function_view_portfolio_extra as $data) {
                ?>
                <div class="tab-pane fade <?php if($i == 1) echo "active in" ?>" id="nav-tab-<?php echo $i ?>">
                    <?php echo $data->cr_portfolioextraContent ?>
                    <hr>
                        <button type="button" class="btn btn-success m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => 'portfolio-extra', 'action' => $data->cr_portfolioID, 'id' => $data->cr_portfolioextraID)) ?>'"><i class="fa fa-pencil cpointer"></i> Edit</button>
                        <button type="button" class="btn btn-danger m-r-5 m-b-5" data-target="#modal-delete-portfolio-extra" data-toggle="modal" data-nm="<?php echo $data->cr_portfolioextraName ?>" data-delete="<?php echo $data->cr_portfolioextraID ?>"><i class="fa fa-times cpointer"></i> Delete</button>
                </div>

                <?php
                        $i++;
                    }
                ?>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
</div>

<div class="modal fade" id="modal-delete-portfolio-extra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="nm"></span></span>?</p>
                <form id="form-delete-portfolio-extra" action="" method="post">
                    <input type="hidden" name="portfolio_extra_id" value="">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-white button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-delete-portfolio-extra" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-delete-portfolio-extra').on('show.bs.modal', function(e) {
            $(this).find('input[name=portfolio_extra_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#nm').html($(e.relatedTarget).data('nm'));
        });

        CKEDITOR.replace( 'editorportfolio', {
            filebrowserBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html',
            filebrowserImageBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Images',
            filebrowserFlashBrowseUrl : '<?php echo MURL ?>cr-include/ckfinder/ckfinder.html?type=Flash',
            filebrowserUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
            filebrowserImageUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
            filebrowserFlashUploadUrl : '<?php echo MURL ?>cr-include/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
        });

        var add_portfolio_extra;
        $("#form-add-portfolio-extra").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_portfolio_extra) {
                    add_portfolio_extra.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                add_portfolio_extra = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/portfolio-extra-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-portfolio-extra").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-portfolio-extra").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_portfolio_extra.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio-extra").removeAttr('disabled');
                        $("#button-add-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't add new portfolio extra content. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio-extra").removeAttr('disabled');
                        $("#button-add-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Extra content name is to long",
                            text:"Can't add new portfolio extra content. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'content-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio-extra").removeAttr('disabled');
                        $("#button-add-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Content is empty",
                            text:"Can't add new portfolio extra content. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New portfolio extra content has been added.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio-extra").removeAttr('disabled');
                        $("#button-add-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new portfolio extra content",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-portfolio-extra").removeAttr('disabled');
                        $("#button-add-portfolio-extra").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new portfolio extra content",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                add_portfolio_extra.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_portfolio_extra;
        $("#form-delete-portfolio-extra").submit(function(event){
            if (delete_portfolio_extra) {
                delete_portfolio_extra.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var portfolio_extra_name = $("#modal-delete-portfolio-extra").find("#nm").html();
            var serializedData = $form.serialize();
            delete_portfolio_extra = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/portfolio-extra-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-portfolio-extra").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-portfolio-extra").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_portfolio_extra.done(function (msg){
                if(msg == 'portfolio-extra-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-portfolio-extra").removeAttr('disabled');
                    $("#button-delete-portfolio-extra").html('Delete');
                    $.gritter.add({
                        title:"Failed! Portfolio extra content is required",
                        text:"Can't delete "+portfolio_extra_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:portfolio_extra_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-portfolio-extra').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => $id)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-portfolio-extra").removeAttr('disabled');
                    $("#button-delete-portfolio-extra").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+portfolio_extra_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-portfolio-extra").removeAttr('disabled');
                    $("#button-delete-portfolio-extra").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+portfolio_extra_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_portfolio_extra.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  
    });
</script>