<?php
/**
 * Class Our Menu
 *
 * @author baycore
 */

class Our_Menu {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_ourmenu($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_ourmenuStatus = 'publish' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_name_asc($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_ourmenuStatus = 'publish' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuTitle asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_name_desc($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_ourmenuStatus = 'publish' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuTitle desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_date_asc($page_link) {
        $result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_ourmenuStatus = 'publish' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuDate asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_date_desc($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_ourmenuStatus = 'publish' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuDate desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_alphabet($page_link, $alphabet) {
        $alphabet_uppercase = ucwords($alphabet);
        $result    = $this->pdo->query("SELECT * FROM  cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_ourmenuTitle LIKE '$alphabet_uppercase%' AND cr_ourmenu.cr_ourmenuStatus = 'publish' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuTitle asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_number($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenucategory.cr_ourmenucategoryLink = '$page_link' AND cr_ourmenu.cr_ourmenuStatus = 'publish' AND cr_ourmenu.cr_ourmenuTitle REGEXP '^[0-9]' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID ORDER BY cr_ourmenu.cr_ourmenuTitle asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_in_category($category, $pid) {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu WHERE cr_ourmenuStatus='publish' AND cr_ourmenucategoryID = '$category' AND cr_ourmenuID <> '$pid' ORDER BY cr_ourmenuID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_selected_ourmenu() {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuSelected = 'yes' AND cr_ourmenu.cr_ourmenuStatus = 'publish' ORDER BY cr_ourmenu.cr_ourmenuID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_ourmenu_detail($link) {
        $result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory, cr_admin WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuLink = '$link' AND cr_ourmenu.cr_adminID = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_ourmenu_detail_order($menu_id) {
        $result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuID = '$menu_id'");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_random_two_ourmenu() {
        $result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuStatus = 'publish' ORDER BY RAND() LIMIT 2");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_random_three_ourmenu() {
        $result    = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuStatus = 'publish' ORDER BY RAND() LIMIT 3");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_latest_ourmenu_carousel() {
        $result = $this->pdo->query("SELECT * FROM cr_ourmenu, cr_ourmenucategory WHERE cr_ourmenu.cr_ourmenucategoryID = cr_ourmenucategory.cr_ourmenucategoryID AND cr_ourmenu.cr_ourmenuStatus = 'publish' ORDER BY cr_ourmenu.cr_ourmenuDate desc LIMIT 8");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
}
?>