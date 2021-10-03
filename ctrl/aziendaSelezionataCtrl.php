<?php

ob_start();

require_once ('commonCtrl.php');

use model\Azienda;


$azienda = new Azienda();
$azienda->idAzienda=$_POST['idAzienda'];
$azienda->caricaAziendaById(); 
$_SESSION['azienda']=$azienda;
$profilo = $_SESSION['profilo']; 


include('../view/commonView.php');
include('../view/aziendaSelezionataView.php');
include('../view/footerView.php');

ob_end_flush();

