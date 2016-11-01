<?php
/**
 * Class Blog Category
 *
 * @author baycore
 */

class Blog_Category {
    private $pdo; //database conection link
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_all_blog_category() {
        $result     = $this->pdo->query("SELECT * FROM cr_blogcategory ORDER BY cr_blogcategoryOrder asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[] = $rows;
        return $data;
    }
    public function view_blog_category($page_link) {
        $check  = $this->pdo->query("SELECT * FROM cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$page_link' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
        if($check->rowCount() < 1){
            $result = $this->pdo->query("SELECT * FROM cr_blogcategory, cr_submenu WHERE cr_blogcategory.cr_blogcategoryLink = '$page_link' AND cr_blogcategory.cr_blogcategoryLink = cr_submenu.cr_submenuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
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
            $result    = $this->pdo->query("SELECT * FROM cr_blogcategory, cr_menu WHERE cr_blogcategory.cr_blogcategoryLink = '$page_link' AND cr_blogcategory.cr_blogcategoryLink = cr_menu.cr_menuLink ORDER BY cr_blogcategory.cr_blogcategoryOrder asc");
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
    public function total_post_in_category($bcid) {
        $result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogcategoryID = '$bcid' AND cr_blogStatus = 'publish'");
        $total = $result->rowCount();
        return $total;
    }
}
?>