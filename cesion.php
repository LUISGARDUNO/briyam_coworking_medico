<?php
setlocale(LC_CTYPE, 'es_MX');

include "core/controller/Core.php";
include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Model.php";

include "core/app/model/PacientData.php";
include "fpdf/fpdf.php";

session_start();

$pacient = PacientData::getById($_GET["id"]);

$pdf = new FPDF($orientation='P');

$pdf->AddPage();
$pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
//$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);

//$pdf->SetFont('DejaVu','',8);

// $textypos = 11+$plusforimage;
$pdf->setY(2);
$pdf->setX(10);
$pdf->SetFont('Arial','B',20);    //Letra Arial, negrita (Bold), tam. 20
$pdf->Cell(5,20,strtoupper("BOOKMEDIK PRO"));
$pdf->SetFont('Arial','B',14);    //Letra Arial, negrita (Bold), tam. 20
$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,56,'CESION DE DATOS' );
$pdf->SetFont('Arial','B',12);    //Letra Arial, negrita (Bold), tam. 20

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,76,'BIENVENIDO/A:' );
$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,86,'A fin de evitar errores de transcripcion y conocer mejor sus necesidades, le' );
$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,96,'rogamos que rellene este formulario para la inclusion de sus datos personales en' );
$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,106,'nuestro fichero de pacientes, (por favor escriba en mayusculas).' );

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130,'NOMBRE: '.strtoupper($pacient->name." ".$pacient->lastname) );
$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+15,'DIRECCION: '.strtoupper($pacient->address) );

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+30,'CODIGO POSTAL: '.strtoupper($pacient->cp)."               POBLACION: ".strtoupper($pacient->pob) );

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+45,'FECHA DE NACIMIENTO: '.date("d/m/Y",strtotime($pacient->day_of_birth))."               DNI: ".$pacient->no );

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+60,'TELEFONO MOVIL: '.strtoupper($pacient->phone) );

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+75,'CORREO ELECTRONICO : '.strtoupper($pacient->email) );


$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+110,'Acepto que ROOMT STAR FITNESS S.L. trate mis datos de caracter personal para el' );

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+120,'tratamiento de mis datos de salud, asi mismo doy el consentimiento para que me puedan' );

$pdf->setY(2);
$pdf->setX(10);
$pdf->Cell(5,130+130,'informar sobre productos y servicios de la empresa que puedan ser de mi interes.' );

$pdf->setY(150);
$pdf->setX(10);
$pdf->Cell(5,0,'FIRMADO EL DIA __ / __ / __  POR __________________________________________.' );



$pdf->output();
