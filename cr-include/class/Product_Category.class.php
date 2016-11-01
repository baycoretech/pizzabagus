<?php
/**
 * Class Product Category
 *
 * @author baycore
 */

class Product_Category {
    private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_product_category() {
        $result     = $this->pdo->query("SELECT * FROM cr_productcategory ORDER BY cr_productcategoryOrder asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[] = $rows;
        return $data;
    }
    public function view_product_category($page_link) {
        $check  = $this->pdo->query("SELECT * FROM cr_productcategory, cr_menu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_menu.cr_menuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
        if($check->rowCount() < 1){
            $result    = $this->pdo->query("SELECT * FROM cr_productcategory, cr_submenu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
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
            $result    = $this->pdo->query("SELECT * FROM cr_productcategory, cr_menu WHERE cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_productcategory.cr_productcategoryLink = cr_menu.cr_menuLink ORDER BY cr_productcategory.cr_productcategoryOrder asc");
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
    public function check_in_product_category($pc_id) {
        $result = $this->pdo->query("SELECT * FROM cr_product WHERE cr_productcategoryID = '$pc_id'");
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