<?php
    $class_blog_category = new Blog_Category($pdo);
    $function_view_blog_category = $class_blog_category->view_blog_category($action);
    $class_blog          = new Blog($pdo);
    $function_view_blog  = $class_blog->view_blog($action);
    $class_blog_comment  = new Blog_Comment($pdo);

    if($id == 'view') {
        $function_view_blog  = $class_blog->view_blog($action);
    }
    elseif($id == 'view-name-asc') {
        $function_view_blog  = $class_blog->view_blog_name_asc($action);
    }
    elseif($id == 'view-name-desc') {
        $function_view_blog  = $class_blog->view_blog_name_desc($action);
    }
    elseif($id == 'view-date-asc') {
        $function_view_blog  = $class_blog->view_blog_date_asc($action);
    }
?>
<div id="options" class="m-b-10">
    <span class="gallery-option-set" id="filter" data-option-key="filter">
        <a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
            Show All
        </a>
        <?php
            foreach ($function_view_blog_category as $data) {
        ?>
        <a href="#<?php echo create_slug($data->cr_blogcategoryName) ?>" class="btn btn-default btn-xs" data-option-value=".<?php echo create_slug($data->cr_blogcategoryName) ?>">
            <?php echo $data->cr_blogcategoryName ?>
        </a>
        <?php } ?>
        <a href="#standardpost" class="btn btn-light-green btn-xs" data-option-value=".standardpost">
            Standard
        </a>
        <a href="#imagepost" class="btn btn-purple btn-xs" data-option-value=".imagepost">
            Image
        </a>
        <a href="#videopost" class="btn btn-danger btn-xs" data-option-value=".videopost">
            Video
        </a>
        <a href="#soundpost" class="btn btn-warning btn-xs" data-option-value=".soundpost">
            Sound
        </a>
        <a href="#draft-blog" class="btn btn-light-blue btn-xs" data-option-value=".draft-blog">
            Draft
        </a>
        <a href="#publish-blog" class="btn btn-inverse btn-xs" data-option-value=".publish-blog">
            Publish
        </a>
    </span>
    <a href="<?php echo $router->generate('admin-dashboard-action', array('section' => $section, 'action' => $action)) ?>" class="btn btn-warning m-t-15"><i class="fa fa-arrow-left"></i></a>
    <button type="button" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'type')) ?>'" class="btn btn-success m-t-15">
        <strong>Write New Post</strong>
    </button>
    <div class="btn-group m-t-15">
        <a href="javascript:;" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Action <span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a id="button-delete-checked-blog" href="javascript:;">Delete Checked Post</a></li>
        </ul>
    </div>

    <?php if($function_view_blog != false) { ?>
    <div class="btn-group m-t-15 m-r-15 btn-sorting">
        <a id="sort-asc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-name-asc')) ?>" class="btn btn-inverse <?php if($id == 'view-name-asc') echo 'active' ?>" title="Sort by name (ascending)"><i class="fa fa-sort-alpha-asc"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-name-desc')) ?>" class="btn btn-inverse <?php if($id == 'view-name-desc') echo 'active' ?>" title="Sort by name (descending)"><i class="fa fa-sort-alpha-desc"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view-date-asc')) ?>" class="btn btn-inverse <?php if($id == 'view-date-asc') echo 'active' ?>" title="Sort by date (ascending)"><i class="fa fa-long-arrow-up"></i> <i class="fa fa-calendar"></i></a>
        <a id="sort-desc" href="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>" class="btn btn-inverse <?php if($id == 'view') echo 'active' ?>" title="Sort by date (descending)"><i class="fa fa-long-arrow-down"></i> <i class="fa fa-calendar"></i></a>
    </div>
    <?php } ?>
</div>

<?php
    if($function_view_blog == false) {
?>
<div class="col-md-12 p-l-0">
    <div class="alert alert-info fade in m-b-15">
        <strong>Empty!</strong>
        No post found.
        <span class="close" data-dismiss="alert">×</span>
    </div>
</div>
<?php
    }
    else {
?>
<div id="gallery" class="gallery">
    <?php
        $i = 1;
        foreach ($function_view_blog as $data) {
            $blog_id       = $data->cr_blogID;
            $blog_type     = $data->cr_blogtypeName;
            $blog_likes    = $class_blog->view_blog_likes($blog_id);
            $blog_visitor  = $class_blog->count_visitor($blog_id);
            $blog_comments = $class_blog_comment->total_comments($blog_id);
            $blog_status   = $data->cr_blogStatus;
            $blog_date = date($function_date_format->cr_settingValue.' '.$function_time_format->cr_settingValue, strtotime($data->cr_blogPostdate));
            if(empty($data->cr_blogFeatured) || $data->cr_blogFeatured == '') {
                $blog_image = MURL."cr-include/images/default-post-image.png";
            }
            else {
                if($blog_type == "video") {
                    $get_video_id = str_replace("https://www.youtube.com/embed/", "", $data->cr_blogFeatured);
                    $blog_image  = "http://img.youtube.com/vi/".$get_video_id."/hqdefault.jpg";
                }
                elseif($blog_type == "sound") {
                    $blog_image = MURL."cr-include/images/default-post-sound.png";
                }
                else {
                    $blog_image = MURL.$data->cr_blogFeatured;
                }
            }
    ?>
        <div class="image <?php echo create_slug($data->cr_blogcategoryName); ?> <?php echo $blog_type.'post' ?> <?php if($blog_status == "draft") echo "draft-blog"; elseif($blog_status == "publish") echo "publish-blog"; ?>">
            <div class="image-inner">
                <a href="<?php if($blog_type == "video" || $blog_type == "sound") echo $data->cr_blogFeatured; else echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'edit', 'extra' => $blog_id)) ?>" <?php if($blog_type == "video" || $blog_type == "sound") { ?> class="html5lightbox" <?php } ?> <?php if($blog_type == "sound") echo 'data-height="166"' ?>>
                    <img src="<?php echo $blog_image ?>" alt="<?php echo $data->cr_blogTitle ?>" />
                </a>
                <p class="image-caption <?php if($blog_type == 'standard') echo "bg-green-lighter"; elseif($blog_type == 'image') echo "bg-purple"; elseif($blog_type == 'video') echo "bg-red"; elseif($blog_type == 'sound') echo "bg-orange" ?>">#<?php echo $i ?> - 
                    <?php echo $data->cr_blogcategoryName ?> - <?php echo ucwords($blog_type) ?>
                </p>
                <span class="text-center portfolio-actbutton">
                    <button type="button" class="btn btn-success btn-icon btn-circle btn-edit" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'edit', 'extra' => $blog_id)) ?>'"><i class="fa fa-pencil"></i></button>
                    <button type="button" class="btn btn-primary btn-icon btn-circle btn-edit" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Total Comment" data-placement="top" data-content="This post has <?php if($blog_comments == 0) echo "no comment."; elseif($blog_comments == 1) echo "1 comment."; else echo "$blog_comments comments." ?>" onclick="location.href='<?php echo $router->generate('admin-dashboard-extra', array('section' => $section, 'action' => $action, 'id' => 'comment', 'extra' => $blog_id)) ?>'" <?php if($data->cr_blogComment == "off" || $blog_comments == 0) echo "disabled" ?>><i class="fa fa-comment"></i></button>
                    <button type="button" class="btn btn-indigo btn-icon btn-circle btn-edit" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Tags" data-placement="bottom" data-content="<?php if(empty($data->cr_blogTags) || $data->cr_blogTags == "") echo "No tag"; else echo $data->cr_blogTags ?>"><i class="fa fa-tags"></i></button>
                    <button type="button" class="btn btn-warning btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Preview" data-placement="top" data-content="Preview this post on your site" onclick="window.open('<?php echo $router->generate('id-link-lang', array('lang' => $default_lang_code, 'page' => $action, 'id_link' => $data->cr_blogLink)); ?>', '_blank');" <?php if($blog_status == "draft") echo "disabled"; else echo ""; ?>><i class="fa fa-external-link"></i></button>
                    <button type="button" class="btn btn-danger btn-icon btn-circle btn-delete" data-target="#modal-delete-blog" data-toggle="modal" data-nm="<?php echo $data->cr_blogTitle; ?>" data-bc="<?php echo $data->cr_blogcategoryName; ?>" data-delete="<?php echo $blog_id; ?>"><i class="fa fa-times"></i></button>
                </span>
            </div>
            <div class="image-info">
                <h5 class="title" <?php if($blog_status == "draft") echo 'style="color: #03A9F4"'; ?>><input value="<?php echo $blog_id ?>" type="checkbox" name="delete-blog[]" class="checkbox-action"> <?php echo $data->cr_blogTitle ?></h5>
                <div class="pull-right">
                    <small>by</small> <a><?php echo ucwords($data->cr_adminDisplayName) ?></a>
                </div>
                <div class="rating">
                    <i class="fa fa-heart"></i> <?php echo $blog_likes ?> 
                    <i class="fa fa-eye m-l-5"></i> <?php echo $blog_visitor ?>
                    <i class="fa fa-comment m-l-5"></i> <?php echo $blog_comments ?>
                    <br><i class="fa fa-calendar"> <?php echo $blog_date ?></i>
                </div>
                <div class="desc">
                    <?php
                        echo short_description($data->cr_blogContent, 60);
                    ?>
                </div>
            </div>
        </div>
    <?php
            $i++;
        }
    ?>
</div>
<?php } ?>

<div class="modal fade" id="modal-delete-blog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="nm"></span> in <span id="bc"></span> category?</p>
                <form id="form-delete-blog" action="" method="post">
                    <input type="hidden" name="blog_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-white button-cancel" data-dismiss="modal">Cancel</button>
                    <button id="button-delete-blog" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal-delete-blog').on('show.bs.modal', function(e) {
            $(this).find('input[name=blog_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#nm').html($(e.relatedTarget).data('nm'));
            $(this).find('#bc').html($(e.relatedTarget).data('bc'));
        });

        function noResultsCheck() {
            var numItems = $('.image:not(.isotope-hidden)').length;   
            if (numItems == 0) {
                alert("There are no results");
            }
        }

        var delete_blog;
        $("#form-delete-blog").submit(function(event){
            if (delete_blog) {
                delete_blog.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var blog_name = $("#modal-delete-blog").find("#nm").html();
            var serializedData = $form.serialize();
            delete_blog = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/blog-post-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-blog").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-blog").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_blog.done(function (msg){
                if(msg == 'blog-empty') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-blog").removeAttr('disabled');
                    $("#button-delete-blog").html('Delete');
                    $.gritter.add({
                        title:"Failed! Blog is required",
                        text:"Can't delete "+blog_name+". Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:blog_name+" has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-blog').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => $id)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-blog").removeAttr('disabled');
                    $("#button-delete-blog").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete "+blog_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-blog").removeAttr('disabled');
                    $("#button-delete-blog").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete "+blog_name,
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_blog.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        }); 

        $("#button-delete-checked-blog").click(function(){
            var count_checked = $("input[name='delete-blog[]']:checked").length;
            if(count_checked == 0) {
                alert("Please select post(s) to delete.");
                return false;
            }
            else {
                if(confirm('Are you sure you want to delete the selected post(s) ?')) {
                    var dataString = $("input[name='delete-blog[]']:checked").serialize();
                    $.ajax({
                        type: "POST",
                        url:  "<?php echo MADMINURL ?>ajax/blog-post-checked-delete.php",
                        data: dataString,
                        cache: false,
                        success: function(msg){
                            if(msg == 'true'){
                                $.gritter.add({
                                    title:"Success!",
                                    text:"Post(s) has been deleted",
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
                                    title:"Failed! Can't delete post(s)",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $.gritter.add({
                                    title:"Error! Can't delete post(s)",
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