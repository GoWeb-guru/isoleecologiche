
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
	

function abilitaModifica(){
	document.getElementById("divModifica").style.display = "";
	document.getElementById("divModifica2").style.display = "";
	document.getElementById("salva").style.display = "";
	document.getElementById("divVisualizza").style.display = "none";
	
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
						
<div class="profile">
		
<form id="dettaglioPrenotazione" name="dettaglioPrenotazione" method="post" action="ctrl/dettaglioPrenotazioniCtrl.php" class="form-validate form-horizontal well">
<input type="hidden" value="<?=$prenotazione->idPrenotazione?>" name="idPrenotazione" id="idPrenotazione">
<fieldset id="users-profile-core">
	<legend>
		Dettaglio richiesta prenotazione	</legend>
  
  <fieldset class="uk-form">
    
    <div class="control-group">
      <div class="control-label">
        <label>Identificativo univoco</label>						
      </div>
      <div class="controls">
      	<?=output($prenotazione->idPrenotazione)?>
      </div>
   </div>
    
	<div class="control-group">
      <div class="control-label">
        <label>Sede della tua azienda</label>						
      </div>
      <div class="controls">

	  <?php if (isset($prenotazione->sede->indirizzoSede) && ($prenotazione->sede->indirizzoSede!=null) ) {?>	
		<?=output($prenotazione->sede->comuneSede . ' - ' . $prenotazione->sede->indirizzoSede)?>
      <?php } else {?>
      	<?=output($prenotazione->sede->comuneSede)?>
	  <?php } ?>		  
      </div>
   </div>

   <div class="control-group">
      <div class="control-label">
        <label>Targa veicolo</label>						
      </div>
      <div class="controls">
		  <?=$prenotazione->targaStorico?>
      </div>
   </div>

   <?php if (isset($prenotazione->quantita) and 1==2 ) {?>	
   <div class="control-group">
      <div class="control-label">
        <label>Quantit&agrave;</label>						
      </div>
      <div class="controls">
		  <?=$prenotazione->quantita?>
      </div>
   </div>
   <?php } ?>

    
   <div class="control-group"  id="divVisualizza">
      <div class="control-label">
        <label>Rifiuto 
	<?php if ($prenotazione->idStato==1)  { ?>
		
	   &nbsp;   
	   <a title="Modifica prenotazione" onclick="abilitaModifica()">
	   <img src="img/modifica.png">
	   </a>
	   <?php } ?></label>						
      </div>
      <div class="controls">
		  <?=$prenotazione->descRifiuti?>
      </div>
	   
   </div>

	<input type="hidden" name="conta" id="conta" value="0">
	  

	<div class="control-group" id="divModifica" style="display: none">
		<div class="control-label">
			<label>Rifiuto <span class="star">&nbsp;*</span></label>	
			<!--
			<br><br>Mantenere premuto<br>il tasto <b>ctrl</b> per selezionare più opzioni	
			-->		
		</div>


			<?php foreach ($rifiuti as $idRifiuto => $rifiuto) { ?>
				<div class="controls" >

				<?php if (strpos($rifiuto->descRifiuto, 'ALTRO') !== false ) { 
					$altro= '<input type="checkbox" name="rifiuto[]" id="rifiuto"'. ( array_key_exists($rifiuto->idRifiuto, $prenotazione->idRifiuto) ? 'checked':'' ) .'value="'.$rifiuto->idRifiuto.'" size="30"  />'.$rifiuto->descRifiuto;
					?>				  
				<?php } else { ?>	
					<input type="checkbox" name="rifiuto[]" <?= ( array_key_exists($rifiuto->idRifiuto, $prenotazione->idRifiuto) ? 'checked':'' ) ?> value="<?=output($rifiuto->idRifiuto)?>" 
						   <?php
								$codiciCer = array('20.01.21', '20.01.23', '20.01.35','20.01.35-R2','20.01.35-R3', '20.01.36');
								foreach ($codiciCer as $codiceCer) {
									if (strpos($rifiuto->cer, $codiceCer) !== FALSE) {
										echo 'onClick="javascript:condizioneCer(this)"'; 
										break;
									}
								}
							  	echo $rifiuto->cer;
						   ?>
						   size="30"  />
					<?=output($rifiuto->descRifiuto)?>
					<b>&nbsp;<?=output($rifiuto->max)?></b><br>
					<?php if (!($rifiuto->max)) { //Bruno: se il rifiuto esiste dentro la prenotazione allora vado a reperire il valore dei metri cubi ?>
						<input type="radio" <?= ( array_key_exists($rifiuto->idRifiuto, $prenotazione->idRifiuto) ? ($prenotazione->idRifiuto[$rifiuto->idRifiuto]==0 ? 'checked="checked"':'' ):'checked="checked"' ) ?> value="0" name="rifiutoM3[<?=$idRifiuto?>]"  style="margin-left: 15px"> <i>minore o uguale a 1 </i>  
						<input type="radio" <?= ( array_key_exists($rifiuto->idRifiuto, $prenotazione->idRifiuto) ? ($prenotazione->idRifiuto[$rifiuto->idRifiuto]==1 ? 'checked="checked"':'' ):'' ) ?> value="1" name="rifiutoM3[<?=$idRifiuto?>]" style="margin-left: 10px"> <i> maggiore di 1 (metro cubo)</i>
					<?php } ?>
				<?php } ?>

				</div>
			<?php } ?>


			<div id="rifiutiNew">
					
				<?php foreach ($prenotazione->rifiutoVerdeg as $idRifiuto => $rifiutoM3) { ?>
				<div class="controls" >
				
					<input type="checkbox" name="rifiutoVerdeg[]" checked value="<?=output($idRifiuto)?>" 
						   <?php
								$codiciCer = array('20.01.21', '20.01.23', '20.01.35','20.01.35-R2','20.01.35-R3', '20.01.36');
								foreach ($codiciCer as $codiceCer) {
									if (strpos($rifiuto->cer, $codiceCer) !== FALSE) {
										echo 'onClick="javascript:condizioneCer(this)"'; 
										break;
									}
								}

						   ?>
						   size="30"  />
					<?=output($prenotazione->rifiutoVerdegDesc[$idRifiuto])?>
					<br>

					<input type="radio" <?= ($prenotazione->rifiutoVerdeg[$idRifiuto]==0 ? 'checked="checked"':'' ) ?> value="0" name="rifiutoM3[<?=$idRifiuto?>]"  style="margin-left: 15px"> <i>minore o uguale a 1 </i>  
					<input type="radio" <?= ($prenotazione->rifiutoVerdeg[$idRifiuto]==1 ? 'checked="checked"':'' ) ?> value="1" name="rifiutoM3[<?=$idRifiuto?>]" style="margin-left: 10px"> <i> maggiore di 1 (metro cubo)</i>
				
				</div>
			<?php } ?>
				
			</div>
		
       </div>

	  <!-- Ricerca rifiuti di Verdegufo -->
	  <div class="control-group" id="divModifica2" style="display: none">
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

			 </div> <!-- fine divVerdeg -->
			  
		  </div>

	  </div>
	  
	  
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
	  
	  
   <div class="control-group">
      <div class="control-label">
        <label>Note</label>						
      </div>
      <div class="controls">
		  <?=$prenotazione->note?>
      </div>
   </div>

   <div class="control-group">
      <div class="control-label">
        <label>Centro di raccolta</label>						
      </div>
	  <div class="controls">
	   <?php if (isset($prenotazione->centroRaccolta->nomeCentro) && ($prenotazione->centroRaccolta->nomeCentro!=null)) {?>
      	<?=output($prenotazione->centroRaccolta->nomeCentro)?> - 
		<?=output($prenotazione->centroRaccolta->indirizzo)?>
		<?php } ?>
      </div>
   </div>


   <div class="control-group">
      <div class="control-label">
        <label>Data Prenotazione</label>						
      </div>
	  <div class="controls">
	   <?php if (isset($prenotazione->dataPrenotazione) && ($prenotazione->dataPrenotazione!=null)) {?>
      	<?=output($prenotazione->dataPrenotazione)?>
		alle <?=output($prenotazione->descFasciaOraria)?>
		<?php } ?>	
      </div>
   </div>	
   
  <?php if (!empty($prenotazione->produttore)) { ?>
   <div class="control-group">
      <div class="control-label">
        <label></label>						
      </div>
	  <div class="controls">	   
			<?php 
				if($prenotazione->produttore ==0) 
					echo 'distributore/installatore/gestore centro assistenza tecnica di AEE (conferimento accompagnato dal formulario';
				else 
					echo 'produttore di RAEE non professionali';
			?>
			
      </div>
   </div>
  <?php } ?>
	  
   <div class="control-group">
      <div class="control-label">
        <label>Stato prenotazione</label>						
      </div>
	  <div class="controls">
      	<?=output($prenotazione->descStato)?>
      </div>
   </div>

   <?php if (isset($prenotazione->motivazione) && ($prenotazione->motivazione!=null)) {?>
   <div class="control-group">
      <div class="control-label">
        <label>Motivazione</label>						
      </div>
	  <div class="controls">
      	<?=output($prenotazione->motivazione)?>
      </div>
   </div>	
   <?php } ?>
   
   <div class="control-group">
      <div class="control-label">
        <label>Data Richiesta</label>						
      </div>
      <div class="controls">
	  <?=output($prenotazione->data)?>
    </div>
   </div>
   
  </fieldset>
  <br/>
              
	<!-- <li class="btn-group">
		<input type="submit" name="salva" value="Salva" />
	</li>-->
	<div class="control-group">
		<div class="controls">
			<button type="submit" id="salva" style="display: none" name="salva" value="Salva" class="btn btn-primary">Salva modifiche</button>
			<button type="submit" name="indietro" value="Indietro" class="cancel btn btn-primary">indietro</button>
			
		</div>
	</div>

</fieldset>
</form>


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
			
			$('#dettaglioPrenotazione').on('click', '[name="salva"]', function(e) {
				//Rimuovo gli eventuali div di errore della validazione 
				//lato server
				$(".uk-alert-danger").remove();
				$("#dettaglioPrenotazione").removeClass("uk-form-danger");
				
				//controllo se la condizione deve essere obbligatoria
				if($('#conta').val() > 0){
					//if($("[name='condizione]").is(":checked")){ //se si verifico il check
				    if (!$("input[name='condizione']:checked").val()) {		
						$("#testoCondizione").css({"backgroundColor":"#e6e6e6","color":"red"});
						alert('Selezionare la tipologia di utenza');
						return false;
					}					
				}
				
				if (! ($("input[name='rifiuto[]']:checked").length || $("input[name='rifiutoVerdeg[]']:checked").length) ) {	
					alert('Selezionare almeno un rifiuto');						
					return false;
				}
				
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
