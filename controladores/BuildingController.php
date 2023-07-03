<?php

include_once 'modelos/BuildingModel.php';
include_once 'modelos/AcademicYearModel.php';

class BuildingController {
    function list() {
        $buildings = BuildingModel::findAll();
        foreach($buildings as &$b) {
            $b->academicyear = AcademicYearModel::findById($b->academicyear_id);
        }
        $GLOBALS["data"] = array ("builds" => $buildings);
    }
    
    function add() {
        $ay = AcademicYearModel::findAll();
        $GLOBALS["data"] = array ( "ay" => $ay );
    }
    
    function add_end() {
        $build = new BuildingModel();
        $build->id = 0;
        $build->academicyear_id = $_POST["academicyear_id"];
        $build->college_id = 1;
        $build->name = $_POST["name"];
        $build->location = $_POST["location"];
        $build->deleted = 0;
        
        $stat = $build->insert();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else {
            redirect("/?controller=building&action=list");
        }
    }
    
    function edit() {
        $ay = AcademicYearModel::findAll();
        $building = BuildingModel::findById($_REQUEST["id"]);
        
        $GLOBALS["data"] = array ("ay" => $ay, "build" => $building);
    }
    
    function edit_end() {
        $build = new BuildingModel();
        $build->id = $_POST["id"];
        $build->college_id = 1;
        $build->academicyear_id = $_POST["academicyear_id"];
        $build->name = $_POST["name"];
        $build->location = $_POST["location"];
        $stat = $build->update();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else 
            redirect("/?controller=building&action=list");
    }
    
    function delete() {
        $build = new BuildingModel();
        $build->id = $_REQUEST["id"];
        $stat = $build->delete();
        
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else {
            redirect("/?controller=building&action=list");
        }
    }
}

?>
