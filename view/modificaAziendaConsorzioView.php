<script>
$.validator.addMethod(
	"regex",
	function(value, element, regexp) {
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
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
      
      
      <form id="modificaAziendaConsorzio" action="ctrl/modificaAziendaConsorzioCtrl.php" method="post" class="form-validate form-horizontal well">
		
	  <input type="hidden" name="idAzienda"  value="<?=$azienda->idAzienda?>" >
		
		<fieldset id="users-profile-core">

		
        
		<legend>Modifica dati utente</legend>
  
		<fieldset class="uk-form">

        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Denominazione:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="denominazione" maxlength="500" 
          value="<?=$azienda->denominazione?>"  size="30" aria-required="true">
            <?=$validator->outputError('denominazione')?>						
           </div>
        </div>
		
		
              
        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Codice Fiscale:<span class="star">&nbsp;*</span>
            </label>
          </div> 
			<div class="controls">
            <input type="text" name="codiceFiscale" maxlength="500" 
          value="<?=$azienda->codiceFiscale?>"   size="30"  aria-required="true">
            <?=$validator->outputError('codiceFiscale')?>						
           </div>
        </div>

		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Partita IVA:<span class="star">&nbsp;*</span>
            </label>
          </div> 
			<div class="controls">
            <input type="text" name="partitaIva" maxlength="500" 
          value="<?=$azienda->partitaIVA?>"  size="30"  aria-required="true">
            <?=$validator->outputError('partitaIva')?>						
           </div>
        </div>
        
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Telefono:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="telefono" maxlength="20" 
          value="<?=$azienda->telefono?>"  size="30" >
            <?=$validator->outputError('telefono')?>						
           </div>
        </div>

		<label for="rdo1" style="float: left; margin-right: 15px">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="rdo1"  id="domesticoRadio" name="idTipologiaUtente" value="2">
			<span>Utenza domestica</span>
		  </label>
		  <label for="rdo2">
			<input type="radio" id="rdo2" id="aziendaRadio" name="idTipologiaUtente" value="1">
			<span>Azienda</span>
		  </label>

		  <br/><br/>
   
		
        
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
		
			$('#modificaAziendaConsorzio').on('click', '[name="salva"]', function(e) {
				//Rimuovo gli eventuali div di errore della validazione 
				//lato server
				$(".uk-alert-danger").remove();
				$("#modificaAziendaConsorzio").removeClass("uk-form-danger");
				
				rules = {
					denominazione: {
						required: true
					},
					telefono: {
						required: true,
						regex: "^[1-9][0-9]+\$"
					},
					partitaIva: {
						regex: "^[0-9]{11}$"
					},
					codiceFiscale: {
						regex: "^[0-9]{11}$|^[A-Za-z]{6}[0-9]{2}[A-Za-z][0-9]{2}[A-Za-z][0-9]{3}[A-Za-z]$"
					},
				}

				$('#modificaAziendaConsorzio').validate({
					rules: rules,
					messages: {
							partitaIva: {
								regex: "Inserire una partita IVA"
							},
							codiceFiscale: {
								regex: "Inserire un codice fiscale o una partita IVA"
							},
                            telefono: {
								regex: "Inserire un numero di cellulare, non un numero di telefono fisso. Inserire solo numeri."
							}
						},
					errorClass: "uk-form-danger"
				});
			});


			<?php if ($azienda->idTipologiaUtente=='2') {?>
				$('input:radio[name=idTipologiaUtente][value=2]').attr('checked', true)
			<?php } else {?>
				$('input:radio[name=idTipologiaUtente][value=1]').attr('checked', true)
			<?php } ?>


		});
	</script>