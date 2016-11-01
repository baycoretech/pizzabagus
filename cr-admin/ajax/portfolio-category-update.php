<?php
  	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_portfolio_category  = new Portfolio_Category($pdo);
 	$name      = $_POST['name'];
    $page_link = $_POST['page'];
    $pc_idh    = $_POST['pc_idh'];
    $name_old  = $_POST['nameold'];
    $admin_login_id = $_SESSION['cr_adminID'];

    if(empty($name)){
        echo "empty-field";           
    }
    else {
	    if(!empty($name) && strlen($name) > 70) {
	    	echo "name-long";
	    }
	    elseif(!empty($name) && strlen($name) < 3) {
	    	echo "name-short";
	    }
	    else {
	    	$check_name = $class_portfolio_category->check_name_portfolio_category($name);
	    	if($check_name == true) {
	    		echo "same-name";
	    	}
	    	else {
	    		//Set timezone
				$class_general_setting    = new General_Setting($pdo);
				$v_set_timezone           = $class_general_setting->set_timezone();
			 	$get_timezone_city        = substr($v_set_timezone->cr_settingValue, 12);
				if(!empty($v_set_timezone->cr_settingValue)) {
				    date_default_timezone_set($get_timezone_city);
				}
				$date_for_now = new DateTime();
				$date_for_now->setTimezone(new DateTimeZone($get_timezone_city));
				$now_date     = $date_for_now->format('Y-m-d H:i:s');
				//Same format as NOW(), use to save datetime value to database
				
	            $function_update_portfolio_category = $class_portfolio_category->update_portfolio_category($name, $name_old, $pc_idh, $admin_login_id, $now_date);
	            if($function_update_portfolio_category == true) {
				    $function_view_pc  = $class_portfolio_category->view_portfolio_category($page_link);
		            foreach ($function_view_pc as $data) {
		                $pc_id = $data->cr_portfoliocategoryID;
                        $check_pc2 = $class_portfolio_category->check_in_portfolio_category_2($pc_id);
?>
<li id="image_li_<?php echo $pc_id; ?>" class="ui-sortable-handle">
    <div class="menu-reorder-wrapper">
        <a href="javascript:void(0);" style="float:none;" class="image_link">
            <h4><?php echo $data->cr_portfoliocategoryName ?> <?php if($check_pc2==0) echo ""; else echo "($check_pc2)" ?>
                <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($check_pc2 == 0) echo "#modal-delete-category"; else echo "#modal-alert" ?>" data-dn="<?php echo $data->cr_portfoliocategoryName; ?>" data-delete="<?php echo $pc_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-category" data-nameold="<?php echo $data->cr_portfoliocategoryName ?>" data-pid="<?php echo $pc_id ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
            </h4>
        </a>
    </div>
</li>
<?php
		            }
		        }
		        else {
		        	echo 'false';
		        }
	        } 
	    }
	}
?>