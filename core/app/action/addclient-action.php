<?php

if(count($_POST)>0){
	$user = new PersonData();
  $alpha = "abcdefghijklmnopqrstuvwxyz".strtoupper("abcdefghijklmnopqrstuvwxyz")."1234567890-_";
  $code ="";
  for($i=0;$i<9;$i++){ $code.= $alpha[rand(0,strlen($alpha)-1)]; }

	$user->code = $_POST["code"];
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];
	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
	$user->list_id = $_POST["list_id"];
	$user->add();

print "<script>window.location='index.php?view=list&id=$_POST[list_id]';</script>";


}


?>