<?php
    $class_social = new Social($pdo);
    $function_edit_social = $class_social->edit_social();
?>
<div class="row">
    <!-- begin col-8 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Social Links</h4>
            </div>
            <div id="" class="panel-body">
                <form id="form-edit-social" data-parsley-validate action="" method="POST">
                    <?php
                        $len = count($function_edit_social);
                        foreach ($function_edit_social as $social) {
                            $placeholder = ucwords($social->cr_socialName);
                    ?>
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="<?php if($social->cr_socialName=="google-plus") echo "Google Plus"; else  echo $placeholder ?>" name="<?php echo $social->cr_socialName ?>" value="<?php if($social->cr_socialLink=="Empty") echo ""; else echo $social->cr_socialLink ?>" data-parsley-type="<?php if($social->cr_socialName=='email') echo "email"; else echo "url"; ?>">
                        <span class="fa fa-<?php echo $social->cr_socialName ?> form-control-feedback"></span>
                    </div>
                    <?php
                        }
                    ?>
            </div>
            <div class="panel-footer">
                <button id="button-edit-social" type="submit" class="btn btn-success m-r-5 m-b-5"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default button-cancel m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => 'social')) ?>'">Cancel</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var edit_social_link;
        $("#form-edit-social").submit(function(event){
            if (edit_social_link) {
                edit_social_link.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_social_link = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/social-update-link.php",
                type: "post",
                beforeSend: function(){ $("#button-edit-social").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-social").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            edit_social_link.done(function (msg){
                if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Social link(s) has been updated",
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
                    $("#button-edit-social").removeAttr('disabled');
                    $("#button-edit-social").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update social link(s)",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-edit-social").removeAttr('disabled');
                    $("#button-edit-social").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update social link(s)",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_social_link.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    })
</script>