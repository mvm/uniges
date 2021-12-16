<h1><?=$strings["space_list_title"]?></h1>

<?php if(in_array(array("space", "add"), $sessionPermissions)) { ?>
<a class="btn btn-primary" href="/?controller=space&action=add"><?=$strings["space_list_add"]?></a>
<?php } ?>

<table class="table">
	<thead>
		<th scope="col"><?=$strings["space_list_academicyear"]?></th>
		<th scope="col"><?=$strings["space_list_name"]?></th>
		<th scope="col"><?=$strings["space_list_type"]?></th>
	</thead>
	
<?php
	foreach($data as $space) {
?>
	<tr>
		<td><?= $space->academicyear->name ?></td>
		<td><?= $space->name ?></td>
		<td><?= $space->type ?></td>
		<td>
<?php if(in_array(array("space", "edit"), $sessionPermissions)) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=space&action=edit&id=<?= $space->id ?>">
			<?= $strings["space_list_edit"] ?>
			</a>
<?php } ?>

<?php if(in_array(array("space", "delete"), $sessionPermissions)) { ?>
			<form style="display: inline" 
				action="/?controller=space&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$space->id?>"></input>
			<input type="submit" value="<?=$strings["space_list_delete"]?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
	</tr>
<?php
	}
?>
	
	<tbody>
	</tbody>
</table>
