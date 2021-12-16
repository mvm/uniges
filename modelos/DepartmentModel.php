<?php

include_once 'Connection.php';

class DepartmentModel {
    public $id;
    public $academicyear_id;
    public $centre_id;
    public $code;
    public $name;
    public $deleted;
    
    public $academicyear;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO department VALUES (?,?,?,?,?,?)");
        $stat->bind_param("iiissi", $this->id, $this->academicyear_id,
            $this->centre_id, $this->code, $this->name, $this->deleted);
        return $stat->execute();
    }
    
    public function delete() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE department SET deleted = 1 WHERE id = ?");
        $stat->bind_param("i", $this->id);
        return $stat->execute();
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE department SET academicyear_id = ?, centre_id = ?, code = ?, name = ? WHERE id = ?");
        $stat->bind_param("iissi", $this->academicyear_id, $this->centre_id,
            $this->code, $this->name, $this->id);
        return $stat->execute();
    }  

    public static function findById($dept_id) {
	    $conn = Connection::getConnection();
	    $stat = $conn->prepare("SELECT * FROM department WHERE id = ? AND deleted = 0");
	    $stat->bind_param("i", $dept_id);
	    $stat->execute();
	    $result = $stat->get_result();
	    if(!$result) { return null; }
	    $fila = $result->fetch_assoc();
	    return $fila;
    }

	private static function readFromAssoc($fila) {
		$ret = new DepartmentModel();
		$ret->id = $fila["id"];
		$ret->academicyear_id = $fila["academicyear_id"];
		$ret->centre_id = $fila["centre_id"];
		$ret->code = $fila["code"];
		$ret->name = $fila["name"];
		$ret->deleted = $fila["deleted"];
		return $ret;
	}

	public static function findAll() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("SELECT * FROM department WHERE deleted = 0");
		$stat->execute();
		$result = $stat->get_result();
		if(!$result) return null;
		$ret = array();
		while($fila = $result->fetch_assoc()) {
			array_push($ret, DepartmentModel::readFromAssoc($fila));
		}
		return $ret;
	}
}

?>
