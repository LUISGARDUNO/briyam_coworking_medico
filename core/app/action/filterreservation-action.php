<?php
// $users=UserData::getAll()();
// $pacients = PacientData::getAll();
// $medics = MedicData::getAll();

// $statuses = StatusData::getAll();
// $payments = PaymentData::getAll();

/// get the current date from databe
$base = new Database();
$con = $base->connect();
$sql = "select date(NOW()) as now";
$query = $con->query($sql);
$now = null;
while($r = $query->fetch_array()){
	$found = true ;
	$now = $r['now'];
}
?>

<section class="content">
    <?php
$thejson = null;

$events = null;
if(isset($_GET["medic_id"]) && $_GET["medic_id"]!="" && isset($_GET["status_id"]) && $_GET["status_id"]!=""){
$events = ReservationData::getAllByMedicIdS($_GET["medic_id"],$_GET["status_id"]);

}else{
$events = ReservationData::getPendings();
}

foreach($events as $event){
	$medic = $event->getMedic();

$k = date('N',strtotime($event->date_at));

$datax = $medic->{'time'.$k.'_data'};

$datax = htmlspecialchars_decode($datax);

$datax = unserialize($datax);
//echo "---------------";
 $strtoco = "$event->time_at + ".$datax["duration"]." minute";
$newtimestamp = strtotime($strtoco);
//echo "---------------";
//$newtimestamp = strtotime($strtoco);


	$pacient = $event->getPacient();
	$thejson[] = array("title"=>$pacient->name." ".$pacient->lastname." - ".$event->title." - ".$medic->name." ".$medic->lastname,"url"=>"./?view=editreservation&id=".$event->id,"start"=>$event->date_at."T".$event->time_at,"end"=>$event->date_at."T".date('H:i:s', $newtimestamp));

}
// print_r(json_encode($thejson));

?>
    <script>
    $(document).ready(function() {

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
            ],
            monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
                'Nov', 'Dic'
            ],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
            defaultDate: '<?php echo $now;?>',
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            events: <?php echo json_encode($thejson); ?>,
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                //var title = prompt('Event Title:');
                $('#myModal').modal('show');
                // ---------------------Cambios ----------------------------------------------------
                var date_at = document.getElementById("date_at");
                date_at.value = moment(start).format('YYYY-MM-DD');
                time_at.value = moment(start).format('HH:mm');
                $('#start').val(start);
                $('#end').val(end);
                // $('#allDay').val(allDay);
                //--------------------------------------------------------------------------------------

                //    console.log(moment(end).format('YYYY-MM-DD'));
                $('#newquickreservationform').submit(function(e) {
                    e.preventDefault();
                    if (date_at.value != "") {
                        calendar.fullCalendar('renderEvent', {
                                start: date_at.value + "T" + time_at
                                    .value //moment($('#start').val()),
                                //end: moment($('#end').val())
                            },
                            true // make the event "stick"
                        );
                        jQuery.post(
                            "./?action=addreservation" // your url
                            , $("#newquickreservationform").serialize()
                        );

                        calendar.fullCalendar('unselect');
                        $('#myModal').modal('hide');
                    }

                });
                console.log(allDay);
                /*if (title) {
                 }
                 */
            }

        });

    });
    </script>

    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Agregar Reserva</h4>
                </div>
                <div class="modal-body">

                    <form class="form-horizontal" role="form" id="newquickreservationform">
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Fecha/Hora</label>
                            <div class="col-lg-5">
                                <input type="date" name="date_at" id="date_at" class="pickadate form-control"
                                    id="inputEmail1" placeholder="Fecha">
                            </div>
                            <div class="col-lg-5">
                                <input type="time" name="time_at" id="time_at" class="pickatime form-control"
                                    id="inputEmail1" placeholder="Hora">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Nota</label>
                            <div class="col-lg-10">
                                <textarea class="form-control" name="note" id="note" placeholder="Nota"></textarea>
                            </div>
                        </div>

                        <input type="hidden" name="sick" value="">
                        <input type="hidden" name="symtoms" value="">
                        <input type="hidden" name="medicaments" value="">

                        <!-- <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado de la cita</label>
    <div class="col-lg-10">
<select name="status_id" class="form-control" >
  <?php foreach($statuses as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail1" class="col-lg-2 control-label">Estado del pago</label>
    <div class="col-lg-10">
<select name="payment_id" class="form-control">
  <?php foreach($payments as $p):?>
    <option value="<?php echo $p->id; ?>"><?php echo $p->name; ?></option>
  <?php endforeach; ?>
</select>
    </div>
  </div> -->

                        <div class="form-group">
                            <label for="inputEmail1" class="col-lg-2 control-label">Costo</label>
                            <div class="col-lg-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                    <input type="hidden" id="start">
                                    <input type="hidden" id="end">
                                    <input type="hidden" id="allDay">
                                    <input type="text" class="form-control" name="price" placeholder="Costo">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary btn-block">Agregar Reserva</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="calendar"></div>