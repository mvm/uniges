<h1><?= $strings["centre_list_title"] ?></h1>

<?php if(has_permission("centre", "add")) { ?>
<a class="btn btn-primary" href="/?controller=centre&action=add"><?= $strings["centre_list_add"] ?></a>
<?php } ?>

<table class="table">
    <thead>
        <th scope="col"><?= $strings["centre_list_ay"] ?></th>
        <th scope="col"><?= $strings["centre_list_name"] ?></th>
        <th scope="col"><?= $strings["centre_list_city"] ?></th>
        <th scope="col"><?= $strings["centre_list_college_name"] ?></th>
        <th scope="col"><?= $strings["centre_list_overseer_email"] ?></th>
    </thead>
    
<?php foreach($data as $c) { ?>
    <tr>
        <td><?= $c->academicyear->name ?></td>
        <td><?= $c->name ?></td>
        <td><?= $c->city ?></td>
        <td><?= $c->college->name ?></td>
        <td><?= $c->overseer_obj->user->email ?></td>
        
        <td>
<?php if(has_permission("centre", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=centre&action=edit&id=<?= $c->id ?>">
			<?= $strings["centre_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("centre", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=centre&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$c->id?>"></input>
			<input type="submit" value="<?= $strings["centre_list_delete"] ?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
        
    </tr>
<?php } ?>
</table>
