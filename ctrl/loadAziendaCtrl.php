<?php
ob_start();

require_once ('commonCtrl.php');

use util\User, model\Azienda, util\Dates;


$azienda = new Azienda();

if (!isset($_SESSION)) {
   session_start();
}

$profilo = $_SESSION['profilo'];
$okMessage = $_SESSION['okMessage'];
$_SESSION['okMessage'] = null;

//Lista prenotazioni
$filtriAziende = array();

if ($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario")) {
	$filtriAziende['contoTerziIdintermediario'] = $profilo->idUser;
}



if (isset($_POST['filtra'])) {	
	if (!empty($_POST['denominazione'])) {
		$filtriAziende['denominazione'] = trim($_POST['denominazione']);
	}
	if (!empty($_POST['partitaIVA'])) {
		$filtriAziende['partitaIVA'] = trim($_POST['partitaIVA']);
	}
	if (!empty($_POST['codiceFiscale'])) {
		$filtriAziende['codiceFiscale'] = trim($_POST['codiceFiscale']);
	}
	

	$listAziende = $azienda->ricercaAziende($filtriAziende);

	if (MAX_RIGHE_PRENOTAZIONI < count($listAziende)) {
		$nascondiPrenotazioni = true;
		$errorMessage = "Sono state trovate più di " . MAX_RIGHE_PRENOTAZIONI . " utenti, ridurre il numero di risultati valorizzando i filtri di ricerca";
	}
} else {
	
	if ($userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")) {
		//Se sono conto terzi consorzio, posso vedere tutte le aziende, quindi troppi record, devo obbligare a fare un filtro
		$nascondiPrenotazioni = true;
	} else {
		$listAziende = $azienda->ricercaAziende($filtriAziende);
	}
}



$paginaMenu='loadAziendaView';
include('../view/commonView.php');
include('../view/loadAziendeView.php');
include('../view/footerView.php');
ob_end_flush();