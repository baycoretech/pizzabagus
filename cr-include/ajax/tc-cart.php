<?php
require __DIR__.'/../error-report.php';
if (!isset($_SESSION)) {
    session_start();
}

if(isset($_POST['act'])) {
    $action = $_POST['act'];
    if($action == "add") {
        if(isset($_POST['menuid']) && isset($_POST['totalorder'])) {
            $menuid       = $_POST['menuid'];
            $menutotal    = $_POST['totalorder'];
            $replace_toppings = str_replace(',', '', $_POST['toppings']);
            if($replace_toppings == '' || $_POST['toppings'] == '')
                $menutoppings = 'null';
            else 
                $menutoppings = $_POST['toppings'];

            $index = $menuid.'!'.$menutoppings;

            if(isset($_SESSION['order'][$index])) {
                $_SESSION['order'][$index]['menutotal']    += $menutotal;
                $_SESSION['order'][$index]['menutoppings']  = $menutoppings;
            }
            else 
                $_SESSION['order'][$index] = array('menuid' => $menuid ,'menutotal' => $menutotal, 'menutoppings' => $menutoppings);
            echo 'success';
        }
        else {
            echo 'failed';
        }
    }
    elseif($action == "update") {
        if(isset($_POST["menuqty"])) {
            if(isset($_POST["menuqty"]) && is_array($_POST["menuqty"])){
                foreach($_POST["menuqty"] as $key => $value){
                    if(is_numeric($value)){
                        $_SESSION['order'][$key]['menutotal'] = $value;
                    }
                }
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
    elseif($action == "checkout") {
        if(isset($_POST['discount'])) {
            $discount = $_POST['discount'];
            if(!empty($discount)) {
                $_SESSION['discount'] = $discount;
            }
        }
        echo 'success';
    }
    elseif($action == "del") {
        if(isset($_POST['index'])) {
            $index = $_POST['index'];
            if(isset($_SESSION['order'][$index])) {
                unset($_SESSION['order'][$index]);
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
    elseif($action == "review") {
        $_SESSION['payment_method'] = 'cash';
        $_SESSION['request'] = $_POST['request'];
        echo 'success';
    }
    elseif($action == "complete-order") {
        if($_SESSION['payment_method'] == 'cash') {
            echo 'success';
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
