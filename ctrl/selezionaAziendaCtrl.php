<?php
ob_start();

require_once ('commonCtrl.php');

use util\URL;;



if (isset($_SESSION['listaAziende'])) {
	
	$idAzienda=$_POST['idAzienda'];
	if (isset($idAzienda)) {
		$_SESSION['azienda']=$_SESSION['listaAziende'][$idAzienda];
		URL::redirect('prenotazioniCtrl.php');
	}
	$count=0;
}  else {
	URL::redirect('logoutCtrl.php');
}	


$paginaMenu='selezionaAziendaView';
include('../view/commonView.php');
include('../view/selezionaAziendaView.php');
include('../view/footerView.php');

ob_end_flush();