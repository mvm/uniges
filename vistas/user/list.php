<h1><?=$strings["user_list_title"]?></h1>

<?php if(in_array(array("user", "add"), $sessionPermissions)) { ?>
<a class="btn btn-primary" href="/?controller=user&action=add"><?=$strings["user_list_add"]?></a>
<?php } ?>

<table class="table">
	<thead>
		<th scope="col"><?=$strings["user_list_email"]?></th>
		<th scope="col"><?=$strings["user_list_dni"]?></th>
		<th scope="col"><?=$strings["user_list_name"]?></th>
		<th scope="col"><?=$strings["user_list_surname"]?></th>
	</thead>
	<tbody>
<?php
	foreach($data as $user) {
?>
	<tr>
		<td><?= $user["email"] ?></td>
		<td><?= $user["dni"] ?></td>
		<td><?= $user["name"] ?></td>
		<td><?= $user["surname"] ?></td>
		<td>
<?php if(in_array(array("user", "edit"), $sessionPermissions)) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=user&action=edit&id=<?= $user["id"] ?>">
			<?= $strings["user_list_edit"] ?>
			</a>
<?php } ?>

<?php if(in_array(array("user", "delete"), $sessionPermissions)) { ?>
			<form style="display: inline" 
				action="/?controller=user&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$user["id"]?>"></input>
			<input type="submit" value="Borrar" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
	</tr>
<?php
	}
?>
	</tbody>

</table>
