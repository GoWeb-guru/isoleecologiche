<?php
ob_start();

require_once ('commonCtrl.php');

use util\URL, model\Prenotazione, model\Stato, model\Rifiuto, model\Comune, util\Dates, model\CentroRaccolta, model\TipologiaUtente;

$prenotazione = new Prenotazione();
$rifiuto = new Rifiuto();
$centroRaccolta = new CentroRaccolta();
$tipologiaUtente = new TipologiaUtente();


if (!isset($_SESSION)) {
   session_start();
}

$profilo = $_SESSION['profilo'];

//echo ('denominazione'.$profilo->denominazione.'-'.$profilo->idCentroRaccolta);
if (empty($profilo->denominazione) or empty($profilo->idCentroRaccolta)){
	URL::redirect('sceltaCentroRaccoltaCtrl.php');
}

//Lista prenotazioni
$filtriPrenotazioni = array();

if (isset($_POST['changeStato']) && $_POST['changeStato']=='changeStato') {
	
	$prenotazioneSelezionate = $_POST['idPrenotazione'];
	$idAziendaSelezionate = $_POST['idAziendaStorico']; //Bruno
	$idTipologiaSelezionate = $_POST['idTipologiaStorico']; //Bruno
	$stato = $_POST['statoScelto'];
	
	$motivazione = $_POST['motivazioneScelta'];
	//print_r($idAziendaSelezionate);
	//die();
	
	try{
		$msgPremio = $prenotazione->updateStatoPrenotazione($prenotazioneSelezionate, $idAziendaSelezionate, $stato, $motivazione, $idTipologiaSelezionate);

		if ($msgPremio != '')
			$msgPremio ='<div style="font-weight: bold; font-size: 18px; color: yellow;"> Le seguenti aziende hanno raggiunto il livello per la premiazione:<br>'.$msgPremio.'</div><br>';

		$okMessage = $msgPremio.'Cambio stato eseguito correttamente';
	
	}catch (Exception $e) {
		$errorMessage = $e->getMessage();				
	} 
}


if (isset($_POST['filtra'])) {
	
	if (!empty($_POST['rifiuto'])) {
		$filtriPrenotazioni['rifiuto'] = $_POST['rifiuto'];
	}

	if (!empty($_POST['dataPresentazione'])) {
		$filtriPrenotazioni['dataPresentazione'] = $_POST['dataPresentazione'];
	}
	
	if (!empty($_POST['codiceFiscale'])) {
		$filtriPrenotazioni['codiceFiscale'] = trim($_POST['codiceFiscale']);
	}
	
	if (!empty($_POST['denominazione'])) {
		$filtriPrenotazioni['denominazione'] = trim($_POST['denominazione']);
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
}

$filtriPrenotazioni['stato'] = "".ID_STATO_RICHIESTA;  //Imposto io il filtro perchè si possono cambiare solo le prenotazioni che sono in stato richiesta

if (!empty($profilo->idComune)) {
	$filtriPrenotazioni['idComune'] = $profilo->idComune;
}

if (!empty($profilo->idCentroRaccolta)) {
	$filtriPrenotazioni['idCentroRaccolta'] = $profilo->idCentroRaccolta;
} else {
	$listCentriRaccolta=$centroRaccolta->loadCentriRaccolta(true);
}

$listPrenotazioni = $prenotazione->leggiPrenotazioniConsorzio($filtriPrenotazioni, true);

if ($listPrenotazioni) {
	foreach ($listPrenotazioni as $prenotazione) {
		$prenotazione->prettyRifiuti('<BR>');
	}
}

if (MAX_RIGHE_PRENOTAZIONI < count($listPrenotazioni)) {
	$nascondiPrenotazioni = true;
	$errorMessage = "Sono state trovate più di " . MAX_RIGHE_PRENOTAZIONI . " prenotazioni, ridurre il numero di risultati valorizzando i filtri di ricerca";
}


$listaRifiuti = $rifiuto->getListaRifiuti();

$listTipologiaUtente=$tipologiaUtente->loadTipologiaUtente();


$paginaMenu='cambioStatoPrenotazioneView';
include('../view/commonView.php');
include('../view/cambioStatoPrenotazioneView.php');
include('../view/footerView.php');
ob_end_flush();
