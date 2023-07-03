<?php
include_once 'Connection.php';

class TutoriaModel {
	public $id;
	public $academicyear_id;
	public $professor_id;
	public $deleted;

	public $academicyear;
	public $professor;
	public $asistencias;

	public function insert() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("INSERT INTO tutoria VALUES (?, ?, ?, ?)");
		$stat->bind_param("iiii", $this->id, $this->academicyear_id,
			$this->professor_id, $this->deleted);
		$stat->execute();
		return $conn->error;
	}

	public function delete() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("UPDATE tutoria SET deleted = 1 WHERE id = ?");
		$stat->bind_param("i", $this->id);
		return $stat->execute(); 
	}

	public function update() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("UPDATE tutoria SET academicyear_id = ?, professor_id = ? WHERE id = ?");
		$stat->bind_param("iii", $this->academicyear_id, $this->professor_id,
			$this->id);
		return $stat->execute();
	}

	static function findById($id) {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("SELECT * FROM tutoria WHERE id = ?");
		$stat->bind_param("i", $id);
		$stat->execute();
		$result = $stat->get_result();
		return $result->fetch_object("TutoriaModel");
	}

	static function findAll() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("SELECT * FROM tutoria WHERE deleted = 0");
		$stat->execute();
		$result = $stat->get_result();

		$return = array();
		while($fila = $result->fetch_object("TutoriaModel")) {
			array_push($return, $fila);
		}
		return $return;
	}
}
?>
