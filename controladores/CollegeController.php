<?php

include_once 'modelos/CollegeModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/ProfessorModel.php';
include_once 'modelos/UserModel.php';

class CollegeController {
    function list() {
        $colleges = CollegeModel::findAll();
        foreach($colleges as &$c) {
            $c->academicyear = AcademicYearModel::findById($c->academicyear_id);
            $c->supervisor_obj = ProfessorModel::findById($c->supervisor);
            $c->supervisor_obj->user = UserModel::findById($c->supervisor_obj->user_id);
        }
        
        $GLOBALS["data"] = $colleges;
    }
    
    function add() {
        $ay = AcademicYearModel::findAll();
        $profs = ProfessorModel::findAll();
        foreach($profs as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
        $GLOBALS["data"] = array ( "ay" => $ay , "profs" => $profs);
    }
    
    function edit() {
        $ay = AcademicYearModel::findAll();
        $profs = ProfessorModel::findAll();
        foreach($profs as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
        $col = CollegeModel::findById($_GET["id"]);
        $GLOBALS["data"] = array ("ay" => $ay, "profs" => $profs, "col" => $col);
    }
    
    function edit_end() {
        $col = new CollegeModel();
        $col->id = $_POST["id"];
        $col->academicyear_id = $_POST["academicyear_id"];
        $col->name = $_POST["name"];
        $col->city = $_POST["city"];
        $col->supervisor = $_POST["supervisor_id"];
        $col->deleted = 0;
        $stat = $col->update();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else 
            redirect("/?controller=college&action=list");
    }
    
    function add_end() {
        $college = new CollegeModel();
        $college->id = 0;
        $college->academicyear_id = $_POST["academicyear_id"];
        $college->name = $_POST["name"];
        $college->city = $_POST["city"];
        $college->supervisor = $_POST["supervisor_id"];
        $college->deleted = 0;
        
        $stat = $college->insert();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else 
            redirect("/?controller=college&action=list");
    }
    
    function delete() {
        $college = CollegeModel::findById($_POST["id"]);
        $stat = $college->delete();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=college&action=list");
    }
}

?>
