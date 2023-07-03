<h1><?= $strings["pda_list_title"] ?></h1>

<?php if(has_permission("pda", "add")) { ?>
<a class="btn btn-primary" href="/?controller=pda&action=add"><?= $strings["pda_list_add"] ?></a>
<?php } ?>

<table class="table">
    <thead>
        <th scope="col"><?= $strings["pda_list_ay"] ?></th>
        <th scope="col"><?= $strings["pda_list_title2"] ?></th>
        <th scope="col"><?= $strings["pda_list_centre"] ?></th>
        <th scope="col"><?= $strings["pda_list_degree"] ?></th>
    </thead>

<?php foreach($data as $p) { ?>
    <tr>
        <td><?= $p->academicyear_obj->name ?></td>
        <td><a href="/uploads/<?= $p->file ?>"><?= $p->title ?></a></td>
        <td><?= $p->centre_obj->name ?></td>
        <td><?= $p->degree_obj->name ?></td>
        
        <td>
<?php if(has_permission("pda", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=pda&action=edit&id=<?= $p->id ?>">
			<?= $strings["pda_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("pda", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=pda&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$p->id?>"></input>
			<input type="submit" value="<?= $strings["pda_list_delete"] ?>" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
        
    </tr>
<?php } ?>
    
</table>
