<?php
    $pagelink = $_GET['s'];
    $o_getPC  = new E_Commerce_Product_Category($pdo);
    $v_getPC  = $o_getPC->view_product_category($pagelink);
    $v_getTPC = $o_getPC->view_total_product_category($pagelink);
    $v_getTPP = $o_getPC->view_total_product($pagelink);

    //$o_getMenu  = new menu($pdo);
    //$v_getDisabledShowcase = $o_getMenu->disabledshowcasePortfolio($pagelink);
    //$v_getTSPortfolio      = $o_getMenu->countshowcasePortfolio($pagelink);
?>
<div class="row">
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
            <h4 class="panel-title">Page Information</h4>
            </div>
            <div class="panel-body">
                <p></p>
                <ul class="fa-ul">
                    <li><i class="fa-li fa fa-dot-circle-o"></i>This page has <?php if($v_getTPC==0) { echo 'no category'; } else { if($v_getTPC==1) echo '1 category '; else  echo $v_getTPC.' categories'; } if($v_getTPP==0) { echo ' and no e-commerce product'; } else { if($v_getTPP==1) echo ' and 1 portfolio/product '; else  echo ' and '.$v_getTPP.' e-commerce products'; } ?>.</li>
                    <li><i class="fa-li fa fa-dot-circle-o"></i><a href="#" data-toggle="modal" data-target="#permalink-modal" data-permalink="<?php echo MURL.'/'.$_GET['s'] ?>">View Permalink</a></li>
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
                    <button id="viewall" class="btn btn-lg btn-success btn-block" onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink; ?>/view'" <?php if($v_getPC==0) { echo "disabled"; } ?>>
                        <i class="fa fa-shopping-cart fa-2x pull-left"></i>
                        <span class="f-w-700">View All</span><br>
                        <small>E-Commerce Products</small>
                    </button>
                    <!--
                    <?php
                        if($v_getDisabledShowcase->cr_option=="showcase"){
                    ?>
                        <div class="alert alert-info fade in m-b-15">
                            All e-commerce products in this page is already set as showcase.
                        </div>
                    <?php
                        }
                        elseif($v_getTSPortfolio==1) {
                    ?>
                        <div class="alert alert-info fade in m-b-15">
                            There is already page set as showcase.
                        </div>    
                    <?php
                        }
                    ?>
                    <?php
                            if (isset ($_POST['setasshowcase'])) {
                                $adminLoginID    = $_POST['adminLoginID'];
                                $pageshowcase    = $_POST['pageshowcase'];

                                if(empty($adminLoginID) || empty($pageshowcase)){
                                           header("Location: $madinurl/page/$pagelink");       
                                }
                                else {
                                        $v_getshowcasePage = $o_getMenu->setshowcasePortfolio($adminLoginID, $pageshowcase);
                                        header("Location: $madinurl/page/$pagelink"); 
                                } 
                            }
                    ?>
                    <form action="" method="POST">
                    <input type="hidden" name="pageshowcase" value="<?php echo $pagelink ?>">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                    <button type="submit" name="setasshowcase" class="btn btn-lg btn-primary btn-block m-t-10" <?php if($v_getTSPortfolio==1 || $v_getDisabledShowcase->cr_option=="showcase") echo "disabled" ?>>
                        <i class="fa fa-check-square fa-2x pull-left"></i>
                        <span class="f-w-700">Set as Showcase</span><br>
                        <small>Portfolios/Products</small>
                    </button>
                    </form>
                    <?php 
                        if($v_getDisabledShowcase->cr_option=="showcase") {  
                    ?>
                    <?php
                        if (isset ($_POST['unsetasshowcase'])) {
                            $adminLoginID    = $_POST['adminLoginID'];
                            $pageshowcase    = $_POST['pageshowcase'];

                            if(empty($adminLoginID) || empty($pageshowcase)){
                                       header("Location: $madinurl/page/$pagelink");       
                            }
                            else {
                                    $v_getunshowcasePortfolio = $o_getMenu->unshowcasePortfolio($adminLoginID, $pageshowcase);
                                    header("Location: $madinurl/page/$pagelink"); 
                            } 
                        }
                ?>
                <form action="" method="POST">
                <input type="hidden" name="pageshowcase" value="<?php echo $pagelink ?>">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                <button type="submit" name="unsetasshowcase" class="btn btn-danger btn-block m-t-10">Remove Showcase</button>
                </form>
                    <?php
                        }
                    ?>
                -->
                </p>
            </div>
        </div>
     <!-- end panel -->
    </div>
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
                <h4 class="panel-title">Category Ordering</h4>
            </div>
            <?php
                if($v_getPC==0) {
            ?>
            <div id="empty-alert" class="alert alert-info no-rounded-corner m-b-0 fade in">
                <p>
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>Empty!</strong>
                    There is no e-commerce product category.
                </p>
            </div> 
            <?php
                }
            ?>
                <div id="" class="panel-body">
                    <div class="gallery-reorder">
                        <p id="pforbutton">
                            <button type="button" class="btn btn-success m-b-5" data-toggle="modal" data-target="#addcategoryModal"><i class="fa fa-plus"></i> Add Category</button>
                            <a href="javascript:void(0);" type="button" class="btn btn-warning m-r-5 m-b-5 btn-reorder reorder_link" id="save_reorder"><i class="fa fa-reorder"></i> Reorder Categories</a>
                        </p>
                        <div id="reorder-helper" style="display:none;">
                            <div class="alert alert-info fade in m-b-15">
                                1. Drag categories to reorder.<br>2. Click 'Save Reordering' when finished.
                            </div>
                        </div>

                        <ul id="list-pc" class="reorder_ul reorder-photos-list">
                        <?php
                                foreach ($v_getPC as $data) {
                                    $pcID = $data->cr_productcategoryID;
                                    $v_getPcount = $o_getPC->check_in_proc2($pcID);
                        ?>
                                <li id="image_li_<?php echo $data->cr_productcategoryID; ?>" class="ui-sortable-handle">
                                    <div class="menu-reorder-wrapper">
                                    <a href="javascript:void(0);" style="float:none;" class="image_link">
                                            <h4><?php echo $data->cr_productcategoryName; ?> <?php if($v_getPcount==0) echo ""; else echo "($v_getPcount)" ?>
                                                <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($v_getPcount==0) echo "#delete-dialog"; else echo "#alert-dialog" ?>" data-dn="<?php echo $data->cr_productcategoryName; ?>" data-hapuspc="<?php echo $data->cr_productcategoryID; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                                <span class="pull-right m-l-10" data-toggle="modal" data-target="#setfeaturedModal" data-featured="<?php echo $data->cr_productcategoryFeatured ?>" data-name="<?php echo $data->cr_productcategoryName ?>" data-pid="<?php echo $data->cr_productcategoryID ?>"><i class="fa fa-star text-<?php if($data->cr_productcategoryFeatured == '1') echo 'warning'; else echo 'inverse' ?> cpointer"></i></span>
                                                <span class="pull-right m-l-10" data-toggle="modal" data-target="#editcategoryModal" data-nameold="<?php echo $data->cr_productcategoryName ?>" data-pid="<?php echo $data->cr_productcategoryID ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                                            </h4>
                                            
                                    </a>
                                    </div>
                                </li>
                        <?php
                                }
                        ?>
                        </ul>
                    </div>

                </div>
         </div>
        <!-- end panel -->
        
    </div>

    
</div>

<div class="modal fade" id="addcategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-white" id="myModalLabel">Add Category</h4>
      </div>
        <div class="modal-body">
                <form id="formaddportfoliocategory" data-parsley-validate action="" method="post">
                    <input type="hidden" name="pagelink" value="<?php echo $pagelink ?>">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                    <div class="form-group">
                        <label class="control-label">Category Name</label>
                        <input id="catname" class="form-control" placeholder="Category Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="70" autofocus required>
                    </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="submitaddportfoliocategory" type="submit" class="btn btn-success" name="save">Save</button>
                </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editcategoryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-white" id="myModalLabel">Edit Category</h4>
      </div>
        <div class="modal-body">
                    
                    <form id="formeditportfoliocategory" data-parsley-validate action="" method="POST">
                        <input id="portfoliocategoryid" type="hidden" name="productcategoryIDh" value="">
                        <input id="portfoliocategoryold" type="hidden" name="nameold" value="">
                        <input type="hidden" name="pagelink" value="<?php echo $pagelink ?>">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Category Name</label>
                            <input id="portfoliocatname" class="form-control" placeholder="Category Name" type="text" name="name" value="" data-parsley-minlength="3" data-parsley-maxlength="50" required>
                        </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="submiteditportfoliocategory" type="submit" class="btn btn-success" name="saveedit">Save</button>
                </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="setfeaturedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-white" id="myModalLabel">Set Featured Category</h4>
      </div>
        <div class="modal-body">
                    
                    <form id="formfeatured" data-parsley-validate action="" method="POST">
                        <input id="product_category_id" type="hidden" name="productcategoryIDh" value="">
                        <input type="hidden" name="pagelink" value="<?php echo $pagelink ?>">
                        <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
                        <div class="form-group">
                            <label class="control-label">Set <span id="set_featured_category_name"></span> as featured category?</label>
                            <select id="featured-value" class="form-control" name="featured" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="submitfeatured" type="submit" class="btn btn-success" name="saveedit">Save</button>
                </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="delete-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-white" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
                <p>Are you sure want to delete <span id="dn" class="add-caps"></span>?</p>
                <form id="formdeleteportfoliocategory" action="" method="post">
                    <input type="hidden" name="pcID" value="" id="delete-pc">
                    <input type="hidden" name="pagelink" value="<?php echo $pagelink ?>">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="submitdeleteportfoliocategory" type="submit" class="btn btn-danger" name="hapusmenu">Delete</button>
                </form>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="alert-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-white" id="myModalLabel">Alert</h4>
      </div>
        <div class="modal-body">
                <p>
                    You can not delete a category if there are e-commerce product(s) in it.
                </p>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="permalink-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Permalink</h4>
            </div>
            <div class="modal-body">
                Permalink : <strong id="permalink-view"></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" onclick="window.open('<?php echo MURL.'/'.$_GET['s'] ?>', '_blank');">View Page</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    //var totallistpc = $("#list-pc li").length;
    //if(totallistpc<1) {
        //$("#empty-alert").show();
        //$(".btn-reorder").hide();
    //}

    $('.reorder_link').on('click',function(){
        $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
        $('.reorder_link').html('Save Reordering');
        $('.reorder_link').attr("id","save_reorder");
        //$('#reorder-helper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");
        $("#save_reorder").click(function( e ){
            if( !$("#save_reorder i").length )
            {
                $(this).html('').prepend('<i class="fa fa-spin fa-refresh"></i> loading');
                $("ul.reorder-photos-list").sortable('destroy');
                //$("#reorder-helper").html( "<div class='alert alert-warning fade in m-b-15'><strong>Reordering Categories</strong> - This could take a moment. Please don't navigate away from this page.</div>" ).removeClass('light_box').addClass('notice notice_error');
    
                var h = [];
                $("ul.reorder-photos-list li").each(function() {  h.push($(this).attr('id').substr(9));  });
                $.ajax({
                    type: "POST",
                    url: "<?php echo MADMINURL ?>/product-category-reorder.php?pagelink=<?php echo $pagelink ?>",
                    data: {ids: " " + h + ""},
                    success: function(html) 
                    {
                        //window.location.reload();
                        $("#reorder-helper").slideUp('slow');
                        $.gritter.add({
                            title:"Success!",
                            text:"E-Commerce product categories has been reordered.",
                            image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                        setTimeout(function() {
                            $("#list-pc").html(html);
                        }, 2000);
                        $('.reorder_link').html('Save Reordering');
                        $("ul.reorder-photos-list").sortable({ tolerance: 'pointer' });
                        //$('.reorder_link').removeAttr("id");
                    }
                    
                }); 
                return false;
            }   
            e.preventDefault();     
        });
    });

    var requestfeatured;
    $("#formfeatured").submit(function(event){
        if (requestaddpc) {
            requestaddpc.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, button");
        var serializedData = $form.serialize();
        requestfeatured = $.ajax({
            url: "<?php echo MADMINURL ?>/product-set-featured.php",
            type: "post",
            beforeSend: function(){ $("#submitfeatured").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
            data: serializedData
        });
        requestfeatured.done(function (msg){
            if(msg=='failed') {
                $("#submitfeatured").html('Save');
                $.gritter.add({
                    title:"Failed!",
                    text:"Can't set featured category. Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else {
                var totallist = $("#list-pc li").length;
                $.gritter.add({
                    title:"Success!",
                    text:"Featured category has been set.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
                $('#setfeaturedModal').modal('hide');
                $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                setTimeout(function() {
                    $("#list-pc").html(msg);
                    $('#featured-value').removeClass('parsley-success');
                    $("#submitfeatured").html('Save');
                    if(totallist<1) {
                        $("#empty-alert").slideUp('slow');
                        $(".btn-reorder").show();
                    }
                }, 2000);
            }
        });
        requestfeatured.always(function () {
            $inputs.prop("disabled", false);
        });
        event.preventDefault();
    });

    var requestaddpc;
    $("#formaddportfoliocategory").submit(function(event){
        if (requestaddpc) {
            requestaddpc.abort();
        }
        var $form = $(this);
        var $inputs = $form.find("input, button");
        var serializedData = $form.serialize();
        requestaddpc = $.ajax({
            url: "<?php echo MADMINURL ?>/product-category-add.php",
            type: "post",
            beforeSend: function(){ $("#submitaddportfoliocategory").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
            data: serializedData
        });
        requestaddpc.done(function (msg){
            if(msg=='failed') {
                $("#submitaddportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed!",
                    text:"Can't add new e-commerce product category. Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='long') {
                $("#submitaddportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed! Category name is too long",
                    text:"Can't add new e-commerce product category. It should have 70 characters or less. Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='short') {
                $("#submitaddportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed! Category name is too short",
                    text:"Can't add new e-commerce product category. It should have 3 characters or more. Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='field-empty') {
                $("#submitaddportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed!",
                    text:"Please fill all fields in the form.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='same-name') {
                $("#submitaddportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed!",
                    text:"E-commerce product category name that you have submitted already exists.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else {
                var totallist = $("#list-pc li").length;
                $.gritter.add({
                    title:"Success!",
                    text:"New e-commerce product category has been added.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
                $('#addcategoryModal').modal('hide');
                $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                setTimeout(function() {
                    $("#list-pc").html(msg);
                    $('#catname').val('');
                    $('#viewall').removeAttr('disabled');
                    $('#catname').removeClass('parsley-success');
                    $("#submitaddportfoliocategory").html('Save');
                    if(totallist<1) {
                        $("#empty-alert").slideUp('slow');
                        $(".btn-reorder").show();
                    }
                }, 2000);
            }
        });
        requestaddpc.always(function () {
            $inputs.prop("disabled", false);
        });
        event.preventDefault();
    });

    var requesteditpc;
                
    // Bind to the submit event of our form
    $("#formeditportfoliocategory").submit(function(event){
                
        // Abort any pending requesteditpc
        if (requesteditpc) {
            requesteditpc.abort();
        }
        // setup some local variables
        var $form = $(this);
                
        // Let's select and cache all the fields
        var $inputs = $form.find("input, button");
                
        // Serialize the data in the form
        var serializedData = $form.serialize();

        requesteditpc = $.ajax({
            url: "<?php echo MADMINURL ?>/product-category-edit.php",
            type: "post",
            beforeSend: function(){ $("#submiteditportfoliocategory").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');},
            data: serializedData
        });
                
        // Callback handler that will be called on success
        requesteditpc.done(function (msg){
            if(msg=='failed') {
                $("#submiteditportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed!",
                    text:"Can't edit e-commerce product category. Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='long') {
                $("#submiteditportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed! Category name is too long",
                    text:"Can't edit e-commerce product category. It should have 70 characters or less. Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='short') {
                $("#submiteditportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed! Category name is too short",
                    text:"Can't edit e-commerce product category. It should have 3 characters or more. Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='field-empty') {
                $("#submiteditportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed!",
                    text:"Please fill all fields in the form.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else if(msg=='same-name') {
                $("#submiteditportfoliocategory").html('Save');
                $.gritter.add({
                    title:"Failed!",
                    text:"E-commerce product category name that you have submitted already exists.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else {
                $.gritter.add({
                    title:"Success!",
                    text:"E-commerce product category has been updated.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
                $('#editcategoryModal').modal('hide');
                $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                setTimeout(function() {
                    $("#list-pc").html(msg);
                    $('#viewall').removeAttr('disabled');
                    $('#portfoliocatname').val('');
                    $('#portfoliocatname').removeClass('parsley-success');
                    $("#submiteditportfoliocategory").html('Save');
                }, 2000);
                //setTimeout(function() {
                    //window.location="<?php echo MADMINURL.'/page/'.$pagelink ?>";
                //}, 2000);
            }
        });
                
        // Callback handler that will be called regardless
        // if the requestaddpc failed or succeeded
        requesteditpc.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });
                
        // Prevent default posting of form
        event.preventDefault();
    });

    // Variable to hold request delete portfolio category
    var requestdeletepc;
                
    // Bind to the submit event of our form
    $("#formdeleteportfoliocategory").submit(function(event){
                
        // Abort any pending requestdeletepc
        if (requestdeletepc) {
            requestdeletepc.abort();
        }
        // setup some local variables
        var $form = $(this);
        var pcname = $("#dn").text();
                
        // Let's select and cache all the fields
        var $inputs = $form.find("input, button");
                
        // Serialize the data in the form
        var serializedData = $form.serialize();

        requestdeletepc = $.ajax({
            url: "<?php echo MADMINURL ?>/product-category-delete.php",
            type: "post",
            beforeSend: function(){ $("#submitdeleteportfoliocategory").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');},
            data: serializedData
        });
                
        // Callback handler that will be called on success
        requestdeletepc.done(function (msg){
            if(msg=='field-empty') {
                $("#submitdeleteportfoliocategory").html('Delete');
                $.gritter.add({
                    title:"Failed!",
                    text:"Can't delete "+pcname+". Please try again.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
            }
            else {
                
                $.gritter.add({
                    title:"Success!",
                    text: pcname+" has been deleted.",
                    image:"<?php echo MADMINURL.'/assets/img/cr.png' ?>",
                    sticky:false,
                    time:""
                });
                $('#delete-dialog').modal('hide');
                $("#list-pc").html('<p class="text-center"><i class="fa fa-2x fa-spinner fa-pulse"></i></p>');
                setTimeout(function() {
                    $("#list-pc").html(msg);
                    $("#submitdeleteportfoliocategory").html('Delete');
                }, 500);

                var auto_refresh = setInterval(
                function () {
                    var totallist2 = $("#list-pc li").length;
                    if(totallist2 < 1) {
                        $("#empty-alert").show();
                        $(".btn-reorder").hide();
                        $("#viewall").attr('disabled','disabled');
                    }
                }, 1000);

                //setTimeout(function() {
                    //window.location="<?php echo MADMINURL.'/page/'.$pagelink ?>";
                //}, 2000);
            }
        });
                
        // Callback handler that will be called regardless
        // if the requestaddpc failed or succeeded
        requestdeletepc.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });
                
        // Prevent default posting of form
        event.preventDefault();
    });

    $('#addcategoryModal').on('show.bs.modal', function(e) {
        $('#catname').focus();
    });

    $('#editcategoryModal').on('show.bs.modal', function(e) {
        $(this).find('#portfoliocategoryold, #portfoliocatname').attr('value', $(e.relatedTarget).data('nameold'));
        $(this).find('#portfoliocategoryid').attr('value', $(e.relatedTarget).data('pid'));
    });

    $('#setfeaturedModal').on('show.bs.modal', function(e) {
        $(this).find('#set_featured_category_name').html($(e.relatedTarget).data('name'));
        $(this).find('#product_category_id').attr('value', $(e.relatedTarget).data('pid'));
    });

    $('#permalink-modal').on('show.bs.modal', function(e) {
        $(this).find('#permalink-view').html($(e.relatedTarget).data('permalink'));
    });

    $('#delete-dialog').on('show.bs.modal', function(e) {
        $(this).find('#delete-pc').attr('value', $(e.relatedTarget).data('hapuspc'));
        $(this).find('#dn').html($(e.relatedTarget).data('dn'));
    });
    
});
</script>