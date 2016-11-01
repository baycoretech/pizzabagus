<?php
/**
 * Class Menu
 *
 * @author baycore
 */

class Menu {
	private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_menu() {
    	$result = $this->pdo->query("SELECT * FROM cr_menu ORDER BY cr_menuOrder asc");
    	if($result->rowCount() < 1) {
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function reorder_menu($id_array) {
    	$count = 1;
    	foreach ($id_array as $id) {
			$update = $this->pdo->query("UPDATE cr_menu SET cr_menuOrder = '$count' WHERE cr_menuID = '$id'");
			$count ++;	
		}
		return true;
    }
    public function view_submenu_in_menu($menu_id) {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$menu_id'");
    	$total  = $result->rowCount();
		return $total;
    }
    public function view_menu_for_parent() {
    	$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option <> 'customlink' ORDER BY cr_menuOrder asc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_submenu($menu) {
    	$menu_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$menu'");
    	$menu_fetch = $menu_query->fetch(PDO::FETCH_OBJ);
    	$menu_id    = $menu_fetch->cr_menuID;
    	$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$menu_id' ORDER BY cr_submenuOrder asc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $result->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_menu_sub($menu) {
    	$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$menu' ORDER BY cr_submenuOrder asc");
    	if($result->rowCount() < 1){
    		return false;
    	}
    	else {
		    while($rows = $result->fetch(PDO::FETCH_OBJ))
			    $data[]=$rows;
			return $data;
		}
    }
    public function view_page_template() {
    	$result = $this->pdo->query("SELECT * FROM cr_pagetemplate ORDER BY cr_pagetemplateID asc");
	    while($rows = $result->fetch(PDO::FETCH_OBJ))
		    $data[]=$rows;
		return $data;
    }
    public function check_menu_title($title) {
    	$title_upper   = ucwords($title);
    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$title_upper' OR cr_menuTitle = '$title'");
    	$check_submenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$title_upper' OR cr_submenuTitle = '$title'");
    	if(($check_menu->rowCount() < 1) && $check_submenu->rowCount() < 1) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }
    public function check_update_menu_title($title, $id) {
    	$title_upper   = ucwords($title);
    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE (cr_menuTitle = '$title_upper' OR cr_menuTitle = '$title') AND cr_menuID <> '$id'");
    	$check_submenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE (cr_submenuTitle = '$title_upper' OR cr_submenuTitle = '$title') AND cr_submenuID <> '$id'");
    	if(($check_menu->rowCount() < 1) && $check_submenu->rowCount() < 1) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }
    public function add_menu($title, $title_id, $parent, $status, $page_template, $option, $admin_login_id, $now_date) {
    	$title_upper    = ucwords($title);
    	$title_id_upper = ucwords($title_id);
    	$title_slug     = create_slug($title); 
    	if(empty($option)) {
    		$option = "";
    	}
    	if(empty($parent)) {
	    	$get_last_id_query = $this->pdo->query("SELECT LAST_INSERT_ID() FROM cr_menu");
	    	$get_last_id_fetch = $get_last_id_query->fetch(PDO::FETCH_OBJ);
	    	$get_last_id       = $get_last_id_fetch->cr_menuID + 1;

		    $result = $this->pdo->prepare("INSERT INTO cr_menu(cr_menuTitle, cr_menuTitle_id, cr_menuLink, cr_menuOrder, cr_menuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $title_slug);
			$result->bindParam(4, $get_last_id);
			$result->bindParam(5, $status);
			$result->bindParam(6, $page_template);
			$result->bindParam(7, $option);
			if($result->execute()) {
				$result = $this->pdo->query("SET @lastID = LAST_INSERT_ID()");
				$result = $this->pdo->query("UPDATE cr_menu SET cr_menuOrder = @lastID WHERE cr_menuID = @lastID;");

				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Menu', ?, ?, ?)");
				$history_detail = " add menu $title_upper ($menu_status) to your website.";
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
		else {
			$get_menu_title_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$parent'");
		    $get_menu_title_fetch = $get_menu_title_query->fetch(PDO::FETCH_OBJ);
		    $get_menu_title       = $get_menu_title_fetch->cr_menuTitle;

		    $result = $this->pdo->prepare("INSERT INTO cr_submenu(cr_submenuTitle, cr_submenuTitle_id cr_submenuLink, cr_menuID, cr_submenuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $title_slug);
			$result->bindParam(4, $parent);
			$result->bindParam(5, $status);
			$result->bindParam(6, $page_template);
			$result->bindParam(7, $option);
			if($result->execute()) {
				$update_menu = $this->pdo->query("UPDATE cr_menu SET cr_menuHasSub = '1' WHERE cr_menuID = '$parent'");

				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Submenu', ?, ?, ?)");
				$history_detail = " add submenu $title_upper ($menu_status) under $get_menu_title to your website.";
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
    public function add_custom_link($title, $title_id, $link, $parent, $status, $option, $admin_login_id, $now_date) {
    	$title_upper    = ucwords($title);
    	$title_id_upper = ucwords($title_id);
    	$page_template  = "0";
    	if(empty($parent)) {
	    	$get_last_id_query = $this->pdo->query("SELECT LAST_INSERT_ID() FROM cr_menu");
	    	$get_last_id_fetch = $get_last_id_query->fetch(PDO::FETCH_OBJ);
	    	$get_last_id       = $get_last_id_fetch->cr_menuID + 1;

		    $result = $this->pdo->prepare("INSERT INTO cr_menu(cr_menuTitle, cr_menuTitle_id, cr_menuLink, cr_menuOrder, cr_menuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $link);
			$result->bindParam(4, $get_last_id);
			$result->bindParam(5, $status);
			$result->bindParam(6, $page_template);
			$result->bindParam(7, $option);
			if($result->execute()) {
				$result = $this->pdo->query("SET @lastID = LAST_INSERT_ID()");
				$result = $this->pdo->query("UPDATE cr_menu SET cr_menuOrder = @lastID WHERE cr_menuID = @lastID;");

				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Custom Link', ?, ?, ?)");
				$history_detail = " add custom link <a href='$link' target='_blank'>$titleupper</a> ($str) to your website.";
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
		else {
			$get_menu_title_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuID = '$parent'");
		    $get_menu_title_fetch = $get_menu_title_query->fetch(PDO::FETCH_OBJ);
		    $get_menu_title       = $get_menu_title_fetch->cr_menuTitle;

		    $result = $this->pdo->prepare("INSERT INTO cr_submenu(cr_submenuTitle, cr_submenuTitle_id, cr_submenuLink, cr_menuID, cr_submenuStatus, cr_pagetemplateID, cr_option) VALUES (?, ?, ?, ?, ?, ?, ?)");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $link);
			$result->bindParam(4, $parent);
			$result->bindParam(5, $status);
			$result->bindParam(6, $page_template);
			$result->bindParam(7, $option);
			if($result->execute()) {
				$update_menu = $this->pdo->query("UPDATE cr_menu SET cr_menuHasSub = '1' WHERE cr_menuID = '$parent'");

				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
					    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Add Custom Link', ?, ?, ?)");
				$history_detail = " add custom link <a href='$link' target='_blank'>$title_upper</a> ($menu_status) under $get_menu_title to your website.";
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
    public function update_menu($title, $title_id, $status, $menu_idh, $admin_login_id, $now_date) {
    	$check_menu_type_query = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_pagetemplateID=cr_pagetemplate.cr_pagetemplateID AND cr_menu.cr_menuID = '$menu_idh'");
    	$check_menu_type_fetch = $check_menu_type_query->fetch(PDO::FETCH_OBJ);
    	$menu_type        = $check_menu_type_fetch->cr_pagetemplateType;
    	$old_link         = $check_menu_type_fetch->cr_menuLink;
    	$menu_option      = $check_menu_type_fetch->cr_option;

    	$title_upper    = ucwords($title);
    	$title_id_upper = ucwords($title_id);
    	$title_slug     = create_slug($title); 

    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE (cr_menuTitle = '$title_upper' OR cr_menuTitle = '$title') AND cr_menuID <> '$menu_idh'");
    	$check_submenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$title_upper' OR cr_submenuTitle = '$title'");

	    if(($check_menu->rowCount() < 1) && $check_submenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_menu SET 
				cr_menuTitle  = ?,
				cr_menuTitle_id  = ?,
				cr_menuLink   = ?,
				cr_menuStatus = ? 
				WHERE cr_menuID = ?");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $title_slug);
			$result->bindParam(4, $status);
			$result->bindParam(5, $menu_idh);
			if($result->execute()) {
				if($menu_type == "blog") {
					$update_link = $this->pdo->prepare("UPDATE cr_blogcategory SET 
						cr_blogcategoryLink  = ?
						WHERE cr_blogcategoryLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}
				elseif($menu_type == "general") {
					$update_link = $this->pdo->prepare("UPDATE cr_general SET 
						cr_generalLink  = ?
						WHERE cr_generalLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}
				elseif($menu_type == "portfolio") {
					if($menu_option == "gallery") {
						$update_link = $this->pdo->prepare("UPDATE cr_gallery SET 
							cr_galleryLink  = ?
							WHERE cr_galleryLink = ?");
						$update_link->bindParam(1, $title_slug);
						$update_link->bindParam(2, $old_link);
						$update_link->execute();
					}
					else {
						$update_link = $this->pdo->prepare("UPDATE cr_portfoliocategory SET 
							cr_portfoliocategoryLink  = ?
							WHERE cr_portfoliocategoryLink = ?");
						$update_link->bindParam(1, $title_slug);
						$update_link->bindParam(2, $old_link);
						$update_link->execute();
					}
				}
				elseif($menu_type == "menu") {
					$update_link = $this->pdo->prepare("UPDATE cr_ourmenucategory SET 
						cr_ourmenucategoryLink  = ?
						WHERE cr_ourmenucategoryLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}
				elseif($menu_type == "e-commerce") {
					$update_link = $this->pdo->prepare("UPDATE cr_productcategory SET 
							cr_productcategoryLink  = ?
							WHERE cr_productcategoryLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}

				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
							    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Menu', ?, ?, ?)");
				$history_detail = " edit menu $title_upper ($menu_status).";
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
	    else {
	    	$same_name = 'same';
		    return $same_name;
	    }
    }
    public function update_custom_link($title, $title_id, $link, $status, $option, $menu_idh, $admin_login_id, $now_date) {
    	$title_upper    = ucwords($title); 
    	$title_id_upper = ucwords($title_id); 
    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE (cr_menuTitle = '$title_upper' OR cr_menuTitle = '$title') AND cr_menuID <> '$menu_idh'");
    	$check_submenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuTitle = '$title_upper' OR cr_submenuTitle = '$title'");

	    if(($check_menu->rowCount() < 1) && $check_submenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_menu SET 
				cr_menuTitle  = ?,
				cr_menuTitle_id  = ?,
				cr_menuLink   = ?,
				cr_menuStatus = ? 
				WHERE cr_menuID = ?");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $link);
			$result->bindParam(4, $status);
			$result->bindParam(5, $menu_idh);
			if($result->execute()) {
				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
							    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Custom Link', ?, ?, ?)");
				$history_detail = " edit custom link <a href='$link' target='_blank'>$title_upper</a> ($menu_status).";
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
	    else {
	    	$same_name = 'same';
		    return $same_name;
	    }
    }
    public function update_subcustom_link($title, $title_id, $link, $status, $option, $submenu_idh, $admin_login_id, $now_date) {
    	$title_upper    = ucwords($title);
    	$title_id_upper = ucwords($title_id);
    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$title_upper' OR cr_menuTitle = '$title'");
	    $check_submenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE (cr_submenuTitle = '$title_upper' OR cr_submenuTitle = '$title') AND cr_submenuID <> '$submenu_idh'");

	    if(($check_menu->rowCount() < 1) && $check_submenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_submenu SET 
				cr_submenuTitle  = ?,
				cr_submenuTitle_id  = ?,
				cr_submenuLink   = ?,
				cr_submenuStatus = ? 
				WHERE cr_submenuID = ?");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $link);
			$result->bindParam(4, $status);
			$result->bindParam(5, $submenu_idh);
			if($result->execute()) {
				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
							    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Custom Link', ?, ?, ?)");
				$history_detail = " edit custom link <a href='$link' target='_blank'>$title_upper</a> ($menu_status).";
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
	    else {
	    	$same_name = 'same';
		    return $same_name;
	    }

    }
    public function update_submenu($title, $title_id, $status, $submenu_idh, $admin_login_id, $now_date) {
    	$check_menu_type_query = $this->pdo->query("SELECT * FROM cr_submenu, cr_pagetemplate WHERE cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID AND cr_submenu.cr_submenuID = '$submenu_idh'");
    	$check_menu_type_fetch = $check_menu_type_query->fetch(PDO::FETCH_OBJ);
    	$menut_ype        = $check_menu_type_fetch->cr_pagetemplateType;
    	$old_link         = $check_menu_type_fetch->cr_submenuLink;
    	$menu_option      = $check_menu_type_fetch->cr_option;

    	$title_upper    = ucwords($title);
    	$title_id_upper = ucwords($title_id);
    	$title_slug     = create_slug($title); 

    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuTitle = '$title_upper' OR cr_menuTitle = '$title'");
	    $check_submenu = $this->pdo->query("SELECT * FROM cr_submenu WHERE (cr_submenuTitle = '$title_upper' OR cr_submenuTitle = '$title') AND cr_submenuID <> '$submenu_idh'");

	    if(($check_menu->rowCount() < 1) && $check_submenu->rowCount() < 1) {
	    	$result = $this->pdo->prepare("UPDATE cr_submenu SET 
				cr_submenuTitle  = ?,
				cr_submenuTitle_id  = ?,
				cr_submenuLink   = ?,
				cr_submenuStatus = ? 
				WHERE cr_submenuID = ?");
			$result->bindParam(1, $title_upper);
			$result->bindParam(2, $title_id_upper);
			$result->bindParam(3, $title_slug);
			$result->bindParam(4, $status);
			$result->bindParam(5, $submenu_idh);
			if($result->execute()) {
				if($menu_type == "blog") {
					$update_link = $this->pdo->prepare("UPDATE cr_blogcategory SET 
						cr_blogcategoryLink  = ?
						WHERE cr_blogcategoryLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}
				elseif($menu_type == "general") {
					$update_link = $this->pdo->prepare("UPDATE cr_general SET 
						cr_generalLink  = ?
						WHERE cr_generalLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}
				elseif($menu_type == "portfolio") {
					if($menu_option == "gallery") {
						$update_link = $this->pdo->prepare("UPDATE cr_gallery SET 
							cr_galleryLink  = ?
							WHERE cr_galleryLink = ?");
						$update_link->bindParam(1, $title_slug);
						$update_link->bindParam(2, $old_link);
						$update_link->execute();
					}
					else {
						$update_link = $this->pdo->prepare("UPDATE cr_portfoliocategory SET 
							cr_portfoliocategoryLink  = ?
							WHERE cr_portfoliocategoryLink = ?");
						$update_link->bindParam(1, $title_slug);
						$update_link->bindParam(2, $old_link);
						$update_link->execute();
					}
				}
				elseif($menu_type == "menu") {
					$update_link = $this->pdo->prepare("UPDATE cr_ourmenucategory SET 
						cr_ourmenucategoryLink  = ?
						WHERE cr_ourmenucategoryLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}
				elseif($menu_type == "e-commerce") {
					$update_link = $this->pdo->prepare("UPDATE cr_productcategory SET 
						cr_productcategoryLink  = ?
						WHERE cr_productcategoryLink = ?");
					$update_link->bindParam(1, $title_slug);
					$update_link->bindParam(2, $old_link);
					$update_link->execute();
				}

				if($status == 1) {
					$menu_status = "Publish";
				}
				elseif($status == 0) {
					$menu_status = "Unpublish";
				}

				$get_history = $this->pdo->prepare("INSERT INTO cr_history(
							    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Edit Submenu', ?, ?, ?)");
				$history_detail = " edit submenu $title_upper ($menu_status).";
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
	    else {
	    	$same_name = 'same';
		    return $same_name;
	    }

    }
    public function reorder_submenu($id_array, $menu) {
    	$count = 1;
    	$check = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$menu'");
    	$rows  = $check->fetch(PDO::FETCH_OBJ);
    	$menu_id = $rows->cr_menuID;
    	foreach ($id_array as $id){
			$update = $this->pdo->query("UPDATE cr_submenu SET cr_submenuOrder = '$count' WHERE cr_submenuID = '$id' AND cr_menuID = '$menu_id'");
			$count ++;	
		}
		return true;
    }
    public function count_showcase_portfolio() {
    	$check = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option = 'showcase'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option = 'showcase'");
    		$total = $result->rowCount();
    		return $total;
    	} 
    	else {
    		$total = $check->rowCount();
    		return $total;
    	}
    }
    public function disable_showcase_portfolio($page_link) {
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page_link'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$page_link'");
    	} 
    	else {
    		$result = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page_link'");
    	}
    	$rows = $result->fetch(PDO::FETCH_OBJ);
    	return $rows;
    }
    public function set_showcase_portfolio($admin_login_id, $page_link, $now_date) {
    	$showcase  = "showcase";
    	$menu_title_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page_link'");
    	if($menu_title_query->rowCount() < 1) {
    		$submenu_title_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$page_link'");
    		$submenu_title_fetch = $submenu_title_query->fetch(PDO::FETCH_OBJ);
			$menu_title   = $submenu_title_fetch->cr_menuTitle;
    	}
    	else {
			$menu_title_fetch = $menu_title_query->fetch(PDO::FETCH_OBJ);
			$menu_title   = $menu_title_fetch->cr_menuTitle;
    	}
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page_link'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->prepare("UPDATE cr_submenu SET 
	    		cr_option            = ?
	    		WHERE cr_submenuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $page_link);
    	} 
    	else {
    		$result = $this->pdo->prepare("UPDATE cr_menu SET 
	    		cr_option            = ?
	    		WHERE cr_menuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $page_link);
    	}
    	if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Set Portfolios/Products as Showcase', ?, ?, ?)");
			$history_detail = " set portfolio(s) in page $menu_title as selected portfolio/product to show at homepage.";
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
    public function unshowcase_portfolio($admin_login_id, $page_link, $now_date) {
    	$showcase  = "";
    	$menu_title_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page_link'");
    	if($menu_title_query->rowCount() < 1) {
    		$submenu_title_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_submenuLink = '$page_link'");
    		$submenu_title_fetch = $submenu_title_query->fetch(PDO::FETCH_OBJ);
			$menu_title   = $submenu_title_fetch->cr_menuTitle;
    	}
    	else {
			$menu_title_fetch = $menu_title_query->fetch(PDO::FETCH_OBJ);
			$menu_title   = $menu_title_fetch->cr_menuTitle;
    	}
    	$check  = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$page_link'");
    	if($check->rowCount()<1) {
    		$result = $this->pdo->prepare("UPDATE cr_submenu SET 
	    		cr_option            = ?
	    		WHERE cr_submenuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $page_link);
    	} 
    	else {
    		$result = $this->pdo->prepare("UPDATE cr_menu SET 
	    		cr_option            = ?
	    		WHERE cr_menuLink = ?");	
		    $result->bindParam(1, $showcase);
			$result->bindParam(2, $page_link);
    	}
    	if($result->execute()) {
			$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Unset Portfolios/Products as Showcase', ?, ?, ?)");
			$history_detail = " remove portfolio(s) in page $menu_title from showcase.";
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
    public function delete_submenu($submenu_id, $admin_login_id, $now_date) {
		$submenu_title_query = $this->pdo->query("SELECT * FROM cr_submenu, cr_menu, cr_pagetemplate WHERE cr_submenu.cr_submenuID = '$submenu_id' AND cr_submenu.cr_menuID = cr_menu.cr_menuID AND cr_submenu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID");
		$submenu_title_fetch = $submenu_title_query->fetch(PDO::FETCH_OBJ);
		$submenu_title   = $submenu_title_fetch->cr_submenuTitle;
		$submenu_link    = $submenu_title_fetch->cr_submenuLink;
		$submenu_type    = $submenu_title_fetch->cr_pagetemplateType;
		$menu_title      = $submenu_title_fetch->cr_menuTitle;
		$menu_id         = $submenu_title_fetch->cr_menuID;

		$check_total_sub = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$menu_id'");
    	$total_sub       = $check_total_sub->rowCount();
    	if($total_sub == 1) {
    		$update_menu = $this->pdo->query("UPDATE cr_menu SET cr_menuHasSub = '0' WHERE cr_menuID = '$menu_id'");
    	} 

    	$result = $this->pdo->prepare("DELETE FROM cr_submenu WHERE cr_submenuID = ?");
    	$result->bindParam(1, $submenu_id);
    	if($result->execute()) {
    		if($submenu_type == "general") {
	    		$result2 = $this->pdo->prepare("DELETE FROM cr_general WHERE cr_generalLink = ?");
		    	$result2->bindParam(1, $submenu_link);
		    	$result2->execute();
	    	}

	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Sub Menu', ?, ?, ?)");
			$history_detail = " delete submenu $submenu_title under $menu_title.";
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
    public function delete_menu($menu_id, $admin_login_id, $now_date) {
		$menu_title_query = $this->pdo->query("SELECT * FROM cr_menu, cr_pagetemplate WHERE cr_menu.cr_menuID = '$menu_id' AND cr_menu.cr_pagetemplateID = cr_pagetemplate.cr_pagetemplateID");
		$menu_title_fetch = $menu_title_query->fetch(PDO::FETCH_OBJ);
		$menu_title   = $menu_title_fetch->cr_menuTitle;
		$menu_link    = $menu_title_fetch->cr_menuLink;
		$menu_type    = $menu_title_fetch->cr_pagetemplateType;

    	$result = $this->pdo->prepare("DELETE FROM cr_menu WHERE cr_menuID = ?");
    	$result->bindParam(1, $menu_id);
    	if($result->execute()) {
	    	if($menu_type == "general") {
	    		$result = $this->pdo->prepare("DELETE FROM cr_general WHERE cr_generalLink = ?");
		    	$result->bindParam(1, $menu_link);
		    	$result->execute();
	    	}

	    	$get_history = $this->pdo->prepare("INSERT INTO cr_history(
				    		cr_historyTitle, cr_historyDetail, cr_historyDateTime, cr_adminID) VALUES ('Delete Menu', ?, ?, ?)");
			$history_detail = " delete menu $menu_title.";
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
    public function count_total_page() {
    	$check_menu    = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuHasSub <> '1'");
    	$total_menu    = $check_menu->rowCount();
		$check_submenu = $this->pdo->query("SELECT * FROM cr_submenu");
    	$total_submenu = $check_submenu->rowCount();
    	return $total_menu + $total_submenu;
	}
}
?>