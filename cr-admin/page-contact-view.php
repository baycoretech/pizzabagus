<?php
    $class_contact  = new Contact($pdo);
    $function_view_contact  = $class_contact->view_contact($action);
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Page Information
                        </a>
                    </h3>
                </div>
                <div style="" aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <p>
                        </p>
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-dot-circle-o"></i><a href="#" data-toggle="modal" data-target="#modal-permalink" data-permalink="<?php echo MURL.$default_lang_code.'/'.$action ?>">View Permalink</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Information
                        </a>
                    </h3>
                </div>
                <div style="" aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <p>This page contains information about your company. Contact information will be shown in the right column, and contact form in the left column. Custom Header is a text that will be a header in this page. Custom Description is a description that will be shown below the Custom Header.</p>
                    </div>
                </div>
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
                <p class="">
                    <?php
                        if($function_view_contact == false) {
                    ?>
                    <button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add')) ?>'">
                        <i class="fa fa-plus fa-2x pull-left"></i>
                        <span class="f-w-700">Add Contact</span><br>
                        <small>Add New Contact</small>
                    </button>
                    <?php
                        }
                        else {
                    ?>
                    <button class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'edit', 'extra' => $function_view_contact->cr_contactID)) ?>'">
                        <i class="fa fa-pencil-square-o fa-2x pull-left"></i>
                        <span class="f-w-700">Edit Contact</span><br>
                        <small>Change Contact</small>
                    </button>
                    <button class="btn btn-lg btn-danger btn-block" data-target="#modal-delete-contact" data-toggle="modal" data-delete="<?php echo $function_view_contact->cr_contactID ?>">
                        <i class="fa fa-times fa-2x pull-left"></i>
                        <span class="f-w-700">Delete Contact</span><br>
                        <small>Delete Current Contact</small>
                    </button>
                    <?php
                        }
                    ?>
                </p>
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
                <h4 class="panel-title">View</h4>
            </div>
            <?php
                if($function_view_contact == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    No contact data found.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <!-- Nav language tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                    <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                </ul>

                <!-- Tab language panes -->
                <div class="tab-content m-b-0">
                    <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                        <dl class="dl-horizontal m-t-10">
                            <dt>Description</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactDesc == '') 
                                            echo "No Description";
                                        else 
                                            echo $function_view_contact->cr_contactDesc;
                                    ?>
                                </dd>
                            <hr>
                            <dt>Social Media</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactSocial == '') 
                                            echo "Not Shown";
                                        elseif($function_view_contact->cr_contactSocial == 'show')
                                            echo "Show";
                                        elseif($function_view_contact->cr_contactSocial == 'not shown')
                                            echo "Not Shown";
                                    ?>
                                </dd>
                            <hr>
                            <dt>Custom Header</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactCustomheader == '') 
                                            echo "No Custom Header";
                                        else 
                                            echo $function_view_contact->cr_contactCustomheader;
                                    ?>
                                </dd>
                            <hr>
                            <dt>Custom Description</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactCustomDesc == '') 
                                            echo "No Custom Description";
                                        else 
                                            echo $function_view_contact->cr_contactCustomDesc;
                                    ?>
                                </dd>
                        </dl>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_id">
                        <dl class="dl-horizontal m-t-10">
                            <dt>Description</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactDesc_id == '') 
                                            echo "No Description";
                                        else 
                                            echo $function_view_contact->cr_contactDesc_id;
                                    ?>
                                </dd>
                            <hr>
                            <dt>Social Media</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactSocial == '') 
                                            echo "Not Shown";
                                        elseif($function_view_contact->cr_contactSocial == 'show')
                                            echo "Show";
                                        elseif($function_view_contact->cr_contactSocial == 'not shown')
                                            echo "Not Shown";
                                    ?>
                                </dd>
                            <hr>
                            <dt>Custom Header</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactCustomheader_id == '') 
                                            echo "No Custom Header";
                                        else 
                                            echo $function_view_contact->cr_contactCustomheader_id;
                                    ?>
                                </dd>
                            <hr>
                            <dt>Custom Description</dt>
                                <dd>
                                    <?php
                                        if($function_view_contact->cr_contactCustomDesc_id == '') 
                                            echo "No Custom Description";
                                        else 
                                            echo $function_view_contact->cr_contactCustomDesc_id;
                                    ?>
                                </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
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

<div class="modal fade" id="modal-delete-contact">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete content in this contact page?</p>
                <form id="form-delete-contact" action="" method="post">
                    <input type="hidden" name="contact_id" value="">
                    <input type="hidden" name="link" value="<?php echo $action ?>">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-delete-contact" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-delete-contact').on('show.bs.modal', function(e) {
            $(this).find('input[name=contact_id]').attr('value', $(e.relatedTarget).data('delete'));
        });

        $('#modal-permalink').on('show.bs.modal', function(e) {
            $(this).find('#permalink-view').html($(e.relatedTarget).data('permalink'));
        });

        var delete_contact;
        $("#form-delete-contact").submit(function(event){
            if (delete_contact) {
                delete_contact.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_contact = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/page-contact-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-contact").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-contact").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled')},
                data: serializedData
            });
            delete_contact.done(function (msg){
                if(msg == 'contact-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-contact").removeAttr('disabled');
                    $("#button-delete-contact").html('Delete');
                    $.gritter.add({
                        title:"Failed! Contact is required",
                        text:"Can't delete content. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Content has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-contact').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-contact").removeAttr('disabled');
                    $("#button-delete-contact").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete content",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-contact").removeAttr('disabled');
                    $("#button-delete-contact").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete content",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_contact.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
    });
</script>