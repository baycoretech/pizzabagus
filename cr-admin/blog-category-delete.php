<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_getBC  = new blogcategory($pdo);

    $bcID         = $_POST['bcID'];
    $pagelink     = $_POST['pagelink'];
    $adminLoginID = $_POST['adminLoginID'];

    if(empty($bcID) || empty($adminLoginID)){
        echo "field-empty";           
    }
    else {
    	$v_delBC      = $o_getBC->deleteBC($bcID, $adminLoginID);
    	$v_getBC  = $o_getBC->viewBlogcategory($pagelink);
    	foreach ($v_getBC as $data) {
            $bcID = $data->cr_blogcategoryID;
            $v_getBcount = $o_getBC->checkInBC2($bcID);
?>
			<li id="image_li_<?php echo $data->cr_blogcategoryID; ?>" class="ui-sortable-handle">
                <div class="menu-reorder-wrapper">
                    <a href="javascript:void(0);" style="float:none;" class="image_link">
                        <h4><?php echo $data->cr_blogcategoryName; ?>
                            <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($v_getBcount==0) echo "#delete-dialog"; else echo "#alert-dialog" ?>" data-dn="<?php echo $data->cr_blogcategoryName; ?>" data-hapusbc="<?php echo $data->cr_blogcategoryID; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                            <span class="pull-right m-l-10" data-toggle="modal" data-target="#editcategoryModal" data-nameold="<?php echo $data->cr_blogcategoryName ?>" data-bid="<?php echo $data->cr_blogcategoryID ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                        </h4>
                    </a>
                </div>
            </li>
<?php
        }
    }    
?>