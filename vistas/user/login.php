<h1><?=$strings["login_title"]?></h1>
<form action="/?controller=user&action=login_end" method="POST">
	<div class="form-group">
		<label for="email"><?=$strings["login_email"]?></label>
		<input type="email" name="email" class="form-control" id="email"
			placeholder="<?= $strings["login_email_ph"] ?>" />
	</div>
	<div class="form-group">
		<label for="passField"><?=$strings["login_pass"] ?></label>
		<input type="password" name="pass" class="form-control" id="passField"
			placeholder="<?= $strings["login_pass_ph"] ?>" />
	</div>
	<button type="submit" class="btn btn-primary"><?= $strings["login_submit"] ?></button>
</form>

