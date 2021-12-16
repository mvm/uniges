<h1><?=$strings["space_add_title"]?></h1>
<form action="/?controller=space&action=add_end" method="POST">

<div class="form-group">
<label for="academicyear"><?=$strings["space_add_academicyear"]?></label>
<select id="academicyear" name="academicyear_id">

<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?=$ay->id?>"><?=$ay->name?></option>
<?php } ?>

</select>
</div>

<div class="form-group">
<label for="name"><?=$strings["space_add_name"]?></label>
<input type="text" id="name" name="name" placeholder="<?=$strings["space_add_name_ph"]?>" />
</div>

<div class="form-group">
<label for="type"><?=$strings["space_add_type"]?></label>
<select id="type" name="type">
<option value="aula"><?=$strings["space_add_type_aula"]?></option>
<option value="despacho"><?=$strings["space_add_type_despacho"]?></option>
</select>
</div>

<input type="submit" value="<?=$strings["space_add_submit"]?>" class="btn btn-primary"/>

</form>
