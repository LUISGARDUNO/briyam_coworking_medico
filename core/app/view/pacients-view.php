<?php if(!Core::$user->view_pacients){ Core::redir("./?view=home"); } ?>
<section class="content">
<div class="row">
	<div class="col-md-12">
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>
-->
		<h1>Pacientes</h1>
	<a href="index.php?view=newpacient" class="btn btn-default"><i class='fa fa-male'></i> Nuevo Paciente</a>
<br>
<br>
		<?php

		$users = PacientData::getAll();
		if(count($users)>0){
			// si hay usuarios
			?>
			<div class="box box-primary">
			<div class="box-body">

			<table class="table table-bordered table-hover datatable">
			<thead>
			<th></th>
			<th>DNI.</th>
			<th><i class="fa fa-picture"></i></th>
			<th>Nombre completo</th>
			<th>Direccion</th>
			<th>Email</th>
			<th>Telefono</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td style="width:30px;"><a href="./?view=pacient&id=<?php echo $user->id; ?>" class="btn btn-default btn-xs"><i class="fa fa-folder-open"></i></a></td>
				<td><?php echo $user->no;?></td>
				<td style="width:80px;">
				<?php if($user->image!=""):?>
	<img src="storage/<?php echo $user->image; ?>" class="img-responsive">
				<?php endif; ?>

				</td>
				<td><p><?php echo $user->name." ".$user->lastname; ?></p>

				</td>
				<td><?php echo $user->address; ?></td>
				<td><?php echo $user->email; ?></td>
				<td><?php echo $user->phone; ?></td>
				<td style="width:270px;">
				<a href="cesion.php?id=<?php echo $user->id;?>" target="_blank" class="btn btn-info btn-xs">Cesion de Datos</a>
				<a href="index.php?view=pacienthistory&id=<?php echo $user->id;?>" class="btn btn-default btn-xs">Historial</a>
					<?php if(Core::$user->edit_pacients): ?>

				<a href="index.php?view=editpacient&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?view=delpacient&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
			<?php endif; ?>
				</td>
				</tr>
				<?php

			}
			?>
			</table>
			</div>
			</div>
			<?php



		}else{
			echo "<p class='alert alert-danger'>No hay pacientes</p>";
		}


		?>


	</div>
</div>
</section>