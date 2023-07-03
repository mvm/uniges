<h1><?=$strings["dept_add_title"]?></h1>
<form action="/?controller=department&action=add_end" method="POST">
	<div class="form-group">
		<label for="acadYear"><?=$strings["dept_add_acadYear"]?></label>
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
        <label for="code"><?=$strings["dept_add_code"]?></label>
        <input type="text" name="code" id="code" placeholder="<?=$strings["dept_add_code_ph"]?>"/>
	</div>
	
	<div class="form-group">
        <label for="name"><?=$strings["dept_add_name"]?></label>
        <input type="text" name="name" id="name" placeholder="<?=$strings["dept_add_name_ph"]?>" />
	</div>
	
	<button type="submit" class="btn btn-primary"><?= $strings["dept_add_submit"] ?></button>
</form>

