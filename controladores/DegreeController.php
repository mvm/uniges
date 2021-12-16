<?php

include_once 'modelos/DegreeModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/ProfessorModel.php';
include_once 'modelos/UserModel.php';
include_once 'modelos/CentreModel.php';

class DegreeController {
    function list() {
        $degrees = DegreeModel::findAll();
        foreach($degrees as &$d) {
            $d->academicyear = AcademicYearModel::findById($d->academicyear_id);
            $d->supervisor_obj = ProfessorModel::findById($d->supervisor);
            $d->supervisor_obj->user = UserModel::findById($d->supervisor_obj->user_id);
        }
        $GLOBALS["data"] = $degrees;
    }
    
    function add() {
        $ay = AcademicYearModel::findAll();
        $centre = CentreModel::findAll();
        $prof = ProfessorModel::findAll();
        foreach($prof as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
        $GLOBALS["data"] = array ( "ay" => $ay, "centre" => $centre, "prof" => $prof );
    }
    
    function edit() {
        $ay = AcademicYearModel::findAll();
        $centre = CentreModel::findAll();
        $prof = ProfessorModel::findAll();
        foreach($prof as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
        $degree = DegreeModel::findById($_REQUEST["id"]);
        $GLOBALS["data"] = array ( "ay" => $ay, "centre" => $centre, "prof" => $prof, "degree" => $degree );
    }
    
    function edit_end() {
        $degree = new DegreeModel();
        $degree->id = $_POST["id"];
        $degree->academicyear_id = $_POST["academicyear_id"];
        $degree->centre_id = $_POST["centre_id"];
        $degree->code = $_POST["code"];
        $degree->name = $_POST["name"];
        $degree->supervisor = $_POST["supervisor"];
        $degree->deleted = 0;
        
        $stat = $degree->update();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=degree&action=list");
    }
    
    function add_end() {
        $degree = new DegreeModel();
        $degree->id = 0;
        $degree->academicyear_id = $_POST["academicyear_id"];
        $degree->centre_id = $_POST["centre_id"];
        $degree->supervisor = $_POST["supervisor"];
        $degree->code = $_POST["code"];
        $degree->name = $_POST["name"];
        $degree->deleted = 0;
        $stat = $degree->insert();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=degree&action=list");
    }
    
    function delete() {
        $degree = new DegreeModel();
        $degree->id = $_POST["id"];
        $stat = $degree->delete();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=degree&action=list");
    }
}

?>
