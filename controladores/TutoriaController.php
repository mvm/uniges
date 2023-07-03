<?php

include_once 'modelos/TutoriaModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/ProfessorModel.php';
include_once 'modelos/UserModel.php';
include_once 'modelos/AsistenciaTutoriaModel.php';
include_once 'modelos/TimeTableModel.php';

class TutoriaController {
	function list() {
		$tutorias = TutoriaModel::findAll();
		foreach($tutorias as &$t) {
			$t->academicyear = AcademicYearModel::findById($t->academicyear_id);
			$t->professor = ProfessorModel::findById($t->professor_id);
			$t->professor->user = UserModel::findById($t->professor->user_id);
			$t->asistencias = AsistenciaTutoriaModel::findByTutoria($t->id);
			
			foreach($t->asistencias as &$asist) {
                $asist->timetable = TimeTableModel::findById($asist->timetable_id);
			}
		}
		$GLOBALS["data"] = $tutorias;
	}

	function add() {
		$academicyear = AcademicYearModel::findAll();
		$professors = ProfessorModel::findAll();
		foreach($professors as &$p) {
			$p->user = UserModel::findById($p->user_id);
		}
		$GLOBALS["data"] = array("prof" => $professors, "ay" => $academicyear);
	}

	function add_end(){
		$tutoria = new TutoriaModel();
		$tutoria->id = 0;
		$tutoria->academicyear_id = $_POST["acadYear"];
		$tutoria->professor_id = $_POST["prof"];
		$tutoria->deleted = 0;
		$tutoria->insert();
		redirect("/?controller=tutoria&action=list");
	}

	function delete() {
		$tutoria = new TutoriaModel();
		$tutoria->id = $_REQUEST["id"];
		$return = $tutoria->delete();
		if($return->error != "") {
			$GLOBALS["errorMessage"] = $return->error;
			$GLOBALS["viewFileName"] = "vistas/error.php";	
		} else {
			redirect("/?controller=tutoria&action=list");
		}
	}

	function edit() {
		$tutoria = TutoriaModel::findById($_GET["id"]);
		$acadYear = AcademicYearModel::findAll();
		$professors = ProfessorModel::findAll();
		foreach($professors as &$p) {
			$p->user = UserModel::findById($p->user_id);
		}

		$GLOBALS["data"] = array("ay" => $acadYear, "prof" => $professors, "tutoria" => $tutoria);
	}

	function edit_end() {
		$tutoria = new TutoriaModel();
		$tutoria->id = $_POST["id"];
		$tutoria->academicyear_id = $_POST["acadYear"];
		$tutoria->professor_id = $_POST["prof"];
		$error = $tutoria->update()->error;

		if($error == "") {
			redirect("/?controller=tutoria&action=list");
		} else {
			$GLOBALS["errorMessage"] = $error;
			$GLOBALS["viewFileName"] = "vistas/error.php";
		}
	}
	
	function asistencia() {
        $asistencia = AsistenciaTutoriaModel::findById($_POST["tutoria_id"], $_POST["timetable_id"]);
        if(!$asistencia) {
            $GLOBALS["errorMessage"] = sprintf("Tutoria (%d, %d) no encontrada", $_POST["tutoria_id"], $_POST["timetable_id"]);
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else {
            $asistencia->attendance = $asistencia->attendance == "si" ? "no" : "si";
            $asistencia->update();
            redirect("/?controller=tutoria&action=list");
        }
	}
}

?>
