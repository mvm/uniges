<?php
    include_once 'modelos/SpaceModel.php';
    include_once 'modelos/AcademicYearModel.php';
    
    class SpaceController {
        function list() {
            $spaces = SpaceModel::findAll();
            foreach($spaces as &$s) {
                $s->academicyear = AcademicYearModel::findById($s->academicyear_id);
            }
            $GLOBALS["data"] = $spaces;
        }
        
        function add() {
            $ay = AcademicYearModel::findAll();
            
            $GLOBALS["data"] = array( "ay" => $ay );
        }
        
        function add_end() {
            $space = new SpaceModel();
            $space->id = 0;
            $space->academicyear_id = $_POST["academicyear_id"];
            $space->building_id = 0;
            $space->name = $_POST["name"];
            $space->type = $_POST["type"];
            $space->deleted = 0;
            $stat = $space->insert();
        
            if(!$stat->error) {
                redirect("/?controller=space&action=list");
            } else {
                $GLOBALS["errorMessage"] = $stat->error;
                $GLOBALS["viewFileName"] = "vistas/error.php";
            }
        }
        
        function delete() {
            $space = SpaceModel::findById($_POST["id"]);
            $stat = $space->delete();
            if(!$stat->error) {
                redirect("/?controller=space&action=list");
            } else {
                $GLOBALS["errorMessage"] = $stat->error;
                $GLOBALS["viewFileName"] = "vistas/error.php";
            }
        }
        
        function edit() {
            $space = SpaceModel::findById($_GET["id"]);
            $ay = AcademicYearModel::findAll();
            $GLOBALS["data"] = array( "ay" => $ay, "space" => $space );
        }
        
        function edit_end() {
            $space = SpaceModel::findById($_POST["id"]);
            $space->academicyear_id = $_POST["academicyear_id"];
            $space->name = $_POST["name"];
            $space->type = $_POST["type"];
            $stat = $space->update();
        
            if($stat->error) {
                $GLOBALS["errorMessage"] = $stat->error;
                $GLOBALS["viewFileName"] = "vistas/error.php";
            } else {
                redirect("/?controller=space&action=list");
            }
        }
    }
?>
