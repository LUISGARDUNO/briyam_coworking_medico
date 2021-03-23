<?php

if(count($_POST)>0){
	$user = new ScheduleData();
	$user->kind = $_POST["kind"];
	$user->start_date_at = $_POST["start_date_at"];
	$user->start_time_at = $_POST["start_time_at"];
	$user->finish_date_at = $_POST["finish_date_at"];
	$user->finish_time_at = $_POST["finish_time_at"];
	$user->n_repeat = $_POST["n_repeat"];
	$user->k_repeat = $_POST["k_repeat"];
	$user->medic_id = $_POST["medic_id"];
	$user->add();

print "<script>window.location='index.php?view=medicschedule&id=$_POST[medic_id]';</script>";


}


?>