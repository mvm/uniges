<h1><?=$strings["dept_list_title"]?></h1>

<?php if(in_array(array("department", "add"), $sessionPermissions)) { ?>
<a class="btn btn-primary" href="/?controller=department&action=add"><?=$strings["dept_list_add"]?></a>
<?php } ?>

<table class="table">
	<thead>
		<th scope="col"><?=$strings["dept_list_academicyear"]?></th>
		<th scope="col"><?=$strings["dept_list_code"]?></th>
		<th scope="col"><?=$strings["dept_list_name"]?></th>
	</thead>
	<tbody>
<?php
	foreach($data as $d) {
?>
	<tr>
		<td><?= $d->academicyear->name ?></td>
		<td><?= $d->code ?></td>
		<td><?= $d->name ?></td>
		<td>
<?php if(has_permission("department", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=department&action=edit&id=<?= $d->id ?>">
			<?= $strings["dept_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("department", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=department&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$d->id?>"></input>
			<input type="submit" value="<?=$strings["dept_list_delete"]?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
	</tr>

<?php } ?>
	</tbody>

</table>
