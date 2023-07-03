<h1><?=$strings["space_edit_title"]?></h1>

<?php $space = $data["space"]; ?>

<form action="/?controller=space&action=edit_end" method="POST">
<input type="hidden" name="id" value="<?=$space->id?>" />

<div class="form-group">
<label for="academicyear"><?=$strings["space_add_academicyear"]?></label>
<select id="academicyear" name="academicyear_id">

<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?=$ay->id?>" <?=$ay->id == $data["space"]->academicyear_id ? "selected" : "" ?>><?=$ay->name?></option>
<?php } ?>

</select>
</div>

<div class="form-group">
<label for="name"><?=$strings["space_add_name"]?></label>
<input type="text" id="name" name="name" placeholder="<?=$strings["space_add_name_ph"]?>" value="<?=$space->name?>"/>
</div>

<div class="form-group">
<label for="type"><?=$strings["space_add_type"]?></label>
<select id="type" name="type">
<option value="aula" <?= $space->type == "aula" ? "selected" : "" ?>><?=$strings["space_add_type_aula"]?></option>
<option value="despacho" <?= $space->type == "despacho" ? "selected" : "" ?>><?=$strings["space_add_type_despacho"]?></option>
</select>
</div>

<input type="submit" value="<?=$strings["space_edit_submit"]?>" class="btn btn-primary"/>

</form>
