<?php
	if(!isset($_SESSION)) {
        session_start();
    }
    require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$class_primary_footer     = new Primary_Footer($pdo);
    $class_portfolio_category = new Portfolio_Category($pdo);
    $class_blog               = new Blog($pdo);
    $class_menu               = new Menu($pdo);
    $all_portfolio_category   = $class_portfolio_category->view_all_portfolio_category();
    $pfid                 = $_POST['pfid'];
    $primary_footer_query = $class_primary_footer->view_primary_footer_query($pfid);
?>
		<input type="hidden" name="footer_id" value="<?php echo $pfid ?>">
<?php
    if($primary_footer_query->cr_footerType == "customtext") {        
?>
		<input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
        <div class="note note-info">
            Use <code>&lt;h2 class="title"&gt;&lt;/h2&gt;</code> to add new title, press <kbd>shift</kbd> + <kbd>Enter</kbd> to make a new line in a paragraph.
        </div>
        <div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="ct-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Text</label>
            <textarea id="ct-pf-text" class="form-control" name="ct-pf-text" placeholder="Write here..." rows="5" data-parsley-minlength="3" data-parsley-maxlength="1000"><?php echo $primary_footer_query->cr_footerContent ?></textarea>
            <script type="text/javascript">
            	CKEDITOR.replace( 'ct-pf-text', {
		            toolbar: [
		                { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		                [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],      // Line break - next group will be placed in new line.
		                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Blockquote' ] },
		                    '/',
		                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		                { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
		                { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
		                { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
		                { name: 'others', items: [ '-' ] }
		            ]
		        });
            </script>
        </div>
<?php
	}
	elseif($primary_footer_query->cr_footerType == "portfolio") {
		$contentexplode = explode(",", $primary_footer_query->cr_footerContent);
		$pcID           = $contentexplode[0];
		$portfolioShow  = $contentexplode[1];
?>
		<input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
		<div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="lp-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Select Category</label>
            <select class="form-control" name="lp-pf-category">
                <option value="">Select Category</option>
                <option value="0" <?php if($pcID == '0') echo 'selected="selected"' ?>>All Category</option>
                <?php
                    foreach ($all_portfolio_category as $data) {
                ?>
                <option value="<?php echo $data->cr_portfoliocategoryID ?>" <?php if($data->cr_portfoliocategoryID == $pcID) echo 'selected="selected"' ?>><?php echo $data->cr_portfoliocategoryName ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Showing Portfolios or Products</label>
            <select class="form-control" name="lp-pf-showing">
                <option value="">Select Showing Portfolio or Products</option>
                <option value="4" <?php if($portfolioShow == "4") echo 'selected="selected"' ?>>4</option>
                <option value="8" <?php if($portfolioShow == "8") echo 'selected="selected"' ?>>8</option>
                <option value="12" <?php if($portfolioShow == "12") echo 'selected="selected"' ?>>12</option>
            </select>
        </div>
<?php
	}
    elseif($primary_footer_query->cr_footerType == "blog") {
        $v_getBCiM      = $class_blog->view_blog_page_in_menu();
        $v_getBCiS      = $class_blog->view_blog_page_in_submenu();
        $contentexplode = explode(",", $primary_footer_query->cr_footerContent);
        $pageID         = $contentexplode[0];
        $catID          = $contentexplode[1];
        $showing        = $contentexplode[2];
?>
        <input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
        <div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="lb-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Select Page</label>
            <select id="blogpage2" class="form-control" name="lb-pf-page">
                <option value="">Select Page</option>
                <?php
                    foreach($v_getBCiM as $data) {
                ?>
                <option value="m<?php echo $data->cr_menuID ?>" <?php if("m".$data->cr_menuID == $pageID) echo 'selected="selected"' ?>><?php echo $data->cr_menuTitle ?></option>
                <?php
                    }
                    foreach($v_getBCiS as $data) {
                ?>
                <option value="s<?php echo $data->cr_submenuID ?>" <?php if("s".$data->cr_submenuID == $pageID) echo 'selected="selected"' ?>><?php echo $data->cr_submenuTitle ?></option>
                <?php
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Select Category</label>
            <select id="blogcategory2" class="form-control" name="lb-pf-category">
                <option value="">Select Category</option>
            </select>
            <p>Current category : <strong><?php if($catID == 0) echo 'All'; else echo $v_getBlogCurrentCat = $class_blog->view_blog_current_cat($catID) ?></strong></p>
        </div>
        <div class="form-group">
            <label class="control-label">Showing Blogs</label>
            <select class="form-control" name="lb-pf-showing">
                <option value="">Select Showing Blogs</option>
                <option value="3" <?php if($showing == "3") echo 'selected="selected"' ?>>3</option>
                <option value="4" <?php if($showing == "4") echo 'selected="selected"' ?>>4</option>
                <option value="5" <?php if($showing == "5") echo 'selected="selected"' ?>>5</option>
                <option value="6" <?php if($showing == "6") echo 'selected="selected"' ?>>6</option>
                </select>
        </div>
<?php
    }
    elseif($primary_footer_query->cr_footerType == "tour") {
        $contentexplode = explode(",", $primary_footer_query->cr_footerContent);
        $position       = $contentexplode[0];
        $page           = $contentexplode[1];
        $showing        = $contentexplode[2];
?>
        <input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
        <div class="form-group">
            <label class="control-label">Title</label>
            <input id="blogtitle" class="form-control" placeholder="Title" type="text" name="lt-pf-title" data-parsley-minlength="3" data-parsley-maxlength="30" value="<?php echo $primary_footer_query->cr_footerTitle ?>" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Select Page</label>
            <select id="blogpage" class="form-control" name="lt-pf-page">
                <option value="">Select Page</option>
                <?php
                    $function_view_menu_for_tour = $class_menu->view_menu_for_tour();
                    if($function_view_menu_for_tour != false) {
                ?>
                <optgroup label="Menu">
                    <?php
                        foreach($function_view_menu_for_tour as $menu) {
                            if($position.','.$page == 'menu,'.$menu->cr_menuID)
                                $selected = 'selected="selected"';
                            else 
                                $selected = '';
                            echo '<option value="menu,'.$menu->cr_menuID.'" '.$selected.'>'.$menu->cr_menuTitle.'</option>';
                        }
                    ?>  
                </optgroup>
                <?php
                    }
                    $function_view_submenu_for_tour = $class_menu->view_submenu_for_tour();
                    if($function_view_submenu_for_tour != false) {
                ?>
                <optgroup label="Submenu">
                    <?php
                        foreach($function_view_submenu_for_tour as $submenu) {
                            if($position.','.$page == 'submenu,'.$submenu->cr_submenuID)
                                $selected = 'selected="selected"';
                            else 
                                $selected = '';
                            echo '<option value="submenu,'.$submenu->cr_submenuID.'" '.$selected.'>'.$submenu->cr_submenuTitle.'</option>';
                        }
                    ?>  
                </optgroup>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label">Showing Tour Packages</label>
            <select id="blogtotal" class="form-control" name="lt-pf-total">
                <option value="">Select Showing Tour Packages</option>
                <option value="3" <?php if($showing == "3") echo 'selected="selected"' ?>>3</option>
                <option value="4" <?php if($showing == "4") echo 'selected="selected"' ?>>4</option>
                <option value="5" <?php if($showing == "5") echo 'selected="selected"' ?>>5</option>
                <option value="6" <?php if($showing == "6") echo 'selected="selected"' ?>>6</option>
            </select>
        </div>
<?php
    }
	elseif($primary_footer_query->cr_footerType == "gallery") {
?>
		<input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
		<div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="lg-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Showing Gallery</label>
            <select class="form-control" name="lg-pf-showing">
                <option value="">Select Showing Gallery</option>
                <option value="4" <?php if($primary_footer_query->cr_footerContent == "4") echo 'selected="selected"' ?>>4</option>
                <option value="8" <?php if($primary_footer_query->cr_footerContent == "8") echo 'selected="selected"' ?>>8</option>
                <option value="12" <?php if($primary_footer_query->cr_footerContent == "12") echo 'selected="selected"' ?>>12</option>
            </select>
        </div>
<?php
	}
	elseif($primary_footer_query->cr_footerType == "social") {
?>	
		<input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
		<div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="sc-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Description</label>
            <textarea class="form-control" name="sc-pf-desc" placeholder="Write here..." rows="5" data-parsley-maxlength="500"><?php echo $primary_footer_query->cr_footerContent ?></textarea>
        </div>
<?php
	}
	elseif($primary_footer_query->cr_footerType == "instafeed") {
?>	
		<input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
		<div class="alert alert-info fade in m-b-15">
            Make sure you've set your Instagram user ID and access token from <a href="<?php echo MADMINURL."/social" ?>"><span class="badge badge-success badge-square">social</span></a> menu. Only one column can be filled with Instagram Feed.
        </div>
        <div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="if-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
            </div>
        <div class="form-group">
            <label class="control-label">Showing Photos</label>
            <select class="form-control" name="if-pf-showing">
                <option value="">Select Showing Photos</option>
                <option value="4" <?php if($primary_footer_query->cr_footerContent == "4") echo "selected=selected" ?>>4</option>
                <option value="8"<?php if($primary_footer_query->cr_footerContent == "8") echo "selected=selected" ?>>8</option>
                <option value="12"<?php if($primary_footer_query->cr_footerContent == "12") echo "selected=selected" ?>>12</option>
            </select>
        </div>
<?php
	}
	elseif($primary_footer_query->cr_footerType == "twitter") {
?>	
		<input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
		<div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="tf-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Widget Script</label>
            <textarea class="form-control" name="tf-pf-text" placeholder="Paste script here..." rows="5" data-parsley-minlength="3" data-parsley-maxlength="1000"><?php echo $primary_footer_query->cr_footerContent ?></textarea>
        </div>
<?php
	}
	elseif($primary_footer_query->cr_footerType == "facebookpage") {
?>	
		<input type="hidden" name="pftype2" value="<?php echo $primary_footer_query->cr_footerType ?>">
		<div class="form-group">
            <label class="control-label">Title</label>
            <input class="form-control" placeholder="Title" type="text" name="fp-pf-title" value="<?php echo $primary_footer_query->cr_footerTitle ?>" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
        </div>
        <div class="form-group">
            <label class="control-label">Widget Script</label>
            <textarea class="form-control" name="fp-pf-text" placeholder="Paste script here..." rows="5" data-parsley-minlength="3" data-parsley-maxlength="1000"><?php echo $primary_footer_query->cr_footerContent ?></textarea>
        </div>
<?php
	}
?>	