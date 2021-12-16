<?php

include_once 'Connection.php';

class DegreeModel {
    public $id;
    public $academicyear_id;
    public $centre_id;
    public $code;
    public $name;
    public $supervisor;
    public $deleted;
    
    public $academicyear;
    public $centre;
    public $supervisor_obj;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO `degree` VALUES (?,?,?,?,?,?,?)");
        $stat->bind_param("iiissii", $this->id, $this->academicyear_id, $this->centre_id, $this->code, $this->name, $this->supervisor, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE `degree` SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE `degree` SET academicyear_id = ?, centre_id = ?, code = ?, name = ?, supervisor = ? WHERE deleted = 0 AND id = ?");
        $stat->bind_param("iissii", $this->academicyear_id, $this->centre_id, $this->code, $this->name, $this->supervisor, $this->id);
        $stat->execute();
        return $stat;
    }
    
    static public function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM degree WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("DegreeModel");
    }
    
    static public function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM degree WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $values = array ();
        while($fila = $result->fetch_object("DegreeModel")) {
            array_push($values, $fila);
        }
        return $values;
    }
}
?>
