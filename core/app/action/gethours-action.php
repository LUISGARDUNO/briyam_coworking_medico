<?php 
//print_r($_GET);
$medic = MedicData::getById($_GET["medic_id"]);
//print_r($medic);
$k = date('N',strtotime($_GET['date_at']));
//echo $k;
$datax = $medic->{'time'.$k.'_data'};
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

$n = date("N",strtotime($_GET["date_at"]));

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
foreach($hours as $h):
$exist = ReservationData::getByMDT($_GET["medic_id"],$_GET["date_at"],$h);

if($exist==null):
	?>

<option value="<?php echo $h; ?>"><?php echo $h; ?></option>
<?php endif; ?>
<?php endforeach; ?>