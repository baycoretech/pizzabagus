<?php
	ini_set('display_errors', 0);
  	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	require_once "include/database.php";//database
	require_once "include/class-data.php";//all data
	$id        = $_POST['blogpageID'];
	$position  = substr($id, 0, 1);
	$blogpid   = substr($id, 1);
	$o_getBlog = new blog($pdo);
	if($position=="m") {
		$v_getBC   = $o_getBlog->viewBlogPageMenuCategory($blogpid);
	}
	elseif($position=="s") {
		$v_getBC   = $o_getBlog->viewBlogPageSubmenuCategory($blogpid);
	}
?>
		<option value="">Select Category</option>
        <option value="0">All Category</option>
<?php
	foreach($v_getBC as $data) {
?>
		<option value="<?php echo $data->cr_blogcategoryID ?>"><?php echo $data->cr_blogcategoryName ?></option>
<?php
	}
?>