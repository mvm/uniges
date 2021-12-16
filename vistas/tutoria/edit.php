<h1><?=$strings["tutoria_edit_title"]?></h1>
<?php
	$tutoria = $data["tutoria"];
?>
<form action="/?controller=tutoria&action=edit_end" method="POST">
	<div class="form-group">
		<input type="hidden" name="id" value="<?=$data["tutoria"]->id?>" />
		<label for="academicYear"><?=$strings["tutoria_add_acadYear"]?></label>
		<select id="acadYear" name="acadYear">
<?php
	foreach($data["ay"] as $year) {
?>
	<option value="<?=$year->id?>" <?= $year->id == $tutoria->academicyear_id? "selected" : ""?>><?= $year->name ?></option>
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
	<option value="<?= $p->id ?>" <?= $p->id == $tutoria->professor_id ? "selected" : "" ?>><?= $p->user->email ?></option>
<?php
	}
?>
		</select>
	</div>
	
	<button type="submit" class="btn btn-primary"><?= $strings["tutoria_edit_submit"] ?></button>
</form>

