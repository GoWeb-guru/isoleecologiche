
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



<?php if (isset($_SESSION['listaAziende'])) {?>						


<fieldset id="users-profile-core">
	<legend>
		Per poter proseguire devi selezionare l'utenza con cui lavorare	</legend>
	
	<button id="selezioneutenza" class="btn btn-primary">Seleziona utenza</button>
    <form id="cambiaprenotazione" action="ctrl/selezionaAziendaCtrl.php" method="post" class="form-validate form-horizontal well">
	<table class="uk-table uk-table-striped uk-table-condensed uk-table-hover">
     <thead>
      <tr>
	   <th>&nbsp;</th>
       <th>Denominazione/<br/>Cognome Nome</th>
	   <th>Partita IVA/<br/>Codice Fiscale</th>	
       <th>Cellulare</th>
	   <th>Sede</th>
	   <th>Tipologia Utenza</th>
	   <th style="width: 60px;">&nbsp;</th>
      </tr>
     </thead>
     <tbody>
		<?php foreach ($_SESSION['listaAziende'] as $key => $azienda) { $count++; ?>
		<tr>

		<?php if ($count==1) {  ?>
			<td><input name="idAzienda"  type="radio" checked="checked" value="<?=$azienda->idAzienda?>" />  </td>	
		<?php } else {  ?>
			<td><input name="idAzienda"  type="radio" value="<?=$azienda->idAzienda?>" />  </td>	
		<?php }  ?>		
	   <td><?=$azienda->denominazione?></td>			
       <td><?=$azienda->partitaIVA?><?=$azienda->codiceFiscale?></td>
	   <td><?=$azienda->telefono?></td>	
	   <td><?=$azienda->sedePrincipale->descComune?></td> 
	   <td><?=$azienda->descTipologiaUtente?></td>
      </tr>
	<?php } ?>
	 </tbody>
    </table>
	</form>
</fieldset>

	


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
	

	<script type="text/javascript">

$(document).ready(function () {

	
	
	$("#selezioneutenza").click(function () {
		$("#cambiaprenotazione").submit();
	});
	

});


</script>


	<?php }?>	
