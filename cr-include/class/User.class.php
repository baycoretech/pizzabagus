<?php
/**
 * Class User
 *
 * @author baycore
 */

class User {
    private $pdo; //database conection link
     
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function user_list() {
        $result = $this->pdo->query("SELECT * FROM cr_admin ORDER BY cr_adminID asc");
        while($rows = $result->fetch(PDO::FETCH_OBJ))
            $data[] = $rows;
        return $data;
    }
    public function admin_self($cr_admin_id_session) {
        $result = $this->pdo->prepare("SELECT * FROM cr_admin WHERE cr_adminID= ?");
        $result->bindParam(1, $cr_admin_id_session);
        $result->execute();
        $rows   = $result->fetch(PDO::FETCH_OBJ);
        return $rows;
    }
}
?>