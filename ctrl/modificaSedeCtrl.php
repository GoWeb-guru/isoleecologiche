<?php

ob_start();

require_once ('commonCtrl.php');

use util\User, util\URL, validator\ModificaAziendaValidator, model\Azienda, model\Sede, model\Comune ;

require_once ('functions.php');


if (isset($_POST['annulla'])) {
	URL::redirect('aziendaCtrl.php');
}

$comuni = Comune::getListaComuni();

$validator = new ModificaAziendaValidator();

if (isset($_SESSION['azienda'])) {
	$azienda = $_SESSION['azienda'];
}

$sede = Sede::getSedePrincipale($azienda->idAzienda);


if (isset($_POST['salva'])) {

  
  // validate input
  try {
	   
	
	$sede->idComune = $_POST['idComune'];
	$sede->indirizzo = $_POST['indirizzo'];
	//$sede->note = $_POST['note'];
	$sede->idSede = $_POST['idSede'];

	//if ($validator->validateForm()) {
		
	
		//Modifica azienda
		$sede->modificaSede($azienda);
		
		$azienda->sedePrincipale= Sede::getSedePrincipale($azienda->idAzienda);
			
		//Si caricano i dati della sede principale in sessione
		$_SESSION['azienda'] = $azienda;
		
		
		URL::redirect('aziendaCtrl.php');
	//}
    
  }catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
}



//view
$paginaMenu='aziendaView';
include('../view/commonView.php');
include('../view/modificaSedeView.php');
include('../view/footerView.php');
ob_end_flush();
