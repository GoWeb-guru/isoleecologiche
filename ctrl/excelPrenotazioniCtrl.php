<?php

require_once ('../vendor/autoload.php');

use model\Prenotazione;

/** Error reporting */
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

$prenotazione = new Prenotazione();

//$listPrenotazioni = $prenotazione->leggiPrenotazioniConsorzio();

//Prenotazione::setPrenotazioneDaBozzaARichiestaBatch();


/** Include PHPExcel */
//require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';
//use excel\PHPExcel;

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$htmlHelper = new PHPExcel_Helper_HTML();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Verdegufo")
							 ->setLastModifiedBy("Verdegufo")
							 ->setTitle("Elenco prenotazioni rifiuti assimilati")
							 ->setSubject("Elenco prenotazioni rifiuti assimilati")
							 ->setDescription("")
							 ->setKeywords("")
							 ->setCategory("");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', "Identificativo")
            ->setCellValue('B1', "Data Prenotazione")
            ->setCellValue('C1', "Utenza")
			->setCellValue('D1', "Denominazione/Cognome Nome")
			->setCellValue('E1', "Telefono")
			->setCellValue('F1', 'Email')
			->setCellValue('G1', 'Rifiuto')
			->setCellValue('H1', "Partita IVA/Cod.Fis.")
			->setCellValue('I1', "Sede Azienda")
			->setCellValue('J1', "Centro di raccolta")
			->setCellValue('K1', "Targa")
			->setCellValue('L1', "Quantità")
			->setCellValue('M1', 'Data richiesta')
			->setCellValue('N1', 'Stato')
			->setCellValue('O1', 'Denominazione Intermediario')
			->setCellValue('P1', 'Identificativo Intermediario')
			->setCellValue('Q1', 'Codici Cer');;
			
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);				
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(28);				
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);				
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(65);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(28);
$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
		
$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->getAlignment()->setWrapText(true);			
			
$objPHPExcel->getActiveSheet()->getStyle('A1:Q1')->applyFromArray(
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
foreach ($listPrenotazioni as $key => $prenotazione) {
	//$numRifiuti=$prenotazione->prettyRifiuti(PHP_EOL);
	$numRifiuti=$prenotazione->prettyRifiuti('<BR>');
	$objPHPExcel->getActiveSheet()->setCellValue('A'.$riga,$prenotazione->idPrenotazione);
	
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$riga,$prenotazione->dataPrenotazione." ".$prenotazione->descFasciaOraria);
	$objPHPExcel->getActiveSheet()->getStyle('B'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$riga,$prenotazione->azienda->descTipologiaUtente);
	
	
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$riga,$prenotazione->azienda->denominazione);
	$objPHPExcel->getActiveSheet()->getStyle('D'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$riga,$prenotazione->azienda->telefono, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$riga,$prenotazione->azienda->email, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->getStyle('F'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	
	$objPHPExcel->getActiveSheet()->setCellValueExplicit('G'.$riga,$htmlHelper->toRichTextObject($prenotazione->descRifiuti).PHP_EOL.$prenotazione->note, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$riga)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('G'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	
	

	$objPHPExcel->getActiveSheet()->setCellValueExplicit('H'.$riga,$prenotazione->azienda->partitaIVA.PHP_EOL.$prenotazione->azienda->codiceFiscale, PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->getStyle('H'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$riga,$prenotazione->sede->comuneSede);
	$objPHPExcel->getActiveSheet()->getStyle('I'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	
	
	$temp='';
	if ($prenotazione->centroRaccolta->idCentroRaccolta==1) {
		$temp=' Mussotto';	
	}
	if ($prenotazione->centroRaccolta->idCentroRaccolta==2) {
		$temp=' - Via Ognissanti';	
	}
	if ($prenotazione->centroRaccolta->idCentroRaccolta==3) {
		$temp=' - Corso Monviso';	
	}
	
	//$objPHPExcel->getActiveSheet()->setCellValue('J'.$riga,$prenotazione->centroRaccolta->nomeCentro.PHP_EOL.$temp.PHP_EOL.$prenotazione->centroRaccolta->indirizzo);
	if ($temp!='')
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$riga,$prenotazione->centroRaccolta->nomeCentro.$temp);
	else 
		$objPHPExcel->getActiveSheet()->setCellValue('J'.$riga,$prenotazione->centroRaccolta->nomeCentro);
	$objPHPExcel->getActiveSheet()->getStyle('J'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$riga,$prenotazione->targaStorico);
	$objPHPExcel->getActiveSheet()->getStyle('K'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

	$objPHPExcel->getActiveSheet()->setCellValue('L'.$riga,$prenotazione->quantita);
	$objPHPExcel->getActiveSheet()->getStyle('L'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

	$objPHPExcel->getActiveSheet()->setCellValue('M'.$riga,$prenotazione->data);
	$objPHPExcel->getActiveSheet()->getStyle('M'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	
	
	

	
	
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$riga,$prenotazione->descStato);
	$objPHPExcel->getActiveSheet()->getStyle('N'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	if ($prenotazione->idStato==2) {
		//evasa
		$objPHPExcel->getActiveSheet()->getStyle('N'.$riga.':N'.$riga)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F28F1C');
	}
	if ($prenotazione->idStato==3) {
		//respinta
		$objPHPExcel->getActiveSheet()->getStyle('N'.$riga.':N'.$riga)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('eb5127');
	}
	if ($prenotazione->idStato==4 || $prenotazione->idStato==5) {
		//evasa
		$objPHPExcel->getActiveSheet()->getStyle('N'.$riga.':N'.$riga)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('4eac5a');
	}


	$objPHPExcel->getActiveSheet()->setCellValue('O'.$riga,$prenotazione->identificativoIntermediarioStorico);
	$objPHPExcel->getActiveSheet()->getStyle('O'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	
	$objPHPExcel->getActiveSheet()->setCellValue('P'.$riga,$prenotazione->denominazioneIntermediarioStorico);
	$objPHPExcel->getActiveSheet()->getStyle('P'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

	$objPHPExcel->getActiveSheet()->setCellValueExplicit('Q'.$riga,$htmlHelper->toRichTextObject($prenotazione->codiciCer), PHPExcel_Cell_DataType::TYPE_STRING);
	$objPHPExcel->getActiveSheet()->getStyle('Q'.$riga)->getAlignment()->setWrapText(true);
	$objPHPExcel->getActiveSheet()->getStyle('Q'.$riga)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
	

	if ($numRifiuti==1)
		$objPHPExcel->getActiveSheet()->getRowDimension($riga)->setRowHeight(23);
	else
		$objPHPExcel->getActiveSheet()->getRowDimension($riga)->setRowHeight(15*$numRifiuti);
	$riga++;
}	





// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Elenco prenotazioni');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// We'll be outputting an excel file
header('Content-type: application/vnd.ms-excel');

// It will be called file.xls
header('Content-Disposition: attachment; filename="prenotazioniRifiutiAssimilati.xlsx"');

// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save('php://output');