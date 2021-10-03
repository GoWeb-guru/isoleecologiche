
		<div class=" tm-block-secondary">
		<div class=" uk-container uk-container-center">
			<footer class="tm-footer uk-text-center uk-text-small">

				<div class="uk-panel">
	VERDEGUFO.IT - Copyright © 2015. All Rights Reserved.<br>
	</div>
<div class="uk-panel"><ul class="uk-subnav uk-subnav-line uk-flex-center"><li><a target="new" href="../pdf/Informativa Utenti CENTRI RACCOLTA RIFIUTI.pdf">Privacy</a></li><li><a href="http://www.goweb.guru/" target="_blank">Credits</a></li></ul></div>
<div class="uk-panel"></div>
			</footer>
		</div>
	</div>
	

		<div id="offcanvas" class="uk-offcanvas">
		<div class="uk-offcanvas-bar uk-offcanvas-bar-flip"><ul class="uk-nav uk-nav-offcanvas">
		<?php if ($userUtils->isUserInGroup($loggedUser, "azienda")) { ?>
			<li><a href="ctrl/profileCtrl.php">Dati utente</a></li>
		<?php } ?>
		<?php if($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") || $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")) { ?>  				
			<li><a href="ctrl/profileCtrl.php">Intermediario</a></li>
		<?php } ?>
		<?php if ($userUtils->isUserInGroup($loggedUser, "societa servizi")) { ?>
			<li><a href="ctrl/profileCtrl.php">Societa</a></li>
		<?php } ?>
		<?php if ($userUtils->isUserInGroup($loggedUser, "consorzio")) { ?>
			<li><a href="ctrl/profileCtrl.php">Consorzio</a></li>
			<li><a href="ctrl/ricercaAziendeCtrl.php">Ricerca Aziende</a></li>
		<?php } ?>
		<?php if (isPageEnabled($loggedUser, 'prenotazioniCtrl.php', $permissionMappings)) { ?>  						             
		<li><a href="ctrl/prenotazioniCtrl.php">Prenotazioni</a></li>
		<?php } if (isPageEnabled($loggedUser, 'prenotazioniConsorzioCtrl.php', $permissionMappings)) { ?> 			
		<li><a href="ctrl/prenotazioniConsorzioCtrl.php">Prenotazioni</a></li>
		<?php } ?>
		<?php if ($userUtils->isUserInGroup($loggedUser, "societa servizi")) { ?>
			<li><a href="ctrl/cambioStatoPrenotazioneCtrl.php">Cambia stato prenotazione</a></li>
		<?php } ?>
		<li><a href="ctrl/logoutCtrl.php">Esci</a></li>
		</ul></div>
	</div>
	
	</div>	
	
<noscript><strong>JavaScript è disablitato.</strong>Abilitarlo per poter utilizzare tutte le funzionalità del sito.</noscript>
</body>
</html>