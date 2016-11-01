<?php
/**
 * Class Blog
 *
 * @author baycore
 */

class Blog {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_blog_likes($blog_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_bloglikes WHERE cr_blogID = '$blog_id'");
    	$total  = $result->rowCount();
    	return $total;
    }
    public function count_visitor($blog_id) {
        $result = $this->pdo->query("SELECT * FROM cr_blogvisitor WHERE cr_blogID = '$blog_id'");
        $total = $result->rowCount();
        return $total;
    }
    public function view_blog($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogID desc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_blog_name_asc($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogTitle asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_blog_name_desc($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogTitle desc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_blog_date_asc($pagelink) {
    	$result = $this->pdo->query("SELECT * FROM  cr_blog, cr_blogcategory, cr_blogtype, cr_admin WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$pagelink' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID AND cr_blog.cr_adminID = cr_admin.cr_adminID ORDER BY cr_blog.cr_blogPostdate asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_blog_page_in_menu() {
    	$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_pagetemplateID = '4' OR cr_pagetemplateID = '5' ORDER BY cr_menuTitle asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_blog_page_in_submenu() {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_pagetemplateID = '4' OR cr_pagetemplateID = '5' ORDER BY cr_submenuTitle asc");
    	if($result->rowCount() < 1){
	    	return false;
	    }
	    else {
		   	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_blog_page_menu_category($id) {
    	$result = $this->pdo->query("SELECT * FROM cr_menu, cr_blogcategory WHERE cr_menu.cr_menuID = '$id' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink");
		while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function view_blog_page_submenu_category($id) {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu, cr_blogcategory WHERE cr_submenu.cr_submenuID = '$id' AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink");
		while($rows = $result->fetch(PDO::FETCH_OBJ))
			$data[]=$rows;
		return $data;
    }
    public function view_blog_current_cat($cat_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat_id'");
		$row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_blogcategoryName;
    }
    public function check_blog_name($title) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogTitle = '$title'");
    	$total = $result->rowCount();
    	if($total < 1) {
    		return false;
    	}
    	else {
    		return true;
    	}
    }
    public function check_blog_type_name($blogtype_name) {
    	$result = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeName = '$blogtype_name'");
    	$row    = $result->fetch(PDO::FETCH_OBJ);
		return $row->cr_blogtypeID;
    }
    public function check_blog_name_edit($id, $title) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogID <> '$id' AND cr_blogTitle = '$title'");
    	$total = $result->rowCount();
    	if($total < 1) {
    		return false;
    	}
    	else {
    		return true;
    	}
    }
    public function add_blog_standard($title, $content, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $admin_login_id, $now_date) {
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch->cr_blogcategoryName;

    	$query_bt = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID = '$blogtype'");
    	$fetch_bt = $query_bt->fetch(PDO::FETCH_OBJ);
    	$bt_name  = ucwords($fetch_bt->cr_blogtypeName);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogPostdate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogMetakeywords, cr_blogMetadescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $metakey);
		$result->bindParam(10, $metadesc);
		$result->bindParam(11, $status);
		$result->bindParam(12, $admin_login_id);
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

			$history_detail = " add new post($bt_name, ".ucwords($status).") in ".$cat_name." category.";
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
    public function add_blog_image($title, $content, $blogtype, $tags, $noimplodetags, $photo, $cat, $status, $comment, $metakey, $metadesc, $admin_login_id, $now_date) {
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch_bc->cr_blogcategoryName;

    	$query_bt = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID = '$blogtype'");
    	$fetch_bt = $query_bt->fetch(PDO::FETCH_OBJ);
    	$bt_name  = ucwords($fetch_bt->cr_blogtypeName);

    	$image    = str_replace(MADMINURL."../","",$photo);
	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogPostdate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogFeatured, cr_blogMetakeywords, cr_blogMetadescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $image);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $admin_login_id);
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

			$history_detail = " add new post($bt_name, ".ucwords($status).") in ".$cat_name." category.";
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
    public function add_blog_video($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $admin_login_id, $now_date) {
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch_bc->cr_blogcategoryName;

    	$query_bt = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID = '$blogtype'");
    	$fetch_bt = $query_bt->fetch(PDO::FETCH_OBJ);
    	$bt_name  = ucwords($fetch_bt->cr_blogtypeName);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogPostdate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogFeatured, cr_blogMetakeywords, cr_blogMetadescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $link);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $admin_login_id);
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

			$history_detail = " add new post($bt_name, ".ucwords($status).") in ".$cat_name." category.";
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
    public function add_blog_sound($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $admin_login_id, $now_date) {
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	
    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch_bc->cr_blogcategoryName;

    	$query_bt = $this->pdo->query("SELECT * FROM cr_blogtype WHERE cr_blogtypeID = '$blogtype'");
    	$fetch_bt = $query_bt->fetch(PDO::FETCH_OBJ);
    	$bt_name  = ucwords($fetch_bt->cr_blogtypeName);

	    $result = $this->pdo->prepare("INSERT INTO cr_blog(
			    		cr_blogTitle, cr_blogContent, cr_blogPostdate, cr_blogLink, cr_blogtypeID, cr_blogcategoryID, cr_blogTags, cr_blogComment, cr_blogFeatured, cr_blogMetakeywords, cr_blogMetadescription, cr_blogStatus, cr_adminID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $link);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $admin_login_id);
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add New Post', ?, ?, ?)");

			$history_detail = " add new post($bt_name, ".ucwords($status).") in ".$cat_name." category.";
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
    public function edit_blog($blog_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogID = '$blog_id'");
    	$row    = $result->fetch(PDO::FETCH_OBJ);
	    return $row;
    }
    public function check_blog_type($blog_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogtype WHERE cr_blog.cr_blogID = '$blog_id' AND cr_blog.cr_blogtypeID = cr_blogtype.cr_blogtypeID");
    	$row = $result->fetch(PDO::FETCH_OBJ);
	    return $row;
    }
    public function update_blog_image($title, $content, $blogtype, $tags, $noimplodetags, $photo, $photourlnc, $cat, $status, $comment, $metakey, $metadesc, $blog_idh, $admin_login_id, $now_date) {
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}
    	$photoca     = str_replace(MADMINURL."../","",$photo);
    	$photocb     = str_replace(MURL,"",$photo);
    	$cekb_q = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogID = '$blog_idh'");
    	$cekb_f = $cekb_q->fetch(PDO::FETCH_OBJ);
    	$thname = $cekb_f->cr_blogFeatured;

    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch_bc->cr_blogcategoryName;

    	if($photocb != $photourlnc) {
    		$result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogModifieddate    = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogFeatured        = ?,
		    		cr_blogMetakeywords    = ?,
		    		cr_blogMetadescription = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?
		    		WHERE cr_blogID        = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $content);
			$result->bindParam(3, $now_date);
			$result->bindParam(4, $urllink);
			$result->bindParam(5, $blogtype);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $tags);
			$result->bindParam(8, $comment);
			$result->bindParam(9, $photoca);
			$result->bindParam(10, $metakey);
			$result->bindParam(11, $metadesc);
			$result->bindParam(12, $status);
			$result->bindParam(13, $admin_login_id);
			$result->bindParam(14, $blog_idh);
    	}
    	else {
		    $result = $this->pdo->prepare("UPDATE cr_blog SET 
		    		cr_blogTitle           = ?, 
		    		cr_blogContent         = ?, 
		    		cr_blogModifieddate    = ?,  
		    		cr_blogLink            = ?,
		    		cr_blogtypeID          = ?,
		    		cr_blogcategoryID      = ?,
		    		cr_blogTags            = ?,
		    		cr_blogComment         = ?,
		    		cr_blogMetakeywords    = ?,
		    		cr_blogMetadescription = ?,
		    		cr_blogStatus          = ?,
		    		cr_adminID             = ?

		    		WHERE cr_blogID        = ?");	
		    $result->bindParam(1, $titleupper);
			$result->bindParam(2, $content);
			$result->bindParam(3, $now_date);
			$result->bindParam(4, $urllink);
			$result->bindParam(5, $blogtype);
			$result->bindParam(6, $cat);
			$result->bindParam(7, $tags);
			$result->bindParam(8, $comment);
			$result->bindParam(9, $metakey);
			$result->bindParam(10, $metadesc);
			$result->bindParam(11, $status);
			$result->bindParam(12, $admin_login_id);
			$result->bindParam(13, $blog_idh);
		}
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
			$history_detail = " edit ".$titleupper." (".ucwords($status).") in ".$cat_name." category.";
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
    public function update_blog_standard($title, $content, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blog_idh, $admin_login_id, $now_date) {
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}

    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch_bc->cr_blogcategoryName;
    	
	    $result = $this->pdo->prepare("UPDATE cr_blog SET 
	    		cr_blogTitle           = ?, 
	    		cr_blogContent         = ?, 
	    		cr_blogModifieddate    = ?,  
	    		cr_blogLink            = ?,
	    		cr_blogtypeID          = ?,
	    		cr_blogcategoryID      = ?,
	    		cr_blogTags            = ?,
	    		cr_blogComment         = ?,
	    		cr_blogMetakeywords    = ?,
	    		cr_blogMetadescription = ?,
	    		cr_blogStatus          = ?,
	    		cr_adminID             = ?
	    		WHERE cr_blogID        = ?");	
	    $result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $metakey);
		$result->bindParam(10, $metadesc);
		$result->bindParam(11, $status);
		$result->bindParam(12, $admin_login_id);
		$result->bindParam(13, $blog_idh);
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
			$history_detail = " edit ".$titleupper." (".ucwords($status).") in ".$cat_name." category.";
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
    public function update_blog_video($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blog_idh, $admin_login_id, $now_date) {
    	global $now_date;
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}

    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch_bc->cr_blogcategoryName;
    	
	    $result = $this->pdo->prepare("UPDATE cr_blog SET 
	    		cr_blogTitle           = ?, 
	    		cr_blogContent         = ?, 
	    		cr_blogModifieddate    = ?,  
	    		cr_blogLink            = ?,
	    		cr_blogtypeID          = ?,
	    		cr_blogcategoryID      = ?,
	    		cr_blogTags            = ?,
	    		cr_blogComment         = ?,
	    		cr_blogFeatured        = ?,
	    		cr_blogMetakeywords    = ?,
	    		cr_blogMetadescription = ?,
	    		cr_blogStatus          = ?,
	    		cr_adminID             = ?
	    		WHERE cr_blogID        = ?");	
	    $result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $link);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $admin_login_id);
		$result->bindParam(14, $blog_idh);
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
			$history_detail = " edit ".$titleupper." (".ucwords($status).") in ".$cat_name." category.";
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
    public function update_blog_sound($title, $content, $link, $blogtype, $tags, $noimplodetags, $cat, $status, $comment, $metakey, $metadesc, $blog_idh, $admin_login_id, $now_date) {
    	$titleupper = ucwords($title);
    	$urllink    = create_slug($title);
    	if(empty($comment)) {
    		$comment = "off";
    	}

    	$query_bc = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategoryID = '$cat'");
    	$fetch_bc = $query_bc->fetch(PDO::FETCH_OBJ);
    	$cat_name = $fetch_bc->cr_blogcategoryName;
    	
	    $result = $this->pdo->prepare("UPDATE cr_blog SET 
	    		cr_blogTitle           = ?, 
	    		cr_blogContent         = ?, 
	    		cr_blogModifieddate    = ?,  
	    		cr_blogLink            = ?,
	    		cr_blogtypeID          = ?,
	    		cr_blogcategoryID      = ?,
	    		cr_blogTags            = ?,
	    		cr_blogComment         = ?,
	    		cr_blogFeatured        = ?,
	    		cr_blogMetakeywords    = ?,
	    		cr_blogMetadescription = ?,
	    		cr_blogStatus          = ?,
	    		cr_adminID             = ?
	    		WHERE cr_blogID        = ?");	
	    $result->bindParam(1, $titleupper);
		$result->bindParam(2, $content);
		$result->bindParam(3, $now_date);
		$result->bindParam(4, $urllink);
		$result->bindParam(5, $blogtype);
		$result->bindParam(6, $cat);
		$result->bindParam(7, $tags);
		$result->bindParam(8, $comment);
		$result->bindParam(9, $link);
		$result->bindParam(10, $metakey);
		$result->bindParam(11, $metadesc);
		$result->bindParam(12, $status);
		$result->bindParam(13, $admin_login_id);
		$result->bindParam(14, $blog_idh);
		if($result->execute()) {
			if($noimplodetags != NULL) {
				foreach($noimplodetags as $tagsname) {
					$result = $this->pdo->prepare("INSERT IGNORE INTO cr_blogtags(
					    		cr_blogtagsName) VALUES (?)");
					$result->bindParam(1, $tagsname);
					$result->execute();
				}
			}

			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Blog', ?, ?, ?)");
			$history_detail = " edit ".$titleupper." (".ucwords($status).") in ".$cat_name." category.";
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
    public function delete_blog($blog_id, $admin_login_id, $now_date) {
    	$check_query = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogID = '$blog_id'");
    	$check_fetch = $check_query->fetch(PDO::FETCH_OBJ);
    	$blog_title  = $check_fetch->cr_blogTitle;
    	$blog_cat    = $check_fetch->cr_blogcategoryName;

    	$comment_q = $this->pdo->query("SELECT * FROM cr_comment WHERE cr_blogID = '$blog_id'");
		if($comment_q->rowCount() >= 1){
		    $comment_d = $this->pdo->prepare("DELETE FROM cr_comment WHERE cr_blogID = ?");
		    $comment_d->bindParam(1, $blog_id);
    		$comment_d->execute();
		}
    	
    	$result = $this->pdo->prepare("DELETE FROM cr_blog WHERE cr_blogID = ?");
    	$result->bindParam(1, $blog_id);
    	if($result->execute()) {
	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Post', ?, ?, ?)");
			$history_detail = " delete ".$blog_title." in ".$blog_cat." category.";
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
    public function all_blog_tags() {
    	$result  = $this->pdo->query("SELECT * FROM cr_blogtags ORDER BY cr_blogtagsID asc");
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
?>