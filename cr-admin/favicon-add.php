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
                <h4 class="panel-title">Add Favicon</h4>
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

        var add_favicon;
        $("#form-add-favicon").submit(function(event){
            if (add_favicon) {
                add_favicon.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            add_favicon = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/favicon-add.php",
                type: "post",
                beforeSend: function(){ $("#button-add-favicon").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-favicon").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            add_favicon.done(function (msg){
                if(msg == 'no-image') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-add-favicon").removeAttr('disabled');
                    $("#button-add-favicon").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! You have not uploaded an image",
                        text:"Can't add new favicon. You have to upload the favicon image. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:"New favicon has been added.",
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
                    $("#button-add-favicon").removeAttr('disabled');
                    $("#button-add-favicon").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't add new favicon",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-add-favicon").removeAttr('disabled');
                    $("#button-add-favicon").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't add new favicon",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            add_favicon.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>