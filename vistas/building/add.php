<h1><?= $strings["building_add_title"] ?></h1>

<form action="/?controller=building&action=add_end" method="POST">

<div class="form-group">
<label for="academicyear"><?= $strings["building_add_acadyear"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>"> <?=$ay->name ?> </option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="name"> <?= $strings["building_add_name"] ?> </label>
<input type="text" name="name" placeholder="<?= $strings["building_add_name_ph"] ?>" />
</div>

<div class="form-group">
<label for="location"> <?= $strings["building_add_location"] ?></label>
<input type="text" name="location" placeholder="<?= $strings["building_add_location_ph"] ?>" />
</div>

<input type="submit" value="<?= $strings["building_add_submit"] ?>" class="btn btn-primary" />

</form>
