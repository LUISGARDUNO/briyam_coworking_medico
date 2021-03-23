<?php

if(count($_POST)>0){
	$user = new CampainListData();
	$user->campain_id = $_POST["campain_id"];
	$user->list_id = $_POST["list_id"];
	$user->add();

	// una vez que agregamos una lista a la campania, asignamos el status listo

	$camp = CampainData::getById($_POST["campain_id"]);
	$camp->status_id=2; // listo
	$camp->update_status();

print "<script>window.location='index.php?view=campainlists&id=$_POST[campain_id]';</script>";


}


?>