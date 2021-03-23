<?php

if(count($_POST)>0){
	$is_admin=0;
	if(isset($_POST["is_admin"])){$is_admin=1;}
	$is_active=0;
	if(isset($_POST["is_active"])){$is_active=1;}
	$user = UserData::getById($_POST["user_id"]);
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->username = $_POST["username"];
	$user->email = $_POST["email"];
	$user->is_admin=$is_admin;
	$user->is_active=$is_active;



	$user->view_reports= isset($_POST["view_reports"])?1:0;

	$user->view_users= isset($_POST["view_users"])?1:0;
	$user->edit_users= isset($_POST["edit_users"])?1:0;

	$user->view_pacients= isset($_POST["view_pacients"])?1:0;
	$user->edit_pacients= isset($_POST["edit_pacients"])?1:0;

	$user->view_medics= isset($_POST["view_medics"])?1:0;
	$user->edit_medics= isset($_POST["edit_medics"])?1:0;

	$user->view_reservations= isset($_POST["view_reservations"])?1:0;
	$user->edit_reservations= isset($_POST["edit_reservations"])?1:0;

	$user->update();

	if($_POST["password"]!=""){
		$user->password = sha1(md5($_POST["password"]));
		$user->update_passwd();
print "<script>alert('Se ha actualizado el password');</script>";

	}
Core::alert("Actualizado!");
print "<script>window.location='index.php?view=users';</script>";


}


?>