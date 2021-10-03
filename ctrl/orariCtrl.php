<?php
ob_start();

require_once ('commonCtrl.php');

use model\CentroRaccolta, model\Orari;
use util\URL, util\Dates, util\Numbers;

$centroRaccolta = new CentroRaccolta();
$listCentriRaccolta=$centroRaccolta->loadCentriRaccolta(true);
$centroRaccoltaSelezionato = 0;
$numPersone = 0;

if (isset($_POST['salva'])) {
	$orari = new Orari();
	if($orari->salvaOrari($_POST)){
		$okMessage = "Salvataggio avvenuto correttamente";
	}
	else {
		$errorMessage = "Errore durante salvataggio Orario Centro di Raccolta";
	}
}

if (isset($_POST['centroRaccoltaHidden'])) {
	$centroRaccoltaSelezionato = $_POST['centroRaccoltaHidden'];
	$orari = new Orari();
	$listaOrari = $orari->loadOrari($_POST['centroRaccoltaHidden']);
	$numPersone = $orari->loadNumPersone($_POST['centroRaccoltaHidden']);
}
else{
	$listaOrari = null;
}

$paginaMenu='orariView';
include('../view/commonView.php');
include('../view/orariView.php');
include('../view/footerView.php');

ob_end_flush();