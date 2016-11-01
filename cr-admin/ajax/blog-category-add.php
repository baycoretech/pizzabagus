<?php
  	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

    $class_blog_category  = new Blog_Category($pdo);
 	$name      = $_POST['name'];
    $page_link = $_POST['page'];
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
	    elseif($name == "page" || $name == "tag" || $name == "cat") {
	        echo "reserved-word";
	    }
	    else {
	    	$check_name = $class_blog_category->check_name_bc($name);
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
				
	            $function_add_blog_category = $class_blog_category->add_blog_category($name, $page_link, $admin_login_id, $now_date);
	            if($function_add_blog_category == true) {
				    $function_view_blog_category = $class_blog_category->view_blog_category($page_link);
		            foreach ($function_view_blog_category as $data) {
		                $bc_id = $data->cr_blogcategoryID;
                        $check_bc2 = $class_blog_category->check_in_bc_2($bc_id);
?>
<li id="image_li_<?php echo $bc_id; ?>" class="ui-sortable-handle">
    <div class="menu-reorder-wrapper">
        <a href="javascript:void(0);" style="float:none;" class="image_link">
            <h4><?php echo $data->cr_blogcategoryName; ?> <?php if($check_bc2 == 0) echo ""; else echo "($check_bc2)" ?>
                <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($check_bc2 == 0) echo "#modal-delete-category"; else echo "#alert-dialog" ?>" data-dn="<?php echo $data->cr_blogcategoryName; ?>" data-delete="<?php echo $bc_id; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                <span class="pull-right m-l-10" data-toggle="modal" data-target="#modal-edit-category" data-nameold="<?php echo $data->cr_blogcategoryName ?>" data-bid="<?php echo $bc_id ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
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