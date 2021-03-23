<?php

// define('LBROOT',getcwd()); // LegoBox Root ... the server root
// include("core/controller/Database.php");
if(!isset($_SESSION["pacient_id"])) {
$user = $_POST['username'];
$pass = $_POST['password'];

$base = new Database();
$con = $base->connect();
 $sql = "select * from medic where (((email= \"".$user."\") and password= \"".$pass."\") or ((no= \"".$user."\") and password= \"".$pass."\")) and (email!=\"\" and password!=\"\") and is_active=1";
//print $sql;
$query = $con->query($sql);
$found = false;
$userid = null;
while($r = $query->fetch_array()){
	$found = true ;
	$userid = $r['id'];
}

if($found==true) {
//	session_start();
//	print $userid;
	$_SESSION['medic_id']=$userid ;
//	setcookie('userid',$userid);
//	print $_SESSION['userid'];
	print "Cargando ... $user";
	print "<script>window.location='index.php?view=medichome';</script>";
}else {
	print "<script>window.location='index.php?view=mediclogin';</script>";
}

}else{
	print "<script>window.location='./';</script>";
	
}
?>