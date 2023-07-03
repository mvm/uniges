<h1><?= $strings["college_add_title"] ?></h1>

<form action="/?controller=college&action=add_end" method="POST">

<div class="form-group">
<label for="academicyear"><?= $strings["college_add_ay"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>"><?=$ay->name?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="name"><?=$strings["college_add_name"]?></label>
<input type="text" id="name" name="name" placeholder="<?= $strings["college_add_name_ph"] ?>" />
</div>

<div class="form-group">
<label for="city"> <?= $strings["college_add_city"] ?></label>
<input type="text" id="city" name="city" placeholder="<?= $strings["college_add_city_ph"] ?>" />
</div>

<div class="form-group">
<label for="supervisor"><?= $strings["college_add_supervisor"] ?></label>
<select id="supervisor" name="supervisor_id">
<?php foreach($data["profs"] as $p) { ?>
    <option value="<?= $p->id ?>"><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<input type="submit" class="btn btn-primary" value="<?= $strings["college_add_submit"] ?>" />

</form>
