	
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
	
	$( "#dataPresentazione" ).datepicker({    
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd-mm-yy'
	});

});
</script>
<div class="profile" id="filtri">    
            
      <form id="prenotazioni" action="ctrl/prenotazioniConsorzioCtrl.php" method="post" class="form-validate form-horizontal well">
		<input type="hidden" name="excel" id="excel" value="" />
		<fieldset id="users-profile-core">
        
		<legend>Filtri</legend>
  
		<fieldset class="uk-form">
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
              Stato prenotazione
            </label>
          </div>
          <div class="controls">
			<?php if (count($listaStati) > 0) { ?>
			<select name="stato" id="stato">
				<option value="">- seleziona -</option>
				<?php foreach ($listaStati as $idStato => $stato) { ?>
				<option value="<?=$idStato?>" <?=getSelectedOption('stato', $idStato)?>>
				<?=output($stato->descStato)?></option>
				<?php } ?>
			</select>
			<?php } else { ?>
			<input type="hidden" name="stato" value="<?=ID_STATO_RICHIESTA?>" />
			Richiesta
			<?php } ?>
           </div>
        </div>
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
              Rifiuto
            </label>
          </div>
          <div class="controls">
			<select name="rifiuto" id="rifiuto">
				<option value="">- seleziona -</option>
				<?php foreach ($listaRifiuti as $idRifiuto => $rifiuto) { ?>
				<option value="<?=$idRifiuto?>" <?=getSelectedOption('rifiuto', $idRifiuto)?> >
				<?=output($rifiuto->descRifiuto)?></option>
				<?php } ?>
			</select>
           </div>
        </div>
		
		<script>
		$(function() {
			$("#rifiuto").change(function() {
				if ($("#rifiuto").val()) {
					var firstOption = $("#dataPrenotazione option:first");
					$("#dataPrenotazione").find('option').remove().end().append(firstOption);
					
					//Mostra la select
					$("#dataPrenotazione").closest("div .control-group").show();	
					
					var request = $.post(
						"ctrl/ajax/getDatePrenotazioneCtrl.php", {
							rifiuto : $("#rifiuto").val()
						}
					)
					.fail(function(jqXHR, textStatus, errorThrown) {
							console.log('server-side failure with status code ' + textStatus + ' and error ' + errorThrown);
					})
					
					request.done(function(data) {
						//Popola la select con i dati restituiti dalla chiamata al server
						var options = $.parseJSON(data);
						
						$.each(options, function(i, d) {
							$('#dataPrenotazione').append('<option value="' + d.idDataPrenotazione + '">' + d.dataPrenotazione + '</option>');
						});
					});
				}else {
					$("#dataPrenotazione").closest("div .control-group").hide();
				}
			});
		});
		</script>
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
              Data Presentazione
            </label>
          </div>
          <div class="controls">
            <input type="text" id="dataPresentazione" name="dataPresentazione"
				value="<?=getInputValue('dataPresentazione')?>" >	
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
              Partita IVA Azienda
            </label>
          </div>
          <div class="controls">
            <input type="text" id="partitaIVA" name="partitaIVA" maxlength="500" 
				value="<?=getInputValue('partitaIVA')?>" size="30">	
           </div>
        </div>

		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
			  Codice Fiscale Utenza domestica
            </label>
          </div>
          <div class="controls">
            <input type="text" id="codiceFiscale" name="codiceFiscale" maxlength="500" 
				value="<?=getInputValue('codiceFiscale')?>" size="30">	
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
		Elenco prenotazioni	
		<?php if (count($listPrenotazioni) > 0) { ?>
		<div class="profile" style="float:right; font-size:16px">    	 
  	<a href="javascript: $('#prenotazioni #excel').val('excel'); $('#prenotazioni').submit(); $('#prenotazioni #excel').val('');"><img src="img/excel.png" title="Scarica in formato Excel"> Scarica in formato Excel</a>
    </div>
		<?php } ?>
  </legend>
	

<?php if (count($listPrenotazioni) > 0) { ?>

<table id="tabellaPrenotazioni" class="uk-table uk-table-striped uk-table-condensed uk-table-hover">
     <thead>
      <tr>
	   <th>Identificativo<br/>Prenotazione</th>
	   <th>Data Prenotazione</th>
	   <th>Denominazione/<BR/>Cognome Nome</th>
	   <th>Telefono</th>
	   <th>Email</th>
	   <th>Utenza</th>
	   <th>Partita IVA/<br/>Cod. Fiscale</th>
	   <th>Rifiuto</th>
	   <th>Centro di raccolta</th>
	   
	   <!--<th>Sede Azienda</th>  -->
	   <th>Stato</th>
	   <!--<th>Data<br/>richiesta</th> -->
	   <th>&nbsp;</th>
      </tr>
     </thead>
     <tbody>
		<?php foreach ($listPrenotazioni as $key => $prenotazione) { ?>
	<!--	<tr class="uk-alert-success"> -->
	   <td><?=$prenotazione->idPrenotazione?></td>
	   <td><?=$prenotazione->dataPrenotazione?></BR>
	   <?=$prenotazione->descFasciaOraria?>
	   </td>	
	   <td><?=$prenotazione->azienda->denominazione?></td>	
	   <td><?=$prenotazione->azienda->telefono?></td>
	   <td><?=$prenotazione->azienda->email?></td>
	   <td><?=$prenotazione->azienda->descTipologiaUtente?></td>
	   <td><?=$prenotazione->azienda->partitaIVA?><?=$prenotazione->azienda->codiceFiscale?></td>
	   <td><?=$prenotazione->descRifiuti?><br/><?=$prenotazione->note?></td>	

	   <td><?=$prenotazione->centroRaccolta->nomeCentro?></BR>
	   <?=$prenotazione->centroRaccolta->indirizzo?>
	   </td>	
	   

	   <!--<td><?=$prenotazione->sede->comuneSede?></td>	-->
	    <?php if ($prenotazione->idStato==4) { ?>
	   		<td class="uk-alert-success"><?=$prenotazione->descStato?></td>
		<?php } else if ($prenotazione->idStato==3) {?>	
		    <td class="uk-alert-danger"><?=$prenotazione->descStato?></td>  
		<?php } else if ($prenotazione->idStato==2) {?>	
		    <td class="uk-alert-warning"><?=$prenotazione->descStato?></td>
		<?php } else {?>
			<td><?=$prenotazione->descStato?></td> 
	   <?php } ?>
	   <!--<td><?=$prenotazione->data?></td> -->
	   <td>
	   </td>
      </tr>
	<?php } ?>
	 </tbody>
    </table>
	<div id="paginatore" style="margin: auto;">
    </div>
	<script type="text/javascript">

        $(document).ready(function () {

            $('#paginatore').smartpaginator({ 
				totalrecords: <?=count($listPrenotazioni)?>, 
				recordsperpage: 10, 
				length: 5,
				datacontainer: 'tabellaPrenotazioni', 
				dataelement: 'tr', 
				initval: 0, 
				theme: 'blu' });
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

	
	<?php if (isset($nuovaPrenotazione)) { ?>
	<!-- inizio modal prenotazione inserita -->
	<div class="modal fade" id="nuovaPrenotazioneModal" tabindex="-1" role="dialog" aria-labelledby="nuovaPrenotazioneModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Chiudi"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="nuovaPrenotazioneModalLabel">Prenotazione inserita con successo</h4>
				</div>
				<div class="modal-body">
					<p><?=output($nuovaPrenotazione->descPrenotazione)?></p>
					<p>Sarete contattati al recapito telefonico indicato in anagrafica per concordare<br/> 
					   la data, l'orario e le modalit&agrave; esatte di esposizione dei rifiuti che la ditta incaricata provveder&agrave; a ritirare</p>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>	
			</div>
		</div>
	</div>
	<script>
		$(document).ready (function() {
			$("#nuovaPrenotazioneModal").modal("show");
		});
	</script>
	<!-- fine modal prenotazione inserita -->
	<?php } ?>
	
	