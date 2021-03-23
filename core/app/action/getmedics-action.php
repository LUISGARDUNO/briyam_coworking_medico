<?php
$medics = MedicData::getAllByCategoryId($_GET["cat_id"]);

$mediccats = MedicCategoryData::getAllByCategory($_GET["cat_id"]);



foreach($mediccats as $mc){
	$medic  = MedicData::getById($mc->medic_id);

	array_push($medics, $medic);

}

$medics2 = array();
foreach($medics as $m){
	// Si medic2 es cero
	if(count($medics2)==0){
		$medics2[] = $m;
	}else{ // Si es mayor que cero


		if(!in_array($m, $medics2)){
			$medics2[] = $m;	
		}

	}


}


?>
<option value=""> -- SELECCIONE MEDICO (<?php echo count($medics2); ?>) --</option>
<?php foreach($medics2 as $m):?>
<option value="<?php echo $m->id; ?>"><?php echo $m->no; ?> - <?php echo $m->name; ?> <?php echo $m->lastname; ?></option>
<?php endforeach; ?>