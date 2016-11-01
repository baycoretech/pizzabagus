<?php
/**
 * Class Breadchrumb
 *
 * @author baycore
 */

class Breadchrumb {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function bc_portfolio($id_link) {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioLink = '$id_link'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows->cr_portfolioTitle;
    }
    public function bc_blog($id_link) {
        $result = $this->pdo->query("SELECT * FROM cr_blog WHERE cr_blogLink = '$id_link'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows->cr_blogTitle;
    }
    public function bc_blog_category($ex_link) {
        $result = $this->pdo->query("SELECT * FROM cr_blogcategory WHERE cr_blogcategorySlug = '$ex_link'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows->cr_blogcategoryName;
    }
    public function bc_tag($id_link) {
        $result = $this->pdo->query("SELECT * FROM cr_blogtags WHERE cr_blogtagsName = '$id_link'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return ucwords($rows->cr_blogtagsName);
    }
}
?>