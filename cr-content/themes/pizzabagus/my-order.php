<?php
	if(!isset($lang)) {
        $empty_order_text = 'Your order is empty.';
        $order_text  = 'ORDER';
        $price_table = 'PRICE';
        $qty_table   = 'QUANTITY';
        $act_table   = 'ACTION';
        $toppings_detail = 'Topping Detail';
        $remove_btn  = 'REMOVE';
        $update_btn  = 'UPDATE ORDER';
        $checkout_btn = 'CHECKOUT';
        $next_btn    = 'NEXT';
        $back_btn    = 'BACK';
    }
    else {
        if($lang == $default_language->cr_languageCode) {
        	$empty_order_text = 'Your order is empty.';
        	$order_text  = 'ORDER';
            $price_table = 'PRICE';
            $qty_table   = 'QUANTITY';
        	$act_table   = 'ACTION';
            $toppings_detail = 'Topping Detail';
        	$remove_btn  = 'REMOVE';
        	$update_btn  = 'UPDATE ORDER';
        	$checkout_btn = 'CHECKOUT';
            $next_btn    = 'NEXT';
            $back_btn    = 'BACK';
        }
        else {
        	$empty_order_text = 'Pesanan masih kosong.';
        	$order_text  = 'PESANAN';
            $price_table = 'HARGA';
            $qty_table   = 'JUMLAH';
        	$act_table   = 'AKSI';
            $toppings_detail = 'Rincian Tambahan';
        	$remove_btn  = 'HAPUS';
        	$update_btn  = 'PERBARUI PESANAN';
        	$checkout_btn = 'PERIKSA';
            $next_btn    = 'LANJUT';
            $back_btn    = 'KEMBALI';
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
		<?php
			if(isset($_SESSION['order'])) {
				if(count($_SESSION['order']) == 0) {
		?>
			<div class="alert alert-info" role="alert">
				<?php echo $empty_order_text ?>
			</div>
		<?php
				}
				else {
		?>
			<form id="form-update-cart" data-parsley-validate action="" method="POST">
				<input type="hidden" name="act" value="update">
				<div class="table-responsive">
				<table class="table cart table-hover table-colored">
					<thead>
						<tr>
							<th>MENU</th>
							<th class="text-right"><?php echo $price_table ?></th>
							<th></th>
							<th width="120" class="text-center"><?php echo $qty_table ?></th>
							<th class="text-center"><?php echo $act_table ?></th>
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
		                    	<div class="form-group">
		                    		<div class="input-group">
			                            <input id="order-total-<?php echo $i ?>" type="text" class="form-control order-total input-sm" placeholder="0" data-parsley-type="integer" data-parsley-min="1" data-parsley-max="50" name="menuqty[<?php echo $your_order['menuid'].'!'.$your_order['menutoppings'] ?>]" data-parsley-errors-container=".order_total_error_<?php echo $i ?>" value="<?php echo $your_order['menutotal'] ?>" required>
			                            <div class="input-group-btn">
			                                <button type="button" class="btn btn-default btn-sm total-increase-<?php echo $i ?>"><i class="fa fa-plus"></i></button>
			                                <button type="button" class="btn btn-default btn-sm total-decrease-<?php echo $i ?>"><i class="fa fa-minus"></i></button>
			                            </div>
			                        </div>
	                        		<div class="order_total_error_<?php echo $i ?>"></div>
								</div>
		                    </td>
		                    <script type="text/javascript">
							    $(document).ready(function(){
							    	$order_total = $('#order-total-<?php echo $i ?>');
									$order_total.updown({ step: 1, min: 1, max: 50 });
							        var $updown = $order_total.data('updown');
							        $('.total-increase-<?php echo $i ?>').click(function(event){
							            $updown.increase(event);
							            $updown.triggerEvents();
							        });
							        $('.total-decrease-<?php echo $i ?>').click(function(event){
							            $updown.decrease(event);
							            $updown.triggerEvents();
							        });
						        });
						    </script>
		                    <td class="text-center">
		                    	<button id="button-remove-order-<?php echo $i ?>" class="btn btn-sm btn-pizzabagus" data-index="<?php echo $your_order['menuid'].'!'.$your_order['menutoppings'] ?>"><span class="hidden-xs hidden-sm"><?php echo $remove_btn ?></span><span class="hidden-md hidden-lg"><i class="fa fa-times"></i></span></button>
		                    </td>
		                    <script type="text/javascript">
								$(document).ready(function() {
									$('#button-remove-order-<?php echo $i ?>').click(function() {
										var action       = 'del';
										var toppings     = $('#button-remove-order-<?php echo $i ?>').attr("data-toppings");
										var index        = $('#button-remove-order-<?php echo $i ?>').attr("data-index");
									    var dataString   = 'act='+action+'&index='+index;
									    console.log(dataString);
										$.ajax({
								            type: "POST",
								            url:  "<?php echo MURL ?>cr-include/ajax/tc-cart.php",
								            data: dataString,
								            cache: false,
								            	beforeSend: function(){ $("#button-remove-order-<?php echo $i ?>").html('<i class="fa fa-spinner fa-pulse"></i>');$("#button-remove-order-<?php echo $i ?>").attr('disabled','disabled');},
								            	success: function(data){
									            	if(data == "success") {
									            		window.location.reload();
									            	}
									            	else if(data == "failed") {
									            		alert("Failed. Can't remove menu from your order. Please try again.");
									            		$("#button-remove-order-<?php echo $i ?>").removeAttr('disabled');
									            		$("#button-remove-order-<?php echo $i ?>").html('<span class="hidden-xs hidden-sm">REMOVE</span><span class="hidden-md hidden-lg"><i class="fa fa-times"></i></span>');
									            	}
									            	else {
									            		alert("Error. Can't remove menu from your order. Please try again.");
									            		$("#button-remove-order-<?php echo $i ?>").removeAttr('disabled');
									            		$("#button-remove-order-<?php echo $i ?>").html('<span class="hidden-xs hidden-sm">REMOVE</span><span class="hidden-md hidden-lg"><i class="fa fa-times"></i></span>');
									            	}
									            }
							            });
										return false;
									});
								});
							</script>
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
		                    <td colspan="5"><strong>TOTAL <?php if($total_quantity == 0 || $total_quantity == 1) echo '<span id="tc-cart-navbar-qty-get">'.$total_quantity.'</span> '.$order_text; else echo '<span id="tc-cart-navbar-qty-get">'.$total_quantity.'</span> '.$order_text ?></strong></td>
		                    <td class="text-right"><strong><?php echo format_rupiah($total_price) ?></strong></td>
		                </tr>
					</tbody>
				</table>
			</div>
			<a class="btn btn-group btn-pizzabagus pull-right" <?php if(empty($_SESSION['cr_customerID']) && empty($_SESSION['cr_customerPassword'])) { ?> type="button" role="button" data-toggle="modal" data-target="#modal-signin-customer" <?php } else { ?> href="<?php echo $router->generate('specific-page-lang', array('lang' => $lang, 'page' => 'checkout')) ?>" <?php } ?>><?php echo $checkout_btn ?></a>
			<button id="button-update-cart" type="submit" class="btn btn-group btn-pizzabagus pull-right m-r-10"><?php echo $update_btn ?></button>
			</form>
		<?php
				}
			}
			else {
		?>
			<div class="alert alert-info" role="alert">
				<?php echo $empty_order_text ?>
			</div>
		<?php } ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var update_cart;
        $("#form-update-cart").submit(function(event){
            if ($(this).parsley().isValid()) {
	            if (update_cart) {
	                update_cart.abort();
	            }
	            var $form = $(this);
	            var $inputs = $form.find("input, button, textarea");
	            var serializedData = $form.serialize();
	            update_cart = $.ajax({
	                url: "<?php echo MURL ?>cr-include/ajax/tc-cart.php",
	                type: "post",
	                beforeSend: function(){ $("#button-update-cart").html('<i class="fa fa-spinner fa-pulse"></i>');$("#button-update-cart").attr('disabled','disabled');},
	                data: serializedData
	            });
	            update_cart.done(function (msg){
	                if(msg == "success") {
						window.location.reload();
					}
					else if(msg == "failed") {
						alert("Failed. Can't update your order. Please try again.");
						$("#button-update-cart").removeAttr('disabled');
						$("#button-update-cart").html('<?php echo $update_btn ?>');
					}
					else {
						alert("Error. Can't update your order. Please try again.");
						$("#button-update-cart").removeAttr('disabled');
						$("#button-update-cart").html('<?php echo $update_btn ?>');
					}
	            });
	            update_cart.always(function () {
	                $inputs.prop("disabled", false);
	            });
	            event.preventDefault();
	        }
        });
    })
</script>