
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

						<form id="register" action="ctrl/abilitaIntermediarioCtrl.php" method="post" class="form-validate form-horizontal well">
<h6>
Abilitandosi al ruolo di intermediario sar&agrave; possibile registrare prenotazioni anche per altre persone.
</h6>		
<h6>
Se si desidera proseguire selezionare il pulsante abilita.
</h6>			
<h6>
Dopo l'abilitazione averr&agrave;, in automatico, il logout dal sistema.
</h6>	
<h6>
Per agire come intermediario sar&agrave; sufficiente accedere nuovamente al sistema con le stesse credenziali. 
</h6>			
<div class="profile">



<br/> <br/> 
   <div class="control-group">
		<div class="controls">
			<button type="submit" id="abilita" name="abilita" value="abilita" class="btn btn-primary">abilita</button>
			<button type="submit" name="annulla" value="Annulla" class="cancel btn btn-primary">annulla</button>
		</div>
	</div> 

	</form>

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
	