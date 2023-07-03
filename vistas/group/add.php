<h1><?= $strings["group_add_title"] ?></h1>

<form action="/?controller=group&action=add_end" method="POST">

<div class="form-group">
<label for="academicyear"><?=$strings["subject_field_acadyear"]?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?=$ay->id?>"><?=$ay->name?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="subject"><?=$strings["group_field_subject"]?></label>
<select id="subject" name="subject_id">
<?php foreach($data["subj"] as $s) { ?>
    <option value="<?= $s->id ?>"><?= $s->code ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="professor"><?=$strings["group_field_professor"]?></label>
<select id="professor" name="professor_id">
<?php foreach($data["prof"] as $p) { ?>
    <option value="<?= $p->id ?>"><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="code"><?= $strings["group_field_code"] ?></label>
<input type="text" id="code" name="code" placeholder="<?= $strings["group_field_code_ph"] ?>" />
</div>

<div class="form-group">
<label for="name"><?= $strings["group_field_name"] ?></label>
<input type="text" id="name" name="name" placeholder="<?= $strings["group_field_name_ph"] ?>" />
</div>

<div class="form-group">
<label for="type"><?= $strings["group_field_type"] ?></label>
<select name="type" id="type">
    <option value="GA">GA</option>
    <option value="GB">GB</option>
    <option value="GC">GC</option>
</select>
</div>

<div class="form-group">
<label for="hours"><?= $strings["group_field_hours"] ?></label>
<input type="text" id="hours" name="hours" placeholder="<?= $strings["group_field_hours_ph"] ?>" />
</div>

<input type="submit" value="<?= $strings["group_add_submit"] ?>" class="btn btn-primary" />

</form>
