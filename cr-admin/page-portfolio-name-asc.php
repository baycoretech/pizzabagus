<?php
	$o_getPC         = new portfoliocategory($pdo);
	$v_getPC         = $o_getPC->viewPortfoliocategory($page);
	$o_getPortfolio  = new portfolio($pdo);
	$v_getPortfolio  = $o_getPortfolio->viewPortfolionameASC($page);
	$v_getFeatured   = $o_getPortfolio->viewFeaturedImage($page);
	$image           = $v_getFeatured->cr_portfoliopageFeatured;
	//change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
	$imageGIF        = str_replace(".png",".gif",$image);
	$imageJPG        = str_replace(".png",".jpg",$image);
	$imageJPEG       = str_replace(".png",".jpeg",$image);
	//remove "/thumbnails" to get the real image
	$imagent         = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$image);
	$imageGIFnt      = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$imageGIF);
	$imageJPGnt      = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$imageJPG);
	$imageJPEGnt     = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$imageJPEG);

	$imageLink       = str_replace("/thumbnails","",$image);
	$imageGIFLink    = str_replace("/thumbnails","",$imageGIF);
	$imageJPGLink    = str_replace("/thumbnails","",$imageJPG);
	$imageJPEGLink   = str_replace("/thumbnails","",$imageJPEG);
	if($v_getFeatured=='0') { echo ''; } else {
?>
<div class="pv-60-30 dark-translucent-bg featured-portfolio" style="background-image: url(<?php 
		                            if(file_exists($imagent)) { 
		                                echo MURL.$imageLink; 
		                            } 
		                            elseif(file_exists($imageGIFnt)) { 
		                                echo MURL.$imageGIFLink; 
		                            } 
		                            elseif(file_exists($imageJPGnt)) {
		                                echo MURL.$imageJPGLink; 
		                            } 
		                            elseif(file_exists($imageJPEGnt)) { 
		                                echo MURL.$imageJPEGLink; 
		                            } 
		                        ?>);background-size: cover;">
	<div class="container pv-60-30">
		<div class="row">
			<div class="col-md-6 text-left pt-60">
				<div class="object-non-visible featured-cd pt-60" data-animation-effect="fadeIn" data-effect-delay="100">
					<h3 class="page-title text-left"><?php echo $v_getFeatured->cr_portfoliopageCaption ?></h3>
					<p><em><?php echo $v_getFeatured->cr_portfoliopageDesc ?></em></p>
				</div> 
			</div>
		</div>
	</div>
</div>
<?php } ?>

<section class="main-container">

	<div class="container">
		<div class="row">

			<!-- main start -->
			<!-- ================ -->
			<div class="main col-md-12">

				<!-- page-title start -->
				<!-- ================ -->
				<h1 class="page-title"><?php echo $pageTitle ?></h1>
				<div class="separator-2"></div>
				<!-- page-title end -->
				<?php
					if($v_getPortfolio==0) {
				?>
				<div class="alert alert-info alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong>Empty!</strong> There is no data found for this page.
				</div>
				<?php
					}
					else {
				?>

				<!-- isotope filters start -->
				<div class="filters">
					<ul class="nav nav-pills">
						<li class="active"><a href="#" data-filter="*">All</a></li>
						<?php
	                        foreach ($v_getPC as $data) {
	                            $pclink = create_slug($data->cr_portfoliocategoryName);
	                    ?>
						<li><a href="#" data-filter=".<?php echo $pclink ?>"><?php echo $data->cr_portfoliocategoryName ?></a></li>
						<?php
							}
						?>
					</ul>
				</div>
				<!-- isotope filters end -->

				<div class="isotope-container row grid-space-10">
					<?php
				        foreach ($v_getPortfolio as $data) {
				            $pID     = $data->cr_portfolioID;
				            $v_getPE = $o_getPortfolio->viewPortfolioExtra($pID);
				            $image   = $data->cr_portfolioThumb;
				            $pclink  = create_slug($data->cr_portfoliocategoryName);
				            $sliderimage = explode(',',$data->cr_portfolioSliderimage);
				            $image2           = $sliderimage[0];
							$imageGIF        = str_replace(".png",".gif",$image2);
							$imageJPG        = str_replace(".png",".jpg",$image2);
							$imageJPEG       = str_replace(".png",".jpeg",$image2);
							$imagent         = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$image2);
							$imageGIFnt      = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$imageGIF);
							$imageJPGnt      = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$imageJPG);
							$imageJPEGnt     = $_SERVER['DOCUMENT_ROOT'].ABSPATH.str_replace("/thumbnails","",$imageJPEG);
							$imageLink       = str_replace("/thumbnails","",$image2);
							$imageGIFLink    = str_replace("/thumbnails","",$imageGIF);
							$imageJPGLink    = str_replace("/thumbnails","",$imageJPG);
							$imageJPEGLink   = str_replace("/thumbnails","",$imageJPEG);
							if(file_exists($imagent)) { 
		                        $show_image =  MURL.$imageLink; 
		                    } 
		                    elseif(file_exists($imageGIFnt)) { 
		                        $show_image =  MURL.$imageGIFLink; 
		                    } 
		                    elseif(file_exists($imageJPGnt)) {
		                        $show_image =  MURL.$imageJPGLink; 
		                    } 
		                    elseif(file_exists($imageJPEGnt)) { 
		                        $show_image =  MURL.$imageJPEGLink; 
		                    }
				    ?>

				    <?php
					    	if($pageTypeName=="Portfolios or Products (Three Columns)" || $pageTypeName=="Portfolios or Products (Four Columns)" || $pageTypeName=="Portfolios or Products (Two Columns)") {
					?>
					<div class="col-md-<?php if($pageColumn==3) echo "4"; elseif($pageColumn==4) echo "3"; elseif($pageColumn==2) echo "6" ?> col-sm-6 isotope-item <?php echo $pclink ?>">
						<div class="image-box shadow bordered text-center mb-20">
							<div class="overlay-container">
								<img src="<?php if($pageColumn==2) echo $show_image; else echo MURL.$image ?>" alt="<?php echo $data->cr_portfolioTitle ?>">
								<div class="overlay-top">
									<div class="text">
										<h3><a href="<?php echo MURL."/".$page."/".create_slug($data->cr_portfolioTitle) ?>"><?php echo $data->cr_portfolioTitle ?></a></h3>
										<p class=""><?php echo $data->cr_portfoliocategoryName ?></p>
									</div>
								</div>
								<div class="overlay-bottom">
									<div class="links">
										<a href="<?php echo MURL."/".$page."/".create_slug($data->cr_portfolioTitle) ?>" class="btn btn-default-transparent btn-animated btn-sm">View Details <i class="pl-10 fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
							}
							elseif($pageTypeName=="Portfolios or Products (Three Columns with Detail)" || $pageTypeName=="Portfolios or Products (Four Columns with Detail)" || $pageTypeName=="Portfolios or Products (Two Columns with Detail)") {
					?>
					<div class="col-sm-6 col-md-<?php if($pageColumn==3) echo "4"; elseif($pageColumn==4) echo "3"; elseif($pageColumn==2) echo "6" ?> isotope-item <?php echo $pclink ?>">
						<div class="image-box style-2 mb-20 shadow bordered light-gray-bg text-center">
							<div class="overlay-container">
								<a href="<?php echo MURL."/".$page."/".create_slug($data->cr_portfolioTitle) ?>">
									<img src="<?php if($pageColumn==2) echo $show_image; else echo MURL.$image ?>" alt="<?php echo $data->cr_portfoliocategoryName ?>">
								</a>
								<div class="overlay-to-top">
									<p class="small margin-clear"><em><?php echo $data->cr_portfoliocategoryName ?></p>
								</div>
							</div>
							<div class="body">
								<?php
										$ptitle = strip_tags($data->cr_portfolioTitle);
							            $subptitle = strlen($ptitle);
							                if($pageColumn=="3") {
								                if($subptitle<35) {
								                    echo "<h3>".$ptitle."</h3>";
								                }
								                else {
								                    echo "<h3>".substr($ptitle,0,35)."..."."</h3>"; 
								                }
								            }
								            elseif($pageColumn=="4") {
								                if($subptitle<20) {
								                    echo "<h4>".$ptitle."</h4>";
								                }
								                else {
								                    echo "<h4>".substr($ptitle,0,20)."..."."</h4>"; 
								                }
								            }
								            elseif($pageColumn=="2") {
								                if($subptitle<50) {
								                    echo "<h4>".$ptitle."</h4>";
								                }
								                else {
								                    echo "<h4>".substr($ptitle,0,50)."..."."</h4>"; 
								                }
								            }
								?>
								<div class="separator"></div>
								<p>
									<?php
										$pdesc = strip_tags($data->cr_portfolioDesc);
							            $subpdesc = strlen($pdesc);
							            if($subpdesc<80) {
								            echo $pdesc;
								        }
								        else {
								            echo substr($pdesc,0,80)."..."; 
								        }
									?>
								</p>
								<a href="<?php echo MURL."/".$page."/".create_slug($data->cr_portfolioTitle) ?>" class="btn btn-default btn-sm btn-hvr hvr-shutter-out-horizontal margin-clear">Read More<i class="fa fa-arrow-right pl-10"></i></a>												
							</div>
						</div>
					</div>
					<?php
							}
						}
					?>
								
				</div>
				<?php
					}
				?>
				
				<div class="separator"></div>

				<p class="text-center">
					<a id="btn-sort" class="btn btn-default-transparent btn-sm btn-hvr hvr-sweep-to-bottom"><strong>Sort by <i class="fa fa-sort"></i></strong></a>
				</p>
				<div id="sort-option" class="text-center">
					<a href="<?php echo MURL."/".$page."/sort/number" ?>" class="btn square btn-dark btn-sm">#</a>
					<?php
						foreach (range('A', 'Z') as $char) {
					?>
						<a href="<?php echo MURL."/".$page."/sort/".strtolower($char) ?>" class="btn square btn-dark btn-sm"><?php echo $char ?></a>
					<?php
						}
					?>
					<a href="<?php echo MURL."/".$page."/sort/name-asc" ?>" class="btn square btn-dark btn-sm active" title="Sort by name (ascending)"><i class="fa fa-sort-alpha-asc"></i></a>
					<a href="<?php echo MURL."/".$page."/sort/name-desc" ?>" class="btn square btn-dark btn-sm" title="Sort by name (descending)"><i class="fa fa-sort-alpha-desc"></i></a>
					<a href="<?php echo MURL."/".$page."/sort/date-asc" ?>" class="btn square btn-dark btn-sm" title="Sort by date (ascending)"><i class="fa fa-long-arrow-up"></i> <i class="fa fa-calendar"></i></a>
					<a href="<?php echo MURL."/".$page."/sort/date-desc" ?>" class="btn square btn-dark btn-sm" title="Sort by date (descending)"><i class="fa fa-long-arrow-down"></i> <i class="fa fa-calendar"></i></a>
				</div>

			</div>
			<!-- main end -->

		</div>
	</div>
</section>
<!-- main-container end -->

<script>
	$(document).ready(function() {
        $('#sort-option').hide();
        $('#btn-sort').on('click', function(event) {        
            $('#sort-option').slideToggle('slow');
        });
    });
</script>