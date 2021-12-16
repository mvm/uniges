<?php

include_once 'Connection.php';

class RoleModel {
    public $id;
    public $name;
    public $deleted;
    
    public static function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM role WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $value = array();
        while($obj = $result->fetch_object("RoleModel")) {
            array_push($value, $obj);
        }
        return $value;
    }
}
?>
