
          
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
        <h1>Modifica della email</h1>
      </div>
      
      
      <form id="modificaMailAzienda" action="ctrl/modificaMailAziendaCtrl.php" method="post" class="form-validate form-horizontal well">
			
		<h5>Modificare l'email azienda</h5>
		
		<div class="control-group">
          <div class="control-label">
            <label>Nuova email:<span class="star">&nbsp;*</span></label>
          </div>
          <div class="controls">
            <input type="email" id="email" name="email" 
				value="<?=getInputValue('email')?>" size="30">
				<?=$validator->outputError('email')?>						
           </div>
        </div>  
		
        <div class="control-group">
          <div class="control-label">
            <label>Conferma nuova email:<span class="star">&nbsp;*</span></label>
          </div>
          <div class="controls">
            <input type="email" id="confermaEmail" name="confermaEmail" 
				value="<?=getInputValue('confermaEmail')?>" size="30">
				<?=$validator->outputError('confermaEmail')?>						
           </div>
        </div>   
		
		<input type="hidden" name="idUser" id="idUser" value="<?=$idUser?>"/>
        
        <div class="control-group">
          <div class="controls">
            <button type="submit" name="salva" value="Salva" class="btn btn-primary">Salva</button>
			<button type="submit" name="annulla" value="Annulla" class="cancel btn btn-primary">Annulla</button>
          </div>
        </div>
        
      </form>
     </div>
	</main>
 </div>
 </div>  
  
	<script type="text/javascript">
		$(document).ready (function() {
		
			$('#modificaMailAzienda').on('click', '[name="salva"]', function(e) {
				//Rimuovo gli eventuali div di errore della validazione 
				//lato server
				$(".uk-alert-danger").remove();
				$("#modificaMailAzienda").removeClass("uk-form-danger");
				
				rules = {
					email: {
						required: true
					},
					confermaEmail: {
						required: true,
						equalTo: '#email'
					}
				}

				$('#modificaEmailAzienda').validate({
					rules: rules,
					errorClass: "uk-form-danger"
				});
			});

		});
	</script>
