<?php
/**
 * Class Sitemap
 *
 * @author baycore
 */

class Sitemap {
    private $pdo;
    protected $alert = 0;
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function sitemap_portfolio() {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID ORDER BY cr_portfolio.cr_portfolioID desc");
        if($result->rowCount() < 1) {
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function sitemap_blog_category() {
        $result = $this->pdo->query("SELECT * FROM cr_blogcategory ORDER BY cr_blogcategoryID desc");
        if($result->rowCount() < 1) {
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function sitemap_blog() {
        $result = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory, cr_blogtype WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blog.cr_blogtypeID=cr_blogtype.cr_blogtypeID AND (cr_blogtype.cr_blogtypeName = 'standard' OR cr_blogtype.cr_blogtypeName = 'image' OR cr_blogtype.cr_blogtypeName = 'sound' OR cr_blogtype.cr_blogtypeName = 'video') ORDER BY cr_blog.cr_blogPostdate desc");
        if($result->rowCount() < 1) {
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
    public function sitemap_blog_tags() {
        $result = $this->pdo->query("SELECT * FROM cr_blogtags ORDER BY cr_blogtagsID asc");
        if($result->rowCount() < 1) {
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[]=$rows;
            return $data;
        }
    }
}
?>