<h1><?=$strings["professor_list_title"]?></h1>

<?php if(in_array(array("professor", "add"), $sessionPermissions)) { ?>
<a class="btn btn-primary" href="/?controller=professor&action=add"><?=$strings["professor_list_add"]?></a>
<?php } ?>

<table class="table">
	<thead>
		<th scope="col"><?=$strings["user_list_dni"]?></th>
		<th scope="col"><?=$strings["user_list_name"]?></th>
		<th scope="col"><?=$strings["user_list_surname"]?></th>
		<th scope="col"><?=$strings["professor_list_dedication"]?></th>
		<th scope="col"><?=$strings["professor_list_department"]?></th>
	</thead>
	<tbody>
<?php
	foreach($data as $prof) {
?>
	<tr>
		<td><?= $prof->user->dni ?></td>
		<td><?= $prof->user->name ?></td>
		<td><?= $prof->user->surname ?></td>
		<td><?= $prof->dedication ?></td>
		<td><?= $prof->department["name"] ?></td>
		<td>
<?php if(has_permission("professor", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=professor&action=edit&id=<?= $prof->id ?>">
			<?= $strings["user_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("professor", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=professor&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$prof->id?>"></input>
			<input type="submit" value="Borrar" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
	</tr>
<?php
	}
?>
	</tbody>

</table
