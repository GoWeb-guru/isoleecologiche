<?php
ob_start();

require_once ('commonCtrl.php');

use model\Prenotazione;

$prenotazione = new Prenotazione();

$idPrenotazione = $_POST['idPrenotazione'];
$prenotazione->getPrenotazione($idPrenotazione);

$prenotazioneCanc = new Prenotazione();


$prenotazioneCanc->deletePrenotazione($idPrenotazione,$idAzienda);

$chiamante="cancellaPrenotazione";
include('sendSmsEmailCtrl.php');
ob_clean ( );

$listPrenotazioni = $prenotazioneCanc->leggiTuttePrenotazioni($idAzienda);

$paginaMenu='prenotazioniView';
include('../view/commonView.php');
include('../view/prenotazioniView.php');
include('../view/footerView.php');
ob_end_flush();