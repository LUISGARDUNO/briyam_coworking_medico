<section class="content">
<?php
$pacients = PacientData::getAll();
$medics = MedicData::getAll();

$statuses = StatusData::getAll();
$payments = PaymentData::getAll();

?>

<div class="row">
<div class="col-md-10">
<h1>Nueva Cita</h1>
<form class="form-horizontal" role="form" method="post" action="./?action=pacientaddreservation">
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Asunto</label>
    <div class="col-lg-10">
      <input type="text" name="title" required class="form-control" id="inputEmail1" placeholder="Asunto">
    </div>
  </div>

  <div class="form-group">
    <div class="col-lg-3 col-md-offset-2">
    <label for="inputEmail1" class="control-label">Area Medica</label>
<select name="category_id" id="category_id" class="form-control" required>
<option value="">-- SELECCIONE --</option>
  <?php foreach(CategoryData::getAll() as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>

    <div class="col-lg-7">
    <label for="inputEmail1" class="control-label">Medico</label>
<select name="medic_id" id="medic_id" class="form-control" required>
<option value="">-- SELECCIONE AREA--</option>
</select>
    </div>
  </div>

  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
    <div class="col-lg-5">
      <input type="text" name="date_at" id="date_at" required class="pickadate2 form-control" id="inputEmail1" placeholder="Fecha">
    </div>
    <div class="col-lg-5">
      <!-- <input type="text" name="time_at" id="time_at" required class="pickatime form-control" id="inputEmail1" placeholder="Hora"> -->
<select name="time_at" id="time_at" required class="form-control">
  <option value="">-- SELECCIONE --</option>
</select>
    </div>
  </div>
  <input type="hidden" name="note" value="">
  <input type="hidden" name="sick" value="">
  <input type="hidden" name="symtoms" value="">
  <input type="hidden" name="medicaments" value="">
<!--
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="note" placeholder="Nota"></textarea>
    </div>
  </div>
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Enfermedad</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="sick" placeholder="Enfermedad"></textarea>
    </div>
  </div>
      <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Sintomas</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="symtoms" placeholder="Sintomas"></textarea>
    </div>
  </div>
        <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Medicamentos</label>
    <div class="col-lg-10">
    <textarea class="form-control" name="medicaments" placeholder="Medicamentos"></textarea>
    </div>
  </div>
-->
  <!--
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
    <div class="col-lg-10">
<select name="status_id" class="form-control" required>
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-10">
<select name="payment_id" class="form-control" required>
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>

    <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Costo</label>
    <div class="col-lg-10">
<div class="input-group">
  <span class="input-group-addon"><i class="fa fa-usd"></i></span>
  <input type="text" class="form-control" name="price" placeholder="Costo">
</div>
    </div>
  </div>
-->
<input type="hidden" name="status_id" value="1">
<input type="hidden" name="payment_id" value="1">
<input type="hidden" name="price" value="0">
  <div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-primary">Agregar Cita</button>
    </div>
  </div>
</form>

</div>
</div>
</section>
<script>
$(".pickadate2").pickadate(
  {
    format: 'yyyy-mm-dd',
    min: '<?php echo date('Y-m-d',time()-(24*60*60)); ?>',
 onSet: function(context) {
  if($("#medic_id").val()==""){
    alert("Debes seleccionar un medico!");
$('#time_at')
    .find('option')
    .remove()
    .end();
  }else{

$.get("./?action=gethours","medic_id="+$("#medic_id").val()+"&date_at="+$("#date_at").val(),function(data){
  $("#time_at").html(data);

  });


  }
//        console.log((data));
    }
  }
  );

$(document).ready(function(){

$("#category_id").change(function(){

$.get("./?action=getmedics","cat_id="+$("#category_id").val(),function(data){
  $("#medic_id").html(data);
  console.log(data);
  });


});

});

  </script>