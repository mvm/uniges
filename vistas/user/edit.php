<h1><?=$strings["user_edit_title"]?></h1>
<form action="/?controller=user&action=edit_end" method="POST">
	<input type="hidden" name="id" value="<?=$data->id?>"></input>
	<div class="form-group">
		<label for="email"><?=$strings["login_email"]?></label>
		<input type="email" name="email" class="form-control" id="email"
			placeholder="<?= $strings["login_email_ph"] ?>"
			value="<?=$data->email?>" />
	</div>
	<div class="form-group">
		<label for="dniField"><?= $strings["register_dni"] ?></label>
		<input type="text" name="dni" class="form-control" id="dniField"
			placeholder="<?= $strings["register_dni_ph"] ?>"
			value="<?= $data->dni ?>" />
	</div>
	<div class="form-group">
		<label for="nameField"><?=$strings["register_name"] ?></label>
		<input type="text" name="name" class="form-control" id="nameField"
			placeholder="<?= $strings["register_name_ph"] ?>"
			value="<?=$data->name?>" />
	</div>
	<div class="form-group">
	<label for="surnameField"><?=$strings["register_surname"]?></label>
	<input type="text" name="surname" class="form-control" id="surnameField"
		placeholder="<?= $strings["register_surname_ph"] ?>"
		value="<?=$data->surname?>" />
	</div>

<!--
	<div class="form-group">
		<label for="passField"><?=$strings["login_pass"] ?></label>
		<input type="password" name="pass" class="form-control" id="passField"
			placeholder="<?= $strings["login_pass_ph"] ?>" />
	</div>
	<div class="form-group">
		<label for="pass2Field"><?=$strings["register_pass2"]?></label>
		<input type="password" name="pass2" class="form-control" id="pass2Field"
			placeholder="<?= $strings["login_pass_ph"] ?>" />
	</div>
-->

    <div class="form-group">
        <label for="roleField">Tipo de usuario:</label>
        <select id="roleField" name="user_role">
        
<?php
    foreach($roles as $role) {
?>
    <option value="<?=$role->id?>" <?= $data->user_role->role_id == $role->id ? "selected" : "" ?>> <?=$role->name?></option>
<?php
    }
?>

        </select>
    </div>
	<button type="submit" class="btn btn-primary"><?= $strings["user_edit_submit"] ?></button>
</form>

