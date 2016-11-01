<?php
	//get total visitor
	$o_getGlobalFunction = new globalFunction($pdo);
    $v_getTotalVisitor   = $o_getGlobalFunction->totalVisitor();
    $v_getTotalPost      = $o_getGlobalFunction->totalPost();
    $v_getTotalPortpro   = $o_getGlobalFunction->totalPortpro();
?>
<div class="row">
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-green">
						<div class="stats-icon"><i class="fa fa-desktop"></i></div>
						<div class="stats-info">
							<h4>TOTAL VISITORS</h4>
							<p><?php echo number_format($v_getTotalVisitor) ?></p>	
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats <?php if($v_getUserPlan->cr_settingValue=="basic") { if($v_getDiskSizeBytes<419430400) echo "bg-blue"; elseif($v_getDiskSizeBytes > 419430400 && $v_getDiskSizeBytes < 470810624) echo "bg-orange"; elseif($v_getDiskSizeBytes>470810624) echo "bg-red"; } elseif($v_getUserPlan->cr_settingValue=="premium" || $v_getUserPlan->cr_settingValue=="probasic" || $v_getUserPlan->cr_settingValue=="propro" || $v_getUserPlan->cr_settingValue=="prosuper") { echo "bg-blue"; } ?>">
						<div class="stats-icon"><i class="fa fa-server"></i></div>
						<div class="stats-info">
							<h4>TOTAL DISK USAGE</h4>
							<p><?php echo $v_getDiskSize ?> / <?php 
								if($v_getUserPlan->cr_settingValue=="basic") 
									echo '<span style="font-size: 12px">500 MB</span>'; 
								elseif($v_getUserPlan->cr_settingValue=="premium" || $v_getUserPlan->cr_settingValue=="probasic" || $v_getUserPlan->cr_settingValue=="propro" || $v_getUserPlan->cr_settingValue=="prosuper") 
									echo  "&#8734;"; 
								?></p>	
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-purple">
						<div class="stats-icon"><i class="fa fa-pencil-square-o"></i></div>
						<div class="stats-info">
							<h4>TOTAL POST</h4>
							<p><?php echo number_format($v_getTotalPost) ?></p>	
						</div>
					</div>
				</div>
				<!-- end col-3 -->
				<!-- begin col-3 -->
				<div class="col-md-3 col-sm-6">
					<div class="widget widget-stats bg-red">
						<div class="stats-icon"><i class="fa fa-clock-o"></i></div>
						<div class="stats-info">
							<h4>LAST LOGIN</h4>
							<?php
								if($cradminLastlogin=="0000-00-00 00:00:00") {
							?>
							<p>None</p>
							<?php
								}
								else {
							?>
							<p data-livestamp="<?php echo $cradminLastlogin ?>"></p>
							<?php
								}
							?>	
						</div>
					</div>
				</div>
				<!-- end col-3 -->
</div>