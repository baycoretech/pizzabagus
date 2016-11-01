<?php
    $function_view_fonts = $class_appearance->view_fonts();
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
                <h4 class="panel-title">Font List</h4>
            </div>
            <div class="panel-toolbar">
                <button type="button" class="btn btn-success m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => 'add')) ?>'"><i class="fa fa-plus"></i> Add Font</button>
                <button type="button" class="btn btn-light-blue m-b-5" data-target="#modal-tutorial-font" data-toggle="modal"><i class="fa fa-video-camera"></i> Tutorial</button>
            </div>
            <?php
                if($function_view_fonts == false) {
            ?>
                <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                    <p>
                    <strong>Empty!</strong>
                    No font found.
                    </p>
                </div>   
            <?php
                }
                else {
            ?> 
            <div class="panel-body">
                <dl class="dl-horizontal m-t-10">
                <?php
                    foreach($function_view_fonts as $font) {
                        if($font->cr_fontsApplied == 'page-heading')
                            $applied = 'Page Heading';
                        else 
                            $applied = ucwords($font->cr_fontsApplied);
                ?>
                    <dt><?php echo $font->cr_fontsName ?></dt>
                    <dd>
                        <?php echo '<code>'.htmlentities($font->cr_fontsLink).'</code> (Applied to '.$applied.')' ?>
                        <button class="btn btn-danger btn-icon btn-circle btn-sm pull-right" data-target="#modal-delete-font" data-toggle="modal" data-delete="<?php echo $font->cr_fontsID ?>" data-name="<?php echo $font->cr_fontsName ?>"><i class="fa fa-times"></i></button>
                        <button class="btn btn-success btn-icon btn-circle btn-sm pull-right m-r-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => 'edit', 'id' => $font->cr_fontsID)) ?>'"><i class="fa fa-pencil"></i></button>
                    </dd>
                <?php if(end($function_view_fonts) !== $font) echo '<hr>'; } ?>
                </dl>
            </div>
            <?php
                }
            ?>
        </div>
        <!-- end panel -->
    </div>
</div>

<div class="modal fade" id="modal-tutorial-font">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tutorial</h4>
            </div>
            <div class="modal-body">
                <div class="note note-info">
                    Creatify use <a href="https://fonts.google.com/" target="_blank">Google Font</a> for easy access and has a large collection of fonts.
                </div>
                <img class="img-responsive" src="" alt="Tutorial Get Google Font" width="100%">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-font">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="font-name"></span>?</p>
                <form id="form-delete-font" action="" method="post">
                    <input type="hidden" name="font_id" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-font" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#modal-tutorial-font').on('show.bs.modal', function(e) {
            $(this).find('img').attr('src','<?php echo MADMINURL.'assets/img/tutorial/totorial_get_google_fonts.gif' ?>');
        });

        $('#modal-tutorial-font').on('hidden.bs.modal', function(e) {
            $(this).find('img').attr('src','');
        });

        $('#modal-delete-font').on('show.bs.modal', function(e) {
            $(this).find('input[name=font_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#font-name').html($(e.relatedTarget).data('name'));
        });

        var delete_font;
        $("#form-delete-font").submit(function(event){
            if (delete_font) {
                delete_font.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var font_name = $("#modal-delete-font").find("#font-name").html();
            var serializedData = $form.serialize();
            delete_font = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/font-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-font").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-font").attr('disabled','disabled');},
                data: serializedData
            });
            delete_font.done(function (msg){
                if(msg == 'font-empty') {
                    $("#button-delete-font").removeAttr('disabled');
                    $("#button-delete-font").html('Delete');
                    $.gritter.add({
                        title:"Failed! Font is required",
                        text:"Can't delete "+font_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:font_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-font').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-font").removeAttr('disabled');
                    $("#button-delete-font").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+font_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-font").removeAttr('disabled');
                    $("#button-delete-font").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+font_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_font.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  
    });
</script>