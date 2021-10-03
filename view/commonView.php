<!DOCTYPE HTML>
<html lang="it-it" dir="ltr"  data-config='{"twitter":0,"plusone":0,"facebook":0,"style":"green"}'>  
  <head>    
    <meta charset="utf-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">       
    <base href="https://prenotazioni.verdegufo.it/isoleecologiche/">       
    <meta name="keywords" content="raccolta differenziata, rifiuti, verdegufo, raccolta, differenziata">       
    <meta name="description" content="Il presente sito ti offre la possibilità di trovare la corretta destinazione per lo smaltimento o raccolta dei rifiuti. Le risposte ottenute fanno riferimento al comune selezionato ed alla tipologia di materiale. Sono presenti le modalità di conferimento, i giorni di raccolta, i calendari di raccolta e la posizione dei centri di raccolta.">       
    <meta name="generator" content="Joomla! - Open Source Content Management">       
    <title>Verde Gufo - Prenotazioni Centri di raccolta</title>       
    <link href="/isoleecologiche/templates/yoo_digit/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon">       
 <!--
<script src="/isoleecologiche/assets/js/combo/quicksilver.min.js" type="text/javascript"></script>
<script src="/isoleecologiche/assets/js/combo/jquery.quickselect.min.js" type="text/javascript"></script>    
	  
	  <script src="template/gzip.php?jquery.min-cf96a9d8.js" type="text/javascript"></script>    
		<script src="template/gzip.php?jquery-noconflict-fd5f3ff4.js" type="text/javascript"></script>    
		<script src="template/gzip.php?jquery-migrate.min-2900ca54.js" type="text/javascript"></script>    
		<script src="template/gzip.php?html5fallback-bf3f4b63.js" type="text/javascript"></script>    
		<script src="template/gzip.php?bootstrap.min-a41d2187.js" type="text/javascript"></script>   --> 
		<script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>    
		<script src="assets/js/validation/jquery.validate.min.js" type="text/javascript"></script>    
		<script src="assets/js/validation/lang/messages_it.js" type="text/javascript"></script>    
		<script src="assets/js/bootstrap.js" type="text/javascript"></script>    
		<script src="assets/js/paginator/smartpaginator.js" type="text/javascript"></script>    
		<!--script src="assets/js/combo/string_score.min.js" type="text/javascript"></script-->
		<script src="assets/js/combo/quicksilver.min.js" type="text/javascript"></script>
		<script src="assets/js/combo/jquery.quickselect.min.js" type="text/javascript"></script>    
		
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="assets/js/datepicker-it.js"></script>		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		
		<script type="text/javascript">
			window.setInterval(function(){var r;try{r=window.XMLHttpRequest?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP")}catch(e){}if(r){r.open("GET","/index.php?option=com_ajax&format=json",true);r.send(null)}},840000);
			</script>     
    <link rel="apple-touch-icon-precomposed" href="apple_touch_icon.png">    
    <link rel="stylesheet" href="template/gzip.php?bootstrap-191184cc.css">    
    <link rel="stylesheet" href="template/gzip.php?theme-7dacfe94.css">    
    <link rel="stylesheet" href="assets/css/paginator/smartpaginator.css">    
    <link rel="stylesheet" href="assets/css/combo/jquery.quickselect.css">
		
   	<script src="template/gzip.php?theme-ba47ee85.js"></script>    
        
    <link rel="stylesheet" type="text/css" href="template/custom.css">

	  
  </head>  
	
	
	
  <body class="tm-noblog">	 	 		     
    <div class="tm-headerbar tm-headerbar-plain uk-clearfix">			       
      <div class="uk-container uk-container-center">								         
        <a class="uk-navbar-brand uk-hidden-small" href="/isoleecologiche/ctrl/profileCtrl.php">	           
          <img class="tm-logo" src="/isoleecologiche/cache/gufo.png" alt="" width="240" height="108" /></a>				 				 				 								         
        <div class="uk-navbar-nav uk-navbar-flip uk-hidden-small">						                      
<?php if (!isset($paginaMenu)) 		
					{ 
						$paginaMenu='';
          }
                    					?>  					 					 					 					           
          <ul class="uk-navbar-nav uk-hidden-small">						 						             
            <?php if ($userUtils->isUserInGroup($loggedUser, "azienda")) { ?>  							             
            <li <?php if ($paginaMenu==='aziendaView') { ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/profileCtrl.php">Dati utente</a>            
            </li>		
            <li <?php if ($paginaMenu==='abilitaIntermediarioView') { ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/abilitaIntermediarioCtrl.php">Abilitazione Intermediario</a>            
            </li>					             
            <?php } ?> 						 						             
            <?php if($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") || $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")) { ?>  							             
            <li <?php if ($paginaMenu==='comuneView') { ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/profileCtrl.php">Intermediario</a>            
            </li>
            <li <?php if ($paginaMenu==='loadAziendaView') { ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/loadAziendaCtrl.php">Ricerca utente</a>            
            </li>						             
			      <li <?php if ($paginaMenu==='inserisciComuneAziendaView') {  ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/inserisciComuneAziendaCtrl.php">Inserisci utente</a>            
            </li>
            <?php } ?> 			
            <?php if($userUtils->isUserInGroup($loggedUser, "area ecologica")) { ?>  							             
            <li <?php if ($paginaMenu==='loadAziendaView') { ?> class="uk-active" <?php } ?> >   
              <?php if (isset($profilo->idCentroRaccolta)) { ?>  
                <a href="/isoleecologiche/ctrl/loadAziendaCtrl.php">Ricerca utente</a>  
              <?php } else { ?>          
                <a href="/isoleecologiche/ctrl/sceltaCentroRaccoltaCtrl.php">Ricerca utente</a>
              <?php } ?> 	
            </li>						             
			      <li <?php if ($paginaMenu==='inserisciComuneAziendaView') {  ?> class="uk-active" <?php } ?> >               
              <?php if (isset($profilo->idCentroRaccolta)) { ?>  
                <a href="/isoleecologiche/ctrl/inserisciComuneAziendaCtrl.php">Inserisci utente</a> 
              <?php } else { ?>          
                <a href="/isoleecologiche/ctrl/sceltaCentroRaccoltaCtrl.php">Inserisci utente</a>
              <?php } ?>        
            </li>
            <?php } ?> 					 						             
            <?php if ($userUtils->isUserInGroup($loggedUser, "societa servizi")) { ?>  							             
            <li <?php if ($paginaMenu==='societaView') { ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/profileCtrl.php">Societa</a>            
            </li>			
            <?php } ?> 						 						             
            <?php if ($userUtils->isUserInGroup($loggedUser, "consorzio")) { ?>
              <?php if (false) { ?>    							             
                <li <?php if ($paginaMenu==='consorzioView') { ?> class="uk-active" <?php } ?> >               
                  <a href="/isoleecologiche/ctrl/profileCtrl.php">Consorzio</a>            
                </li>
              <?php } ?>   
			<li <?php if ($paginaMenu==='ricercaAziendeView') { ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/ricercaAziendeCtrl.php">Ricerca Utente</a>            
            </li>			
            <?php } ?> 						 						 						 
<?php 
          if (isPageEnabled($loggedUser, 'prenotazioniCtrl.php', $permissionMappings)) { ?>  						             
            <li <?php if ($paginaMenu==='prenotazioniView') { ?> class="uk-active" <?php } ?> >               
              <a href="/isoleecologiche/ctrl/prenotazioniCtrl.php">Prenotazioni</a>            
            </li>						 
<?php }
							
          if (isPageEnabled($loggedUser, 'prenotazioniConsorzioCtrl.php', $permissionMappings)) { ?> 						             
              

              <?php if (isset($profilo->areaEcologica) && $profilo->areaEcologica) { ?> 
                <?php if (isset($profilo->idCentroRaccolta)) { ?>      
                  <li <?php if ($paginaMenu==='prenotazioniView') { ?> class="uk-active" <?php } ?> >       
                    <a href="/isoleecologiche/ctrl/prenotazioniConsorzioCtrl.php">Prenotazioni</a>
                  </li>	   
                <?php } else { ?>          
                  <li <?php if ($paginaMenu==='prenotazioniView') { ?> class="uk-active" <?php } ?> > 
                    <a href="/isoleecologiche/ctrl/sceltaCentroRaccoltaCtrl.php">Prenotazioni</a>
                  </li>	
                <?php } ?> 
              <?php } else { ?>     
                <li <?php if ($paginaMenu==='prenotazioniView') { ?> class="uk-active" <?php } ?> > 
                  <a href="/isoleecologiche/ctrl/prenotazioniConsorzioCtrl.php">Prenotazioni</a>   
                </li>	
                <li <?php if ($paginaMenu==='registroPrenotazioniView') { ?> class="uk-active" <?php } ?> >               
                  <a href="/isoleecologiche/ctrl/registroPrenotazioniCtrl.php">Registro</a>            
                </li>	
              <?php } ?>        
            
			  <?php if($userUtils->isUserInGroup($loggedUser, "area ecologica")) { ?> 
				<li <?php if ($paginaMenu==='cambioStatoPrenotazioneView') { ?> class="uk-active" <?php } ?> >   
				  <?php if (isset($profilo->idCentroRaccolta)) { ?>  
					<a href="/isoleecologiche/ctrl/cambioStatoPrenotazioneCtrl.php">Cambia stato prenotazione</a>        
				  <?php } else { ?>          
					<a href="/isoleecologiche/ctrl/sceltaCentroRaccoltaCtrl.php">Cambia stato prenotazione</a>
				  <?php } ?>        
				</li>		
			  <?php } ?>
			  
            <?php } ?>  		  
            <?php if ($userUtils->isUserInGroup($loggedUser, "consorzio")) { ?>           
            <li class="uk-parent" data-uk-dropdown="{}" aria-haspopup="true" aria-expanded="false">               
              <a>Impostazioni</a>
              <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-width-1">										                 
                <div class="uk-grid uk-dropdown-grid">											                   
                  <div class="uk-width-1-1">												                     
                    <ul class="uk-nav uk-nav-navbar">													                       
                      <li>                      
                        <a href="/isoleecologiche/ctrl/orariCtrl.php">Orari centri di raccolta</a>            
                      </li>												           
                    </ul>											         
                  </div>											         
                  <!-- <div class="uk-width-1-1">												           
                    <ul class="uk-nav uk-nav-navbar">													             
                      <li>            
                      <a href="/isoleecologiche/ctrl/logoutCtrl.php">Esci</a>            
                      </li>												           
                    </ul>											         
                  </div>							 -->			       
                </div>									     
              </div>					
            </li>         
            <?php } ?> 						             
				
            <li class="uk-parent" data-uk-dropdown="{}" aria-haspopup="true" aria-expanded="false">							               
              <a href="/isoleecologiche/ctrl/modificaPasswordCtrl.php">                
                <span class="icon-user">                       
                </span>&nbsp;<?=isset($loggedUser) ? $loggedUser->getLogin() : ''?></a>							 									               
              <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-width-1">										                 
                <div class="uk-grid uk-dropdown-grid">											                   
                  <div class="uk-width-1-1">												                     
                    <ul class="uk-nav uk-nav-navbar">													                       
                      <li>                      
                      <a href="/isoleecologiche/ctrl/modificaPasswordCtrl.php">Modifica password</a>            
            </li>												           
          </ul>											         
        </div>											         
        <div class="uk-width-1-1">												           
          <ul class="uk-nav uk-nav-navbar">													             
            <li>            
            <a href="/isoleecologiche/ctrl/logoutCtrl.php">Esci</a>            
            </li>												           
          </ul>											         
        </div>										       
      </div>									     
    </div>						     
    </li>					     
    </ul>	 				     
    </div>	 					 		 					 					 					 		 				 								     
    <a href="#offcanvas" class="uk-navbar-toggle uk-navbar-flip uk-visible-small" data-uk-offcanvas></a>				 								     
    <a class="tm-logo-small uk-navbar-brand uk-visible-small" href="/isoleecologiche/ctrl/profileCtrl.php">	       
      <img class="tm-logo" src="/isoleecologiche/cache/gufo.png" alt="" width="240" height="108" /></a>				 			  		     
    </div>                 
    <div class="uk-container uk-container-center">                
      <div style="margin-top:20px; ">        
        <h5>Sistema di prenotazione PER IL CONFERIMENTO DEI RIFIUTI AI CENTRI DI RACCOLTA        
        </h5>
		  <?php if ( ($userUtils->isUserInGroup($loggedUser, "conto terzi intermediario") || $userUtils->isUserInGroup($loggedUser, "conto terzi consorzio")) and (isset($_SESSION['azienda'])) )  { ?> 
		  	<label style="float: right; font-weight: bold;">
				<?php $azienda = $_SESSION['azienda']; 	?>
          <a href="/isoleecologiche/ctrl/aziendaCtrl.php">  
					  <span class="icon-user"></span><?=$azienda->denominazione?>
          </a>	
			  </label>
		  <?php } ?> 
      <?php if ($userUtils->isUserInGroup($loggedUser, "area ecologica") and (isset($_SESSION['azienda'])) )  { ?> 
		  	<label style="float: right; font-weight: bold;">
				<?php $azienda = $_SESSION['azienda']; 	?>
					  <span class="icon-user"></span><?=$azienda->denominazione?> 	
			  </label>
		  <?php } ?> 
      </div>         
    </div>


 		