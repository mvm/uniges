<?php

include_once 'Connection.php';

class AsistenciaTutoriaModel {
    public $tutoria_id;
    public $timetable_id;
    public $attendance;
    public $deleted;
    
    public $timetable;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO asistenciatutoria VALUES (?, ?, ?, ?)");
        $stat->bind_param("iisi", $this->tutoria_id, $this->timetable_id,
            $this->attendance, $this->deleted);
        return $stat->execute();
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE asistenciatutoria SET attendance = ? WHERE tutoria_id = ? AND timetable_id = ?");
        if(!$stat) {
            echo "Error: {$conn->error}";
            return null;
        }
        
        $stat->bind_param("sii", $this->attendance, $this->tutoria_id, $this->timetable_id);
        return $stat->execute();
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE asistenciatutoria SET deleted = 1 WHERE tutoria_id = ?, timetable_id = ?");
        $stat->bind_param("ii", $this->tutoria_id, $this->timetable_id);
        return $stat->execute();
    }
    
    public static function findByTutoria($tutoria_id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM asistenciatutoria WHERE tutoria_id = ? AND deleted = 0");
        $stat->bind_param("i", $tutoria_id);
        $stat->execute();
        $result = $stat->get_result();
        $value = array();
        while($asistut = $result->fetch_object("AsistenciaTutoriaModel")) {
            array_push($value, $asistut);
        }
        return $value;
    }
    
    public static function findById($tutoria_id, $timetable_id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM asistenciatutoria WHERE tutoria_id = ? AND timetable_id = ?");
        $stat->bind_param("ii", $tutoria_id, $timetable_id);
        $stat->execute();
        $result = $stat->get_result();
        if(!$result) return null;
        return $result->fetch_object("AsistenciaTutoriaModel");
    }
}
?>
