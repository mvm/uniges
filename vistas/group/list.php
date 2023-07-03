<h1><?= $strings["group_list_title"] ?></h1>

<?php if(has_permission("group", "add")) { ?>
    <a class="btn btn-primary" href="/?controller=group&action=add"><?= $strings["group_list_add"] ?></a>
<?php } ?>

<table class="table">
    <thead>
        <th scope="col"><?= $strings["group_list_ay"] ?></th>
        <th scope="col"><?= $strings["group_list_subject"] ?></th>
        <th scope="col"><?= $strings["group_list_professor"] ?></th>
        <th scope="col"><?= $strings["group_list_code"] ?></th>
        <th scope="col"><?= $strings["group_list_name"] ?></th>
        <th scope="col"><?= $strings["group_list_type"] ?></th>
    </thead>
    
<?php foreach($data as $g) { ?>
    <tr>
        <td><?= $g->academicyear->name ?></td>
        <td><?= $g->subject->code ?></td>
        <td><?= $g->professor->user->email ?></td>
        <td><?= $g->code ?></td>
        <td><?= $g->name ?></td>
        <td><?= $g->type ?></td>
        
        <td>
<?php if(has_permission("group", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=group&action=edit&id=<?= $g->id ?>">
			<?= $strings["group_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("group", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=group&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$g->id?>"></input>
			<input type="submit" value="<?= $strings["group_list_delete"] ?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
    
    </tr>
<?php } ?>
    
</table>
