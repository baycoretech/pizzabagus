<?php
    if(isset($_SESSION['order'])) {
    	$total = 0; 
    	foreach ($_SESSION['order'] as $your_order) { 
    		$total += $your_order['menutotal']; 
    	}
		if($total == 0) {
			$redirect = $master_url.'my-order/';
			header("Location: $redirect");
		}
		else {
			if(!isset($lang)) {
        		$order_text  = 'ORDER';
        		$billing_text = 'BILLING INFORMATION';
        		$payment_text = 'PAYMENT INFORMATION';
                $price_table = 'PRICE';
                $qty_table   = 'QUANTITY';
                $toppings_detail = 'Topping Detail';
                $next_btn    = 'COMPLETE ORDER';
                $back_btn    = 'BACK';

                //Billing Information
                $firstname_bill  = 'First Name';
                $middlename_bill = 'Middle Name';
                $lastname_bill   = 'Last Name';
                $phone_bill      = 'Telephone';
                $address1_bill   = 'Address 1';
                $address2_bill   = 'Address 2';
                $hotel_bill      = 'Hotel/Villa';
                $city_bill       = 'City';
                $detail_bill     = 'Detail';
        		$request_bill    = 'Request';
                $payment_bill    = 'Payment';

                //Alert
                $alert_failed_text = 'Failed. Can\'t review your order. Please try again.'; 
                $alert_error_text  = 'Error. Can\'t review your order. Please try again.'; 
            }
            else {
                if($lang == $default_language->cr_languageCode) {
        			$order_text  = 'ORDER';
        			$billing_text = 'BILLING INFORMATION';
        			$payment_text = 'PAYMENT INFORMATION';
                    $price_table = 'PRICE';
	                $qty_table   = 'QUANTITY';
	                $toppings_detail = 'Topping Detail';
	                $next_btn    = 'COMPLETE ORDER';
	                $back_btn    = 'BACK';

	                //Billing Information
	                $firstname_bill  = 'First Name';
	                $middlename_bill = 'Middle Name';
	                $lastname_bill   = 'Last Name';
	                $phone_bill      = 'Telephone';
	                $address1_bill   = 'Address 1';
	                $address2_bill   = 'Address 2';
	                $hotel_bill      = 'Hotel/Villa';
	                $city_bill       = 'City';
	                $detail_bill     = 'Detail';
        			$request_bill    = 'Request';
	                $payment_bill    = 'Payment';

	                //Alert
	                $alert_failed_text = 'Failed. Can\'t review your order. Please try again.'; 
	                $alert_error_text  = 'Error. Can\'t review your order. Please try again.'; 
                }
                else {
        			$order_text  = 'PESANAN';
        			$billing_text = 'INFORMASI TAGIHAN';
        			$payment_text = 'INFORMASI PEMBAYARAN';
                    $price_table = 'HARGA';
	                $qty_table   = 'JUMLAH';
	                $toppings_detail = 'Rincian Tambahan';
	                $next_btn    = 'SELESAI';
	                $back_btn    = 'KEMBALI';

	                //Billing Information
	                $firstname_bill  = 'Nama Depan';
	                $middlename_bill = 'Nama Tengah';
	                $lastname_bill   = 'Nama Belakang';
	                $phone_bill      = 'Telepon';
	                $address1_bill   = 'Alamat 1';
	                $address2_bill   = 'Alamat 2';
	                $hotel_bill      = 'Hotel/Vila';
	                $city_bill       = 'Kota';
	                $detail_bill     = 'Rincian';
        			$request_bill    = 'Permintaan';
	                $payment_bill    = 'Pembayaran';

	                //Alert
	                $alert_failed_text = 'Gagal. Tidak bisa menyelesaikan pesanan anda. Silahkan coba lagi.'; 
	                $alert_error_text  = 'Kesalahan. Tidak bisa menyelesaikan pesanan anda. Silahkan coba lagi.';
                }
            }

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="page-title"><?php echo $page_title ?></h1>
			<div class="page-title-border-left"></div>
			<div class="page-title-border-right"></div>
		</div>

		<div class="col-md-12 m-b-20">
				<div class="table-responsive">
				<table class="table cart table-hover table-colored">
					<thead>
						<tr>
							<th>MENU</th>
							<th class="text-right"><?php echo $price_table ?></th>
							<th></th>
							<th width="120" class="text-center"><?php echo $qty_table ?></th>
							<th class="amount text-right">SUBTOTAL</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$i = 1;
		                $total_quantity = 0;
		                $total_price    = 0;
		                foreach ($_SESSION['order'] as $your_order) {
		                	$menu_detail     = $class_our_menu->view_ourmenu_detail_order($your_order['menuid']);
		                    $total_quantity += $your_order['menutotal'];
		            ?>
		                <tr>
		                    <td>
		                        <?php 
		                            echo $menu_detail->cr_ourmenuTitle;
		                            if($your_order['menutoppings'] != 'null') {
		                                $explode_toppings = explode(',', $your_order['menutoppings']);
		                                echo ' <a role="button" data-toggle="collapse" href="#collapse-detail-'.$i.'" aria-expanded="false" aria-controls="collapse-detail-'.$i.'"><i class="fa fa-pie-chart"></i></a><br><small class="menu-topping-order"><em>';
		                                foreach($explode_toppings as $topping) {
		                                    $topping_name = $class_additional_toppings->view_additional_toppings_order($topping);
		                                    if(!isset($lang)) {
                                                if(end($explode_toppings) === $topping)
                                                    echo $topping_name->cr_toppingsName;
                                                else
                                                    echo $topping_name->cr_toppingsName.', ';
                                            }
                                            else {
                                                if($lang == $default_language->cr_languageCode) {
                                                    if(end($explode_toppings) === $topping)
                                                        echo $topping_name->cr_toppingsName;
                                                    else
                                                        echo $topping_name->cr_toppingsName.', ';
                                                }
                                                else {
                                                    if(end($explode_toppings) === $topping)
                                                        echo $topping_name->cr_toppingsName_id;
                                                    else
                                                        echo $topping_name->cr_toppingsName_id.', ';
                                                }
                                            }
		                                }
		                                echo '</em></small>'; 
		                        ?>
		                        <div class="collapse collapse-toppings-detail m-t-10" id="collapse-detail-<?php echo $i ?>">
								  	<ul class="list-group">
								  		<li class="list-group-item active"><?php echo $toppings_detail ?></li>
								  	<?php 
								  		foreach($explode_toppings as $topping_detail) {
								  			$topping_name = $class_additional_toppings->view_additional_toppings_order($topping_detail);
								  			if(!isset($lang)) {
                                                $toppings_name = $topping_name->cr_toppingsName;
                                            }
                                            else {
                                                if($lang == $default_language->cr_languageCode) {
                                                	$toppings_name = $topping_name->cr_toppingsName;
                                                }
                                                else {
                                                	$toppings_name = $topping_name->cr_toppingsName_id;
                                                }
                                            }
								  	?>
									  	<li class="list-group-item"><?php echo $toppings_name ?> <span class="pull-right"><?php echo format_rupiah($topping_name->cr_toppingsPrice) ?></span></li>
									  <?php } ?>
									</ul>
								</div>
								<?php } ?>
		                    </td>
		                    <td class="text-right">
		                    	<?php echo format_rupiah($menu_detail->cr_ourmenuPrice) ?>
		                    </td>
		                    <td></td>
		                    <td width="120" class="text-center">
		                    	<?php echo $your_order['menutotal'] ?>
		                    </td>
		                    <td class="text-right">
		                    	<?php 
		                    		if($your_order['menutoppings'] != 'null') {
		                                $total_topping_price = 0;
		                                foreach($explode_toppings as $topping) {
		                                    $topping_price = $class_additional_toppings->view_additional_toppings_order($topping);
		                                    $total_topping_price += $topping_price->cr_toppingsPrice;
		                                }
		                                if($your_order['menutotal'] > 1)
			                                $subtotal_price = $menu_detail->cr_ourmenuPrice * $your_order['menutotal'] + ($total_topping_price * $your_order['menutotal']);
			                            else
			                                $subtotal_price = $menu_detail->cr_ourmenuPrice * $your_order['menutotal'] + $total_topping_price;
		                                echo format_rupiah($subtotal_price);
		                            }   
		                            else {
		                                $subtotal_price = $menu_detail->cr_ourmenuPrice * $your_order['menutotal'];
		                                echo format_rupiah($subtotal_price);
		                            }
		                    	?>	
		                    </td>
		                </tr>
		            <?php 
		            		$i++;
		                    $total_price += $subtotal_price;
		            	} 
		            ?>
			            <tr>
		                    <td colspan="4"><strong>TOTAL <?php if($total_quantity == 0 || $total_quantity == 1) echo '<span id="tc-cart-navbar-qty-get">'.$total_quantity.'</span> '.$order_text; else echo '<span id="tc-cart-navbar-qty-get">'.$total_quantity.'</span> '.$order_text ?></strong></td>
		                    <td class="text-right"><strong><?php echo format_rupiah($total_price) ?></strong></td>
		                </tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="col-md-12">
			<hr>
		</div>
		<div class="col-md-6">
			<h4 class="m-b-20"><?php echo $billing_text ?></h4>
			<dl class="dl-horizontal">
			  	<dt><?php echo $firstname_bill ?></dt>
			  	<dd><span>:</span> <?php echo $customer_logged_in->cr_customerFirstname ?></dd>
			  	<dt><?php echo $middlename_bill ?></dt>
			  	<dd><span>:</span> <?php if($customer_logged_in->cr_customerMiddlename == '') echo '-'; else echo $customer_logged_in->cr_customerMiddlename ?></dd>
			  	<dt><?php echo $lastname_bill ?></dt>
			  	<dd><span>:</span> <?php echo $customer_logged_in->cr_customerLastname ?></dd>
			  	<dt><?php echo $phone_bill ?></dt>
			  	<dd><span>:</span> <?php echo $customer_logged_in->cr_customerPhone ?></dd>
			  	<dt>Email</dt>
			  	<dd><span>:</span> <?php echo $customer_logged_in->cr_customerEmail ?></dd>
			  	<dt><?php echo $hotel_bill ?></dt>
			  	<dd><span>:</span> <?php if($customer_logged_in->cr_customerHotelvilla == '') echo '-'; else echo $customer_logged_in->cr_customerHotelvilla ?></dd>
			  	<dt><?php echo $address1_bill ?></dt>
			  	<dd><span>:</span> <?php echo $customer_logged_in->cr_customerAddress1 ?></dd>
			  	<dt><?php echo $address2_bill ?></dt>
			  	<dd><span>:</span> <?php if($customer_logged_in->cr_customerAddress2 == '') echo '-'; else echo $customer_logged_in->cr_customerAddress2 ?></dd>
			  	<dt><?php echo $city_bill ?></dt>
			  	<dd><span>:</span> <?php echo $customer_logged_in->cr_customerCity ?></dd>
			  	<dt><?php echo $detail_bill ?></dt>
			  	<dd><span>:</span> <?php if($customer_logged_in->cr_customerDetail == '') echo '-'; else echo $customer_logged_in->cr_customerDetail ?></dd>
			  	<dt><?php echo $request_bill ?></dt>
			  	<dd><span>:</span> <?php echo $_SESSION['request'] ?></dd>
			  	<dt><?php echo $payment_bill ?></dt>
			  	<dd>: <?php if($_SESSION['payment_method'] == 'cash') echo 'Cash' ?></dd>
			</dl>
		</div>
		<div class="col-md-6">
			<h4 class="m-b-20"><?php echo $payment_text ?></h4>
			<div class="alert alert-info">
				<?php echo $function_payment_information->cr_settingValue ?>
			</div>
		</div>
		<div class="col-md-12 m-b-20">
			<hr>
			<button id="button-complete-order" class="btn btn-group btn-pizzabagus pull-right"><?php echo $next_btn ?></button>
			<a href="<?php echo $router->generate('specific-page-lang', array('lang' => $lang, 'page' => 'checkout')) ?>" class="btn btn-group btn-pizzabagus pull-right m-r-10"><?php echo $back_btn ?></a>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('#button-complete-order').click(function() {
			var action      = 'complete-order';
			var dataString  = 'act='+action;
			$.ajax({
	            type: "POST",
	            url:  "<?php echo MURL ?>cr-include/ajax/tc-cart.php",
	            data: dataString,
	            cache: false,
	            	beforeSend: function(){ $("#button-complete-order").html('COMPLETING ORDER... <i class="fa fa-spinner fa-pulse"></i>');$("#button-complete-order").attr('disabled','disabled');},
	            	success: function(data){
		            	if(data == "success") {
		            		setTimeout(function() {
	                            window.location="<?php echo $router->generate('specific-page-lang', array('lang' => $lang, 'page' => 'invoice')); ?>";
	                        }, 2000);
		            	}
		            	else if(data == "failed") {
		            		$("#button-complete-order").removeAttr('disabled');
		            		$("#button-complete-order").html('<?php echo $next_btn ?>');
		            		alert("<?php echo $alert_failed_text ?>");
		            	}
		            	else {
		            		$("#button-complete-order").removeAttr('disabled');
		            		$("#button-complete-order").html('<?php echo $next_btn ?>');
		            		alert("<?php echo $alert_error_text ?>");
		            	}
		            }
            });
			return false;
		});
    })
</script>
<?php
		}
	}
	else {
		header("Location: $redirect");
	}
?>