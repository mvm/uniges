<?php

include_once 'Connection.php';

class BuildingModel {
    public $id;
    public $academicyear_id;
    public $college_id;
    public $name;
    public $location;
    public $deleted;
    
    public $academicyear;
    public $college;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO building VALUES (?,?,?,?,?,?)");
        $stat->bind_param("iiissi", $this->id, $this->academicyear_id, $this->college_id,
            $this->name, $this->location, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE building SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE building SET academicyear_id = ?, college_id = ?, name = ?, location = ? WHERE id = ?");
        $stat->bind_param("iissi", $this->academicyear_id, $this->college_id, $this->name, $this->location, $this->id);
        $stat->execute();
        return $stat;
    }
    
    static public function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM building WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $value = array ();
        while($fila = $result->fetch_object("BuildingModel")) {
            array_push($value, $fila);
        }
        return $value;
    }
    
    static public function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM building WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("BuildingModel");
    }
}
?>
