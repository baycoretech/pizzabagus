<?php
    $function_edit_favicon = $class_appearance->edit_favicon();
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
                <h4 class="panel-title">Favicon</h4>
            </div>
            <?php require "favicon-upload.php" ?>
         </div>
        <!-- end panel -->
    </div>
</div>
<script>
    $(document).ready(function() {
        var auto_refresh = setInterval(
        function () {
            var asd = $('.avatar-view').find('img').attr('src');
            $('#avatarForm').attr('value', asd);
        }, 500);

        var edit_favicon;
        $("#form-edit-favicon").submit(function(event){
            if (edit_favicon) {
                edit_favicon.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_favicon = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/favicon-add.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-favicon").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-favicon").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            edit_favicon.done(function (msg){
                if(msg == 'no-image') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-edit-favicon").removeAttr('disabled');
                    $("#button-edit-favicon").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! You have not uploaded an image",
                        text:"Can't update favicon. You have to upload the favicon image. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:"Favicon has been updated.",
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
                    $("#button-edit-favicon").removeAttr('disabled');
                    $("#button-edit-favicon").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update favicon",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-edit-favicon").removeAttr('disabled');
                    $("#button-edit-favicon").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update favicon",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_favicon.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>