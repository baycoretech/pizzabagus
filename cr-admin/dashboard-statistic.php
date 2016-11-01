<?php
	$last_month    = date('m', strtotime("-1 month"));
	$current_month = date('m');
	$year          = date('Y');

    $function_total_visitor        = $class_administrative->total_visitor();
    $function_last_month_precentage_visitor      = $class_administrative->precentage_visitor($last_month, $year);
    $function_current_month_precentage_visitor   = $class_administrative->precentage_visitor($current_month, $year);

    $precentage_visitor = round(($function_current_month_precentage_visitor - $function_last_month_precentage_visitor) / $function_last_month_precentage_visitor * 100, 2);

    $function_total_publish_post = $class_administrative->total_publish_post();
    $function_total_draft_post   = $class_administrative->total_draft_post();

    $precentage_disk_usage = round(($function_disk_size / 500) * 100, 2); 
?>
<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-pink">
			<div class="stats-icon"><i class="material-icons">desktop_windows</i></div>
			<div class="stats-info">
				<h4>TOTAL VISITORS</h4>
				<p><?php echo number_format($function_total_visitor) ?></p>	
			</div>
			<div class="stats-link">
				<a>
					<span class="pull-left"><?php if($function_last_month_precentage_visitor > $function_current_month_precentage_visitor) echo '<i class="fa fa-arrow-down"></i>'; elseif($function_last_month_precentage_visitor < $function_current_month_precentage_visitor) echo '<i class="fa fa-arrow-up"></i>'; elseif($function_last_month_precentage_visitor == $function_current_month_precentage_visitor) echo '<i class="fa fa-exchange"></i>'; ?> <?php echo $precentage_visitor ?>%</span>
					<?php if($function_last_month_precentage_visitor > $function_current_month_precentage_visitor) echo 'Lower than last month'; elseif($function_last_month_precentage_visitor < $function_current_month_precentage_visitor) echo 'Better than last month'; elseif($function_last_month_precentage_visitor == $function_current_month_precentage_visitor) echo 'Same as last month'; ?>
				</a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats <?php if($function_user_plan == "basic") { if($function_disk_size_bytes < 419430400) echo "bg-blue"; elseif($function_disk_size_bytes > 419430400 && $function_disk_size_bytes < 470810624) echo "bg-orange"; elseif($function_disk_size_bytes > 470810624) echo "bg-red"; } elseif($function_user_plan == "premium" || $function_user_plan == "probasic" || $function_user_plan == "propro" || $function_user_plan == "prosuper") { echo "bg-blue"; } ?>">
			<div class="stats-icon"><i class="material-icons">storage</i></div>
			<div class="stats-info">
				<h4>TOTAL DISK USAGE</h4>
				<p><?php echo $function_disk_size ?> / <?php 
								if($function_user_plan == "basic") 
									echo '<span style="font-size: 12px">500 MB</span>'; 
								elseif($function_user_plan == "premium" || $function_user_plan == "probasic" || $function_user_plan == "propro" || $function_user_plan == "prosuper") 
									echo  "&#8734;"; 
								?>
				</p>	
			</div>
			<div class="stats-link">
				<a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'disk-usage')) ?>">
					<?php if($function_user_plan == "basic") { ?>
					<span class="pull-left"><?php echo $precentage_disk_usage ?>%</span>
					<?php } else { ?>
					<span class="pull-left">Unlimited storage</span>
					<?php } ?>
					View Detail <i class="fa fa-arrow-circle-o-right"></i>
				</a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-grey-600">
			<div class="stats-icon"><i class="material-icons">create</i></div>
			<div class="stats-info">
				<h4>DRAFT/PUBLISH POST</h4>
				<p><?php echo $function_total_draft_post ?>/<?php echo $function_total_publish_post ?></p>	
			</div>
			<div class="stats-link">
				<a><span class="pull-left"><i class="fa fa-pencil"></i> <?php echo $function_total_draft_post + $function_total_publish_post ?></span>Kepp Posting <i class="fa fa-thumbs-up"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="material-icons">timer</i></div>
			<div class="stats-info">
				<h4>LAST LOGIN</h4>
				<?php
					if($admin_last_login == "0000-00-00 00:00:00") {
				?>
				<p>None</p>
				<?php
					}
					else {
				?>
				<p data-livestamp="<?php echo $admin_last_login ?>"></p>
				<?php
					}
				?>	
			</div>
			<div class="stats-link">
				<a href="<?php echo $router->generate('admin-dashboard-section', array('section' => 'history')) ?>">
				<span class="pull-left">Good to see you</span>
				History <i class="fa fa-arrow-circle-o-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->