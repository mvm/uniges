<?php

include_once 'Connection.php';

class PdaModel {
    public $id;
    public $title;
    public $file;
    public $academicyear_id;
    public $college_id;
    public $centre_id;
    public $degree_id;
    public $deleted;
    
    public $academicyear_obj;
    public $college_obj;
    public $centre_obj;
    public $degree_obj;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO pda VALUES (?,?,?,?,?,?,?,?)");
        $stat->bind_param("issiiiii", $this->id, $this->title, $this->file, $this->academicyear_id, $this->college_id, $this->centre_id, $this->degree_id, $this->deleted);
        $stat->execute();
        return $stat;
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE pda SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        $stat->execute();
        return $stat;
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE pda SET title = ?, file = ?, academicyear_id = ?, college_id = ?, centre_id = ?, degree_id = ? WHERE id = ?");
        $stat->bind_param("ssiiiii", $this->title, $this->file, $this->academicyear_id, $this->college_id, $this->centre_id, $this->degree_id, $this->id);
        $stat->execute();
        return $stat;
    }
    
    static public function findById($id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM pda WHERE deleted = 0 AND id = ?");
        $stat->bind_param("i", $id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("PdaModel");
    }
    
    static public function findAll() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM pda WHERE deleted = 0");
        $stat->execute();
        $result = $stat->get_result();
        $values = array ();
        while($fila = $result->fetch_object("PdaModel")) {
            array_push($values, $fila);
        }
        return $values;
    }
}
?>
