<?php

include_once 'modelos/GroupModel.php';
include_once 'modelos/AcademicYearModel.php';
include_once 'modelos/SubjectModel.php';
include_once 'modelos/ProfessorModel.php';
include_once 'modelos/UserModel.php';

class GroupController {

    function list() {
        $grupos = GroupModel::findAll();
        foreach($grupos as &$g) {
            $g->academicyear = AcademicYearModel::findById($g->academicyear_id);
            $g->subject = SubjectModel::findById($g->subject_id);
            $g->professor = ProfessorModel::findById($g->professor_id);
            $g->professor->user = UserModel::findById($g->professor->user_id);
        }
        $GLOBALS["data"] = $grupos;
    }
    
    function add() {
        $ay = AcademicYearModel::findAll();
        $subj = SubjectModel::findAll();
        $prof = ProfessorModel::findAll();
        foreach($prof as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
    
        $data = array( "ay" => $ay, "subj" => $subj, "prof" => $prof );
        $GLOBALS["data"] = $data;
    }
    
    function edit() {
        $ay = AcademicYearModel::findAll();
        $subj = SubjectModel::findAll();
        $prof = ProfessorModel::findAll();
        foreach($prof as &$p) {
            $p->user = UserModel::findById($p->user_id);
        }
        $group = GroupModel::findById($_REQUEST["id"]);
        
        $data = array("ay" => $ay, "subj" => $subj, "prof" => $prof, "group" => $group);
        $GLOBALS["data"] = $data;
    }
    
    function edit_end() {
        $group = GroupModel::findById($_POST["id"]);
        $group->academicyear_id = $_POST["academicyear_id"];
        $group->subject_id = $_POST["subject_id"];
        $group->professor_id = $_POST["professor_id"];
        $group->code = $_POST["code"];
        $group->name = $_POST["name"];
        $group->type = $_POST["type"];
        $group->hours = $_POST["hours"];
        
        $stat = $group->update();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else 
            redirect("/?controller=group&action=list");
    }
    
    function add_end() {
        $group = new GroupModel();
        $group->id = 0;
        $group->academicyear_id = $_POST["academicyear_id"];
        $group->subject_id = $_POST["subject_id"];
        $group->professor_id = $_POST["professor_id"];
        $group->code = $_POST["code"];
        $group->name = $_POST["name"];
        $group->type = $_POST["type"];
        $group->hours = $_POST["hours"];
        $group->deleted = 0;
        
        $stat = $group->insert();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else 
            redirect("/?controller=group&action=list");
    }
    
    function delete() {
        $group = new GroupModel();
        $group->id = $_REQUEST["id"];
        $stat = $group->delete();
        if($stat->error) {
            $GLOBALS["errorMessage"] = $stat->error;
            $GLOBALS["viewFileName"] = "vistas/error.php";
        } else
            redirect("/?controller=group&action=list");
    }

}

?>
