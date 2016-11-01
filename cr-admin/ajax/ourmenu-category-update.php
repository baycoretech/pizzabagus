<?php
  	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_ourmenu_category  = new Our_Menu_Category($pdo);
 	$name      = $_POST['name'];
 	$name_id   = $_POST['name_id'];
    $page_link = $_POST['page'];
    $mc_idh    = $_POST['mc_idh'];
    $name_old  = $_POST['nameold'];
    $admin_login_id = $_SESSION['cr_adminID'];

    if(empty($name) || empty($name_id)){
        echo "empty-field";           
    }
    else {
	    if(!empty($name) && strlen($name) > 70) {
	    	echo "name-long";
	    }
	    elseif(!empty($name) && strlen($name) < 3) {
	    	echo "name-short";
	    }
	    elseif(!empty($name_id) && strlen($name_id) > 70) {
	    	echo "name-long";
	    }
	    elseif(!empty($name_id) && strlen($name_id) < 3) {
	    	echo "name-short";
	    }
	    else {
	    	$check_name = $class_ourmenu_category->check_update_name_ourmenu_category($name, $mc_idh);
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
				
	            $function_update_ourmenu_category = $class_ourmenu_category->update_ourmenu_category($name, $name_id, $name_old, $mc_idh, $admin_login_id, $now_date);
	            if($function_update_ourmenu_category == true) {
				    $function_view_mc  = $class_ourmenu_category->view_ourmenu_category($page_link);
		            foreach ($function_view_mc as $data) {
		                $mc_id = $data->cr_ourmenucategoryID;
                        $check_mc2 = $class_ourmenu_category->check_in_ourmenu_category_2($mc_id);
?>
<li id="image_li_<?php echo $mc_id; ?>" class="ui-sortable-handle">
    <div class="menu-reorder-wrapper">
        <a href="javascript:void(0);" style="float:none;" class="image_link">
            <h4><?php echo $data->cr_ourmenucategoryName ?> <?php if($check_mc2==0) echo ""; else echo "($check_mc2)" ?>
                <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($check_mc2 == 0) echo "#modal-delete-category"; else echo "#modal-alert" ?>" data-dn="<?php echo $data->cr_ourmenucategoryName; ?>" data-delete="<?php echo $mc_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-category" data-nameid="<?php echo $data->cr_ourmenucategoryName_id ?>" data-nameold="<?php echo $data->cr_ourmenucategoryName ?>" data-pid="<?php echo $mc_id ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
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