<?php
// set up autoloader
require_once ('../vendor/autoload.php');

error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

use util\User, util\URL;

require_once ('constants.php');
require_once ('functions.php');

$userUtils = new User();

$loggedUser = $userUtils->getLoggedUser();

if (!isset($loggedUser)) {
	URL::redirect('loginCtrl.php');
}

$requestedFile = getRequestedFile();

if (!isPageEnabled($loggedUser, $requestedFile, $permissionMappings)) {	
	URL::redirect('divietoCtrl.php');
}

if (isset($_SESSION['azienda'])) {
	$idTipologiaUtente = $_SESSION['azienda']->idTipologiaUtente;

	$idAzienda = $_SESSION['azienda']->idAzienda;
}

