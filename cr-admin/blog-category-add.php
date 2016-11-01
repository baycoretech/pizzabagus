<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$o_getBC  = new blogcategory($pdo);

    $name            = $_POST['name'];
    $pagelink        = $_POST['pagelink'];
    $adminLoginID    = $_POST['adminLoginID'];

    if(empty($name) || empty($adminLoginID)){
        echo "field-empty";           
    }
    elseif(strlen($name)>70) {
        echo "long";
    }
    elseif(strlen($name)<3) {
        echo "short";
    }
    elseif($name=="page" || $name=="tag" || $name=="cat") {
        echo "reserved-word";
    }
    else {
    	$v_checkBCName = $o_getBC->checkNameBC($name);
        if($v_checkBCName==1) {
        	echo "same-name";
        }
        else {
            $v_getAddBC = $o_getBC->addBlogcategory($name, $pagelink, $adminLoginID);
            $v_getBC  = $o_getBC->viewBlogcategory($pagelink);
            foreach ($v_getBC as $data) {
                $bcID = $data->cr_blogcategoryID;
                $v_getBcount = $o_getBC->checkInBC2($bcID);
?>
				<li id="image_li_<?php echo $data->cr_blogcategoryID; ?>" class="ui-sortable-handle">
                    <div class="menu-reorder-wrapper">
                        <a href="javascript:void(0);" style="float:none;" class="image_link">
                            <h4><?php echo $data->cr_blogcategoryName; ?>  <?php if($v_getBcount==0) echo ""; else echo "($v_getBcount)" ?>
                                <span class="pull-right m-l-10" data-toggle="modal" data-target="<?php if($v_getBcount==0) echo "#delete-dialog"; else echo "#alert-dialog" ?>" data-dn="<?php echo $data->cr_blogcategoryName; ?>" data-hapusbc="<?php echo $data->cr_blogcategoryID; ?>"><i class="fa fa-times text-danger cpointer"></i></span>
                                <span class="pull-right m-l-10" data-toggle="modal" data-target="#editcategoryModal" data-nameold="<?php echo $data->cr_blogcategoryName ?>" data-bid="<?php echo $data->cr_blogcategoryID ?>"><i class="fa fa-pencil text-success cpointer"></i></span>
                            </h4>
                                            
                        </a>
                    </div>
                </li>
<?php
    		}                                
        } 
    }
?>