<?php
$rx = ReservationData::getRepeated($_POST["pacient_id"],$_SESSION["medic_id"],$_POST["date_at"],$_POST["time_at"]);
if($rx==null){
$r = new ReservationData();
$r->no="";
$r->title = $_POST["title"];
$r->note = $_POST["note"];
$r->pacient_id = $_POST["pacient_id"];
$r->medic_id = $_SESSION["medic_id"];
$r->date_at = $_POST["date_at"];
$r->time_at = $_POST["time_at"];
$r->user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:"NULL";

$r->status_id = $_POST["status_id"];
$r->payment_id = $_POST["payment_id"];
$r->price = $_POST["price"];
$r->sick = $_POST["sick"];
$r->symtoms = $_POST["symtoms"];
$r->medicaments = $_POST["medicaments"];


$r->add();






//////////////////////////////////////////////////////////////////////////////////////////
$email_user = Core::$smtp_email; //
$email_password = Core::$smtp_password;
// Email para el medico

$medic = MedicData::getById($_SESSION["medic_id"]);
$pacient = PacientData::getById($_POST["pacient_id"]);

if($medic->email!=""&& $email_user!="" && $email_password!=""){
$the_subject = "Nueva cita para el medico - Sistema de Citas Medicas";
$address_to = $medic->email;//"evilnapsis@gmail.com";
$from_name = $pacient->name." ".$pacient->lastname;//"Evilnapsis";
$phpmailer = new PHPMailer();
// ---------- datos de la cuenta de Gmail -------------------------------
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//-----------------------------------------------------------------------
// $phpmailer->SMTPDebug = 1;
$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = "smtp.gmail.com"; // GMail
$phpmailer->Port = 465;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;
$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->Subject = $the_subject;	
$phpmailer->Body .="<h1 style='color:#3498db;'>Nueva cita!</h1>";
$phpmailer->Body .= "<p>Nombre: Se ha registrado una nueva cita para el medico, a continuacion los datos. </p>";

$phpmailer->Body .="<h3 style='color:#3498db;'>DATOS DEL MEDICO</h3>";
$phpmailer->Body .= "<p>Nombre: ".$medic->name." ".$medic->lastname." </p>";

$phpmailer->Body .="<h3 style='color:#3498db;'>DATOS DEL PACIENTE</h3>";
$phpmailer->Body .= "<p>Nombre: ".$pacient->name." ".$pacient->lastname." </p>";
$phpmailer->Body .= "<p>Telefono: ".$pacient->phone." </p>";
$phpmailer->Body .= "<p>Email: ".$pacient->email." </p>";
$phpmailer->Body .="<h3 style='color:#3498db;'>DATOS DE LA CITA</h3>";

$phpmailer->Body .= "<p>Asunto: ".$_POST["title"]." </p>";
$phpmailer->Body .= "<p>Fecha: ".$_POST["date_at"]." </p>";
$phpmailer->Body .= "<p>Hora: ".$_POST["time_at"]." </p>";

$phpmailer->IsHTML(true);
$phpmailer->Send();
}

if($pacient->email!=""&& $email_user!="" && $email_password!=""){
$the_subject = "Confirmacion de cita para el paciente - Sistema de Citas Medicas";
$address_to = $pacient->email;//"evilnapsis@gmail.com";
$from_name = $medic->name." ".$medic->lastname;//"Evilnapsis";
$phpmailer = new PHPMailer();
// ---------- datos de la cuenta de Gmail -------------------------------
$phpmailer->Username = $email_user;
$phpmailer->Password = $email_password; 
//-----------------------------------------------------------------------
// $phpmailer->SMTPDebug = 1;
$phpmailer->SMTPSecure = 'ssl';
$phpmailer->Host = "smtp.gmail.com"; // GMail
$phpmailer->Port = 465;
$phpmailer->IsSMTP(); // use SMTP
$phpmailer->SMTPAuth = true;
$phpmailer->setFrom($phpmailer->Username,$from_name);
$phpmailer->AddAddress($address_to); // recipients email
$phpmailer->Subject = $the_subject;	
$phpmailer->Body .="<h1 style='color:#3498db;'>Nueva cita!</h1>";
$phpmailer->Body .= "<p>Nombre: Se ha registrado una nueva cita para el paciente, a continuacion los datos. </p>";


$phpmailer->Body .="<h3 style='color:#3498db;'>DATOS DEL PACIENTE</h3>";
$phpmailer->Body .= "<p>Nombre: ".$pacient->name." ".$pacient->lastname." </p>";
$phpmailer->Body .= "<p>Telefono: ".$pacient->phone." </p>";
$phpmailer->Body .= "<p>Email: ".$pacient->email." </p>";
$phpmailer->Body .="<h3 style='color:#3498db;'>DATOS DEL MEDICO</h3>";
$phpmailer->Body .= "<p>Nombre: ".$medic->name." ".$medic->lastname." </p>";

$phpmailer->Body .="<h3 style='color:#3498db;'>DATOS DE LA CITA</h3>";
$phpmailer->Body .= "<p>Asunto: ".$_POST["title"]." </p>";
$phpmailer->Body .= "<p>Fecha: ".$_POST["date_at"]." </p>";
$phpmailer->Body .= "<p>Hora: ".$_POST["time_at"]." </p>";

$phpmailer->IsHTML(true);
$phpmailer->Send();
}
//////////////////////////////////////////////////////////////////////////////////////////




Core::alert("Agregado exitosamente!");
}else{
Core::alert("Error al agregar, Cita Repetida!");
}
Core::redir("./index.php?view=medicreservations");
?>