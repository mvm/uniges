<?php

include_once 'Connection.php';

class SubjectModel {
    public $id;
    public $academicyear_id;
    public $degree_id;
    public $department_id;
    public $professor_id;
    public $code;
    public $name;
    public $content;
    public $credits;
    public $type;
    public $hours;
    public $semester;
    public $deleted;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO subject VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stat->bind_param("iiiiisssisisi", $this->id, $this->academicyear_id, $this->degree_id,
            $this->department_id, $this->professor_id, $this->code, $this->name,
            $this->content, $this->credits, $this->type, $this->hours, $this->semester, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE subject SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE subject SET academicyear_id = ?, degree_id = ?, department_id = ?, professor_id = ?, code = ?, name = ?, content = ?, credits = ?, type = ?, hours = ?, semester = ? WHERE id = ?");
        $stat->bind_param("iiiisssisisi", $this->academicyear_id, $this->degree_id,
            $this->department_id,
            $this->professor_id, $this->code, $this->name, $this->content, $this->credits, $this->type,
            $this->hours, $this->semester, $this->id);
        $stat->execute();
        return $stat;
    }
    
    public static function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM subject WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $value = array();
        while($fila = $result->fetch_object("SubjectModel")) {
            array_push($value, $fila);
        }
        return $value;
    }
    
    public static function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM subject WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("SubjectModel");
    }
}
?>
