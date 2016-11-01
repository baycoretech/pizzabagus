<?php
/**
 * Class Meta
 *
 * @author baycore
 */

class Meta {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_metakeywords($page, $idlink) {
        $resultp = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page' AND cr_portfolio.cr_portfolioLink = '$idlink'");
        if($resultp->rowCount() < 1) {
            $resultb = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$page' AND cr_blog.cr_blogLink = '$idlink'");
            if($resultb->rowCount() < 1) {
                $resultg = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$page'");
                $rows    = $resultg->fetch(PDO::FETCH_OBJ);
                $metakey = $rows->cr_generalMetaKeywords;
                return $metakey;
            }
            else {
                $rows    = $resultb->fetch(PDO::FETCH_OBJ);
                $metakey = $rows->cr_blogMetaKeywords;
                return $metakey;
            }
        }
        else {
            $rows    = $resultp->fetch(PDO::FETCH_OBJ);
            $metakey = $rows->cr_portfolioMetaKeywords;
            return $metakey;
        }
   }
   public function view_metadescription($page, $idlink) {
        $resultp = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page' AND cr_portfolio.cr_portfolioLink = '$idlink'");
        if($resultp->rowCount() < 1) {
            $resultb = $this->pdo->query("SELECT * FROM cr_blog, cr_blogcategory WHERE cr_blog.cr_blogcategoryID = cr_blogcategory.cr_blogcategoryID AND cr_blogcategory.cr_blogcategoryLink = '$page' AND cr_blog.cr_blogLink = '$idlink'");
            if($resultb->rowCount() < 1) {
                $resultg  = $this->pdo->query("SELECT * FROM cr_general WHERE cr_generalLink = '$page'");
                $rows     = $resultg->fetch(PDO::FETCH_OBJ);
                $metadesc = $rows->cr_generalMetaDescription;
                return $metadesc;
            }
            else {
                $rows     = $resultb->fetch(PDO::FETCH_OBJ);
                $metadesc = $rows->cr_blogMetaDescription;
                return $metadesc;
            }
        }
        else {
            $rows     = $resultp->fetch(PDO::FETCH_OBJ);
            $metadesc = $rows->cr_portfolioMetaDescription;
            return $metadesc;
        }
   }
   public function view_random_gallery_image($page) {
        $result = $this->pdo->query("SELECT * FROM cr_gallery WHERE cr_galleryLink = '$page' ORDER BY RAND()");
        $rows  = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
   }
}
?>