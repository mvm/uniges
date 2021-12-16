<h1><?= $strings["college_list_title"] ?></h1>

<?php if(has_permission("college", "add")) { ?>
<a class="btn btn-primary" href="/?controller=college&action=add"><?= $strings["college_add"] ?></a>
<?php } ?>

<table class="table">
    <thead>
        <th scope="col"><?= $strings["college_ay"] ?></th>
        <th scope="col"><?= $strings["college_name"] ?></th>
        <th scope="col"><?= $strings["college_city"] ?></th>
        <th scope="col"><?= $strings["college_supervisor"] ?></th>
    </thead>
    
<?php foreach($data as $c) { ?>
    <tr>
        <td><?= $c->academicyear->name ?></td>
        <td><?= $c->name ?></td>
        <td><?= $c->city ?></td>
        <td><?= $c->supervisor_obj->user->email ?></td>
        
        <td>
<?php if(has_permission("college", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=college&action=edit&id=<?= $c->id ?>">
			<?= $strings["college_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("college", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=college&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$c->id?>"></input>
			<input type="submit" value="<?= $strings["college_delete"] ?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
    
    </tr>
<?php } ?>
    
    
</table>
