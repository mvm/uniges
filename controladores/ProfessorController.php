<?php

include_once 'modelos/ProfessorModel.php';
include_once 'modelos/DepartmentModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/UserModel.php';

class ProfessorController {
	function list() {
		$professors = ProfessorModel::findAll();
		foreach($professors as &$prof) {
			$user = UserModel::findById($prof->user_id);
			$dept = DepartmentModel::findById($prof->department_id);
			$prof->user = $user;
			$prof->department = $dept;
		}
		$GLOBALS['data'] = $professors;
	}

	function delete() {
		$prof = ProfessorModel::findById($_POST["id"]);
		$prof->delete();
		redirect("/?controller=professor&action=list");	
	}

	function edit() {
		$prof = ProfessorModel::findById($_GET["id"]);
		if($prof == null) {
			$GLOBALS["errorMessage"] = "Professor id={$_GET["id"]} not found.";
			$GLOBALS["viewFileName"] = "vistas/error.php";
			return;
		}
		$acadYear = AcademicYearModel::findAll();
		$depts = DepartmentModel::findAll();
		$users = UserModel::findAll();

		$GLOBALS["data"] = array( "acadYear" => $acadYear,
			"depts" => $depts,
			"users" => $users,
			"prof" => $prof);
	}

	function edit_end() {
		$prof = new ProfessorModel();
		$prof->id = $_POST["id"];
		$prof->academicyear_id = $_POST["acadYear"];
		$prof->department_id = $_POST["dept"];
		$prof->dedication = $_POST["dedication"];
		$prof->user_id = $_POST["userField"];
		$prof->update();
		redirect("/?controller=professor&action=list");
	}

	function add() {
		$acadYear = AcademicYearModel::findAll();
		$depts = DepartmentModel::findAll();
		$users = UserModel::findAll();

		$GLOBALS["data"] = array ( "acadYear" => $acadYear,
			"depts" => $depts,
			"users" => $users );
	}

	function add_end() {
		$prof = new ProfessorModel();
		$prof->id = 0;
		$prof->academicyear_id = $_POST["acadYear"];
		$prof->department_id = $_POST["dept"];
		$prof->dedication = $_POST["dedication"];
		$prof->user_id = $_POST["userField"];
		$prof->deleted = 0;
		$prof->insert();
		redirect("/?controller=professor&action=list");
	}
}

?>
