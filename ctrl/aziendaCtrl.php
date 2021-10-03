<?php
ob_start();

require_once ('commonCtrl.php');


use  util\URL;


if ($userUtils->isUserInGroup($loggedUser, "comune")){
	$aggiungiUtenzaDomestica=false;
	$aggiungiUtenzaAzienda=false;
} else {
	if (isset($_SESSION['azienda'])) {
		$azienda = $_SESSION['azienda'];
		if (!isset($_SESSION['listaAziende'])) {
			if ($azienda->idTipologiaUtente ==1)
				$aggiungiUtenzaDomestica=true;
			else $aggiungiUtenzaAzienda=true;
		}
	}  else {
		if (!isset($_SESSION['listaAziende'])) {
			$aggiungiUtenzaDomestica=true;
			$aggiungiUtenzaAzienda=true;
		} else {
			URL::redirect('selezionaAziendaCtrl.php');
		}
	}
}	


if (isset($_SESSION['passwordUpdatedFlag'])) {
	unset($_SESSION['passwordUpdatedFlag']);
	$modalMessage = "La password è stata modificata con successo";
	$modalTitle = "Password modificata";
}

$paginaMenu='aziendaView';
include('../view/commonView.php');
include('../view/aziendaView.php');
include('../view/footerView.php');

ob_end_flush();