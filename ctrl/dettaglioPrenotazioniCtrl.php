<?php
ob_start();

require_once ('commonCtrl.php');

use model\Prenotazione, model\Rifiuto, model\DataPrenotazione;
use util\URL, util\Dates;

if (!isset($_SESSION)) {
   session_start();
}

$profilo = $_SESSION['profilo']; 

$prenotazione = new Prenotazione();

if (isset($_POST['indietro'])) {
	URL::redirect('prenotazioniCtrl.php');
}



if (!isset($_POST['salva'])) {
	$idPrenotazioneDettaglio = $_POST['idPrenotazioneDettaglio'];
	$prenotazione->getPrenotazione($idPrenotazioneDettaglio);
	$idTipologiaUtente = $prenotazione->azienda->idTipologiaUtente;
	$prenotazione->prettyRifiuti('<BR>');
	$rifiuti = Rifiuto::caricaRifiutiFromCentroRaccolta($prenotazione->idCentroRaccolta, $idTipologiaUtente);
}
else{ //Bruno per salvataggio
	$idPrenotazioneDettaglio = $_POST['idPrenotazione'];
	$prenotazione->getPrenotazione($idPrenotazioneDettaglio);
	$idTipologiaUtente = $prenotazione->azienda->idTipologiaUtente;
	$prenotazione->prettyRifiuti('<BR>');
	// validate input and create user record
	// send activation code by email to user
	try {
		
		$prenotazione->idRifiuto= $_POST['rifiuto'];
		$prenotazione->rifiutoM3= $_POST['rifiutoM3'];	
		$prenotazione->rifiutoVerdeGM3= $_POST['rifiutoVerdeGM3'];	

		$prenotazione->rifiutoVerdeg = $_POST['rifiutoVerdeg'];
		$prenotazione->produttore=$_POST['condizione'];

		//echo '<BR>'.print_r($_POST['rifiuto'], true);
		//echo '<BR>'.print_r($_POST['rifiutoVerdeg'], true);

		if ($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") 
		|| $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")
		|| $userUtils->isUserInGroup($loggedUser, "area ecologica")) {
			//Sto facendo una prenotazione conto terzi quindi passo i dati di chi la esegue
			$prenotazione->inserisciPrenotazione($_SESSION['profilo'], true);
		} else {
			$prenotazione->inserisciPrenotazione(null, true);
		}

		$chiamante="modificaPrenotazione";
		include('sendSmsEmailCtrl.php');

		if (isset($profilo->idCentroRaccolta))
			URL::redirect('prenotazioniConsorzioCtrl.php');
		else 
			URL::redirect('prenotazioniCtrl.php');
	}catch (Exception $e) {
		$errorMessage = $e->getMessage();
	}
}










//view
$paginaMenu='prenotazioniView';
include('../view/commonView.php');
include('../view/dettaglioPrenotazioniView.php');
include('../view/footerView.php');
ob_end_flush();

