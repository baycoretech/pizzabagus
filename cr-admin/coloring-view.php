<?php
    $function_color_scheme     = $class_settings->view_settings_color_scheme();
    $function_custom_primary   = $class_settings->view_settings_custom_primary();
    $function_custom_secondary = $class_settings->view_settings_custom_secondary();
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
                <h4 class="panel-title">Color Select</h4>
            </div>
            <div class="panel-body">
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="green" <?php if($function_color_scheme->cr_settingValue == "green") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-green.png" ?>">
                        Green
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="blue" <?php if($function_color_scheme->cr_settingValue == "blue") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-blue.png" ?>">
                        Blue
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="orange" <?php if($function_color_scheme->cr_settingValue == "orange") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-orange.png" ?>">
                        Orange
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="red" <?php if($function_color_scheme->cr_settingValue == "red") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-red.png" ?>">
                        Red
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="pink" <?php if($function_color_scheme->cr_settingValue == "pink") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-pink.png" ?>">
                        Pink
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="purple" <?php if($function_color_scheme->cr_settingValue=="purple") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-purple.png" ?>">
                        Purple
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="gray" <?php if($function_color_scheme->cr_settingValue == "gray") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-gray.png" ?>">
                        Gray
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input class="standardcolor" type="radio" name="colorscheme" value="navy" <?php if($function_color_scheme->cr_settingValue == "navy") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-navy.png" ?>">
                        Navy
                    </label>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-1">   
                    <label class="rwi">
                        <input id="customcolor" class="" type="radio" name="colorscheme" value="custom" <?php if($function_color_scheme->cr_settingValue == "custom") echo 'checked="checked"' ?>>
                        <img style="width:100%" src="<?php echo MADMINURL."assets/img/coloring-custom.png" ?>">
                        Custom
                    </label>
                </div>
                <div class="clearfix"></div>
                <div id="colorsetup" class="m-t-15">
                    <label>Select Custom Colors</label>
                    <div class="form-group">
                        <input id="primarycolorpicker" placeholder="Select Primary Color" type="text" value="<?php if($function_custom_primary->cr_settingValue == "" || empty($function_custom_primary->cr_settingValue)) echo ""; else echo $function_custom_primary->cr_settingValue ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <input id="secondarycolorpicker" placeholder="Select Secondary Color" type="text" value="<?php if($function_custom_secondary->cr_settingValue == "" || empty($function_custom_secondary->cr_settingValue)) echo ""; else echo $function_custom_secondary->cr_settingValue ?>" class="form-control">
                    </div>
                </div>
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
                    <form id="form-set_coloring" action="" method="POST">
                        <input id="colorschemeform" type="hidden" name="color_scheme" value="">
                        <input id="customprimary" type="hidden" name="custom_primary" value="">
                        <input id="customsecondary" type="hidden" name="custom_secondary" value="">
                        <button id="button-set_coloring" type="submit" class="btn btn-lg btn-success btn-block" name="save">
                            <i class="fa fa-paint-brush fa-2x pull-left"></i>
                            <span class="f-w-700">Save Coloring</span><br>
                            <small>Save New Coloring</small>
                        </button>
                    </form>
            </div>
        </div>
		<!-- end panel -->
	</div>
</div>
<script>
    $(document).ready(function() {
        $.gritter.add({
            title:"Creatify Tips",
            text:"Select a color scheme that is on the list or select custom to make your own color scheme.",
            image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
            sticky:true,
            time:""
        });
        $("#colorsetup").hide();
        $("#customcolor").click(function(){
            if ($("#customcolor").is(":checked")) {
                $("#colorsetup").show();
            } else {
                $("#colorsetup").hide();
            }
        });
        $(".standardcolor").click(function(){
            $("#colorsetup").hide();
        });
        var auto_refresh = setInterval(
        function () {
            var asd = $('input[name=colorscheme]:checked').val();
            $('#colorschemeform').attr('value', asd);
        }, 500);
        var auto_refresh = setInterval(
        function () {
            var ccs = $('#colorschemeform').val();
            var cp = $('#primarycolorpicker').val();
            var sp = $('#secondarycolorpicker').val();
            if(ccs == "custom") {
                $('#customprimary').attr('value', cp);
                $('#customsecondary').attr('value', sp);
            }
            else {
                $('#customprimary').attr('value', '');
                $('#customsecondary').attr('value', '');
            }
        }, 500);
        var set_coloring;
            $("#form-set_coloring").submit(function(event){
                if (set_coloring) {
                    set_coloring.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                set_coloring = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/coloring-set.php",
                    type: "post",
                    beforeSend: function(){ $("#button-set_coloring").html('<i class="fa fa-spinner fa-pulse fa-2x pull-left"></i><span class="f-w-700">Saving...</span><br><small>Save New Coloring</small>');$("#button-set_coloring").attr('disabled','disabled');},
                    data: serializedData
                });
                set_coloring.done(function (msg){
                    if(msg == 'no-color') {
                        $("#button-set_coloring").removeAttr('disabled');
                        $("#button-set_coloring").html('<i class="fa fa-paint-brush fa-2x pull-left"></i><span class="f-w-700">Save Coloring</span><br><small>Save New Coloring</small>');
                        $.gritter.add({
                            title:"Failed! Please select color scheme",
                            text:"Can't set coloring. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Coloring has been set.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'coloring')) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-set_coloring").removeAttr('disabled');
                        $("#button-set_coloring").html('<i class="fa fa-paint-brush fa-2x pull-left"></i><span class="f-w-700">Save Coloring</span><br><small>Save New Coloring</small>');
                        $.gritter.add({
                            title:"Failed! Can't set coloring",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-set_coloring").removeAttr('disabled');
                        $("#button-set_coloring").html('<i class="fa fa-paint-brush fa-2x pull-left"></i><span class="f-w-700">Save Coloring</span><br><small>Save New Coloring</small>');
                        $.gritter.add({
                            title:"Error! Can't set coloring",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                set_coloring.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            });
    });
</script>