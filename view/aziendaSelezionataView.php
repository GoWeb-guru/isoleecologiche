
          
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
        <h1>Utente SELEZIONATO</h1>
      </div>
      
      
      <form id="modificaMailAzienda" action="ctrl/modificaMailAziendaCtrl.php" method="post" class="form-validate form-horizontal well">
			
		<h5>Dati Utente</h5>
		
		<div class="control-group">
          <div class="control-label">
            <label><?=($azienda->idTipologiaUtente==1 ? 'Denominazione':'Cognome Nome:')?></label>
          </div>
          <div class="control-label2">
            <label><?=$azienda->denominazione?></label>					
           </div>
    </div>  

    <?php if ($azienda->idTipologiaUtente==1) { ?>
		<div class="control-group">
          <div class="control-label">
            <label>Partita IVA:</label>
          </div>
          <div class="control-label2">
            <label><?=$azienda->partitaIVA?></label>					
           </div>
    </div>  
    <?php } ?>
    <div class="control-group">
          <div class="control-label">
            <label>Codice Fiscale:</label>
          </div>
          <div class="control-label2">
            <label><?=$azienda->codiceFiscale?></label>					
           </div>
    </div> 
    <div class="control-group">
          <div class="control-label">
            <label>Tip. Utente:</label>
          </div>
          <div class="control-label2">
            <label><?=$azienda->descTipologiaUtente?></label>					
           </div>
    </div>  
    <div class="control-group">
          <div class="control-label">
            <label>Telefono:</label>
          </div>
          <div class="control-label2">
            <label><?=$azienda->telefono?></label>					
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
