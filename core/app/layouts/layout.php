<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>B-Medical &copy;</title>
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="img/ico.ico" type="img/ico.ico" />
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/skins/skin-blue-light.min.css" rel="stylesheet" type="text/css" />
    <script src="plugins/jquery/jquery-2.1.4.min.js"></script>
<script src="plugins/morris/raphael-min.js"></script>
<script src="plugins/morris/morris.js"></script>
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <link rel="stylesheet" href="plugins/morris/example.css">

    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
<link href='plugins/fullcalendar/fullcalendar.min.css' rel='stylesheet' />
<link href='plugins/fullcalendar/scheduler.min.css' rel='stylesheet' />
<link href='plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='plugins/fullcalendar/moment.min.js'></script>
<script src='plugins/fullcalendar/fullcalendar.min.js'></script>
<script src='plugins/fullcalendar/scheduler.min.js'></script>
<!--  pickadate -->
<link rel="stylesheet" type="text/css" href="plugins/pickadate/themes/classic.css">
<link rel="stylesheet" type="text/css" href="plugins/pickadate/themes/classic.date.css">
<link rel="stylesheet" type="text/css" href="plugins/pickadate/themes/classic.time.css">
<script src='plugins/pickadate/picker.js'></script>
<script src='plugins/pickadate/picker.date.js'></script>
<script src='plugins/pickadate/picker.time.js'></script>
<script src="plugins/jspdf/jspdf.min.js"></script>
<script src="plugins/jspdf/jspdf.plugin.autotable.js"></script>

<link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css"/>
<script src='plugins/select2/select2.min.js'></script>
<script type="text/javascript">
$(document).ready(function(){
  $("select").select2();
});
</script>
  </head>

  <body style="font-family: Montserrat Regular;" class="<?php if(isset($_SESSION["user_id"]) || isset($_SESSION["pacient_id"]) || isset($_SESSION["medic_id"]) ):?>  skin-blue-light sidebar-mini <?php else:?>login-page<?php endif; ?>" >
    <div class="wrapper">
      <!-- Main Header -->
      <?php if(isset($_SESSION["user_id"]) || isset($_SESSION["pacient_id"]) || isset($_SESSION["medic_id"])):?>
      <header class="main-header">
        <!-- Logo -->
        <a href="./" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span style="font-family: Montserrat Regular,'Century Gothic', Century Gothic;" class="logo-mini"><b>B-</b>M</span>
          <!-- logo for regular state and mobile devices -->
          <span style="font-family: Montserrat Regular,'Century Gothic', Century Gothic;" class="logo-lg"><b>B-</b>Medical</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span style="font-family: Montserrat Regular,'Century Gothic', Century Gothic;" class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div style="font-family: Montserrat Regular,'Century Ghothic',Century Gothic;" class="navbar-custom-menu">
            <ul style="font-family: Montserrat Regular,'Century Gothic', Century Ghotic;" class="nav navbar-nav">


              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class=""><?php
                  if(isset($_SESSION["user_id"])){ echo UserData::getById($_SESSION["user_id"])->name; }
                  else if(isset($_SESSION["user_id"])){ echo UserData::getById($_SESSION["user_id"])->name." (Doctor)"; }
                  else if(isset($_SESSION["pacient_id"])){ echo PacientData::getById($_SESSION["pacient_id"])->name." (Paciente)"; }
                  else if(isset($_SESSION["medic_id"])){ echo MedicData::getById($_SESSION["medic_id"])->name." (Medico)"; }

                  ?></span>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <?php if(isset($_SESSION["medic_id"])):?>
                      <a href="./?view=configuremedic" class="btn btn-default btn-flat"><i class='fa fa-cog'></i> Configurar</a>
                    <?php endif; ?>
                      <a href="./logout.php" class="btn btn-default btn-flat">Salir</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
<!--
<div class="user-panel">
            <div class="pull-left image">
              <img src="1.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>Alexander Pierce</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          -->
          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <?php if(isset($_SESSION["user_id"])):?>

              <?php $u = UserData::getById($_SESSION["user_id"]); ?>
            <li><a href="./index.php?view=home"><i class='fa fa-dashboard'></i> <span>Inicio</span></a></li>
            <?php if(Core::$user->view_reservations):?>
            <li><a href="./index.php?view=newreservation"><i class='fa fa-calendar'></i> <span>Calendario</span></a></li>
            <li><a href="./index.php?view=calendar2"><i class='fa fa-calendar'></i> <span>Calendario por Dia</span></a></li>
            <!-- <li><a href="./?view=newreservation"><i class='fa fa-asterisk'></i> <span>Nueva Reserva</span></a></li>
            <li><a href="./?view=reservations"><i class='fa fa-calendar'></i> <span>Reservas</span></a></li>
          <?php endif; ?>
            <?php if(Core::$user->view_pacients):?>
            <li><a href="./?view=pacients"><i class='fa fa-male'></i> <span>Pacientes</span></a></li>
          <?php endif; ?>

            <?php if(Core::$user->view_medics):?>
            <li><a href="./?view=medics"><i class='fa fa-support'></i> <span>Medicos</span></a></li>
          <?php endif; ?>

            <li><a href="./?view=categories"><i class='fa fa-th-list'></i> <span>Areas Medicas</span></a></li>


            <?php if(Core::$user->view_reports):?>
            <li><a href="./?view=reports"><i class='fa fa-area-chart'></i> <span>Reportes</span></a></li>
          <?php endif; ?>

            <?php if(Core::$user->view_users):?>
            <li><a href="./?view=users"><i class='fa fa-user'></i> <span>Usuarios</span></a></li>
          <?php endif; ?> -->

            <?php elseif(isset($_SESSION["pacient_id"])):?>
            <li><a href="./?view=pacienthome"><i class='fa fa-dashboard'></i> <span>Inicio</span></a></li>
            <li><a href="./?view=pacientnewreservation"><i class='fa fa-asterisk'></i> <span>Nueva Cita</span></a></li>
            <li><a href="./?view=pacientreservations"><i class='fa fa-calendar'></i> <span>Citas</span></a></li>
            <?php elseif(isset($_SESSION["medic_id"])):?>
            <li><a href="./?view=medichome"><i class='fa fa-dashboard'></i> <span>Inicio</span></a></li>
            <li><a href="./?view=medicreservations"><i class='fa fa-calendar'></i> <span>Nueva Reserva</span></a></li>
            <li><a href="./?view=medicreports"><i class='fa fa-area-chart'></i> <span>Mis Reservas</span></a></li>
            <?php endif; ?>

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>
    <?php endif;?>

      <!-- Content Wrapper. Contains page content -->
      <?php if(isset($_SESSION["user_id"])  || isset($_SESSION["pacient_id"]) || isset($_SESSION["medic_id"]) ):?>
      <div class="content-wrapper">
        <?php View::load("index");?>
      </div><!-- /.content-wrapper -->

        <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> v1.0.1.2
        </div>
        <div>
                <a href="https://wa.me/525511647297" class="btn btn-success pull-right" class=""><i
                        class="fa fa-whatsapp"></i></a>
            </div>
            <!-- whatsapp bissness5511647297 -->
            <strong>Copyright &copy; 2020 </strong>
            <strong><a href="https://bmedical.com.mx/" target="_blank">B-Medical</a></strong>
            <br>
      </footer>
      <?php else:?>
        <?php if(isset($_GET["view"]) && $_GET["view"]=="pacientlogin"):?>
<div class="login-box">
      <div class="login-logo">
        <h4>ACCESO AL PACIENTE</h4>
        <a href="./?view=pacientlogin"><b>B-</b>Medical</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="./?action=processloginpacient" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" required class="form-control" placeholder="Usuario"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
              <a href="./" class="btn btn-default btn-block">Regresar</a>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->  
        <?php elseif(isset($_GET["view"]) && $_GET["view"]=="pacientregister"):?>
<div class="login-box">
      <div class="login-logo">
        <h4>REGISTRO DE PACIENTES</h4>
        <a href="./?view=pacientlogin"><b>B-</b>Medical</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="./?action=processregisterpacient" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="no" required class="form-control" placeholder="Cedula/DNI"/>
            <span class="glyphicon glyphicon-th-list form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="name" required class="form-control" placeholder="Nombre"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="lastname" required class="form-control" placeholder="Apellidos"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="date" name="day_of_birth" required class="form-control" placeholder="Fecha de Nacimiento"/>
            <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="phone" required class="form-control" placeholder="Telefono"/>
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" name="email" required class="form-control" placeholder="Email"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
              <a href="./" class="btn btn-default btn-block">Regresar</a>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
            <?php elseif(isset($_GET["view"]) && $_GET["view"]=="mediclogin"):?>
<div class="login-box">
      <div class="login-logo">
        <h4>ACCESO AL MEDICO</h4>
        <a href="./?view=pacientlogin"><b>B-</b>Medical</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="./?action=processloginmedic" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" required class="form-control" placeholder="Usuario"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
              <a href="./" class="btn btn-default btn-block">Regresar</a>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
        <?php else:?>
<div class="login-box">
      <div class="login-logo">
      <img src="img/Bmedical_nvo-removebg-preview.png" height="50px" />
        <a href="./"><b>B-</b>Medical</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="./?action=processlogin" method="post">
          <div class="form-group has-feedback">
            <input type="text" name="username" required class="form-control" placeholder="Usuario"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" required class="form-control" placeholder="Password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <div class="col-xs-12">
              <button type="submit" class="btn btn-bitbucket btn-block btn-flat">Acceder</button>
              <!-- <a href="./?view=pacientlogin" class="btn btn-default btn-block">Login Paciente</a>
              <a href="./?view=mediclogin" class="btn btn-default btn-block">Login Medico</a>
              <a href="./?view=pacientregister" class="btn btn-default btn-block">Registro de Pacientes</a> -->
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    </div>
    <div class="login-box">
        <div class="col col-xs-12">
            <div style="font-family: Montserrat Light, 'Century Gothic',Century Gothic; font-size:22px;">
                <br>
                <b>Powered by BRIYAM &copy;</b>
            </div>
        </div>
    </div>
    <?php endif;?>

     <?php endif;?>


    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".pickadate").pickadate({format: 'yyyy-mm-dd',min: '<?php echo date('Y-m-d',time()-(24*60*60)); ?>'});
        $(".pickadate2").pickadate({format: 'yyyy-mm-dd'});
        $(".pickatime").pickatime({format: 'HH:i',interval: 10 });
      })
    </script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(".datatable").DataTable({
         "pageLength": 25,
          "language": {
        "sProcessing":    "Procesando...",
        "sLengthMenu":    "Mostrar _MENU_ registros",
        "sZeroRecords":   "No se encontraron resultados",
        "sEmptyTable":    "Ningún dato disponible en esta tabla",
        "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":   "",
        "sSearch":        "Buscar:",
        "sUrl":           "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":    "Último",
            "sNext":    "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
        });
      });
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience. Slimscroll is required when using the
          fixed layout. -->
  </body>
</html>

