<?php

ob_start();

require_once ('commonCtrl.php');

use util\User, util\URL, validator\ModificaAziendaConsorzioValidator, model\Azienda, model\Sede, model\Comune ;

require_once ('functions.php');


if (isset($_POST['annulla'])) {
	URL::redirect('ricercaAziendeCtrl.php');
}

$validator = new ModificaAziendaConsorzioValidator();

$idAzienda=$_POST['idAzienda'];

$azienda= new Azienda();

$azienda->caricaAziendaByIdAzienda($idAzienda);


if (isset($_POST['salva'])) {

  
  // validate input and create user record
  // send activation code by email to user
  try {
	   
	
	$azienda->partitaIVA = $_POST['partitaIva'];
	$azienda->codiceFiscale = $_POST['codiceFiscale'];
	$azienda->denominazione = $_POST['denominazione'];
	$azienda->telefono = $_POST['telefono'];
	$azienda->idTipologiaUtente = $_POST['idTipologiaUtente'];

	if ($validator->validateForm()) {
	
		//Modifica azienda
		$azienda->modificaAziendaConsorzio();
			
		$_SESSION['updatedFlag'] = true;
		$_SESSION['okMessage'] = "Utente modificato correttamente";	
		URL::redirect('ricercaAziendeCtrl.php');
	}
    
  }catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
}



//view
$paginaMenu='modificaAziendaConsorzioView';
include('../view/commonView.php');
include('../view/modificaAziendaConsorzioView.php');
include('../view/footerView.php');
ob_end_flush();
