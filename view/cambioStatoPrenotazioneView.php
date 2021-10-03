	
	<div class="tm-wrapper">

		<div class="tm-block tm-block-padding-top">
	<!--	<div class=" uk-container uk-container-center">
			<section class="tm-top-a uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
<div class="uk-width-1-1"><div class="uk-panel">
	</div></div>
</section>
		</div> -->
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
						
						<?php if (isset($okMessage)) {?>
						<div class="uk-alert uk-alert-large uk-alert-success" data-uk-alert="">
							<button type="button" class="uk-alert-close uk-close"></button>							
							<p><?=$okMessage?></p>
						</div>
						<?php } ?>
						
						</div>

<button id="filtriButton" class="btn">Mostra filtri</button>
<script>
$(function() {
	$("#filtri").hide();
	
	$( "#filtriButton" ).click(function() {
	  $( "#filtri" ).toggle( "slow" );
		$(this).text(function(i, text) {
			  return text === "Nascondi filtri" ? "Mostra filtri" : "Nascondi filtri";
		})
	});

});
</script>
<div class="profile" id="filtri">    
            
      <form id="prenotazioni" action="ctrl/cambioStatoPrenotazioneCtrl.php" method="post" class="form-validate form-horizontal well">
		<fieldset id="users-profile-core">
        
		<legend>Filtri</legend>
  
		<fieldset class="uk-form">
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
              Rifiuto
            </label>
          </div>
          <div class="controls">
			<select name="rifiuto" id="rifiuto" style="font-size: 12px;">
				<option value="">- seleziona -</option>
				<?php foreach ($listaRifiuti as $idRifiuto => $rifiuto) { ?>
				<option value="<?=$idRifiuto?>" <?=getSelectedOption('rifiuto', $idRifiuto)?> >
				<?=output($rifiuto->descRifiuto)?></option>
				<?php } ?>
			</select>
           </div>
        </div>




		<?php if (empty($profilo->idCentroRaccolta)) { ?>
			<div class="control-group">
			<div class="control-label">
				<label id="jform_name-lbl" for="jform_name" class="hasTooltip">
				Centro di raccolta
				</label>
			</div>
			<div class="controls">
					<select name="centroRaccolta" id="centroRaccolta">
						<option value="">- seleziona un centro di raccolta -</option>
						<?php foreach ($listCentriRaccolta as $idCentroRaccolta => $centroRaccolta) { ?>
						<option value="<?=$idCentroRaccolta?>" <?=getSelectedOption('centroRaccolta', $idCentroRaccolta)?> >
						<?=output($centroRaccolta->nomeCentro . ' - ' . $centroRaccolta->indirizzo)?></option>
						<?php } ?>
					</select>
			</div>
			</div>
		<?php } ?>

		
		<div class="control-group">
			<div class="control-label">
				<label id="jform_name-lbl" for="jform_name" class="hasTooltip">
				Tipologia Utente
				</label>
			</div>
			<div class="controls">
			<select name="tipologiaUtente" id="tipologiaUtente">
				<option value="">- seleziona la tipologia dell'utente -</option>
				<?php foreach ($listTipologiaUtente as $idTipologiaUtente => $tipologiaUtente) { ?>
				<option value="<?=$idTipologiaUtente?>" <?=getSelectedOption('tipologiaUtente', $idTipologiaUtente)?> >
				<?=output($tipologiaUtente->descTipologiaUtente)?></option>
				<?php } ?>
			</select>
			</div>
		</div>
		
		
        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
			Denominazione/<BR/>Cognome Nome
            </label>
          </div>
          <div class="controls">
            <input type="text" id="denominazione" name="denominazione" maxlength="500" 
				value="<?=getInputValue('denominazione')?>" size="30">	
           </div>
        </div>
		
		<?php if (!empty($profilo->idConsorzio) || !empty($profilo->idCentroRaccolta)) { ?>
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
              Comune prenotazione
            </label>
          </div>
          <div class="controls">
			<input type="text" id="comune" name="comune" maxlength="255" 
				value="<?=getInputValue('comune')?>" size="30" autocomplete="off">
          </div>
        </div>
		
		<script>
		$(function() {
			$('#comune').quickselect({
				maxItemsToShow:20,
				minChars:2,
				ajax:"ctrl/ajax/getComuniDenominazioneCtrl.php",
				delay:400/*, 
				autoSelectFirst:false,
				selectSingleMatch:true/*,
				formatItem:function(data, index, total){return data[0]+", "+data[1]},
				additionalFields:[$('#denominazione')]*/
			});
		});
		</script>
    	<?php } ?>
        
        </fieldset>
  <br/>
              
	<div class="control-group">
		<div class="controls">
			<button type="submit" id="filtraSubmit" name="filtra" value="filtra" class="btn btn-primary">filtra</button>
		</div>
	</div>

</fieldset>
</form>
     </div>


<?php if (!isset($nascondiPrenotazioni)) { ?>
<div class="profile">

<fieldset id="users-profile-core">
	<legend>
		Elenco prenotazioni	in stato confermata
  </legend>
	

<?php if (count($listPrenotazioni) > 0) { ?>

<button id="cambiaStato1" class="btn btn-primary">Cambia stato</button>
<form id="cambiaprenotazione" action="ctrl/cambioStatoPrenotazioneCtrl.php" method="post" class="form-validate form-horizontal well">
<input type="hidden" name="changeStato" id="changeStato" value="" />
<input type="hidden" name="statoScelto" id="statoScelto" value="" />
<input type="hidden" name="motivazioneScelta" id="motivazioneScelta" value="" />
<table id="tabellaPrenotazioni" class="uk-table uk-table-striped uk-table-condensed uk-table-hover" style="font-size: smaller;">
     <thead>
      <tr>
	   <th>
		<input type="checkbox" id="ckbCheckAll" style="margin-left: -1px" />
	   </th> 
	   <th>Identificativo<br/>Prenotazione</th>
	   <th>Denominazione/<BR/>Cognome Nome</th>
	   <th>Telefono</th>
	   <th>Rifiuto</th>
	   <th>Centro di raccolta</th>
	   <th>Data Prenotazione</th>
	   <th>Sede Azienda</th>
	   <th>Stato</th>
	   <th>Data<br/>richiesta</th>
	   <th>&nbsp;</th>
      </tr>
     </thead>
     <tbody>
		<?php foreach ($listPrenotazioni as $key => $prenotazione) { ?>
		<tr>
	   <td>
		<input name="idPrenotazione[]" id="idPrenotazione" type="checkbox" value="<?=$prenotazione->idPrenotazione?>" />
		<input name="idAziendaStorico[]" id="idAziendaStorico<?=$prenotazione->idPrenotazione?>" type="checkbox" style="display: none" value="<?=$prenotazione->azienda->idAzienda?>" />
		<input name="idTipologiaStorico[]" id="idTipologiaStorico<?=$prenotazione->idPrenotazione?>" type="checkbox" style="display: none" value="<?=$prenotazione->azienda->idTipologiaUtente?>" />
	   </td>	
	   
	   <td><?=$prenotazione->idPrenotazione?></td>
	   <td><?=$prenotazione->azienda->denominazione?></td>	
	   <td><?=$prenotazione->azienda->telefono?></td>
	   <td><?=$prenotazione->descRifiuti?></td>	
	   <td><?=$prenotazione->centroRaccolta->nomeCentro?></BR>
	   <?=$prenotazione->centroRaccolta->indirizzo?>
	   </td>	
	   <td><?=$prenotazione->dataPrenotazione?></BR>
	   <?=$prenotazione->descFasciaOraria?>
	   </td>	
	   <td><?=$prenotazione->sede->comuneSede?></td>	
	   <td><?=$prenotazione->descStato?></td>
	   <td><?=$prenotazione->data?></td>
	   <td>
	   </td>
      </tr>
	<?php } ?>
	 </tbody>
    </table>
	</form>
	<div id="paginatore" style="margin: auto;">
    </div>
	<br />
	<button id="cambiaStato2" class="btn btn-primary">Cambia stato</button>
	
	<script type="text/javascript">

        $(document).ready(function () {
			
			//Bruno: imposto la selezione della checkbox nascosta con avere l'idAzienda selezionata
			$("input[id=idPrenotazione]").bind("click", function(Event){
				if($(this).prop('checked') == true){
					$("#idAziendaStorico"+this.value).prop('checked', true);
					//console.log(this.value);
				}
				else{
					$("#idAziendaStorico"+this.value).prop('checked', false);
					//console.log(this.value);
				}
				if($(this).prop('checked') == true){
					$("#idTipologiaStorico"+this.value).prop('checked', true);
					//console.log(this.value);
				}
				else{
					$("#idTipologiaStorico"+this.value).prop('checked', false);
					//console.log(this.value);
				}
			 });

			
												   
            $('#paginatore').smartpaginator({ 
				totalrecords: <?=count($listPrenotazioni)?>, 
				recordsperpage: 100, 
				length: 5,
				datacontainer: 'tabellaPrenotazioni', 
				dataelement: 'tr', 
				initval: 0, 
				theme: 'blu' });
			
			$("#ckbCheckAll").click(function () {
				$("input[id=idPrenotazione]").prop('checked', $(this).prop('checked'));
			});	
			
			$("#cambiaStato1,#cambiaStato2").click(function () {
				//Verifico le prenotazioni selezionate
				var values = $('input[id=idPrenotazione]:checked').map(function () {
				  return this.value;
				}).get(); 
				if (values=== undefined || values.length==0){
					$("#nessunaPrenotazione").modal("show");
				} else {
					$("#stato").val("");
					$("#motivazione").val('');
					$("#spanPren").text(values.length);
					$("#cambioStatoPrenorazione").modal("show");
				}
			});
			
			$("#salvaNuovoStato").click(function () {
				changeStato
				$('#cambiaprenotazione #changeStato').val('changeStato'); 
				if ($('#stato').val()==''){
					alert('Selezionare il nuovo stato Prenotazione');
					return false;
				}
				else{
					if (($('#stato').val()==3) && ($('#motivazione').val()=='')){
						alert('Nel caso si selezioni lo stato "Respinta" sarà necessario inserire una motivazione');
						return false;
					}
					else {
						$('#cambiaprenotazione #statoScelto').val($('#stato').val()); 
						$('#cambiaprenotazione #motivazioneScelta').val($('#motivazione').val()); 
						$('#cambiaprenotazione').submit();
					}
				}
			});
        });
		

    </script>
	<?php } else { ?>
		<p>Non ci sono prenotazioni</p>
	<?php
	}
	?>
	<br />
	
</fieldset>

</div>
<?php } ?>

					</main>
					
				</div>
				     	            
			</div>
		</div>
	</div>
	

  
		<div class="tm-block tm-block-padding-top ">
		<div class=" uk-container uk-container-center">
			<section class="tm-bottom-a uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}">
<div class="uk-width-1-1"><div class="uk-panel">
	</div></div>
</section>
		</div>
	</div>
	
				<a class="tm-totop-scroller  tm-block-secondary" data-uk-smooth-scroll href="#"></a>
	
	
	</div>

	
	
	<!-- inizio modal nessuna prenotazione selezionata-->
	<div class="modal hide fade" id="nessunaPrenotazione" tabindex="-1" role="dialog" aria-labelledby="nessunaPrenotazioneModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Chiudi"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="nessunaPrenotazioneModalLabel">Non &egrave; stata selezionata nessuna prenotazione</h4>
				</div>
				<div class="modal-body">
					<p><?=output($nuovaPrenotazione->descPrenotazione)?></p>
					<p>Selezionare le prenotazioni per le quali si desidera effettuare il passaggio di stato.</p>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>	
			</div>
		</div>
	</div>
	<!-- fine modal nessuna prenotazione selezionata -->

	<!-- inizio modal cambio stato alle prenotazioni selezionate-->
	<div class="modal hide fade" id="cambioStatoPrenorazione" tabindex="-1" role="dialog" aria-labelledby="cambioStatoPrenorazioneModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Chiudi"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="cambioStatoPrenorazioneModalLabel">Verr&agrave; cambiato lo stato per le  <span id="spanPren"> </span> prenotazioni selezionate</h4>
				</div>
				<div class="modal-body">
					<p>&Egrave possibile portare lo stato per le prenotazioni selezionate a <b>"Evasa"</b>,<b>"Non presentato"</b> oppure <b>"Respinta"</b>. 
						Nel caso si selezioni lo stato <b>"Respinta"</b> sar&agrave; necessario inserire una motivazione.
					   </p>
					<br />
					
					<div class="uk-grid">
						<div class="uk-width-3-10">
							<div class="control-label">
							<label id="jform_name-lbl" for="jform_name" class="hasTooltip">
								Nuovo stato Prenotazione
							</label>
							</div>
							<div class="controls">
								<select name="stato" id="stato" required>
									<option value="">- seleziona -</option>
									<option value="4">Evasa</option>
									<option value="2">Non presentato</option>
									<option value="3">Respinta</option>
								</select>
							</div>
						</div>
						
						<div class="uk-width-7-10">
							<div class="control-label">
							<label id="jform_name-lbl" for="jform_name" class="hasTooltip">
								Motivazione
							</label>
							</div>
							<div class="controls">
							<textarea name="motivazione" id="motivazione" rows="5" cols="120" style="width: 70%; height: 40px" > 
							</textarea>	
							</div>
						</div>
						
					</div>
				
				</div>
			</div>
			<div class="modal-footer">
			    <button id="salvaNuovoStato" type="button" class="btn btn-default" data-dismiss="modal">Salva nuovo stato</button> 
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>	
			</div>
		</div>
	</div>
	<!-- fine modal cambio stato alle prenotazioni selezionate-->
	
	