<?php
	if(!isset($_SESSION)) {
        session_start();
    }
	require __DIR__.'/../../cr-include/error-report.php';
    require __DIR__.'/../include/database/connection.php';
    require __DIR__.'/../include/autoloader.php';
    require __DIR__.'/../include/global-function.php';

	$id        = $_POST['blogpageID'];
	$position  = substr($id, 0, 1);
	$blogpid   = substr($id, 1);

    $class_blog        = new Blog($pdo);
	if($position == "m") {
		$blog_category = $class_blog->view_blog_page_menu_category($blogpid);
	}
	elseif($position == "s") {
		$blog_category = $class_blog->view_blog_page_submenu_category($blogpid);
	}
?>
		<option value="">Select Category</option>
        <option value="0">All Category</option>
<?php
	foreach($blog_category as $data) {
?>
		<option value="<?php echo $data->cr_blogcategoryID ?>"><?php echo $data->cr_blogcategoryName ?></option>
<?php
	}
?>