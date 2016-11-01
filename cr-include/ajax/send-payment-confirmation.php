<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../error-report.php';
    require __DIR__.'/../database/connection.php';
    require __DIR__.'/../autoloader.php'; 
    require __DIR__.'/../setup-function.php'; 
    require __DIR__.'/../global-function.php';

    $name           = $_POST['name'];
    $from_bank      = $_POST['transferfrom'];
    $to_bank        = $_POST['transferto'];
    $total          = $_POST['total'];
    $photo          = $_POST['image'];
    $invoice_number = $_POST['invoice_number'];

    $class_invoice           = new Invoice($pdo);
	$function_view_invoice   = $class_invoice->view_invoice($invoice_number);
    $invoice_id              = $function_view_invoice->cr_invoiceID;

    if($function_view_invoice != false) {
        if($function_view_invoice->cr_invoicePackagetype == 'voucher') {
            $function_invoice_detail = $class_invoice->view_invoice_detail($invoice_number);
            $total_price    = 0;
            foreach($function_invoice_detail as $data) {
                if($data->cr_packageType == 'spa') {
                    $class_spa = new Featured_Spa($pdo);
                    $function_view_spa_detail_book = $class_spa->view_spa_detail_book($data->cr_packageID);
                    $book_price   = $data->cr_packageQuantity * $function_view_spa_detail_book->cr_spaPrice;
                }
                elseif($data->cr_packageType == 'adventure') {
                    $class_adventure = new Featured_Adventure($pdo);
                    $function_view_adventure_detail_book = $class_adventure->view_adventure_detail_book($data->cr_packageID);
                    $book_price   = $data->cr_packageQuantity * $function_view_adventure_detail_book->cr_adventurePrice;
                }
                elseif($data->cr_packageType == 'golf') {
                    $class_golf = new Featured_Golf($pdo);
                    $function_view_golf_detail_book = $class_golf->view_golf_detail_book($data->cr_packageID);
                    $book_price   = $data->cr_packageQuantity * $function_view_golf_detail_book->cr_golfPrice;
                }
                $total_price    += $book_price;
            }
        }
        elseif($function_view_invoice->cr_invoicePackagetype == 'tour') {
            $function_invoice_detail = $class_invoice->view_invoice_detail($invoice_number);
            $total_price    = 0;
            $class_tour  = new Featured_Tours($pdo);
            foreach($function_invoice_detail as $data) {
                $function_view_tour_detail_book = $class_tour->view_tour_detail_book($data->cr_packageID);
                $book_price   = $data->cr_packageQuantity * $function_view_tour_detail_book->cr_tourPrice;
                $total_price    += $book_price;
            }
        }
        elseif($function_view_invoice->cr_invoicePackagetype == 'car') {
            $function_invoice_detail = $class_invoice->view_invoice_detail($invoice_number);
            $total_price    = 0;
            $class_car_rental = new Featured_Car_Rental($pdo);
            foreach($function_invoice_detail as $data) {
                $function_car_rental_booking = $class_car_rental->car_rental_booking($data->cr_packageID);
                $explode_desc = explode(',', $data->cr_packageDesc);
                if($explode_desc[0] == 'self') {
                    if($function_car_rental_booking->cr_carPricecondition == 'hour') {
                        $car_rent_hours = $function_car_rental_booking->cr_carPricetime;
                    }
                    elseif($function_car_rental_booking->cr_carPricecondition == 'day') {
                        $car_rent_hours = $function_car_rental_booking->cr_carPricetime * 24;
                    }
                    $start = new DateTime($explode_desc[4]);
                    $end   = new DateTime($explode_desc[5]);
                    $diff = $end->diff($start);
                    $hours = $diff->h;
                    $hours = $hours + ($diff->days*24);
                    if($hours == 1)  
                        $estimated_hours = $hours.' hour'; 
                    else  
                        $estimated_hours = $hours.' hours';
                    if($hours <= $car_rent_hours) {
                        $book_price = $function_car_rental_booking->cr_carPrice;
                    }
                    else {
                        $over_time  = $hours - $car_rent_hours;
                        $multiplier = floor($hours / $car_rent_hours);
                        $mod        = $hours % $car_rent_hours;
                        if($over_time > 5) {
                            $book_price = $function_car_rental_booking->cr_carPrice * ($multiplier + 1);
                        }
                        else {
                            $book_price = $function_car_rental_booking->cr_carPrice + (0.1 * $function_car_rental_booking->cr_carPrice);
                        }
                    }
                }
                elseif($explode_desc[0] == 'driver') {
                    if($function_car_rental_booking->cr_carPriceconditionwithdriver == 'hour') {
                        $car_rent_hours = $function_car_rental_booking->cr_carPricetimewithdriver;
                    }
                    elseif($function_car_rental_booking->cr_carPriceconditionwithdriver == 'day') {
                        $car_rent_hours = $function_car_rental_booking->cr_carPricetimewithdriver * 24;
                    }
                    $start = new DateTime($explode_desc[5]);
                    $end   = new DateTime($explode_desc[7]);
                    $diff = $end->diff($start);
                    $hours = $diff->h;
                    $hours = $hours + ($diff->days*24);
                    if($hours == 1)  
                        $estimated_hours = $hours.' hour'; 
                    else  
                        $estimated_hours = $hours.' hours';
                    if($hours <= $car_rent_hours) {
                        $book_price = $function_car_rental_booking->cr_carPricewithdriver;
                    }
                    else {
                        $over_time  = $hours - $car_rent_hours;
                        $multiplier = floor($hours / $car_rent_hours);
                        $mod        = $hours % $car_rent_hours;
                        if($over_time > 5) {
                            $book_price = $function_car_rental_booking->cr_carPricewithdriver * ($multiplier + 1);
                        }
                        else {
                            $book_price = $function_car_rental_booking->cr_carPricewithdriver + (0.1 * $function_car_rental_booking->cr_carPricewithdriver);
                        }
                    }
                }
                $total_price    += $book_price;
            }
        }
        $total_payment = ($total_price + ($total_price * 0.1));
    }

    if(empty($name) || empty($from_bank) || empty($to_bank) || empty($total) || empty($from_bank)) {
    	echo 'empty-field';
    }
    else {
    	if(empty($photo)) {
    		echo 'empty-image';
    	}
    	elseif($total != $total_payment) {
    		echo 'wrong-total';
    	}
    	else {
    		$class_general_setting    = new General_Setting($pdo);
		    //Set timezone
		    $v_set_timezone           = $class_general_setting->set_timezone();
		    $get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
		    if(!empty($v_set_timezone->cr_settingValue)) {
		        date_default_timezone_set($get_timezone_city);
		    }
		    $date_for_now = new DateTime();
		    $date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
		    $now_date     = $date_for_now->format('Y-m-d H:i:s');
		    //Same format as NOW(), use to save datetime value to database, without timezone, that will be diffrent datetime insert in database

		    $function_send_receipt = $class_invoice->send_receipt($now_date, $from_bank, $to_bank, $total, $name, $photo, $invoice_id);
		    if($function_send_receipt == true) {
		    	echo 'true';
		    }
		    else {
		    	echo 'false';
		    }
    	}
    }
?>