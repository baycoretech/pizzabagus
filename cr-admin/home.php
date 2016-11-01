<div class="row">
	<div class="col-md-12">
		<div class="jumbotron p-15 welcome-jumbotron m-b-20">
		  <h2 class="text-success">Welcome to Creatify</h2>
		  <p class="text-white">Creatify gives you creativity to create your <strong>creative website</strong>. Check our documentation for more help, or email us if you have any problems with Creatify.</p>
		</div>
	</div>

	<?php
		if($function_coming_soon->cr_settingValue == "enable") {
	?>
	<div class="col-md-12">
		<div class="note note-info">
			<h4>Maintenance Mode</h4>
			<p>Your website is in maintenance mode. Disable maintenance mode to get your website online back.</p>
		</div>
	</div>
	<?php
		}
		else {
			echo "";
		}
	?>
</div>
<div class="row">
	<!-- begin col-8 -->
	<div class="col-md-8">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				</div>
				<h4 class="panel-title">Website Analytics (Last 7 Days)</h4>
			</div>
			<div class="panel-body">
				<div id="interactive-chart" class="height-sm"></div>
			</div>
		</div>           
	</div>
	<div class="col-md-4">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				</div>
				<h4 class="panel-title">Calendar</h4>
			</div>
			<div class="panel-body">
				<div id="datepicker-inline" class="datepicker-full-width"><div></div></div>
			</div>
		</div>

		<!--
		<div class="panel panel-inverse" data-sortable-id="index-7">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Visitors User Agent</h4>
			</div>
			<div class="panel-body">
				<div id="donut-chart" class="height-sm"></div>
			</div>
		</div>
		-->
	</div>
</div>