<?php
    $class_footer = new Footer($pdo);
    $function_view_footer = $class_footer->view_footer();
    $explode_footer = explode(',', $function_view_footer->cr_settingValue);
    $first_column   = $explode_footer[0];
    $second_column  = $explode_footer[1];
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
                <h4 class="panel-title">View</h4>
            </div>
            <div class="panel-body">
            <?php
                if($function_view_footer->cr_settingValue == '' || $function_view_footer->cr_settingValue == NULL) {
		    ?>
		       <div class="alert alert-info fade in m-b-15">
					<strong>Empty!</strong>
					No footer data found.
					<span class="close" data-dismiss="alert">×</span>
				</div>
		    <?php
		        }
		        else {
		    ?>
                <dl class="dl-horizontal m-t-10">
                    <dt>Left Column</dt>
                    <dd>
                    <?php
                        if($first_column == "NULL" || $first_column == "")
                            echo "Empty";
                        else
                            echo $first_column; 
                    ?>
                    </dd>
                    <hr>
                    <dt>Right Column</dt>
                    <dd>
                    <?php
                        if($second_column == "NULL" || $second_column == "")
                            echo "Empty";
                        else
                            echo $second_column; 
                    ?>
                    </dd>
                </dl>
	        <?php
	            }
	        ?>
            </div>
        </div>
		<!-- end panel -->
    </div>
	<!-- end col-9 -->
    <!-- begin col-3 -->
    <div class="col-md-3">
        <!-- begin panel -->
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
                <button class="btn btn-lg btn-success btn-block" data-target="#modal-edit-footer" data-toggle="modal" data-settingid="<?php echo $function_view_footer->cr_settingID ?>" data-firstcolumn='<?php if($function_view_footer->cr_settingValue == '' || $function_view_footer->cr_settingValue == NULL || $first_column == 'NULL') echo ''; else echo $first_column ?>' data-secondcolumn='<?php if($function_view_footer->cr_settingValue == '' || $function_view_footer->cr_settingValue == NULL || $second_column == 'NULL') echo ""; else echo $second_column ?>'>
                    <i class="fa fa-pencil-square-o fa-2x pull-left"></i>
                    <span class="f-w-700">Edit Footer</span><br>
                    <small>Change the Footer</small>
                </button>
            </div>
        </div>
        <!-- end panel -->
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
                            Footer split into two columns, <strong>Left Column</strong> and <strong>Right Column</strong>. 
                            Footer usually contains copyright of a website.
                        </p>
                        <ul class="fa-ul">
                            <li><i class="fa-li fa fa-dot-circle-o"></i><strong>Left Column</strong> - Content that will appear in the left column</li>
                            <li><i class="fa-li fa fa-dot-circle-o"></i><strong>Right Column</strong> - Content that will appear in the right column</li>
                        </ul>
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
                            There are one button below, <strong class="text-success">Edit Footer</strong>. Click <strong class="text-success">Edit Footer</strong> to edit existing footer data.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-edit-footer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Footer</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <p>
                       You can use HTML tag in both column. Use double quote for HTML tag.        
                    </p>
                </div>
                <form id="form-edit-footer" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="setting_idh" value="" id="settingid">
                    <div class="form-group">
                        <label class="control-label">Left Column</label>
                        <input id="firstcolumn" class="form-control" placeholder="Left Column" type="text" name="firstcolumn" value="" data-parsley-maxlength="700">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Right Column</label>
                        <input id="secondcolumn" class="form-control" placeholder="Right Column" type="text" name="secondcolumn" value="" data-parsley-maxlength="700">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-footer" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-edit-footer').on('show.bs.modal', function(e) {
            $(this).find('#firstcolumn').attr('value', $(e.relatedTarget).data('firstcolumn'));
            $(this).find('#secondcolumn').attr('value', $(e.relatedTarget).data('secondcolumn'));
            $(this).find('#settingid').attr('value', $(e.relatedTarget).data('settingid'));
        });

        var edit_footer;
        $("#form-edit-footer").submit(function(event){
            if (edit_footer) {
                edit_footer.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_footer = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/footer-update.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-footer").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-footer").attr('disabled','disabled');},
                data: serializedData
            });
            edit_footer.done(function (msg){
                if(msg == 'firstcolumn-long') {
                    $("#button-edit-footer").removeAttr('disabled');
                    $("#button-edit-footer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Left column is too long",
                        text:"Can't update footer. It should have 700 characters or less. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                if(msg == 'secondcolumn-long') {
                    $("#button-edit-footer").removeAttr('disabled');
                    $("#button-edit-footer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Right column is too long",
                        text:"Can't update footer. It should have 700 characters or less. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Footer has been updated",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-edit-footer').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-edit-footer").removeAttr('disabled');
                    $("#button-edit-footer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update footer",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-edit-footer").removeAttr('disabled');
                    $("#button-edit-footer").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update footer",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_footer.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>