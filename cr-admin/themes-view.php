<?php
    $function_get_theme     = $class_appearance->get_theme();
    $used_theme             = $function_get_theme->cr_settingValue;
    $function_bg_template   = $class_settings->view_settings_background_template();
    $function_bg_repeat     = $class_settings->view_settings_background_repeat();
    $function_bg_position   = $class_settings->view_settings_background_position();
    $function_bg_attachment = $class_settings->view_settings_background_attachment();
    $function_bg_size       = $class_settings->view_settings_background_size();
    $function_layout        = $class_settings->view_settings_layout_mode();
?>
<div class="row">
	<div class="col-md-9">
		<div class="panel panel-inverse" data-sortable-id="ui-media-object-4">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Theme List</h4>
            </div>
            <div class="panel-body">
			    <ul class="media-list media-list-with-divider">
                    <?php
                        $function_folder_name = $class_administrative->folder_name();
                        if($function_folder_name == false) {
                            $target_folder = $_SERVER['DOCUMENT_ROOT']."/cr-content/themes/";
                        }
                        else {
                            $target_folder = $_SERVER['DOCUMENT_ROOT']."/".$function_folder_name."/cr-content/themes/";
                        }
                        if ($handle = opendir($target_folder)) {
                            while (false !== ($entry = readdir($handle))) {
                                if ($entry != "." && $entry != "..") {
                                    $getDetail      = file($target_folder.$entry.'/detail.txt');
                                    $theme_name     = trim(preg_replace('/\s+/', ' ', $getDetail[0]));
                                    $theme_author   = $getDetail[1]; 
                                    $theme_desc     = $getDetail[2]; 
                                    $theme_option   = $getDetail[3]; 
                                    $theme_version  = $getDetail[4]; 
                                    $version        = str_replace('.','',$theme_version);
                                    $explode_option = explode(',', $theme_option);
                                        $option1    = $explode_option[0];//wide
                                        $option2    = $explode_option[1];//boxed
                                        $option3    = $explode_option[2];//background image
                                        $option4    = $explode_option[3];
                                        $option5    = $explode_option[4];
                                        /*
                                        Option for disabled feature
                                        Appearance
                                          |--Home Page Styles    => homepagestyles
                                          |--Coloring            => coloring
                                        Section
                                          |--Slider Image        => slider
                                          |--Clients or Partners => clientspartners
                                          |--Contact HHeader     => contactheader
                                          |--Primary Footer      => primaryfooter
                                          |--Jumbotron           => jumbotron
                                          |--Quotes              => quotes
                                          |--Services            => services
                                        Page
                                          |--Blog                => blog
                                        */
                    ?>
                        <li class="media media-lg">
                            <a class="media-left hidden-xs" href="">
                                <img src="<?php echo MURL."cr-content/themes/".$entry."/screenshot.png" ?>" alt="<?php echo $data->cr_themesName." screenshot" ?>" class="media-object" />
                            </a>
                            <a class="show-sd hidden-sm hidden-md hidden-lg" href="">
                                <img src="<?php echo MURL."cr-content/themes/".$entry."/screenshot.png" ?>" alt="<?php echo $theme_name." screenshot" ?>" style="width: 100%;" class="m-b-15" />
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $theme_name ?></h4>
                                <p><i class="fa fa-user"></i> <?php echo $theme_author ?> <i class="fa fa-paint-brush m-l-10"></i> <?php echo $theme_version ?></p>
                                <p><?php echo $theme_desc ?></p>
                                <p>
                                    <button class="btn btn-sm btn-success m-r-5 m-t-5" <?php if($entry == $used_theme) echo "disabled" ?> data-target="#modal-apply-theme" data-toggle="modal" data-dn="<?php echo $theme_name; ?>" data-folder="<?php echo $entry; ?>"><i class="fa fa-<?php if($entry == $used_theme) echo "check"; else echo "paint-brush" ?>"></i> <?php if($entry == $used_theme) echo "Selected"; else echo "Apply Theme" ?></button>
                                    <?php
                                        if($theme_option != "") {
                                            if($option1 == "wide") {
                                    ?>  
                                        <button class="btn btn-sm btn-success button-layout m-r-5 m-t-5" <?php if($function_layout->cr_settingValue == "wide") echo "disabled" ?> id="wide-button-<?php echo $entry ?>" data-theme="<?php echo $entry ?>" data-layout="wide" data-trigger="hover focus" data-toggle="popover" data-container="body" title="Layout Mode" data-placement="top" data-content="Choose wide for wider layout"><i class="fa fa-arrow-left"></i> Wide <i class="fa fa-arrow-right"></i></button>
                                    <?php
                                            }
                                            elseif($option1 == "none") {
                                                echo "";
                                            }

                                            if($option2 == "boxed") {
                                    ?>
                                        <button class="btn btn-sm btn-success button-layout m-r-5 m-t-5" <?php if($function_layout->cr_settingValue == "boxed") echo "disabled" ?> id="boxed-button-<?php echo $entry ?>" data-theme="<?php echo $entry ?>" data-layout="boxed" data-trigger="hover focus" data-toggle="popover" data-container="body" title="Layout Mode" data-placement="top" data-content="Choose boxed for box layout with background image"><i class="fa fa-arrow-right"></i> Boxed <i class="fa fa-arrow-left"></i></button>
                                    <?php
                                            }
                                            elseif($option2 == "none") {
                                                echo "";
                                            }
                                        }
                                    ?>
                                    <button class="btn btn-sm btn-success m-r-5 m-t-5" data-toggle="modal" data-target="#modal-update-themes" data-folder="<?php echo $entry ?>" data-themename="<?php echo $theme_name ?>" data-version="<?php echo $version ?>" data-targetfolder="<?php if($function_folder_name == false) echo 'withoutfolder'; else echo $function_folder_name ?>"><i class="fa fa-file-zip-o"></i> Update</button>
                                </p>
                            </div>
                        </li> 
                    
                    <?php
                                }
                            }
                            closedir($handle);
                        }
                    ?>   
				</ul>
			</div>
		</div>
	</div>
    <div class="col-md-3">
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
                <button type="button" class="btn btn-lg btn-info btn-block" onclick="window.open('<?php echo $router->generate('admin-dashboard-section', array('section' => 'themes-preview')) ?>', '_blank');">
                    <i class="fa fa-mobile fa-2x pull-left"></i>
                    <span class="f-w-700">Preview Themes</span><br>
                    <small>Preview Selected Themes</small>
                </button>
                <button type="button" data-target="#modal-upload-themes" data-toggle="modal" class="btn btn-lg btn-success btn-block">
                    <i class="fa fa-upload fa-2x pull-left"></i>
                    <span class="f-w-700">Upload Themes</span><br>
                    <small>Upload New Themes</small>
                </button>
            </div>
        </div>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Background Image</h4>
            </div>
            <div class="panel-body">
                <div id="used-image-container">
                    <?php
                        if($function_bg_template->cr_settingValue != '') 
                            echo '<img width="100%" src="'.MURL.'cr-editor/images/'.$function_bg_template->cr_settingValue.'">'
                    ?>
                </div>
                <form action="<?php echo MADMINURL ?>ajax/media-select-upload.php" class="dropzone" id="logindropzone">
                    <div class="dz-message text-center">
                        <h3><i class="fa fa-cloud-upload fa-2x"></i></h3>
                        <h4>Drag and Drop Files</h4>
                    </div>
                </form>
                <p class="fancy m-t-20"><span>OR</span></p>
                <button id="browse-media-button" data-target="#browse-media-dialog" data-toggle="modal" class="btn btn-success btn-block m-t-15"><i class="fa fa-image"></i> Browse Media</button>
                <?php
                    if($function_bg_template->cr_settingValue != '') { 
                ?>
                <div class="btn-group btn-group-justified m-t-5">
                    <a role="button" data-target="#modal-background-option" data-toggle="modal" class="btn btn-default btn-sm">Option</a>
                    <a role="button" id="button-remove-background" class="btn btn-danger btn-sm">Remove</a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
    $class_media = new Media($pdo);
    $function_view_media_data = $class_media->view_media_data();
?>
<div class="modal fade" id="browse-media-dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Browse Media</h4>
            </div>
            <div class="modal-body">
                <div id="error-handling"></div>
                <div class="row">
                    <div class="col-md-9">
                    <form id="form-media-browse" action="" method="POST">
                        <div class="form-group">
                        <?php
                            $i = 1;
                            foreach($function_view_media_data as $data) {
                        ?>
                            <div class="col-md-3">   
                                <label class="rwi">
                                    <input class="" type="radio" name="mediaselect" value="<?php echo $data->cr_mediaName ?>" data-title="<?php if(empty($data->cr_mediaTitle)) echo 'No title'; else echo $data->cr_mediaTitle ?>" data-desc="<?php if(empty($data->cr_mediaDesc)) echo 'No description'; else echo $data->cr_mediaDesc ?>" <?php if($i == 1) echo 'checked="checked"' ?>>
                                    <div class="nailthumb-container modal-square-thumb">
                                        <img style="width:100%" src="<?php echo MURL."cr-editor/images/".$data->cr_mediaName ?>">
                                    </div>
                                </label>
                            </div>
                        <?php
                                $i++;
                            }
                        ?>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    </div>
                    <div class="col-md-3">
                        <?php
                            $function_view_latest_media_data = $class_media->view_latest_media_data();
                        ?>
                        <legend>Media Information</legend>
                        <dl>
                            <dt>Title</dt>
                            <dd id="media-title-info"><?php if(empty($function_view_latest_media_data->cr_mediaTitle)) echo 'No title'; else echo $function_view_latest_media_data->cr_mediaTitle ?></dd>
                            <dt class="m-t-10">Description</dt>
                            <dd id="media-desc-info"><?php if(empty($function_view_latest_media_data->cr_mediaDesc)) echo 'No title'; else echo $function_view_latest_media_data->cr_mediaDesc ?></dd>
                        </dl>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="button-media-select" type="button" class="btn btn-success">Select</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-alert">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Failed to upload the image. Please try again.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-apply-theme">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to apply <span id="dn"></span> as your theme?</p>
                <form id="form-apply-theme" action="" method="post">
                    <input type="hidden" name="theme_folder" value="">
                    <input type="hidden" name="theme_name" value="">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="button-apply-theme" type="submit" class="btn btn-success" name="apply">Apply Theme</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload-themes">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Upload New Themes</h4>
            </div>
            <div class="modal-body">
                <form id="form-upload-theme" enctype="multipart/form-data" data-parsley-validate action="" method="POST">
                    <input type="file" name="ziptheme" required>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button id="button-upload-theme" type="submit" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-update-themes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><span id="theme-update-name"></span> - Update Themes</h4>
            </div>
            <div class="modal-body">
                <p id="update-information">Click Check button to check if update available.</p>
            </div>
            <div class="modal-footer">
                <button id="check-update-btn" type="button" class="btn btn-default" data-foldertheme="" data-versiontheme="" data-tfldr="">Check</button>
                <button id="update-theme-btn" type="submit" class="btn btn-success" data-tfldr="" disabled="disable">Update</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-background-option">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Background Option</h4>
            </div>
            <div class="modal-body">
                <form id="form-background-option" data-parsley-validate action="" method="POST">
                    <div class="form-group">
                        <label class="control-label">Background Repeat</label>
                        <select class="form-control" name="backgroundrepeat">
                            <option value="">Select Background Repeat</option>
                            <option value="repeat" <?php if($function_bg_repeat->cr_settingValue == "repeat") echo 'selected="selected"' ?>>Repeat</option>
                            <option value="repeat-x" <?php if($function_bg_repeat->cr_settingValue == "repeat-x") echo 'selected="selected"' ?>>Repeat-x</option>
                            <option value="repeat-y" <?php if($function_bg_repeat->cr_settingValue == "repeat-y") echo 'selected="selected"' ?>>Repeat-y</option>
                            <option value="no-repeat" <?php if($function_bg_repeat->cr_settingValue == "no-repeat") echo 'selected="selected"' ?>>No repeat</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Background Position</label>
                        <select class="form-control" name="backgroundposition">
                            <option value="">Select Background Position</option>
                            <option value="left top" <?php if($function_bg_position->cr_settingValue == "left top") echo 'selected="selected"' ?>>Left Top</option>
                            <option value="left center" <?php if($function_bg_position->cr_settingValue == "left center") echo 'selected="selected"' ?>>Left Center</option>
                            <option value="left bottom" <?php if($function_bg_position->cr_settingValue == "left bottom") echo 'selected="selected"' ?>>Left Bottom</option>
                            <option value="top center" <?php if($function_bg_position->cr_settingValue == "top center") echo 'selected="selected"' ?>>Top Center</option>
                            <option value="center center" <?php if($function_bg_position->cr_settingValue == "center center") echo 'selected="selected"' ?>>Center Center</option>
                            <option value="bottom center" <?php if($function_bg_position->cr_settingValue == "bottom center") echo 'selected="selected"' ?>>Bottom Center</option>
                            <option value="right top" <?php if($function_bg_position->cr_settingValue == "right top") echo 'selected="selected"' ?>>Right Top</option>
                            <option value="right center" <?php if($function_bg_position->cr_settingValue == "right center") echo 'selected="selected"' ?>>Right Center</option>
                            <option value="right bottom" <?php if($function_bg_position->cr_settingValue == "right bottom") echo 'selected="selected"' ?>>Right Bottom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Background Attachment</label>
                        <select class="form-control" name="backgroundattachment">
                            <option value="">Select Background Attachment</option>
                            <option value="scroll" <?php if($function_bg_attachment->cr_settingValue == "scroll") echo 'selected="selected"' ?>>Scroll</option>
                            <option value="fixed" <?php if($function_bg_attachment->cr_settingValue == "fixed") echo 'selected="selected"' ?>>Fixed</option>
                            <option value="none" <?php if($function_bg_attachment->cr_settingValue == "none") echo 'selected="selected"' ?>>None</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Background Size</label>
                        <select class="form-control" name="backgroundsize">
                            <option value="">Select Background Size</option>
                            <option value="auto" <?php if($function_bg_size->cr_settingValue == "auto") echo 'selected="selected"' ?>>Auto</option>
                            <option value="cover" <?php if($function_bg_size->cr_settingValue == "cover") echo 'selected="selected"' ?>>Cover</option>
                            <option value="50%" <?php if($function_bg_size->cr_settingValue == "50%") echo 'selected="selected"' ?>>50%</option>
                            <option value="100%" <?php if($function_bg_size->cr_settingValue == "100%") echo 'selected="selected"' ?>>100%</option>
                            <option value="200%" <?php if($function_bg_size->cr_settingValue == "200%") echo 'selected="selected"' ?>>200%</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-background-option" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link href="<?php echo MADMINURL ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet" />
<link href="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.css" rel="stylesheet" />
<script src="<?php echo MADMINURL ?>assets/plugins/dropzone/dropzone.js"></script>
<script src="<?php echo MADMINURL ?>assets/plugins/nailthumb/jquery.nailthumb.1.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
        $('#modal-apply-theme').on('show.bs.modal', function(e) {
            $(this).find('input[name=theme_folder]').attr('value', $(e.relatedTarget).data('folder'));
            $(this).find('input[name=theme_name]').attr('value', $(e.relatedTarget).data('dn'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });

        $('#browse-media-dialog').on('show.bs.modal', function(e) {
            var thumbnail_width = $('.modal-square-thumb').width();
            $('.modal-square-thumb').css({'height':thumbnail_width+'px'});
            $('.nailthumb-container').nailthumb();
        });
        Dropzone.options.logindropzone = {
          maxFilesize: 5, // MB
          maxFiles: 1,
          acceptedFiles: "image/*",
          success: function( file, response ){
            if(response != false) {
                $('#browse-media-button').attr('disabled','disabled');
                $('#used-image-container').slideUp(1000);
                var setting      = 'Background Image';
                var setting_idh  = '<?php echo $function_bg_template->cr_settingID ?>';
                var dataString   = 'value='+response+'&settingname='+setting+'&settingIDh='+setting_idh;
                $.ajax({
                    type: "POST",
                    url:  "<?php echo MADMINURL ?>ajax/settings-update.php",
                    data: dataString,
                    cache: false,
                    success: function(msg){
                        var message = msg.split('!')[0];
                        var setting_name = msg.split('!')[1];
                        if(message == 'false') {
                            $.gritter.add({
                                title:"Failed! Something error with media file",
                                text:"Can't select media. Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                        else if(message == 'true') {
                            $.gritter.add({
                                title:"Success!",
                                text:setting_name + " has been updated.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                            setTimeout(function() {
                                window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                            }, 2000);
                        }
                        else {
                            $.gritter.add({
                                title:"Error! Can't update setting",
                                text:"Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    }
                });
            }
            else {
                $('#modal-alert').modal('show');
            }
          }
        };
        var selected_media_title = $('input[name=mediaselect]:checked').attr('data-title');
        var selected_media_desc  = $('input[name=mediaselect]:checked').data('desc');
        $('#media-title-info').html(selected_media_title);
        $('#media-desc-info').html(selected_media_desc);
        $('input[name=mediaselect]').click(function() {
            var selected_media_title = $(this).data('title');
            var selected_media_desc  = $(this).data('desc');
            $('#media-title-info').html(selected_media_title);
            $('#media-desc-info').html(selected_media_desc);
        })
        $("#button-media-select").click(function(){
            var media = $('input[name=mediaselect]:checked').val();
            $("#button-media-select").attr('disabled','disabled');
            $("#button-media-select").html('<i class="fa fa-spinner fa-pulse"></i>');
            setTimeout(function() {
                $('#browse-media-dialog').modal('hide');
                $("#button-media-select").removeAttr('disabled');
                $("#button-media-select").html('Select');
            }, 2000);
            $('#used-image-container').html('<img style="width: 100%" class="" src="<?php echo MURL."cr-editor/images/" ?>'+media+'">');
            //$('#mediafile').attr('value', media);
            var setting      = 'Background Image';
            var setting_idh  = '<?php echo $function_bg_template->cr_settingID ?>';
            var dataString   = 'value='+media+'&settingname='+setting+'&settingIDh='+setting_idh;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/settings-update.php",
                data: dataString,
                cache: false,
                success: function(msg){
                    var message = msg.split('!')[0];
                    var setting_name = msg.split('!')[1];
                    if(message == 'false') {
                        $.gritter.add({
                            title:"Failed! Something error with media file",
                            text:"Can't select media. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(message == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:setting_name + " has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else {
                        $.gritter.add({
                            title:"Error! Can't update setting",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                }
            });
            return false;
        });

        var upload_theme;
        $("#form-upload-theme").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (upload_theme) {
                    upload_theme.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                var formData = new FormData($form[0]);
                upload_theme = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/themes-upload.php",
                    type: "post",
                    beforeSend: function(){ $("#button-upload-theme").html('<i class="fa fa-spinner fa-pulse"></i> Uploading...');},
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                });
                upload_theme.done(function (msg){
                    if(msg == 'notzip') {
                        $("#button-upload-theme").html('Upload');
                        $.gritter.add({
                            title:"Failed! Can't upload theme",
                            text:"Can't upload new theme. The file you are trying to upload is not a .zip file. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'failed') {
                        $("#button-upload-theme").html('Upload');
                        $.gritter.add({
                            title:"Failed! Can't upload theme",
                            text:"Can't upload new theme. There was a problem with the upload. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'empty') {
                        $("#button-upload-theme").html('Upload');
                        $.gritter.add({
                            title:"Failed! Can't upload theme",
                            text:"You have not uploaded a zip file. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'success'){
                        $.gritter.add({
                            title:"Success!",
                            text:"New theme has been uploaded.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else {
                        $("#button-upload-theme").html('Upload');
                        $.gritter.add({
                            title:"Error! Can't upload theme",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                upload_theme.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var apply_theme;
        $("#form-apply-theme").submit(function(event){
            if (apply_theme) {
                apply_theme.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var theme_name = $('#modal-apply-theme').find("#dn").html();
            var serializedData = $form.serialize();
            apply_theme = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/themes-apply.php",
                type: "post",
                beforeSend: function(){ $("#button-apply-theme").html('<i class="fa fa-spinner fa-pulse"></i> Changing Theme...');$("#button-apply-theme").attr('disabled','disabled')},
                data: serializedData,
                cache: false
            });
            apply_theme.done(function (msg){
                if(msg == 'false') {
                    $("#button-apply-theme").removeAttr('disabled');
                    $("#button-apply-theme").html('Upload');
                    $.gritter.add({
                        title:"Failed! Can't apply theme",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Theme has been change to "+theme_name+".",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else {
                    $("#button-apply-theme").removeAttr('disabled');
                    $("#button-apply-theme").html('Upload');
                    $.gritter.add({
                        title:"Error! Can't apply theme",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            apply_theme.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        $.gritter.add({
            title:"Creatify Tips",
            text:"Creatify contains responsive premium theme and very suitable for creative website.",
            image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
            sticky:true,
            time:""
        });

        $('.button-layout').click(function() {
            var id          = '#'+$(this).attr("id");
            var layoutmode  = $(this).attr("data-layout");
            var dataString  = 'settingvalue='+layoutmode;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/themes-layout-update.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $(id).html('<i class="fa fa-spinner fa-pulse"></i>');$(id).attr('disabled','disabled');},
                success: function(message){
                    if(message == 'empty-setting') {
                        $(id).removeAttr('disabled');
                        $(id).html('<i class="fa fa-arrow-left"></i> Wide <i class="fa fa-arrow-right"></i>');
                        $.gritter.add({
                            title:"Failed! No setting selected",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(message == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Layout has been changed to "+layoutmode+'.',
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(message == 'false') {
                        $(id).removeAttr('disabled');
                        $(id).html('<i class="fa fa-arrow-left"></i> Wide <i class="fa fa-arrow-right"></i>');
                        $.gritter.add({
                            title:"Failed! Can't change layout to "+layoutmode,
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(id).removeAttr('disabled');
                        $(id).html('<i class="fa fa-arrow-left"></i> Wide <i class="fa fa-arrow-right"></i>');
                        $.gritter.add({
                            title:"Error! Can't change layout to "+layoutmode,
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                }
            });
            return false;
        });

        var background_option;
        $("#form-background-option").submit(function(event){
            if (background_option) {
                background_option.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            background_option = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-background-option.php",
                type: "post",
                beforeSend: function(){ $("#button-background-option").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-background-option").attr('disabled','disabled');},
                data: serializedData
            });
            background_option.done(function (msg){
                var message = msg.split('!')[0];
                var setting_name = msg.split('!')[1];
                if(message == 'true') {
                    $.gritter.add({
                        title:"Success!",
                        text:setting_name + " has been updated.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(message == 'false') {
                    $("#button-background-option").removeAttr('disabled');
                    $("#button-background-option").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Failed! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-background-option").removeAttr('disabled');
                    $("#button-background-option").html('<i class="fa fa-check"></i> Save');
                    $.gritter.add({
                        title:"Error! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            background_option.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        $('#button-remove-background').click(function() {
            var value        = '';
            var setting      = 'Background Image';
            var setting_idh  = '<?php echo $function_bg_template->cr_settingID ?>';
            var dataString   = 'value='+value+'&settingname='+setting+'&settingIDh='+setting_idh;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/settings-update.php",
                data: dataString,
                cache: false,
                beforeSend: function(){ $('#button-remove-background').html('<i class="fa fa-spinner fa-pulse"></i>');$('#button-remove-background').attr('disabled','disabled');},
                success: function(msg){
                    var message = msg.split('!')[0];
                    var setting_name = msg.split('!')[1];
                    if(message == 'false') {
                        $('#button-remove-background').removeAttr('disabled');
                        $('#button-remove-background').html('Remove');
                        $.gritter.add({
                            title:"Failed! Something error when removing background image",
                            text:"Can't remove background image. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(message == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Background image has been removed.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else {
                        $('#button-remove-background').removeAttr('disabled');
                        $('#button-remove-background').html('Remove');
                        $.gritter.add({
                            title:"Error! Can't update setting",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                }
            });
            return false;
        });

        $('#modal-update-themes').on('show.bs.modal', function(e) {
            $(this).find('#update-information').html('Click Check button to check if update available.');
            $(this).find('#update-theme-btn').attr('disabled','disable');
            $(this).find('#check-update-btn').attr('data-foldertheme', $(e.relatedTarget).data('folder'));
            $(this).find('#check-update-btn').attr('data-versiontheme', $(e.relatedTarget).data('version'));
            $(this).find('#check-update-btn').attr('data-tfldr', $(e.relatedTarget).data('targetfolder'));
            $(this).find('#update-theme-btn').attr('data-tfldr', $(e.relatedTarget).data('targetfolder'));
            $(this).find('#theme-update-name').html($(e.relatedTarget).data('themename'));
        });

        $('#check-update-btn').click(function() {
            var themefolder  = $("#check-update-btn").attr("data-foldertheme");
            var themevers    = $("#check-update-btn").attr("data-versiontheme");
            var targetfolder = $("#check-update-btn").attr("data-tfldr");
            var dataString   = 'themefolder='+themefolder+'&themevers='+themevers+'&targetfolder='+targetfolder;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/themes-check-update.php",
                data: dataString,
                cache: false,
                    beforeSend: function(){ $("#check-update-btn").html('<i class="fa fa-spinner fa-pulse"></i> Checking for Update...');},
                    success: function(data){
                        if(data == "available") {
                            $("#check-update-btn").html('Check');
                            $("#update-theme-btn").removeAttr('disabled');
                            $("#update-information").html('Update is available. Click Update button to update theme.');
                        }
                        else if(data == "unavailable") {
                            $("#check-update-btn").html('Check');
                            $("#update-information").html('No update available.');
                        }
                        else {
                            $("#check-update-btn").html('Check');
                            $.gritter.add({
                                title:"Error! Can't check for update",
                                text:"Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    }
            });
            return false;
        });

        $('#update-theme-btn').click(function() {
            var themefolder  = $("#check-update-btn").attr("data-foldertheme");
            var targetfolder = $("#update-theme-btn").attr("data-tfldr");
            var dataString   = 'themefolder='+themefolder+'&targetfolder='+targetfolder;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/themes-update.php",
                data: dataString,
                cache: false,
                    beforeSend: function(){ $("#update-theme-btn").html('<i class="fa fa-spinner fa-pulse"></i> Updating Theme...');},
                    success: function(data){
                        if(data == "success") {
                            $("#update-theme-btn").html('Update');
                            $("#update-theme-btn").attr('disabled','disable');
                            $("#update-information").html("Success update theme. Refreshing this page...");
                            setTimeout(function() {
                                window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                            }, 2000);
                        }
                        else if(data == 'failed') {
                            $("#update-theme-btn").html('Update');
                            $("#update-information").html("Can't update theme. Please try again.");
                        }
                        else {
                            $("#update-theme-btn").html('Update');
                            $.gritter.add({
                                title:"Error! Can't update theme",
                                text:"Please try again.",
                                image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                sticky:false,
                                time:""
                            });
                        }
                    }
            });
            return false;
        });
	});	
</script>