	
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
											
											
						<?php if (isset($okMessage)) {?>
						<div class="uk-alert uk-alert-large uk-alert-success" data-uk-alert="">
							<button type="button" class="uk-alert-close uk-close"></button>							
							<p><?=$okMessage?></p>
						</div>
						<?php } ?>

<button id="filtriButton" class="btn">Nascondi filtri</button>
<script>

$(function() {
	$('#prenotazioni').on('click', '[name="filtra"]', function(e) {
			if ($("#denominazione").val().trim()=='' && $("#partitaIVA").val().trim()=='' && $("#codiceFiscale").val().trim()=='')
			{
				$('#msgFiltri').attr('style', 'font-size: 18px; color:#efff00; background-color:#9d1919;');
				return false;
			} 
	});
	//$("#filtri").hide();
	$('#denominazione').on('input', function() {
	   $('#msgFiltri').attr('style', 'font-size: 14px;');	
	});
	$('#partitaIVA').on('input', function() {
	   $('#msgFiltri').attr('style', 'font-size: 14px;');	
	});
	$('#codiceFiscale').on('input', function() {
	   $('#msgFiltri').attr('style', 'font-size: 14px;');	
	});
	
	$( "#filtriButton" ).click(function() {
	  $( "#filtri" ).toggle( "slow" );
		$(this).text(function(i, text) {
			  return text === "Nascondi filtri" ? "Mostra filtri" : "Nascondi filtri";
		})
	});
});
</script>
<div class="profile" id="filtri">    
            
      <form id="prenotazioni"  action="ctrl/loadAziendaCtrl.php" method="post" class="form-validate form-horizontal well">
		<fieldset id="users-profile-core">
        
		<legend>Filtri &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="msgFiltri" style="font-size: 14px;"> Impostare almeno un filtro&nbsp;</span> </legend>
		
		<fieldset class="uk-form">
		
		

		
	
		
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
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip">
			  Partita IVA azienda
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
        
        </fieldset>
  <br/>
              
	<div class="control-group">
		<div class="controls">
			<button type="submit" id="filtraSubmit" name="filtra" value="filtra" class="btn btn-primary">ricerca</button>
		</div>
	</div>

</fieldset>
</form>
     </div>


<?php if (!isset($nascondiAziende)) { ?>
<div class="profile">

<fieldset id="users-profile-core">
	<legend>
		Elenco utenti	
		<?php if (count($listAziende) > 0) { ?>
		<div class="profile" style="float:right; font-size:16px"> 
    </div>
		<?php } ?>
  </legend>
	

	
	
<?php if (count($listAziende) > 0) { ?>

<table id="tabellaPrenotazioni" class="uk-table uk-table-striped uk-table-condensed uk-table-hover" style="font-size: smaller;">
     <thead>
      <tr>
	   <th>Denominazione/<BR/>Cognome Nome</th>	
       <th>Partita IVA</th>
       <th>Codice Fiscale</th>
       <th>Tip. Utente</th>
	   <th>Telefono</th>
	   <th>Utenza</th>
	   
	   <th>&nbsp;</th>
      </tr>
     </thead>
     <tbody>
		<?php foreach ($listAziende as $key => $azienda) { ?>
		<tr>
		<td><?=$azienda->denominazione?></td>
		<td><?=$azienda->partitaIVA?></td>
		<td><?=$azienda->codiceFiscale?></td>
		<td><?=$azienda->descTipologiaUtente?></td>
		<td><?=$azienda->telefono?></td>
		<td><?=$azienda->email?></td>
	   <td>
		  
	       <a href="javascript: $('#selezionaUtente #idAzienda').val('<?=$azienda->idAzienda?>'); $('#selezionaUtente').submit();" title="Seleziona Utente">
		   	 <img src="img/selectUser.png">
		   </a>
		   <?php if (!isset($azienda->idUser)) { ?>
				<a href="javascript: $('#modificaDatiUtente #idAzienda').val('<?=$azienda->idAzienda?>'); $('#modificaDatiUtente').submit();" title="Modifica Dati Utente">
					<img src="img/modifica.png">
				</a>
		   <?php } ?>
		  
		   
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
				totalrecords: <?=count($listAziende)?>, 
				recordsperpage: 10, 
				length: 5,
				datacontainer: 'tabellaPrenotazioni', 
				dataelement: 'tr', 
				initval: 0, 
				theme: 'blu' });
        });

    </script>
	<?php } else { ?>
		<p>Non sono stati trovati utenti</p>
	<?php
	}
	?>
	<br />
	
	<br />
	<table class="uk-table uk-table-striped uk-table-condensed uk-table-hover" style="background:#efefef">
     <thead>
	  <tr>
	   <th colspan="3">Legenda</th>	
	  </tr>
	  <tr>
	   <th><img src="img/selectUser.png"></th>	
       <th style="font-size: 90%;">Seleziona utente</th>
       <td>Permette fare prenotazioni per questo utente</td>
	  </tr>
	  <tr>
	   <th><img src="img/modifica.png"></th>	
       <th style="font-size: 90%;">Modifica utente</th>
       <td>Permette di modificare i  dati dell'utente</td>
	  </tr>
     </thead>
     <tbody>
	 </tbody>
    </table>
	
	
	 
	<form id="selezionaUtente" name="selezionaUtente" method="post" action="ctrl/aziendaSelezionataCtrl.php">
		<input type="hidden" name="idAzienda" id="idAzienda" />
	</form>
	<form id="modificaDatiUtente" name="modificaDatiUtente" method="post" action="ctrl/settaAziendaXmodificaCtrl.php">
		<input type="hidden" name="idAzienda" id="idAzienda" />
	</form>
	
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

	

	
	