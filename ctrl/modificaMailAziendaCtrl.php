<?php

ob_start();

require_once ('commonCtrl.php');

use util\User, util\URL, validator\ModificaMailAziendaValidator;

$userUtil = new User();

if (isset($_POST['annulla'])) {
	URL::redirect('ricercaAziendeCtrl.php');
}

$validator = new ModificaMailAziendaValidator();

$idUser=$_POST['idUser'];
		
		
if (isset($_POST['salva'])) {
  
  try {
	   
	if ($validator->validateForm()) {
		
		$userUtil->updateMailAzienda($idUser, $_POST['email']);
	
		if (!isset($_SESSION)) {	
			session_start();
		}

		$_SESSION['updatedFlag'] = true;
		$_SESSION['okMessage'] = "Email modificata correttamente";	
		URL::redirect('ricercaAziendeCtrl.php');
	}
   
  }catch (Exception $e) {
    $errorMessage = $e->getMessage();
  }
}

include('../view/commonView.php');
include('../view/modificaMailAziendaView.php');
include('../view/footerView.php');

ob_end_flush();

