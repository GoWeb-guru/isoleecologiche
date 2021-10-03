<?php

ob_start();

require_once ('commonCtrl.php');

error_reporting(E_ALL);

use util\User, util\Emails, util\URL, validator\InsertComuneAziendaValidator, model\Azienda, model\Sede, model\Comune ;

if (!isset($_SESSION)) {
   session_start();
}

if (isset($_SESSION['profilo'])) {
	$profilo = $_SESSION['profilo'];
}

require_once ('functions.php');

$validator = new InsertComuneAziendaValidator();

$comuni = Comune::getListaComuni();


if (isset($_POST['submit'])) {

	

  // validate input and create user record
  // send activation code by email to user
  try {
	if ($validator->validateForm()) {
		//Creazione della nuova azienda
		$nuovaAzienda = new Azienda();
		if (!empty($_POST['partitaIva'])) {
			$nuovaAzienda->partitaIVA = $_POST['partitaIva'];
			$nuovaAzienda->targa = $_POST['targaAz'];
		}
		if (!empty($_POST['codiceFiscale'])) {
			$nuovaAzienda->codiceFiscale = $_POST['codiceFiscale'];
			$nuovaAzienda->targa = $_POST['targaDom'];
		}
		$nuovaAzienda->denominazione = $_POST['denominazione'];
		$nuovaAzienda->telefono = $_POST['telefono'];
		
		$nuovaAzienda->idTipologiaUtente = $_POST['idTipologiaUtente'];

		if (isset($_SESSION['profilo'])) {
			$nuovaAzienda->idIntermediario = $profilo->idUser;
		}

		$sede = new Sede();
		
		$sede->idComune = $_POST['idComune'];
		$sede->indirizzo = $_POST['indirizzo'];
		
		$nuovaAzienda->sedePrincipale = $sede;

		$nuovaAzienda->inserisciComuneAzienda();

		$nuovaAzienda->caricaAziendaById(); 
		$_SESSION['azienda']=$nuovaAzienda;
		URL::redirect('aziendaCtrl.php');

	}

    
  }catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
}

$paginaMenu='inserisciComuneAziendaView';
include('../view/commonView.php');
include('../view/inserisciComuneAziendaView.php');
include('../view/footerView.php');

ob_end_flush();
