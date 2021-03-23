<?php

if(isset($_GET["opt"]) && $_GET["opt"]=="add"){
	$user = new FileData();

	$img = new Upload($_FILES["name"]);
	if($img->uploaded){
		$img->Process("storage/pacient/$_POST[pacient_id]");
		if($img->processed){
			$user->name=$img->file_dst_name;
		}
	}
	$user->title = $_POST["title"];
	$user->description = $_POST["description"];
	$user->pacient_id = $_POST["pacient_id"];
	$user->doctype_id = $_POST["doctype_id"];
	$user->add();

	Core::alert("Agregado exitosamente!");
	Core::redir("./?view=pacient&id=$_POST[pacient_id]");

}
if(isset($_GET["opt"]) && $_GET["opt"]=="update"){

	$user = FileData::getById($_POST["id"]);

	$img = new Upload($_FILES["name"]);
	if($img->uploaded){
		$img->Process("storage/pacient/$user->pacient_id");
		if($img->processed){
			$user->name=$img->file_dst_name;
		}
	}

	$user->title = $_POST["title"];
	$user->description = $_POST["description"];
	$user->doctype_id = $_POST["doctype_id"];
	$user->update();
	Core::alert("Actualizado exitosamente!");
	Core::redir("./?view=pacient&id=$user->pacient_id");
}
if(isset($_GET["opt"]) && $_GET["opt"]=="del"){
	$f = FileData::getById($_GET["id"]);
	$f->del();
	Core::alert("Eliminado exitosamente!");
	Core::redir("./?view=pacient&id=$f->pacient_id");	

}
if(isset($_GET["opt"]) && $_GET["opt"]=="download"){
	$f = FileData::getById($_GET["id"]);
	$url = "storage/pacient/$f->pacient_id/$f->name";
	if(file_exists($url)){
		header("Content-disposition: attachment; filename=\"$f->name\"");
		readfile($url);
	}
}

?>