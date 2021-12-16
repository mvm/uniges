<?php

include_once 'modelos/PdaModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/CollegeModel.php';
include_once 'modelos/CentreModel.php';
include_once 'modelos/DegreeModel.php';

class PdaController {
    const UPLOAD_DIR = "/var/www/html/uploads";
    function list() {
        $pdas = PdaModel::findAll();
        foreach($pdas as &$p) {
            $p->academicyear_obj = AcademicYearModel::findById($p->academicyear_id);
            $p->college_obj = CollegeModel::findById($p->college_id);
            $p->centre_obj = CentreModel::findById($p->centre_id);
            $p->degree_obj = DegreeModel::findById($p->degree_id);
        }
        $GLOBALS["data"] = $pdas;
    }
    
    function add() {
        $ay = AcademicYearModel::findAll();
        $col = CollegeModel::findAll();
        $centre = CentreModel::findAll();
        $degrees = DegreeModel::findAll();
        
        $GLOBALS["data"] = array ("ay" => $ay, "col" => $col, "cen" => $centre, "deg" => $degrees);
    }
    
    function edit() {
        $ay = AcademicYearModel::findAll();
        $col = CollegeModel::findAll();
        $centre = CentreModel::findAll();
        $degrees = DegreeModel::findAll();
        $pda = PdaModel::findById($_GET["id"]);
        
        $GLOBALS["data"] = array ("ay" => $ay, "col" => $col, "cen" => $centre, "deg" => $degrees,
            "pda" => $pda);
    }
    
    function edit_end() {
        $pda = PdaModel::findById($_POST["id"]);
        $pda->title = $_POST["title"];
        $pda->academicyear_id = $_POST["academicyear_id"];
        $pda->college_id = $_POST["college_id"];
        $pda->centre_id = $_POST["centre_id"];
        $pda->degree_id = $_POST["degree_id"];
        
        if(isset($_FILES["file"])) {
            $file = self::UPLOAD_DIR . "/" . basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], $file);
            unlink(self::UPLOAD_DIR . "/" . basename($pda->file));
            $pda->file = basename($_FILES["file"]["name"]);
        }
        
        $stat = $pda->update();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else {
            redirect("/?controller=pda&action=list");
        }
    }
    
    function add_end() {
        $url = self::UPLOAD_DIR . "/" . basename($_FILES["file"]["name"]);
        if(!move_uploaded_file($_FILES["file"]["tmp_name"], $url)) {
            $GLOBALS["errorMessage"] = "Error subiendo archivo.";
            $GLOBALS["viewFileName"] = "vistas/error.php";
            return;
        }
        $pda = new PdaModel();
        $pda->id = 0;
        $pda->title = $_POST["title"];
        $pda->file = basename($_FILES["file"]["name"]);
        $pda->academicyear_id = $_POST["academicyear_id"];
        $pda->college_id = $_POST["college_id"];
        $pda->centre_id = $_POST["centre_id"];
        $pda->degree_id = $_POST["degree_id"];
        $pda->deleted = 0;
        $stat = $pda->insert();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
            return;
        }
        redirect("/?controller=pda&action=list");
    }
    
    function delete() {
        $pda = PdaModel::findById($_POST["id"]);
        $stat = $pda->delete();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
            return;
        }
        unlink(self::UPLOAD_DIR . "/" . basename($pda->file));
        
        redirect("/?controller=pda&action=list");
    }
}

?>
