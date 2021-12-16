<h1><?=$strings["professor_add_title"]?></h1>
<form action="/?controller=professor&action=add_end" method="POST">
	<div class="form-group">
		<label for="academicYear"><?=$strings["prof_add_acadYear"]?></label>
		<select id="acadYear" name="acadYear">
<?php
	foreach($data["acadYear"] as $year) {
?>
	<option value="<?=$year->id?>"><?= $year->name ?></option>
<?php			
	}
?>
		</select>
	</div>
	<div class="form-group">
		<label for="deptField"><?= $strings["prof_add_dept"] ?></label>
		<select id="dept" name="dept">
<?php
	foreach($data["depts"] as $dept) {
?>
	<option value="<?=$dept->id?>"><?= $dept->name ?></option>
<?php
	}
?>
		</select>
	</div>
	<div class="form-group">
		<label for="dedicationField"><?=$strings["prof_add_dedication"] ?></label>
		<input type="text" name="dedication" class="form-control" id="dedicationField"
			placeholder="<?= $strings["prof_add_dedic_ph"] ?>"
			 />
	</div>
	<div class="form-group">
		<label for="userField"><?=$strings["prof_add_user"]?></label>
		<select id="user" name="userField">
<?php
	foreach($data["users"] as $user) {
?>
	<option value="<?= $user["id"] ?>"><?= $user["email"] ?></option>
<?php
	}
?>
		</select>
	</div>
	
	<button type="submit" class="btn btn-primary"><?= $strings["prof_add_submit"] ?></button>
</form>

