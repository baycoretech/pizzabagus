<?php
/**
 * Class Portfolio Extra
 *
 * @author baycore
 */

class Portfolio_Extra {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_portfolio_extra($portfolio_link) {
        $result    = $this->pdo->query("SELECT * FROM cr_portfolioextra, cr_portfolio WHERE cr_portfolioextra.cr_portfolioID = cr_portfolio.cr_portfolioID AND cr_portfolio.cr_portfolioLink = '$portfolio_link'");
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