<?php
ob_start();

require_once ('commonCtrl.php');

use model\CentroRaccolta;
use util\URL;

if (!isset($_SESSION)) {
   session_start();
}

$profilo = $_SESSION['profilo'];

$centroRaccolta = new CentroRaccolta();

if (isset($_POST['salva'])) {

	// validate input and create user record
	// send activation code by email to user
	try {
		
		if (isset($_POST['centroRaccolta'])) {
			$profilo->idCentroRaccolta= $_POST['centroRaccolta'];

			$centroRaccolta->idCentroRaccolta=$profilo->idCentroRaccolta;
			$centroRaccolta->getCentroRaccolta();
			$profilo->nomeCentroRaccolta=$centroRaccolta->nomeCentro . ' - ' . $centroRaccolta->indirizzo;

			URL::redirect('prenotazioniConsorzioCtrl.php');
		} else {
			$errorMessage='Valorizzare tutti i campi obbligatori';
		}
		
	}catch (Exception $e) {
		$errorMessage = $e->getMessage();
	}
}

$listCentriRaccolta=$centroRaccolta->loadCentriRaccolta(true,$idTipologiaUtente);




//view
$paginaMenu='prenotazioniView';
include('../view/commonView.php');
include('../view/sceltaCentroRaccoltaView.php');
include('../view/footerView.php');
ob_end_flush();