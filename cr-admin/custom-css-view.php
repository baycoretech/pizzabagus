<?php
    $function_folder_name = $class_administrative->folder_name();
    if($function_folder_name == false) {
        $target_folder = $_SERVER['DOCUMENT_ROOT']."/";
    }
    else {
        $target_folder = $_SERVER['DOCUMENT_ROOT']."/".$function_folder_name."/";
    }
    $custom_css_file   = fopen($target_folder.'cr-editor/css/custom.css','r');
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
                <h4 class="panel-title">Custom CSS</h4>
            </div>
            <div class="panel-toolbar">
                <button id="save-custom-stylesheet" class="btn btn-success">Save Custom CSS</button>
            </div>
            <div class="panel-body p-0">
                <textarea id="custom-stylesheet" class="form-control" rows="20" style="width: 100%"><?php while ($line = fgets($custom_css_file)) { echo($line);} fclose($custom_css_file); ?></textarea>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#custom-stylesheet').ace({ theme: 'github', lang: 'css' });

        $('#save-custom-stylesheet').click(function() {
            var target       = '<?php echo $target_folder.'cr-editor/css/custom.css' ?>';
            var line         = $("#custom-stylesheet").val();
            var dataString   = 'target='+target+'&line='+line;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/custom-stylesheet-update.php",
                data: dataString,
                cache: false,
                    beforeSend: function(){ $("#save-custom-stylesheet").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#save-custom-stylesheet").attr('disabled','disabled');},
                    success: function(data){
                        if(data == "false") {
                            $("#save-custom-stylesheet").removeAttr('disabled');
                            $.gritter.add({
                                title:"Failed! There is something error when saving the file",
                                text:"Can't update custom css. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        if(data == "true") {
                            $.gritter.add({
                                title:"Success!",
                                text:"Custom css has been updated.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                            setTimeout(function() {
                                window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                            }, 2000);
                        }
                        else {
                            $("#save-custom-stylesheet").removeAttr('disabled');
                            $.gritter.add({
                                title:"Error! There is something error when saving the file",
                                text:"Can't update custom css. Please try again."+data,
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    }
            });
            return false;
        });
    })
</script>
