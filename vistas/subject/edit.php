<h1><?=$strings["subject_edit_title"]?></h1>

<form action="/?controller=subject&action=edit_end" method="POST">

<input type="hidden" name="id" value="<?= $data["subj"]->id ?>" />

<div class="form-group">
<label for="academicyear"><?=$strings["subject_add_acadyear"]?></label>
<select id="academicyear" name="academicyear_id">
<?php foreach($data["acadYear"] as $ay) { ?>
    <option value="<?=$ay->id?>"
        <?= $ay->id == $data["subj"]->academicyear_id ? "selected" : "" ?>
    ><?=$ay->name?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="department"><?=$strings["subject_add_department"]?></label>
<select id="department" name="department_id">
<?php foreach($data["depts"] as $d) { ?>
    <option value="<?=$d->id?>"
        <?= $d->id == $data["subj"]->department_id ? "selected" : "" ?>
    ><?=$d->name?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="prof"><?=$strings["subject_add_prof"]?></label>
<select id="prof" name="professor_id">
<?php foreach($data["profs"] as $p) { ?>
    <option value="<?=$p->id?>"
        <?= $p->id == $data["subj"]->professor_id ? "selected" : "" ?>
    ><?=$p->user->email?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="code"><?=$strings["subject_add_code"]?></label>
<input type="text" name="code" id="code" placeholder="<?=$strings["subject_add_code_ph"]?>"
    value="<?=$data["subj"]->code ?>"/>
</div>

<div class="form-group">
<label for="name"><?=$strings["subject_add_name"]?></label>
<input type="text" name="name" id="name" placeholder="<?=$strings["subject_add_name_ph"]?>"
    value="<?= $data["subj"]->name ?>"/>
</div>

<div class="form-group">
<label for="content"><?=$strings["subject_add_content"]?></label>
<input type="text" name="content" id="content" placeholder="<?=$strings["subject_add_content_ph"]?>"
    value="<?= $data["subj"]->content ?>"
/>
</div>

<div class="form-group">
<label for="credits"><?=$strings["subject_add_credits"]?></label>
<input type="text" name="credits" id="credits" placeholder="<?=$strings["subject_add_credits_ph"]?>"
    value="<?= $data["subj"]->credits ?>"
/>
</div>

<div class="form-group">
<label for="type"><?=$strings["subject_add_type"]?></label>
<select id="type" name="type">
    <option value="OB" <?= $data["subj"]->type == "OB" ? "selected" : "" ?>>OB</option>
    <option value="OP" <?= $data["subj"]->type == "OP" ? "selected" : "" ?>>OP</option>
    <option value="FB" <?= $data["subj"]->type == "FB" ? "selected" : "" ?>>FB</option>
</select>
</div>

<div class="form-group">
<label for="hours"><?=$strings["subject_add_hours"]?></label>
<input type="text" name="hours" id="hours" placeholder="<?=$strings["subject_add_hours_ph"]?>"
    value="<?= $data["subj"]->hours ?>"/>
</div>

<div class="form-group">
<label for="semester"><?= $strings["subject_add_semester"] ?></label>
<select id="semester" name="semester">
    <option value="1" <?= $data["subj"]->semester == "1" ? "selected" : "" ?>>
        <?= $strings["subject_add_semester1"] ?></option>
    <option value="2"<?= $data["subj"]->semester == "2" ? "selected" : "" ?>>
    <?= $strings["subject_add_semester2"] ?></option>
</select>
</div>

<div class="form-group">
<input type="submit" class="btn btn-primary" value="<?=$strings["subject_edit_submit"]?>"/>
</div>
</form>
