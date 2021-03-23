<?php
$medic = MedicData::getById($_GET["id"]);

?>
<section class="content">
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
	<a href="index.php?view=newschedule&id=<?php echo $medic->id; ?>" class="btn btn-default"><i class='fa fa-clock-o'></i> Nuevo Horario</a>
<!--<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/medicss-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div> -->
</div>
		<h1><?php echo $medic->name." ".$medic->lastname; ?> <small>Horarios</small></h1>
<br>
		<?php

		$users = ScheduleData::getAllByMedicId($_GET["id"]);
		if(count($users)>0){
			// si hay usuarios
			?>
			<div class="box box-primary">
			<table class="table table-bordered table-hover">
			<thead>
			<th>Fecha inicio</th>
			<th>Fechacfin</th>
			<th>Hora inicio</th>
			<th>Hora fin</th>
			<th>Repite</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				?>
				<tr>
				<td><?php echo $user->start_date_at; ?></td>
				<td><?php echo $user->finish_date_at; ?></td>
				<td><?php echo $user->start_time_at; ?></td>
				<td><?php echo $user->finish_time_at; ?></td>
				<td><?php

				if($user->n_repeat!="" && $user->k_repeat!=""){
					echo $user->n_repeat;
					switch ($user->k_repeat) {
						case 'day':
							echo "Dias";
							break;
						case 'month':
							echo "Meses";
							break;
						case 'year':
							echo "A&ntilde;os";
							break;
						
						default:
							# code...
							break;
					}
				}else{
					echo "No";
				}

				 ?></td>

				<td style="width:250px;">
				<a href="index.php?view=editmedic&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?view=delmedic&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>

				</td>
				</tr>
				<?php

			}
			?>
			</table>
			</div>
			<?php
		}else{
			echo "<p class='alert alert-danger'>No hay horarios</p>";
		}


		?>


	</div>
</div>
</section>