<?php

include_once 'Connection.php';

class AcademicYearModel {
	public $id;
	public $name;
	public $deleted;

	private static function readFromAssoc($fila) {
		$ret = new AcademicYearModel();
		$ret->id = $fila["id"];
		$ret->name = $fila["name"];
		$ret->deleted = $fila["deleted"];
		return $ret;
	}

	public static function findAll() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("SELECT * FROM academicyear WHERE deleted = 0");
		$stat->execute();

		$result = $stat->get_result();
		$ret = array();
		while($fila = $result->fetch_assoc()) {
			array_push($ret, AcademicYearModel::readFromAssoc($fila));
		}
		return $ret;
	}

	public static function findById($id) {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("SELECT * FROM academicyear WHERE id = ? AND deleted = 0");
		$stat->bind_param("i", $id);
		$stat->execute();
		$result = $stat->get_result();
		if(!$result) return null;
		return $result->fetch_object("AcademicYearModel");
	}
}
?>
