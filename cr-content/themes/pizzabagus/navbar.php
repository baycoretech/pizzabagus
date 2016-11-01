<?php
    $class_menu = new Menu($pdo);
    $function_view_menu = $class_menu->view_menu();

    $class_our_menu   = new Our_Menu($pdo);
    $class_additional_toppings = new Additional_Toppings($pdo);
?>
    <div class="logo-small container hidden-md hidden-lg">
            <a href="<?php echo $router->generate('home'); ?>">
                <?php
                    if($logo_image == "" || empty($logo_image)) {
                        echo '<h3 class="alternative-logo">'.$function_sitename->cr_settingValue."</h3>";
                    }
                     else {
                ?>
                <img id="logo_img" src="<?php echo MURL.'cr-editor/images/'.$logo_image ?>" style="height: 90px;" alt="<?php echo $function_sitename->cr_settingValue ?>">
                <?php
                    }
                ?>
            </a>
    </div>
    <nav class="navbar navbar-default navbar-master">
        <div id="navbar-inner-container" class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $router->generate('home-lang', array('lang' => $lang)); ?>">
                    <?php
                        if($logo_image == "" || empty($logo_image)) {
                            echo '<h3 class="alternative-logo">'.$function_sitename->cr_settingValue."</h3>";
                        }
                         else {
                    ?>
                    <img id="logo_img" src="<?php echo MURL.'cr-editor/images/'.$logo_image ?>" style="height: 85px;" alt="<?php echo $function_sitename->cr_settingValue ?>">
                    <?php
                        }
                    ?>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                        if($function_hpl->cr_settingValue == 'show') {
                            if(!isset($lang)) {
                                $home_text = 'Home';
                            }
                            else {
                                if($lang == $default_language->cr_languageCode) {
                                    $home_text = 'Home';
                                }
                                else {
                                    $home_text = 'Beranda';
                                }
                            }
                    ?>
                    <li <?php if(!isset($page)) echo 'class="active"' ?>><a href="<?php echo $router->generate('home-lang', array('lang' => $lang)); ?>"><?php echo $home_text ?> <span class="sr-only">(current)</span></a></li>
                    <?php
                        }
                        elseif($function_hpl->cr_settingValue == 'hide') {
                            echo '';
                        }
                        if($function_view_menu != false) {
                            foreach ($function_view_menu as $data) {
                                if(!isset($lang)) {
                                    //Menu
                                    $menu_title = $data->cr_menuTitle;
                                    $menu_link  = $data->cr_menuLink;
                                }
                                else {
                                    if($lang == $default_language->cr_languageCode) {
                                        //Menu
                                        $menu_title = $data->cr_menuTitle;
                                        $menu_link  = $data->cr_menuLink;
                                    }
                                    else {
                                        //Menu
                                        $menu_title_field = 'cr_menuTitle_'.$lang;
                                        $menu_title = $data->$menu_title_field;
                                        $menu_link  = $data->cr_menuLink;
                                    }
                                }
                    ?>
                    <li class="<?php if($data->cr_menuLink == $page) echo "active "; if($data->cr_menuHasSub == 1) echo 'dropdown' ?>">
                        <a class="<?php if($data->cr_menuHasSub == 1) echo "dropdown-toggle"; else echo "" ?>" <?php if($data->cr_menuHasSub == 1) echo 'data-toggle="dropdown"'; ?> href="<?php if($data->cr_menuHasSub == 1) { echo "#"; } else { if($data->cr_option == "customlink") echo $data->cr_menuLink; else echo $router->generate('specific-page-lang', array('lang' => $lang ,'page' => $menu_link)); } ?>"><?php echo $menu_title; if($data->cr_menuHasSub == 1) echo ' <i class="fa fa-caret-down"></i>' ?></a>
                        <?php 
                                if($data->cr_menuHasSub == 1) {
                                    $menu =  $data->cr_menuID;
                                    $function_view_menu_sub = $class_menu->view_menu_sub($menu); 
                        ?>
                            <ul class="dropdown-menu dropdown-navbar dropdown-navbar-master">
                                    <?php
                                        foreach ($function_view_menu_sub as $data) {
                                            if(!isset($lang)) {
                                                //Submenu
                                                $submenu_title = $data->cr_submenuTitle;
                                                $submenu_link  = $data->cr_submenuLink;
                                            }
                                            else {
                                                if($lang == $default_language->cr_languageCode) {
                                                    //Submenu
                                                    $submenu_title = $data->cr_submenuTitle;
                                                    $submenu_link  = $data->cr_submenuLink;
                                                }
                                                else {
                                                    //Submenu
                                                    $submenu_title_field = 'cr_submenuTitle_'.$lang;
                                                    $submenu_title = $data->$submenu_title_field;
                                                    $submenu_link  = $data->cr_submenuLink;
                                                }
                                            }
                                    ?>
                                <li class="<?php if($page == $data->cr_submenuLink) echo "active" ?>"><a href="<?php if($data->cr_option == "customlink") echo $data->cr_submenuLink; else echo $router->generate('specific-page-lang', array('lang' => $lang ,'page' => $submenu_link)); ?>"><?php echo $submenu_title ?></a></li>
                                    <?php
                                        }
                                    ?>
                            </ul>
                            <?php } ?>
                    </li>
                    <?php
                        }}
                        if(!empty($_SESSION['cr_customerID']) && !empty($_SESSION['cr_customerPassword'])) {
                    ?>
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-user"></i> <i class="fa fa-caret-down"></i></a>
                            <ul class="dropdown-menu dropdown-navbar">
                                <div class="dropdown-customer-info">
                                    <a href="<?php echo $router->generate('specific-page-lang', array('lang' => $lang, 'page' => 'profile')) ?>"><img class="initial-photo img-circle" src="" width="60" height="60" data-width="60" data-height="60" data-font-size="40" data-name="<?php echo $customer_displayname ?>"></a>
                                    <p><?php echo $customer_displayname ?></p>
                                    <p class="dropdown-customer-action"><a href="<?php echo $router->generate('specific-page-lang', array('lang' => $lang, 'page' => 'profile')) ?>"><i class="fa fa-user"></i></a> <a href="<?php echo MURL.'logout.php' ?>"><i class="fa fa-power-off"></i></a></p>
                                </div>
                            </ul>
                    </li>
                    <?php 
                        } 
                        else {
                            if(!isset($lang)) {
                                $signin_text   = 'SIGN IN';
                                $register_text = 'REGISTER';
                            }
                            else {
                                if($lang == $default_language->cr_languageCode) {
                                    $signin_text = 'SIGN IN';
                                    $register_text = 'REGISTER';
                                }
                                else {
                                    $signin_text = 'MASUK';
                                    $register_text = 'DAFTAR';
                                }
                            }
                    ?>
                    <li><a href="#" data-target="#modal-signin-customer" data-toggle="modal"><?php echo $signin_text ?></a></li>
                    <li><a href="#" data-target="#modal-register-customer" data-toggle="modal"><?php echo $register_text ?></a></li>
                    <?php 
                        } 

                        if(!isset($lang)) {
                            $empty_order_text = 'Your order is empty.';
                            $order_text   = 'ORDER';
                            $my_order_btn = 'MY ORDER';
                            $qty_table   = 'QTY';
                        }
                        else {
                            if($lang == $default_language->cr_languageCode) {
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
                    ?>
                    <li><a id="mybook-dropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-basket"></i> <span id="total-items" class="badge badge-pizzabagus"><?php if($page == 'invoice') { echo '0'; } else { if(isset($_SESSION['order'])) { $total = 0; foreach ($_SESSION['order'] as $your_order) { $total += $your_order['menutotal']; } echo $total; } else echo '0'; } ?></span></a>
                        <ul id="navbar-load-cart" class="dropdown-menu dropdown-navbar dropdown-navbar-master navbar-cart">
                        <?php
                            if($page == 'invoice') {
                                echo '<li><a>'.$empty_order_text.'</a></li>';
                            }
                            else {
                                if(isset($_SESSION['order'])) {
                                    $total = 0; 
                                    foreach ($_SESSION['order'] as $your_order) { 
                                        $total += $your_order['menutotal']; 
                                    }
                                    if($total != 0) {
                        ?>
                            <table class="table" style="margin-bottom: 0">
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
                                                        $topping_name = $class_additional_toppings-> view_additional_toppings_order($topping);
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
                                                }
                                            ?></td>
                                        <td class="text-center"><?php echo $your_order['menutotal'] ?></td>
                                        <td class="text-right">
                                            <?php 
                                                if($your_order['menutoppings'] != 'null') {
                                                    $total_topping_price = 0;
                                                    foreach($explode_toppings as $topping) {
                                                        $topping_price = $class_additional_toppings-> view_additional_toppings_order($topping);
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
                                        <td colspan="2"><strong>
                                            TOTAL <?php if($total_quantity == 0 || $total_quantity == 1) echo $total_quantity.' '.$order_text; else echo $total_quantity.' '.$order_text ?>
                                            </strong></td>
                                        <td class="text-right"><strong><?php echo format_rupiah($total_price) ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <a href="<?php echo $router->generate('specific-page-lang', array('lang' => $lang, 'page' => 'my-order')) ?>" class="btn btn-pizzabagus btn-sm pull-right"><?php echo $my_order_btn ?></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <?php
                                    }
                                    else {
                        ?>
                        <li><a><?php echo $empty_order_text ?></a></li>
                        <?php
                                    }
                                }
                                else {
                        ?>
                        <li><a><?php echo $empty_order_text ?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>

                    </li>
                  </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </nav>