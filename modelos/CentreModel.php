<?php

include_once 'Connection.php';

class CentreModel {
    public $id;
    public $academicyear_id;
    public $college_id;
    public $name;
    public $city;
    public $overseer;
    public $deleted;
    
    public $academicyear;
    public $college;
    public $overseer_obj;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO centre VALUES (?,?,?,?,?,?,?)");
        $stat->bind_param("iiissii", $this->id, $this->academicyear_id, $this->college_id, $this->name, $this->city, $this->overseer, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE centre SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE centre SET academicyear_id = ?, college_id = ?, name = ?, city = ?, overseer = ? WHERE id = ?");
        $stat->bind_param("iissii", $this->academicyear_id, $this->college_id, $this->name, $this->city, $this->overseer, $this->id);
        $stat->execute();
        return $stat;
    }
    
    static public function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM centre WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $values = array ();
        while($fila = $result->fetch_object("CentreModel")) {
            array_push($values, $fila);
        }
        return $values;
    }
    
    static public function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM centre WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("CentreModel");
    }
}
?>
