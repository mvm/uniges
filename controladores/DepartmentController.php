<?php

include_once 'modelos/DepartmentModel.php';
include_once 'modelos/AcademicYearModel.php';

class DepartmentController {
    function list() {
        $depts = DepartmentModel::findAll();
        foreach($depts as &$d) {
            $d->academicyear = AcademicYearModel::findById($d->academicyear_id);
        }
        $GLOBALS["data"] = $depts;
    }
    
    function add() {
        $years = AcademicYearModel::findAll();
        $GLOBALS["data"] = array ( "ay" => $years );
    }
    
    function add_end() {
        $dept = new DepartmentModel();
        $dept->id = 0;
        $dept->academicyear_id = $_POST["acadYear"];
        $dept->centre_id = 0;
        $dept->code = $_POST["code"];
        $dept->name = $_POST["name"];
        $dept->deleted = 0;
        $dept->insert();
    
        redirect("/?controller=department&action=list");
    }
    
    function delete() {
        $dept = DepartmentModel::findById($_POST["id"]);
        $deptobj = new DepartmentModel();
        $deptobj->id = $dept["id"];
        $deptobj->delete();
        redirect("/?controller=department&action=list");
    }
    
    function edit() {
        $years = AcademicYearModel::findAll();
        $dept = DepartmentModel::findById($_GET["id"]);
        $deptobj = new DepartmentModel();
        $deptobj->id = $dept["id"];
        $deptobj->academicyear_id = $dept["academicyear_id"];
        $deptobj->code = $dept["code"];
        $deptobj->name = $dept["name"];
        $deptobj->deleted = $dept["deleted"];
        
        $GLOBALS["data"] = array( "ay" => $years, "dept" => $deptobj);
    }
    
    function edit_end() {
        $dept = new DepartmentModel();
        $dept->id = $_POST["id"];
        $dept->academicyear_id = $_POST["acadYear"];
        $dept->centre_id = 0;
        $dept->code = $_POST["code"];
        $dept->name = $_POST["name"];
        $dept->update();
        redirect("/?controller=department&action=list");
    }
}

?>
