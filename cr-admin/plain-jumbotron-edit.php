<?php
    $o_getJumbotron = new jumbotron($pdo);
    $v_getEditPLjumbotron = $o_getJumbotron->editPlainjumbotron();
?>
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Plain Jumbotron Information</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="formaddjumbotron" data-parsley-validate action="" method="POST">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Caption</label>
                            <input class="form-control" placeholder="Plain Jumbotron Caption" type="text" name="caption" value="<?php echo $v_getEditPLjumbotron->cr_jumbotronCaption ?>" data-parsley-minlength="2" data-parsley-maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="desc" class="form-control" rows="3" placeholder="Plain Jumbotron Description"  data-parsley-minlength="2" required><?php echo $v_getEditPLjumbotron->cr_jumbotronDesc ?></textarea>
                        </div>
                        <div class="form-group">
                            <div class="note note-info">
                                <p>
                                    Fill Button Text and Button Link fields if you want to add a button to plain jumbotron.          
                                </p>
                            </div>
                            <label class="control-label">Button Text</label>
                            <input class="form-control" placeholder="Plain Jumbotron Button Text" type="text" name="btext" value="<?php echo $v_getEditPLjumbotron->cr_jumbotronButtontext ?>" data-parsley-maxlength="50">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Button Link</label>
                            <input class="form-control" placeholder="Plain Jumbotron Button Link" type="text" name="blink" value="<?php echo $v_getEditPLjumbotron->cr_jumbotronButtonLink ?>" data-parsley-type="url" data-parsley-maxlength="255">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Text Position</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="textposition" value="left" <?php if($v_getEditPLjumbotron->cr_jumbotronTextposition=="left") echo "checked" ?>>
                                    Left
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="textposition" value="center" <?php if($v_getEditPLjumbotron->cr_jumbotronTextposition=="center") echo "checked" ?>>
                                    Center
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="textposition" value="right" <?php if($v_getEditPLjumbotron->cr_jumbotronTextposition=="right") echo "checked" ?>>
                                    Right
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="note note-info">
                                <p>
                                    Select what overlay effect do you want to add to jumbotron.
                                </p>
                            </div>
                            <label class="control-label">Overlay Effect</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="matchcs" value="light-bg" <?php if($v_getEditPLjumbotron->cr_jumbotronColorscheme=="light-bg") echo "checked" ?>>
                                    Light Background
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="matchcs" value="dark-bg" <?php if($v_getEditPLjumbotron->cr_jumbotronColorscheme=="dark-bg") echo "checked" ?>>
                                    Dark Background
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="matchcs" value="tint-bg" <?php if($v_getEditPLjumbotron->cr_jumbotronColorscheme=="tint-bg") echo "checked" ?>>
                                    Match with Color Scheme
                                </label>
                            </div>
                        </div>
                </div>
            <div class="panel-footer">
                <button id="submitaddjumbotron" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-warning m-r-5 m-b-5" onclick="location.href='<?php echo MADMINURL; ?>/plain-jumbotron ?>'"><i class="fa fa-reply"></i> Cancel</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>
</div>

<script>
        $(document).ready(function() {
            // Variable to hold request add jumbotron
            var requestaddjumbotron;
                        
            // Bind to the submit event of our form
            $("#formaddjumbotron").submit(function(event){
                        
                // Abort any pending requestaddjumbotron
                if (requestaddjumbotron) {
                    requestaddjumbotron.abort();
                }
                // setup some local variables
                var $form = $(this);
                        
                // Let's select and cache all the fields
                var $inputs = $form.find("input, button");
                
                // Serialize the data in the form
                var serializedData = $form.serialize();

                requestaddjumbotron = $.ajax({
                    url: "<?php echo MADMINURL ?>/plain-jumbotron-edit-ajax.php",
                    type: "post",
                    beforeSend: function(){ $("#submitaddjumbotron").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
                    data: serializedData
                });
                        
                // Callback handler that will be called on success
                requestaddjumbotron.done(function (msg){
                    if(msg=='caption-short') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Jumbotron caption is too short",
                            text:"Can't add new plain jumbotron. It should have 2 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='caption-long') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Jumbotron caption is too long",
                            text:"Can't add new plain jumbotron. It should have 100 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='desc-short') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Jumbotron description is too short",
                            text:"Can't add new plain jumbotron. It should have 2 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='btext-long') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Button text is too long",
                            text:"Can't add new plain jumbotron. It should have 50 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='blink-long') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Button link is too long",
                            text:"Can't add new plain jumbotron. It should have 255 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-tp') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not selected the text position",
                            text:"Can't add new plain jumbotron. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='no-cs') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You have not selected the overlay effect",
                            text:"Can't add new plain jumbotron. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='invalid-url') {
                        $("#submitaddjumbotron").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Invalid button URL link",
                            text:"Can't add new plain jumbotron. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"Plain jumbotron has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo MADMINURL ?>/plain-jumbotron";
                        }, 2000);
                    }
                });
                        
                // Callback handler that will be called regardless
                // if the requestaddjumbotron failed or succeeded
                requestaddjumbotron.always(function () {
                    // Reenable the inputs
                    $inputs.prop("disabled", false);
                });
                        
                // Prevent default posting of form
                event.preventDefault();
            });
        });
    
</script>