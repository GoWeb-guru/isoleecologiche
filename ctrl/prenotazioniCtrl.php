<?php
ob_start();

require_once ('commonCtrl.php');

use model\Prenotazione, util\URL;

$prenotazione = new Prenotazione();

if (!isset($_SESSION)) {
   session_start();
}

if (!isset($_SESSION['azienda'])) {
	if ($userUtils->isUserInGroup($loggedUser, "comune")){
		$errorMessage="Per inserire una prenotazione è necessario selezionare un utente o crearne uno nuovo";
	}
	else{
		if (isset($_SESSION['listaAziende'])) {
			URL::redirect('selezionaAziendaCtrl.php');
		}
		//$errorMessage="Per inserire una prenotazione è necessario prima inserire un utenza domestica o aziendale";
		$errorMessage="Per inserire una prenotazione è necessario selezionare un utente o crearne uno nuovo";
	} 
} else {

	$listPrenotazioni = $prenotazione->leggiTuttePrenotazioni($idAzienda);


	if ($listPrenotazioni) {
		foreach ($listPrenotazioni as $prenot) {
			$prenot->prettyRifiuti('<BR>');
		}
	}



	if (isset($_SESSION['idNuovaPrenotazione'])) {
		$idNuovaPrenotazione = $_SESSION['idNuovaPrenotazione'];
		unset($_SESSION['idNuovaPrenotazione']);
		$prenotazione->getPrenotazione($idNuovaPrenotazione);
		$nuovaPrenotazione = $prenotazione;
	}

}

$paginaMenu='prenotazioniView';
include('../view/commonView.php');
include('../view/prenotazioniView.php');
include('../view/footerView.php');
ob_end_flush();
