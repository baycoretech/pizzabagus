<?php
/**
 * Class Portfolio Category
 *
 * @author baycore
 */

class Portfolio_Category {
    private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_portfolio_category() {
        $result     = $this->pdo->query("SELECT * FROM cr_portfoliocategory ORDER BY cr_portfoliocategoryOrder asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[] = $rows;
        return $data;
    }
    public function view_portfolio_category($page_link) {
        $check  = $this->pdo->query("SELECT * FROM cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
        if($check->rowCount() < 1){
            $result    = $this->pdo->query("SELECT * FROM cr_portfoliocategory, cr_submenu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
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
            $result    = $this->pdo->query("SELECT * FROM cr_portfoliocategory, cr_menu WHERE cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfoliocategory.cr_portfoliocategoryLink = cr_menu.cr_menuLink ORDER BY cr_portfoliocategory.cr_portfoliocategoryOrder asc");
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
    public function check_in_portfolio_category($pc_id) {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfoliocategoryID = '$pc_id'");
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