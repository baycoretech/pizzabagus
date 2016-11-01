<?php
/**
 * Class Product Extra
 *
 * @author baycore
 */

class Product_Extra {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_product_extra($product_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_productextra, cr_product WHERE cr_productextra.cr_productID = cr_product.cr_productID AND cr_product.cr_productLink = '$product_link'");
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
?>