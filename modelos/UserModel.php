<?php

include_once "Connection.php";

class UserModel {
	public $id;
    public $dni;
    public $name;
    public $surname;
    public $email;
    public $password;
    public $deleted;

    public $user_role;
    
	static function updatePass($email, $pass) {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("UPDATE user SET password = ? WHERE email = ?");
		$stat->bind_param("ss", password_hash($pass, PASSWORD_DEFAULT),
			$email);
		$stat->execute();
	}

	function insert() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("INSERT INTO user VALUES (?, ?, ?, " .
			"?, ?, ?, ?)");
		$stat->bind_param("isssssi", $this->id, $this->dni, $this->name, $this->surname, $this->email,
			$this->password, $this->deleted);   
		$stat->execute();
	}

	static private function readFromAssoc($user_data) {
		$result_user = new UserModel();
		$result_user->id = $user_data["id"];
		$result_user->dni = $user_data["dni"];
		$result_user->name = $user_data["name"];
		$result_user->surname = $user_data["surname"];
		$result_user->email = $user_data["email"];
		$result_user->password = $user_data["password"];
		$result_user->deleted = $user_data["deleted"];
		return $result_user;
	}

	static function findById($id) {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("SELECT * FROM user WHERE id = ? AND deleted = 0");
		$stat->bind_param("i", $id);
		$stat->execute();
		$result = $stat->get_result();
		if($result == null) return null;
		$user_data = $result->fetch_assoc();
		$result_user = UserModel::readFromAssoc($user_data);
		return $result_user;
	}

	static function findAll() {
		$conn = Connection::getConnection();
		$stat = $conn->prepare("SELECT * FROM user WHERE deleted = 0");
		$stat->execute();

		$result = $stat->get_result();
		if(!$result) return null;
		$return = array();
		while($fila = $result->fetch_assoc()) {
			array_push($return, $fila);
		}
		return $return;
	}

    static function findByEmail($email) {
    	$conn = Connection::getConnection();
	$stat = $conn->prepare("SELECT * FROM user WHERE email = ? AND deleted = 0");
	$stat->bind_param("s", $email);
	$stat->execute();
	$result = $stat->get_result();
	if(!$result) return null;
	$fila = $result->fetch_assoc();
	return $fila;
    }

	function delete() {
		if($this->id == 0) {
			throw new Exception("user id not specified");
		}
		$conn = Connection::getConnection();
		$stat = $conn->prepare("UPDATE user SET deleted = 1 WHERE id= ?");
		$stat->bind_param("i", $this->id);
		$stat->execute();
		return $stat->get_result();
	}

	function update() {
		if($this->id == 0) {
			throw new Exception("user id not specified");
		}
		$conn = Connection::getConnection();
		$stat = $conn->prepare("UPDATE user SET dni = ?, name = ?, surname = ?, email = ? WHERE id = ? AND deleted = 0");
		$stat->bind_param("ssssi", $this->dni,
				$this->name,
				$this->surname,
				$this->email,
				$this->id);
		return $stat->execute();

	}
}
?>
