<?php
    $function_view_menu = $class_menu->view_menu();
    $function_view_menu_for_parent = $class_menu->view_menu_for_parent();
    $function_view_page_template   = $class_menu->view_page_template();
    $v_get_total_page = $class_menu->count_total_page();
?>
<style type="text/css">
    .caption-style-3 {
        list-style-type: none;
        margin: 0px;
        padding: 0px;
        
    }
    .caption-style-3 li {
        float: left;
        position: relative;
        margin-bottom: 15px;
    }
    .caption-style-3 label.rwi {
        display: block;
    }
    .caption-style-3 li:hover .caption {
        opacity: 1;
        transform: translateY(-100px);
        -webkit-transform:translateY(-100px);
        -moz-transform:translateY(-100px);
        -ms-transform:translateY(-100px);
        -o-transform:translateY(-100px);
        visibility: visible;
    }
    .caption-style-3 li:hover .cover-dark {
        opacity: 1;
    }
    .caption-style-3 li:hover img {
        opacity: 1;
    }
    .caption-style-3 img {
        margin: 0px;
        padding: 0px;
        float: left;
        z-index: 4;
    }
    .caption-style-3 .caption {
        cursor: pointer;
        position: absolute;
        opacity: 0;
        visibility: hidden;
        top:100%;
        z-index: 5;
        -webkit-transition:all 0.15s ease-in-out;
        -moz-transition:all 0.15s ease-in-out;
        -o-transition:all 0.15s ease-in-out;
        -ms-transition:all 0.15s ease-in-out;
        transition:all 0.15s ease-in-out;

    }
    .caption-style-3 img {
        -webkit-transition:all 0.15s ease-in-out;
        -moz-transition:all 0.15s ease-in-out;
        -o-transition:all 0.15s ease-in-out;
        -ms-transition:all 0.15s ease-in-out;
        transition:all 0.15s ease-in-out;
    }
    .caption-style-3 .blur {
        background-color: rgba(0, 188, 212,0.95);
        height: 95px;
        z-index: 5;
        position: absolute;
    }
    .caption-style-3 .cover-dark {
        background-color: rgba(0, 0, 0,0.4);
        z-index: 3;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 5px;
        right: 0;
        margin: 0px;
        padding: 0px;
        transform: translateX(15px);
        -webkit-transform:translateX(15px);
        -moz-transform:translateX(15px);
        -ms-transform:translateX(15px);
        -o-transform:translateX(15px);
        -webkit-transition:all 0.15s ease-in-out;
        -moz-transition:all 0.15s ease-in-out;
        -o-transition:all 0.15s ease-in-out;
        -ms-transition:all 0.15s ease-in-out;
        transition:all 0.15s ease-in-out;
        opacity: 0;
    }
    .caption-style-3 .caption-text h1 {
        text-transform: uppercase;
        font-size: 18px;
        color: #ffffff;
    }
    .caption-style-3 .caption-text {
        z-index: 10;
        color: #fff;
        position: absolute;
        height: 95px;
        text-align: center;
        padding: 5px 8px;
        top:5px;
    }
</style>
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
                <h4 class="panel-title">Menu Information and Template</h4>
            </div>
                <div id="" class="panel-body">
                    <form id="form-add-menu" data-parsley-validate action="" method="POST">
                        <!-- Nav language tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_en" aria-controls="tab_en" role="tab" data-toggle="tab">English</a></li>
                            <li role="presentation"><a href="#tab_id" aria-controls="tab_id" role="tab" data-toggle="tab">Indonesian</a></li>
                        </ul>

                        <!-- Tab language panes -->
                        <div class="tab-content m-b-0">
                            <div role="tabpanel" class="tab-pane fade in active" id="tab_en">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input class="form-control" placeholder="Menu Title" type="text" name="title" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_id">
                                <div class="form-group">
                                    <label class="control-label">Title</label>
                                    <input class="form-control" placeholder="Menu Title" type="text" name="title_id" data-parsley-minlength="4" data-parsley-maxlength="25" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label">Parent</label>
                            <select class="form-control" name="parent">
                                <option value="">Select Menu Parent</option>
                                <?php
                                    foreach ($function_view_menu_for_parent as $parent) {
                                ?> 
                                <option value="<?php echo $parent->cr_menuID ?>"><?php echo $parent->cr_menuTitle ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="">Select Status</option>
                                <option value="1">Publish</option>
                                <option value="0">Unpublish</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p><label class="control-label">Page Template</label></p>
                            <div class="note note-info">
                                If you choose a parent menu, the page template will not affect.          
                            </div>
                            <div class="row">
                                <ul class="caption-style-3">
                                <?php
                                    foreach ($function_view_page_template as $template) {
                                ?> 
                                    <li class="col-xs-12 col-md-3 getwidth">
                                        <label class="rwi">
                                            <input class="<?php if($template->cr_pagetemplateType == 'portfolio') echo 'use-gallery'; else echo "unuse-gallery" ?> <?php if($template->cr_pagetemplateName == 'Two Columns') echo "use-contact"; else echo "unuse-contact"; ?>" type="radio" name="pagetemplate" value="<?php echo $template->cr_pagetemplateID ?>" <?php if($template->cr_pagetemplateID == '1') echo 'checked="checked"'; else echo "" ?>>
                                            <img src="<?php echo MADMINURL.$template->cr_pagetemplateImage ?>" alt="" width="100%">
                                                <div class="cover-dark applywidth"></div>

                                            <div class="caption">
                                                <div class="blur applywidth"></div>
                                                <div class="caption-text applywidth">
                                                    <h1><?php if($template->cr_pagetemplateType == 'general') echo 'GENERAL'; elseif($template->cr_pagetemplateType == 'portfolio') echo 'PORTFOLIO'; elseif($template->cr_pagetemplateType == 'blog') echo 'BLOG'; elseif($template->cr_pagetemplateType == 'menu') echo 'MENU'; ?></h1>
                                                    <p><?php echo $template->cr_pagetemplateName ?></p>
                                                </div>
                                            </div>
                                        </label>
                                    </li>
                                <?php
                                    }
                                ?>
                                </ul>

                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="note-gallery" class="note note-info">
                                    Check <strong>Set as Gallery</strong> if you want to make your portfolio page template used as gallery.          
                            </div>
                            <div id="use-gallery-form" class="checkbox m-l-15">
                                <label>
                                    <input type="checkbox" value="gallery" name="option">
                                    Set as Gallery
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div id="note-contact" class="note note-info">
                                Check <strong>Set as Contact Page</strong> if you want to make your page template used as contact page.          
                            </div>
                            <div id="use-contact-form" class="checkbox m-l-15">
                                <label>
                                    <input type="checkbox" value="contact" name="option">
                                    Set as Contact Page
                                </label>
                            </div>
                        </div>
                </div>
            <div class="panel-footer">
                <button id="button-add-menu" type="submit" class="btn btn-success m-r-5 m-b-5" name="save"><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-white button-cancel pull-right m-r-5 m-b-5" onclick="location.href='<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>'">Cancel</button>
                </form>
            </div>
         </div>
        <!-- end panel -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var set_height = setInterval(
            function () {
                var ert = $(".getwidth").outerHeight() - 5 +"px";
                $(".applywidth").css("width", ert);
            }, 500
        );

        $("#use-gallery-form").hide();
        $("#note-gallery").hide();

        $("#use-contact-form").hide();
        $("#note-contact").hide();

        $(".use-gallery").click(function(){
            if ($(".use-gallery").is(":checked")) {
                $('#note-gallery').addClass('animated flipInY');
                $("#note-gallery").show();
                $("#use-gallery-form").show();
            } else {
                $("#note-gallery").addClass('animated bounceOut');
                $("#note-gallery").hide();
                $("#use-gallery-form").hide();
            }
        });

        $(".unuse-gallery").click(function(){
            if ($(".use-gallery").is(":checked")) {
                $('#note-gallery').addClass('animated fadeInY');
                $("#note-gallery").show();
                $("#use-gallery-form").show();
            } else {
                $("#note-gallery").addClass('animated bounceOut');
                $("#note-gallery").hide();
                $("#use-gallery-form").hide();
            }
        });

        $(".use-contact").click(function(){
            if ($(".use-contact").is(":checked")) {
                $('#note-contact').addClass('animated flipInY');
                $("#note-contact").show();
                $("#use-contact-form").show();
            } else {
                $("#note-contact").addClass('animated bounceOut');
                $("#note-contact").hide();
                $("#use-contact-form").hide();
            }
        });

        $(".unuse-contact").click(function(){
            if ($(".use-contact").is(":checked")) {
                $('#note-contact').addClass('animated fadeInY');
                $("#note-contact").show();
                $("#use-contact-form").show();
            } else {
                $("#note-contact").addClass('animated bounceOut');
                $("#note-contact").hide();
                $("#use-contact-form").hide();
            }
        });

        var add_menu;
        $("#form-add-menu").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_menu) {
                    add_menu.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                add_menu = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/menu-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-menu").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-menu").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_menu.done(function (msg){
                    if(msg == 'empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't add new menu. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='same-title') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new menu. Menu title is already exist. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='title-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Menu title is too long",
                            text:"Can't add new menu. It should have 25 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='title-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Menu title is too short",
                            text:"Can't add new menu. It should have 4 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='reserved-text') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't add new menu. Don't use word like 'tag', 'cr-admin', 'cr-content', 'cr-include', 'Cart', 'Checkout', 'Payment', 'Checkout Review', 'Invoice', it's a reserved word. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New menu has been added.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg=='false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-menu").removeAttr('disabled');
                        $("#button-add-menu").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new menu",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                 });
                add_menu.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });
    });
</script>