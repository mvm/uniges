<h1><?=$strings["tutoria_list_title"]?></h1>

<?php if(in_array(array("tutoria", "add"), $sessionPermissions)) { ?>
<a class="btn btn-primary" href="/?controller=tutoria&action=add"><?=$strings["tutoria_list_add"]?></a>
<?php } ?>

<table class="table">
	<thead>
		<th scope="col"><?=$strings["tutoria_list_academicyear"]?></th>
		<th scope="col"><?=$strings["user_list_email"]?></th>
	</thead>
	<tbody>
<?php
	foreach($data as $t) {
?>
	<tr>
		<td><?= $t->academicyear->name ?></td>
		<td><?= $t->professor->user->email ?></td>
		<td>
<?php if(has_permission("tutoria", "edit")) { ?>
<a class="btn btn-primary btn-sm"
			href="/?controller=tutoria&action=edit&id=<?= $t->id ?>">
			<?= $strings["user_list_edit"] ?>
			</a>
<?php } ?>

<?php if(has_permission("tutoria", "delete")) { ?>
			<form style="display: inline" 
				action="/?controller=tutoria&action=delete" method="POST">
				<input type="hidden" name="id" value="<?=$t->id?>"></input>
			<input type="submit" value="Borrar" class="btn btn-danger btn-sm" />
			</form>
<?php } ?>
		</td>
	</tr>

<?php if(has_permission("tutoria", "asistencia")) { ?>
	
	<div class="container">
        
        <?php
            foreach($t->asistencias as $as) {
        ?>
        <tr>
            <th scope="row">Asistencia</th>
            <td><?= $as->timetable->day ?></td>
            <td><?= $as->timetable->hourbegin ?></td>
            <td><?= $as->timetable->hourend ?></td>
            <td><?= $as->attendance ?></td>
            
            <td>
            <form style="display: inline" 
				action="/?controller=tutoria&action=asistencia" method="POST">
				<input type="hidden" name="tutoria_id" value="<?=$as->tutoria_id?>"></input>
				<input type="hidden" name="timetable_id" value="<?=$as->timetable_id?>"></input>
			<input type="submit" value="Asistir" class="btn btn-primary btn-sm" />
			</form>
            </td>
        </tr>
        
        <?php
            }
        ?>
	</div>
	
<?php
	}
?>
<?php } ?>
	</tbody>

</table>
