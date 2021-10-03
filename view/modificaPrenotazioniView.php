<script type="text/javascript">
$.validator.addMethod(
	"maxQuantita",
	function(value, element) {
		var maxQuantita = $('#maxQuantita').val();
		return this.optional(element) || maxQuantita == '' || +maxQuantita >= value.replace(',', '.');
	},
	"Controlla il contenuto del campo."
);

$.validator.addMethod(
	"minQuantita",
	function(value, element) {
		return this.optional(element) || +<?=$minQuantita?> <= value.replace(',', '.');
	},
	"Controlla il contenuto del campo."
);


$.validator.addMethod(
	"precisione",
	function(value, element) {
		var precisione = $('#precisione').val();
		var re = new RegExp("^\\d{0,11}(\\,\\d{0,"+precisione+"})?$");
		return this.optional(element) || precisione == '' || re.test(value);
	},
	"Controlla il contenuto del campo."
);

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
		
<form id="modificaPrenotazione" name="modificaPrenotazione" method="post" action="ctrl/modificaPrenotazioniCtrl.php" class="form-validate form-horizontal well">
<input type="hidden" value="<?=$prenotazione->idPrenotazione?>" name="idPrenotazione" id="idPrenotazione">
<fieldset id="users-profile-core">
	<legend>
		Modifica prenotazione	</legend>
  
  <fieldset class="uk-form">
    
	<div class="control-group">
      <div class="control-label">
        <label>Sede</label>						
      </div>
      <div class="controls">
      	<?=output($prenotazione->sede->comuneSede . ' - ' . $prenotazione->sede->indirizzoSede)?>
      </div>
   </div>
    
    <div class="control-group">
      <div class="control-label">
        <label>Descrizione rifiuto</label>						
      </div>
      <div class="controls">
      	<?=output($prenotazione->rifiuto->descRifiuto)?>
      </div>
	  <?php if ($prenotazione->rifiuto->idRifiuto==1) {?>
		<!-- 1 fitofarmaci -->
			<div class="controls">
				<b>Attenzione: i contenitori bonificati per fitofarmaci saranno ritirati solo se lavati, risciacquati almeno 3 volte, inseriti in sacco trasparente e con l'etichetta riportante: 1 ragione sociale azienda; 2 indirizzo; 3 partita iva azienda</b>
			</div>
		<?php } ?>
		<?php if ($prenotazione->rifiuto->idRifiuto==2) {?>
		<!-- 2 teli agricoli -->
			<div class="controls">
				<b>Attenzione: i teli agricoli vengono ritirati solo se si presentano ben puliti e piegati</b>
			</div>
		<?php } ?>
   </div>
   
   <div class="control-group">
      <div class="control-label">
        <label>Quantità <span class="star">&nbsp;*</span></label>						
      </div>
      <div class="controls">
		<?php if ($flagRifiutiTeli) { ?>
		<select name="quantita" id="quantita">
			<option value="" <?=getSelectedOption('quantita', '', $prenotazione->quantita)?> >- seleziona -</option>
			<option value="0,2" <?=getSelectedOption('quantita', '0,2', $prenotazione->quantita)?> >0,2</option>
			<option value="0,4" <?=getSelectedOption('quantita', '0,4', $prenotazione->quantita)?> >0,4</option>
			<option value="0,6" <?=getSelectedOption('quantita', '0,6', $prenotazione->quantita)?> >0,6</option>
			<option value="0,8" <?=getSelectedOption('quantita', '0,8', $prenotazione->quantita)?> >0,8</option>
			<option value="1" <?=getSelectedOption('quantita', '1', $prenotazione->quantita)?> >1</option>
		</select>
		<?php }else { ?>
      	<input type="text" name="quantita" maxlength="16" 
					value="<?=getInputValue('quantita', $prenotazione->quantita)?>" /> 
		<?php } ?><?=output($prenotazione->rifiuto->unitaMisura)?>
		<?=$validator->outputError('quantita')?>			
		<input type="hidden" id="maxQuantita" name="maxQuantita" 
			value="<?=output($prenotazione->rifiuto->valMax)?>" />
		<input type="hidden" id="precisione" name="precisione" 
			value="<?=output($prenotazione->rifiuto->cifreDecimali)?>" />	
    </div>
   </div>
   
   <div class="control-group">
      <div class="control-label">
        <label>Scadenza prenotazione</label>						
      </div>
      <div class="controls">
      	<?=output($prenotazione->dataFinePrenotazione)?>
      </div>
	  <div class="controls">
		<b>Attenzione, le prenotazioni effettuate entro questa scadenza saranno soddisfatte nel mese successivo la scadenza stessa.</b>
	  </div>
   </div>
   
   <div class="control-group">
      <div class="control-label">
        <label>Note</label>						
      </div>
      <div class="controls">
      	<textarea cols="" rows="" name="note" placeholder=""><?=$prenotazione->note?></textarea>
      	<!--<input type="text" name="note" maxlength="1000" 
					value="<?=getInputValue('note')?>" />-->
    </div>
   </div>
   
   <div class="control-group">
      <div class="control-label">
        <label>Data Richiesta</label>						
      </div>
      <div class="controls">
      	<?=util\Dates::formatDate(util\Dates::today())?>
    </div>
   </div>
   
  </fieldset>
  <br/>
              
	<!-- <li class="btn-group">
		<input type="submit" name="salva" value="Salva" />
	</li>-->
	<div class="control-group">
		<div class="controls">
			<button type="submit" name="salva" value="Salva" class="btn btn-primary">salva</button>
			<button type="submit" name="annulla" value="Annulla" class="cancel btn btn-primary">annulla</button>
		</div>
	</div>

</fieldset>
</form>
<script type="text/javascript">
		$(document).ready (function() {
		
			$('#modificaPrenotazione').on('click', '[name="salva"]', function(e) {
				//Rimuovo gli eventuali div di errore della validazione 
				//lato server
				$(".uk-alert-danger").remove();
				$("#modificaPrenotazione").removeClass("uk-form-danger");
				
				rules = {
					quantita: {required:true,
							   <%=($prenotazione->rifiuto->cifreDecimali > 0 ? "precisione:true" : "digits:true")%>,
							   minQuantita:true,
							   maxQuantita:true},
					note: {
						maxlength: 1000
					}
				}

				$('#modificaPrenotazione').validate({
					rules: rules,
					messages: {
						quantita: {
							precisione: "Il valore deve contenere al massimo "+$('#precisione').val()+" cifre decimali",
							minQuantita: "Il valore non deve essere inferiore a <?=util\Numbers::formatQuantity($minQuantita)?>",
							maxQuantita: "Il valore non deve essere superiore a " + $('#maxQuantita').val()
						}
					},
					errorClass: "uk-form-danger",
					onfocusout: false
				});	
				
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