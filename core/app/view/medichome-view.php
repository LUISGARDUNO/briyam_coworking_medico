<?php
//print_r($_SESSION);
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
$n = date('N',strtotime($now));
$m = MedicData::getById($_SESSION["medic_id"]);

$thejson = array();
for($ix=0;$ix<7;$ix++){
 // echo "|||||||";
//echo $ix;  
//  echo "|||||||";
  $day = date('Y-m-d',strtotime($now)+(60*60*24*$ix));
 // echo "|||||||";
$n2= date('N',strtotime($day));

//foreach(MedicData::getAll() as $m){
$datax = $m->{'time'.$n2.'_data'};
$datax = htmlspecialchars_decode($datax);
$datax = unserialize($datax);
//print_r($datax);
//print_r($medic);
//$start1 = "8:00:00";
//$end1 = "14:00:00";
$start1 = $datax['time1_start'];//"8:00:00";
$end1 = $datax['time1_finish'];//"14:00:00";

//$start2 = "14:30:00";
//$end2 = "20:00:00";
$start2 = $datax['time2_start'];//"8:00:00";
$end2 = $datax['time2_finish'];//"14:00:00";
$duration = $datax['duration'];
$hours  = array();
if($datax["time_active"]==1){
if($n>=1&$n<=7){
  for($i=strtotime($start1);$i<=strtotime($end1);$i+=60*$duration){
    $hours[] = date("H:i:s",$i);
  }
}

if($n>=1&$n<=7){
  for($i=strtotime($start2);$i<=strtotime($end2);$i+=60*$duration){
    $hours[] = date("H:i:s",$i);
  }
}
}
foreach($hours as $h){
$exist = ReservationData::getByMDT($m->id,$day,$h);

if($exist==null){
   $strtoco = "$h + ".$datax["duration"]." minute";
$newtimestamp = strtotime($strtoco);
   $thejson[] = array("resourceId"=> 'medic'.$m->id,"title"=>"Libre","url"=>"","start"=>$day."T".$h,"end"=>$day."T".date('H:i:s', $newtimestamp),"color"=>"#27ae60");


}

}
//}
}



?>




<section class="content">
<?php
// $thejson = null;
/*
$events = ReservationData::getEveryByMedicId($_SESSION["medic_id"]);
foreach($events as $event){
	$thejson[] = array("title"=>$event->title,"start"=>$event->date_at."T".$event->time_at);
}*/
 //print_r(json_encode($thejson));


//  $medic = $event->getMedic();
$events = ReservationData::getEveryByMedicId($_SESSION["medic_id"]);
//print_r($events);
  $medic = $m;
foreach($events as $event){

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
  $color = "#c0392b";
  if($event->status_id==2){ $color = "#2980b9"; }
  $thejson[] = array("resourceId"=> 'medic'.$medic->id,"title"=>$pacient->name." ".$pacient->lastname." - ".$event->title." - ".$medic->name." ".$medic->lastname,"url"=>"./?view=editreservation&id=".$event->id,"start"=>$event->date_at."T".$event->time_at,"end"=>$event->date_at."T".date('H:i:s', $newtimestamp),"color"=>$color);

}
//echo "////////////////////////////////////////////////////////";
//print_r($thejson);
//echo "////////////////////////////////////////////////////////";
?>

<script>


	$(document).ready(function() {

		$('#calendar').fullCalendar({
				buttonText: {
					today:    'hoy',
					month:    'mes',
					week:     'semana',
					day:      'día',
				},		
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				weekends: false,
				editable: false,
				eventLimit: true,
				dayNamesShort: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				monthNamesShort: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],				
				defaultView: 'agendaWeek',
				nowIndicator: true,
				schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
				minTime: "07:30",
				maxTime: "22:00",
				height: 720,
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
</section>