<?php

include_once "modelos/UserModel.php";
include_once "modelos/UserRoleModel.php";
include_once "modelos/RoleModel.php";

class UserController {

	function register() {
	}

	function register_end() {
		$is_user_registered = UserModel::findByEmail($_POST["email"]);
		if($is_user_registered != null) {
			$GLOBALS["errorMessage"] = sprintf("User %s already registered.", $_POST["email"]);
			$GLOBALS["viewFileName"] = "vistas/error.php";
			return;
		}

		$user = new UserModel();
		$user->id = 0;
		$user->email = $_POST["email"];
		$user->dni = $_POST["dni"];
		$user->name = $_POST["name"];
		$user->surname = $_POST["surname"];

		if($_POST["pass"] == $_POST["pass2"]) {
			$user->password = password_hash($_POST["pass"], PASSWORD_DEFAULT);
		} else {
			$GLOBALS["errorMessage"] = "Las contraseñas introducidas no son iguales.";
			$GLOBALS["viewFileName"] = "vistas/error.php";
			return;
		}

		$user->deleted = 0;

		$user->insert();
		
		$user = UserModel::findByEmail($_POST["email"]);
		$user_role = new UserRoleModel();
		$user_role->user_id = $user["id"];
		$user_role->role_id = 2;
		$stat = $user_role->insert();
		
		redirect("/?controller=user&action=login");
	}

	function login() {
		$GLOBALS["viewFileName"] = "vistas/user/login.php";
	}

	function login_end() {
		$fila = UserModel::findByEmail($_POST["email"]);
		if($fila["password"] == "" || password_verify($_POST["pass"], $fila["password"])) {
			$_SESSION["id"] = $fila["id"];
			$_SESSION["email"] = $fila["email"];

			if($fila["password"] == "") {
				UserModel::updatePass($_POST["email"], $_POST["pass"]);
			}

			redirect("/?controller=user&action=list");
		} else {
			$GLOBALS["errorMessage"] = $strings["login_failed"];
			$GLOBALS["viewFileName"] = "vistas/error.php";
		}
	}

	function logout() {
		session_destroy();	
		redirect("/");
	}

	function list() {
		$usuarios = UserModel::findAll();
		$GLOBALS["data"] = $usuarios;
	}

	function delete() {
		$user = UserModel::findById($_POST["id"]);
		if($user != null) {
			$user->delete();
			redirect("/?controller=user&action=list");
		} else {
			$GLOBALS["errorMessage"] = "User id={$user->id} not found.";
			$GLOBALS["viewFileName"] = "vistas/error.php";
		}	
	}

	function edit() {
		$user = UserModel::findById($_GET["id"]);
		$user->user_role = UserRoleModel::findByUserId($_GET["id"]);
		$roles = RoleModel::findAll();

		if($user == null) {
			$GLOBALS["errorMessage"] = "User id={$user->id} not found.";
			$GLOBALS["viewFileName"] = "vistas/error.php";
			return;
		}
		$GLOBALS["data"] = $user;
		$GLOBALS["roles"] = $roles;
	}

	function edit_end() {
		$user = UserModel::findById($_POST["id"]);

		if($user == null) {
			$GLOBALS["errorMessage"] = "User id={$_POST['id']} not found";
			$GLOBALS["viewFileName"] = "vistas/error.php";
			return;
		}

		$user->email = $_POST["email"];
		$user->name = $_POST["name"];
		$user->surname = $_POST["surname"];
		$user->dni = $_POST["dni"];
		$user->update();
		
		$user_role = new UserRoleModel();
		$user_role->user_id = $_POST["id"];
		$user_role->role_id = $_POST["user_role"];
		$user_role->update();
		redirect("/?controller=user&action=list");
	}

	function add() {
	}

	function add_end() {
		if($_POST["pass"] != $_POST["pass2"]) {
			$GLOBALS["errorMessage"] = "Passwords no coinciden.";
			$GLOBALS["viewFileName"] = "vistas/error.php";
			return;
		}
		$user = new UserModel();
		$user->id = 0;
		$user->dni = $_POST["dni"];
		$user->name = $_POST["name"];
		$user->surname = $_POST["surname"];
		$user->email = $_POST["email"];
		$user->password = password_hash($_POST["pass"], PASSWORD_DEFAULT);
		$user->deleted = 0;

		$user->insert();
		redirect("/?controller=user&action=list");
	}
}

?>
