<h1><?= $strings["centre_add_title"] ?></h1>

<form action="/?controller=centre&action=add_end" method="POST">

<div class="form-group">
<label for="academicyear"><?= $strings["centre_add_ay"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>"><?= $ay->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="college"><?= $strings["centre_add_college"] ?></label>
<select id="college" name="college_id">
<?php foreach($data["col"] as $col) { ?>
    <option value="<?= $col->id ?>"><?= $col->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="overseer"><?= $strings["centre_add_overseer"] ?></label>
<select id="overseer" name="overseer">
<?php foreach($data["prof"] as $p) { ?>
    <option value="<?= $p->id ?>"><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="name"><?= $strings["centre_add_name"] ?></label>
<input type="text" name="name" />
</div>

<div class="form-group">
<label for="city"><?= $strings["centre_add_city"] ?></label>
<input type="text" name="city" />
</div>

<input type="submit" class="btn btn-primary" value="<?= $strings["centre_add_submit"] ?>"/>

</form>
