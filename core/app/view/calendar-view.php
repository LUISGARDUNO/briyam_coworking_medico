<?php if(!Core::$user->view_reservations){ Core::redir("./?view=home"); } ?>

<section class="content">

<div class="row">
<div style="font-family: Montserrat Regural,'Century Ghotic';" class="col-md-12">
<h1>Calendario</h1>

<div class="container">
        <div class="calendly-inline-widget" data-url="https://calendly.com/luisbriyam/reservar-consulta"
            style="min-width: 70px; height: 70rem"></div>
        <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
    </div>
</div>
</div>
<!-- <div class="box box-primary">
<div class="box-body">
<script>

  $("#filterreservation").submit(function(e){
    e.preventDefault();
      console.log("xxxx");
    $.get("./?action=filterreservation",$("#filterreservation").serialize(),function(data){
      console.log(data);
      $(".dataload").html(data);
    });
  });

  $(document).ready(function(){
    $.get("./?action=filterreservation","",function(data){
      console.log(data);
      $(".dataload").html(data);
    });
  });

</script>

<div class="clearfix"></div>
<br>

<div class="dataload">

</div> -->
<div><button class="btn btn-success btn-block">Terminar de Reservar</button></div>
</div>
</div>

</div>
</div>
</section>

<!--Client ID 544009176002-hf31dm8mfdql54bdf7nttmunt6a6236n.apps.googleusercontent.com -->
<!--clien secret kKD58nn0pN4nWNSsX6PO1yCG -->

<!--Api KEY AIzaSyCCLcMWFO77mqsg13SL0Tc5Ur5iVlzoLtI -->
