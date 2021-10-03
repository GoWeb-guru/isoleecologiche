
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

<fieldset id="users-profile-core">
	<legend>
		Intermediario	</legend>
	<dl class="dl-horizontal">
		<dt>
			Denominazione		</dt>
		<dd>
			<?=$profilo->denominazione?>&nbsp;		</dd>
		<dt>
			Email		</dt>

					<dd>
				<?=$profilo->email?>&nbsp;			</dd>		
		
	</dl>
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
