<!-- 493039597077-lu2jhfoav73n72k47hdc9kt2i7bu23sc.apps.googleusercontent.com -->
<!-- piXoBZExEicLUhhTbmFxYvhL -->

<!-- Calendar 2 Original  -->
<?php if(!Core::$user->view_reservations){ Core::redir("./?view=home"); } ?>
<?php
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
?>
<section class="content">

<div class="row">
<div class="col-md-12">
<h1>Calendario por dia</h1>


<div class="box box-primary">
<div class="box-body">
<script>
  $("#filterreservation").submit(function(e){
    e.preventDefault();
      console.log("xxxx");
    $.get("./?action=filterreservation",$("#filterreservation").serialize(),function(data){
      $(".dataload").html(data);
    });
  });

  $(document).ready(function(){
    $.get("./?action=filterreservation","",function(data){
      $(".dataload").html(data);
    });
  });

</script>

<div class="clearfix"></div>
<br>

<div id="calendar2">
</div>

</div>
</div>

</div>
</div>
</section>
<?php
$events = ReservationData::getPendings2();
$thejson = array();
for($ix=0;$ix<7;$ix++){
 // echo "|||||||";
//echo $ix;  
//  echo "|||||||";
  $day = date('Y-m-d',strtotime($now)+(60*60*24*$ix));
 // echo "|||||||";
$n2= date('N',strtotime($day));

foreach(MedicData::getAll() as $m){
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
}
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
  $color = "#c0392b";
  if($event->status_id==2){ $color = "#2980b9"; }
  $thejson[] = array("resourceId"=> 'medic'.$medic->id,"title"=>$pacient->name." ".$pacient->lastname." - ".$event->title." - ".$medic->name." ".$medic->lastname,"url"=>"./?view=editreservation&id=".$event->id,"start"=>$event->date_at."T".$event->time_at,"end"=>$event->date_at."T".date('H:i:s', $newtimestamp),"color"=>$color);

}
//
?>
<script>
  $(function() { // document ready

    $('#calendar2').fullCalendar({
      defaultView: 'agendaDay',
      defaultDate: '<?php echo $now;?>',
      editable: true,
      selectable: true,
      eventLimit: true, // allow "more" link when too many events
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaDay'
      },
      views: {
        agendaTwoDay: {
          type: 'agenda',
          duration: { days: 2 },

          // views that are more than a day will NOT do this behavior by default
          // so, we need to explicitly enable it
          groupByResource: true

          //// uncomment this line to group by day FIRST with resources underneath
          //groupByDateAndResource: true
        }
      },

      //// uncomment this line to hide the all-day slot
      //allDaySlot: false,

      resources: [
      <?php foreach(MedicData::getAll() as $m):?>
        { id: 'medic<?php echo $m->id; ?>', title: '<?php echo $m->name; ?> <?php echo $m->lastname; ?>' },
      <?php endforeach; ?>
      ],
      events: <?php echo json_encode($thejson); ?>,

      select: function(start, end, jsEvent, view, resource) {
        console.log(
          'select',
          start.format(),
          end.format(),
          resource ? resource.id : '(no resource)'
        );
      },
      dayClick: function(date, jsEvent, view, resource) {
        console.log(
          'dayClick',
          date.format(),
          resource ? resource.id : '(no resource)'
        );
      }
    });
  
  });

</script>