<?php
/**
 * Class Blog_Category
 *
 * @author baycore
 */

class Blog_Category {
	private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_blog_category() {
    	$result  = $this->pdo->query("SELECT * FROM cr_blogcategory ORDER BY cr_blogcategoryOrder asc");
    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function view_blog_category($pagelink) {
    	$check  = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    	if($check->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_submenu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    		if($result->rowCount() < 1){
	    		return false;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    	else {
    		$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
	    	if($result->rowCount() < 1){
	    		return false;
	    	}
	    	else {
		    	while($rows = $result->fetch(PDO::FETCH_OBJ))
			    	$data[]=$rows;
			    return $data;
			}
    	}
    }
    public function view_total_blog_category($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    	if($result->rowCount() < 1){
    		$result = $this->pdo->query("SELECT * FROM  cr_blogcategory, cr_submenu WHERE cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
    		$total = $result->rowCount();
    		return $total;
    	}
    	else {
    		$total = $result->rowCount();
    		return $total;
    	}
    }
    public function view_total_blog($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogID desc");
    	$total = $result->rowCount();
    	return $total;
    }
    public function add_blog_category($name, $pagelink, $admin_login_id, $now_date) {
    	$name_upper = ucwords($name);
    	$slug       = create_slug($name);
	    $result = $this->pdo->prepare("INSERT INTO cr_blogcategory(
			    		cr_blogcategoryName, cr_blogcategorySlug, cr_blogcategoryLink, cr_blogcategoryCreateddate) VALUES (?, ?, ?, ?)");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $slug);
		$result->bindParam(3, $pagelink);
		$result->bindParam(4, $now_date);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Blog Category', ?, ?, ?)");
			$history_detail = " add ".$name_upper." in blog category.";
			$get_history->bindParam(1, $history_detail);
			$get_history->bindParam(2, $now_date);
			$get_history->bindParam(3, $admin_login_id);
			$get_history->execute();
			return true;
		}
		else {
			return false;
		}
    }
    public function update_blog_category($name, $name_old, $blog_category_idh, $admin_login_id, $now_date) {
    	$name_upper = ucwords($name);
    	$slug       = create_slug($name);
	    $result = $this->pdo->prepare("UPDATE cr_blogcategory SET 
	    	cr_blogcategoryName = ?,
	    	cr_blogcategorySlug = ?,
	    	cr_blogcategoryModifieddate = ? 
	    	WHERE cr_blogcategoryID = ?");
		$result->bindParam(1, $name_upper);
		$result->bindParam(2, $slug);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $blog_category_idh);
		if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog Category', ?, ?, ?)");
			$history_detail = " edit blog category from ".$name_old." to ".$name_upper.".";
			$get_history->bindParam(1, $history_detail);
			$get_history->bindParam(2, $now_date);
			$get_history->bindParam(3, $admin_login_id);
			$get_history->execute();
			return true;
		}
		else {
			return false;
		}
    }
    public function check_name_bc($name) {
    	$result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryName = '$name'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
    public function reorder_blog_category($id_array) {
    	$count = 1;
    	foreach ($id_array as $id){
			$update = $this->pdo->query("UPDATE cr_blogcategory SET cr_blogcategoryOrder = $count WHERE cr_blogcategoryID = $id");
			$count ++;	
		}
		return true;
    }
    public function check_in_bc($bc_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogcategoryID = '$bc_id'");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
	    	return true;
	    }
   	}
   	public function check_in_bc_2($bc_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogcategoryID = '$bc_id'");
	    return $result->rowCount();
   	}
   	public function delete_blog_category($bc_id, $admin_login_id, $now_date) {
   		global $now_date;
   		$query = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$bc_id'");
    	$fetch = $query->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch->cr_blogcategoryName;

    	$result = $this->pdo->prepare("DELETE FROM cr_blogcategory WHERE cr_blogcategoryID = ?");
    	$result->bindParam(1, $bc_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Blog Category', ?, ?, ?)");
			$history_detail = " delete ".$cat_name." in blog category.";
			$get_history->bindParam(1, $history_detail);
			$get_history->bindParam(2, $now_date);
			$get_history->bindParam(3, $admin_login_id);
			$get_history->execute();
			return true;
		}
		else {
			return false;
		}
    }
}
?>