<?php

session_start();
$do_output = true;

# Set language variables

if(!isset($_SESSION["language"])) {
    $_SESSION["language"] = "es";
}

if(preg_match("/^[a-zA-Z]+$/", $_SESSION["language"])) {
    $_language = $_SESSION["language"];
} else {
    $_language = "es";
}

if(file_exists("idiomas/{$_language}.php")) {
    include_once "idiomas/{$_language}.php";
} else {
    include_once 'idiomas/es.php';
}

include_once 'Connection.php';

function show_error($msg) {
    $GLOBALS["errorMessage"] = $msg;
    $GLOBALS["viewFileName"] = "vistas/error.php";
}

function get_permissions($user_id) {
	$conn = Connection::getConnection();
	$stat = $conn->prepare("select feature.name as feature_name, action.name as action_name from user join user_role on user.id = user_role.user_id join role_permission on role_permission.role_id = user_role.role_id join feature on role_permission.feature_id = feature.id join action on action.id = role_permission.action_id where user.id = ?");
	$stat->bind_param("i", $user_id);
	$stat->execute();
	$result = $stat->get_result();
	$permissions = array();
	while($fila = $result->fetch_assoc()) {
		array_push($permissions, array ($fila["feature_name"], $fila["action_name"]));
	}
	return $permissions;
}

function has_permission($controller, $action) {
	if(!isset($GLOBALS["sessionPermissions"])) {
		return false;
	}
	return in_array(array($controller, $action), $GLOBALS["sessionPermissions"]);
}

if(isset($_SESSION["id"])) {
    $sessionPermissions = get_permissions($_SESSION["id"]);
    $_SESSION["permissions"] = $sessionPermissions;
} else {
	$sessionPermissions = array(array("user", "login"), array("user", "register"),
		array("user", "register_end"), array("user", "login_end"), array("user", "logout"));
}

function redirect($url) {
	header("Location: " . $url, true, 303);
	$GLOBALS["do_output"] = false;

}

$controller = "user"; $action = "list";
if(!isset($_SESSION["id"])) $action = "login";

if(array_key_exists("controller", $_GET)) {
	if(preg_match("/^[a-zA-Z_]+$/", $_GET["controller"])) {
		$controller = $_GET["controller"];
	} else {
		$errorMessage = sprintf("Controlador '%s' tiene formato incorrecto.",
			htmlspecialchars($_GET["controller"]));
		$viewFileName = "vistas/error.php";
	}
}

if(array_key_exists("action", $_GET)) {
    if(preg_match("/^[a-zA-Z_]+$/", $_GET["action"])) {
        $action = $_GET["action"];
    } else {
	    $errorMessage = sprintf("Accion '%s' tiene formato incorrecto.",
	    	htmlspecialchars($_GET["action"]));
	    $viewFileName = "vistas/error.php";
    }
}

if(isset($controller)) {
	$fileController = ucfirst($controller);
	if(file_exists("controladores/{$fileController}Controller.php")) {
		include_once "controladores/{$fileController}Controller.php";
		$contClass = "{$fileController}Controller";

		if(!class_exists($contClass)) {
			$errorMessage = sprintf("Class '%s' does not exist.",
				htmlspecialchars($contClass));
			$viewFileName = "vistas/error.php";
			goto end;
		}

		$contObj = new $contClass();
		if(method_exists($contObj, $action)) {

			if(in_array(array($controller, $action), $sessionPermissions)) {
				$GLOBALS["viewFileName"] = "vistas/{$controller}/{$action}.php";	
				$contObj->$action();
			} else {
				$errorMessage = "Action not allowed.";
				$GLOBALS["viewFileName"] = "vistas/error.php";
			}
		} else {
			$errorMessage = sprintf("Controlador '%s' no tiene método '%s'.",
				htmlspecialchars($controller),
				htmlspecialchars($action));
			$viewFileName = "vistas/error.php";
			goto end;
		}
	} else {
		$errorMessage = sprintf("Controlador '%s' no existe.",
			htmlspecialchars($controller));
		$viewFileName = "vistas/error.php";
	}
}

end:
if($do_output)
	include "vistas/main.php";

?>
