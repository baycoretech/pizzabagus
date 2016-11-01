<?php
/**
 * Class Product Reviews
 *
 * @author baycore
 */

class Product_Reviews {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_total_reviews($product_link) {
        $result = $this->pdo->query("SELECT * FROM cr_productreviews, cr_product WHERE cr_productreviews.cr_productID = cr_product.cr_productID AND cr_productreviews.cr_productreviewsStatus = '2' AND cr_product.cr_productLink = '$product_link'");
        $total = $result->rowCount();
        return $total;
    }
    public function view_reviews($product_link) {
        $result = $this->pdo->query("SELECT * FROM cr_product, cr_productreviews WHERE cr_product.cr_productLink = '$product_link' AND cr_product.cr_productID = cr_productreviews.cr_productID AND cr_productreviews.cr_productreviewsStatus = '2' ORDER BY cr_productreviews.cr_productreviewsDate asc");
        if($result->rowCount()<1) {
            $alert = 0;
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                    $data[]=$rows;
            return $data;
        }
    }
    public function send_review($review_name, $review_title, $review_email, $review_star, $review_text, $pid, $now_date) {
        $title  = ucwords($review_title);
        $status = "1";
        $result = $this->pdo->prepare("INSERT INTO cr_productreviews(
                        cr_productreviewsName, cr_productreviewsTitle, cr_productreviewsStar, cr_productreviewsEmail, cr_productreviewsReview, cr_productreviewsDate, cr_productreviewsStatus, cr_productID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $result->bindParam(1, $review_name);
        $result->bindParam(2, $title);
        $result->bindParam(3, $review_star);
        $result->bindParam(4, $review_email);
        $result->bindParam(5, $review_text);
        $result->bindParam(6, $now_date);
        $result->bindParam(7, $status);
        $result->bindParam(8, $pid);
        $result->execute();
    }
    
    public function get_product_menu($pid) {
        $result  = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_menu WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = cr_menu.cr_menuLink AND cr_product.cr_productID='$pid'");
        if($result->rowCount()<1) {
            $result2  = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_submenu WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = cr_submenu.cr_submenuLink AND cr_product.cr_productID = '$pid'");
            $rows2    = $result2->fetch(PDO::FETCH_OBJ);
            return $rows2->cr_submenuLink;
        }
        else {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            return $rows->cr_menuLink;
        }
    }
}
?>