<h1><?=$strings["user_add_title"]?></h1>
<form action="/?controller=user&action=add_end" method="POST">
	<div class="form-group">
		<label for="email"><?=$strings["login_email"]?></label>
		<input type="email" name="email" class="form-control" id="email"
			placeholder="<?= $strings["login_email_ph"] ?>"
			/>
	</div>
	<div class="form-group">
		<label for="dniField"><?= $strings["register_dni"] ?></label>
		<input type="text" name="dni" class="form-control" id="dniField"
			placeholder="<?= $strings["register_dni_ph"] ?>"
			 />
	</div>
	<div class="form-group">
		<label for="nameField"><?=$strings["register_name"] ?></label>
		<input type="text" name="name" class="form-control" id="nameField"
			placeholder="<?= $strings["register_name_ph"] ?>"
			 />
	</div>
	<div class="form-group">
	<label for="surnameField"><?=$strings["register_surname"]?></label>
	<input type="text" name="surname" class="form-control" id="surnameField"
		placeholder="<?= $strings["register_surname_ph"] ?>"
		 />
	</div>

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
	<button type="submit" class="btn btn-primary"><?= $strings["user_add_submit"] ?></button>
</form>

