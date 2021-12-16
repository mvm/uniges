<?php

include_once 'Connection.php';

class ProfessorModel {
	public $id;
	public $academicyear_id;
	public $department_id;
	public $dedication;
	public $deleted;
	public $user_id;

	public $user;
	public $department;

	private static function readFromAssoc($fila) {
	    	$res = new ProfessorModel();
		$res->id = $fila["id"];
		$res->academicyear_id = $fila["academicyear_id"];
		$res->department_id = $fila["department_id"];
		$res->dedication = $fila["dedication"];
		$res->deleted = $fila["deleted"];
		$res->user_id = $fila["user_id"];
		return $res;
	}

	public function delete() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("UPDATE professor SET deleted = 1 WHERE id = ?");
		$stat->bind_param("i", $this->id);
		$stat->execute();
		return $stat->get_result();
	}

	public function insert() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("INSERT INTO professor VALUES (?, ?, ?, ?, ?, ?)");
		$stat->bind_param("iiisii", $this->id, $this->academicyear_id,
			$this->department_id, $this->dedication, $this->user_id,
			$this->deleted);
		$stat->execute();
		echo $stat->error;
		return $stat->get_result();
	}

	public function update() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("UPDATE professor SET academicyear_id = ?, department_id = ?, dedication = ?, user_id = ? WHERE id = ?");
		$stat->bind_param("iisii", $this->academicyear_id, $this->department_id,
			$this->dedication, $this->user_id, $this->id);
		$stat->execute();
		return $stat->get_result();
	}

    public static function findAll() {
	    $conn = Connection::getConnection();
	    $stat = $conn->prepare("SELECT * FROM professor WHERE professor.deleted = 0");
	    $stat->execute();

	    $result = $stat->get_result();
	    if(!$result) return null;
	    $return = array();
	    while($fila = $result->fetch_assoc()) {
	    	array_push($return, ProfessorModel::readFromAssoc($fila));
	    }
	    return $return;
    }

    public static function findById($id) {
	$conn = Connection::getConnection();
	$stat = $conn->prepare("SELECT * FROM professor WHERE id = ? AND deleted = 0");
	$stat->bind_param("i", $id);
	$stat->execute();
	$result = $stat->get_result();
	if(!$result) return null;
    	$fila = $result->fetch_assoc();
	$return = ProfessorModel::readFromAssoc($fila);
	return $return;	
    }
}
?>
