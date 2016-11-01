<?php
    $function_edit_logo = $class_appearance->edit_logo();
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
                <h4 class="panel-title">Logo</h4>
            </div>
            <?php require "logo-upload.php" ?>
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
        
        var edit_logo;
        $("#form-edit-logo").submit(function(event){
            if (edit_logo) {
                edit_logo.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_logo = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/logo-add.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-logo").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-logo").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            edit_logo.done(function (msg){
                if(msg == 'no-image') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-edit-logo").removeAttr('disabled');
                    $("#button-edit-logo").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! You have not uploaded an image",
                        text:"Can't update logo. You have to upload the logo image. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:"Logo has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo MADMINURL ?>/logo";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-edit-logo").removeAttr('disabled');
                    $("#button-edit-logo").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update logo",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-edit-logo").removeAttr('disabled');
                    $("#button-edit-logo").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update logo",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_logo.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>