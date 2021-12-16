<?php

include_once 'Connection.php';

class SpaceModel {
    public $id;
    public $academicyear_id;
    public $building_id;
    public $name;
    public $type;
    public $deleted;
    
    public $academicyear;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO space VALUES (?,?,?,?,?,?)");
        $stat->bind_param("iiissi", $this->id, $this->academicyear_id,
            $this->building_id, $this->name, $this->type, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE space SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE space SET academicyear_id = ?, building_id = ?, name = ?, type = ? WHERE id = ?");
        $stat->bind_param("iissi", $this->academicyear_id, $this->building_id, $this->name, $this->type, $this->id);
        $stat->execute();
        return $stat;
    }
    
    static public function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM space WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("SpaceModel");
    }
    
    static public function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM space WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $value = array();
        while($fila = $result->fetch_object("SpaceModel")) {
            array_push($value, $fila);
        }
        return $value;
    }
}
?>
