<?php
ob_start();

require_once ('commonCtrl.php');

use model\Sede;

if (isset($_SESSION['azienda'])) {
	$azienda = $_SESSION['azienda'];
}

$sede = new Sede();

$idSede = $_POST['idSede'];

try 
{
	$sede->deleteSede($idSede,$idAzienda);
}catch (Exception $e) {
    $errorMessage = $e->getMessage();
 }

$azienda->sedi = $sede->caricaSedi($idAzienda);
		

		
$_SESSION['azienda'] = $azienda;


$paginaMenu='aziendaView';
include('../view/commonView.php');
include('../view/aziendaView.php');
include('../view/footerView.php');
ob_end_flush();