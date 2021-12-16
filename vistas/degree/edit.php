<h1><?= $strings["degree_edit_title"] ?></h1>

<?php $degree = $data["degree"]; ?>

<form action="/?controller=degree&action=edit_end" method="POST">

<input type="hidden" name="id" value="<?= $degree->id ?>" />

<div class="form-group">
<label for="academicyear"><?= $strings["degree_add_ay"] ?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?= $ay->id ?>" <?= $degree->academicyear_id == $ay->id ? "selected" : "" ?>><?= $ay->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="centre"><?= $strings["degree_add_centre"] ?></label>
<select id="centre" name="centre_id">
<?php foreach($data["centre"] as $c) { ?>
    <option value="<?= $c->id ?>" <?= $degree->centre_id == $c->id ? "selected" : "" ?>><?= $c->name ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="supervisor"><?= $strings["degree_add_supervisor"] ?></label>
<select id="supervisor" name="supervisor">
<?php foreach($data["prof"] as $p) { ?>
    <option value="<?= $p->id ?>" <?= $degree->supervisor == $p->id ? "selected" : "" ?>><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="code"><?= $strings["degree_add_code"] ?></label>
<input type="text" id="code" name="code" value="<?= $degree->code ?>" />
</div>

<div class="form-group">
<label for="name"><?= $strings["degree_add_name"] ?></label>
<input type="text" id="name" name="name" value="<?= $degree->name ?>"/>
</div>

<input type="submit" class="btn btn-primary" value="<?= $strings["degree_edit_submit"] ?>" />
</form>
