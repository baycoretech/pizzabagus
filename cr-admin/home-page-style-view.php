<?php
    $function_homepage_style = $class_settings->view_settings_homepage_style();
    $explode_style = explode(',', $function_homepage_style->cr_settingValue);
    $first_layer  = $explode_style[0];
    $second_layer = $explode_style[1];
    $third_layer  = $explode_style[2];
    $others_layer = $explode_style[3];
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Home Page Style Wizards</h4>
            </div>
            <div class="panel-body">
                <form id="form-homepage-style" action="" method="POST" data-parsley-validate name="form-wizard">
                    <input type="hidden" name="settingIDh" value="<?php echo $function_homepage_style->cr_settingID ?>">
                    <input type="hidden" name="settingname" value="Home Page Style">
                    <div id="wizard">
                        <ol>
                            <li>
                                Layer 1 
                                <small>First layer of your home page website.</small>
                            </li>
                            <li>
                                Layer 2
                                <small>Second layer of your home page website.</small>
                             </li>
                            <li>
                                Layer 3 and Others
                                <small>Third layer and others of your home page website.</small>
                            </li>
                            <li>
                                Confirmation
                                <small>Confirmation for home page style wizards.</small>
                            </li>
                        </ol>
                        <!-- begin wizard step-1 -->
                        <div class="wizard-step-1">
                            <fieldset>
                                <legend class="pull-left width-full">Layer 1</legend>
                                <div class="row">
                                    <div class="col-md-6">   
                                        <label class="rwi">
                                            <input type="radio" name="layer1" value="image-slider" data-parsley-group="wizard-layer-1" <?php if($first_layer=="image-slider") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-layer1-image-slider.png" ?>">
                                            Image Slider
                                        </label>
                                    </div>
                                    <div class="col-md-6">   
                                        <label class="rwi">
                                            <input type="radio" name="layer1" value="static-image" data-parsley-group="wizard-layer-1" <?php if($first_layer=="static-image") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-layer1-static-image.png"?>">
                                            Static Image
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p>
                                        <button id="uncheck-layer1" type="button" class="btn btn-white btn-sm m-l-15" role="button"><span class="fa-stack"><i class="fa fa-check fa-stack-1x"></i><i class="fa fa-ban fa-stack-2x text-danger"></i></span> Unselect</button>
                                    </p>
                                </div>
                            </fieldset>
                        </div>
                        <!-- end wizard step-1 -->
                        <!-- begin wizard step-2 -->
                        <div class="wizard-step-2">
                            <fieldset>
                                <legend class="pull-left width-full">Layer 2</legend>
                                <div class="row">
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="services" data-parsley-group="wizard-layer-2" <?php if($second_layer=="services") echo "checked"; else echo "checked" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-services.png" ?>">
                                            Services
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="latest-portfolio" data-parsley-group="wizard-layer-2" <?php if($second_layer=="latest-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-portfolio.png"?>">
                                            Latest Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="selected-portfolio" data-parsley-group="wizard-layer-2" <?php if($second_layer=="selected-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-selected-portfolio.png"?>">
                                            Selected Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="showcase-portfolio" data-parsley-group="wizard-layer-2" <?php if($second_layer=="showcase-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-showcase-portfolio.png" ?>">
                                            Showcase Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="recent-post" data-parsley-group="wizard-layer-2" <?php if($second_layer=="recent-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-recent-post.png"?>">
                                            Recent Post
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="popular-post" data-parsley-group="wizard-layer-2" <?php if($second_layer=="popular-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-popular-post.png"?>">
                                            Popular Post
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p>
                                           <button id="uncheck-layer2" type="button" class="btn btn-white btn-sm m-l-15" role="button"><span class="fa-stack"><i class="fa fa-check fa-stack-1x"></i><i class="fa fa-ban fa-stack-2x text-danger"></i></span> Unselect</button>
                                    </p>
                                </div>
                            </fieldset>
                        </div>
                        <!-- end wizard step-2 -->
                        <!-- begin wizard step-3 -->
                        <div class="wizard-step-3">
                            <fieldset>
                                <legend class="pull-left width-full">Layer 3</legend>
                                    <!-- begin row -->
                                <div class="row">
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="services" <?php if($third_layer=="services") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-services.png" ?>">
                                            Services
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="latest-portfolio" <?php if($third_layer=="latest-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-portfolio.png"?>">
                                            Latest Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="selected-portfolio" data-parsley-group="wizard-layer-2" <?php if($third_layer=="selected-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-selected-portfolio.png"?>">
                                            Selected Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="showcase-portfolio" data-parsley-group="wizard-layer-2" <?php if($third_layer=="showcase-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-showcase-portfolio.png" ?>">
                                            Showcase Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="recent-post" data-parsley-group="wizard-layer-2" <?php if($third_layer=="recent-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-recent-post.png"?>">
                                            Recent Post
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="popular-post" data-parsley-group="wizard-layer-2" <?php if($third_layer=="popular-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-popular-post.png"?>">
                                            Popular Post
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <p>
                                        <button id="uncheck" type="button" class="btn btn-white btn-sm m-l-15" role="button"><span class="fa-stack"><i class="fa fa-check fa-stack-1x"></i><i class="fa fa-ban fa-stack-2x text-danger"></i></span> Unselect</button>
                                    </p>
                                </div>
                                <legend class="pull-left width-full m-l-15 m-t-15">Others</legend>
                                <div class="row">
                                    <div class="col-md-3">   
                                        <label class="rwi">
                                            <input type="radio" name="others" value="quotes" <?php if($others_layer=="quotes") echo "checked"; else echo "" ?>>
                                               <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-quotes.png"?>">
                                            Quotes
                                        </label>
                                    </div>
                                    <div class="col-md-3">   
                                        <label class="rwi">
                                            <input type="radio" name="others" value="clients" <?php if($others_layer=="clients") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-clients.png" ?>">
                                            Clients or Partners
                                        </label>
                                    </div>
                                    <!--
                                    <div class="col-md-3">   
                                        <label class="rwi">
                                            <input type="radio" name="others" value="plainjumbotron" <?php if($others_layer=="plainjumbotron") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-plain-jumbotron.png"?>">
                                            Plain Jumbotron
                                        </label>
                                    </div>
                                    <div class="col-md-3">   
                                        <label class="rwi">
                                            <input type="radio" name="others" value="backgroundjumbotron" <?php if($others_layer=="backgroundjumbotron") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."assets/img/homepage-background-jumbotron.png"?>">
                                            Background Jumbotron
                                        </label>
                                    </div>
                                    -->
                                    <div class="clearfix"></div>
                                    <p>
                                        <button id="uncheck-others" type="button" class="btn btn-white btn-sm m-l-15" role="button"><span class="fa-stack"><i class="fa fa-check fa-stack-1x"></i><i class="fa fa-ban fa-stack-2x text-danger"></i></span> Unselect</button>
                                    </p>
                                </div>
                            </fieldset>
                        </div>
                         <!-- end wizard step-3 -->
                         <!-- begin wizard step-4 -->
                        <div>
                            <div class="jumbotron m-b-0 text-center">
                                <h1>Have you finished?</h1>
                                <p>Click Save Home Page Style button to save your homepage style, or click Previous button to go to previous steps . </p>
                                <p><button id="button-homepage-style" type="submit" class="btn btn-success btn-lg" role="button">Save Home Page Style</button></p>
                            </div>
                        </div>
                        <!-- end wizard step-4 -->
                    </div>
                </form>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $.gritter.add({
            title:"Creatify Tips",
            text:"Home page style is like a burger, consists of 3 layers and others. You can create a home page that is different from the others.",
            image:"<?php echo MADMINURL.'assets/img/cr.png'; ?>",
            sticky:true,
            time:""
        });

        $('#uncheck-layer1').click(function() {
            $('input[name=layer1]').removeAttr('checked');
        });
        $('#uncheck-layer2').click(function() {
            $('input[name=layer2]').removeAttr('checked');
        });
        $('#uncheck').click(function() {
            $('input[name=layer3]').removeAttr('checked');
        });
        $('#uncheck-others').click(function() {
            $('input[name=others]').removeAttr('checked');
        });

        var edit_settings;
        $("#form-homepage-style").submit(function(event){
            if (edit_settings) {
                edit_settings.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            edit_settings = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/settings-home-page-style.php",
                type: "post",
                beforeSend: function(){ $("#button-homepage-style").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-homepage-style").attr('disabled','disabled');},
                data: serializedData
            });
            edit_settings.done(function (msg){
                var message = msg.split('!')[0];
                var setting_name = msg.split('!')[1];
                if(message == 'empty-setting') {
                    $("#button-homepage-style").removeAttr('disabled');
                    $("#button-homepage-style").html('Save Homepage Style');
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
                    $("#button-homepage-style").removeAttr('disabled');
                    $("#button-homepage-style").html('Save Homepage Style');
                    $.gritter.add({
                        title:"Failed! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-homepage-style").removeAttr('disabled');
                    $("#button-homepage-style").html('Save Homepage Style');
                    $.gritter.add({
                        title:"Error! Can't update setting",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            edit_settings.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });
    });
</script>