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

<div class=" uk-container uk-container-center">
  <div class="tm-middle uk-grid">
    <main class="tm-main uk-width-medium-1-1">
    
    
    <div id="system-message-container">
			<?php if (isset($errorMessage)) {?>
      <div class="uk-alert uk-alert-large uk-alert-warning" data-uk-alert="">
        <button type="button" class="uk-alert-close uk-close"></button>
        <h2>Attenzione</h2>
        <p><?=$errorMessage?></p>
      </div>
      <?php } ?>
    </div>
    
    <div class="registration">      
      <div class="page-header">
        <div class="uk-hidden-large" style="margin-top:10px; "><h2>SISTEMA DI PRENOTAZIONE PER IL RITIRO DEI RIFIUTI INGOMBRANTI</h2></div>
        <h2>Nuova Utenza Aziendale</h2>
		<span style="font-size: smaller;"> (* = Campo Obbligatorio) <span>
      </div>
      
      
      <form id="register" action="ctrl/aggiungiUtenzaAziendaleCtrl.php" method="post" class="form-validate form-horizontal well">
        
		<h4>Dati Utente</h4>

		  <style>
		  .rdo
			  position: relative
			  display: block
			  float: left
			  width: 18px
			  height: 18px
			  border-radius: 10px
			  background-color: #606062 
			  background-image: linear-gradient(#474749,#606062)
			  box-shadow: inset 0 1px 1px rgba(white,.15), inset 0 -1px 1px rgba(black,.15)
			  transition: all .15s ease
			  &:after
				content: ""
				position: absolute
				display: block
				top: 6px
				left: 6px
				width: 6px
				height: 6px
				border-radius: 50%
				background: white
				opacity: 0
				transform: scale(0)

			.cbx + span,
			.rdo + span
			  float: left
			  margin-left: 6px

			.forms
			  margin: auto
			  user-select: none

			  label
				display: inline-block
				margin: 10px
				cursor: pointer

			  input[type="checkbox"]
			  input[type="radio"]
				position: absolute
				opacity: 0

			  input[type="radio"]:checked + .rdo
				background-color: #606062 
				background-image: linear-gradient(#255CD2,#1D52C1)
				&:after
				  opacity: 1
				  transform: scale(1)
			  	transition: all .15s ease

		  </style>

        <div id="contenitoreForm">

        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Denominazione:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="denominazione" maxlength="500" 
          value="<?php echo isset($_POST['denominazione']) ? output($_POST['denominazione']) : ''; ?>"  class="required" size="30" required="required" aria-required="true">
            <?=$validator->outputError('denominazione')?>						
           </div>
        </div>
              
        
        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Partita IVA:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" id="partitaIva" name="partitaIva" maxlength="500" 
          value="<?php echo isset($_POST['partitaIva']) ? output($_POST['partitaIva']) : ''; ?>" class="required" size="30" required="required" size="30" aria-required="true">
            <?=$validator->outputError('partitaIva')?>						
           </div>
        </div>
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Cellulare:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="telefono" maxlength="20" 
          value="<?php echo isset($_POST['telefono']) ? output($_POST['telefono']) : ''; ?>"  class="required" size="30" required="required" aria-required="true">
            <?=$validator->outputError('telefono')?>						
           </div>
        </div>
		
        <div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
            Numero targa:<span class="star" data-uk-modal="{target:'#modal-1'}"> <i class="uk-icon-question"></i></span>
			
				<div id="modal-1" class="uk-modal" aria-hidden="true" style="display: none; overflow-y: scroll;">
					<div class="uk-modal-dialog">
						<button type="button" class="uk-modal-close uk-close"></button>
						<h1>Numero targa</h1>
					</div>
				</div>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="targa"
          value="<?php echo isset($_POST['targa']) ? output($_POST['targa']) : ''; ?>"  class="required" size="6"  aria-required="true">
            <?=$validator->outputError('targa')?>						
           </div>
        </div>

		
		<h4>Dati sede (altre sedi secondarie si potranno inserire successivamente)</h4>
		
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
				<option value="<?=$idComune?>" <?=getSelectedOption('idComune', $idComune)?> >
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
          value="<?php echo isset($_POST['indirizzo']) ? output($_POST['indirizzo']) : ''; ?>" class="required" required="required" size="50" aria-required="true">
            <?=$validator->outputError('indirizzo')?>						
           </div>
        </div>
		

		
        <br/>
 	
       
        <div class="control-group">
          <div class="controls">
            <button type="submit" name="submit" value="Registrati" class="btn btn-primary">Registra utente</button>
          </div>
        </div>

        </div>
        
      </form>
     </div>
	</main>
 </div>
 </div>  
  
	<script type="text/javascript">
		$(document).ready (function() {

			
			$('#register').on('click', '[type="submit"]', function(e) {
				//Rimuovo gli eventuali div di errore della validazione 
				//lato server
				$(".uk-alert-danger").remove();
				$("#register").removeClass("uk-form-danger");
				
				rules = {
					denominazione: "required",
					partitaIva: {
						regex: "^[0-9]{11}$"
					},
					indirizzo: "required",
					targa: "required",
					telefono: {
						required: true,
						regex: "[0-9]+\$"
					},
					idComune: "required",
					rules: {
						required: true,
						range: [1, 1]
					}
				}

				if ($.validator) {
					$('#register').validate({
						rules: rules,
						messages: {
							partitaIva: {
								regex: "Inserire una partita IVA"
							},
							numeroTessera: {
								regex: "Inserire un n° di 4 cifre"
							},
							telefono: {
								regex: "Inserire un numero di cellulare, non un numero di telefono fisso. Inserire solo numeri."
							}
						},
						errorClass: "uk-form-danger"
					});
				}
			});

		});
	</script>
</body>
</html>