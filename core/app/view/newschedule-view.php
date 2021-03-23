<section class="content">
<div class="row">
	<div class="col-md-12">
	<h1>Nuevo Horario</h1>
	<br>
		<form class="form-horizontal" method="post" id="addproduct" action="index.php?action=addschedule" role="form">

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Incluir</label>
    <div class="col-md-2">
      <input type="radio" name="kind" value="1"  required placeholder="">
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Excluir</label>
    <div class="col-md-2">
      <input type="radio" name="kind"  required placeholder="">
    </div>

  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha inicio*</label>
    <div class="col-md-4">
      <input type="date" name="start_date_at" class="form-control" required placeholder="">
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Hora inicio*</label>
    <div class="col-md-4">
      <input type="time" name="start_time_at" class="form-control" required placeholder="">
    </div>

  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha fin*</label>
    <div class="col-md-4">
      <input type="date" name="finish_date_at" class="form-control" required placeholder="">
    </div>
    <label for="inputEmail1" class="col-lg-2 control-label">Hora fin*</label>
    <div class="col-md-4">
      <input type="time" name="finish_time_at" class="form-control" required placeholder="">
    </div>

  </div>



  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Repetir*</label>
    <div class="col-md-5">
      <input type="text" name="n_repeat" class="form-control" id="lastname" placeholder="Repetir">
    </div>
    <div class="col-md-5">
    <select class="form-control" name="k_repeat">
    <option value="">-- SELECCIONA --</option>
    <option value="day">Dias</option>
    <option value="month">Mes</option>
    <option value="year">A&ntilde;o</option>
    </select>
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
    <input type="hidden" name="medic_id" value="<?php echo $_GET["id"]; ?>">
      <button type="submit" class="btn btn-primary">Agregar Horario</button>
    </div>
  </div>


</form>
	</div>
</div>
</section>