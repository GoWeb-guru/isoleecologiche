
<style type="text/css">
	
	.radiobtn {
		position: relative;
		/*display: block;*/
		display: -webkit-inline-box;
   }
	.radiobtn label {
		display: block;
		background: #fee8c3;
		color: #444;
		border-radius: 5px;
		padding: 10px 20px;
		border: 2px solid #fdd591;
		margin-bottom: 5px;
		cursor: pointer;
		width: 70%; /*bruno*/
		margin-right: 15px; /*bruno*/
   }
	.radiobtn label:after, .radiobtn label:before {
		content: "";
		position: absolute;
		right: 11px;
		top: 11px;
		width: 20px;
		height: 20px;
		border-radius: 3px;
		background: #fdcb77;
   }
	.radiobtn label:before {
		background: transparent;
		transition: 0.1s width cubic-bezier(0.075, 0.82, 0.165, 1) 0s, 0.3s height cubic-bezier(0.075, 0.82, 0.165, 2) 0.1s;
		z-index: 2;
		overflow: hidden;
		background-repeat: no-repeat;
		background-size: 13px;
		background-position: center;
		width: 0;
		height: 0;
		background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAxNS4zIDEzLjIiPiAgPHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE0LjcuOGwtLjQtLjRhMS43IDEuNyAwIDAgMC0yLjMuMUw1LjIgOC4yIDMgNi40YTEuNyAxLjcgMCAwIDAtMi4zLjFMLjQgN2ExLjcgMS43IDAgMCAwIC4xIDIuM2wzLjggMy41YTEuNyAxLjcgMCAwIDAgMi40LS4xTDE1IDMuMWExLjcgMS43IDAgMCAwLS4yLTIuM3oiIGRhdGEtbmFtZT0iUGZhZCA0Ii8+PC9zdmc+);
   }
	.radiobtn input[type="radio"] {
		display: none;
		position: absolute;
		width: 100%;
		appearance: none;
   }
	.radiobtn input[type="radio"]:checked + label {
		background: #fdcb77;
		animation-name: blink;
		animation-duration: 1s;
		border-color: #fcae2c;
   }
   
	.radiobtn input[type="radio"]:checked + label:after {
		background: #fcae2c;
   }
	.radiobtn input[type="radio"]:checked + label:before {
		width: 20px;
		height: 20px;
   }
   
   .radiobtn input[type="radio"]:disabled + label {
		background: #dddddd;
		border-color: #ccc;
		color: #999;
   }
   .radiobtn input[type="radio"]:disabled + label:after, .radiobtn input[type="radio"]:disabled + label:before {
		content: "";
		position: absolute;
		right: 11px;
		top: 11px;
		width: 20px;
		height: 20px;
		border-radius: 3px;
		background: #ccc;
   }
   
   
	@keyframes blink {
		0% {
			background-color: #fdcb77;
	   }
		10% {
			background-color: #fdcb77;
	   }
		11% {
			background-color: #fdd591;
	   }
		29% {
			background-color: #fdd591;
	   }
		30% {
			background-color: #fdcb77;
	   }
		50% {
			background-color: #fdd591;
	   }
		45% {
			background-color: #fdcb77;
	   }
		50% {
			background-color: #fdd591;
	   }
		100% {
			background-color: #fdcb77;
	   }
   }

</style>

   
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
	   
<form style="display:none" id="nuovaPrenotazione2" name="nuovaPrenotazione2" method="post" action="ctrl/sceltaCentroRaccoltaCtrl.php" class="form-validate form-horizontal well">
		   <input type="hidden" name="centroRaccolta" id="centroRaccoltaHidden">
</form>
	   
<form id="nuovaPrenotazione" name="nuovaPrenotazione" method="post" action="ctrl/sceltaCentroRaccoltaCtrl.php" class="form-validate form-horizontal well">
   <input type="hidden" name="conta" id="conta" value="0">
   
<fieldset id="users-profile-core">
   <legend>
	   Seleziona il centro di raccolta	</legend>
 
 <fieldset class="uk-form">
 




   <div class="control-group">
	 <div class="control-label">
	   <label>Centro di raccolta <span class="star">&nbsp;*</span></label>						
	 </div>
	 <div class="controls">
	   <select name="centroRaccolta" id="centroRaccolta" required="required" aria-required="true">
		 <option value="">- seleziona un centro di raccolta -</option>
		 <?php foreach ($listCentriRaccolta as $idCentroRaccolta => $centroRaccolta) { ?>
		
		 <option value="<?=$idCentroRaccolta?>" <?=getSelectedOption('centroRaccolta', $idCentroRaccolta)?> >
		 <?=output($centroRaccolta->nomeCentro . ' - ' . $centroRaccolta->indirizzo)?></option>
		 <?php  } ?>
	   </select>
	 </div>
   </div>	


	 
 </fieldset>
 
   <br/> 
  <div class="control-group">
	   <div class="controls">
		   <button type="submit" id="salva" name="salva" value="Salva" class="btn btn-primary">invia</button>
	   </div>
   </div>    
</form>
<script type="text/javascript">
	   $(document).ready (function() {
		   

		   
		   $('#nuovaPrenotazione').on('click', '[name="salva"]', function(e) {
			   //Rimuovo gli eventuali div di errore della validazione 
			   //lato server
			   $(".uk-alert-danger").remove();
			   $("#nuovaPrenotazione").removeClass("uk-form-danger");
			   

		   
			   rules = {
					'orarioCentroRaccolta[]': {required:true}
			   }
			   
			   $('#nuovaPrenotazione').validate({
				   ignore: [],
				   rules: rules,
				   messages: {
				   },
				   errorClass: "uk-form-danger",
				   errorPlacement: function (label, element) {
					   // default
					   if (element.is(':radio')) {
						   label.insertAfter('#xerrore');       
					   }
					   else {
						   label.insertAfter(element);
					   }
				   },
				   onfocusout: false
			   });
			   
		   });


		   

			   
	   });
   </script>


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
