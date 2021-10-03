
	<div class="tm-wrapper">

		<div class="tm-block tm-block-padding-top">
		<div class=" uk-container uk-container-center">
			<section class="tm-top-a uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
<div class="uk-width-1-1"><div class="uk-panel">
	
	 <?php if(!($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") || $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio"))) { ?>
	
		<?php if ($aggiungiUtenzaDomestica) {?>
			<ul class="btn-toolbar pull-left" style="padding-left: 0; padding-right: 30px">
			<li class="btn-group">
				<a class="btn btn-primary" href="ctrl/aggiungiUtenzaDomesticaCtrl.php">
					Aggiungi utenza domestica</a>
			</li>
		</ul>
		<?php }?>
		<?php if ($aggiungiUtenzaAzienda) {?>
			<ul class="btn-toolbar pull-left" style="padding-left: 0; padding-right: 30px">
			<li class="btn-group">
				<a class="btn btn-primary" href="ctrl/aggiungiUtenzaAziendaleCtrl.php">
					Aggiungi utenza aziendale</a>
			</li>
		</ul>
		<?php }?>
	
		<?php if (!($aggiungiUtenzaAzienda) and !($aggiungiUtenzaDomestica)) {?>
			<ul class="btn-toolbar pull-left" style="padding-left: 0; padding-right: 30px">
			<li class="btn-group">
				<a class="btn btn-primary" href="ctrl/selezionaAziendaCtrl.php">
					Seleziona utenza</a>
			</li>
		</ul>
		<?php }?>
	
	<?php }?>
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
<ul class="btn-toolbar pull-right">
	<li class="btn-group">
		<a class="btn" href="ctrl/modificaAziendaCtrl.php">
			Modifica dati utente</a>
	</li>
</ul>

<fieldset id="users-profile-core">
	<legend>
		Dati utente	</legend>
	<dl class="dl-horizontal">
		<?php if ($idTipologiaUtente==1) {?>
		<dt>
			Denominazione		</dt>
		<?php } else {?>	
		<dt>
			Cognome Nome</dt>
		<?php }?>		
		<dd>
			<?=$azienda->denominazione?>&nbsp;		</dd>
			
		<?php if ($idTipologiaUtente==1) {?>
		<dt>
			Partita IVA	</dt>
		<dd>
			<?=$azienda->partitaIVA?>&nbsp;		</dd>
		<?php } else {?>	
		<dt>
			Codice Fiscale		</dt>
		<dd>
			<?=$azienda->codiceFiscale?>&nbsp;		</dd> 
		<?php }?>	
		<dt>
			Targa		</dt>

					<dd>
				<?=$azienda->targa?>&nbsp;			</dd>
		<dt>
			Telefono		</dt>

					<dd>
				<?=$azienda->telefono?>&nbsp;			</dd>
		<dt>
			Utente		</dt>

					<dd>
				<?=$azienda->email?>&nbsp;			</dd>		
		
	</dl>
</fieldset>

<?php if ($idTipologiaUtente==1) {?>
<ul class="btn-toolbar pull-right">
	<li class="btn-group">
		<a class="btn" href="ctrl/modificaSedeCtrl.php">
			Modifica dati sede principale</a>
	</li>
</ul>
<?php }?>	
<?php if ($idTipologiaUtente==2) {?>
<ul class="btn-toolbar pull-right">
	<li class="btn-group">
		<a class="btn" href="ctrl/modificaSedeCtrl.php">
			Modifica dati sede utenza</a>
	</li>
</ul>
<?php }?>	
<fieldset id="users-profile-custom">


<?php if ($idTipologiaUtente==1) {?>
	<legend>Sede della tua azienda</legend>
<?php }?>		
	<dl class="dl-horizontal">
			<dt>Comune</dt>
		<dd>
							<?=$azienda->sedePrincipale->descComune?>&nbsp;					</dd>
					<dt>Indirizzo</dt>
		<dd>
							<?=$azienda->sedePrincipale->indirizzo?>&nbsp;					</dd>
							<!--
					<dt>Note</dt>
		<dd>
							<?=$azienda->sedePrincipale->note?>&nbsp;					</dd> -->
				</dl>
</fieldset>

<?php if ($idTipologiaUtente==1) {?>
<ul class="btn-toolbar pull-right">
	<li class="btn-group">
		<a class="btn" href="ctrl/aggiungiSedeCtrl.php">
			Aggiungi altre sedi</a>
	</li>
</ul>
<?php }?>	
<?php if (count($azienda->sedi) > 0) { ?>

<fieldset id="users-profile-custom">
	<legend>Altre sedi ritiro rifiuto</legend>

<table class="uk-table uk-table-striped uk-table-condensed uk-table-hover">
     <thead>
      <tr>
       <th>Comune</th>
       <th>Indirizzo</th>
	   <th>Elimina sede</th>
      </tr>
     </thead>
     <tbody>
		<?php foreach ($azienda->sedi as $key => $sede) { ?>
		<tr>
       <td><?=$sede->descComune?></td>
       <td><?=$sede->indirizzo?></td>
	   <td>
	   <a title="Cancella sede" onclick="UIkit.modal.confirm('Sei sicuro di voler cancellare la sede di <?=outputJS($sede->descComune)?>?', function(){ $('#idSede').val('<?=$sede->idSede?>'); $('#sedeCanc').submit(); }, {labels: {'Ok': 'Si', 'Cancel': 'No'}});">
	   <img src="img/elimina.png">
	   </a></td>
      </tr>
	<?php } ?>
	 </tbody>
    </table>
</fieldset>
<form id="sedeCanc" name="sedeCanc" method="post" action="ctrl/cancellaSedeCtrl.php">
	<input type="hidden" name="idSede" id="idSede" value=""/>
</form>
	<?php
	}
	?>



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
	
	<?php if (isset($modalMessage)) { ?>
	<!-- inizio messaggio modale -->
	<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Chiudi"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="messageModalLabel"><?=output($modalTitle)?></h4>
				</div>
				<div class="modal-body">
					<p><?=output($modalMessage)?></p>				
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>	
			</div>
		</div>
	</div>
	<script>
		$(document).ready (function() {
			$("#messageModal").modal("show");
		});
	</script>
	<!-- fine messaggio modale -->
	<?php } ?>
