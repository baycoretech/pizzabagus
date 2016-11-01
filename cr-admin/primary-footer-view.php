<?php
    $class_primary_footer     = new Primary_Footer($pdo);
    $class_portfolio_category = new Portfolio_Category($pdo);
    $class_blog       = new Blog($pdo);
    $primary_footer_1 = $class_primary_footer->view_primary_footer_1();
    $primary_footer_2 = $class_primary_footer->view_primary_footer_2();
    $primary_footer_3 = $class_primary_footer->view_primary_footer_3();
    $primary_footer_4 = $class_primary_footer->view_primary_footer_4();
    $all_portfolio_category = $class_portfolio_category->view_all_portfolio_category();
    $blog_page_in_menu      = $class_blog->view_blog_page_in_menu();
    $blog_page_in_submenu   = $class_blog->view_blog_page_in_submenu();
    $total_instafeed = $class_primary_footer->view_total_instafeed();
    $fourth_column   = $class_settings->view_settings_fourth_column_pf();
?>
<div class="row">
    <!-- begin col-9 -->
    <div class="col-md-9">
        <!-- begin panel -->
        <div class="panel-group" id="accordion">
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Primary Footer First Column
                        </a>
                    </h3>
                </div>
                <div style="" aria-expanded="true" id="collapseOne" class="panel-collapse collapse in">
                    <?php
                        if($primary_footer_1  ==  false) {
                    ?>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success m-b-5" data-target="#modal-add-primary-footer" data-toggle="modal" data-footername="1"><i class="fa fa-plus"></i> Add Data</button>
                    </div>
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <strong>Empty!</strong>
                        You have not yet set the first column in the primary footer.
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                    <?php
                        }
                        else {
                    ?> 
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success button-modal-primary-footer m-b-5" data-target="#modal-edit-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_1->cr_footerID ?>"><i class="fa fa-pencil"></i> Edit</button>
                        <button type="button" class="btn btn-danger m-b-5" data-target="#modal-delete-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_1->cr_footerID ?>"><i class="fa fa-times"></i> Delete</button>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal m-t-10">
                            <dt>Content Type</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_1->cr_footerType == "customtext")
                                            echo "Custom Text";
                                        elseif($primary_footer_1->cr_footerType == "portfolio")
                                            echo "Portfolio or Product";
                                        elseif($primary_footer_1->cr_footerType == "blog")
                                            echo "Blogs";
                                        elseif($primary_footer_1->cr_footerType == "gallery")
                                            echo "Gallery";
                                        elseif($primary_footer_1->cr_footerType == "social")
                                            echo "Available Social Media";
                                         elseif($primary_footer_1->cr_footerType == "instafeed")
                                            echo "Instagram Feed";
                                        elseif($primary_footer_1->cr_footerType == "twitter")
                                            echo "Twitter Feed";
                                        elseif($primary_footer_1->cr_footerType == "facebookpage")
                                            echo "Facebook Page";
                                        elseif($primary_footer_1->cr_footerType == "tour")
                                            echo "Tour Packages";
                                    ?>
                                </dd>
                            <hr>
                            <dt>Title</dt>
                                <dd>
                                    <?php 
                                        echo $primary_footer_1->cr_footerTitle
                                    ?>
                                </dd>
                            <hr>
                            <dt>Content</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_1->cr_footerType == "customtext")  {
                                            echo $primary_footer_1->cr_footerContent;
                                        }
                                        elseif($primary_footer_1->cr_footerType == "portfolio") {
                                            $ex = explode(",", $primary_footer_1->cr_footerContent);
                                            $ex1 = $ex[0];
                                            $ex2 = $ex[1];
                                            if($ex1  ==  '0') {
                                                $pcategory = 'all';
                                            }
                                            else {
                                                $pf_pc = $class_primary_footer->view_primary_footer_portfolio_category($ex1);
                                                $pcategory = $pf_pc->cr_portfoliocategoryName;
                                            }
                                            
                                            echo "Showing the latest ".$ex2." portfolio items from ".strtolower($pcategory)." category.";
                                        }
                                        elseif($primary_footer_1->cr_footerType == "blog") {
                                            $ex = explode(",", $primary_footer_1->cr_footerContent);
                                            $ex1 = $ex[0];//page
                                            $ex2 = $ex[1];//cat
                                            $ex3 = $ex[2];//total
                                            $pf_bc = $class_primary_footer->view_primary_footer_blog_category($ex2);
                                            $pf_bp = $class_primary_footer->view_primary_footer_blog_page($ex1);
                                            if($ex2 == "0") {
                                                $bcat = "all";
                                            }
                                            else {
                                                $bcat = ucwords($pf_bc->cr_blogcategoryName);
                                            }
                                            echo "Showing ".$ex3." blog posts from ".$bcat." category in page ".ucwords($pf_bp).".";
                                        }
                                        elseif($primary_footer_1->cr_footerType == "tour") {
                                            $ex = explode(",", $primary_footer_1->cr_footerContent);
                                            $ex1 = $ex[0];//position
                                            $ex2 = $ex[1];//page
                                            $ex3 = $ex[2];//total
                                            $pf_tp = $class_primary_footer->view_primary_footer_tour_page($ex1, $ex2);
                                            echo "Showing ".$ex3." tour packages in page ".ucwords($pf_tp).".";
                                        }
                                        elseif($primary_footer_1->cr_footerType == "gallery") {
                                            echo "Showing the latest ".$primary_footer_1->cr_footerContent." items from gallery.";
                                        }
                                        elseif($primary_footer_1->cr_footerType == "social") {
                                            echo "Showing available social media.";
                                        }
                                        elseif($primary_footer_1->cr_footerType == "instafeed") {
                                            echo "Showing the latest ".$primary_footer_1->cr_footerContent." photos from your instagram.";
                                        }
                                        elseif($primary_footer_1->cr_footerType == "twitter") {
                                            echo "Showing your twitter feed.";
                                        }
                                        elseif($primary_footer_1->cr_footerType == "facebookpage") {
                                            echo "Showing your facebook page.";
                                        }
                                    ?>
                                </dd>
                        </dl>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Primary Footer Second Column
                        </a>
                    </h3>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseTwo" class="panel-collapse collapse">
                    <?php
                        if($primary_footer_2 == 0) {
                    ?>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success m-b-5" data-target="#modal-add-primary-footer" data-toggle="modal" data-footername="2"><i class="fa fa-plus"></i> Add Data</button>
                    </div>
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <strong>Empty!</strong>
                        You have not yet set the second column in the primary footer.
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                    <?php
                        }
                        else {
                    ?>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success button-modal-primary-footer m-b-5" data-target="#modal-edit-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_2->cr_footerID ?>"><i class="fa fa-pencil"></i> Edit</button>
                        <button type="button" class="btn btn-danger m-b-5" data-target="#modal-delete-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_2->cr_footerID ?>"><i class="fa fa-times"></i> Delete</button>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal m-t-10">
                            <dt>Content Type</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_2->cr_footerType == "customtext")
                                            echo "Custom Text";
                                        elseif($primary_footer_2->cr_footerType == "portfolio")
                                            echo "Portfolio or Product";
                                        elseif($primary_footer_2->cr_footerType == "blog")
                                            echo "Blogs";
                                        elseif($primary_footer_2->cr_footerType == "gallery")
                                            echo "Gallery";
                                        elseif($primary_footer_2->cr_footerType == "social")
                                            echo "Available Social Media";
                                        elseif($primary_footer_2->cr_footerType == "instafeed")
                                            echo "Instagram Feed";
                                        elseif($primary_footer_2->cr_footerType == "twitter")
                                            echo "Twitter Feed";
                                        elseif($primary_footer_2->cr_footerType == "facebookpage")
                                            echo "Facebook Page";
                                        elseif($primary_footer_2->cr_footerType == "tour")
                                            echo "Tour Packages";
                                    ?>
                                </dd>
                            <hr>
                            <dt>Title</dt>
                                <dd>
                                    <?php 
                                        echo $primary_footer_2->cr_footerTitle
                                    ?>
                                </dd>
                            <hr>
                            <dt>Content</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_2->cr_footerType == "customtext") {
                                            echo $primary_footer_2->cr_footerContent;
                                        }
                                        elseif($primary_footer_2->cr_footerType == "portfolio") {
                                            $ex = explode(",", $primary_footer_2->cr_footerContent);
                                            $ex1 = $ex[0];
                                            $ex2 = $ex[1];
                                            if($ex1  ==  '0') {
                                                $pcategory = 'all';
                                            }
                                            else {
                                                $pf_pc = $class_primary_footer->view_primary_footer_portfolio_category($ex1);
                                                $pcategory = $pf_pc->cr_portfoliocategoryName;
                                            }
                                            
                                            echo "Showing the latest ".$ex2." portfolio items from ".strtolower($pcategory)." category.";
                                        }
                                        elseif($primary_footer_2->cr_footerType == "blog") {
                                            $ex = explode(",", $primary_footer_2->cr_footerContent);
                                            $ex1 = $ex[0];//page
                                            $ex2 = $ex[1];//cat
                                            $ex3 = $ex[2];//total
                                            $pf_bc = $class_primary_footer->view_primary_footer_blog_category($ex2);
                                            $pf_bp = $class_primary_footer->view_primary_footer_blog_page($ex1);
                                            if($ex2 == "0") {
                                                $bcat = "all";
                                            }
                                            else {
                                                $bcat = ucwords($pf_bc->cr_blogcategoryName);
                                            }
                                            echo "Showing ".$ex3." blog posts from ".$bcat." category in page ".ucwords($pf_bp).".";
                                        }
                                        elseif($primary_footer_2->cr_footerType == "tour") {
                                            $ex = explode(",", $primary_footer_2->cr_footerContent);
                                            $ex1 = $ex[0];//position
                                            $ex2 = $ex[1];//page
                                            $ex3 = $ex[2];//total
                                            $pf_tp = $class_primary_footer->view_primary_footer_tour_page($ex1, $ex2);
                                            echo "Showing ".$ex3." tour packages in page ".ucwords($pf_tp).".";
                                        }
                                        elseif($primary_footer_2->cr_footerType == "gallery") {
                                            echo "Showing the latest ".$primary_footer_2->cr_footerContent." items from gallery.";
                                        }
                                        elseif($primary_footer_2->cr_footerType == "social") {
                                            echo "Showing available social media.";
                                        }
                                        elseif($primary_footer_2->cr_footerType == "instafeed") {
                                            echo "Showing the latest ".$primary_footer_2->cr_footerContent." photos from your instagram.";
                                        }
                                        elseif($primary_footer_2->cr_footerType == "twitter") {
                                            echo "Showing your twitter feed.";
                                        }
                                        elseif($primary_footer_2->cr_footerType == "facebookpage") {
                                            echo "Showing your facebook page.";
                                        }
                                    ?>
                                </dd>
                        </dl>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Primary Footer Third Column 
                        </a>
                    </h3>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseThree" class="panel-collapse collapse">
                    <?php
                        if($primary_footer_3 == 0) {
                    ?>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success m-b-5"  data-target="#modal-add-primary-footer" data-toggle="modal" data-footername="3"><i class="fa fa-plus"></i> Add Data</button>
                    </div>
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <strong>Empty!</strong>
                        You have not yet set the third column in the primary footer.
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                    <?php
                        }
                        else {
                    ?>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success button-modal-primary-footer m-b-5" data-target="#modal-edit-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_3->cr_footerID ?>"><i class="fa fa-pencil"></i> Edit</button>
                        <button type="button" class="btn btn-danger m-b-5" data-target="#modal-delete-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_3->cr_footerID ?>"><i class="fa fa-times"></i> Delete</button>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal m-t-10">
                            <dt>Content Type</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_3->cr_footerType == "customtext")
                                            echo "Custom Text";
                                        elseif($primary_footer_3->cr_footerType == "portfolio")
                                            echo "Portfolio or Product";
                                        elseif($primary_footer_3->cr_footerType == "blog")
                                            echo "Blogs";
                                        elseif($primary_footer_3->cr_footerType == "gallery")
                                            echo "Gallery";
                                        elseif($primary_footer_3->cr_footerType == "social")
                                            echo "Available Social Media";
                                        elseif($primary_footer_3->cr_footerType == "instafeed")
                                            echo "Instagram Feed";
                                        elseif($primary_footer_3->cr_footerType == "twitter")
                                            echo "Twitter Feed";
                                        elseif($primary_footer_3->cr_footerType == "facebookpage")
                                            echo "Facebook Page";
                                        elseif($primary_footer_3->cr_footerType == "tour")
                                            echo "Tour Packages";
                                    ?>
                                </dd>
                            <hr>
                            <dt>Title</dt>
                                <dd>
                                    <?php 
                                        echo $primary_footer_3->cr_footerTitle
                                    ?>
                                </dd>
                            <hr>
                            <dt>Content</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_3->cr_footerType == "customtext") {
                                            echo $primary_footer_3->cr_footerContent;
                                        }
                                        elseif($primary_footer_3->cr_footerType == "portfolio") {
                                            $ex = explode(",", $primary_footer_3->cr_footerContent);
                                            $ex1 = $ex[0];
                                            $ex2 = $ex[1];
                                            if($ex1  ==  '0') {
                                                $pcategory = 'all';
                                            }
                                            else {
                                                $pf_pc = $class_primary_footer->view_primary_footer_portfolio_category($ex1);
                                                $pcategory = $pf_pc->cr_portfoliocategoryName;
                                            }
                                            
                                            echo "Showing the latest ".$ex2." portfolio items from ".strtolower($pcategory)." category.";
                                        }
                                        elseif($primary_footer_3->cr_footerType == "blog") {
                                            $ex = explode(",", $primary_footer_3->cr_footerContent);
                                            $ex1 = $ex[0];//page
                                            $ex2 = $ex[1];//cat
                                            $ex3 = $ex[2];//total
                                            $pf_bc = $class_primary_footer->view_primary_footer_blog_category($ex2);
                                            $pf_bp = $class_primary_footer->view_primary_footer_blog_page($ex1);
                                            if($ex2 == "0") {
                                                $bcat = "all";
                                            }
                                            else {
                                                $bcat = ucwords($pf_bc->cr_blogcategoryName);
                                            }
                                            echo "Showing ".$ex3." blog posts from ".$bcat." category in page ".ucwords($pf_bp).".";
                                        }
                                        elseif($primary_footer_3->cr_footerType == "tour") {
                                            $ex = explode(",", $primary_footer_3->cr_footerContent);
                                            $ex1 = $ex[0];//position
                                            $ex2 = $ex[1];//page
                                            $ex3 = $ex[2];//total
                                            $pf_tp = $class_primary_footer->view_primary_footer_tour_page($ex1, $ex2);
                                            echo "Showing ".$ex3." tour packages in page ".ucwords($pf_tp).".";
                                        }
                                        elseif($primary_footer_3->cr_footerType == "gallery") {
                                            echo "Showing the latest ".$primary_footer_3->cr_footerContent." items from gallery.";
                                        }
                                        elseif($primary_footer_3->cr_footerType == "social") {
                                            echo "Showing available social media.";
                                        }
                                        elseif($primary_footer_3->cr_footerType == "instafeed") {
                                            echo "Showing the latest ".$primary_footer_3->cr_footerContent." photos from your instagram.";
                                        }
                                        elseif($primary_footer_3->cr_footerType == "twitter") {
                                            echo "Showing your twitter feed.";
                                        }
                                        elseif($primary_footer_3->cr_footerType == "facebookpage") {
                                            echo "Showing your facebook page.";
                                        }
                                    ?>
                                </dd>
                        </dl>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Primary Footer Fourth Column (<?php if($fourth_column->cr_settingValue == 'enable') echo 'Status: Enable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'Status: Disable' ?>)
                        </a>
                    </h3>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseFour" class="panel-collapse collapse">
                    <?php
                        if($primary_footer_4 == 0) {
                    ?>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success m-b-5" data-target="#modal-enable-disable-column4" data-toggle="modal"><i class="fa fa-<?php if($fourth_column->cr_settingValue == 'enable') echo 'toggle-on'; elseif($fourth_column->cr_settingValue == 'disable') echo 'toggle-off' ?>"></i> <?php if($fourth_column->cr_settingValue == 'enable') echo 'Disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'Enable' ?></button>
                        <button type="button" class="btn btn-success m-b-5"  data-target="#modal-add-primary-footer" data-toggle="modal" data-footername="4"><i class="fa fa-plus"></i> Add Data</button>
                    </div>
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <strong>Empty!</strong>
                        You have not yet set the fourth column in the primary footer.
                        <span class="close" data-dismiss="alert">×</span>
                    </div>
                    <?php
                        }
                        else {
                    ?>
                    <div class="panel-toolbar">
                        <button type="button" class="btn btn-success m-b-5" data-target="#modal-enable-disable-column4" data-toggle="modal"><i class="fa fa-<?php if($fourth_column->cr_settingValue == 'enable') echo 'toggle-on'; elseif($fourth_column->cr_settingValue == 'disable') echo 'toggle-off' ?>"></i> <?php if($fourth_column->cr_settingValue == 'enable') echo 'Disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'Enable' ?></button>
                        <button type="button" class="btn btn-success button-modal-primary-footer m-b-5" data-target="#modal-edit-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_4->cr_footerID ?>"><i class="fa fa-pencil"></i> Edit</button>
                        <button type="button" class="btn btn-danger m-b-5" data-target="#modal-delete-primary-footer" data-toggle="modal" data-footerid="<?php echo $primary_footer_4->cr_footerID ?>"><i class="fa fa-times"></i> Delete</button>
                    </div>
                    <div class="panel-body">
                        <dl class="dl-horizontal m-t-10">
                            <dt>Content Type</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_4->cr_footerType == "customtext")
                                            echo "Custom Text";
                                        elseif($primary_footer_4->cr_footerType == "portfolio")
                                            echo "Portfolio or Product";
                                        elseif($primary_footer_4->cr_footerType == "blog")
                                            echo "Blogs";
                                        elseif($primary_footer_4->cr_footerType == "gallery")
                                            echo "Gallery";
                                        elseif($primary_footer_4->cr_footerType == "social")
                                            echo "Available Social Media";
                                        elseif($primary_footer_4->cr_footerType == "instafeed")
                                            echo "Instagram Feed";
                                        elseif($primary_footer_4->cr_footerType == "twitter")
                                            echo "Twitter Feed";
                                        elseif($primary_footer_4->cr_footerType == "facebookpage")
                                            echo "Facebook Page";
                                        elseif($primary_footer_4->cr_footerType == "tour")
                                            echo "Tour Packages";
                                    ?>
                                </dd>
                            <hr>
                            <dt>Title</dt>
                                <dd>
                                    <?php 
                                        echo $primary_footer_4->cr_footerTitle
                                    ?>
                                </dd>
                            <hr>
                            <dt>Content</dt>
                                <dd>
                                    <?php
                                        if($primary_footer_4->cr_footerType == "customtext") {
                                            echo $primary_footer_4->cr_footerContent;
                                        }
                                        elseif($primary_footer_4->cr_footerType == "portfolio") {
                                            $ex = explode(",", $primary_footer_4->cr_footerContent);
                                            $ex1 = $ex[0];
                                            $ex2 = $ex[1];
                                            if($ex1  ==  '0') {
                                                $pcategory = 'all';
                                            }
                                            else {
                                                $pf_pc = $class_primary_footer->view_primary_footer_portfolio_category($ex1);
                                                $pcategory = $pf_pc->cr_portfoliocategoryName;
                                            }
                                            
                                            echo "Showing the latest ".$ex2." portfolio items from ".strtolower($pcategory)." category.";
                                        }
                                        elseif($primary_footer_4->cr_footerType == "blog") {
                                            $ex = explode(",", $primary_footer_4->cr_footerContent);
                                            $ex1 = $ex[0];//page
                                            $ex2 = $ex[1];//cat
                                            $ex3 = $ex[2];//total
                                            $pf_bc = $class_primary_footer->view_primary_footer_blog_category($ex2);
                                            $pf_bp = $class_primary_footer->view_primary_footer_blog_page($ex1);
                                            if($ex2 == "0") {
                                                $bcat = "all";
                                            }
                                            else {
                                                $bcat = ucwords($pf_bc->cr_blogcategoryName);
                                            }
                                            echo "Showing ".$ex3." blog posts from ".$bcat." category in page ".ucwords($pf_bp).".";
                                        }
                                        elseif($primary_footer_4->cr_footerType == "tour") {
                                            $ex = explode(",", $primary_footer_4->cr_footerContent);
                                            $ex1 = $ex[0];//position
                                            $ex2 = $ex[1];//page
                                            $ex3 = $ex[2];//total
                                            $pf_tp = $class_primary_footer->view_primary_footer_tour_page($ex1, $ex2);
                                            echo "Showing ".$ex3." tour packages in page ".ucwords($pf_tp).".";
                                        }
                                        elseif($primary_footer_4->cr_footerType == "gallery") {
                                            echo "Showing the latest ".$primary_footer_4->cr_footerContent." items from gallery.";
                                        }
                                        elseif($primary_footer_4->cr_footerType == "social") {
                                            echo "Showing available social media.";
                                        }
                                        elseif($primary_footer_4->cr_footerType == "instafeed") {
                                            echo "Showing the latest ".$primary_footer_4->cr_footerContent." photos from your instagram.";
                                        }
                                        elseif($primary_footer_4->cr_footerType == "twitter") {
                                            echo "Showing your twitter feed.";
                                        }
                                        elseif($primary_footer_4->cr_footerType == "facebookpage") {
                                            echo "Showing your facebook page.";
                                        }
                                    ?>
                                </dd>
                        </dl>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-9 -->
    <div class="col-md-3">
        <div class="panel-group" id="accordion-info">
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="true" class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion-info" href="#collapseInformation">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Information
                        </a>
                    </h3>
                </div>
                <div style="" aria-expanded="true" id="collapseInformation" class="panel-collapse collapse in">
                    <div class="alert alert-info no-rounded-corner m-b-0 fade in">
                        <p>
                            Primary footer has four columns. Each column can be filled with custom text, latest portfolios or products, blogs,  latest gallery, available social media, instagram feed, twitter feed, or facebook page box.
                        </p>
                        <p>You can enable or disable the fourth column primary footer. Disable it to get three column, or enable it to get four column of primary footer.</p>
                    </div>
                </div>
            </div>
            <div class="panel panel-inverse overflow-hidden">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a aria-expanded="false" class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion-info" href="#collapseAction">
                            <i class="fa fa-plus-circle pull-right"></i> 
                            Action Button
                        </a>
                    </h3>
                </div>
                <div style="height: 0px;" aria-expanded="false" id="collapseAction" class="panel-collapse collapse">
                    <div class="panel-body">
                        <p>
                            There are one button at the left side, <strong class="text-success">Add Data</strong>. Click <strong class="text-success">Add Data</strong> to add new footer data in each column. If the column contains data, then the <strong class="text-success">Add Data</strong> button the data will be replaced by the <strong class="text-danger">Delete</strong> button
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-primary-footer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Footer</h4>
            </div>
            <div class="modal-body">
                <form id="form-add-primary-footer" data-parsley-validate action="" method="POST">
                    <input type="hidden" name="footer_id" value="" id="footername">
                    <div class="form-group">
                        <legend>Footer Type</legend>
                        <label class="control-label">Select Footer Type</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="radio">
                                    <label>
                                        <input id="ct" type="radio" name="pftype" value="customtext">
                                        Custom Text
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input id="lp" type="radio" name="pftype" value="portfolio">
                                        Portfolios
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input id="lb" type="radio" name="pftype" value="blog">
                                        Blogs
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input id="lg" type="radio" name="pftype" value="gallery">
                                        Latest Gallery
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="radio">
                                    <label>
                                        <input id="sc" type="radio" name="pftype" value="social">
                                        Available Social Media
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input id="if" type="radio" name="pftype" value="instafeed" <?php if($total_instafeed >= 1) echo "disabled" ?>>
                                        Instagram Feed
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input id="tf" type="radio" name="pftype" value="twitter">
                                        Twitter Feed
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input id="fp" type="radio" name="pftype" value="facebookpage">
                                        Facebook Page
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="customtextselected">
                        <legend>Footer Data</legend>
                        <div class="note note-info">
                            Use <code>&lt;h2 class="title"&gt;&lt;/h2&gt;</code> to add new title, press <kbd>shift</kbd> + <kbd>Enter</kbd> to make a new line in a paragraph.
                        </div>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="customtexttitle" class="form-control" placeholder="Title" type="text" name="customtexttitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Text</label>
                            <textarea id="customtexttext" class="form-control" name="customtexttext" placeholder="Write here..." rows="5" data-parsley-minlength="3" data-parsley-maxlength="1000"></textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace( 'customtexttext', {
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
                    </div>

                    <div id="latestportfolioselected">
                        <legend>Footer Data</legend>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="latestportfoliotitle" class="form-control" placeholder="Title" type="text" name="latestportfoliotitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Category</label>
                            <select id="latestportfoliocategory" class="form-control" name="latestportfoliocategory">
                                <option value="">Select Category</option>
                                <option value="0">All Category</option>
                                <?php
                                    foreach ($all_portfolio_category as $data) {
                                ?>
                                <option value="<?php echo $data->cr_portfoliocategoryID ?>"><?php echo $data->cr_portfoliocategoryName ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Showing Portfolios or Products</label>
                            <select id="latestportfoliototal" class="form-control" name="latestportfoliototal">
                                <option value="">Select Showing Portfolio or Products</option>
                                <option value="4">4</option>
                                <option value="8">8</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>

                    <div id="blogselected">
                        <legend>Footer Data</legend>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="blogtitle" class="form-control" placeholder="Title" type="text" name="blogtitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Page</label>
                            <select id="blogpage" class="form-control" name="blogpage">
                                <option value="">Select Page</option>
                                <?php
                                    foreach($blog_page_in_menu as $data) {
                                ?>
                                <option value="m<?php echo $data->cr_menuID ?>"><?php echo $data->cr_menuTitle ?></option>
                                <?php
                                    }
                                    foreach($blog_page_in_submenu as $data) {
                                ?>
                                <option value="s<?php echo $data->cr_submenuID ?>"><?php echo $data->cr_submenuTitle ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Select Category</label>
                            <select id="blogcategory" class="form-control" name="blogcategory">
                                <option value="">Select Category</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Showing Blogs</label>
                            <select id="blogtotal" class="form-control" name="blogtotal">
                                <option value="">Select Showing Blogs</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>

                    <div id="latestgalleryselected">
                        <legend>Footer Data</legend>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="latestgallerytitle" class="form-control" placeholder="Title" type="text" name="latestgallerytitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Showing Gallery</label>
                            <select id="latestgallerytotal" class="form-control" name="latestgallerytotal">
                                <option value="">Select Showing Gallery</option>
                                <option value="4">4</option>
                                <option value="8">8</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>

                    <div id="socialselected">
                        <legend>Footer Data</legend>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="socialtitle" class="form-control" placeholder="Title" type="text" name="socialtitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea id="socialdescription" class="form-control" name="socialdescription" placeholder="Write here..." rows="5" data-parsley-maxlength="500"></textarea>
                        </div>
                    </div>

                    <div id="instafeedselected">
                        <legend>Footer Data</legend>
                        <div class="alert alert-info fade in m-b-15">
                            Make sure you've set your Instagram user ID and access token from <a href="<?php echo MADMINURL."social" ?>">Social</a> menu. Only one column can be filled with Instagram Feed.
                        </div>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="instafeedtitle" class="form-control" placeholder="Title" type="text" name="instafeedtitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Showing Photos</label>
                            <select id="instafeedtotal" class="form-control" name="instafeedtotal">
                                <option value="">Select Showing Photos</option>
                                <option value="4">4</option>
                                <option value="8">8</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>

                    <div id="twitterfeedselected">
                        <legend>Footer Data</legend>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="twitterfeedtitle" class="form-control" placeholder="Title" type="text" name="twitterfeedtitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Widget Script</label>
                            <textarea id="twitterfeedtext" class="form-control" name="twitterfeedtext" placeholder="Paste script here..." rows="5" data-parsley-minlength="3" data-parsley-maxlength="1000"></textarea>
                        </div>
                    </div>

                    <div id="facebookpageselected">
                        <legend>Footer Data</legend>
                        <div class="form-group">
                            <label class="control-label">Title</label>
                            <input id="facebookpagetitle" class="form-control" placeholder="Title" type="text" name="facebookpagetitle" data-parsley-minlength="3" data-parsley-maxlength="30" autofocus>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Widget Script</label>
                            <textarea id="facebookpagetext" class="form-control" name="facebookpagetext" placeholder="Paste script here..." rows="5" data-parsley-minlength="3" data-parsley-maxlength="1000"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button id="cancel-add" type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-add-primary-footer" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- #edit-dialog -->
<div class="modal fade" id="modal-edit-primary-footer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Footer</h4>
            </div>
            <div class="modal-body">
                <form id="form-edit-primary-footer" data-parsley-validate action="" method="POST">
                    <div id="edit-pf-body"></div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button id="button-edit-primary-footer" type="submit" class="btn btn-success"><i class="fa fa-check"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-delete-primary-footer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Alert</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete current footer data?</p>
                <?php
                    if (isset ($_POST['hapus'])) {
                        $footerid     = $_POST['footerID'];
                        $adminLoginID = $_POST['adminLoginID'];
                        $v_delPFooter  = $class_primary_footer->deletePFooter($footerid, $adminLoginID);
                            header("Location: $madinurl/primary-footer/"); 
                    } 
                ?>
                <form id="form-delete-primary-footer" action="" method="post">
                    <input type="hidden" name="footer_id" value="" id="delete">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-delete-primary-footer" type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-enable-disable-column4">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Fourth Column Primary Footer</h4>
            </div>
            <div class="modal-body">
                <?php
                    if($fourth_column->cr_settingValue == 'enable') {
                        $value = 'disable';
                    }
                    elseif($fourth_column->cr_settingValue == 'disable') {
                        $value = 'enable';
                    }
                ?>
                <p>Are you sure want to <?php echo $value ?> fourth column in primary footer?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                <button id="button-enable-disable-column4" type="button" class="btn btn-success" data-value="<?php echo $value ?>" data-name="Primary Footer Fourth Column" data-id="<?php echo $fourth_column->cr_settingID ?>"><?php if($fourth_column->cr_settingValue == 'enable') echo 'Disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'Enable' ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("* #customtextselected").hide();
        $("#latestportfolioselected").hide();
        $("#blogselected").hide();
        $("#latestgalleryselected").hide();
        $("#socialselected").hide();
        $("#instafeedselected").hide();
        $("#twitterfeedselected").hide();
        $("#facebookpageselected").hide();
        $("#ct").click(function(){
            //$("#form-add-primary-footer").parsley().reset();
            if ($("#ct").is(":checked")) {
                $('#customtextselected').addClass('animated fadeIn');
                //hide other form
                $("#latestportfolioselected").hide();
                $("#blogselected").hide();
                $("#latestgalleryselected").hide();
                $("#socialselected").hide();
                $("#instafeedselected").hide();
                $("#twitterfeedselected").hide();
                $("#facebookpageselected").hide();
                //show selected form
                $("#customtextselected").show();
                $("#customtexttitle").attr('required','required');

                $("#latestportfoliotitle").parsley().destroy();
                $("#latestportfoliocategory").parsley().destroy();
                $("#latestportfoliototal").parsley().destroy();

                $("#blogtitle").parsley().destroy();
                $("#blogpage").parsley().destroy();
                $("#blogcategory").parsley().destroy();
                $("#blogtotal").parsley().destroy();

                $("#latestgallerytitle").parsley().destroy();
                $("#latestgallerytotal").parsley().destroy();

                $("#socialtitle").parsley().destroy();

                $("#instafeedtitle").parsley().destroy();
                $("#instafeedtotal").parsley().destroy();

                $("#twitterfeedtitle").parsley().destroy();
                $("#twitterfeedtext").parsley().destroy();

                $("#facebookpagetitle").parsley().destroy();
                $("#facebookpagetext").parsley().destroy();
                
            } else {
                $("#customtextselected").addClass('animated fadeOut');
                $("#customtextselected").hide();
            }
        });

        $("#lp").click(function(){
            $("#form-add-primary-footer").parsley().reset();
            if ($("#lp").is(":checked")) {
                $('#latestportfolioselected').addClass('animated fadeIn');
                $("#customtextselected").hide();
                $("#blogselected").hide();
                $("#latestgalleryselected").hide();
                $("#socialselected").hide();
                $("#instafeedselected").hide();
                $("#twitterfeedselected").hide();
                $("#facebookpageselected").hide();
                //show selected form
                $("#latestportfolioselected").show();
                $("#latestportfoliotitle, #latestportfoliocategory, #latestportfoliototal").attr('required','required');

                $("#customtexttitle").parsley().destroy();
                $("#customtexttext").parsley().destroy();

                $("#blogtitle").parsley().destroy();
                $("#blogpage").parsley().destroy();
                $("#blogcategory").parsley().destroy();
                $("#blogtotal").parsley().destroy();

                $("#latestgallerytitle").parsley().destroy();
                $("#latestgallerytotal").parsley().destroy();

                $("#socialtitle").parsley().destroy();

                $("#instafeedtitle").parsley().destroy();
                $("#instafeedtotal").parsley().destroy();

                $("#twitterfeedtitle").parsley().destroy();
                $("#twitterfeedtext").parsley().destroy();

                $("#facebookpagetitle").parsley().destroy();
                $("#facebookpagetext").parsley().destroy();
                
            } else {
                $("#latestportfolioselected").addClass('animated fadeOut');
                $("#latestportfolioselected").hide();
            }
        });

        $("#lg").click(function(){
            $("#form-add-primary-footer").parsley().reset();
            if ($("#lg").is(":checked")) {
                $('#latestgalleryselected').addClass('animated fadeIn');
                $("#customtextselected").hide();
                $("#latestportfolioselected").hide();
                $("#blogselected").hide();
                $("#socialselected").hide();
                $("#instafeedselected").hide();
                $("#twitterfeedselected").hide();
                $("#facebookpageselected").hide();
                //show selected form
                $("#latestgalleryselected").show();
                $("#latestgallerytitle, #latestgallerytotal").attr('required','required');

                $("#customtexttitle").parsley().destroy();
                $("#customtexttext").parsley().destroy();

                $("#blogtitle").parsley().destroy();
                $("#blogpage").parsley().destroy();
                $("#blogcategory").parsley().destroy();
                $("#blogtotal").parsley().destroy();

                $("#latestportfoliotitle").parsley().destroy();
                $("#latestportfoliocategory").parsley().destroy();
                $("#latestportfoliototal").parsley().destroy();

                $("#socialtitle").parsley().destroy();

                $("#instafeedtitle").parsley().destroy();
                $("#instafeedtotal").parsley().destroy();

                $("#twitterfeedtitle").parsley().destroy();
                $("#twitterfeedtext").parsley().destroy();

                $("#facebookpagetitle").parsley().destroy();
                $("#facebookpagetext").parsley().destroy();
                
            } else {
                $("#latestgalleryselected").addClass('animated fadeOut');
                $("#latestgalleryselected").hide();
            }
        });

        $("#sc").click(function(){
            $("#form-add-primary-footer").parsley().reset();
            if ($("#sc").is(":checked")) {
                $('#socialselected').addClass('animated fadeIn');
                $("#customtextselected").hide();
                $("#latestportfolioselected").hide();
                $("#blogselected").hide();
                $("#latestgalleryselected").hide();
                $("#instafeedselected").hide();
                $("#twitterfeedselected").hide();
                $("#facebookpageselected").hide();
                //show selected form
                $("#socialselected").show();
                $("#socialtitle").attr('required','required');

                $("#customtexttitle").parsley().destroy();
                $("#customtexttext").parsley().destroy();

                $("#blogtitle").parsley().destroy();
                $("#blogpage").parsley().destroy();
                $("#blogcategory").parsley().destroy();
                $("#blogtotal").parsley().destroy();

                $("#latestportfoliotitle").parsley().destroy();
                $("#latestportfoliocategory").parsley().destroy();
                $("#latestportfoliototal").parsley().destroy();

                $("#latestgallerytitle").parsley().destroy();
                $("#latestgallerytotal").parsley().destroy();

                $("#instafeedtitle").parsley().destroy();
                $("#instafeedtotal").parsley().destroy();

                $("#twitterfeedtitle").parsley().destroy();
                $("#twitterfeedtext").parsley().destroy();

                $("#facebookpagetitle").parsley().destroy();
                $("#facebookpagetext").parsley().destroy();
                
            } else {
                $("#socialselected").addClass('animated fadeOut');
                $("#socialselected").hide();
            }
        });

        $("#if").click(function(){
            $("#form-add-primary-footer").parsley().reset();
            if ($("#if").is(":checked")) {
                $('#instafeedselected').addClass('animated fadeIn');
                $("#customtextselected").hide();
                $("#latestportfolioselected").hide();
                $("#blogselected").hide();
                $("#latestgalleryselected").hide();
                $("#socialselected").hide();
                $("#twitterfeedselected").hide();
                $("#facebookpageselected").hide();
                //show selected form
                $("#instafeedselected").show();
                $("#instafeedtitle, #instafeedtotal").attr('required','required');

                $("#customtexttitle").parsley().destroy();
                $("#customtexttext").parsley().destroy();

                $("#blogtitle").parsley().destroy();
                $("#blogpage").parsley().destroy();
                $("#blogcategory").parsley().destroy();
                $("#blogtotal").parsley().destroy();

                $("#latestportfoliotitle").parsley().destroy();
                $("#latestportfoliocategory").parsley().destroy();
                $("#latestportfoliototal").parsley().destroy();

                $("#latestgallerytitle").parsley().destroy();
                $("#latestgallerytotal").parsley().destroy();

                $("#socialtitle").parsley().destroy();

                $("#twitterfeedtitle").parsley().destroy();
                $("#twitterfeedtext").parsley().destroy();

                $("#facebookpagetitle").parsley().destroy();
                $("#facebookpagetext").parsley().destroy();
                
            } else {
                $("#instafeedselected").addClass('animated fadeOut');
                $("#instafeedselected").hide();
            }
        });

        $("#tf").click(function(){
            $("#form-add-primary-footer").parsley().reset();
            if ($("#tf").is(":checked")) {
                $('#twitterfeedselected').addClass('animated fadeIn');
                $("#customtextselected").hide();
                $("#latestportfolioselected").hide();
                $("#blogselected").hide();
                $("#latestgalleryselected").hide();
                $("#socialselected").hide();
                $("#instafeedselected").hide();
                $("#facebookpageselected").hide();
                //show selected form
                $("#twitterfeedselected").show();
                $("#twitterfeedtitle, #twitterfeedtext").attr('required','required');

                $("#customtexttitle").parsley().destroy();
                $("#customtexttext").parsley().destroy();

                $("#blogtitle").parsley().destroy();
                $("#blogpage").parsley().destroy();
                $("#blogcategory").parsley().destroy();
                $("#blogtotal").parsley().destroy();

                $("#latestportfoliotitle").parsley().destroy();
                $("#latestportfoliocategory").parsley().destroy();
                $("#latestportfoliototal").parsley().destroy();

                $("#latestgallerytitle").parsley().destroy();
                $("#latestgallerytotal").parsley().destroy();

                $("#socialtitle").parsley().destroy();

                $("#instafeedtitle").parsley().destroy();
                $("#instafeedtotal").parsley().destroy();

                $("#facebookpagetitle").parsley().destroy();
                $("#facebookpagetext").parsley().destroy();
                
            } else {
                $("#twitterfeedselected").addClass('animated fadeOut');
                $("#twitterfeedselected").hide();
            }
        });

        $("#fp").click(function(){
            $("#form-add-primary-footer").parsley().reset();
            if ($("#fp").is(":checked")) {
                $('#facebookpageselected').addClass('animated fadeIn');
                $("#customtextselected").hide();
                $("#latestportfolioselected").hide();
                $("#blogselected").hide();
                $("#latestgalleryselected").hide();
                $("#socialselected").hide();
                $("#instafeedselected").hide();
                $("#twitterfeedselected").hide();
                //show selected form
                $("#facebookpageselected").show();
                $("#facebookpagetitle, #facebookpagetext").attr('required','required');

                $("#customtexttitle").parsley().destroy();
                $("#customtexttext").parsley().destroy();

                $("#blogtitle").parsley().destroy();
                $("#blogpage").parsley().destroy();
                $("#blogcategory").parsley().destroy();
                $("#blogtotal").parsley().destroy();

                $("#latestportfoliotitle").parsley().destroy();
                $("#latestportfoliocategory").parsley().destroy();
                $("#latestportfoliototal").parsley().destroy();

                $("#latestgallerytitle").parsley().destroy();
                $("#latestgallerytotal").parsley().destroy();

                $("#socialtitle").parsley().destroy();

                $("#instafeedtitle").parsley().destroy();
                $("#instafeedtotal").parsley().destroy();

                $("#twitterfeedtitle").parsley().destroy();
                $("#twitterfeedtext").parsley().destroy();
                
            } else {
                $("#facebookpageselected").addClass('animated fadeOut');
                $("#facebookpageselected").hide();
            }
        });

        $("#lb").click(function(){
            $("#form-add-primary-footer").parsley().reset();
            if ($("#lb").is(":checked")) {
                $('#blogselected').addClass('animated fadeIn');
                $("#customtextselected").hide();
                $("#latestportfolioselected").hide();
                $("#latestgalleryselected").hide();
                $("#socialselected").hide();
                $("#instafeedselected").hide();
                $("#twitterfeedselected").hide();
                $("#facebookpageselected").hide();
                //show selected form
                $("#blogselected").show();
                $("#blogtitle, #blogpage, #blogcategory, #blogtotal").attr('required','required');

                $("#customtexttitle").parsley().destroy();
                $("#customtexttext").parsley().destroy();

                $("#facebookpagetitle").parsley().destroy();
                $("#facebookpagetext").parsley().destroy();

                $("#latestportfoliotitle").parsley().destroy();
                $("#latestportfoliocategory").parsley().destroy();
                $("#latestportfoliototal").parsley().destroy();

                $("#latestgallerytitle").parsley().destroy();
                $("#latestgallerytotal").parsley().destroy();

                $("#socialtitle").parsley().destroy();

                $("#instafeedtitle").parsley().destroy();
                $("#instafeedtotal").parsley().destroy();

                $("#twitterfeedtitle").parsley().destroy();
                $("#twitterfeedtext").parsley().destroy();
                
            } else {
                $("#blogselected").addClass('animated fadeOut');
                $("#blogselected").hide();
            }
        });

        $('#cancel-add').click(function(){
            $("#ct").removeAttr("checked");
            $("#lp").removeAttr("checked");
            $("#lb").removeAttr("checked");
            $("#lg").removeAttr("checked");
            $("#sc").removeAttr("checked");
            $("#if").removeAttr("checked");
            $("#tf").removeAttr("checked");
            $("#fp").removeAttr("checked");
            $("#customtextselected").hide();
            $("#latestportfolioselected").hide();
            $("#blogselected").hide();
            $("#latestgalleryselected").hide();
            $("#socialselected").hide();
            $("#instafeedselected").hide();
            $("#twitterfeedselected").hide();
            $("#facebookpageselected").hide();
            $("#form-add-primary-footer").parsley().reset();
            $("#customtexttitle").parsley().destroy();
            $("#customtexttext").parsley().destroy();
            $("#latestportfoliotitle").parsley().destroy();
            $("#latestportfoliocategory").parsley().destroy();
            $("#latestportfoliototal").parsley().destroy();
            $("#blogtitle").parsley().destroy();
            $("#blogpage").parsley().destroy();
            $("#blogcategory").parsley().destroy();
            $("#blogtotal").parsley().destroy();
            $("#latestgallerytitle").parsley().destroy();
            $("#latestgallerytotal").parsley().destroy();
            $("#socialtitle").parsley().destroy();
            $("#instafeedtitle").parsley().destroy();
            $("#instafeedtotal").parsley().destroy();
            $("#twitterfeedtitle").parsley().destroy();
            $("#twitterfeedtext").parsley().destroy();
            $("#facebookpagetitle").parsley().destroy();
            $("#facebookpagetext").parsley().destroy();
        });
        $('#modal-add-primary-footer').on('show.bs.modal', function(e) {
            $(this).find('#footername').attr('value', $(e.relatedTarget).data('footername'));
        });
        $('#modal-delete-primary-footer').on('show.bs.modal', function(e) {
            $(this).find('#delete').attr('value', $(e.relatedTarget).data('footerid'));
        });
        $('#blogpage').change(function() {
            var blogpageID = $('#blogpage').val();
            var dataString = 'blogpageID='+blogpageID;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/primary-footer-blog-page.php",
                data: dataString,
                cache: false,
                success: function(data){
                    $('#blogcategory').html(data);
                }
            });
        });
        $('.button-modal-primary-footer').click(function() {
            var pfid       = $(this).data("footerid");
            var dataString = 'pfid='+pfid;
            $.ajax({
                type: "POST",
                url:  "<?php echo MADMINURL ?>ajax/primary-footer-modal-body.php",
                data: dataString,
                cache: false,
                success: function(data){
                    $('#modal-edit-primary-footer').modal('show');
                    $('#edit-pf-body').html(data);
                    $('#blogpage2').show(function() {
                        var blogpageID2 = $('#blogpage2').val();
                        var dataString2 = 'blogpageID='+blogpageID2;
                        $.ajax({
                            type: "POST",
                            url:  "<?php echo MADMINURL ?>ajax/primary-footer-blog-page.php",
                            data: dataString2,
                            cache: false,
                            success: function(data){
                                $('#blogcategory2').html(data);
                            }
                        });
                    });
                    $('#blogpage2').change(function() {
                        var blogpageID2 = $('#blogpage2').val();
                        var dataString2 = 'blogpageID='+blogpageID2;
                        $.ajax({
                            type: "POST",
                            url:  "<?php echo MADMINURL ?>ajax/primary-footer-blog-page.php",
                            data: dataString2,
                            cache: false,
                            success: function(data){
                                $('#blogcategory2').html(data);
                            }
                        });
                    });
                }
            });
            return false;
        });

        $('#button-enable-disable-column4').click(function() {
            var value        = $(this).data("value");
            var setting_name = $(this).data("name");
            var setting_id   = $(this).data("id");
            var dataString   = 'value='+value+'&settingname='+setting_name+'&settingIDh='+setting_id;
            $.ajax({
                url:  "<?php echo MADMINURL ?>ajax/settings-update.php",
                type: "POST",
                beforeSend: function(){ $("#button-enable-disable-column4").html('<i class="fa fa-spinner fa-pulse"></i>');$("#button-enable-disable-column4").attr('disabled','disabled');},
                data: dataString,
                cache: false,
                success: function(msg){
                    var message = msg.split('!')[0];
                    var setting_name = msg.split('!')[1];
                    if(message == 'empty-setting') {
                        $("#button-enable-disable-column4").removeAttr('disabled');
                        $("#button-enable-disable-column4").html('<?php if($fourth_column->cr_settingValue == 'enable') echo 'Disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'Enable' ?>');
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
                            text:setting_name + " has been <?php if($fourth_column->cr_settingValue == 'enable') echo 'disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'enable' ?>d",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            $('#modal-enable-disable-column4').modal('hide');
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(message == 'false') {
                        $("#button-enable-disable-column4").removeAttr('disabled');
                        $("#button-enable-disable-column4").html('<?php if($fourth_column->cr_settingValue == 'enable') echo 'Disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'Enable' ?>');
                        $.gritter.add({
                            title:"Failed! Can't <?php if($fourth_column->cr_settingValue == 'enable') echo 'disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'enable' ?> primary footer fourth column",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-enable-disable-column4").removeAttr('disabled');
                        $("#button-enable-disable-column4").html('<?php if($fourth_column->cr_settingValue == 'enable') echo 'Disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'Enable' ?>');
                        $.gritter.add({
                            title:"Error! Can't <?php if($fourth_column->cr_settingValue == 'enable') echo 'disable'; elseif($fourth_column->cr_settingValue == 'disable') echo 'enable' ?> primary footer fourth column",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                }
            });
            return false;
        });

        var add_primary_footer;
        $("#form-add-primary-footer").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (add_primary_footer) {
                    add_primary_footer.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                add_primary_footer = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/primary-footer-add.php",
                    type: "post",
                    beforeSend: function(){ $("#button-add-primary-footer").html('<i class="fa fa-spinner fa-pulse"></i> Saving...');$("#button-add-primary-footer").attr('disabled','disabled');},
                    data: serializedData
                });
                add_primary_footer.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-add-primary-footer").removeAttr('disabled');
                        $("#button-add-primary-footer").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't add new primary footer data. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"New primary footer data has been added.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-add-primary-footer").removeAttr('disabled');
                        $("#button-add-primary-footer").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Failed! Can't add new primary footer data",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-add-primary-footer").removeAttr('disabled');
                        $("#button-add-primary-footer").html('<i class="fa fa-check"></i> Save');
                        $.gritter.add({
                            title:"Error! Can't add new primary footer data",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                add_primary_footer.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var edit_primary_footer;
        $("#form-edit-primary-footer").submit(function(event){
            if ($(this).parsley().isValid()) {
                if (edit_primary_footer) {
                    edit_primary_footer.abort();
                }
                var $form = $(this);
                var $inputs = $form.find("input, button");
                for ( instance in CKEDITOR.instances )
                        CKEDITOR.instances[instance].updateElement();
                var serializedData = $form.serialize();
                edit_primary_footer = $.ajax({
                    url: "<?php echo MADMINURL ?>ajax/primary-footer-update.php",
                    type: "post",
                    beforeSend: function(){ $("#button-edit-primary-footer").html('<i class="fa fa-spinner fa-pulse"></i> Updating...');$("#button-edit-primary-footer").attr('disabled','disabled');},
                    data: serializedData
                });
                edit_primary_footer.done(function (msg){
                    if(msg == 'empty-field') {
                        $("#button-edit-primary-footer").removeAttr('disabled');
                        $("#button-edit-primary-footer").html('<i class="fa fa-check"></i> Update');
                        $.gritter.add({
                            title:"Failed! Please fill required field",
                            text:"Can't update primary footer data. Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else if(msg == 'true') {
                        $.gritter.add({
                            title:"Success!",
                            text:"Primary footer data has been updated.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                        setTimeout(function() {
                            window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                        }, 2000);
                    }
                    else if(msg == 'false') {
                        $("#button-edit-primary-footer").removeAttr('disabled');
                        $("#button-edit-primary-footer").html('<i class="fa fa-check"></i> Update');
                        $.gritter.add({
                            title:"Failed! Can't update primary footer data",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                    else {
                        $("#button-edit-primary-footer").removeAttr('disabled');
                        $("#button-edit-primary-footer").html('<i class="fa fa-check"></i> Update');
                        $.gritter.add({
                            title:"Error! Can't update primary footer data",
                            text:"Please try again.",
                            image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                            sticky:false,
                            time:""
                        });
                    }
                });
                edit_primary_footer.always(function () {
                    $inputs.prop("disabled", false);
                });
                event.preventDefault();
            }
        });

        var delete_primary_footer;
        $("#form-delete-primary-footer").submit(function(event){
            if (delete_primary_footer) {
                delete_primary_footer.abort();
            }
            var $form = $(this);
            var $inputs = $form.find("input, button");
            var serializedData = $form.serialize();
            delete_primary_footer = $.ajax({
                url: "<?php echo MADMINURL ?>ajax/primary-footer-delete.php",
                type: "post",
                beforeSend: function(){ $("#button-delete-primary-footer").html('<i class="fa fa-spinner fa-pulse"></i> Deleting...');$("#button-delete-primary-footer").attr('disabled','disabled');},
                data: serializedData
            });
            delete_primary_footer.done(function (msg){
                if(msg == 'pf-empty') {
                    $("#button-delete-primary-footer").removeAttr('disabled');
                    $("#button-delete-primary-footer").html('Delete');
                    $.gritter.add({
                        title:"Failed! Primary footer is required",
                        text:"Can't delete current primary footer data. Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else if(msg == 'true'){
                    $.gritter.add({
                        title:"Success!",
                        text:"Current primary footer data has been deleted",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                    setTimeout(function() {
                        $('#modal-delete-primary-footer').modal('hide');
                        window.location="<?php echo $router->generate('admin-dashboard-section', array('section' => $section)) ?>";
                    }, 2000);
                }
                else if(msg == 'false') {
                    $("#button-delete-primary-footer").removeAttr('disabled');
                    $("#button-delete-primary-footer").html('Delete');
                    $.gritter.add({
                        title:"Failed! Can't delete current primary footer data",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
                else {
                    $("#button-delete-primary-footer").removeAttr('disabled');
                    $("#button-delete-primary-footer").html('Delete');
                    $.gritter.add({
                        title:"Error! Can't delete current primary footer data",
                        text:"Please try again.",
                        image:"<?php echo MADMINURL.'assets/img/cr.png' ?>",
                        sticky:false,
                        time:""
                    });
                }
            });
            delete_primary_footer.always(function () {
                $inputs.prop("disabled", false);
            });
            event.preventDefault();
        });  
    });
</script>