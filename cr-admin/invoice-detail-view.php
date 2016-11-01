<?php
    $invoice_number    = $action;
    $function_sitename = $class_settings->view_settings_sitename();
    $function_tagline  = $class_settings->view_settings_tagline();
    $function_email    = $class_settings->view_settings_email();
    $function_phone    = $class_settings->view_settings_phone();
    $function_address  = $class_settings->view_settings_address();
    //$function_tax_payment  = $class_settings->view_settings_tax_payment();

    $class_invoice         = new Invoice($pdo);
    $function_view_invoice = $class_invoice->view_invoice_detail_paper($invoice_number);
    $invoice_date          = date($function_date_format->cr_settingValue, strtotime($function_view_invoice->cr_invoiceDate));
    $explode_type          = explode(',', $function_view_invoice->cr_invoiceType);
    $class_customer = new Customer($pdo);
    $customer_data  = $class_customer->edit_customer($explode_type[1]);

    $class_ourmenu  = new Our_Menu($pdo);
    $class_additional_toppings  = new Additional_Toppings($pdo);

    $function_view_logo = $class_appearance->view_logo();
    $function_get_theme = $class_appearance->get_theme();
    $logo_image      = $function_view_logo->cr_settingValue;
    //change .png thumbnails format to .GIF, .JPG, and .JPEG, select which file are exist
    $logo_image_gif  = str_replace(".png",".gif",$logo_image);
    $logo_image_jpg  = str_replace(".png",".jpg",$logo_image);
    $logo_image_jpeg = str_replace(".png",".jpeg",$logo_image);
    //remove "/thumbnails" to get the real image
    $logo_image_nt     = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image;
    $logo_image_gif_nt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image_gif;
    $logo_image_jpg_nt  = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image_jpg;
    $logo_image_jpeg_nt = $_SERVER['DOCUMENT_ROOT'].ABSPATH.'cr-editor/images/'.$logo_image_jpeg;

    $logo_image_link     = MURL.'cr-editor/images/'.$logo_image;
    $logo_image_gif_link  = MURL.'cr-editor/images/'.$logo_image_gif;
    $logo_image_jpg_link  = MURL.'cr-editor/images/'.$logo_image_jpg;
    $logo_image_jpeg_link = MURL.'cr-editor/images/'.$logo_image_jpeg;

    if(file_exists($logo_image_nt)) { 
        $image_path =  $logo_image_link; 
    } 
    elseif(file_exists($logo_image_gif_nt)) { 
        $image_path =  $logo_image_gif_link; 
    } 
    elseif(file_exists($logo_image_jpg_nt)) {
        $image_path =  $logo_image_jpg_link; 
    } 
    elseif(file_exists($logo_image_jpeg_nt)) { 
        $image_path =  $logo_image_jpeg_link; 
    } 
?>
<div class="invoice">
    <div class="invoice-company text-inverse">
        <span class="pull-right hidden-xs hidden-sm hidden-print">
        <!--<a href="javascript:;" class="btn btn-sm btn-bmw m-b-10"><i class="fa fa-file-pdf-o m-r-5"></i> Export as PDF</a>-->
        <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-print"></i> Print</a>
        </span>
        <?php
            if($logo_image == '' || empty($logo_image)) {
                echo '<h3 class="alternative-logo">'.$function_sitename->cr_settingValue."</h3>";
            }
             else {
        ?>
        <img src="<?php echo $image_path ?>" style="height: 60px;" alt="<?php echo $function_sitename->cr_settingValue ?>">
        <?php
            }
        ?>
    </div>
    <div class="invoice-header">
        <div class="invoice-from">
            <strong>Customer Details</strong>
            <address class="m-t-5 m-b-5">
            <dl class="dl-horizontal">
                <dt>Name</dt>
                <dd><span>:</span> <?php echo $customer_data->cr_customerTitle.'. '.$customer_data->cr_customerFirstname.' '.$customer_data->cr_customerLastname ?></dd>
                <dt>Phone</dt>
                <dd><span>:</span> <?php echo $customer_data->cr_customerPhone ?></dd>
                <dt>Email</dt>
                <dd><span>:</span> <?php echo $customer_data->cr_customerEmail ?></dd>
                <dt>Address 1</dt>
                <dd><span>:</span> <?php echo $customer_data->cr_customerAddress1 ?></dd>
                <dt>Address 2</dt>
                <dd><span>:</span> <?php if($customer_data->cr_customerAddress2 == '') echo '-'; else echo $customer_data->cr_customerAddress2 ?></dd>
                <dt>Detail</dt>
                <dd><span>:</span> <?php if($customer_data->cr_customerDetail == '') echo '-'; else echo $customer_data->cr_customerDetail ?></dd>
            </dl>
            </address>
        </div>
        <div class="invoice-to">
            <strong>Payment Details</strong>
            <address class="m-t-5 m-b-5">
                <dl class="dl-horizontal">
                <dt>Payment</dt>
                <dd><span>:</span> <?php if($function_view_invoice->cr_invoicePayment == 'cash') echo 'Cash'; elseif($function_view_invoice->cr_invoicePayment == 'bank') echo 'Bank Transfer' ?></dd>
                <dt>Status</dt>
                <dd><span>:</span> <?php echo ucwords($function_view_invoice->cr_invoiceStatus) ?></dd>
            </address>
            
            <strong>Note and Special Request</strong>
            <p><?php if($function_view_invoice->cr_invoiceCustomeraddinfo == '') echo 'None'; else echo $function_view_invoice->cr_invoiceCustomeraddinfo ?></p>
            
        </div>
        <div class="invoice-date">
            <div class="date m-t-5"><strong>Invoice</strong></div>
            <div class="invoice-detail">
                Number : #<?php echo $function_view_invoice->cr_invoiceNumber ?><br />
                Date : <?php echo $invoice_date ?>
            </div>
        </div>
    </div>
    <div class="invoice-content">
        <div class="table-responsive">
            <table class="table table-invoice">
                <thead>
                    <tr>
                        <th>MENU</th>
                        <th class="text-right">PRICE</th>
                        <th class="text-center" width="120">QUANTITY</th>
                        <th class="text-right">SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $function_invoice_detail = $class_invoice->view_invoice_detail($function_view_invoice->cr_invoiceNumber);
                    $total_quantity = 0;
                    $total_price    = 0;
                    foreach($function_invoice_detail as $data) {
                        $menu_detail     = $class_ourmenu->view_ourmenu_detail_order($data->cr_ourmenuID);
                        $menu_name       = $menu_detail->cr_ourmenuTitle;
                        $menu_price      = $menu_detail->cr_ourmenuPrice;
                        $menu_toppings   = $data->cr_ourmenuToppings;
                        $total_quantity += $data->cr_ourmenuQuantity;
                ?>
                    <tr>
                        <td>
                            <?php echo $menu_name ?><br>
                            <small><em>
                                <?php
                                    if($menu_toppings != 'null') {
                                        echo 'with additional topping(s)<br>';
                                        $explode_toppings = explode(',', $menu_toppings);
                                        foreach($explode_toppings as $topping) {
                                            $topping_name = $class_additional_toppings->view_additional_toppings_order($topping);
                                            echo '<i class="fa fa-check-square-o"></i> '.$topping_name->cr_toppingsName.'<br>';
                                        }
                                    }
                                ?>
                            </em></small>
                        </td>
                        <td class="text-right">
                            <?php
                                echo format_rupiah($menu_price);
                                if($menu_toppings != 'null') {
                                    echo '<br><br>';
                                    $explode_toppings = explode(',', $menu_toppings);
                                    foreach($explode_toppings as $topping) {
                                        $topping_name = $class_additional_toppings->view_additional_toppings_order($topping);
                                        echo format_rupiah($topping_name->cr_toppingsPrice).'<br>';
                                    }
                                }
                            ?>
                        </td>
                        <td class="text-center"><?php echo $data->cr_ourmenuQuantity ?></td>
                        <td class="text-right">
                            <?php 
                                if($data->cr_ourmenuToppings != 'null') {
                                    $total_topping_price = 0;
                                    $explode_toppings = explode(',', $menu_toppings);
                                    foreach($explode_toppings as $topping) {
                                        $topping_price = $class_additional_toppings->view_additional_toppings_order($topping);
                                        $total_topping_price += $topping_price->cr_toppingsPrice;
                                    }
                                    if($data->cr_ourmenuQuantity > 1)
                                        $subtotal_price = $menu_price * $data->cr_ourmenuQuantity + ($total_topping_price * $data->cr_ourmenuQuantity);
                                    else
                                        $subtotal_price = $menu_price * $data->cr_ourmenuQuantity + $total_topping_price;
                                    echo format_rupiah($subtotal_price);
                                }   
                                else {
                                    $subtotal_price = $menu_price * $data->cr_ourmenuQuantity;
                                    echo format_rupiah($subtotal_price);
                                }
                            ?>
                        </td>
                    </tr>
                <?php 
                        $total_price += $subtotal_price;
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="invoice-price">
            <div class="invoice-price-left">
                <div class="invoice-price-row">
                    <div class="sub-price">
                        <small>SUBTOTAL</small>
                        <?php 
                            echo format_rupiah($total_price);
                        ?>
                    </div>
                    <div class="sub-price">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="sub-price">
                        <small>TAX</small>
                        Prices are inclusive of 10% government tax.
                    </div>
                </div>
            </div>
            <div class="invoice-price-right">
                <small>TOTAL</small>
                <?php 
                    echo format_rupiah($total_price);
                ?>
            </div>
        </div>
    </div>
    
    <div class="invoice-note">
        <?php
            $class_commerce_settings  = new Commerce_Settings($pdo);
            $function_term_of_service = $class_commerce_settings->view_settings_term_of_service();
            echo $function_term_of_service->cr_settingValue;
        ?>
        <!--
        * We will deliver your order immedietely.<br />
        * If you have any questions concerning this invoice, please contact us.
        -->

    </div>
    <!--<div class="invoice-border-top"><img src="<?php echo MURL."cr-content/themes/".$function_get_theme->cr_settingValue ?>/images/invoice-line.png"></div>-->
    <div class="invoice-footer text-muted">
        <p class="invoice-thanks text-center m-b-5">
            THANK YOU FOR YOUR ORDER
        </p>
        <p class="text-center">
            <span class="m-r-10"><i class="fa fa-globe"></i> <?php echo $_SERVER['SERVER_NAME'] ?></span>
            <span class="m-r-10"><i class="fa fa-phone"></i> <?php echo $function_phone->cr_settingValue ?></span>
            <span class="m-r-10"><i class="fa fa-envelope"></i> <?php echo $function_email->cr_settingValue ?></span>
        </p>
    </div>
    <!--<a href="javascript:;" class="btn btn-sm btn-primary btn-block hidden-md hidden-lg hidden-print m-t-20 m-b-10"><i class="fa fa-file-pdf-o m-r-5"></i> Export as PDF</a>-->
    <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-primary btn-block hidden-md hidden-lg hidden-print m-b-10"><i class="fa fa-print"></i> Print</a>
</div>