<?php
ob_start();

require_once ('commonCtrl.php');

use model\Prenotazione, model\Stato, model\Rifiuto, util\Dates,  model\CentroRaccolta, model\TipologiaUtente;

$prenotazione = new Prenotazione();
$stato = new Stato();
$rifiuto = new Rifiuto();
$centroRaccolta = new CentroRaccolta();
$tipologiaUtente = new TipologiaUtente();


if (!isset($_SESSION)) {
   session_start();
}

$profilo = $_SESSION['profilo'];



//Lista prenotazioni
$filtriPrenotazioni = array();

if (isset($_POST['filtra']) or isset($_POST['excel'])) {
	if (isset($_POST['stato']) && strlen($_POST['stato']) > 0) {
		$filtriPrenotazioni['stato'] = $_POST['stato'];
	}
	
	if (!empty($_POST['rifiuto'])) {
		$filtriPrenotazioni['rifiuto'] = $_POST['rifiuto'];	
	}

	if (!empty($_POST['codiceCer'])) {
		$filtriPrenotazioni['codiceCer'] = $_POST['codiceCer'];	
	}

	if (!empty($_POST['dataPrenotazioneDa'])) {
		$filtriPrenotazioni['dataPrenotazioneDa'] = $_POST['dataPrenotazioneDa'];
	}

	if (!empty($_POST['dataPrenotazioneA'])) {
		$filtriPrenotazioni['dataPrenotazioneA'] = $_POST['dataPrenotazioneA'];
	}
	
	if (!empty($_POST['denominazione'])) {
		$filtriPrenotazioni['denominazione'] = trim($_POST['denominazione']);
	}

	if (!empty($_POST['partitaIVA'])) {
		$filtriPrenotazioni['partitaIVA'] = trim($_POST['partitaIVA']);
	}

	if (!empty($_POST['codiceFiscale'])) {
	    $filtriPrenotazioni['codiceFiscale'] = trim($_POST['codiceFiscale']);
	}
	
	if (!empty($_POST['comune'])) {
		$filtriPrenotazioni['comune'] = $_POST['comune'];
	}

	if (!empty($_POST['centroRaccolta'])) {
		$filtriPrenotazioni['idCentroRaccolta'] = $_POST['centroRaccolta'];
	}

	if (!empty($_POST['tipologiaUtente'])) {
		$filtriPrenotazioni['tipologiaUtente'] = $_POST['tipologiaUtente'];
	}


} else {
	if (!empty($profilo->idCentroRaccolta)) {
		//Se l'utente è di tipo dentro Raccolta, filtro per la data corrente

		$filtriPrenotazioni['dataPrenotazioneDa']=date("d-m-Y");
		$_POST['dataPrenotazioneDa']=$filtriPrenotazioni['dataPrenotazioneDa'];

		$filtriPrenotazioni['dataPrenotazioneA']=date("d-m-Y");
		$_POST['dataPrenotazioneA']=$filtriPrenotazioni['dataPrenotazioneA'];
	}
}

if (!empty($profilo->idComune)) {
	$filtriPrenotazioni['idComune'] = $profilo->idComune;
}

if (!empty($profilo->idCentroRaccolta)) {
	$filtriPrenotazioni['idCentroRaccolta'] = $profilo->idCentroRaccolta;
} else {
	$listCentriRaccolta=$centroRaccolta->loadCentriRaccolta(true);
}


if (isset($_POST['excel']) && $_POST['excel']=='excel') {
	$listPrenotazioni = $prenotazione->leggiPrenotazioniConsorzio($filtriPrenotazioni, false, true);
	if (count($listPrenotazioni) > 0) {
		include('../ctrl/excelPrenotazioniCtrl.php');
		die();
	}else {
		$errorMessage = "Non sono state trovate prenotazioni per compilare il file excel in base ai filtri di ricerca selezionati";
	}
}else {
	$listPrenotazioni = $prenotazione->leggiPrenotazioniConsorzio($filtriPrenotazioni);
	if (MAX_RIGHE_PRENOTAZIONI <= count($listPrenotazioni)) {
		$nascondiPrenotazioni = true;
		$errorMessage = "Sono state trovate più di " . MAX_RIGHE_PRENOTAZIONI . " prenotazioni, ridurre il numero di risultati valorizzando i filtri di ricerca";
	}	
}

if ($listPrenotazioni) {
	foreach ($listPrenotazioni as $prenotazione) {
		$prenotazione->prettyRifiuti('<BR>');
	}
}

//Lista stati
$listaStati = $stato->getListaStatiConsorzio();;

$listaRifiuti = $rifiuto->getListaRifiuti();
$listaCodiciCer = $rifiuto->getListaCodiciCer();

$listTipologiaUtente=$tipologiaUtente->loadTipologiaUtente();





//Lista comuni
/*if (!isset($profilo->idComune)) {
	//Se l'utente è un comune, non gli si permette di scegliere il comune della prenotazione
	$listaComuni = Comune::getListaComuni();
}*/

$paginaMenu='prenotazioniView';
include('../view/commonView.php');
include('../view/prenotazioniConsorzioView.php');
include('../view/footerView.php');
ob_end_flush();