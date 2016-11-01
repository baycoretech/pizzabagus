<?php
    $class_blog_category = new Blog_Category($pdo);
    $function_view_blog_category = $class_blog_category->view_blog_category($action);
    $total_blog_category = $class_blog_category->view_total_blog_category($action);
    $total_blog = $class_blog_category->view_total_blog($action);
?>
<div class="row">
    <div class="col-md-3">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
            <h4 class="panel-title">Page Information</h4>
            </div>
            <div class="panel-body">
                <p></p>
                <ul class="fa-ul">
                    <li><i class="fa-li fa fa-dot-circle-o"></i>This page has <?php if($total_blog_category == 0) { echo '<span id="count_category">no category</span>'; } else { if($total_blog_category == 1) echo '<span id="count_category">1 category</span> '; else  echo '<span id="count_category">'.$total_blog_category.' category(s)</span>'; } if($total_blog == 0) { echo ' and no post'; } else { if($total_blog == 1) echo ' and 1 post '; else  echo ' and '.$total_blog.' posts'; } ?>.</li>
                    <li><i class="fa-li fa fa-dot-circle-o"></i><a href="#" data-toggle="modal" data-target="#modal-permalink" data-permalink="<?php echo MURL.$action ?>">View Permalink</a></li>
                </ul>
            </div>
        </div>
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
                    <button id="viewall" class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo $router->generate('admin-dashboard-id', array('section' => $section, 'action' => $action, 'id' => 'view')) ?>'" <?php if($function_view_blog_category == 0) { echo "disabled"; } ?>>
                        <i class="fa fa-pencil-square-o fa-2x pull-left"></i>
                        <span class="f-w-700">View All</span><br>
                        <small>Blog Posts</small>
                    </button>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Category Ordering</h4>
            </div>
            <?php
                if($function_view_blog_category == 0) {
            ?>
            <div id="empty-alert" class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>Empty!</strong>
                    There is no post category.
                </p>
            </div> 
            <?php
                }
            ?>
            <div id="panel-category" class="panel-body">
                <div class="gallery-reorder">
                    <button type="button" class="btn btn-success m-b-5" data-toggle="modal" data-target="#modal-add-category"><i class="fa fa-plus"></i> Add Category</button>
                        <a href="javascript:void(0);" type="button" class="btn btn-warning m-r-5 m-b-5 btn-reorder reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder Categories</a>
                    <div id="reorder-helper" style="display:none;">
                        <div class="alert alert-info fade in m-b-15">
                            1. Drag categories to reorder.<br>2. Click 'Save Reordering' when finished.
                        </div>
                    </div>
                    <ul id="list-bc" class="reorder_ul reorder-photos-list">
                    <?php
                        if($function_view_blog_category != false) {
                            foreach ($function_view_blog_category as $data) {
                                $bc_id = $data->cr_blogcategoryID;
                                $check_bc2 = $class_blog_category->check_in_bc_2($bc_id);
                    ?>
                        <li id="image_li_<?php echo $bc_id; ?>" class="ui-sortable-handle">
                            <div class="menu-reorder-wrapper">
                                <a href="javascript:void(0);" style="float:none;" class="image_link">
                                    <h4><?php echo $data->cr_blogcategoryName; ?> <?php if($check_bc2 == 0) echo ""; else echo "($check_bc2)" ?>
                                        <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($check_bc2 == 0) echo "#modal-delete-category"; else echo "#alert-dialog" ?>" data-dn="<?php echo $data->cr_blogcategoryName; ?>" data-delete="<?php echo $bc_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                        <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-category" data-nameold="<?php echo $data->cr_blogcategoryName ?>" data-bid="<?php echo $bc_id ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                                    </h4>
                                </a>
                            </div>
                        </li>
                    <?php
                        }}
                    ?>
                    </ul>
                </div>
            </div>
         </div>
    </div>
</div>

<div class="modal fade" id="modal-add-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Category</h4>
      </div>
        <div class="modal-body">
            <form id="form-add-category" data-parsley-validate action="" method="post">
                <input type="hidden" name="page" value="<?php echo $action ?>">
                <div class="form-group">
                    <label class="control-label">Category Name</label>
                    <input id="catname" class="form-control" placeholder="Category Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="70" required>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-add-category" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-edit-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
      </div>
        <div class="modal-body">
            <form id="form-edit-category" data-parsley-validate action="" method="POST">
                <input type="hidden" name="bc_idh" value="">
                <input type="hidden" name="nameold" value="">
                <input type="hidden" name="page" value="<?php echo $action ?>">
                <div class="form-group">
                    <label class="control-label">Category Name</label>
                    <input class="form-control" placeholder="Category Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="70" required>
                </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-edit-category" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-delete-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
            <p>Are you sure want to delete <span id="dn" class="add-caps"></span>?</p>
            <form id="form-delete-category" action="" method="post">
                <input type="hidden" name="bc_id" value="">
                <input type="hidden" name="page" value="<?php echo $action ?>">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-default button-cancel" data-dismiss="modal">Cancel</button>
                <button id="button-delete-category" type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="alert-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
            <p>You can not delete a category if there are blogpost(s) in it.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-permalink">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Permalink</h4>
            </div>
            <div class="modal-body">
                Permalink : <strong id="permalink-view"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="window.open('<?php echo $router->generate('specific-page-lang', array('lang' => $default_lang_code, 'page' => $action)) ?>', '_blank');">View Page</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var totallistbc = $("#list-bc li").length;
        if(totallistbc < 1) {
            $("#empty-alert").show();
            $(".btn-reorder").hide();
        }

        $('.reorder_link').on('click',function(){
            $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
            $('.reorder_link').html('Save Reordering');
            $('.reorder_link').attr("id","save_reorder");
            //$('#reorder-helper').slideDown('slow');
            $('.image_link').attr("href","javascript:void(0);");
            $('.image_link').css("cursor","move");
            $("#save_reorder").click(function( e ){
                if( !$("#save_reorder i").length ) {
                    $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                    $("ul.reorder-photos-list").sortable('destroy');
                    //$("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Categories</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
                    var h = [];
                    var page = '<?php echo $action ?>';
                    $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                    $.ajax({
                        type: "POST",
                        url: "<?php echo MADMINURL ?>ajax/blog-category-reorder.php ?>",
                        data: {ids: " " + h + "", page: page},
                        success: function(data) {
                             //window.location.reload();
                             if(data == 'false') {
                                $("#save_reorder").removeAttr('disabled');
                                $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Categories');
                                $.gritter.add({
                                    title:"Failed! Can't reorder category",
                                    text:"Please try again.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                            }
                            else {
                                $("#panel-category").removeClass('p-0');
                                $("#reorder-helper").slideUp('slow');
                                $.gritter.add({
                                    title:"Success!",
                                    text:"Categories has been reordered.",
                                    image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                                    sticky:false,
                                    time:""
                                });
                                $("#list-bc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                                setTimeout(function() {
                                    $("#save_reorder").removeAttr('disabled');
                                    $("#save_reorder").html('<i class="fa fa-reorder"></i> Reorder Categories');
                                    $("#list-bc").html(data);
                                }, 2000);
                                $('.reorder_link').html('Save Reordering');
                                $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
                                //$('.reorder_link').removeAttr("id");
                            }
                        }
                    }); 
                    return false;
                }   
                e.preventDefault();     
            });
        });

        var add_category;
        $("#form-add-category").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_category) {
                    add_category.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                add_category = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/blog-category-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-category").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-category").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                add_category.done(function (msg){
                    if(msg=='empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Please fill all required field.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Category name is too long",
                            text:"Can't add new category. It should have 70 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Category name is too short",
                            text:"Can't add new category. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='field-empty') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Please fill all fields in the form.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='same-name') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Category name that you have submitted already exists.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='reserved-word') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't add new category. Don't use word like 'tag', 'page', or 'cat'. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-add-category").removeAttr('disabled');
                        $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't add new category. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"New category has been added.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        $("#panel-category").removeClass('p-0');
                        $('#modal-add-category').modal('hide');
                        $("#list-bc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                        setTimeout(function() {
                            $("#list-bc").html(msg);
                            $("#empty-alert").slideUp();
                            var totallist = $("#list-bc li").length;
                            $form.find('input[name=name]').val('');
                            $form.find('input[name=name]').parsley().destroy();
                            $form.find('input[name=name]').removeClass('parsley-success');
                            $('#viewall').removeAttr('disabled');
                            $(".button-cancel").removeAttr('disabled');
                            $("#button-add-category").removeAttr('disabled');
                            $("#button-add-category").html('<i class="fa fa-check"></i> Save');
                            if(totallist == 0) {
                                $('#count_category').html('no category');
                            }
                            else if(totallist == 1) {
                                $('#count_category').html('1 category');
                            }
                            else if(totallist > 1) {
                                $('#count_category').html(totallist+' category(s)');
                            }
                        }, 2000);
                    }
                });
                add_category.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var edit_category;
        $("#form-edit-category").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_category) {
                    edit_category.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                var serializedData = $form.serialize();
                edit_category = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/blog-category-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-category").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-edit-category").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_category.done(function (msg){
                    if(msg=='empty-field') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Please fill all required field.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-long') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Category name is too long",
                            text:"Can't edit category. It should have 70 characters or less. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='name-short') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Category name is too short",
                            text:"Can't edit category. It should have 3 characters or more. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='same-name') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Category name that you have submitted already exists.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='reserved-word') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! You used the reserved word",
                            text:"Can't edit category. Don't use word like 'tag', 'page', or 'cat'. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg=='false') {
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-edit-category").removeAttr('disabled');
                        $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed!",
                            text:"Can't edit category. Please try again.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $.gritter.add({
                            title:"Success!",
                            text:"Category has been updated.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        $('#modal-edit-category').modal('hide');
                        $("#list-bc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                        setTimeout(function() {
                            $("#list-bc").html(msg);
                            var totallist = $("#list-bc li").length;
                            $('#viewall').removeAttr('disabled');
                            $form.find('input[name=name]').val('');
                            $form.find('input[name=name]').parsley().destroy();
                            $form.find('input[name=name]').removeClass('parsley-success');
                            $(".button-cancel").removeAttr('disabled');
                            $("#button-edit-category").removeAttr('disabled');
                            $("#button-edit-category").html('<i class="fa fa-check"></i> Save');
                            if(totallist == 0) {
                                $('#count_category').html('no category');
                            }
                            else if(totallist == 1) {
                                $('#count_category').html('1 category');
                            }
                            else if(totallist > 1) {
                                $('#count_category').html(totallist+' category(s)');
                            }
                        }, 2000);
                    }
                });
                edit_category.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_category;
        $("#form-delete-category").submit(function(event){
            if (delete_category) {
                delete_category.abort();
            }
            var $form = $(this);
            var category =  $('#modal-delete-category').find("#dn").text();
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_category = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/blog-category-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-category").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-category").attr('disabled','disabled');$(".button-cancel").attr('disabled','disabled');},
                data: serializedData
            });
            delete_category.done(function (msg){
                if(msg == 'empty-field') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-category").removeAttr('disabled');
                    $("#button-delete-category").html('Delete');
                    $.gritter.add({
                        title:"Failed! Category is required",
                        text:"Can't delete "+category+". Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg=='false') {
                    $(".button-cancel").removeAttr('disabled');
                    $("#button-delete-category").removeAttr('disabled');
                    $("#button-delete-category").html('Delete');
                    $.gritter.add({
                        title:"Failed!",
                        text:"Can't delete portfolio category. Please try again.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $.gritter.add({
                        title:"Success!",
                        text: category+" has been deleted.",
                        image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    $('#modal-delete-category').modal('hide');
                    $("#list-bc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                    setTimeout(function() {
                        $("#list-bc").html(msg);
                        $(".button-cancel").removeAttr('disabled');
                        $("#button-delete-category").removeAttr('disabled');
                        $("#button-delete-category").html('Delete');
                        var totallist2 = $("#list-bc li").length;
                        $('#count_category').html(totallist2);
                        if(totallist2 < 1) {
                            $("#empty-alert").show();
                            $(".btn-reorder").hide();
                            $("#viewall").attr('disabled','disabled');
                        }
                        if(totallist2 == 0) {
                            $('#count_category').html('no category');
                        }
                        else if(totallist2 == 1) {
                            $('#count_category').html('1 category');
                        }
                        else if(totallist2 > 1) {
                            $('#count_category').html(totallist2+' category(s)');
                        }
                    }, 2000);
                }
            });
            delete_category.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });

        $('#modal-edit-category').on('show.bs.modal', function(e) {
            $(this).find('input[name=name], input[name=nameold]').attr('value', $(e.relatedTarget).data('nameold'));
            $(this).find('input[name=bc_idh]').attr('value', $(e.relatedTarget).data('bid'));
        });

        $('#modal-delete-category').on('show.bs.modal', function(e) {
            $(this).find('input[name=bc_id]').attr('value', $(e.relatedTarget).data('delete'));
            $(this).find('#dn').html($(e.relatedTarget).data('dn'));
        });

        $('#modal-permalink').on('show.bs.modal', function(e) {
            $(this).find('#permalink-view').html($(e.relatedTarget).data('permalink'));
        });
    });
</script>