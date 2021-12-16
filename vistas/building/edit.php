<h1><?= $strings["building_edit_title"] ?></h1>

<?php
    $build = $data["build"];
?>

<form action="/?controller=building&action=edit_end" method="POST">

<input type="hidden" name="id" value="<?= $build->id ?>" />

<div class="form-group">
<label for="academicyear"><?= $strings["building_edit_acadyear"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>" <?= $ay->id == $build->academicyear_id ? "selected" : "" ?>> <?=$ay->name ?> </option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="name"> <?= $strings["building_edit_name"] ?> </label>
<input type="text" name="name" placeholder="<?= $strings["building_add_name_ph"] ?>" value="<?= $build->name ?>" />
</div>

<div class="form-group">
<label for="location"> <?= $strings["building_add_location"] ?></label>
<input type="text" name="location" placeholder="<?= $strings["building_add_location_ph"] ?>" value="<?= $build->location ?>" />
</div>

<input type="submit" value="<?= $strings["building_edit_submit"] ?>" class="btn btn-primary" />

</form>
