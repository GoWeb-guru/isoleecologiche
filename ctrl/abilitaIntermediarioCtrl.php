<?php
ob_start();

require_once ('commonCtrl.php');

use util\User, util\URL,  model\Profilo;

if (isset($_SESSION['azienda'])) {
	$azienda = $_SESSION['azienda'];
}

if (isset($_POST['annulla'])) {
	URL::redirect('prenotazioniCtrl.php');
}

if (isset($_POST['abilita'])) {
	Profilo::abilitaIntermediario($loggedUser->id);
	$user = new User();

	$user->logout();

	URL::redirect('loginCtrl.php');
}



$paginaMenu='abilitaIntermediarioView';
include('../view/commonView.php');
include('../view/abilitaIntermediarioView.php');
include('../view/footerView.php');

ob_end_flush();