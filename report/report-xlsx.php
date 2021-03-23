<?php

/** Error reporting */
include "../core/autoload.php";
include "../core/app/model/ReservationData.php";
include "../core/app/model/PacientData.php";
include "../core/app/model/MedicData.php";
include "../core/app/model/StatusData.php";
include "../core/app/model/PaymentData.php";
session_start();

include "../vendor/autoload.php";

/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
//require_once '../core/controller/PHPExcel/Classes/PHPExcel.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//require __DIR__ . '/../Header.php';

//$spreadsheet = new Spreadsheet();
// Create new PHPExcel object
$objPHPExcel = new Spreadsheet();
//$products = ProductData::getAll();
$products = $_SESSION["report_data"];

// Set document properties
$objPHPExcel->getProperties()->setCreator("BookMedik Pro v5.1")
							 ->setLastModifiedBy("BookMedik Pro v5.1")
							 ->setTitle("Products - BookMedik Pro v5.1")
							 ->setSubject("BookMedik Pro Citas Report")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");


// Add some data
$sheet = $objPHPExcel->setActiveSheetIndex(0);

$sheet->setCellValue('A1', 'Reporte de Citas - BookMedik Pro')
->setCellValue('A4', 'Id')
->setCellValue('B4', 'Asunto')
->setCellValue('C4', 'Paciente')
->setCellValue('D4', 'Medico')
->setCellValue('E4', 'Fecha')
->setCellValue('F4', 'Precio')
->setCellValue('G4', 'Estado');

$start = 5;
foreach($products as $product){
		$medic = $product->getMedic();
	$pacient = $product->getPacient();
$sheet->setCellValue('A'.$start, $product->id)
->setCellValue('B'.$start, $product->title)
->setCellValue('C'.$start, $pacient->name." ".$pacient->lastname)
->setCellValue('D'.$start, $medic->name." ".$medic->lastname)
->setCellValue('E'.$start, $product->date_at." ".$product->time_at)
->setCellValue('F'.$start, "$ ".$product->price)
->setCellValue('G'.$start, $product->getStatus()->name);
$start++;
}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


//$sheet->setCellValue('A5', 'Hello World !');
////////////////////////////////////////////////////
  // Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reservations-'.time().'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
//////////////////////////////////////////////////////
$writer = new Xlsx($objPHPExcel);
$writer->save('php://output');

