<?php
    $class_portfolio_category = new Portfolio_Category($pdo);
    $function_view_pc = $class_portfolio_category->view_portfolio_category($action);
    $class_portfolio  = new Portfolio($pdo);
    if($id == 'view') {
        $function_view_portfolio  = $class_portfolio->view_portfolio($action);
    }
    elseif($id == 'view-name-asc') {
        $function_view_portfolio  = $class_portfolio->view_portfolio_name_asc($action);
    }
    elseif($id == 'view-name-desc') {
        $function_view_portfolio  = $class_portfolio->view_portfolio_name_desc($action);
    }
    elseif($id == 'view-date-asc') {
        $function_view_portfolio  = $class_portfolio->view_portfolio_date_asc($action);
    }
?>
<div id="options" class="m-b-10">
    <span class="gallery-option-set" id="filter" data-option-key="filter">
        <a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
            Show All
        </a>
        <?php
            foreach ($function_view_pc as $data) {
                $pc_slug = create_slug($data->cr_portfoliocategoryName);
        ?>
        <a href="#<?php echo $pc_slug ?>" class="btn btn-default btn-xs" data-option-value=".<?php echo $pc_slug ?>">
            <?php echo $data->cr_portfoliocategoryName; ?>
        </a>
        <?php
            }
        ?>
        <a href="#draft-portfolio" class="btn btn-light-blue btn-xs" data-option-value=".draft-portfolio">
            Draft
        </a>
        <a href="#publish-portfolio" class="btn btn-inverse btn-xs" data-option-value=".publish-portfolio">
            Publish
        </a>
    </span>
    <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>" class="btn btn-warning m-t-15"><i class="fa fa-arrow-left"></i></a>
    <button type="button" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add')) ?>'" class="btn btn-success m-t-15">
        <strong>Add Portfolio</strong>
    </button>
    <div class="btn-group m-t-15">
        <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="button-delete-checked-portfolio" href="javascript:;">Delete Checked Portfolio</a></li>
        </ul>
    </div>

    <?php if($function_view_portfolio != false) { ?>
    <div class="btn-group m-t-15 m-r-15 btn-sorting">
        <a id="sort-asc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-name-asc')) ?>" class="btn btn-inverse <?php if($id == 'view-name-asc') echo 'active' ?>" title="Sort by name (ascending)"><i class="fa fa-sort-alpha-asc"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-name-desc')) ?>" class="btn btn-inverse <?php if($id == 'view-name-desc') echo 'active' ?>" title="Sort by name (descending)"><i class="fa fa-sort-alpha-desc"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-date-asc')) ?>" class="btn btn-inverse <?php if($id == 'view-date-asc') echo 'active' ?>" title="Sort by date (ascending)"><i class="fa fa-long-arrow-up"></i> <i class="fa fa-calendar"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>" class="btn btn-inverse <?php if($id == 'view') echo 'active' ?>" title="Sort by date (descending)"><i class="fa fa-long-arrow-down"></i> <i class="fa fa-calendar"></i></a>
    </div>
    <?php } ?>
</div>
<div id="gallery" class="gallery">
    <?php
        if($function_view_portfolio != false) {
            $i = 1;
            foreach ($function_view_portfolio as $data) {
                $portfolio_id     = $data->cr_portfolioID;
                $function_view_pe = $class_portfolio->view_portfolio_extra($portfolio_id);
                $portfolio_image  = $data->cr_portfolioThumb;
                $pc_slug          = create_slug($data->cr_portfoliocategoryName);
                $portfolio_status = $data->cr_portfolio_status;
                $count_likes      = $class_portfolio->count_likes($portfolio_id);
                $count_visitor    = $class_portfolio->count_visitor($portfolio_id);
                $portfolio_date   = date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($data->cr_portfolioDate));
                //change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
                $portfolio_image_GIF  = str_replace(".png",".gif",$portfolio_image);
                $portfolio_image_JPG  = str_replace(".png",".jpg",$portfolio_image);
                $portfolio_image_JPEG = str_replace(".png",".jpeg",$portfolio_image);
                //remove "/thumbnails" to get the real image
                $portfolio_imagent     = str_replace('/cr-editor/_thumbs/Images/','',$portfolio_image);
                $portfolio_image_GIF_nt  = str_replace('/cr-editor/_thumbs/Images/','',$portfolio_image_GIF);
                $portfolio_image_JPG_nt  = str_replace('/cr-editor/_thumbs/Images/','',$portfolio_image_JPG);
                $portfolio_image_JPEG_nt = str_replace('/cr-editor/_thumbs/Images/','',$portfolio_image_JPEG);

                $portfolio_image_link     = MURL.'cr-editor/images/'.$portfolio_imagent;
                $portfolio_image_GIF_link  = MURL.'cr-editor/images/'.$portfolio_image_GIF_nt;
                $portfolio_image_JPG_link  = MURL.'cr-editor/images/'.$portfolio_image_JPG_nt;
                $portfolio_image_JPEG_link = MURL.'cr-editor/images/'.$portfolio_image_JPEG_nt;

                if(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$portfolio_imagent)) { 
                    $image_path =  $portfolio_image_link; 
                } 
                elseif(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$portfolio_image_GIF_nt)) { 
                    $image_path =  $portfolio_image_GIF_link; 
                } 
                elseif(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$portfolio_image_JPG_nt)) {
                    $image_path =  $portfolio_image_JPG_link; 
                } 
                elseif(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$portfolio_image_JPEG_nt)) { 
                    $image_path =  $portfolio_image_JPEG_link; 
                } 
    ?>
            <div class="image <?php echo $pc_slug ?> <?php if($portfolio_status == "draft") echo "draft-portfolio"; elseif($portfolio_status == "publish") echo "publish-portfolio"; ?>">
                <div class="image-inner">
                    <a href="<?php echo $image_path ?>" data-lightbox="<?php echo $pc_slug; ?>">
                        <img src="<?php echo MURL.$portfolio_image ?>" alt="<?php echo $data->cr_portfolioTitle ?>" />
                    </a>
                    <p class="image-caption <?php if($portfolio_status == "draft") echo "bg-aqua"; elseif($portfolio_status == "publish") echo "bg-black"; ?>">
                        #<?php echo $i ?> - <?php echo $data->cr_portfoliocategoryName ?>
                    </p>
                    <span class="text-center portfolio-actbutton">
                        <button type="button" class="btn btn-success btn-icon btn-circle" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'edit', 'extra' => $portfolio_id)) ?>'"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-primary btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Extra Content" data-placement="top" data-content="This portfolio has <?php if($function_view_pe == 0) echo "no extra content."; elseif($function_view_pe == 1) echo "1 extra content."; else echo $function_view_pe." extra contents." ?>" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'extra', 'extra' => $portfolio_id)) ?>'"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-warning btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Preview" data-placement="top" data-content="Preview this portfolio on your site" onclick="window.open('<?php echo $router->generate('id-link', array('page' => $data->cr_portfoliocategoryLink, 'id_link' => $data->cr_portfolioLink)); ?>', '_blank');" <?php if($portfolio_status == "draft") echo "disabled"; else echo ""; ?>><i class="fa fa-external-link"></i></button>
                        <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#modal-delete-portfolio" data-toggle="modal" data-nm="<?php echo $data->cr_portfolioTitle; ?>" data-pc="<?php echo $data->cr_portfoliocategoryName; ?>" data-delete="<?php echo $portfolio_id; ?>"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <div class="image-info getheight">
                        <h5 class="title name" <?php if($portfolio_status == "draft") echo 'style="color: #49B6D6"'; ?>><input value="<?php echo $portfolio_id ?>" type="checkbox" name="delete-portfolio[]" class="checkbox-action"> <?php echo $data->cr_portfolioTitle ?></h5>
                        <div class="pull-right">
                            <small>by</small> <a><?php echo ucwords($data->cr_adminDisplayName) ?></a>
                        </div>
                        <div class="rating">
                            <i class="fa fa-heart"></i> <?php echo $count_likes ?>
                            <i class="fa fa-eye m-l-10"></i> <?php echo $count_visitor ?><br>
                            <i class="fa fa-calendar"> <?php echo $portfolio_date ?></i>
                        </div>
                        <div class="desc">
                            <?php
                                echo short_description($data->cr_portfolioDesc, 60);
                            ?>
                        </div>
                </div>
            </div>
    <?php
                $i++;
            }
        }
    ?>
    <div class="image <?php foreach ($function_view_pc as $data) { echo create_slug($data->cr_portfoliocategoryName)." "; } ?> draft-portfolio publish-portfolio">
        <div class="image-inner">
            <a href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'add')) ?>">
                <img src="<?php echo MADMINURL ?>assets/img/add.png" alt="Add Portfolio" />
            </a>
        </div>
        <div class="image-info applyheight">
            <h5 class="title">Add New Portfolio</h5>
            <div class="desc">
                Click here to add new portfolio.
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-portfolio">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="nm"></span> in <span id="pc"></span> category?</p>
                <form id="form-delete-portfolio" action="" method="post">
                    <input type="hidden" name="portfolio_id" value="">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-white button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-delete-portfolio" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        <?php
            if($function_view_portfolio != false) {
        ?>
        var set_height = setInterval(
            function () {
                var ert = $(".getheight").outerHeight()+"px";
                $(".applyheight").css("height", ert);
            }, 500
        );
        <?php } ?>

        $('#modal-delete-portfolio').on('show.bs.modal', function(e) {
            $(this).find('input[name=portfolio_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#nm').html($(e.relatedTarget).data('nm'));
            $(this).find('#pc').html($(e.relatedTarget).data('pc'));
        });

        var delete_portfolio;
        $("#form-delete-portfolio").submit(function(event){
            if (delete_portfolio) {
                delete_portfolio.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var portfolio_name = $("#modal-delete-portfolio").find("#nm").html();
            var serializedData = $form.serialize();
            delete_portfolio = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/portfolio-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-portfolio").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-portfolio").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_portfolio.done(function (msg){
                if(msg == 'portfolio-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-portfolio").removeAttr('disabled');
                    $("#button-delete-portfolio").html('Delete');
                    $.gritter.add({
                        title:"Failed! Portfolio is required",
                        text:"Can't delete "+portfolio_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:portfolio_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-portfolio').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => $id)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-portfolio").removeAttr('disabled');
                    $("#button-delete-portfolio").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+portfolio_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-portfolio").removeAttr('disabled');
                    $("#button-delete-portfolio").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+portfolio_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_portfolio.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  

        $("#button-delete-checked-portfolio").click(function(){
            var count_checked = $("input[name='delete-portfolio[]']:checked").length;
            if(count_checked == 0) {
                alert("Please select portfolio(s) to delete.");
                return false;
            }
            else {
                if(confirm('Are you sure you want to delete the selected portfolio(s) ?')) {
                    var dataString = $("input[name='delete-portfolio[]']:checked").serialize();
                    $.ajax({
                        type: "POST",
                        url:  "<?php echo MADMINURL ?>ajax/portfolio-checked-delete.php",
                        data: dataString,
                        cache: false,
                        success: function(msg){
                            if(msg == 'true'){
                                $.gritter.add({
                                    title:"Success!",
                                    text:"Portfolio(s) has been deleted",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                                setTimeout(function() {
                                    window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => $id)) ?>";
                                }, 2000);
                            }
                            else if(msg == 'false') {
                                $.gritter.add({
                                    title:"Failed! Can't delete portfolio(s)",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $.gritter.add({
                                    title:"Error! Can't delete portfolio(s)",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                        }
                    });
                    return false;
                }  
            }         
        });
    });
</script>