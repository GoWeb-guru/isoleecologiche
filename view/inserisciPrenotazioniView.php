
<style type="text/css">
	
	 .radiobtn {
		 position: relative;
		 /*display: block;*/
		 display: -webkit-inline-box;
	}
	 .radiobtn label {
		 display: block;
		 background: #fee8c3;
		 color: #444;
		 border-radius: 5px;
		 padding: 10px 20px;
		 border: 2px solid #fdd591;
		 margin-bottom: 5px;
		 cursor: pointer;
		 width: 70%; /*bruno*/
		 margin-right: 15px; /*bruno*/
	}
	 .radiobtn label:after, .radiobtn label:before {
		 content: "";
		 position: absolute;
		 right: 11px;
		 top: 11px;
		 width: 20px;
		 height: 20px;
		 border-radius: 3px;
		 background: #fdcb77;
	}
	 .radiobtn label:before {
		 background: transparent;
		 transition: 0.1s width cubic-bezier(0.075, 0.82, 0.165, 1) 0s, 0.3s height cubic-bezier(0.075, 0.82, 0.165, 2) 0.1s;
		 z-index: 2;
		 overflow: hidden;
		 background-repeat: no-repeat;
		 background-size: 13px;
		 background-position: center;
		 width: 0;
		 height: 0;
		 background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNS4zIDEzLjIiPiAgPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE0LjcuOGwtLjQtLjRhMS43IDEuNyAwIDAgMC0yLjMuMUw1LjIgOC4yIDMgNi40YTEuNyAxLjcgMCAwIDAtMi4zLjFMLjQgN2ExLjcgMS43IDAgMCAwIC4xIDIuM2wzLjggMy41YTEuNyAxLjcgMCAwIDAgMi40LS4xTDE1IDMuMWExLjcgMS43IDAgMCAwLS4yLTIuM3oiIGRhdGEtbmFtZT0iUGZhZCA0Ii8+PC9zdmc+);
	}
	 .radiobtn input[type="radio"] {
		 display: none;
		 position: absolute;
		 width: 100%;
		 appearance: none;
	}
	 .radiobtn input[type="radio"]:checked + label {
		 background: #fdcb77;
		 animation-name: blink;
		 animation-duration: 1s;
		 border-color: #fcae2c;
	}
	
	 .radiobtn input[type="radio"]:checked + label:after {
		 background: #fcae2c;
	}
	 .radiobtn input[type="radio"]:checked + label:before {
		 width: 20px;
		 height: 20px;
	}
	
	.radiobtn input[type="radio"]:disabled + label {
		 background: #dddddd;
		 border-color: #ccc;
		 color: #999;
	}
	.radiobtn input[type="radio"]:disabled + label:after, .radiobtn input[type="radio"]:disabled + label:before {
		 content: "";
		 position: absolute;
		 right: 11px;
		 top: 11px;
		 width: 20px;
		 height: 20px;
		 border-radius: 3px;
		 background: #ccc;
	}
	
	
	 @keyframes blink {
		 0% {
			 background-color: #fdcb77;
		}
		 10% {
			 background-color: #fdcb77;
		}
		 11% {
			 background-color: #fdd591;
		}
		 29% {
			 background-color: #fdd591;
		}
		 30% {
			 background-color: #fdcb77;
		}
		 50% {
			 background-color: #fdd591;
		}
		 45% {
			 background-color: #fdcb77;
		}
		 50% {
			 background-color: #fdd591;
		}
		 100% {
			 background-color: #fdcb77;
		}
	}

</style>

<script type="text/javascript">
	
function condizioneCer(el){
	if ($(el).is(":checked")){	
		$('#conta').val(+$('#conta').val() + +1);
	}
	else {
		$('#conta').val(+$('#conta').val() - +1);
		
	}
	
	if($('#conta').val() > 0){
		$("#rigaCondizione").css("display", "block");
	}
	else{
		$("#rigaCondizione").css("display", "none");
	}
}
	
	
function checkCentroRaccolta() {
	
	if ($('#centroRaccolta').val()) {
		$('#sedeHidden').val($('#sede').val());
		$('#targaHidden').val($('#targa').val());
		$('#centroRaccoltaHidden').val($('#centroRaccolta').val());
		
		$('#nuovaPrenotazione2').submit();
	}else {
		//Viene svuotata la select dei giorno
		svuotaSelect("giorno");
	}
}

function checkGiorno() {
	
	if ($('#giorno').val()) {
		$giorno=$('#giorno').val().split("|");
		$('#sedeHidden').val($('#sede').val());
		$('#targaHidden').val($('#targa').val());
		$('#centroRaccoltaHidden').val($('#centroRaccolta').val());
		$('#giornoHidden').val($giorno[0]);
		$('#dataPrenotazioneHidden').val($giorno[1]);
		$('#nuovaPrenotazione2').submit();
	}else {
		//Viene cancellata la fascia oraria
		svuotaSelect("orarioCentroRaccolta");
		
	}
}

function svuotaSelect(idSelect) {
	var firstOption = $("#"+idSelect+" option:first");
	$("#"+idSelect).find('option').remove().end();
}

	
function impostaRifiuto($valore) {
	var risultato = $valore.split("|");

	//document.getElementById("searchrifiuti").value = decodeURIComponent(risultato[0].replace(/([.*+?^=!:${}()|\[\]\\])/g," "));
	descRifiuto = decodeURIComponent(risultato[0].replace(/([.*+?^=!:${}()|\[\]\\])/g," "));
	document.getElementById("searchrifiuti").value = '';
	document.getElementById("resultsrifiuti").style.display = "none";
	document.getElementById("results-textrifiuti").style.display = "none";
	//document.getElementById("idrifiuto").value  = risultato[1];
	
	var testoChiamaCondizione = '';
	if(risultato[2]=='20.01.21' || risultato[2]=='20.01.23' || risultato[2]=='20.01.35' || risultato[2]=='20.01.35-R2' || risultato[2]=='20.01.35-R3' || risultato[2]=='20.01.36'){
		$('#conta').val(+$('#conta').val() + +1);
		$("#rigaCondizione").css("display", "block");
		testoChiamaCondizione = 'onClick="javascript:condizioneCer(this)"';
	}
	
	
	var testoDaInserire = '<div class="controls"> <input type="checkbox" checked name="rifiutoVerdeg[]" value="'+risultato[1]+'" size="30" '+testoChiamaCondizione+' /> '+ descRifiuto 
	+'<br><input type="radio" checked="checked" value="0" name="rifiutoVerdeGM3['+risultato[1]+']"  style="margin-left: 15px"> <i>minore o uguale a 1 </i><input type="radio" value="1" name="rifiutoVerdeGM3['+risultato[1]+']" style="margin-left: 10px"> <i> maggiore di 1 (metro cubo)</i></div>';
	$("#rifiutiNew").append(testoDaInserire);
	
	$(".segnala").fadeOut();
	$(".informa").fadeIn();
	
	
	
}

	
function segnala() {
	$(".informa").fadeOut();
	$(".segnala").fadeIn();	  
}

	
</script>
	
	<div class="tm-wrapper">

		<div class="tm-block tm-block-padding-top">
		<div class=" uk-container uk-container-center">
			<section class="tm-top-a uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
<div class="uk-width-1-1"><div class="uk-panel">
	</div></div>
</section>
		</div>
	</div>
	
	
		<div class="tm-block  ">
		<div class=" uk-container uk-container-center">

										
			<div class="tm-middle uk-grid" data-uk-grid-match data-uk-grid-margin>

								<div class="tm-main uk-width-medium-1-1">

					
										<main class="tm-content">

						<div id="system-message-container">
							<?php if (isset($errorMessage)) {?>
							<div class="uk-alert uk-alert-large uk-alert-warning" data-uk-alert="">
								<button type="button" class="uk-alert-close uk-close"></button>
								<h2>Attenzione</h2>
								<p><?=$errorMessage?></p>
							</div>
							<?php } ?>
						</div>

						<h6>
Attenzione la prenotazione non E' modificabile: non saranno ammesse variazioni di orario, di giorno e del centro di raccolta.
</h6>
<h6>
Si ricorda a tutti gli utenti che l ’accesso a tutti i Centri di raccolta consortili &egrave; consentito per tutti i cittadini residenti nei comuni consorziati
</h6>
<div class="profile">
		
<form style="display:none" id="nuovaPrenotazione2" name="nuovaPrenotazione2" method="post" action="ctrl/inserisciPrenotazioniCtrl.php" class="form-validate form-horizontal well">
			<input type="hidden" name="centroRaccolta" id="centroRaccoltaHidden">
			<input type="hidden" name="giorno" id="giornoHidden">	
			<input type="hidden" name="sede" id="sedeHidden">	
			<input type="hidden" name="dataPrenotazione" id="dataPrenotazioneHidden">
			<input type="hidden" name="targa" id="targaHidden">
</form>
		
<form id="nuovaPrenotazione" name="nuovaPrenotazione" method="post" action="ctrl/inserisciPrenotazioniCtrl.php" class="form-validate form-horizontal well">
	<input type="hidden" name="conta" id="conta" value="0">
	
<fieldset id="users-profile-core">
	<legend>
		Aggiungi prenotazione	</legend>
  
  <fieldset class="uk-form">

  <div class="control-group">
  			<div class="control-label">
			  <input type="checkbox" name="dichiarazioneCovid" required="required" aria-required="true"> <span class="star">&nbsp;*</span>
			</div>
           <div class="controls">
		   “Dichiaro in qualità o in nome e per conto del datore di lavoro aziendale di avere ottemperato alle verifiche sui miei dipendenti e collaboratori sul possesso del certificato verde ai sensi del D.L. 127 del 21/09/2021, quale misura di protezione dal contagio da COVID-19 e di essere consapevole che presso il centro di raccolta potranno essere effettuate verifiche a campione”.
  						
			</div>
			
			
		</div>

  
  <?php if ($idTipologiaUtente==1) {?>
    <div class="control-group">
      <div class="control-label">
        <label>Sede della tua azienda <span class="star">&nbsp;*</span></label>						
      </div>
      <div class="controls">
        <select name="sede" id="sede"  required="required" aria-required="true">
          <option value="">- seleziona una sede -</option>
          <?php foreach ($sedi as $idSede => $sede) { ?>
          <option value="<?=$idSede?>" <?=getSelectedOption('sede', $idSede)?> >
          <?=output($sede->descComune . ' - ' . $sede->indirizzo)?></option>
          <?php } ?>
        </select>
        <?=$validator->outputError('sede')?>
      </div>
    </div>
	<?php } else {?>	
		<input type="hidden" name="sede" id="sede" value="<?=$sedePrincipale->idSede?>">
	<?php }?>	

	<?php if ($idTipologiaUtente==1) {?>
	  
		<div class="control-group">
			<div class="control-label">
				<label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
				Targa veicolo:<span class="star" data-uk-modal="{target:'#modal-1'}">&nbsp;*</span>
				</label>
			</div>
			<div class="controls">
				<input type="text" name="targa" id="targa" maxlength="20" 
			value="<?php echo isset($_POST['targa']) ? output($_POST['targa']) : ''; ?>"  class="required" size="30" required="required" aria-required="true">
				<?=$validator->outputError('targa')?>						
			</div>
		</div>
	<?php } else {?>	
		<div class="control-group">
			<div class="control-label">
				<label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
				Targa veicolo:
				</label>
			</div>
			<div class="controls">
				<input type="text" name="targa" id="targa" maxlength="20" 
			value="<?php echo isset($_POST['targa']) ? output($_POST['targa']) : ''; ?>"  size="30" aria-required="true">
				<?=$validator->outputError('targa')?>						
			</div>
		</div>
	<?php }?>



	<div class="control-group">
      <div class="control-label">
        <label>Centro di raccolta <span class="star">&nbsp;*</span></label>						
      </div>
      <div class="controls">
	  <?php if (!isset($profilo->idCentroRaccolta)) {?>
        <select name="centroRaccolta" id="centroRaccolta" required="required" aria-required="true" onchange="javascript:checkCentroRaccolta()">
          <option value="">- seleziona un centro di raccolta -</option>
          <?php foreach ($listCentriRaccolta as $idCentroRaccolta => $centroRaccolta) { ?>
          <option value="<?=$idCentroRaccolta?>" <?=getSelectedOption('centroRaccolta', $idCentroRaccolta)?> >
          <?=output($centroRaccolta->nomeCentro . ' - ' . $centroRaccolta->indirizzo)?></option>
          <?php } ?>
        </select>
        <?=$validator->outputError('centroRaccolta')?>
	  <?php } else { ?>
		<?=output($profilo->nomeCentroRaccolta)?></option>
		
	  <?php } ?>	
      </div>
    </div>	

	<?php if ((isset($_POST['centroRaccolta']) && !empty($_POST['centroRaccolta'])) || isset($profilo->idCentroRaccolta)) {?>
	
		<?php if (1==2) {?>
    		<div class="control-group">
    		<div class="control-label">
    			<label>Giorno prenotazione <span class="star">&nbsp;*</span></label>						
    		</div>
    		<div class="controls">
    			<select name="giorno" id="giorno" required="required" aria-required="true" onchange="javascript:checkGiorno()">
    			<option value="">- seleziona un giorno -</option>
    			<?php foreach ($listDataPrenotazione as $idGiorno => $giorno) { ?>
    			<option value="<?=$idGiorno.'|'.$giorno->data ?>" <?=getSelectedOption('dataPrenotazione', $giorno->data)?> >
    			<?=output($giorno->giorno . ' - ' . $giorno->data)?></option>
    			<?php } ?>
    			</select>
    			<?=$validator->outputError('giorno')?>
    		</div>
    		</div>	
    
    		
    		<?php if (isset($_POST['giorno']) && !empty($_POST['giorno'])) {?>	
    			Entro le ore 14:00 scade il termine per prenotare il servizio per il giorno successivo. Gli accessi dopo le ore 14:00 consentono le prenotazioni per i giorni seguenti il successivo 
    			<br>
    			<br>
    			<div class="control-group">
    			<div class="control-label">
    				<label>Orario prenotazione <span class="star">&nbsp;*</span></label>						
    			</div>
    			<div class="controls">
    				<select name="orarioCentroRaccolta" id="orarioCentroRaccolta" required="required" aria-required="true">
    				<option value="">- seleziona un orario prenotazione -</option>
    				<?php foreach ($listOrarioCentroRaccolta as $idOrarioCentroRaccolta => $orarioCentroRaccolta) { ?>
    				<option value="<?=$orarioCentroRaccolta->idOrarioCentroRaccolta.'|'.$orarioCentroRaccolta->descFasciaOraria.'|'.$orarioCentroRaccolta->fascia15 ?>" <?=getSelectedOption('orarioCentroRaccolta', $idOrarioCentroRaccolta)?> >
    				<?=output($orarioCentroRaccolta->descFasciaOraria)?></option>
    				<?php } ?>
    				</select>
    				<?=$validator->outputError('orarioCentroRaccolta')?>
    			</div>
    			</div>
    		<?php }
				} else { ?>
				
				<div class="control-group">
					<div class="control-label">
						<label>Giorno prenotazione <span class="star">&nbsp;*</span></label>						
					</div>
					<div class="controls">
						<select name="giorno" id="giorno" required="required" aria-required="true" onchange="javascript:checkGiorno()">
						<option value="">- seleziona un giorno -</option>
						<?php foreach ($listDataPrenotazione as $idKey => $giorno) { ?>
						<option value="<?=$giorno->idGiorno.'|'.$giorno->data ?>" <?=getSelectedOption('dataPrenotazione', $giorno->data)?> >
						<?=output($giorno->giorno . ' - ' . $giorno->data)?></option>
						<?php } ?>
						</select>
						<?=$validator->outputError('giorno')?>
					</div>
					</div>	


					<?php if (isset($_POST['giorno']) && !empty($_POST['giorno'])) {?>	
						<div class="control-label">
							&nbsp;					
						</div>
						<div class="controls">
						Le fasce orarie in grigio sono gia' occupate o piu' non prenotabili
						</div>
						<div class="control-group">
						<div class="control-label">
							<label>Orario prenotazione <span class="star">&nbsp;*</span></label>
							<br>Seleziona l'orario desiderato
						</div>
						<div class="controls">
							<div id="xerrore"></div>
							<?php
							//Aggiunta per fascie multiple
						$idOrarioCentroRaccolaTemp = 0;
						//print_r($listOrarioCentroRaccolta);
						foreach($listOrarioCentroRaccolta as &$value) {
							//echo 'valore idOrarioCentroRa:'.$value->idOrarioCentroRaccolta;
							
							if ($idOrarioCentroRaccolaTemp != $value->idOrarioCentroRaccolta) {
								if ($idOrarioCentroRaccolaTemp !=0) echo('<br>');
								$idOrarioCentroRaccolaTemp = $value->idOrarioCentroRaccolta;
								//$primaRiga = current($listOrarioCentroRaccolta);
								$primaRiga = $value;
								
								$totaleFascie15 = $primaRiga->numFascia15;
								$lidOrarioCentroRaccolta = $primaRiga->idOrarioCentroRaccolta;

								$today = date("Y-m-d");
								$number = date('N', strtotime($today));
								if ($_POST['giorno'] == $number)
									$controllo = true;
								else
									$controllo = false;

								//echo "array:".print_r($listOrarioCentroRaccolta);
								//echo "totale fascie15:".$totaleFascie15;
								for ($i = 1; $i <= $totaleFascie15; $i++) {
									//echo 'inizio:'.$listOrarioCentroRaccolta[1]->inizio.' valore i:'.$i;
									$descFasciaOraria= date("H:i",($primaRiga->inizio  + (15*60* ($i-1) ) )).' - '.date("H:i",($primaRiga->inizio + (15*60* ($i) )));	
								 ?>				 
									<div class="radiobtn">
										<input type="radio" class="required" id="id<?=$value->idOrarioCentroRaccolta.'!'.$i?>"
														name="orarioCentroRaccolta" value="<?=$lidOrarioCentroRaccolta.'|'.$descFasciaOraria.'|'.$i ?>"  
											<?php
												//echo date("H:i",time()).'|';
												//echo date("H:i",($primaRiga->inizio  + (15*60* ($i) ) ));
												if (isset($listOrarioCentroRaccolta[$value->idOrarioCentroRaccolta.'!'.$i])) {
													if ( ($listOrarioCentroRaccolta[$value->idOrarioCentroRaccolta.'!'.$i]->disp==0) or ( ($controllo) and (date("H:i",($primaRiga->inizio  + (15*60* ($i) ) )) <= date("H:i",time()) ) ) )
														echo " disabled";											
												}
												else {	

													$lDataPrenotazione = str_replace('/', '-', $_POST['dataPrenotazione']);
													//echo 'data mod="'.$lDataPrenotazione.'" | ';
													$lDataPrenotazione = date('Y-m-d 00:00:00', strtotime($lDataPrenotazione));

													if ( ($lDataPrenotazione == date("Y-m-d 00:00:00") ) and ( date("H:i",($primaRiga->inizio  + (15*60* ($i) ) )) <= date("H:i",time()) ) )
														echo " disabled";
												}
											?>
										/>

										<label for="id<?=$value->idOrarioCentroRaccolta.'!'.$i?>"><?=$descFasciaOraria?>
										</label>


									</div>					 
						<?php 	} 
							} //chiusura IF 
						}
						?>				 					 
						
						</div>
						</div>




					


							<div class="control-group">
								<div class="control-label">
									<label>Rifiuto <span class="star">&nbsp;*</span></label>	
									<!--
									<br><br>Mantenere premuto<br>il tasto <b>ctrl</b> per selezionare più opzioni	
									-->		
								</div>
								
						<!--

								<select name="rifiuto[]" id="rifiuto" multiple style="height:35em; max-width: 900px;
							font-size: small; overflow-x:auto; overflow-y:auto;" required="required" aria-required="true">
										<?php foreach ($rifiuti as $idRifiuto => $rifiuto) { ?>
										<option value="<?=$idRifiuto?>" <?=getSelectedOption('rifiuto', $idRifiuto)?> >
										<?=output($rifiuto->descRifiuto)?></option>
										<?php } ?>
									</select>
									<?=$validator->outputError('rifiuto')?>
									-->
									<?php foreach ($rifiuti as $idRifiuto => $rifiuto) { ?>
										<div class="controls" >

										<?php if (strpos($rifiuto->descRifiuto, 'ALTRO') !== false ) { 
											$altro= '<input type="checkbox" name="rifiuto[]" id="rifiuto" value="'.$rifiuto->idRifiuto.'" size="30"  />'.$rifiuto->descRifiuto;
											?>				  
										<?php } else { ?>	
											<input type="checkbox" name="rifiuto[]" value="<?=output($rifiuto->idRifiuto)?>" 
												   <?php
														$cer=false;
														$codiciCer = array('20.01.21', '20.01.23', '20.01.35','20.01.35-R2','20.01.35-R3', '20.01.36');
												   		foreach ($codiciCer as $codiceCer) {
															if (strpos($rifiuto->cer, $codiceCer) !== FALSE) {
																echo 'onClick="javascript:condizioneCer(this)"'; 
																break;
															}
														}
													
												   ?>
												   size="30"  />
											<?=output($rifiuto->descRifiuto)?>
											<b>&nbsp;<?=output($rifiuto->max)?></b><br>
											<?php if (!($rifiuto->max)) { ?>
												<input type="radio" checked="checked" value="0" name="rifiutoM3[<?=$idRifiuto?>]"  style="margin-left: 15px"> <i>minore o uguale a 1 </i>  
												<input type="radio" value="1" name="rifiutoM3[<?=$idRifiuto?>]" style="margin-left: 10px"> <i> maggiore di 1 (metro cubo)</i>
											<?php } ?>
										<?php } ?>
										
										</div>
									<?php } ?>
									
			
       								<div id="rifiutiNew">
										
									</div>
		
       </div>

	  <!-- Ricerca rifiuti di Verdegufo -->
	  <div class="control-group">
		  <div class="control-label">
			
		  </div>
		  <div class="controls">
			<label>La selezione dei materiali sopra indicati ha soddisfatto le tue necessità?</label>
			<label for="rdo2" style="margin-right: 10px">
				<input type="radio" id="soddisfatto" style="float: left; margin-left: 5px; margin-right: 5px" name="altroverdeg"  checked="checked"> 
				SI
			</label>

			<label for="rdo1" >
				<input type="radio" id="nonsoddisfatto" style="float: left; margin-right: 5px" name="altroverdeg">NO
			</label>
			
			<div id="divVerdeg" style="display: none">
				<br>
				<div class="informa" style="display: none">
					Nuovo materiale aggiunto nella lista!
				</div>
				<div class="segnala" style="display: none">
					Il materiale non può essere conferito per la tua tipologia di utente al centro di raccolta selezionato!
				</div>

				<i>(inserisci il rifiuto da cercare, min. 2 caratteri)</i>
				<input type="text" id="searchrifiuti" value="" class="uk-width-1-1" autocomplete="off">
				<input type="hidden" id="idrifiuto" value="">

			    <!-- Show Results -->
			    <h4 id="results-textrifiuti">Lista risultati per la ricerca: <b id="search-stringrifiuti">Array</b></h4>
			    <ul id="resultsrifiuti"></ul>

			
			  
				<br />
				<?=$altro?>
				<div id="rigaNote" style="display: none">
				  <div >
					<label>Note</label>						
				  </div>
				  <div >
					<textarea style="width: 100%;" cols="" rows="" name="note" id="note" placeholder=""><?=getInputValue('note')?></textarea>
					<!--<input type="text" name="note" maxlength="1000" 
								value="<?=getInputValue('note')?>" />-->
				  </div>
				</div>	
				
				
				
			 </div> <!-- fine divVerdeg -->
			  
		  </div>

	  </div>
	  
<!--
	   <div class="control-group">
	   <div class="control-label">
        <label>Quantitativo rifiuti</label>
      </div>
      <div class="controls">
		<label for="rdo2" style="margin-right: 10px">
			<input type="radio"  style="float: left; margin-right: 5px" name="quantita"  checked="checked" value="0"> minore o uguale ad 1 metro cubo
		</label>	
		  
        <label for="rdo1" >
			<input type="radio"  style="float: left; margin-right: 5px" name="quantita"  value="1"> maggiore di 1 metro cubo
		</label>
				
      </div>
      
    </div>
-->


					<?php }?>	
		
		
		
		
		<?php }?>	
		
		

	<?php }?>
	
    
   
  
       
   

   
   <div class="control-group">
      <div class="control-label">
        <label>Data Richiesta</label>						
      </div>
      <div class="controls">
	    <?=util\Dates::formatDate(util\Dates::today())?>
	  </div>
	  
   </div>
	 
<?php if ($idTipologiaUtente==1) {?>
   <div class="control-group">
      <div class="control-label">
        				
      </div>
      <div class="controls">
	    <div id="rigaCondizione" style="display: none">
		  <div>
			<label id="testoCondizione">Il servizio è riservato ai distributori/installatori/gestori centro assistenza tecnica di AEE secondo le modalità previste dal  D.M. 08/03/2010 n° 65, ed ai produttori di RAEE non professionali (RAEE di origine commerciale, industriale, istituzionale e di altro tipo analoghi, per natura e per quantità, a quelli originati dai nuclei domestici)</label>
			  <input type="radio" value="0" name="condizione" style="margin-left: 10px"> distributore/installatore/gestore centro assistenza tecnica di AEE (conferimento accompagnato dal formulario semplificato)<br>
			  <input type="radio" value="1"  name="condizione" style="margin-left: 10px"> produttore di RAEE non professionali
		  </div>
			<div id="xerrore"></div>
		</div>	
	  </div>
	  
   </div>
<?php }
	else {
?>
	<input type="radio" value="" name="condizione" style="display: none">
<?php } ?>
	
	  
<!--  
   <div class="control-group">
          <div class="controls">
            <input type="checkbox" name="condizioni" value="true" class="required" size="30" required="required" aria-required="true" />
			&nbsp;&nbsp;"consapevole delle sanzioni previste, dichiaro che l'azienda svolge attivita'� consentita dalle norme vigenti in materia di contenimento del COVID19"
			<?=$validator->outputError('condizioni')?>
          </div>
        </div>	
-->   
	  
  </fieldset>
  
</fieldset>
	<br/> 
   <div class="control-group">
		<div class="controls">
			<button type="submit" id="salva" name="salva" value="Salva" class="btn btn-primary">invia</button>
			<button type="reset" name="annulla" value="Annulla" class="cancel btn btn-primary">annulla</button>
		</div>
	</div>    
</form>
<script type="text/javascript">
		$(document).ready (function() {
			
			//Inizio ricerca rifiuti Verdegufo
			// Icon Click Focus 
			$('div.icon').click(function(){ $('input#searchrifiuti').focus(); }); 
			//Listen for the event 
			$("body").on("keyup", "#searchrifiuti", function(e) { 
				// Set Timeout 
				clearTimeout($.data(this, 'timer')); 
				// Set Search String 
				var search_string = $(this).val(); 
				// Do Search 
				$(".informa").fadeOut();
				if (search_string == '') { 
					$("ul#resultsrifiuti").fadeOut(); 
					$('h4#results-textrifiuti').fadeOut(); 
				}
				else { 
					if ($(this).val().length >= 2) { //eseguo solo se testo cercato maggiore di 2 caratteri
						$("ul#resultsrifiuti").fadeIn(); 
						$('h4#results-textrifiuti').fadeIn(); 
						$(this).data('timer', setTimeout(search, 100)); 
					}
				}; 
			});
			
			// Live Search 
			// On Search Submit and Get Results 
			function search() { 
				var query_value = $('input#searchrifiuti').val(); 
				$('b#search-stringrifiuti').html(query_value); 
				if(query_value !== ''){ 
					$.ajax({ 
						type: "POST", 
						url: "ctrl/searchrifiuti.php", 
						data: { query: query_value, 
							    idTipologiaUtente : <?=$idTipologiaUtente?>, 
							    centroRaccolta : $('#centroRaccolta').val() 
							  }, 
						cache: false, 
						success: function(html){ 
							$("ul#resultsrifiuti").html(html); 
						} 
					}); 
				}
				return false; 
			}
			//FINE ricerca rifiuti Verdegufo
			
			$('#nuovaPrenotazione').on('click', '[name="salva"]', function(e) {
				//Rimuovo gli eventuali div di errore della validazione 
				//lato server
				$(".uk-alert-danger").remove();
				$("#nuovaPrenotazione").removeClass("uk-form-danger");
				
				//controllo se la condizione deve essere obbligatoria
				<?php if ($idTipologiaUtente==1) {?>
				if($('#conta').val() > 0){
					//if($("[name='condizione]").is(":checked")){ //se si verifico il check
				    if (!$("input[name='condizione']:checked").val()) {		
						$("#testoCondizione").css({"backgroundColor":"#e6e6e6","color":"red"});
						alert('Selezionare la tipologia di utenza');
						return false;
					}
					
				}
				<?php }?>
			
				rules = {
					 'orarioCentroRaccolta[]': {required:true}
				}
				
				$('#nuovaPrenotazione').validate({
					ignore: [],
					rules: rules,
					messages: {
					},
					errorClass: "uk-form-danger",
					errorPlacement: function (label, element) {
						// default
						if (element.is(':radio')) {
							label.insertAfter('#xerrore');       
						}
						else {
							label.insertAfter(element);
						}
					},
					onfocusout: false
				});
				
			});

			 $("#rifiuto").change(function(){
				 	if ($(this).is(":checked")){				
						$("#rigaNote").css("display", "block");
						$("#note").prop('required',true);
					}
				 	else {
						$("#rigaNote").css("display", "none");
						$("#note").prop('required',false);
					}
				});
			
			$("#soddisfatto").change(function(){
				 	if( $(this).is(":checked") ){			
						$("#divVerdeg").css("display", "none");
					}
				 	else {
						$("#divVerdeg").css("display", "block");
					}
				});
			$("#nonsoddisfatto").change(function(){
				 	if( $(this).is(":checked") ){			
						$("#divVerdeg").css("display", "block");
					}
				 	else {
						$("#divVerdeg").css("display", "none");
					}
				});
			
				
		});
	</script>


</div>

					</main>
					
					
				</div>
				
	            	            	            
			</div>
		</div>
	</div>
	
  
		<div class="tm-block tm-block-padding-top ">
		<div class=" uk-container uk-container-center">
			<section class="tm-bottom-a uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
<div class="uk-width-1-1"><div class="uk-panel">
	</div></div>
</section>
		</div>
	</div>
	
				<a class="tm-totop-scroller  tm-block-secondary" data-uk-smooth-scroll href="#"></a>
	
	
	</div>
