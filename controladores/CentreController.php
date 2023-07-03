<?php

include_once 'modelos/CentreModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/CollegeModel.php';
include_once 'modelos/ProfessorModel.php';
include_once 'modelos/UserModel.php';

class CentreController {
    function list() {
        $centres = CentreModel::findAll();
        foreach($centres as &$c) {
            $c->academicyear = AcademicYearModel::findById($c->academicyear_id);
            $c->college = CollegeModel::findById($c->college_id);
            $c->overseer_obj = ProfessorModel::findById($c->overseer);
            $c->overseer_obj->user = UserModel::findById($c->overseer_obj->user_id);
        }
        $GLOBALS["data"] = $centres;
    }
    
    function add() {
        $ay = AcademicYearModel::findAll();
        $col = CollegeModel::findAll();
        $prof = ProfessorModel::findAll();
        foreach($prof as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
        
        $GLOBALS["data"] = array ("ay" => $ay, "col" => $col, "prof" => $prof);
    }
    
    function edit() {
        $ay = AcademicYearModel::findAll();
        $col = CollegeModel::findAll();
        $prof = ProfessorModel::findAll();
        foreach($prof as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
        $centre = CentreModel::findById($_GET["id"]);
        $GLOBALS["data"] = array ( "ay" => $ay, "col" => $col, "prof" => $prof, "centre" => $centre);
    }
    
    function edit_end() {
        $centre = new CentreModel();
        $centre->id = $_POST["id"];
        $centre->academicyear_id = $_POST["academicyear_id"];
        $centre->college_id = $_POST["college_id"];
        $centre->overseer = $_POST["overseer"];
        $centre->name = $_POST["name"];
        $centre->city = $_POST["city"];
        $centre->deleted = 0;
    
        $stat = $centre->update();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=centre&action=list");
    }
    
    function add_end() {
        $centre = new CentreModel();
        $centre->id = 0;
        $centre->academicyear_id = $_POST["academicyear_id"];
        $centre->college_id = $_POST["college_id"];
        $centre->overseer = $_POST["overseer"];
        $centre->name = $_POST["name"];
        $centre->city = $_POST["city"];
        $centre->deleted = 0;
        $stat = $centre->insert();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=centre&action=list");
    }
    
    function delete() {
        $centre = new CentreModel();
        $centre->id = $_POST["id"];
        $stat = $centre->delete();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=centre&action=list");
    }
}
?>
