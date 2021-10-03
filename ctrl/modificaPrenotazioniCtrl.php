<?php
ob_start();

require_once ('commonCtrl.php');

use model\Prenotazione, model\Sede, model\Rifiuto, model\DataPrenotazione;
use util\URL, util\Dates;
use validator\ModificaPrenotazioneValidator;

$minQuantita = 0;

$validator = new ModificaPrenotazioneValidator();

if (!isset($_SESSION)) {
   session_start();
}

$prenotazione = new Prenotazione();

if (isset($_POST['annulla'])) {
	URL::redirect('prenotazioniCtrl.php');
}

if (isset($_POST['salva'])) {
  
  // validate input and create user record
  // send activation code by email to user
  try {
	
	if ($validator->validateForm()) {
		$prenotazione->quantita = parseDecimal($_POST['quantita']);
		$prenotazione->note = $_POST['note'];
		$prenotazione->idPrenotazione = $_POST['idPrenotazione']; 
		
		$prenotazione->updatePrenotazione($idAzienda);
		
		URL::redirect('prenotazioniCtrl.php');
	}
    
  }catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
}

$idPrenotazioneModifica = $_POST['idPrenotazioneModifica'];

$prenotazione->getPrenotazioneModifica($idPrenotazioneModifica);

$flagRifiutiTeli = ID_RIFIUTI_TELI == $prenotazione->rifiuto->idRifiuto;

$minQuantita = pow(10, -$prenotazione->rifiuto->cifreDecimali);

//view
$paginaMenu='prenotazioniView';
include('../view/commonView.php');
include('../view/modificaPrenotazioniView.php');
include('../view/footerView.php');
ob_end_flush();

