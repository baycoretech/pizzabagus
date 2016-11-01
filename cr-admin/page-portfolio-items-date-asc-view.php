<?php
    $pagelink = $_GET['s'];
    $pc       = $_GET['id'];
    $o_getPC  = new portfoliocategory($pdo);
    $v_getPC  = $o_getPC->viewPortfoliocategory($pagelink);
    $o_getPortfolio  = new portfolio($pdo);
    $v_getPortfolio  = $o_getPortfolio->viewPortfoliodateASC($pagelink);
?>
<div id="options" class="m-b-10">
    
    <span class="gallery-option-set" id="filter" data-option-key="filter">
                    <a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
                        Show All
                    </a>
                    <?php
                        foreach ($v_getPC as $data) {
                            $pclink = create_slug($data->cr_portfoliocategoryName);
                    ?>
                    <a href="#<?php echo $pclink; ?>" class="btn btn-default btn-xs" data-option-value=".<?php echo $pclink; ?>">
                        <?php echo $data->cr_portfoliocategoryName; ?>
                    </a>
                    <?php
                        }
                    ?>
    </span>
    <a href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>" class="btn btn-warning m-t-15"><i class="fa fa-arrow-left"></i></a>
    <a href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/add" class="btn btn-success m-t-15">
        <strong>Add Portfolio or Product</strong>
    </a>

    <div class="btn-group m-t-15 m-r-15 pull-right">
        <a id="sort-asc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view-name-asc" class="btn btn-inverse" title="Sort by name (ascending)"><i class="fa fa-sort-alpha-asc"></i></a>
        <a id="sort-desc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view-name-desc" class="btn btn-inverse" title="Sort by name (descending)"><i class="fa fa-sort-alpha-desc"></i></a>
        <a id="sort-desc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view-date-asc" class="btn btn-inverse active" title="Sort by date (ascending)"><i class="fa fa-long-arrow-up"></i> <i class="fa fa-calendar"></i></a>
        <a id="sort-desc" href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/view" class="btn btn-inverse" title="Sort by date (descending)"><i class="fa fa-long-arrow-down"></i> <i class="fa fa-calendar"></i></a>
    </div>
</div>
<div id="gallery" class="gallery">
    <?php
        $i = 1;
        foreach ($v_getPortfolio as $data) {
            $pID            = $data->cr_portfolioID;
            $v_getPE        = $o_getPortfolio->viewPortfolioExtra($pID);
            if($data->cr_portfolioCustomthumb=='') {
                $portfolioImage = $data->cr_portfolioThumb;
            }
            else {
                $portfolioImage = $data->cr_portfolioCustomthumb;
            }
            $pclink         = create_slug($data->cr_portfoliocategoryName);
            $v_getLikes     = $o_getPortfolio->countLikes($pID);
            $v_getViewers   = $o_getPortfolio->countVisitor($pID);
            $portfolioDate  = date($v_getDateFormat->cr_settingValue." ".$v_getTimeFormat->cr_settingValue, strtotime($data->cr_portfolioDate));
            //change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
            $portfolioImageGIF  = str_replace(".png",".gif",$portfolioImage);
            $portfolioImageJPG  = str_replace(".png",".jpg",$portfolioImage);
            $portfolioImageJPEG = str_replace(".png",".jpeg",$portfolioImage);
            //remove "/thumbnails" to get the real image
            $portfolioImagent     = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$portfolioImage;
            $portfolioImageGIFnt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$portfolioImageGIF;
            $portfolioImageJPGnt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$portfolioImageJPG;
            $portfolioImageJPEGnt = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'/cr-editor/images/'.$portfolioImageJPEG;

            $portfolioImageLink     = MURL.'/cr-editor/images/'.$portfolioImage;
            $portfolioImageGIFLink  = MURL.'/cr-editor/images/'.$portfolioImageGIF;
            $portfolioImageJPGLink  = MURL.'/cr-editor/images/'.$portfolioImageJPG;
            $portfolioImageJPEGLink = MURL.'/cr-editor/images/'.$portfolioImageJPEG;

            if(file_exists($portfolioImagent)) { 
                $image_path =  $portfolioImageLink; 
            } 
            elseif(file_exists($portfolioImageGIFnt)) { 
                $image_path =  $portfolioImageGIFLink; 
            } 
            elseif(file_exists($portfolioImageJPGnt)) {
                $image_path =  $portfolioImageJPGLink; 
            } 
            elseif(file_exists($portfolioImageJPEGnt)) { 
                $image_path =  $portfolioImageJPEGLink; 
            } 
    ?>
            <div class="image <?php echo $pclink; ?>">
                <div class="image-inner">
                    <a href="<?php echo $image_path ?>" data-lightbox="<?php echo $pclink; ?>">
                        <img src="<?php echo MURL.'/cr-editor/_thumbs/Images/'.$portfolioImage ?>" alt="<?php echo $data->cr_portfolioTitle ?>" />
                    </a>
                    <p class="image-caption">
                        #<?php echo $i ?> - <?php echo $data->cr_portfoliocategoryName ?>
                    </p>
                    <span class="text-center portfolio-actbutton">
                        <button type="button" class="btn btn-success btn-icon btn-circle" onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/edit/<?php echo $data->cr_portfolioID; ?>'"><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn btn-primary btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Extra Content" data-placement="top" data-content="This portfolio/product has <?php if($v_getPE==0) echo "no extra content."; elseif($v_getPE==1) echo "1 extra content."; else echo $v_getPE." extra contents.";  ?>" onclick="location.href='<?php echo MADMINURL; ?>/page/<?php echo $pagelink ?>/extra/<?php echo $data->cr_portfolioID; ?>'"><i class="fa fa-plus"></i></button>
                        <button type="button" class="btn btn-warning btn-icon btn-circle" data-trigger="hover focus"  data-toggle="popover" data-container="body" title="Preview" data-placement="top" data-content="Preview this portfolio or product on your site" onclick="window.open('<?php echo MURL; ?>/<?php echo $pagelink ?>/<?php echo $data->cr_portfolioLink; ?>', '_blank');" <?php if($data->cr_portfolioStatus=="draft") echo "disabled"; else echo ""; ?>><i class="fa fa-external-link"></i></button>
                        <button type="button" class="btn btn-danger btn-icon btn-circle" data-target="#delete-dialog" data-toggle="modal" data-nm="<?php echo $data->cr_portfolioTitle; ?>" data-pc="<?php echo $data->cr_portfoliocategoryName; ?>" data-hapus="<?php echo $data->cr_portfolioID; ?>"><i class="fa fa-times"></i></button>
                    </span>
                </div>
                <div class="image-info">
                        <h5 class="title name"><?php echo $data->cr_portfolioTitle ?></h5>
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
                                $dec    = strip_tags($data->cr_portfolioDesc);
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
            <div class="image <?php foreach ($v_getPC as $data) { echo urlLink($data->cr_portfoliocategoryName)." "; } ?>">
                    <div class="image-inner">
                        <a href="<?php echo MADMINURL ?>/page/<?php echo $pagelink ?>/add">
                            <img src="<?php echo MADMINURL ?>/assets/img/add.png" alt="" />
                        </a>
                    </div>
                    <div class="image-info">
                        <h5 class="title">Add New Portfolio or Product</h5>
                        <div class="desc">
                            Click here to add new portfolio or product in <?php echo ucwords($pagelink) ?>'s page.
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
                        $portfolioID  = $_POST['portfolioID'];
                        $adminLoginID = $_POST['adminLoginID'];
                        $v_delPortfolio = $o_getPortfolio->deletePortfolio($portfolioID, $adminLoginID);
                            header("Location: $madinurl/page/$pagelink/view"); 
                    } 
                ?>
                <form action="" method="post">
                    <input type="hidden" name="portfolioID" value="" id="delete">
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

            $('#delete-dialog').on('show.bs.modal', function(e) {
                $(this).find('#delete').attr('value', $(e.relatedTarget).data('hapus'));
                $(this).find('#nm').html($(e.relatedTarget).data('nm'));
                $(this).find('#pc').html($(e.relatedTarget).data('pc'));
            });
        });
            
</script>