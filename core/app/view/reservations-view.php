<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forma</title>
</head>

<body>

</body>

</html>
<!-- ----------------------------------------------------------------------------------------------------------------------------- -->
<section class="content">
    <div>
        <a style="margin: 10px 0px 10px 0px; " href="javascript:history.back()"><img src="img/btnBack.png" height="42"
              width="42" style="margin-top: 10px;"></a>
    </div>
	<br>
    <div class="row">
        <div>
            <a href="http://10.47.3.49:8080/bookon/?view=medicreports">
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-blue-active">
                            <i class="fa fa-hospital-o"></i>
                        </span>
                        <div class="info-box-content">
                            <span
                                style=" font-family: Montserrat Light, 'Century Gothic',Century Gothic ; font-size:larger"
                                class="text text-black">Reservar por Consultorio</span>
                        </div>
            </a>
        </div>
    </div>

    <!-- Ficha Reservar por fecha -->
    <!-- --------------------------------- -->
    <!-- Ficha Consulta tus reservas -->
    <a href="https://briyam.com/bmedical/control/calendar.asp">
	<!-- <a href="http://10.47.3.49:8080/bookon/?view=newreservation"> -->
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow-gradient">
                    <i class="fa fa-calendar"></i>
                </span>
                <div class="info-box-content">
                    <span style=" font-family: Montserrat Light, 'Century Gothic',Century Gothic ; font-size:larger"
                        class="text text-black">Reservacion por fechas </span>
                </div>
            </div>
        </div>
    </a>

</section>

<!-- <section class="content">
 <?php
$thejson = null;

$events = ReservationData::getEveryByPacientId($_SESSION["user_id"]);
foreach($events as $event){
	$thejson[] = array("title"=>$event->title,"start"=>$event->date_at."T".$event->time_at);
}
print_r(json_encode($thejson));

?>
<script>


	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo json_encode($thejson); ?>
		});

	});

</script>


<div class="row">
<div class="col-md-12">
<h1>Calendario</h1>
<div class="box box-primary">
<div id="calendar"></div>
</div>

</div>
</div>
</section> -->

<!---------------------------------------------- Cambios------------------------ -->

<!-- <?php if(!Core::$user->view_reservations){ Core::redir("./?view=home"); } ?>
<section class="content">
<div class="row">
	<div class="col-md-12">
<div class="btn-group pull-right">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="report/clients-word.php">Word 2007 (.docx)</a></li>
  </ul>
</div>

</div>
		<h1>Citas</h1>
<a href="./index.php?view=newreservation" class="btn btn-default"><i class='fa fa-asterisk'></i> Nueva cita</a>
<a href="./index.php?view=oldreservations" class="btn btn-default"><i class='fa fa-clock-o'></i> Citas Anteriores</a>
<br><br>
<form class="form-horizontal" role="form">
<input type="hidden" name="view" value="reservations">
        <?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();
        ?>

  <div class="form-group">
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-search"></i></span>
		  <input type="text" name="q" value="<?php if(isset($_GET["q"]) && $_GET["q"]!=""){ echo $_GET["q"]; } ?>" class="form-control" placeholder="Palabra clave">
		</div>
    </div>
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-male"></i></span>
<select name="pacient_id" class="form-control">
<option value="">PACIENTE</option>
  <?php foreach($pacients as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["pacient_id"]) && $_GET["pacient_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-2">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-support"></i></span>
<select name="medic_id" class="form-control">
<option value="">MEDICO</option>
  <?php foreach($medics as $p):?>
    <option value="<?php echo $p->id; ?>" <?php if(isset($_GET["medic_id"]) && $_GET["medic_id"]==$p->id){ echo "selected"; } ?>><?php echo $p->id." - ".$p->name." ".$p->lastname; ?></option>
  <?php endforeach; ?>
</select>
		</div>
    </div>
    <div class="col-lg-4">
		<div class="input-group">
		  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		  <input type="text" name="date_at" value="<?php if(isset($_GET["date_at"]) && $_GET["date_at"]!=""){ echo $_GET["date_at"]; } ?>" class="pickadate form-control" placeholder="Fecha">
		</div>
    </div>

    <div class="col-lg-2">
    <button class="btn btn-primary btn-block">Buscar</button>
    </div>

  </div>
</form> -->

<!-- <?php
$users= array();
if((isset($_GET["q"]) && isset($_GET["pacient_id"]) && isset($_GET["medic_id"]) && isset($_GET["date_at"])) && ($_GET["q"]!="" || $_GET["pacient_id"]!="" || $_GET["medic_id"]!="" || $_GET["date_at"]!="") ) {
$sql = "select * from reservation where ";
if($_GET["q"]!=""){
	$sql .= " title like '%$_GET[q]%' and note like '%$_GET[q] %' ";
}

if($_GET["pacient_id"]!=""){
if($_GET["q"]!=""){
	$sql .= " and ";
}
	$sql .= " pacient_id = ".$_GET["pacient_id"];
}

if($_GET["medic_id"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!=""){
	$sql .= " and ";
}

	$sql .= " medic_id = ".$_GET["medic_id"];
}



if($_GET["date_at"]!=""){
if($_GET["q"]!=""||$_GET["pacient_id"]!="" ||$_GET["medic_id"]!="" ){
	$sql .= " and ";
}

	$sql .= " date_at = \"".$_GET["date_at"]."\"";
}

		$users = ReservationData::getBySQL($sql);

}else{
		$users = ReservationData::getAll();

}
		if(count($users)>0){
			// si hay usuarios
			?>
			<div class="box box-primary">
			<div class="box-body">
			<table class="table table-bordered table-hover datatable">
			<thead>
			<th>Cod.</th>
			<th>Asunto</th>
			<th>Paciente</th>
			<th>Medico</th>
			<th>Estado</th>
			<th>Fecha</th>
			<th></th>
			</thead>
			<?php
			foreach($users as $user){
				$pacient  = $user->getPacient();
				$medic = $user->getMedic();
				?>
				<tr>
				<td><?php echo $user->no; ?></td>
				<td><?php echo $user->title; ?></td>
				<td><?php echo $pacient->name." ".$pacient->lastname; ?></td>
				<td><?php echo $medic->name." ".$medic->lastname; ?></td>
				<td>
					<?php
					if($user->status_id==1 && $user->price==0){
						echo "Debe asignar precio";

					} else{
					echo StatusData::getById($user->status_id)->name;
				}
					?></td>
				<td><?php echo $user->date_at." ".$user->time_at; ?></td>
				<td style="width:180px;">

				<a href="./report/reservation-word.php?id=<?php echo $user->id;?>" class="btn btn-default btn-xs">Descargar</a>
					<?php if(Core::$user->edit_reservations): ?>
				<a href="index.php?view=editreservation&id=<?php echo $user->id;?>" class="btn btn-warning btn-xs">Editar</a>
				<a href="index.php?action=delreservation&id=<?php echo $user->id;?>" class="btn btn-danger btn-xs">Eliminar</a>
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
			echo "<p class='alert alert-info'>No hay citas</p>";
		}


		?>


	</div>
</div> -->
</section>