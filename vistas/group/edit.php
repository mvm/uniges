<h1><?= $strings["group_edit_title"] ?></h1>
<?php $group = $data["group"]; ?>

<form action="/?controller=group&action=edit_end" method="POST">

<input type="hidden" name="id" value="<?= $group->id ?>"/>

<div class="form-group">
<label for="academicyear"><?=$strings["subject_field_acadyear"]?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["ay"] as $ay) { ?>
    <option value="<?=$ay->id?>" <?= $ay->id == $group->academicyear_id ? "selected" : "" ?>><?=$ay->name?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="subject"><?=$strings["group_field_subject"]?></label>
<select id="subject" name="subject_id">
<?php foreach($data["subj"] as $s) { ?>
    <option value="<?= $s->id ?>" <?= $s->id == $group->subject_id ? "selected" : "" ?>><?= $s->code ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="professor"><?=$strings["group_field_professor"]?></label>
<select id="professor" name="professor_id">
<?php foreach($data["prof"] as $p) { ?>
    <option value="<?= $p->id ?>" <?= $p->id == $group->professor_id ? "selected" : "" ?>><?= $p->user->email ?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="code"><?= $strings["group_field_code"] ?></label>
<input type="text" id="code" name="code" placeholder="<?= $strings["group_field_code_ph"] ?>" value="<?= $group->code ?>" />
</div>

<div class="form-group">
<label for="name"><?= $strings["group_field_name"] ?></label>
<input type="text" id="name" name="name" placeholder="<?= $strings["group_field_name_ph"] ?>" value="<?= $group->name ?>" />
</div>

<div class="form-group">
<label for="type"><?= $strings["group_field_type"] ?></label>
<select name="type" id="type">
    <option value="GA" <?= $group->type == "GA" ? "selected" : "" ?>>GA</option>
    <option value="GB" <?= $group->type == "GB" ? "selected" : "" ?>>GB</option>
    <option value="GC" <?= $group->type == "GC" ? "selected" : "" ?>>GC</option>
</select>
</div>

<div class="form-group">
<label for="hours"><?= $strings["group_field_hours"] ?></label>
<input type="text" id="hours" name="hours" placeholder="<?= $strings["group_field_hours_ph"] ?>" value="<?= $group->hours ?>" />
</div>

<input type="submit" value="<?= $strings["group_edit_submit"] ?>" class="btn btn-primary" />

</form>
