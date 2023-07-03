<h1><?= $strings["centre_edit_title"] ?></h1>

<?php $centre = $data["centre"]; ?>
<form action="/?controller=centre&action=edit_end" method="POST">

<input type="hidden" name="id" value="<?= $centre->id ?>" />

<div class="form-group">
<label for="academicyear"><?= $strings["centre_add_ay"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>" <?= $ay->id == $centre->academicyear_id ? "selected" : "" ?>><?= $ay->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="college"><?= $strings["centre_add_college"] ?></label>
<select id="college" name="college_id">
<?php foreach($data["col"] as $col) { ?>
    <option value="<?= $col->id ?>" <?= $col->id == $centre->college_id ? "selected" : "" ?>><?= $col->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="overseer"><?= $strings["centre_add_overseer"] ?></label>
<select id="overseer" name="overseer">
<?php foreach($data["prof"] as $p) { ?>
    <option value="<?= $p->id ?>" <?= $p->id == $centre->overseer ? "selected" : "" ?>><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="name"><?= $strings["centre_add_name"] ?></label>
<input type="text" name="name" value="<?= $centre->name ?>"/>
</div>

<div class="form-group">
<label for="city"><?= $strings["centre_add_city"] ?></label>
<input type="text" name="city" value="<?= $centre->city ?>"/>
</div>

<input type="submit" class="btn btn-primary" value="<?= $strings["centre_edit_submit"] ?>"/>

</form>
