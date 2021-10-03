<?php

const ID_RIFIUTI_FITOFARMACI = 1;
const ID_RIFIUTI_TELI = 2;

const ID_STATO_RICHIESTA = 1;

const MAX_RIGHE_PRENOTAZIONI = 1000;
const MAX_RIGHE_AZIENDE = 1000;

$permissionMappings = array(
	'prenotazioniConsorzioCtrl.php' => 'page.prenotazioniConsorzio',
	'prenotazioniCtrl.php' => 'page.prenotazioni',
	'dettaglioPrenotazioniCtrl.php' => 'page.dettaglioPrenotazioni',
	'inserisciPrenotazioniCtrl.php' => 'page.inserisciPrenotazioni',
	'modificaPrenotazioniCtrl.php' => 'page.modificaPrenotazioni',
	'cancellaPrenotazioniCtrl.php' => 'page.cancellaPrenotazioniCtrl',
	'aziendaCtrl.php' => 'page.azienda',
	'modificaAziendaCtrl.php' => 'page.modificaAzienda',
	'aggiungiSedeCtrl.php' => 'page.aggiungiSede',
	'modificaSedeCtrl.php' => 'page.modificaSede',
	'cancellaSedeCtrl.php' => 'page.cancellaSede',
	'excelPrenotazioniCtrl.php' => 'page.excelPrenotazioni',
	'societaCtrl.php' => 'page.societa',
	'cambioStatoPrenotazioneCtrl.php' => 'page.cambioStatoPrenotazioneCtrl',
	'comuneCtrl.php' => 'page.comune',
	'consorzioCtrl.php' => 'page.consorzio',
	//'ricercaAziendeCtrl.php' => 'page.ricercaAziende',
	//'orariCtrl.php' => 'page.orari',	
	//'loadAziendaCtrl.php' => 'page.loadAzienda',	
	//'inserisciComuneAziendaCtrl.php' => 'page.inserisciComuneAzienda',
);


