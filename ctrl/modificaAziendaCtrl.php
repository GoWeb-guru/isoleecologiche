<?php

ob_start();

require_once ('commonCtrl.php');

use util\User, util\URL, validator\ModificaAziendaValidator, validator\ModificaUtenteValidator ;

require_once ('functions.php');


if (isset($_POST['annulla'])) {
	URL::redirect('aziendaCtrl.php');
}

if ($idTipologiaUtente==1)
    $validator = new ModificaAziendaValidator();
else 
    $validator = new ModificaUtenteValidator();

if (isset($_SESSION['azienda'])) {
	$azienda = $_SESSION['azienda'];
}

$aziendaDup = $azienda->duplicaAzienda();


if (isset($_POST['salva'])) {

  
  // validate input and create user record
  // send activation code by email to user
  try {
	
    if ($idTipologiaUtente==1){
        $aziendaDup->partitaIVA = $_POST['partitaIva'];
        $aziendaDup->codiceFiscale = $azienda->codiceFiscale;
    } else {
        $aziendaDup->partitaIVA = $azienda->partitaIVA;
        $aziendaDup->codiceFiscale = $azienda->codiceFiscale;
    }
	
	$aziendaDup->denominazione = $_POST['denominazione'];
  $aziendaDup->telefono = $_POST['telefono'];
  $aziendaDup->targa = $_POST['targa'];

	if ($validator->validateForm()) {
	    
	
		
		//Modifica azienda
		$aziendaDup->modificaAzienda();
			
		//Si caricano i dati dell'azienda in sessione
		$_SESSION['azienda'] = $aziendaDup;
		
		
		URL::redirect('aziendaCtrl.php');
	}
    
  }catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
}



//view
$paginaMenu='aziendaView';
include('../view/commonView.php');
include('../view/modificaAziendaView.php');
include('../view/footerView.php');
ob_end_flush();
