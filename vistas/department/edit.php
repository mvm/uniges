<h1><?=$strings["dept_edit_title"]?></h1>
<?php $dept = $data["dept"]; ?>

<form action="/?controller=department&action=edit_end" method="POST">
    <input type="hidden" name="id" value="<?=$dept->id ?>" />
	<div class="form-group">
		<label for="acadYear"><?=$strings["dept_add_acadYear"]?></label>
		<select id="acadYear" name="acadYear">
<?php
	foreach($data["ay"] as $year) {
?>
	<option value="<?=$year->id?>"
        <?= $dept->academicyear_id == $year->id? "selected" : "" ?>>
        <?= $year->name ?>
    </option>
<?php			
	}
?>
		</select>
	</div>
	
	<div class="form-group">
        <label for="code"><?=$strings["dept_add_code"]?></label>
        <input type="text" name="code" id="code" placeholder="<?=$strings["dept_add_code_ph"]?>"
            value="<?= $dept->code ?>"/>
	</div>
	
	<div class="form-group">
        <label for="name"><?=$strings["dept_add_name"]?></label>
        <input type="text" name="name" id="name" placeholder="<?=$strings["dept_add_name_ph"]?>"
            value="<?=$dept->name ?>"/>
	</div>
	
	<button type="submit" class="btn btn-primary"><?= $strings["dept_edit_submit"] ?></button>
</form>

