<?php
ob_start();

require_once ('commonCtrl.php');

use model\Prenotazione, model\Sede, model\Rifiuto, model\CentroRaccolta, model\OrarioCentroRaccolta;
use util\URL, util\Dates, util\Numbers;
use validator\NuovaPrenotazioneValidator;

$validator = new NuovaPrenotazioneValidator();


$profilo = $_SESSION['profilo']; 

if (!isset($_SESSION)) {
   session_start();
}

 if (!isset($_SESSION['azienda'])) {
	$errorMessage="Per inserire una prenotazione è necessario selezionare un utente o crearne uno nuovo";
 } else {
	if (isset($_POST['annulla'])) {
		URL::redirect('prenotazioniCtrl.php');
	}

	$azienda=$_SESSION['azienda'];

	if (!isset($_POST['targa'])){
		$_POST['targa']=$azienda->targa;
	}

	$continua=true;


	if ($idTipologiaUtente==1){
		//Azienda
		if ($_SESSION['azienda']->partitaIVA==null){
			$errorMessage='Partita Iva non presente, andare in Dati Utente e valorizzarla';
			$continua=false;
		}
	} else {
		//Utente domestico
		if ($_SESSION['azienda']->codiceFiscale==null){
			$errorMessage='Codcie Fiscale non presente, andare in Dati Utente e valorizzarla';
			$continua=false;
		}
	}

	if ($continua){
		$prenotazione = new Prenotazione();
		$centroRaccolta = new CentroRaccolta();
		$orarioCentroRaccolta = new OrarioCentroRaccolta();

		$sedePrincipale = $azienda->sedePrincipale;
		$sedi =  $azienda->sedi;
		if (isset($sedePrincipale->idSede)) {
			$sedi = array($sedePrincipale->idSede => $sedePrincipale) + $sedi;
		}

		if (isset($_POST['salva'])) {
		
		// validate input and create user record
		// send activation code by email to user
		try {
			
			if ($validator->validateForm()) {

				$prenotazione->sede = new Sede();
				$prenotazione->idRifiuto= $_POST['rifiuto'];
				$prenotazione->rifiutoM3= $_POST['rifiutoM3'];	
				$prenotazione->rifiutoVerdeGM3= $_POST['rifiutoVerdeGM3'];	
				
				$prenotazione->rifiutoVerdeg = $_POST['rifiutoVerdeg'];
				
				if ($idTipologiaUtente==1)
					$prenotazione->sede = $sedi[$_POST['sede']];
				else $prenotazione->sede = $sedePrincipale;

				$prenotazione->azienda=$azienda;
				
				
				$prenotazione->note = $_POST['note'];

				$temp = explode("|", $_POST['giorno']); 

				$temp2 = explode("|", $_POST['orarioCentroRaccolta']); 

				//echo 'stampa tempo2'.$temp2;
				
				$prenotazione->idOrarioCentroRaccolta = $temp2[0];  
				$prenotazione->dataPrenotazione = $temp[1];
				$prenotazione->descFasciaOraria = $temp2[1];  
				$prenotazione->fascia15 = $temp2[2];  
				$prenotazione->idStato = 1;
				$prenotazione->targaStorico=$_POST['targa'];
				$prenotazione->quantita=$_POST['quantita'];
				if ($idTipologiaUtente==1)
					$prenotazione->produttore=$_POST['condizione'];
				

				if (isset($profilo->idCentroRaccolta)){
					$idCentroRaccolta=$profilo->idCentroRaccolta;	
				} else  $idCentroRaccolta=$_POST['centroRaccolta'];

				$centroRaccolta->idCentroRaccolta= $idCentroRaccolta;
				$centroRaccolta->getCentroRaccolta();
				$prenotazione->centroRaccolta=$centroRaccolta;
				
				//echo '<BR>'.print_r($_POST['rifiutoVerdeg'], true);
						
				if ($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") 
				|| $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")
				|| $userUtils->isUserInGroup($loggedUser, "area ecologica")) {
					//Sto facendo una prenotazione conto terzi quindi passo i dati di chi la esegue
					$prenotazione->inserisciPrenotazione($_SESSION['profilo']);
				} else {
					$prenotazione->inserisciPrenotazione();
				}

				/*
				echo '<br> azienda->targa:'.isset($azienda->targa);
				echo '<br> azienda->targa:'.$azienda->targa;

				echo '<br> prenotazione->targaStorico:'.isset($prenotazione->targaStorico);
				echo '<br> prenotazione->targaStorico:'.$prenotazione->targaStorico;
				*/

				$_SESSION['idNuovaPrenotazione'] = $prenotazione->idPrenotazione;
		
				
				
				if ((!isset($azienda->targa) || $azienda->targa=='') && isset($prenotazione->targaStorico)){
					//devo inserire la tarda sull'azienda per averle le prossime volte
					$azienda->targa=$prenotazione->targaStorico;
					$azienda->inserisciTargaAzienda();
				}

				

				$chiamante="inserisciPrenotazione";
				include('sendSmsEmailCtrl.php');

				if (isset($profilo->idCentroRaccolta))
					URL::redirect('prenotazioniConsorzioCtrl.php');
				else 
					URL::redirect('prenotazioniCtrl.php');
				return;	
			} else {
				$errorMessage='Valorizzare tutti i campi obbligatori';
			}
			
		}catch (Exception $e) {
			$errorMessage = $e->getMessage();
		}
		}


		$listCentriRaccolta=$centroRaccolta->loadCentriRaccolta(true,$idTipologiaUtente);

		if (isset($_POST['centroRaccolta']) && !empty($_POST['centroRaccolta']))
			$idCentroRaccolta=$_POST['centroRaccolta'];

		if (isset($profilo->idCentroRaccolta))	
			$idCentroRaccolta=$profilo->idCentroRaccolta;

		if (isset($idCentroRaccolta)) {
			//Lista rifiuti
			$rifiuti = Rifiuto::caricaRifiutiFromCentroRaccolta($idCentroRaccolta,$idTipologiaUtente);
			

			$listDataPrenotazione=$orarioCentroRaccolta->loadGiorniPerPrenotazione($idCentroRaccolta,$idAzienda,$idTipologiaUtente);

			if (count($listDataPrenotazione)===0 && !isset($errorMessage)) {
				$errorMessage = "Non sono disponibili prenotazioni, nei prossimi giorni, per il centro di raccolta selezionato";
			}
			
			if (isset($_POST['giorno']) && !empty($_POST['giorno'])) {
				$listOrarioCentroRaccolta=$orarioCentroRaccolta->getFascieOccupate($idCentroRaccolta,$_POST['giorno'], $_POST['dataPrenotazione'] );
				if (count($listOrarioCentroRaccolta)===0){
					$errorMessage = "Non sono disponibili prenotazioni per il giorno selezionato";
				}
			}

		}
	}
}

//view
$paginaMenu='prenotazioniView';
include('../view/commonView.php');
include('../view/inserisciPrenotazioniView.php');
include('../view/footerView.php');
ob_end_flush();