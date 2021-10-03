<?php
ob_start();

require_once ('commonCtrl.php');

if (isset($_SESSION['profilo'])) {
	$profilo = $_SESSION['profilo'];
}

if (isset($_SESSION['passwordUpdatedFlag'])) {
	unset($_SESSION['passwordUpdatedFlag']);
	$modalMessage = "La password è stata modificata con successo";
	$modalTitle = "Password modificata";
}

$paginaMenu='societaView';
include('../view/commonView.php');
include('../view/societaView.php');
include('../view/footerView.php');

ob_end_flush();