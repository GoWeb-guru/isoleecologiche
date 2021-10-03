<?php
ob_start();

require_once ('commonCtrl.php');

use util\FPDF,util\PDF, model\Prenotazione, model\Sede, model\Rifiuto, model\DataPrenotazione;
use util\URL, util\Dates;


if (isset($_SESSION['azienda'])) {
	$azienda = $_SESSION['azienda'];
}


if (!isset($prenotazione)) {

	$prenotazione = new Prenotazione();

	$idPrenotazioneStampa = $_POST['idPrenotazioneStampa'];

	$prenotazione->getPrenotazione($idPrenotazioneStampa);

}



$interlinea=10;
$interlineaPar=5;
$interlineaAvv=7;
$larghLinea=190;

$pdf = new PDF('CONFERMA PRENOTAZIONE N. '.$prenotazione->idPrenotazione, 1);

$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

$pdf->Ln($interlinea);
$pdf->Ln($interlinea);
$pdf->Ln($interlinea);

if (isset($prenotazione->idIntermediario)) {
	$pdf->MultiCell($larghLinea,$interlinea,'Prenotazione effettuta da');
	$pdf->SetFont('Arial','',12);
	$pdf->MultiCell($larghLinea,$interlinea,'Identificativo: '.$pdf->formatOutput($prenotazione->identificativoIntermediarioStorico));
	$pdf->MultiCell($larghLinea,$interlinea,'Denominazione: '.$pdf->formatOutput($prenotazione->denominazioneIntermediarioStorico));
	$pdf->SetFont('Arial','B',16);
	$pdf->Ln($interlinea);
	$pdf->MultiCell($larghLinea,$interlinea,"Per l'utenza");
} else {
	$pdf->MultiCell($larghLinea,$interlinea,'Utenza');
}


$pdf->SetFont('Arial','',12);
if ($idTipologiaUtente==2){
	$pdf->MultiCell($larghLinea,$interlinea,'Cognome e nome: '.$pdf->formatOutput($azienda->denominazione));
	$pdf->MultiCell($larghLinea,$interlinea,'Codice Fiscale: '.$pdf->formatOutput($azienda->codiceFiscale));
} else {
	$pdf->MultiCell($larghLinea,$interlinea,'Denominazione: '.$pdf->formatOutput($azienda->denominazione));
	$pdf->MultiCell($larghLinea,$interlinea,'Partita IVA: '.$pdf->formatOutput($azienda->partitaIVA));
}
$pdf->MultiCell($larghLinea,$interlinea,'Telefono: '.$pdf->formatOutput($azienda->telefono));
$pdf->MultiCell($larghLinea,$interlinea,'Utente: '.$pdf->formatOutput($azienda->email));
$pdf->MultiCell($larghLinea,$interlinea,'Targa: '.$pdf->formatOutput($prenotazione->targaStorico));
//$pdf->MultiCell($larghLinea,$interlinea,'Quantitativo rifiuti: '.$pdf->formatOutput($prenotazione->quantita));

$pdf->SetFont('Arial','B',16);
$pdf->Ln($interlineaPar);
$pdf->MultiCell($larghLinea,$interlinea,'Dati rifiuto');
$pdf->SetFont('Arial','',12);

$pdf->MultiCell($larghLinea,$interlinea,'Rifiuto: ');

$token = strtok($prenotazione->descRifiuti, ';');
while($token !==false)   {

	$pdf->WriteHTML('- '.$token.'<br><br>');
/*

	$pdf->MultiCell($larghLinea,$interlinea,'- '.$pdf->formatOutput($token));

*/	
	$token =strtok(';');  
}

if ($prenotazione->note!=null){
	$pdf->MultiCell($larghLinea,$interlinea,'Note: '.$prenotazione->note);
}

if ($prenotazione->centroRaccolta->nomeCentro!=null){
	$pdf->WriteHTML('<br><b>Centro di raccolta: </b>'.$prenotazione->centroRaccolta->nomeCentro.' - '.$prenotazione->centroRaccolta->indirizzo);
}



if ($prenotazione->dataPrenotazione!=null){
	$pdf->WriteHTML('<br><br><b>Data prenotazione: </b>'.$prenotazione->dataPrenotazione.' alle '.$prenotazione->descFasciaOraria);
}

$pdf->WriteHTML('<br><br>Data richiesta: '.$prenotazione->data.'<br>');


$pdf->SetFont('Arial','B',12); 


$str=$pdf->formatOutput("Le utenze non domestiche che si configurano come produttori iniziali di rifiuti non pericolosi (o pericolosi entro il limite di 30 Kg o l. al giorno) che effettuano operazioni di raccolta e trasporto dei propri rifiuti – per il conferimento al centro di raccolta - sono tenuti a possedere l’iscrizione all’Albo nazionale gestori ambientali(D.Lgs. n. 152/2006, art. 212, c. 8). ");




$str3=$pdf->formatOutput("AL FINE DI GARANTIRE IL DISTANZIAMENTO E' FATTO OBBLIGO AGLI UTENTI DI RESTARE RIGOROSAMENTE A BORDO DEL "
."PROPRIO VEICOLO E DI NON SCENDERE SINO A CHE IL VEICOLO SARA' ENTRATO NEL CENTRO. "
."ALL'INTERNO DEL CENTRO E' FATTO OBBLIGO DI MANTENERE UNA DISTANZA INTERPERSONALE SUPERIORE AD 1 METRO.\n "
."L'ACCESSO E' CONSENTITO AGLI UTENTI DOTATI DI MASCHERINE ED E' RACCOMANDATO L'USO DEI GUANTI MONOUSO, DA INDOSSARE ANCHE SOTTO I GUANTI DA LAVORO."
."ALL'INGRESSO ED ALL'INTERNO DEL CENTRO SEGUIRE SCRUPOLOSAMENTE LE INDICAZIONI DELL'ADDETTO ALLA GESTIONE ED IL REGOLAMENTO DI ACCESSO"
);
$str2=$pdf->formatOutput("Attenzione: non saranno ammesse variazioni di orario, di giorno e del centro di raccolta scelto.");



// Line break
$pdf->Ln($interlinea);
if ($idTipologiaUtente==1){
	//$pdf->SetTextColor(255,0,0);
	$pdf->SetFont('Arial','I',8);
	$pdf->MultiCell($larghLinea,$interlineaPar,$str,1);
	$pdf->Ln($interlinea);
}
$pdf->SetFont('Arial','B',12); 
$pdf->SetTextColor(0);
$pdf->MultiCell($larghLinea,$interlineaAvv,$str2,1);
$pdf->Ln($interlinea);
$pdf->SetFont('Arial','I',10);
$pdf->MultiCell($larghLinea,$interlineaAvv,$str3);




if (isset($prenotazione) && $elaborazione=='mail'){
	$pdf->Output('../pdfTemp/'.$fileName,'F',true);
} else {
	$pdf->Output('Prenotazione rifiuti.pdf','D',true);
}
?>
