<h1><?= $strings["degree_list_title"] ?></h1>

<?php if(has_permission("degree", "add")) { ?>
<a class="btn btn-primary" href="/?controller=degree&action=add"><?= $strings["degree_list_add"] ?></a>
<?php } ?>

<table class="table">
    <thead>
        <th scope="col"><?= $strings["degree_list_ay"] ?></th>
        <th scope="col"><?= $strings["degree_list_code"] ?></th>
        <th scope="col"><?= $strings["degree_list_name"] ?></th>
        <th scope="col"><?= $strings["degree_list_sup"] ?></th>
    </thead>
    
<?php foreach($data as $d) { ?>
    <tr>
        <td><?= $d->academicyear->name ?></td>
        <td><?= $d->code ?></td>
        <td><?= $d->name ?></td>
        <td><?= $d->supervisor_obj->user->email ?></td>
        
        <td>
<?php if(has_permission("degree", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=degree&action=edit&id=<?= $d->id ?>">
			<?= $strings["degree_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("degree", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=degree&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$d->id?>"></input>
			<input type="submit" value="<?= $strings["degree_list_delete"] ?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
        
    </tr>
<?php } ?>

</table>
