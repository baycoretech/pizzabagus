<?php
/**
 * Class Product
 *
 * @author baycore
 */

class Product {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_currency() {
        $result = $this->pdo->query("SELECT * FROM cr_currency WHERE cr_currencyStatus = '1'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    public function view_active_currency($code) {
        $result = $this->pdo->query("SELECT * FROM cr_currency WHERE cr_currencyCode = '$code'");
        $row    = $result->fetch(PDO::FETCH_OBJ);
        return $row;
    }
    public function view_all_currency() {
        $result = $this->pdo->query("SELECT * FROM cr_currency ORDER BY cr_currencyStatus desc");
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
    public function view_product($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_productcategory.cr_productcategoryLink = '$page_link' AND cr_product.cr_productStatus='publish' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productID desc");
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
    public function view_all_product_for_search() {
        $result    = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_product.cr_productStatus='publish' ORDER BY cr_product.cr_productID desc");
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
    public function view_product_detail($link) {
        $result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_product.cr_productLink = '$link' AND cr_product.cr_adminID = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_product_extra($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_product, cr_productextra WHERE cr_product.cr_productID = cr_productextra.cr_productID AND cr_productextra.cr_productID = '$pid'");
        $total  = $result->rowCount();
        return $total;
    }
    public function check_ip_likes($pid, $ip) {
        $result = $this->pdo->query("SELECT * FROM cr_productlikes WHERE cr_productID = '$pid' AND cr_productlikesIP = '$ip' LIMIT 1");
        $total  = $result->rowCount();
        return $total;
    }
    public function add_likes($pid, $ip, $now_date) {
        $result = $this->pdo->query("INSERT INTO cr_productlikes (cr_productlikesIP, cr_productlikesDate, cr_productID) VALUES ('$ip', '$now_date', '$pid')");
    }
    public function count_likes_front($product_name) {
        $result = $this->pdo->query("SELECT * FROM cr_productlikes, cr_product WHERE cr_productlikes.cr_productID = cr_product.cr_productID AND cr_product.cr_productLink = '$product_name'");
        $total  = $result->rowCount();
        return $total;
    }
    public function get_ip_likes($product_name, $visitor_ip) {
        $result = $this->pdo->query("SELECT * FROM cr_productlikes, cr_product WHERE cr_productlikes.cr_productID = cr_product.cr_productID AND cr_product.cr_productLink = '$product_name' AND cr_productlikes.cr_productlikesIP = '$visitor_ip'");
        $total  = $result->rowCount();
        return $total;
    }
    public function count_reviews_approve($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_productreviews WHERE cr_productID = '$pid' AND cr_productreviewsStatus = '2'");
        $total = $result->rowCount();
        return $total;
    }
    public function count_visitor($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_productvisitor WHERE cr_productID = '$pid'");
        $total  = $result->rowCount();
        return $total;
    }
    public function save_product_visitor($ip, $pid, $now_date) {
        $check_ip  = $this->pdo->query("SELECT * FROM cr_productvisitor WHERE cr_productvisitorIP = '$ip' AND cr_productID = '$pid'");
        $insert_ip = $this->pdo->prepare("INSERT INTO cr_productvisitor (cr_productvisitorIP, cr_productvisitorDate, cr_productID) VALUES(?, ?, ?)");
        $insert_ip->bindParam(1, $ip);
        $insert_ip->bindParam(2, $now_date);
        $insert_ip->bindParam(3, $pid);
        if($check_ip->rowCount() == 0) {
            $insert_ip->execute();
        }
    }
    public function view_product_chart($pid) {
        $result    = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_product.cr_productID = '$pid' ORDER BY cr_product.cr_productID desc");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function get_discount_coupon($dcid) {
        $result    = $this->pdo->query("SELECT * FROM cr_discountcoupon WHERE cr_discountcouponCode = '$dcid' LIMIT 1");
        if($result->rowCount() < 1){
            $alert = 0;
            return $alert;
        }
        else {
            $rows = $result->fetch(PDO::FETCH_OBJ);
            $valid_until   =  $rows->cr_discountcouponValiduntil;
            $date_discount = date('Y-m-d', strtotime($valid_until)); 
            $date_now      = date('Y-m-d', strtotime('now')); 
            if(strtotime($date_discount) < strtotime($date_now)) {
                return 'expired';
            }
            else {
                return $rows;
            }
        }
    }
    public function view_featured_product_categories() {
        $result = $this->pdo->query("SELECT * FROM cr_productcategory WHERE cr_productcategoryFeatured = '1' ORDER BY cr_productcategoryID desc");
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
    public function view_random_product_categories_image($product_categoryID) {
        $result = $this->pdo->query("SELECT * FROM cr_product WHERE cr_productcategoryID = '$product_categoryID' ORDER BY RAND()");
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
    public function view_product_name_in_featured_categories($product_categoryID) {
        $result = $this->pdo->query("SELECT * FROM cr_product WHERE cr_productcategoryID = '$product_categoryID' ORDER BY cr_productID desc LIMIT 3");
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
    public function view_custom_shop_latest_arrival_product() {
        $result    = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_product.cr_productStatus='publish' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productID desc LIMIT 8");
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
    public function view_custom_shop_featured_product_manual() {
        $result    = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_product.cr_productStatus='publish' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productFeaturedorder asc LIMIT 8");
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
    public function view_custom_shop_topseller_product_manual() {
        $result    = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory, cr_admin WHERE cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID AND cr_product.cr_productStatus='publish' AND cr_product.cr_adminID = cr_admin.cr_adminID ORDER BY cr_product.cr_productTopsellerorder asc LIMIT 8");
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
    public function view_custom_shop_featured_product_automatic() {
        $result = $this->pdo->query("SELECT cr_product.cr_productID, cr_product.cr_productTitle, cr_product.cr_productLink, cr_product.cr_productDesc, cr_product.cr_productDate, cr_product.cr_productThumb, cr_product.cr_productPrice, cr_product.cr_productDiscount, cr_product.cr_productStock, cr_product.cr_productStatus, cr_product.cr_productcategoryID, COUNT(*) FROM cr_product INNER JOIN cr_productlikes ON cr_product.cr_productID = cr_productlikes.cr_productID WHERE cr_product.cr_productStatus = 'publish' GROUP BY cr_product.cr_productID ORDER BY count(*) desc LIMIT 8");
        if($result->rowCount()<1) {
            $alert = 0;
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_custom_shop_topseller_product_automatic() {
        $result = $this->pdo->query("SELECT cr_product.cr_productID, cr_product.cr_productTitle, cr_product.cr_productLink, cr_product.cr_productDesc, cr_product.cr_productDate, cr_product.cr_productThumb, cr_product.cr_productPrice, cr_product.cr_productDiscount, cr_product.cr_productStock, cr_product.cr_productStatus, cr_product.cr_productcategoryID, COUNT(*) FROM cr_product INNER JOIN cr_invoicedetail ON cr_product.cr_productID = cr_invoicedetail.cr_productID LEFT JOIN cr_invoice ON cr_invoice.cr_invoiceNumber = cr_invoicedetail.cr_invoiceNumber WHERE cr_product.cr_productStatus = 'publish' AND cr_invoice.cr_invoiceStatus = 'paid' GROUP BY cr_product.cr_productID, cr_invoice.cr_invoiceNumber ORDER BY count(*) desc LIMIT 8");
        if($result->rowCount()<1) {
            $alert = 0;
            return $alert;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_featured_product_automatic_category($product_id) {
        $result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory WHERE cr_product.cr_productID = '$product_id' AND cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_topseller_product_automatic_category($product_id) {
        $result = $this->pdo->query("SELECT * FROM cr_product, cr_productcategory WHERE cr_product.cr_productID = '$product_id' AND cr_product.cr_productcategoryID = cr_productcategory.cr_productcategoryID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}
?>