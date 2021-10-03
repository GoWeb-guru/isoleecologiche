<?php
ob_start();

require_once ('commonCtrl.php');

use util\FPDF,util\PDF, model\Prenotazione, model\Sede, model\Rifiuto, model\DataPrenotazione;
use util\URL, util\Dates;



	$prenotazione = new Prenotazione();

	$interlinea=8;
	$interlineaPar=5;
	$interlineaAvv=7;
	$larghLinea=160;

	$pdf = new PDF('SCHEDA RIFIUTI CONFERITI AL CENTRO DI RACCOLTA ', 2);

	$pdf->SetLeftMargin(25);
	
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',11);
	$pdf->Ln();
	

	$numItems = count($listPrenotazioni);
	$i = 0;

	foreach ($listPrenotazioni as $key => $prenotazione) {

		$pdf->Ln(5);

		// Tabella iniziale
		$pdf->SetFont('Arial','', 10);
		$pdf->Cell(40,16, '', 1,0);
		$pdf->Cell(40,8,'Numero', 1,0);
		$pdf->Cell(80,8,$pdf->formatOutput($prenotazione->idAnnuale), 1,1);
		$pdf->SetX(65);
		$pdf->Cell(40,8,'Data', 1,0);
		$pdf->Cell(80,8,$pdf->formatOutput($prenotazione->data), 1,1);
		$pdf->Cell(40,6,'Centro di raccolta', 1);
		$pdf->Cell(120,6,$pdf->formatOutput($prenotazione->centroRaccolta->nomeCentro), 1,1);
		$pdf->Cell(40,6,'sito in', 1);
		$pdf->Cell(120,6,$pdf->formatOutput($prenotazione->centroRaccolta->luogoCentro), 1,1);
		$pdf->Cell(40,6,'Via', 1);
		$pdf->Cell(120,6,$pdf->formatOutput($prenotazione->centroRaccolta->indirizzo), 1,1);
		$pdf->Cell(40,6,'C.a.p.', 1);
		$pdf->Cell(120,6,$pdf->formatOutput($prenotazione->centroRaccolta->cap), 1,1);
		$pdf->Cell(40,6,'Tel. n.', 1);
		$pdf->Cell(120,6,'0172/560137', 1,1); //Numero fisso
		$pdf->Cell(40,6,'Fax. n.', 1);
		$pdf->Cell(120,6,'0173/442435', 1,1); //Fax fisso
		
		$pdf->Ln($interlinea);
		
		//$pdf->MultiCell($larghLinea,$interlinea,'Descrizione tipologia del rifiuto: '.$pdf->formatOutput($prenotazione->descRifiuti));
		$pdf->MultiCell($larghLinea,$interlinea,'Descrizione tipologia del rifiuto: ');
		$token = strtok($prenotazione->descRifiuti, ';');
		while($token !==false)   {
			$pdf->WriteHTML('- '.$token.'<br>');
			$token = strtok(';');  
		}

		//$pdf->MultiCell($larghLinea,$interlinea,'Codice dell\' elenco dei rifiuti: '.$pdf->formatOutput($prenotazione->codiciCer));
		$pdf->MultiCell($larghLinea,$interlinea,'Codice dell\' elenco dei rifiuti: ');
		$codiciArr = explode('<BR>', $prenotazione->codiciCer);
		$len = count($codiciArr);
		foreach ($codiciArr as $index => $codice) {
			$index == $len - 1 ? $pdf->WriteHTML(''.$codice.'') : $pdf->WriteHTML(''.$codice.', ');
		}

		$pdf->Ln($interlinea);
		
		$pdf->MultiCell($larghLinea,$interlinea,'Azienda: '.$pdf->formatOutput($prenotazione->azienda->denominazione));
		$pdf->MultiCell($larghLinea,$interlinea,'Partita I.V.A.: '.$pdf->formatOutput($prenotazione->azienda->partitaIVA));
		$pdf->MultiCell($larghLinea,$interlinea,'Targa e mezzo che conferisce: '.$pdf->formatOutput($prenotazione->targaStorico)); 
		
		
		/*if ($prenotazione->azienda->idTipologiaUtente==2){
			$pdf->MultiCell($larghLinea,$interlinea,'Denominazione'.$pdf->formatOutput($prenotazione->codiciCer));
			$pdf->MultiCell($larghLinea,$interlinea,'Codice Fiscale'.$pdf->formatOutput($prenotazione->codiciCer));
		}*/

		$pdf->MultiCell($larghLinea,$interlinea,'Firma dell\'addetto al Centro di controllo:', 0, 'R');
		$pdf->MultiCell($larghLinea,$interlinea, $pdf->formatOutput($prenotazione->firmaOperatore), 0 ,'R');
		$pdf->Ln();

		if($i != $numItems-1){
			$pdf->AddPage();
			$pdf->Ln($interlinea);
			$i++;
		}
		
	}


	if (isset($prenotazione) && $elaborazione=='mail'){
		$pdf->Output('../pdfTemp/'.$fileName,'F',true);
	} else {
		$pdf->Output('Prenotazione rifiuti.pdf','D',true);
	}
?>
