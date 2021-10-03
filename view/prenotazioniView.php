	
	
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

<?php if  (isset($_SESSION['azienda'])) { ?>						
<div class="profile">
<h6>
Attenzione: non saranno ammesse variazioni di orario, di giorno e del centro di raccolta scelto.
La prenotazione è cancellabile fino ad 2 ore prima della fascia oraria scelta.
</h6>
<ul class="btn-toolbar pull-right">
	<li class="btn-group">
		<a class="btn" href="ctrl/inserisciPrenotazioniCtrl.php">
			<span></span> Richiedi prenotazione</a>
	</li>
</ul>

<fieldset id="users-profile-core">
	<legend>
		Elenco richieste prenotazioni	</legend>



<?php if (count($listPrenotazioni) > 0) { ?>

<table class="uk-table uk-table-striped uk-table-condensed uk-table-hover">
     <thead>
      <tr>
       <th>Identificativo</th>
	   <th>Rifiuto</th>	
       <th>Data Prenotazione</th>
	   <th>Centro di raccolta</th>
	   <th>Stato</th>
	   <!--<th>Data<br/>richiesta</th>-->
	   <th style="width: 60px;">&nbsp;</th>
      </tr>
     </thead>
     <tbody>
		<?php foreach ($listPrenotazioni as $key => $prenotazione) { ?>
		<tr>
	   <td><?=$prenotazione->idPrenotazione?></td>			
       <td><?=$prenotazione->descRifiuti?></td> 
	   <td>
	   <?php if (isset($prenotazione->dataPrenotazione) && ($prenotazione->dataPrenotazione!=null)) {?>
	   	<?=$prenotazione->dataPrenotazione?> alle <?=$prenotazione->descFasciaOraria?>
	   <?php } ?>
	   </td>	
	   <td><?=$prenotazione->centroRaccolta->nomeCentro?></td> 
	   <td><?=$prenotazione->descStato?></td>
	   <!--<td><?=$prenotazione->data?></td>-->
	   <td>
	   <?php if ($prenotazione->idStato==1)  { ?>
	   <a href="javascript: $('#prenotazioniDet #idPrenotazioneDettaglio').val('<?=$key?>'); $('#prenotazioniDet').submit();" title="Modifica prenotazione">
	   <img src="img/modifica.png">
	   </a>
	   <?php } ?>
	   <?php if ($prenotazione->idStato==1 && $prenotazione->cancellabile)  { ?>
	   &nbsp;   
	   <a title="Cancella prenotazione" onclick="UIkit.modal.confirm('Sei sicuro di voler cancellare la prenotazione con data scadenza prenotazione <?=$prenotazione->dataFinePrenotazione?>?', function(){ $('#idPrenotazione').val('<?=$key?>'); $('#prenotazioniCanc').submit(); }, {labels: {'Ok': 'Si', 'Cancel': 'No'}});">
	   <img src="img/elimina.png">
	   </a>
	   <?php } ?>
	   <?php if ($prenotazione->idStato==1)  { ?>
	   &nbsp;
	   <a title="Documento di prenotazione" href="javascript: $('#prenotazioniStampaDocPren #idPrenotazioneStampa').val('<?=$key?>'); $('#prenotazioniStampaDocPren').submit();">
	   <img src="img/docprenot.png">
	   </a>
	   <?php } ?>
	   </td>
      </tr>
	<?php } ?>
	 </tbody>
    </table>
	<form id="prenotazioniDet" name="prenotazioniDet" method="post" action="ctrl/dettaglioPrenotazioniCtrl.php">
		<input type="hidden" name="idPrenotazioneDettaglio" id="idPrenotazioneDettaglio" value="" />
	</form>
	<form id="prenotazioniStampaDocPren" name="prenotazioniStampaDocPren" method="post" action="ctrl/stampaDocumentoPrenotazioneCtrl.php">
		<input type="hidden" name="idPrenotazioneStampa" id="idPrenotazioneStampa" value=""/>
	</form>
	<form id="prenotazioniCanc" name="prenotazioniCanc" method="post" action="ctrl/cancellaPrenotazioniCtrl.php">
		<input type="hidden" name="idPrenotazione" id="idPrenotazione" value=""/>
	</form>
	<?php } ?>
	
	
	<br />
	<table class="uk-table uk-table-striped uk-table-condensed uk-table-hover" style="background:#efefef">
     <thead>
	  <tr>
	   <th colspan="3">Legenda</th>	
	  </tr>
      <tr>
	   <th><img src="img/modifica.png"></th>	
       <th style="font-size: 90%;">Modifica</th>
       <th>&nbsp;</th>
	  </tr>
	  <tr>
	   <th><img src="img/elimina.png"></th>	
       <th style="font-size: 90%;">Cancella prenotazione</th>
       <th>&nbsp;</th>
	  </tr>
	  <tr>
	   <th><img src="img/docprenot.png"></th>	
       <th style="font-size: 90%;">Documento di prenotazione</th>
       <th>&nbsp;</th>
	  </tr>
     </thead>
     <tbody>
	 </tbody>
    </table>
	
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

	
	<?php if (isset($nuovaPrenotazione)) { ?>
	<!-- inizio modal prenotazione inserita -->
	<div class="modal fade" id="nuovaPrenotazioneModal" tabindex="-1" role="dialog" aria-labelledby="nuovaPrenotazioneModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Chiudi"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="nuovaPrenotazioneModalLabel">Prenotazione inserita con successo</h4>
				</div>
				<div class="modal-body">
					
						<p>Si consiglia di presentarsi al Centro di raccolta con la prenotazione effettuata</p>
						<p>Avviso: l’utenza che intende rinunciare al servizio (non presentandosi al centro di raccolta) è invitata a cancellare la prenotazione entro le due ore antecedenti l’orario prenotato.
						<br>
						La possibilità di prenotazione potrà essere interdetta all’utenza che avrà rinunciato al servizio almeno per cinque volte consecutive.</p>
						<?php if ($idTipologiaUtente==1) {?>
							<p>
								Le utenze non domestiche che si configurano come produttori iniziali di rifiuti non pericolosi (o pericolosi entro il limite di 30 Kg o l. al giorno) che effettuano operazioni di raccolta e trasporto dei propri rifiuti – per il conferimento al centro di raccolta - sono tenuti a possedere l’iscrizione all’Albo nazionale gestori ambientali(D.Lgs. n. 152/2006, art. 212, c. 8).
							</p>
						<?php }?>	
					
				</div>
			</div>
			<div class="modal-footer">
			<form id="prenotazioniStampaModal" name="prenotazioniStampa" method="post" action="ctrl/stampaDocumentoPrenotazioneCtrl.php">
				<input type="hidden" name="idPrenotazioneStampa" id="idPrenotazioneModal" value="<?=$nuovaPrenotazione->idPrenotazione?>" />
				<button type="button" class="btn btn-default" data-dismiss="modal" onclick="javascript:$(this).closest('form').submit()">Stampa</button>	
				<button type="button" class="btn btn-default" data-dismiss="modal">Chiudi</button>	
			</form>
			</div>
		</div>
	</div>
	<script>
		$(document).ready (function() {
			$("#nuovaPrenotazioneModal").modal("show");
		});
	</script>
	<!-- fine modal prenotazione inserita -->
	<?php } ?>
<?php } ?>
	