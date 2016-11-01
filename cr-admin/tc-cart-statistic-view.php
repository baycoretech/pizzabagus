<?php
	$month = date('m');
	$year  = date('Y');
	//get total visitor
	$o_get_global_function = new globalFunction($pdo);
    $v_get_total_paid_invoice   = $o_get_global_function->total_paid_invoice();
    $v_get_total_unpaid_invoice = $o_get_global_function->total_unpaid_invoice();
    $v_get_total_customer       = $o_get_global_function->total_customer();
    $v_get_shipping_this_month    = $o_get_global_function->total_shipping_this_month($month, $year);
    
    $o_get_active_currency = new Currency($pdo);
    $v_get_active_currency = $o_get_active_currency->view_active_currency();
   
   	$total_shipping = 0;
   	$total_price    = 0;
    foreach($v_get_shipping_this_month as $data) {
    	$v_get_price_this_month    = $o_get_global_function->total_price_this_month($data->cr_invoiceNumber);
    	foreach($v_get_price_this_month as $data2) {
    		$total_price += $data2->cr_productPrice*$data2->cr_productQuantity;
    	}
    	$total_shipping += $data->cr_invoiceShipping;
    }
?>
<div class="row">
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-green">
			<div class="stats-icon"><i class="fa fa-file-o"></i></div>
			<div class="stats-info">
				<h4>TOTAL PAID INVOICE</h4>
				<p><?php echo number_format($v_get_total_paid_invoice) ?></p>	
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-file-o"></i></div>
			<div class="stats-info">
				<h4>TOTAL UNPAID INVOICE</h4>
				<p><?php echo number_format($v_get_total_unpaid_invoice) ?></p>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-blue">
			<div class="stats-icon"><i class="fa fa-users"></i></div>
			<div class="stats-info">
				<h4>TOTAL CUSTOMER</h4>
				<p><?php echo number_format($v_get_total_customer) ?></p>	
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-money"></i></div>
			<div class="stats-info">
				<h4>INCOME THIS MONTH</h4>
				<p><?php echo $v_get_active_currency->cr_currencySymbol." ".number_format($total_shipping + $total_price, $v_get_active_currency->cr_currencyDecimals, $v_get_active_currency->cr_currencyDecimalpoint, $v_get_active_currency->cr_currencySeparator); ?></p>	
			</div>
		</div>
	</div>
	<!-- end col-3 -->
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
				<h4 class="panel-title">Store Analytics (Last 7 Days)</h4>
			</div>
			<div class="panel-body">
				<div id="store-chart" class="height-sm"></div>
			</div>
		</div>
                    
	</div>
	<!-- end col-8 -->
	<!-- begin col-4 -->
	<div class="col-md-4">
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
				</div>
				<h4 class="panel-title">Income in <?php echo $year ?></h4>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Month</th>
								<th>Income</th>
							</tr>
						</thead>
						<tbody>
						<?php
							for($i=1;$i<=12;$i++) {
								$month_var = str_pad($i, 1, "0", STR_PAD_LEFT);
								$v_get_shipping_this_month_table    = $o_get_global_function->total_shipping_this_month($month_var, $year);
								$total_shipping_table = 0;
							   	$total_price_table    = 0;
							    foreach($v_get_shipping_this_month_table as $data) {
							    	$month_table = date('F', strtotime($data->cr_invoiceDate));
							    	$v_get_price_table    = $o_get_global_function->total_price_this_month($data->cr_invoiceNumber);
							    	foreach($v_get_price_table as $data2) {
							    		$total_price_table += $data2->cr_productPrice*$data2->cr_productQuantity;
							    	}
							    	$total_shipping_table += $data->cr_invoiceShipping;
							    }
							    if($total_shipping_table + $total_price_table != 0) {
						?>
							<tr>
								<td <?php if($month_var == $month) echo 'class="text-success"' ?>><?php echo $month_table ?></td>
								<td <?php if($month_var == $month) echo 'class="text-success"' ?>><?php echo $v_get_active_currency->cr_currencySymbol." ".number_format($total_shipping_table + $total_price_table, $v_get_active_currency->cr_currencyDecimals, $v_get_active_currency->cr_currencyDecimalpoint, $v_get_active_currency->cr_currencySeparator); ?></td>
							</tr>
						<?php
									$total_profit += $total_shipping_table + $total_price_table;
								}
							}
						?>
							<tr>
								<td><strong>TOTAL</strong></td>
								<td><strong><?php echo $v_get_active_currency->cr_currencySymbol." ".number_format($total_profit, $v_get_active_currency->cr_currencyDecimals, $v_get_active_currency->cr_currencyDecimalpoint, $v_get_active_currency->cr_currencySeparator); ?></strong></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- end col-4 -->
</div>
<!-- end row -->