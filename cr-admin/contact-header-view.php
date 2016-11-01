<?php
    $class_contact_header  = new Contact_Header($pdo);
    $function_contact_header  = $class_contact_header->view_contact_header();
    $explode      = explode(',', $function_contact_header->cr_settingValue);
    $first_value  = $explode[0];
    $second_value = $explode[1];
    $third_value  = $explode[2];
?>
<div class="row">
    <div class="col-md-12">
        <!-- begin panel -->
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
                <button class="btn btn-success" data-target="#modal-edit-contact-header" data-toggle="modal" data-settingid="<?php echo $function_contact_header->cr_settingID ?>" data-email="<?php echo $first_value ?>" data-phone="<?php echo $second_value ?>" data-socmed="<?php echo $third_value ?>"><i class="fa fa-pencil"></i> Edit C.Header</button>
            </div>
            <div class="panel-body">
                    <dl class="dl-horizontal m-t-10">
                        <dt>Website Email</dt>
                            <dd>
                                <?php
                                    if($first_value == 0)
                                        echo "Not Shown";
                                    else
                                        echo "Show"; 
                                 ?>
                            </dd>
                        <hr>
                        <dt>Phone</dt>
                            <dd>
                                <?php
                                    if($second_value == 0)
                                        echo "Not Shown";
                                    else
                                        echo "Show"; 
                                 ?>
                            </dd>
                        <hr>
                        <dt>Available Social Media</dt>
                            <dd>
                                <?php
                                    if($third_value == 0)
                                        echo "Not Shown";
                                    else
                                        echo "Show"; 
                                 ?>
                            </dd>
                    </dl>
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>

<div class="modal fade" id="modal-edit-contact-header">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Contact Header</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                   Choose what do you want to show. You can choose more than one. For example, you can choose Website Email and Phone together.          
                </div>
                <form id="form-edit-contact-header" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="setting_idh" value="" id="settingid">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="email" value="1">
                                    Website Email
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="phone" value="1">
                                    Phone
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="socmed" value="1">
                                    Social Media
                                </label>
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-edit-contact-header" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-edit-contact-header').on('show.bs.modal', function(e) {
            $(this).find('#settingid').attr('value', $(e.relatedTarget).data('settingid'));
            var emailvalue  = $(e.relatedTarget).data('email');
            var phonevalue  = $(e.relatedTarget).data('phone');
            var socmedvalue = $(e.relatedTarget).data('socmed');
            if(emailvalue == 1) {
                $('input[name=email]').attr("checked", "checked");
            }
            else {
                $('input[name=email]').removeAttr("checked");
            }
            if(phonevalue == 1) {
                $('input[name=phone]').attr("checked", "checked");
            }
            else {
                $('input[name=phone]').removeAttr("checked");
            }
            if(socmedvalue == 1) {
                $('input[name=socmed]').attr("checked", "checked");
            }
            else {
                $('input[name=socmed]').removeAttr("checked");
            }
        });

        var edit_contact_header;
        $("#form-edit-contact-header").submit(function(event){
            if (edit_contact_header) {
                edit_contact_header.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_contact_header = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/contact-header-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-contact-header").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-contact-header").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            edit_contact_header.done(function (msg){
                if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Contact header has been updated",
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
                    $("#button-edit-contact-header").removeAttr('disabled');
                    $("#button-edit-contact-header").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update contact header",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-edit-contact-header").removeAttr('disabled');
                    $("#button-edit-contact-header").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update contact header",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_contact_header.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>