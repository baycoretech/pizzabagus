<?php
    $o_getSettings  = new settings($pdo);
    $v_getSettingsHomePage = $o_getSettings->viewSettingsHomepage();
    $exviewHomePage = explode(',', $v_getSettingsHomePage->cr_settingValue);
    $firstLayer  = $exviewHomePage[0];
    $secondLayer = $exviewHomePage[1];
    $thirdLayer  = $exviewHomePage[2];
    $otherslayer = $exviewHomePage[3];
    //disabled feature
    $v_getGF     = $o_getGF->folderName();
    if($v_getGF=="0") {
        $targetFolder = $_SERVER['DOCUMENT_ROOT']."/cr-content/themes/";
    }
    else {
        $targetFolder = $_SERVER['DOCUMENT_ROOT']."/".$v_getGF."/cr-content/themes/";
    }
    $v_getThemes   = $o_getSettings->viewSettingsUsedTheme();
    $v_getUThemes  = $v_getThemes->cr_settingValue;
    $getdetailtxt  = file($targetFolder.$v_getUThemes.'/detail.txt');
    $themeOption   = $getdetailtxt[4]; 
    $tOptarr       = explode(',', $themeOption);
?>
<div class="row">
    <?php
        if(in_array("homepagestyles", $tOptarr)===true) {
    ?>
    <div class="col-md-12">
        <div class="note note-info">
            <h4>Homepage Styles is Not Available</h4>
            <p>Your theme is not support homepage style. However, other themes that support this feature could remain use it.</p>
        </div>
    </div>
    <?php
        }
    ?>
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Homepage Style Wizards</h4>
            </div>
            <div class="panel-body">
                <?php
                        if (isset ($_POST['save'])) {
                            $layer1       = $_POST['layer1'];
                            $layer2       = $_POST['layer2'];
                            $layer3       = $_POST['layer3'];
                            $others       = $_POST['others'];
                            $adminLoginID = $_POST['adminLoginID'];
                            if(empty($layer1)) {
                                $layer1 = "NULL";
                            }
                            if(empty($layer2)) {
                                $layer2 = "NULL";
                            }
                            if(empty($layer3)) {
                                $layer3 = "NULL";
                            }
                            if(empty($others)) {
                                $others = "NULL";
                            }
                            $arr = array($layer1,$layer2,$layer3,$others);
                            $value   = implode(",", $arr); 
                            if(empty($adminLoginID)){
                                header("Location: $madinurl/homepage");             
                            }
                            else {
                                $v_getUpdateHomepage = $o_getSettings->updateSettingsHomepage($value, $adminLoginID);
                                header("Location: $madinurl/homepage");       
                            } 
                        }
                ?>
                <form action="" method="POST" data-parsley-validate="true" name="form-wizard">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                    <div id="wizard">
                        <ol>
                            <li>
                                Layer 1 
                                <small>First layer of your homepage website.</small>
                            </li>
                            <li>
                                Layer 2
                                <small>Second layer of your homepage website.</small>
                             </li>
                            <li>
                                Layer 3 and Others
                                <small>Third layer and others of your homepage website.</small>
                            </li>
                            <li>
                                Confirmation
                                <small>Confirmation for homepage style wizards.</small>
                            </li>
                        </ol>
                        <!-- begin wizard step-1 -->
                        <div class="wizard-step-1">
                            <fieldset>
                                <legend class="pull-left width-full">Layer 1</legend>
                                <div class="row">
                                    <div class="col-md-6">   
                                        <label class="rwi">
                                            <input type="radio" name="layer1" value="image-slider" data-parsley-group="wizard-layer-1" <?php if($firstLayer=="image-slider") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-layer1-image-slider.png" ?>">
                                            Image Slider
                                        </label>
                                    </div>
                                    <div class="col-md-6">   
                                        <label class="rwi">
                                            <input type="radio" name="layer1" value="static-image" data-parsley-group="wizard-layer-1" <?php if($firstLayer=="static-image") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-layer1-static-image.png"?>">
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
                                            <input type="radio" name="layer2" value="services" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="services") echo "checked"; else echo "checked" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-services.png" ?>">
                                            Services
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="latest-portfolio" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="latest-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-portfolio.png"?>">
                                            Latest Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="selected-portfolio" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="selected-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-selected-portfolio.png"?>">
                                            Selected Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="showcase-portfolio" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="showcase-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-showcase-portfolio.png" ?>">
                                            Showcase Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="recent-post" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="recent-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-recent-post.png"?>">
                                            Recent Post
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="popular-post" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="popular-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-popular-post.png"?>">
                                            Popular Post
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="products" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="products") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-products.png"?>">
                                            Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="featured-product-categories" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="featured-product-categories") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-featured-product-categories.png"?>">
                                            Featured Product Categories
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer2" value="banner" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="banner") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-banner.png"?>">
                                            Banner
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
                                            <input type="radio" name="layer3" value="services" <?php if($thirdLayer=="services") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-services.png" ?>">
                                            Services
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="latest-portfolio" <?php if($thirdLayer=="latest-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-portfolio.png"?>">
                                            Latest Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="selected-portfolio" data-parsley-group="wizard-layer-2" <?php if($thirdLayer=="selected-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-selected-portfolio.png"?>">
                                            Selected Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="showcase-portfolio" data-parsley-group="wizard-layer-2" <?php if($thirdLayer=="showcase-portfolio") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-showcase-portfolio.png" ?>">
                                            Showcase Portfolios or Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="recent-post" data-parsley-group="wizard-layer-2" <?php if($thirdLayer=="recent-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-recent-post.png"?>">
                                            Recent Post
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="popular-post" data-parsley-group="wizard-layer-2" <?php if($thirdLayer=="popular-post") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-popular-post.png"?>">
                                            Popular Post
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="products" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="products") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-products.png"?>">
                                            Products
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="featured-product-categories" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="featured-product-categories") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-featured-product-categories.png"?>">
                                            Featured Product Categories
                                        </label>
                                    </div>
                                    <div class="col-md-4">   
                                        <label class="rwi">
                                            <input type="radio" name="layer3" value="banner" data-parsley-group="wizard-layer-2" <?php if($secondLayer=="banner") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-banner.png"?>">
                                            Banner
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
                                            <input type="radio" name="others" value="quotes" <?php if($otherslayer=="quotes") echo "checked"; else echo "" ?>>
                                               <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-quotes.png"?>">
                                            Quotes
                                        </label>
                                    </div>
                                    <div class="col-md-3">   
                                        <label class="rwi">
                                            <input type="radio" name="others" value="clients" <?php if($otherslayer=="clients") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-clients.png" ?>">
                                            Clients or Partners
                                        </label>
                                    </div>
                                    <div class="col-md-3">   
                                        <label class="rwi">
                                            <input type="radio" name="others" value="plainjumbotron" <?php if($otherslayer=="plainjumbotron") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-plain-jumbotron.png"?>">
                                            Plain Jumbotron
                                        </label>
                                    </div>
                                    <div class="col-md-3">   
                                        <label class="rwi">
                                            <input type="radio" name="others" value="backgroundjumbotron" <?php if($otherslayer=="backgroundjumbotron") echo "checked"; else echo "" ?>>
                                            <img style="width:100%" src="<?php echo MADMINURL."/assets/img/homepage-background-jumbotron.png"?>">
                                            Background Jumbotron
                                        </label>
                                    </div>
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
                                <p>Click Save My Homepage button to save your homepage style, or click Previous button to go to previous steps . </p>
                                <p><button type="submit" name="save" class="btn btn-success btn-lg" role="button">Save My Homepage</button></p>
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
            text:"Homepage style is like a burger, consists of 3 layers and others. You can create a homepage that is different from the others.",
            image:"<?php echo MADMINURL.'/assets/img/cr.png'; ?>",
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
    });
</script>