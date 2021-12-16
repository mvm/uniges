<?php

include_once 'Connection.php';

class UserRoleModel {
    public $user_id;
    public $role_id;
    
    public function insert() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("INSERT INTO user_role VALUES (?, ?)");
        $stat->bind_param("ii", $this->user_id, $this->role_id);
        return $stat->execute();
    }
    
    public function update() {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("UPDATE user_role SET role_id = ? WHERE user_id = ?");
        $stat->bind_param("ii", $this->role_id, $this->user_id);
        $stat->execute();
        return $stat;
    }
    
    public function findByUserId($user_id) {
        $conn = Connection::getConnection();
        $stat = $conn->prepare("SELECT * FROM user_role WHERE user_id = ?");
        $stat->bind_param("i", $user_id);
        $stat->execute();
        $result = $stat->get_result();
        return $result->fetch_object("UserRoleModel");
    }
}
?>
