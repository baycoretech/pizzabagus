<?php
    $o_getSettings = new settings($pdo);
    $v_getSettingsFontcolor = $o_getSettings->viewSettingsFontcolor();
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
                            <label>Select Font Color</label>
                            <div class="form-group">
                                    <input id="fontcolorpicker" type="text" value="<?php echo $v_getSettingsFontcolor->cr_settingValue ?>" class="form-control" data-colorpicker-guid="1">
                            </div>
                            <p>
                                <button id="restordefault" class="btn btn-success btn-sm m-r-5">Restore Default</button>
                            </p>
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
                            <p class="">
                                <?php
                                    if (isset ($_POST['save'])) {
                                            $value           = $_POST['fontcolor'];
                                            $adminLoginID    = $_POST['adminLoginID'];

                                        if(empty($value) || empty($adminLoginID)){
                                            header("Location: $madinurl/font-coloring");             
                                        }
                                        else {
                                            $v_getUpdateColorscheme = $o_getSettings->updateSettingsFontcolor($value, $adminLoginID);
                                            header("Location: $madinurl/font-coloring"); 
                                                
                                        } 
                                    }
                                ?>
                                <form action="" method="POST">
                                <input id="fontcolorform" type="hidden" name="fontcolor" value="">
                                <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                                <button type="submit" class="btn btn-lg btn-success btn-block" name="save">
                                    <i class="fa fa-paint-brush fa-2x pull-left"></i>
                                    <span class="f-w-700">Save Font</span><br>
                                    <small>Save Font Coloring</small>
                                </button>
                                </form>
                            </p>
                        </div>
                    </div>
                    
			        <!-- end panel -->
			    </div>
</div>
<div class="row">
    <div class="col-md-4">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                </div>
                                <h4 class="panel-title">Heading</h4>
                            </div>
                            <div id="headingfont" class="panel-body">
                                    <h1>h1. Heading 1</h1>
                                    <h2>h2. Heading 2</h2>
                                    <h3>h3. Heading 3</h3>
                                    <h4>h4. Heading 4</h4>
                                    <h5>h5. Heading 5</h5>
                                    <h6>h6. Heading 6</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <div class="panel-heading-btn">
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                                </div>
                                <h4 class="panel-title">Paragraph</h4>
                            </div>
                            <div id="paragraphfont" class="panel-body">
                                    <p>
                                        Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, 
                                        nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
                                    </p>
                                    <p>
                                        Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus
                                         auctor fringilla. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. 
                                         Donec ullamcorper nulla non metus auctor fringilla.
                                    </p>
                                    <p>
                                        Maecenas sed diam eget risus varius blandit sit amet non magna. Donec id elit non mi porta gravida at eget metus. 
                                        Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                    </p>
                            </div>
                        </div>
                    </div>
</div>

<script>
        $(document).ready(function() {
            var auto_refresh = setInterval(
            function () {
                var fontcolorpicker = $('#fontcolorpicker').val();
                $('#fontcolorform').attr('value', fontcolorpicker);
            }, 500);

            var auto_refresh_heading = setInterval(
            function () {
                var fontcolorpicker = $('#fontcolorpicker').val();
                $('#headingfont h1, #headingfont h2, #headingfont h3, #headingfont h4, #headingfont h5, #headingfont h6').css({"color": fontcolorpicker});
            }, 500);

            var auto_refresh_paragraph = setInterval(
            function () {
                var fontcolorpicker = $('#fontcolorpicker').val();
                $('#paragraphfont p').css({"color": fontcolorpicker});
            }, 500);

            $('#restordefault').click(function(){
                $('#fontcolorpicker').val('#506A85');
            })
        });
    
</script>