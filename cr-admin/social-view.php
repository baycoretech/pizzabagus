<?php
    $class_social = new Social($pdo);
    $function_view_social  = $class_social->view_social();
    $view_instafeed_userid = $class_social->view_instafeed_user_id();
    $view_instafeed_accesstoken = $class_social->view_instafeed_access_token();
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
                <h4 class="panel-title">Social Ordering</h4>
            </div>
            <div class="panel-toolbar">
                <button class="btn btn-success m-b-5 m-r-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-action', array('section' => 'social', 'action' => 'edit')) ?>'"><i class="fa fa-pencil"></i> Edit Social</button>
                <a href="javascript:void(0);" type="button" class="btn btn-warning m-b-5 m-r-5 reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder</a>
                <button class="btn btn-danger m-b-5 m-r-5" data-target="#modal-remove-social" data-toggle="modal"><i class="fa fa-times"></i> Remove Social Link</button>
                <button class="btn btn-brown m-b-5" data-target="#modal-edit-instafeed" data-toggle="modal" data-uid="<?php echo $view_instafeed_userid->cr_settingValue ?>" data-at="<?php echo $view_instafeed_accesstoken->cr_settingValue ?>"><i class="fa fa-instagram"></i> Instagram Feeds</button>
            </div>
            <div class="panel-body">
            <?php
                if($function_view_social == false) {
    	    ?>
    		      <div class="alert alert-info fade in m-b-15">
    				<strong>Empty!</strong>
    				No social media data found.
    				<span class="close" data-dismiss="alert">×</span>
    			</div>
    		<?php
    		    }
    		    else {
    		?>
    		    <div class="gallery-reorder">
    		        <div id="reorder-helper" style="display:none;">
    		            <div class="alert alert-info fade in m-b-15">
    		                1. Drag social networks to reorder.<br>2. Click 'Save Reordering' when finished.
    		            </div>
    		        </div>
                    <div class="row">
        		        <ul class="reorder_ul reorder-social-list">
        		        <?php
                            $i = 1;
        	                foreach ($function_view_social as $social) {
        	            ?>
        		            <li id="image_li_<?php echo $social->cr_socialID; ?>" class="ui-sortable-handle col-xs-6 col-md-1">
        		                <a tabindex="0" role="button" data-trigger="hover focus" href="javascript:void(0);" style="float:none;" class="image_link" data-toggle="popover" data-container="body" title="<?php if($social->cr_socialName=="google-plus") echo "Google Plus"; else echo ucwords($social->cr_socialName); ?>" data-placement="bottom" data-content="<?php if($social->cr_socialLink == NULL || empty($social->cr_socialLink)) echo "None"; else echo $social->cr_socialLink; ?>">
        		                        <img src="<?php echo MADMINURL.$social->cr_socialImage; ?>">
        		                </a>
        		            </li>
        		        <?php
                                $i++;
        		            }
        		        ?>
        		        </ul>
                    </div>
    		    </div>
        	<?php
        	    }
        	?>
            </div>
        </div>
	</div>

    <?php
        if((empty($view_instafeed_accesstoken->cr_settingValue) || $view_instafeed_accesstoken->cr_settingValue == "") && (empty($view_instafeed_userid->cr_settingValue) || $view_instafeed_userid->cr_settingValue == "")) {
            echo "";
        }
        else {
    ?>
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Instagram Feeds</h4>
            </div>
            <div class="panel-body">
                <div id="instafeed" class="row"></div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<div class="modal fade" id="modal-edit-instafeed" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Instafeed User ID and Access Token</h4>
      </div>
        <div class="modal-body">
            <div class="note note-info m-b-15">
                If you don't know your Instagram user ID and access token, click <a href="http://www.otzberg.net/iguserid/" target="_blank">here</a> to get your Instagram User ID, and <a href="http://instagram.pixelunion.net/" target="_blank">here</a> to get your access token.
            </div>
            <form id="form-edit-instafeed" data-parsley-validate action="" method="POST">
                <div class="form-group has-feedback">
                    <label class="control-label">Instagram User ID</label>
                    <input class="form-control" placeholder="Instagram User ID" type="text" name="userid" value="">
                    <span class="fa fa-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label">Instagram Access Token</label>
                    <input class="form-control" placeholder="Instagram Access Token" type="text" name="accesstoken" value="">
                    <span class="fa fa-key form-control-feedback"></span>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-edit-instafeed" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-remove-social">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to remove link(s) in social media?</p>
                <form id="form-remove-social" data-parsley-validate action="" method="post">
                	<input type="hidden" name="empty" value="Empty">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-remove-social" type="submit" class="btn btn-danger">Remove</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $.gritter.add({
            title:"Creatify Tips",
            text:"Social media give some benefits and opportunities for your website.",
            image:"<?php echo MADMINURL.'/assets/img/cr.png'; ?>",
            sticky:true,
            time:""
        });

        $('#modal-edit-instafeed').on('show.bs.modal', function(e) {
            $(this).find('input[name=userid]').attr('value', $(e.relatedTarget).data('uid'));
            $(this).find('input[name=accesstoken]').attr('value', $(e.relatedTarget).data('at'));
        });

        $('.reorder_link').on('click',function(){
            $("ul.reorder-social-list").sortable({ tolerance: 'pointer' });
            $('.reorder_link').html('Save Reordering');
            $('.reorder_link').attr("id","save_reorder");
            $('#reorder-helper').slideDown('slow');
            $('.image_link').attr("href","javascript:void(0);");
            $('.image_link').css("cursor","move");
            $("#save_reorder").click(function( e ){
                if( !$("#save_reorder i").length )
                {
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-social-list").sortable('destroy');
                    $("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Socials</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
        
                    var h = [];
                    $("ul.reorder-social-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo MADMINURL ?>ajax/social-reorder.php",
                        data: {ids: " " + h + ""},
                        success: function(html) {
                            window.location.reload();
                        }
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });

        var remove_social_link;
        $("#form-remove-social").submit(function(event){
            if (remove_social_link) {
                remove_social_link.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            remove_social_link = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/social-remove-link.php",
                type: "post",
                beforeSend: function(){ $("#button-remove-social").html('<i class="fa fa-spinner fa-pulse"></i> Removing...');$("#button-remove-social").attr('disabled','disabled');},
                data: serializedData
            });
            remove_social_link.done(function (msg){
                if(msg == 'remove-empty') {
                    $("#button-remove-social").removeAttr('disabled');
                    $("#button-remove-social").html('Remove');
                    $.gritter.add({
                        title:"Failed! Social is required",
                        text:"Can't remove social link(s). Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Social link(s) has been removed",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-remove-social').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => 'social')) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-remove-social").removeAttr('disabled');
                    $("#button-remove-social").html('Remove');
                    $.gritter.add({
                        title:"Failed! Can't remove social link(s)",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-remove-social").removeAttr('disabled');
                    $("#button-remove-social").html('Remove');
                    $.gritter.add({
                        title:"Error! Can't remove social link(s)",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            remove_social_link.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        var edit_instafeed;
        $("#form-edit-instafeed").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_instafeed) {
                    edit_instafeed.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_instafeed = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/instafeed-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-instafeed").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-instafeed").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_instafeed.done(function (msg){
                    if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Instafeed setting has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-edit-instafeed").removeAttr('disabled');
                        $("#button-edit-instafeed").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't update instafeed setting",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-edit-instafeed").removeAttr('disabled');
                        $("#button-edit-instafeed").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't update instafeed setting",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_instafeed.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        <?php
            if((empty($view_instafeed_accesstoken->cr_settingValue) || $view_instafeed_accesstoken->cr_settingValue == "") && (empty($view_instafeed_userid->cr_settingValue) || $view_instafeed_userid->cr_settingValue == "")) {
                echo "";
            }
            else {
        ?>
        var feed = new Instafeed({
            get: 'user',
            userId: <?php echo $view_instafeed_userid->cr_settingValue ?>,
            accessToken: '<?php echo $view_instafeed_accesstoken->cr_settingValue ?>',
            limit: 12,
            template: '<div class="col-sm-6 col-md-2 instawrapperfeeds"><a class="" href="{{link}}"><img src="{{image}}" /></a></div>',
            resolution: 'standard_resolution'
        });
        feed.run();
        <?php } ?>
    });
</script>