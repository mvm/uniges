<h1><?=$strings["tutoria_add_title"]?></h1>
<form action="/?controller=tutoria&action=add_end" method="POST">
	<div class="form-group">
		<label for="academicYear"><?=$strings["tutoria_add_acadYear"]?></label>
		<select id="acadYear" name="acadYear">
<?php
	foreach($data["ay"] as $year) {
?>
	<option value="<?=$year->id?>"><?= $year->name ?></option>
<?php			
	}
?>
		</select>
	</div>
	<div class="form-group">
		<label for="prof"><?=$strings["tutoria_add_prof"]?></label>
		<select id="prof" name="prof">
<?php
	foreach($data["prof"] as $p) {
?>
	<option value="<?= $p->id ?>"><?= $p->user->email ?></option>
<?php
	}
?>
		</select>
	</div>
	
	<button type="submit" class="btn btn-primary"><?= $strings["tutoria_add_submit"] ?></button>
</form>

