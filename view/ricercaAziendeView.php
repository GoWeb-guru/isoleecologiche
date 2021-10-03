	
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
            
      <form id="prenotazioni" action="ctrl/ricercaAziendeCtrl.php" method="post" class="form-validate form-horizontal well">
		<input type="hidden" name="excel" id="excel" value="" />
		<fieldset id="users-profile-core">
        
		<legend>Filtri</legend>
  
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

		<script>			
		$(function() {
			$('#codiceFiscale').quickselect({
				maxItemsToShow: 20,
				minChars: 2,
				ajax: "ctrl/ajax/getAziendeCfCtrl.php",
				delay: 400, 
				selectSingleMatch: true,
				formatItem:function(data, index, total){return data[0]+", "+data[1]},
				additionalFields:[$('#denominazione')]
			});
		});
		</script>
        
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
		Elenco aziende	
		<?php if (count($listAziende) > 0) { ?>
		<div class="profile" style="float:right; font-size:16px">    	 
  	<a href="javascript: $('#prenotazioni #excel').val('excel'); $('#prenotazioni').submit(); ('#prenotazioni #excel').val('');"><img src="img/excel.png" title="Scarica in formato Excel"> Scarica in formato Excel</a>
    </div>
		<?php } ?>
  </legend>
	

	
	
<?php if (count($listAziende) > 0) { ?>

<table id="tabellaPrenotazioni" class="uk-table uk-table-striped uk-table-condensed uk-table-hover">
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
		  
	       <a href="javascript: $('#modificaDatiUtente #idAzienda').val('<?=$azienda->idAzienda?>'); $('#modificaDatiUtente').submit();" title="Modifica Utente">
		   	 <img src="img/modifica.png">
		   </a>
		   <a href="javascript: $('#modificaMailAzienda #idUser').val('<?=$azienda->idUser?>'); $('#modificaMailAzienda').submit();" title="Modifica Email">
		   	 <img src="img/email.png">
		   </a>
		   
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
		<p>Non ci sono aziende</p>
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
	   <th><img src="img/modifica.png"></th>	
       <th style="font-size: 90%;">Modifica Dati Utente</th>
       <td>Permette di modificare i dati dell'utente</td>
	  </tr>
	  <tr>
	   <th><img src="img/email.png"></th>	
       <th style="font-size: 90%;">Modifica Email</th>
       <td>Permette di impostare una nuova Email</td>
	  </tr>
     </thead>
     <tbody>
	 </tbody>
    </table>
	
	<form id="modificaMailAzienda" name="modificaMailAzienda" method="post" action="ctrl/modificaMailAziendaCtrl.php">
		<input type="hidden" name="idUser" id="idUser" />
	</form>
	 
	<form id="modificaDatiUtente" name="modificaDatiUtente" method="post" action="ctrl/modificaAziendaConsorzioCtrl.php">
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

	

	
	