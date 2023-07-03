<?php

include_once 'Connection.php';

class CollegeModel {
    public $id;
    public $academicyear_id;
    public $name;
    public $city;
    public $supervisor;
    public $deleted;
    
    public $academicyear;
    public $supervisor_obj;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO college VALUES (?, ?, ?, ?, ?, ?)");
        $stat->bind_param("iissii", $this->id, $this->academicyear_id, $this->name,
            $this->city, $this->supervisor, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE college SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE college SET academicyear_id = ?, name = ?, city = ?, supervisor = ?, deleted = ? WHERE id = ?");
        $stat->bind_param("issiii", $this->academicyear_id, $this->name, $this->city, $this->supervisor, $this->deleted, $this->id);
        $stat->execute();
        return $stat;
    }
    
    static public function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM college WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $value = array ();
        while($fila = $result->fetch_object("CollegeModel")) {
            array_push($value, $fila);
        }
        return $value;
    }
    
    static public function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM college WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("CollegeModel");
    }
}
?>
