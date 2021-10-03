<?php
ob_start();

require_once ('commonCtrl.php');

use util\User, model\Azienda;
use util\URL;


if ($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") || $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")) {
	$azienda = new Azienda();
	$azienda->idAzienda=$_POST['idAzienda'];
	$azienda->caricaAziendaById(); 
	$_SESSION['azienda']=$azienda;
	URL::redirect('aziendaCtrl.php');
} 

ob_end_flush();