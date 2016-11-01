<?php
/**
 * Class Jumbotron
 *
 * @author baycore
 */

class Jumbotron {
    private $pdo;
    protected $alert = 0;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function view_plain_jumbotron() {
        $result = $this->pdo->query("SELECT * FROM cr_jumbotron WHERE cr_jumbotronName = 'plainjumbotron'");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        if($rows->cr_jumbotronCaption=='' || empty($rows->cr_jumbotronCaption)) {
            return $alert;
        }
        else {
            return $rows;
        }
    }
    public function view_background_jumbotron() {
        $result = $this->pdo->query("SELECT * FROM cr_jumbotron WHERE cr_jumbotronName = 'backgroundjumbotron' LIMIT 1");
        $rows = $result->fetch(PDO::FETCH_OBJ);
        if($rows->cr_jumbotronCaption=='' || empty($rows->cr_jumbotronCaption)) {
            return $alert;
        }
        else {
            return $rows;
        }
    }
}
?>