<?php

include_once 'Connection.php';

class TimeTableModel {
    public $id;
    public $academicyear_id;
    public $space_id;
    public $group_id;
    public $date;
    public $hourbegin;
    public $hourend;
    public $day;
    public $deleted;
    
    public static function findById($timetable_id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM timetable WHERE id = ?");
        $stat->bind_param("i", $timetable_id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("TimeTableModel");
    }
}
?>
