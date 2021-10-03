<?php

require_once ('../vendor/autoload.php');

use model\Prenotazione;

/** Error reporting */
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

$prenotazione = new Prenotazione();


/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
//use excel\PHPExcel;

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Verdegufo")
							 ->setLastModifiedBy("Verdegufo")
							 ->setTitle("Elenco prenotazioni")
							 ->setSubject("Elenco prenotazioni")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "Denominazione/Cognome Nome")
            ->setCellValue('B1', "Partita IVA")
            ->setCellValue('C1', "Codice Fiscale")
            ->setCellValue('D1', "Tip.Utente")
			->setCellValue('E1', "Telefono")
			->setCellValue('F1', "Utenza")
			->setCellValue('G1', "Targa");
			
			
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(60);				
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);			
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);		
			
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setWrapText(true);			
			
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			),
			'borders' => array(
				'top'     => array(
 					'style' => PHPExcel_Style_Border::BORDER_THIN
 				)
			),
			'fill' => array(
	 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
	  			'rotation'   => 90,
	 			'startcolor' => array(
	 				'argb' => 'FFA0A0A0'
	 			),
	 			'endcolor'   => array(
	 				'argb' => 'FFFFFFFF'
	 			)
	 		)
		)
);			

$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$riga = 2;
foreach ($listAziende as $key => $azienda) {
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$riga,$azienda->denominazione);
	$objPHPExcel->getActiveSheet()->setCellValueExplicit('B'.$riga,$azienda->partitaIVA, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->setCellValueExplicit('C'.$riga,$azienda->codiceFiscale, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$riga,$azienda->descTipologiaUtente, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$riga,$azienda->telefono, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$riga,$azienda->email, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$riga,$azienda->targa, PHPExcel_Cell_DataType::TYPE_STRING);
	$riga++;
}	



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Elenco aziende');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="aziende.xlsx"');

// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save('php://output');