<h1><?=$strings["subject_list_title"]?></h1>

<?php if(in_array(array("subject", "add"), $sessionPermissions)) { ?>
<a class="btn btn-primary" href="/?controller=subject&action=add"><?=$strings["subject_list_add"]?></a>
<?php } ?>

<table class="table">
	<thead>
		<th scope="col"><?=$strings["subject_list_code"]?></th>
		<th scope="col"><?=$strings["subject_list_name"]?></th>
		<th scope="col"><?=$strings["subject_list_credits"]?></th>
		<th scope="col"><?=$strings["subject_list_type"]?></th>
		<th scope="col"><?=$strings["subject_list_semester"]?></th>
	</thead>
	<tbody>
<?php
	foreach($data["asigs"] as $s) {
?>
	<tr>
		<td><?= $s->code ?></td>
		<td><?= $s->name ?></td>
		<td><?= $s->credits ?></td>
		<td><?= $s->type ?></td>
		<td><?= $s->semester ?></td>
		
		<td>
<?php if(has_permission("subject", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=subject&action=edit&id=<?= $s->id ?>">
			<?= $strings["subject_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("subject", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=subject&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$s->id?>"></input>
			<input type="submit" value="<?= $strings["subject_list_delete"] ?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
	</tr>
	
<?php
	}
?>
	</tbody>

</table>
