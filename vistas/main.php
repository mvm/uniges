<?php

if(isset($_SESSION) && isset($_SESSION["id"])) {
	$logged_in = 1;
} else {
	$logged_in = 0;
}

?>
<html>
<head>
<title><?=$strings["app_title"]?></title>
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
</head>

<body class="bg-light">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="/"><?=$strings["app_title"]?></a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarCollapse">
	<?php
	 
	 if($logged_in == 0) {
	 ?>
	<div class="navbar-nav">
	  <a class="nav-link" href="/?controller=user&action=login"><?=$strings["login"]?></a>
	  <a class="nav-link" href="/?controller=user&action=register"><?=$strings["register"]?></a>
	</div>
	<?php } else { ?>

		<div class="navbar-nav">
<?php
		 if(in_array(array("user", "list"), $sessionPermissions)) {
?>
			<a class="nav-link" href="/?controller=user&action=list"><?=$strings["navbar_user"]?></a>
<?php } ?>

<?php if(in_array(array("professor", "list"), $sessionPermissions)) { ?>
			<a class="nav-link" href="/?controller=professor&action=list"><?=$strings["navbar_professor"]?></a>
<?php } ?>			

<?php if(has_permission("tutoria", "list")) { ?>
	<a class="nav-link" href="/?controller=tutoria&action=list"><?= $strings["navbar_tutoria"] ?></a>
<?php } ?>

<?php if(has_permission("department", "list")) { ?>
    <a class="nav-link" href="/?controller=department&action=list"><?= $strings["navbar_department"] ?></a>
<?php } ?>

<?php if(has_permission("subject", "list")) { ?>
    <a class="nav-link" href="/?controller=subject&action=list"><?= $strings["navbar_subject"] ?></a>
<?php } ?>

<?php if(has_permission("space", "list")) { ?>
    <a class="nav-link" href="/?controller=space&action=list"><?= $strings["navbar_space"] ?></a>
<?php } ?>

<?php if(has_permission("building", "list")) { ?>
    <a class="nav-link" href="/?controller=building&action=list"><?= $strings["navbar_building"] ?></a>
<?php } ?>

<?php if(has_permission("group", "list")) { ?>
    <a class="nav-link" href="/?controller=group&action=list"><?= $strings["navbar_group"] ?></a>
<?php } ?>

<?php if(has_permission("college", "list")) { ?>
    <a class="nav-link" href="/?controller=college&action=list"><?= $strings["navbar_college"] ?></a>
<?php } ?>

<?php if(has_permission("centre", "list")) { ?>
    <a class="nav-link" href="/?controller=centre&action=list"><?= $strings["navbar_centre"] ?></a>
<?php } ?>

<?php if(has_permission("degree", "list")) { ?>
    <a class="nav-link" href="/?controller=degree&action=list"><?= $strings["navbar_degree"] ?></a>
<?php } ?>

<?php if(has_permission("pda", "list")) { ?>
    <a class="nav-link" href="/?controller=pda&action=list"><?= $strings["navbar_pda"] ?></a>
<?php } ?>

			<a class="nav-link"
			   href="/?controller=user&action=logout"><?=$strings["logout"]?></a>
		</div>
	<?php } ?>
      </div>
	
    </div>
  </nav>

  <?php # Contenido principal
   ?>

  <div class="container-md">
<?php
if(isset($viewFileName) && file_exists($viewFileName)) {
	include_once $viewFileName;
} else {
	$errorMessage = sprintf("Vista de controlador '%s' y accion '%s' no encontrada.",
		htmlspecialchars($controller),
		htmlspecialchars($action));
	include_once "vistas/error.php";
}
?>
  </div>
  
  <nav class="navbar fixed-bottom navbar-dark bg-primary">
    <div class="container-fluid">
      <p class="navbar-text text-center">Uniges - Miguel Vicente</p>
    </div>
  </nav>
  
</body>

</html>
