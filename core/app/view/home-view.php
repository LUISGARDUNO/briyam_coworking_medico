<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta
			name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
		/>
    <!-- <link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		/> -->
		<!-- <link
			href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700"
			rel="stylesheet"
		/> -->
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css"
		/>
		<link rel="stylesheet" href="gallery-grid.css" />
  <title>Document</title>
</head>
<body>
<?php


$dateB = new DateTime(date('Y-m-d')); 
$dateA = $dateB->sub(DateInterval::createFromDateString('30 days'));
$sd= strtotime(date_format($dateA,"Y-m-d"));
$ed = strtotime(date("Y-m-d"));
$ntot = 0;
$nsells = 0;
$sumatot = array();
for($i=$sd;$i<=$ed;$i+=(60*60*24)){
$operations[$i] = ReservationData::getGroupByDate(date("Y-m-d",$i),date("Y-m-d",$i));


//    $sumatot[date("Y-m-d",$i)]=$sum;
}


?>
  <section class="content-header">

    <h1 style="font-family: Montserrat Regular,'Century Gothic', Century Gotihc;">
      B-Medical
    </h1>
  </section>

<section class="content">

<!-- Button trigger modal -->

<div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <a href="http://10.47.3.49:8080/bookon/?view=reservations">
          <span class="info-box-icon bg-purple"><i class="fa fa-desktop"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Nueva Reserva</span>
            <!-- <span class="info-box-number"><?php echo count(ReservationData::getAll());?></span> -->
          </div>
          </a>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <a href="http://10.47.3.49:8080/bookon/?view=newreservation"><div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-google-wallet"></i></span>

          <div class="info-box-content">
            <span style="font-family: Montserrat Regular,'Century Gothic', Century Gotihc;" class="info-box-text">Cargar Saldo</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        </a>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <a href="http://10.47.3.49:8080/bookon/index.php?view=calendar2"><div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-calendar"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Mis Reservas </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      </a>
      </section>
<section>
      <div>
      <div class="container gallery-container">
			<h1
				style="
					font-family: Montserrat Regular, 'Century Gothic', Century Gothic;
				"
			>
				Consultorios
			</h1>

			<p class="page-description text-center">Descubre tu favorito</p>

			<div class="tz-gallery">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio1.png">
							<img src="img/Consultorio1.png" alt="Park" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio2.png">
							<img src="img/Consultorio2.png" alt="Bridge" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio3.png">
							<img src="img/Consultorio3.png" alt="Tunnel" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio4.png">
							<img src="img/Consultorio4.png" alt="Coast" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio5.png">
							<img src="img/Consultorio5.png" alt="Rails" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio6.png">
							<img src="img/Consultorio6.png" alt="Traffic" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio7.png">
							<img src="img/Consultorio7.png" alt="Rocks" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio8.png">
							<img src="img/Consultorio8.png" alt="Benches" />
						</a>
					</div>
					<div class="col-sm-6 col-md-4">
						<a class="lightbox" href="img/Consultorio9.png">
							<img src="img/Consultorio9.png" alt="Sky" />
						</a>
					</div>
				</div>
			</div>
		</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
		<script>
			baguetteBox.run(".tz-gallery");
		</script>
</section>
</body>
</html>

