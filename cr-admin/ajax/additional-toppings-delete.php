<?php
  	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_additional_toppings  = new Additional_Toppings($pdo);
    $class_ourmenu_category    = new Our_Menu_Category($pdo);
 	$at_id      = $_POST['at_id'];
    $admin_login_id = $_SESSION['cr_adminID'];

    if(empty($at_id)){
        echo "empty-field";           
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
		
        $function_delete_additional_toppings = $class_additional_toppings->delete_additional_toppings($at_id, $admin_login_id, $now_date);
        if($function_delete_additional_toppings == true) {
			$function_additional_toppings  = $class_additional_toppings->view_additional_toppings();
            foreach ($function_additional_toppings as $data) {
                $at_id = $data->cr_toppingsID;
                $explode_category = explode(',', $data->cr_ourmenucategoryID);
?>
<li id="image_li_<?php echo $at_id ?>" class="ui-sortable-handle">
    <div class="menu-reorder-wrapper">
    <a href="javascript:void(0);" style="float:none;" class="image_link">
        <h4><?php echo $data->cr_toppingsName ?>
            <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($check_mc2 == 0) echo "#modal-delete-toppings"; else echo "#modal-alert" ?>" data-dn="<?php echo $data->cr_toppingsName; ?>" data-delete="<?php echo $at_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
            <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-toppings" data-nameid="<?php echo $data->cr_toppingsName_id ?>" data-nameold="<?php echo $data->cr_toppingsName ?>" data-size="<?php echo $data->cr_toppingsSize ?>" data-price="<?php echo $data->cr_toppingsPrice ?>" data-tid="<?php echo $at_id ?>" data-mc="<?php echo $data->cr_ourmenucategoryID ?>"><i class="fa fa-pencil text-success cpointer"></i></span><br><small><em>Applied to <?php foreach($explode_category as $cat) { $category_in_toppings = $class_ourmenu_category->view_ourmenu_category_in_toppings($cat); if(end($explode_category) !== $cat) echo $category_in_toppings->cr_ourmenucategoryName.', '; else echo $category_in_toppings->cr_ourmenucategoryName; } ?><?php if($data->cr_toppingsSize == 'none') echo ''; else echo ' in '.$data->cr_toppingsSize.' size' ?></em></small>
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
?>