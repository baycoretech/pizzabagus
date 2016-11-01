<?php
    $pagelink = $_GET['s'];
    $pc       = $_GET['id'];
    $o_getPC  = new E_Commerce_Product_Category($pdo);
    $v_getPC  = $o_getPC->view_product_category($pagelink);
    $o_getProduct  = new E_Commerce_Product($pdo);
    $v_getProduct  = $o_getProduct->view_product_date_asc($pagelink);
?>
<div id="options" class="m-b-10">
    
    <span class="gallery-option-set" id="filter" data-option-key="filter">
                    <a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
                        Show All
                    </a>
                    <?php
                        foreach ($v_getPC as $data) {
                            $pclink = create_slug($data->cr_productcategoryName);
                    ?>
                    <a href="#<?php echo $pclink; ?>" class="btn btn-default btn-xs" data-option-value=".<?php echo $pclink; ?>">
                        <?php echo $data->cr_productcategoryName; ?>
                    </a>
                    <?php
                        }
                    ?>
                    <a href="#draft-product" class="btn btn-default btn-xs bg-aqua" data-option-value=".draft-product">
                        Draft
                    </a>
                    <a href="#publish-product" class="btn btn-default btn-xs bg-black" data-option-value=".publish-product">
                        Publish
                    </a>
    </span>
    <a href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>" class="btn btn-warning m-t-15"><i class="fa fa-arrow-left"></i></a>
    <button type="button" 
        <?php 
            if($v_getUserPlan->cr_settingValue=="basic") { 
                if($v_getDiskSizeBytes>=523239424) { 
                    echo ""; 
                } 
                else { 
        ?> onclick="location.href='<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/add'" 
        <?php 
                }
            }
            elseif($v_getUserPlan->cr_settingValue=="premium" || $v_getUserPlan->cr_settingValue=="probasic" || $v_getUserPlan->cr_settingValue=="propro" || $v_getUserPlan->cr_settingValue=="prosuper") { 
        ?> 
            onclick="location.href='<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/add'"
        <?php
            }
        ?>
        <?php 
            if($v_getUserPlan->cr_settingValue=="basic") { 
                if($v_getDiskSizeBytes>=523239424) 
                    echo "disabled"; 
                } 
        ?> class="btn btn-success m-t-15">
        <strong>Add Product</strong>
    </button>

    <div class="btn-group m-t-15 m-r-15 btn-sorting">
        <a id="sort-asc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view-name-asc" class="btn btn-inverse" title="Sort by name (ascending)"><i class="fa fa-sort-alpha-asc"></i></a>
        <a id="sort-desc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view-name-desc" class="btn btn-inverse" title="Sort by name (descending)"><i class="fa fa-sort-alpha-desc"></i></a>
        <a id="sort-desc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view-date-asc" class="btn btn-inverse" title="Sort by date (ascending)"><i class="fa fa-long-arrow-up"></i> <i class="fa fa-calendar"></i></a>
        <a id="sort-desc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view" class="btn btn-inverse active" title="Sort by date (descending)"><i class="fa fa-long-arrow-down"></i> <i class="fa fa-calendar"></i></a>
    </div>
</div>
<div id="gallery" class="gallery">
    <?php
        $i = 1;
        foreach ($v_getProduct as $data) {
            $pID            = $data->cr_productID;
            $v_getPE        = $o_getProduct->view_product_extra($pID);
            $productImage   = $data->cr_productThumb;
            $pclink         = create_slug($data->cr_productcategoryName);
            $pstatus        = $data->cr_portfolioStatus;
            $v_getLikes     = $o_getProduct->count_likes($pID);
            $v_getViewers   = $o_getProduct->count_visitor($pID);
            $portfolioDate  = date($v_getDateFormat->cr_settingValue." ".$v_getTimeFormat->cr_settingValue, strtotime($data->cr_productDate));
            //change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
            $productImageGIF  = str_replace(".png",".gif",$productImage);
            $productImageJPG  = str_replace(".png",".jpg",$productImage);
            $productImageJPEG = str_replace(".png",".jpeg",$productImage);
            //remove "/thumbnails" to get the real image
            $productImagent     = str_replace('/cr-editor/_thumbs/Images/','',$productImage);
            $productImageGIFnt  = str_replace('/cr-editor/_thumbs/Images/','',$productImageGIF);
            $productImageJPGnt  = str_replace('/cr-editor/_thumbs/Images/','',$productImageJPG);
            $productImageJPEGnt = str_replace('/cr-editor/_thumbs/Images/','',$productImageJPEG);

            $productImageLink     = MURL.'/cr-editor/images/'.$productImagent;
            $productImageGIFLink  = MURL.'/cr-editor/images/'.$productImageGIFnt;
            $productImageJPGLink  = MURL.'/cr-editor/images/'.$productImageJPGnt;
            $productImageJPEGLink = MURL.'/cr-editor/images/'.$productImageJPEGnt;

            if(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$productImagent)) { 
                $image_path =  $productImageLink; 
            } 
            elseif(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$productImageGIFnt)) { 
                $image_path =  $productImageGIFLink; 
            } 
            elseif(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$productImageJPGnt)) {
                $image_path =  $productImageJPGLink; 
            } 
            elseif(file_exists($_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$productImageJPEGnt)) { 
                $image_path =  $productImageJPEGLink; 
            } 
    ?>
            <div class="image <?php echo $pclink ?> <?php if($pstatus=="draft") echo "draft-product"; elseif($pstatus=="publish") echo "publish-product"; ?>">
                <div class="image-inner">
                    <a href="<?php echo $image_path ?>" data-lightbox="<?php echo $pclink; ?>" data-title="asdasd">
                        <img src="<?php echo MURL.$productImage ?>" alt="<?php echo $data->cr_productTitle ?>" />
                    </a>
                    <p class="image-caption <?php if($pstatus=="draft") echo "bg-aqua"; elseif($pstatus=="publish") echo "bg-black"; ?>">
                        #<?php echo $i ?> - <?php echo $data->cr_productcategoryName ?>
                    </p>
                    <span class="text-center portfolio-actbutton">
                        <button type="button" class="btn btn-success btn-icon btn-circle" 
                        <?php 
                            if($v_getUserPlan->cr_settingValue=="basic") { 
                                if($v_getDiskSizeBytes>=523239424) { 
                                    echo ""; 
                                } 
                                else { 
                        ?> onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/edit/<?php echo $data->cr_portfolioID; ?>'" 
                        <?php 
                                }
                            } 
                            elseif($v_getUserPlan->cr_settingValue=="premium" || $v_getUserPlan->cr_settingValue=="probasic" || $v_getUserPlan->cr_settingValue=="propro" || $v_getUserPlan->cr_settingValue=="prosuper") {
                        ?> 
                            onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/edit/<?php echo $data->cr_productID; ?>'" 
                        <?php
                            }
                        ?>
                        <?php 
                            if($v_getUserPlan->cr_settingValue=="basic") { 
                                if($v_getDiskSizeBytes>=523239424) 
                                    echo "disabled"; 
                                } 
                        ?>><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-primary btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Extra Content" data-placement="top" data-content="This product has <?php if($v_getPE==0) echo "no extra content."; elseif($v_getPE==1) echo "1 extra content."; else echo $v_getPE." extra contents.";  ?>" 
                        <?php 
                            if($v_getUserPlan->cr_settingValue=="basic") { 
                                if($v_getDiskSizeBytes>=523239424) { 
                                    echo ""; 
                                } 
                                else { 
                        ?> onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/extra/<?php echo $data->cr_productID; ?>'" 
                        <?php 
                                }
                            }
                            elseif($v_getUserPlan->cr_settingValue=="premium" || $v_getUserPlan->cr_settingValue=="probasic" || $v_getUserPlan->cr_settingValue=="propro" || $v_getUserPlan->cr_settingValue=="prosuper") {  
                        ?> 
                            onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/extra/<?php echo $data->cr_portfolioID; ?>'" 
                        <?php
                            }
                        ?>
                        <?php 
                            if($v_getUserPlan->cr_settingValue=="basic") { 
                                if($v_getDiskSizeBytes>=523239424) 
                                    echo "disabled"; 
                                } 
                        ?>><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-default btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="User Reviews" data-placement="top" data-content="Manage user reviews" onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/reviews/<?php echo $data->cr_productID; ?>'" <?php if($data->cr_productAllowreviews=="no") echo 'disabled'; ?>><i class="fa fa-users"></i></button>
                        <button type="button" class="btn btn-warning btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Preview" data-placement="top" data-content="Preview this e-commerce product on your site" onclick="window.open('<?php echo MURL; ?>/<?php echo $pagelink ?>/<?php echo $data->cr_productLink; ?>', '_blank');" <?php if($data->cr_productStatus=="draft") echo "disabled"; else echo ""; ?>><i class="fa fa-external-link"></i></button>
                        <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-toggle="modal" data-nm="<?php echo $data->cr_productTitle; ?>" data-pc="<?php echo $data->cr_productcategoryName; ?>" data-hapus="<?php echo $data->cr_productID; ?>"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <div class="image-info getheight">
                        <h5 class="title name" <?php if($pstatus=="draft") echo 'style="color: #49B6D6"'; ?>><?php echo $data->cr_productTitle ?></h5>
                        <div class="pull-right">
                            <small>by</small> <a><?php echo ucwords($data->cr_adminDisplayName) ?></a>
                        </div>
                        <div class="rating">
                            <i class="fa fa-heart"></i> <?php echo $v_getLikes ?>
                            <i class="fa fa-eye m-l-10"></i> <?php echo $v_getViewers ?><br>
                            <i class="fa fa-calendar"> <?php echo $portfolioDate ?></i>
                        </div>
                        <div class="desc">
                            <?php
                                $dec    = strip_tags($data->cr_productDesc);
                                $subdec = strlen($dec);
                                if($subdec<=60) {
                                    echo $dec;
                                }
                                else {
                                    echo substr($dec,0,60)."..."; 
                                }
                            ?>
                        </div>
                </div>
            </div>
    <?php
            $i++;
        }
    ?>
            <div class="image <?php foreach ($v_getPC as $data) { echo urlLink($data->cr_productcategoryName)." "; } ?> draft-product publish-product">
                    <div class="image-inner">
                        <a href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/add">
                            <img src="<?php echo MADMINURL ?>/assets/img/add.png" alt="" />
                        </a>
                    </div>
                    <div class="image-info applyheight">
                        <h5 class="title">Add New E-Commerce Product</h5>
                        <div class="desc">
                            Click here to add new e-commerce product in <?php echo ucwords($pagelink) ?>'s page.
                        </div>
                    </div>
                </div>
                
</div>

<!-- #delete-dialog -->
<div class="modal fade" id="delete-dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title text-white">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete <span id="nm"></span> in <span id="pc"></span>?</p>
                <?php
                    if (isset ($_POST['hapus'])) {
                        //Delete Handler
                        $deleteit     = sha1("deleteit");
                        $productID  = $_POST['productID'];
                        $adminLoginID = $_POST['adminLoginID'];
                        $v_del_product = $o_getProduct->delete_product($productID, $adminLoginID);
                            header("Location: $madinurl/page/$pagelink/view"); 
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="productID" value="" id="delete">
                    <input type="hidden" name="adminLoginID" value="<?php echo $cradminID_session ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" name="hapus">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
        $(document).ready(function() {
            var set_height = setInterval(
                function () {
                    var ert = $(".getheight").outerHeight()+"px";
                    $(".applyheight").css("height", ert);
                }, 500
            );
            $('#delete-dialog').on('show.bs.modal', function(e) {
                $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
                $(this).find('#nm').html($(e.relatedTarget).data('nm'));
                $(this).find('#pc').html($(e.relatedTarget).data('pc'));
            });
        });
            
</script>