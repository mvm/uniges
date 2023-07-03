<h1><?= $strings["degree_add_title"] ?></h1>

<form action="/?controller=degree&action=add_end" method="POST">

<div class="form-group">
<label for="academicyear"><?= $strings["degree_add_ay"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>"><?= $ay->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="centre"><?= $strings["degree_add_centre"] ?></label>
<select id="centre" name="centre_id">
<?php foreach($data["centre"] as $c) { ?>
    <option value="<?= $c->id ?>"><?= $c->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="supervisor"><?= $strings["degree_add_supervisor"] ?></label>
<select id="supervisor" name="supervisor">
<?php foreach($data["prof"] as $p) { ?>
    <option value="<?= $p->id ?>"><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="code"><?= $strings["degree_add_code"] ?></label>
<input type="text" id="code" name="code" />
</div>

<div class="form-group">
<label for="name"><?= $strings["degree_add_name"] ?></label>
<input type="text" id="name" name="name" />
</div>

<input type="submit" class="btn btn-primary" value="<?= $strings["degree_add_submit"] ?>" />
</form>
