<h1><?= $strings["college_edit_title"] ?></h1>
<?php $col = $data["col"]; ?>
<form action="/?controller=college&action=edit_end" method="POST">

<input type="hidden" name="id" value="<?= $col->id ?>" />

<div class="form-group">
<label for="academicyear"><?= $strings["college_add_ay"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>" <?= $ay->id == $col->academicyear_id ? "selected" : "" ?>><?=$ay->name?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="name"><?=$strings["college_add_name"]?></label>
<input type="text" id="name" name="name" placeholder="<?= $strings["college_add_name_ph"] ?>" 
    value="<?= $col->name ?>"/>
</div>

<div class="form-group">
<label for="city"> <?= $strings["college_add_city"] ?></label>
<input type="text" id="city" name="city" placeholder="<?= $strings["college_add_city_ph"] ?>"
    value="<?= $col->city ?>"/>
</div>

<div class="form-group">
<label for="supervisor"><?= $strings["college_add_supervisor"] ?></label>
<select id="supervisor" name="supervisor_id">
<?php foreach($data["profs"] as $p) { ?>
    <option value="<?= $p->id ?>" <?= $p->id == $col->supervisor? "selected" : "" ?>><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<input type="submit" class="btn btn-primary" value="<?= $strings["college_edit_submit"] ?>" />

</form>
