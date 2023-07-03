<?php

include_once 'modelos/SubjectModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/DepartmentModel.php';
include_once 'modelos/ProfessorModel.php';
include_once 'modelos/UserModel.php';

class SubjectController {
    function list() {
        $asigs = SubjectModel::findAll();
        $GLOBALS["data"] = array("asigs" => $asigs);
    }
    
    function add() {
        $acadYear = AcademicYearModel::findAll();
        $depts = DepartmentModel::findAll();
        $profs = ProfessorModel::findAll();
        
        foreach($profs as $p) {
            $p->user = UserModel::findById($p->user_id);
        }
        
        $GLOBALS["data"] = array("acadYear" => $acadYear, "depts" => $depts, "profs" => $profs);
    }
    
    function add_end() {
        $subject = new SubjectModel();
        $subject->id = 0;
        $subject->academicyear_id = $_POST["academicyear_id"];
        $subject->department_id = $_POST["department_id"];
        $subject->degree_id = 0;
        $subject->professor_id = $_POST["professor_id"];
        $subject->code = $_POST["code"];
        $subject->name = $_POST["name"];
        $subject->content = $_POST["content"];
        $subject->credits = $_POST["credits"];
        $subject->type = $_POST["type"];
        $subject->hours = $_POST["hours"];
        $subject->semester = $_POST["semester"];
        $subject->deleted = 0;
        $stat = $subject->insert();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=subject&action=list");
    }
    
    function delete() {
        $subj = new SubjectModel();
        $subj->id = $_POST["id"];
        $stat = $subj->delete();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=subject&action=list");
    }
    
    function edit() {
        $subj = SubjectModel::findById($_GET["id"]);
        $acadYear = AcademicYearModel::findAll();
        $depts = DepartmentModel::findAll();
        $profs = ProfessorModel::findAll();
        
        foreach($profs as $p) {
            $p->user = UserModel::findById($p->user_id);
        }
        
        $GLOBALS["data"] = array("acadYear" => $acadYear, "depts" => $depts, "profs" => $profs,
            "subj" => $subj);
    }
    
    function edit_end() {
        $subj = new SubjectModel();
        $subj->id = $_POST["id"];
        $subj->academicyear_id = $_POST["academicyear_id"];
        $subj->degree_id = 0;
        $subj->department_id = $_POST["department_id"];
        $subj->professor_id = $_POST["professor_id"];
        $subj->code = $_POST["code"];
        $subj->name = $_POST["name"];
        $subj->content = $_POST["content"];
        $subj->credits = $_POST["credits"];
        $subj->type = $_POST["type"];
        $subj->hours = $_POST["hours"];
        $subj->semester = $_POST["semester"];
        $res = $subj->update();
        if($res->error) {
            $GLOBALS["errorMessage"] = $res->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=subject&action=list");
    }
}
?>
