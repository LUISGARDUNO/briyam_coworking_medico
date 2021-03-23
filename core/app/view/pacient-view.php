<?php 
$p = PacientData::getById($_GET["id"]);
?>
<section class="content">
<div class="row">
	<div class="col-md-12">
		<h1><?php echo $p->name." ".$p->lastname; ?> <small>Archivos</small></h1>
<a href="./?view=newfile&pid=<?php echo $p->id; ?>" class="btn btn-default">Nuevo archivo</a>
<br><br>
		<?php

		$users = FileData::getAllByPacientId($p->id);
		if(count($users)>0){
			// si hay usuarios
			?>
			<div class="box box-primary">
			<table class="table table-bordered table-hover">
			<thead>
			<th>Archivo</th>
			<th>Tipo</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php  echo $user->getDoctype()->name; ?></td>
				<td><?php echo $user->created_at; ?></td>
				<td style="width:250px;">
				<a href="index.php?action=files&opt=download&id=<?php echo $user->id;?>" class="btn btn-default btn-xs">Descargar</a>
				<a href="index.php?view=editfile&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?action=files&opt=del&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>

				</td>
				</tr>
				<?php

			}
			?>
			</table>
			</div>
			<?php
		}else{
			echo "<p class='alert alert-danger'>No hay archivos</p>";
		}


		?>

<!-- - - - - - - - - - - - - - - - - - - - - - - - - - -->

	</div>
</div>
</section>