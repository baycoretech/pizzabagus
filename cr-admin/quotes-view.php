<?php
    $class_quotes  = new Quotes($pdo);
    $function_view_quotes    = $class_quotes->view_quotes();
    $function_quotes_menu    = $class_quotes->view_page_for_quotes_menu();
    $function_quotes_submenu = $class_quotes->view_page_for_quotes_submenu();
    $function_quotes_pageid  = $class_quotes->view_quotes_in_page_id();
    $function_quotes_page    = explode(",", $class_quotes->view_quotes_in_page());
    $function_quotes_title   = $class_settings->view_settings_quotes_title();
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
                <h4 class="panel-title">Quote List</h4>
            </div>
            <div class="panel-toolbar">
                <button class="btn btn-success" data-target="#modal-add-quote" data-toggle="modal"><i class="fa fa-plus"></i> Add Quote</button>
                <button class="btn btn-info" data-target="#modal-quote-title" data-toggle="modal" data-settingid="<?php echo $function_quotes_title->cr_settingID ?>" data-qt="<?php echo $function_quotes_title->cr_settingValue ?>"><i class="fa fa-cog"></i> Quotes Title</button>
            </div>
            <?php
                if($function_view_quotes == false) {
            ?>
            <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <strong>Empty!</strong>
                    No quote data found.
                </p>
            </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th width="30" class="text-center">#</th>
                                <th class="">Name</th>
                                <th class="">He/She said</th>
                                <th class="">Status</th>
                                <th width="120" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $i=1;
                            foreach ($function_view_quotes as $quote) {
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class=""><?php echo $quote->cr_quotesName ?></td>
                                <td class="add-caps"><?php echo $quote->cr_quotesText ?></td>
                                <td class="add-caps"><?php echo ucfirst($quote->cr_quotesStatus) ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-icon btn-circle" data-target="#modal-edit-quote" data-toggle="modal" data-qid="<?php echo $quote->cr_quotesID ?>" data-quotesname="<?php echo $quote->cr_quotesName ?>" data-quotestext="<?php echo $quote->cr_quotesText ?>" data-quotesstatus="<?php echo $quote->cr_quotesStatus ?>"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#modal-delete-quote" data-toggle="modal" data-dn="<?php echo $quote->cr_quotesName ?>" data-delete="<?php echo $quote->cr_quotesID; ?>"><i class="fa fa-times"></i></button>
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

<div class="modal fade" id="modal-add-quote">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Quote</h4>
            </div>
            <div class="modal-body">
                <form id="form-add-quote" data-parsley-validate action="" method="POST">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input class="form-control" placeholder="Name" type="text" name="name" data-parsley-maxlength="50" autofocus required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">He/She said</label>
                        <textarea class="form-control" name="text" placeholder="Write here..." rows="5" data-parsley-maxlength="255" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">Select Status</option>
                            <option value="show">Show</option>
                            <option value="not shown">Not Shown</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-add-quote" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-quote">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Quote</h4>
            </div>
            <div class="modal-body">
                <form id="form-edit-quote" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="quote_idh" value="">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input class="form-control" placeholder="Name" type="text" name="name" value="" data-parsley-maxlength="50" autofocus required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">What He/She is Saying</label>
                        <textarea class="form-control" placeholder="Write here..." name="text" rows="3" data-parsley-minlength="3" data-parsley-maxlength="255" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="">Select Status</option>
                            <option value="show">Show</option>
                            <option value="not shown">Not Shown</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-quote" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-quote">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete quote from <span id="dn"></span>?</p>
                <form id="form-delete-quote" action="" method="post">
                    <input type="hidden" name="quote_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-quote" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-quote-title">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Quotes Title and Page</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    Type what do you want to show in front-end website for quotes title.
                </div>
                <form id="form-quote-title" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="settingIDh" value="">
                        <input type="hidden" name="settingname" value="Quotes Title and Page">
                        <div class="form-group">
                            <label class="control-label">Quote Title</label>
                            <input class="form-control" placeholder="Quote Title" type="text" name="quotetitle" value="" data-parsley-maxlength="50" autofocus required>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Show in Page</label>
                            </div>
                            <div class="col-md-6">
                                <p>Menu(s)</p>
                                <div class="form-group">
                                <?php
                                    if($function_quotes_menu == false) {
                                        echo "<p>No menu found.</p>";
                                    }
                                    else {
                                        foreach($function_quotes_menu as $data) {
                                ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="quotepage[]" value="<?php echo $data->cr_menuLink ?>" <?php if(in_array($data->cr_menuLink, $function_quotes_page) === true) echo 'checked="checked"' ?>>
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
                                    if($function_quotes_submenu == false) {
                                        echo "<p>No submenu found.</p>";
                                    }
                                    else {
                                        foreach($function_quotes_submenu as $data) {
                                ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="quotepage[]" value="<?php echo $data->cr_submenuLink ?>" <?php if(in_array($data->cr_submenuLink, $function_quotes_page) === true) echo 'checked="checked"' ?>>
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
                <button id="button-quote-title" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo MADMINURL ?>assets/plugins/DataTables/css/data-table.css" type="text/css" rel="stylesheet" />
<script type="text/javascript">
    $(document).ready(function(){
        $("#data-table").DataTable({dom:'C<"clear">lfrtip'});

        $('#modal-edit-quote').on('show.bs.modal', function(e) {
            $(this).find('input[name=quote_idh]').attr('value', $(e.relatedTarget).data('qid'));
            $(this).find('input[name=name]').attr('value', $(e.relatedTarget).data('quotesname'));
            $(this).find('textarea[name=text]').attr('value', $(e.relatedTarget).data('quotestext'));
            $(this).find('select[name=status]').attr('value', $(e.relatedTarget).data('quotesstatus'));
        });

        $('#modal-delete-quote').on('show.bs.modal', function(e) {
            $(this).find('input[name=quote_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });

        $('#modal-quote-title').on('show.bs.modal', function(e) {
            $(this).find('input[name=settingIDh]').attr('value', $(e.relatedTarget).data('settingid'));
            $(this).find('input[name=quotetitle]').attr('value', $(e.relatedTarget).data('qt'));
        });

        var add_quote;
        $("#form-add-quote").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_quote) {
                    add_quote.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                add_quote = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/quote-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-quote").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-quote").attr('disabled','disabled');},
                    data: serializedData
                });
                add_quote.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-add-quote").removeAttr('disabled');
                        $("#button-add-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't add new quote. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $("#button-add-quote").removeAttr('disabled');
                        $("#button-add-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Name is too long",
                            text:"Can't add new quote. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'quote-long') {
                        $("#button-add-quote").removeAttr('disabled');
                        $("#button-add-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Quote is too long",
                            text:"Can't add new quote. It should have 255 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New quote has been added.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-add-quote").removeAttr('disabled');
                        $("#button-add-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new quote",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-add-quote").removeAttr('disabled');
                        $("#button-add-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new quote",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                add_quote.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var edit_quote;
        $("#form-edit-quote").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_quote) {
                    edit_quote.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_quote = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/quote-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-quote").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-quote").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_quote.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-edit-quote").removeAttr('disabled');
                        $("#button-edit-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't update quote. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $("#button-edit-quote").removeAttr('disabled');
                        $("#button-edit-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Name is too long",
                            text:"Can't update quote. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'quote-long') {
                        $("#button-edit-quote").removeAttr('disabled');
                        $("#button-edit-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Quote is too long",
                            text:"Can't update quote. It should have 255 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Quote has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-edit-quote").removeAttr('disabled');
                        $("#button-edit-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update quote",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-edit-quote").removeAttr('disabled');
                        $("#button-edit-quote").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update quote",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_quote.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var quote_title;
        $("#form-quote-title").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (quote_title) {
                    quote_title.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                quote_title = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/quote-title.php",
                    type: "post",
                    beforeSend: function(){ $("#button-quote-title").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-quote-title").attr('disabled','disabled');},
                    data: serializedData
                });
                quote_title.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-quote-title").removeAttr('disabled');
                        $("#button-quote-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill all required field",
                            text:"Can't set quote title. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'name-long') {
                        $("#button-quote-title").removeAttr('disabled');
                        $("#button-quote-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Title is too long",
                            text:"Can't set quote title. It should have 50 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Quote title has been set.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-quote-title").removeAttr('disabled');
                        $("#button-quote-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't set quote title",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-quote-title").removeAttr('disabled');
                        $("#button-quote-title").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't set quote title",
                            text:msg,
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                quote_title.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_quote;
        $("#form-delete-quote").submit(function(event){
            if (delete_quote) {
                delete_quote.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var quote_name = $("#modal-delete-quote").find("#dn").html();
            var serializedData = $form.serialize();
            delete_quote = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/quote-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-quote").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-quote").attr('disabled','disabled');},
                data: serializedData
            });
            delete_quote.done(function (msg){
                if(msg == 'quote-empty') {
                    $("#button-delete-quote").removeAttr('disabled');
                    $("#button-delete-quote").html('Delete');
                    $.gritter.add({
                        title:"Failed! Quote is required",
                        text:"Can't delete quote from "+quote_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Quote from "+quote_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-quote').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-quote").removeAttr('disabled');
                    $("#button-delete-quote").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete quote from "+quote_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-quote").removeAttr('disabled');
                    $("#button-delete-quote").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete quote from "+quote_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_quote.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 
    });
</script>