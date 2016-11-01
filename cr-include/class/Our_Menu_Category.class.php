<?php
/**
 * Class Our Menu Category
 *
 * @author baycore
 */

class Our_Menu_Category {
    private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_ourmenu_category() {
        $result     = $this->pdo->query("SELECT * FROM cr_ourmenucategory ORDER BY cr_ourmenucategoryOrder asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[] = $rows;
        return $data;
    }
    public function view_ourmenu_category($page_link) {
        $check  = $this->pdo->query("SELECT * FROM cr_ourmenucategory, cr_menu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_menu.cr_menuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
        if($check->rowCount() < 1){
            $result    = $this->pdo->query("SELECT * FROM cr_ourmenucategory, cr_submenu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
            if($result->rowCount() < 1){
                $alert = 0;
                return $alert;
            }
            else {
                while($rows = $result->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }
        }
        else {
            $result    = $this->pdo->query("SELECT * FROM cr_ourmenucategory, cr_menu WHERE cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenucategory.cr_ourmenucategoryLink = cr_menu.cr_menuLink ORDER BY cr_ourmenucategory.cr_ourmenucategoryOrder asc");
            if($result->rowCount() < 1){
                $alert = 0;
                return $alert;
            }
            else {
                while($rows = $result->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }
        }
    }
    public function check_in_ourmenu_category($pc_id) {
        $result = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenucategoryID = '$pc_id'");
        if($result->rowCount() < 1){
            $alert = 0;
            return $alert;
        }
        else {
            $alert = 1;
            return $alert;
        }
    }
}
?>