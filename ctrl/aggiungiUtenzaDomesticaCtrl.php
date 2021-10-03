<?php

ob_start();

require_once ('commonCtrl.php');

error_reporting(E_ALL);

use util\User, util\Emails, util\URL, validator\AggiungiUtenzaDomesticaValidator, model\Azienda, model\Sede, model\Comune ;

if (!isset($_SESSION)) {
   session_start();
}

if (isset($_SESSION['profilo'])) {
	$profilo = $_SESSION['profilo'];
}

require_once ('functions.php');

$validator = new AggiungiUtenzaDomesticaValidator();

$comuni = Comune::getListaComuni();


if (isset($_POST['submit'])) {

	

  // validate input and create user record
  // send activation code by email to user
  try {

	if ($validator->validateForm()) {

		//Creazione della nuova azienda
		$nuovaAzienda = new Azienda();
		$nuovaAzienda->codiceFiscale = $_POST['codiceFiscale'];
		$nuovaAzienda->denominazione = $_POST['denominazione'];
		$nuovaAzienda->telefono = $_POST['telefono'];
		$nuovaAzienda->idTipologiaUtente = 2;
		$nuovaAzienda->idUser=$loggedUser->id;
		
		$sede = new Sede();
		
		$sede->idComune = $_POST['idComune'];
		$sede->indirizzo = $_POST['indirizzo'];
		
		$nuovaAzienda->sedePrincipale = $sede;

		$nuovaAzienda->inserisciComuneAzienda();


		if (!isset($_SESSION['azienda'])) {
			$nuovaAzienda->caricaAziendaById(); 
			$_SESSION['azienda']=$nuovaAzienda;
			URL::redirect('aziendaCtrl.php');
		} else {
			$_SESSION['azienda']=null;
			$listaAziende=Azienda::caricaAziendeByUser($loggedUser->id); 
			$_SESSION['listaAziende']=$listaAziende;
			//deve selezionare con che utenza lavorare
			URL::redirect('selezionaAziendaCtrl.php');
		}

	}

    
  }catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
}

$paginaMenu='aggiungiUtenzaDomesticaView';
include('../view/commonView.php');
include('../view/aggiungiUtenzaDomesticaView.php');
include('../view/footerView.php');

ob_end_flush();
