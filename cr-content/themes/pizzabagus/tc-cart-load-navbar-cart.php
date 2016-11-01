<?php
	if (!isset($_SESSION)) {
	    session_start();
	}
	require __DIR__.'/../../../cr-include/error-report.php';
    require __DIR__.'/../../../cr-include/database/connection.php';
    require __DIR__.'/../../../cr-include/autoloader.php'; 
    require __DIR__.'/../../../cr-include/global-function.php';
    require __DIR__.'/../../../cr-include/altorouter.php';

    $router       = new AltoRouter();
    if($v_get_folder_name != '0') {
        $router->setBasePath('/'.$v_get_folder_name);
    }
    require __DIR__.'/../../../cr-include/routes.php';

    //Set default language page
    $class_language   = new Language($pdo);
    $default_language = $class_language->default_language();
    $default_page     = $default_language->cr_languageCode;
    $current_language = $_GET['lang'];

    if(!isset($default_page)) {
        $empty_order_text = 'Your order is empty.';
        $order_text   = 'ORDER';
        $my_order_btn = 'MY ORDER';
        $qty_table   = 'QTY';
    }
    else {
        if($current_language == $default_language->cr_languageCode) {
            $empty_order_text = 'Your order is empty.';
            $order_text   = 'ORDER';
            $my_order_btn = 'MY ORDER';
            $qty_table   = 'QTY';
        }
        else {
            $empty_order_text = 'Pesanan masih kosong.';
            $order_text   = 'PESANAN';
            $my_order_btn = 'PESANAN SAYA';
            $qty_table   = 'JUMLAH';
        }
    }
	
	if(isset($_SESSION['order'])) {
		if(count($_SESSION['order']) == 0) {
?>
	<li>
		<table class="table table-hover">
			<thead>
				<tr>
					<th><?php echo $empty_order_text ?></th>
				</tr>
			</thead>
		</table>
	</li>
<?php
		}
		else {
			$class_our_menu   = new Our_Menu($pdo);
    		$class_additional_toppings = new Additional_Toppings($pdo);
?>
	<li>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>MENU</th>
                    <th class="text-center"><?php echo $qty_table ?></th>
                    <th class="text-right">SUBTOTAL</th>
				</tr>
			</thead>
			<tbody>
			<?php
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
                                echo '<br><small class="menu-topping-order"><em>';
                                foreach($explode_toppings as $topping) {
                                    $topping_name = $class_additional_toppings->view_additional_toppings_order($topping);
                                    if(!isset($default_page)) {
                                        if(end($explode_toppings) === $topping)
                                            echo $topping_name->cr_toppingsName;
                                        else
                                            echo $topping_name->cr_toppingsName.', ';
                                    }
                                    else {
                                        if($current_language == $default_language->cr_languageCode) {
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
                            }
                        ?></td>
                    <td class="text-center"><?php echo $your_order['menutotal'] ?></td>
                    <td class="text-right">
                    	<?php 
                    		if($your_order['menutoppings'] != 'null') {
                                $total_topping_price = 0;
                                foreach($explode_toppings as $topping) {
                                    $topping_price = $class_additional_toppings->view_additional_toppings_order($topping);
                                    $total_topping_price += $topping_price->cr_toppingsPrice;
                                }
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
                    $total_price += $subtotal_price;
            	} 
            ?>

                <tr>
                    <td colspan="2"><strong>TOTAL <?php if($total_quantity == 0 || $total_quantity == 1) echo '<span id="tc-cart-navbar-qty-get">'.$total_quantity.'</span> '.$order_text; else echo '<span id="tc-cart-navbar-qty-get">'.$total_quantity.'</span> '.$order_text ?></strong></td>
                    <td class="text-right"><strong><?php echo format_rupiah($total_price) ?></strong></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a href="<?php echo $router->generate('specific-page-lang', array('lang' => $default_page,'page' => 'my-order')) ?>" class="btn btn-pizzabagus btn-sm pull-right"><?php echo $my_order_btn ?></a>
                    </td>
                </tr>
            </tbody>
		</table>
	</li>
<?php
		}
	}
	else {
?>
	<li>
		<table class="table table-hover">
			<thead>
				<tr>
					<th><?php echo $empty_order_text ?></th>
				</tr>
			</thead>
		</table>
	</li>
<?php
	}
?>