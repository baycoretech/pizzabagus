<?php
require __DIR__.'/../error-report.php';
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['type'])) {
    $type = $_POST['type'];
    $step = $_POST['step'];
    if($type == 'car') {
    	if(isset($step)) {
    		if($step == 'booking-details') {
                if(isset($_POST['car_id']) && isset($_POST['adult']) && isset($_POST['driver']) && isset($_POST['payment'])) {
        			$_SESSION['car_car_id']      = $_POST['car_id'];
        			$_SESSION['car_adult']       = $_POST['adult'];
        			$_SESSION['car_kids']        = $_POST['kids'];
        			$_SESSION['car_infant']      = $_POST['infant'];
        			$_SESSION['car_driver']      = $_POST['driver'];
        			$_SESSION['car_startdate']   = $_POST['startdate'];
        			$_SESSION['car_starttime']   = $_POST['starttime'];
        			$_SESSION['car_enddate']     = $_POST['enddate'];
        			$_SESSION['car_endtime']     = $_POST['endtime'];
        			$_SESSION['car_pickup']      = $_POST['pickup'];
        			$_SESSION['car_pickupdate']  = $_POST['pickupdate'];
        			$_SESSION['car_pickuptime']  = $_POST['pickuptime'];
        			$_SESSION['car_dropoff']     = $_POST['dropoff'];
        			$_SESSION['car_dropoffdate'] = $_POST['dropoffdate'];
        			$_SESSION['car_dropofftime'] = $_POST['dropofftime'];
        			$_SESSION['car_payment_method'] = $_POST['payment'];
        			$_SESSION['car_request']     = $_POST['request'];
        			echo 'success';
                }
                else {
                    echo 'failed';
                }
    		}
    		elseif($step == 'contact-details') {
                if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['nationality'])) {
        			$_SESSION['car_contactname']     = $_POST['name'];
        			$_SESSION['car_contactemail']    = $_POST['email'];
                    $_SESSION['car_contactphone']    = $_POST['phone'];
        			$_SESSION['car_contactaddress']  = $_POST['address'];
                    $_SESSION['car_contactnationality']  = $_POST['nationality'];
                    if($_POST['nationality'] == 'Indonesia') {
                        $_SESSION['car_contactid']  = $_POST['idcardtype'].','.$_POST['idcard'];
                    }
                    else {
                        $_SESSION['car_contactid']  = 'Passport,'.$_POST['passport'];
                    }
        			echo 'success';
                }
                else {
                    echo 'failed';
                }
    		}
    		elseif($step == 'complete') {
                $_SESSION['invoice_type'] = $type;
    			echo 'success';
    		}
    		else {
    			echo 'failed';
    		}
    	}
    	else {
    		echo 'failed';
    	}
    }
    elseif($type == 'tour') {
        if(isset($step)) {
            if($step == 'booking-details') {
                if(isset($_POST['tour_id']) && isset($_POST['pax']) && isset($_POST['date']) && isset($_POST['time'])) {
                    $_SESSION['tour_tour_id'] = $_POST['tour_id'];
                    $_SESSION['tour_pax']     = $_POST['pax'];
                    $_SESSION['tour_date']    = $_POST['date'];
                    $_SESSION['tour_time']    = $_POST['time'];
                    echo 'success';
                }
                else {
                    echo 'failed';
                }
            }
            elseif($step == 'participant-details') {
                if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['nationality']) && isset($_POST['address'])) {
                    $partname        = $_POST['name'];
                    $partemail       = $_POST['email'];
                    $partphone       = $_POST['phone'];
                    $partnationality = $_POST['nationality'];
                    $partaddress     = $_POST['address'];
                    if($partnationality == 'Indonesia') {
                        $partid  = $_POST['idcardtype'].','.$_POST['idcard'];
                    }
                    else {
                        $partid  = 'Passport,'.$_POST['passport'];
                    }
                    foreach($partname as $key => $value) {
                        if($partnationality == 'Indonesia') {
                            $_SESSION['tour_participants'][$key] = array('partname' => $value, 'partemail' => $partemail[$key], 'partphone' => $partphone[$key], 'partnationality' => $partnationality[$key], 'partid' => $_POST['idcardtype'][$key].','.$_POST['idcard'][$key], 'partaddress' => $partaddress[$key]);
                        }
                        else {
                            $_SESSION['tour_participants'][$key] = array('partname' => $value, 'partemail' => $partemail[$key], 'partphone' => $partphone[$key], 'partnationality' => $partnationality[$key], 'partid' => 'Passport,'.$_POST['idcard'][$key], 'partaddress' => $partaddress[$key]);
                        }
                    }
                    echo 'success';
                }
                else {
                    echo 'failed';
                }
            }
            elseif($step == 'contact-details') {
                if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['nationality'])) {
                    $_SESSION['tour_contactname']     = $_POST['name'];
                    $_SESSION['tour_contactemail']    = $_POST['email'];
                    $_SESSION['tour_contactphone']    = $_POST['phone'];
                    $_SESSION['tour_contactaddress']  = $_POST['address'];
                    $_SESSION['tour_contactnationality']  = $_POST['nationality'];
                    if($_POST['nationality'] == 'Indonesia') {
                        $_SESSION['tour_contactid']  = $_POST['idcardtype'].','.$_POST['idcard'];
                    }
                    else {
                        $_SESSION['tour_contactid']  = 'Passport,'.$_POST['passport'];
                    }
                    echo 'success';
                }
                else {
                    echo 'failed';
                }
            }
            elseif($step == 'complete') {
                $_SESSION['invoice_type'] = $type;
                $_SESSION['tour_payment_method'] = 'bank';
                echo 'success';
            }
            else {
                echo 'failed';
            }
        }
        else {
            echo 'failed';
        }
    }   
}
else {
	echo 'failed';
}
?>