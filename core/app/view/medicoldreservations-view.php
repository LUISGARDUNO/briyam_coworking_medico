<section class="content">
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
</div>
		<h1>Citas</h1>
<br>
		<?php

		$users = ReservationData::getOld();
		if(count($users)>0){
			// si hay usuarios
			?>

			<table class="table table-bordered table-hover">
			<thead>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$pacient->lastname; ?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				<td style="width:130px;">
				</td>
				</tr>
				<?php

			}
?>
</table>
<?php


		}else{
			echo "<p class='alert alert-danger'>No hay pacientes</p>";
		}


		?>


	</div>
</div>

</section>