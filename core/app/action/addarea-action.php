<?php

$medic = MedicData::getById($_POST["medic_id"]);

if($medic->category_id!=$_POST["category_id"]){

	$mc = MedicCategoryData::getByMC($_POST["medic_id"], $_POST["category_id"]);

	if($mc==null){
		$mc = new MedicCategoryData();
		$mc->medic_id = $medic->id;
		$mc->category_id = $_POST["category_id"];
		$mc->add();
		Core::alert("Agregado exitosamente!");

	}else{
		Core::alert("No puedes repetir area!");
	}

}else{

	Core::alert("No puedes repetir area!");
}
Core::redir("./?view=editmedic&id=".$medic->id);

?>