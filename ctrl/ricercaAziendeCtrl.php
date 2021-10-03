<?php
ob_start();

require_once ('commonCtrl.php');

use model\Azienda, util\Dates;

$azienda = new Azienda();

if (!isset($_SESSION)) {
   session_start();
}

$profilo = $_SESSION['profilo'];
$okMessage = $_SESSION['okMessage'];
$_SESSION['okMessage'] = null;

//Lista prenotazioni
$filtriAziende = array();

if (isset($_POST['filtra']) || (isset($_POST['excel']) && $_POST['excel']=='excel')) {
		
	
	if (!empty($_POST['denominazione'])) {
		$filtriAziende['denominazione'] = trim($_POST['denominazione']);
	}
	if (!empty($_POST['partitaIVA'])) {
		$filtriAziende['partitaIVA'] = trim($_POST['partitaIVA']);
	}
	if (!empty($_POST['codiceFiscale'])) {
	    $filtriAziende['codiceFiscale'] = trim($_POST['codiceFiscale']);
	}
}

$listAziende = $azienda->ricercaAziende($filtriAziende);

if (MAX_RIGHE_AZIENDE <= count($listAziende)) {
	$nascondiPrenotazioni = true;
	$errorMessage = "Sono state trovate più di " . MAX_RIGHE_AZIENDE . " aziende, ridurre il numero di risultati valorizzando i filtri di ricerca";
}elseif (isset($_POST['excel']) && $_POST['excel']=='excel') {
	if (count($listAziende) > 0) {
		include('../ctrl/excelAziendeCtrl.php');
		die();
	}else {
		$errorMessage = "Non sono state trovate aziende per compilare il file excel in base ai filtri di ricerca selezionati";
	}
}



$paginaMenu='ricercaAziendeView';
include('../view/commonView.php');
include('../view/ricercaAziendeView.php');
include('../view/footerView.php');
ob_end_flush();