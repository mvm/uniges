<h1><?=$strings["building_list_title"]?></h1>

<?php if(has_permission("subject", "add")) { ?>
    <a class="btn btn-primary" href="/?controller=building&action=add"><?= $strings["building_list_add"] ?></a>
<?php } ?>

<table class="table">
    <thead>
        <th scope="col"><?= $strings["building_list_academicyear"] ?></th>
        <th scope="col"><?= $strings["building_list_name"] ?></th>
        <th scope="col"><?= $strings["building_list_location"] ?></th>
    </thead>
    
<?php foreach($data["builds"] as $b) { ?>
    <tr>
        <td><?= $b->academicyear->name ?></td>
        <td><?= $b->name ?></td>
        <td><?= $b->location ?></td>
        
        <td>
<?php if(has_permission("building", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=building&action=edit&id=<?= $b->id ?>">
			<?= $strings["building_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("building", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=building&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$b->id?>"></input>
			<input type="submit" value="<?= $strings["building_list_delete"] ?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
        
    </tr>
<?php } ?>
</table>
