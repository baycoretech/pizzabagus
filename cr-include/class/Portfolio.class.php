<?php
/**
 * Class Portfolio
 *
 * @author baycore
 */

class Portfolio {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_portfolio($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioStatus = 'publish' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_name_asc($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioStatus = 'publish' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_name_desc($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioStatus = 'publish' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_date_asc($page_link) {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioStatus = 'publish' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioDate asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_date_desc($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioStatus = 'publish' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioDate desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_alphabet($page_link, $alphabet) {
        $alphabet_uppercase = ucwords($alphabet);
        $result    = $this->pdo->query("SELECT * FROM  cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioTitle LIKE '$alphabet_uppercase%' AND cr_portfolio.cr_portfolioStatus = 'publish' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_number($page_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioStatus = 'publish' AND cr_portfolio.cr_portfolioTitle REGEXP '^[0-9]' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID ORDER BY cr_portfolio.cr_portfolioTitle asc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_in_category($category, $pid) {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio WHERE cr_portfolioStatus='publish' AND cr_portfoliocategoryID = '$category' AND cr_portfolioID <> '$pid' ORDER BY cr_portfolioID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_selected_portfolio() {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfolio.cr_portfolioSelected = 'yes' AND cr_portfolio.cr_portfolioStatus = 'publish' ORDER BY cr_portfolio.cr_portfolioID desc");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_portfolio_detail($link) {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory, cr_admin WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfolio.cr_portfolioLink = '$link' AND cr_portfolio.cr_adminID = cr_admin.cr_adminID");
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
    public function view_portfolio_extra($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfolioextra WHERE cr_portfolio.cr_portfolioID = cr_portfolioextra.cr_portfolioID AND cr_portfolioextra.cr_portfolioID = '$pid'");
        $total  = $result->rowCount();
        return $total;
    }
    public function view_showcase_portfolio() {
        $check = $this->pdo->query("SELECT * FROM cr_menu WHERE cr_option = 'showcase'");
        if($check->rowCount()<1) {
            $page_link_query = $this->pdo->query("SELECT * FROM cr_submenu WHERE cr_option = 'showcase'");
            $page_link_fetch = $page_link_query->fetch(PDO::FETCH_OBJ);
            $page_link       = $page_link_fetch->cr_submenuLink;
            $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link' AND cr_portfolio.cr_portfolioStatus = 'publish' ORDER BY cr_portfolio.cr_portfolioID desc");
            if($result->rowCount() < 1){
                return false;
            }
            else {
                while($rows = $result->fetch(PDO::FETCH_OBJ))
                    $data[] = $rows;
                return $data;
            }
        }
        else {
            $page_link2_fetch = $check->fetch(PDO::FETCH_OBJ);
            $page_link2       = $page_link2_fetch->cr_menuLink;
            $result           = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfoliocategory.cr_portfoliocategoryLink = '$page_link2' AND cr_portfolio.cr_portfolioStatus = 'publish' ORDER BY cr_portfolio.cr_portfolioID desc");
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
    public function view_random_two_portfolio() {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfolio.cr_portfolioStatus = 'publish' ORDER BY RAND() LIMIT 2");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_random_three_portfolio() {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfolio.cr_portfolioStatus = 'publish' ORDER BY RAND() LIMIT 3");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function view_latest_portfolio_carousel() {
        $result = $this->pdo->query("SELECT * FROM cr_portfolio, cr_portfoliocategory WHERE cr_portfolio.cr_portfoliocategoryID = cr_portfoliocategory.cr_portfoliocategoryID AND cr_portfolio.cr_portfolioStatus = 'publish' ORDER BY cr_portfolio.cr_portfolioDate desc LIMIT 8");
        if($result->rowCount() < 1){
            return false;
        }
        else {
            while($rows = $result->fetch(PDO::FETCH_OBJ))
                $data[] = $rows;
            return $data;
        }
    }
    public function check_ip_likes($pid, $ip) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliolikes WHERE cr_portfolioID = '$pid' AND cr_portfoliolikesIP = '$ip' LIMIT 1");
        $total  = $result->rowCount();
        return $total;
    }
    public function count_likes($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliolikes WHERE cr_portfolioID = '$pid'");
        $total  = $result->rowCount();
        return $total;
    }
    public function count_likes_front($portfolio_name) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliolikes, cr_portfolio WHERE cr_portfoliolikes.cr_portfolioID = cr_portfolio.cr_portfolioID AND cr_portfolio.cr_portfolioLink = '$portfolio_name'");
        $total  = $result->rowCount();
        return $total;
    }
    public function get_ip_likes($portfolio_name, $visitor_ip) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliolikes, cr_portfolio WHERE cr_portfoliolikes.cr_portfolioID = cr_portfolio.cr_portfolioID AND cr_portfolio.cr_portfolioLink = '$portfolio_name' AND cr_portfoliolikes.cr_portfoliolikesIP = '$visitor_ip'");
        $total  = $result->rowCount();
        return $total;
    }
    public function add_likes($pid, $ip, $now_date) {
        $result = $this->pdo->query("INSERT INTO cr_portfoliolikes (cr_portfoliolikesIP, cr_portfoliolikesDate, cr_portfolioID) VALUES ('$ip', '$now_date', '$pid')");
    }
    public function save_portfolio_visitor($ip, $pid, $now_date) {
        $check_ip  = $this->pdo->query("SELECT * FROM cr_portfoliovisitor WHERE cr_portfoliovisitorIP = '$ip' AND cr_portfolioID = '$pid'");
        $insert_ip = $this->pdo->prepare("INSERT INTO cr_portfoliovisitor (cr_portfoliovisitorIP, cr_portfoliovisitorDate, cr_portfolioID) VALUES(?, ?, ?)");
        $insert_ip->bindParam(1, $ip);
        $insert_ip->bindParam(2, $now_date);
        $insert_ip->bindParam(3, $pid);
        if($check_ip->rowCount() == 0) {
            $insert_ip->execute();
        }
    }
    public function count_visitor($pid) {
        $result = $this->pdo->query("SELECT * FROM cr_portfoliovisitor WHERE cr_portfolioID = '$pid'");
        $total  = $result->rowCount();
        return $total;
    }
}
?>