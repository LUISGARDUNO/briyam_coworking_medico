<?php


if($_GET["href"]!=""&& $_GET["cco"]!=""&& $_GET["ccl"]!=""){
	$campain = CampainData::getByCode($_GET["cco"]);
	$person = PersonData::getByCode($_GET["ccl"]);

	$entry = new EntryData();
	$entry->href = $_GET["href"];
	$entry->campain_id= $campain->id;
	$entry->person_id = $person->id;
	$entry->add();

	if($_GET["href"]==1){
		Core::redir($campain->url1);
	}else if($_GET["href"]==2){
		Core::redir($campain->url2);		
	}
}



?>