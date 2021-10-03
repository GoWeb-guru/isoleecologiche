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
      
      
      <form id="register" action="ctrl/aggiungiSedeCtrl.php" method="post" class="form-validate form-horizontal well">
	  
		<fieldset id="users-profile-core">
        
		<legend>Aggiungi sede</legend>
  
		<fieldset class="uk-form">
		
        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Comune:<span class="star">&nbsp;*</span>
            </label>
          </div>
		  <div class="controls">
			<select name="idComune" id="idComune">
				<option value="">- seleziona un comune -</option>
				<?php foreach ($comuni as $idComune => $comune) { ?>
				<option value="<?=$idComune?>" <?=getUpdateSelectedOption($sede->idComune, $idComune)?> >
				<?=output($comune->descComune)?></option>
				<?php } ?>
			</select>	
            <?=$validator->outputError('idComune')?>						
           </div>
        </div>
		
		
              
        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Indirizzo:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="indirizzo" maxlength="500" 
          value="<?=output($sede->indirizzo)?>"  class="required" size="30" required="required" aria-required="true">
            <?=$validator->outputError('indirizzo', 'input')?>						
           </div>
        </div>
        
		<!--
        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Note
            </label>
          </div>
		  <div class="controls">
		    <textarea cols="" rows="3" name="note" placeholder=""><?=output($sede->note)?></textarea>
            <?=$validator->outputError('note')?>						
           </div>
        </div>
		-->
		
        
        </fieldset>
  <br/>
              
	<!-- <li class="btn-group">
		<input type="submit" name="salva" value="Salva" />
	</li>-->
	<div class="control-group">
		<div class="controls">
			<button type="submit" name="salva" value="Salva" class="btn btn-primary">salva</button>
			<button type="submit" name="annulla" value="Annulla" formnovalidate class="cancel btn btn-primary">annulla</button>
		</div>
	</div>

</fieldset>
</form>
     </div>
 </main>
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
	</div>
	</div>
