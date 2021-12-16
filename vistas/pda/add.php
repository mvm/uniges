<h1><?= $strings["pda_add_title"] ?></h1>

<form enctype="multipart/form-data" action="/?controller=pda&action=add_end" method="POST">

<div class="form-group">
<label for="title"><?= $strings["pda_add_title2"] ?></label>
<input type="text" id="title" name="title" />
</div>

<input type="hidden" name="MAX_FILE_SIZE" value="500000000" />

<div class="form-group">
<label for="file"><?= $strings["pda_add_file"] ?></label>
<input type="file" id="file" name="file" />
</div>

<div class="form-group">
<label for="academicyear"><?= $strings["pda_add_ay"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>"><?= $ay->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="college"><?= $strings["pda_add_college"] ?></label>
<select id="college" name="college_id">
<?php foreach($data["col"] as $c) { ?>
    <option value="<?= $c->id ?>"><?= $c->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="centre"><?= $strings["pda_add_centre"] ?></label>
<select id="centre" name="centre_id">
<?php foreach($data["cen"] as $c) { ?>
    <option value="<?= $c->id ?>"><?= $c->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="degree"><?= $strings["pda_add_degree"] ?></label>
<select id="degree" name="degree_id">
<?php foreach($data["deg"] as $d) { ?>
    <option value="<?= $d->id ?>"><?= $d->name ?></option>
<?php } ?>
</select>
</div>

<input type="submit" class="btn btn-primary" value="<?= $strings["pda_add_submit"] ?>"/>

</form>
