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
    	$check = $this->pdo->query("SELECT * FROM cr_menu ORDER BY cr_menuOrder asc");
    	if($check->rowCount() < 1){
    		return false;
    	}
    	else {
	    	while($rows = $check->fetch(PDO::FETCH_OBJ))
		    	$data[]=$rows;
		    return $data;
		}
    }
    public function view_submenu($menu) {
        $menu_id_query = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_menuLink = '$menu'");
        $menu_id_fetch = $menu_title_query->fetch(PDO::FETCH_OBJ);
        $menu_id       = $menu_title_fetch->cr_menuID;
        $check            = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$menu_id' AND cr_pagetemplateID <> '10' ORDER BY cr_submenuOrder asc");
        if($check->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $check->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function view_menu_sub($menu) {
        $result = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_menuID = '$menu' ORDER BY cr_submenuOrder asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[]=$rows;
        return $data;
    }
    public function view_page_template() {
        $result = $this->pdo->query("SELECT * FROM cr_pagetemplate ORDER BY cr_pagetemplateID asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[]=$rows;
        return $data;
    }
}
?>