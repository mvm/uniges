<?php

include_once 'Connection.php';

class GroupModel {
    public $id;
    public $academicyear_id;
    public $subject_id;
    public $professor_id;
    public $code;
    public $name;
    public $type;
    public $hours;
    public $deleted;
    
    public $academicyear;
    public $subject;
    public $professor;
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE `group` SET academicyear_id = ?, subject_id = ?, professor_id = ?, code = ?, name = ?, type = ?, hours = ? WHERE id = ?");
        $stat->bind_param("iiisssii", $this->academicyear_id, $this->subject_id, $this->professor_id, $this->code, $this->name, $this->type, $this->hours, $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO `group` VALUES (?,?,?,?,?,?,?,?,?)");
        $stat->bind_param("iiiisssii", $this->id, $this->academicyear_id, $this->subject_id, $this->professor_id, $this->code, $this->name, $this->type, $this->hours, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE `group` SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }

    static public function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM `group` WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("GroupModel");
    }
    
    static public function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM `group` WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $value = array();
        while($fila = $result->fetch_object("GroupModel")) {
            array_push($value, $fila);
        }
        return $value;
    }
}
?>
