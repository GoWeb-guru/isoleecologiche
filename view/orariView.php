<script type="text/javascript">
	var validOptions = ["00", "15", "30", "45"];
	previousValue = "";
	
	var filterChanged = function() {
		$('#centroRaccoltaHidden').val($('#centroRaccolta').val());
		$('#cambiaCentro').submit();
	}

	window.onload = function() {
		let filter = document.getElementById('centroRaccolta');
		filter.addEventListener('change', filterChanged);
	}

	function copia(oggetto){
		valCopia = $("#valCopia").val();
		if(valCopia != 0){
			$('#'+valCopia).css('background-color', '#ECECEC');
		}
		$(oggetto).css('background-color', '#AAAAAA');
		$("#valCopia").val(oggetto.id);
	}

	function incolla(oggetto){
		valCopia = $("#valCopia").val();
		if(valCopia != 0){
			//leggere nr e copiare sulla riga dell'id ogggetto
			rigaCopia = valCopia.substring(0, 3);
			rigaIncolla = oggetto.id.substring(0, 3);
			for (let index = 1; index <=4; index++) {
				$('input[name="'+rigaIncolla+'I'+index+'"]').val($('input[name="'+rigaCopia+'I'+index+'"]').val());
				$('input[name="'+rigaIncolla+'F'+index+'"]').val($('input[name="'+rigaCopia+'F'+index+'"]').val());
				$('input[name="'+rigaIncolla+'Persone'+index+'"]').val($('input[name="'+rigaCopia+'Persone'+index+'"]').val());
				$('select[name="'+rigaIncolla+'Antpost'+index+'"]').val($('select[name="'+rigaCopia+'Antpost'+index+'"]').val());
			}
			
		}
	}

	function salva(){
		$("#salva").val(1);
		$("#insOrario").isValid();
	}

</script>

<style>
	.ore{
		width:75px;
	}
	.minuti{
		width:20px;
	}
	.persone{
		width:13px;
	}
	.bordo{
		border-right-style: inset;
	}
	.antpost{
		width:60px;
	}
	.allinea{
		float:left;
	}

	table.uk-table td {
		font-size: 90%;
		vertical-align: middle;
	}

	input:invalid+span:after {
	position: absolute;
	content: '✖';
	color:red;
	padding-left: 5px;
	}

	input:valid+span:after {
	position: absolute;
	content: '✓';
	padding-left: 5px;
	}

</style>


<div class="tm-wrapper">

	<div class="tm-block tm-block-padding-top">
		<div class=" uk-container uk-container-center">
			<section class="tm-top-a uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
				<div class="uk-width-1-1">
					<div class="uk-panel"></div>
				</div>
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

							<?php if (isset($okMessage)) {?>
							<div class="uk-alert uk-alert-large uk-alert-success" data-uk-alert="">
								<button type="button" class="uk-alert-close uk-close"></button>							
								<p><?=$okMessage?></p>
							</div>
							<?php } ?>

						</div>

						<div class="profile">
							<form style="display:none" id="cambiaCentro" name="cambiaCentro" method="post" action="ctrl/orariCtrl.php" class="form-validate form-horizontal well">
										<input type="hidden" name="centroRaccoltaHidden" id="centroRaccoltaHidden">
							</form>
							<form id="insOrario" name="insOrario" method="post" action="ctrl/orariCtrl.php" class="form-validate form-horizontal well" style="padding: 0px !important;">
							<input type="hidden" name="salva" id="salva" value="0">
							<input type="hidden" id="valCopia" value="0">
							<hr>
							<div class="control-group">
								<div class="controls" style="text-align: center;">
								<b>Centro di raccolta<span class="star">&nbsp;* </span></b> <select name="centroRaccolta" id="centroRaccolta" required="required" aria-required="true" style="width: 500px;">
										<option value="">- seleziona un centro di raccolta -</option>
										<?php foreach ($listCentriRaccolta as $idCentroRaccolta => $centroRaccolta) { ?>
										<option value="<?=$idCentroRaccolta?>" <?=getUpdateSelectedOption($idCentroRaccolta, $centroRaccoltaSelezionato)?> >
										<?=output($centroRaccolta->nomeCentro . ' - ' . $centroRaccolta->indirizzo)?></option>
										<?php } ?>
									</select>

								</div>
							</div>	

							<?php error_reporting(0); if(isset($listaOrari)){ ?>
							<table class="uk-table uk-table-striped uk-table-condensed uk-table-hover" style="width: 100%;">
								<tr><th></th><th>Inizio /<br> Fine</th><th>Nr.<br>Ris.</th><th class="bordo" style="display:none">Ant/Post</th>
									<th>Inizio /<br> Fine</th><th>Nr.<br>Ris.</th><th class="bordo" style="display:none">Ant/Post</th>
									<th>Inizio /<br> Fine</th><th>Nr.<br>Ris.</th><th class="bordo" style="display:none">Ant/Post</th>
									<th >Inizio /<br> Fine</th><th>Nr.<br>Ris.</th><th style="display:none">Ant / Post</th>
									<th>C / <br>I</th>
								</tr>
								<?php foreach ($listaOrari as $key => $value) {
											if($value->idGiorno == 1) $listaLunedi[$value->idFasciaOraria] = $value;
											if($value->idGiorno == 2) $listaMartedi[$value->idFasciaOraria] = $value;
											if($value->idGiorno == 3) $listaMercoledi[$value->idFasciaOraria] = $value;
											if($value->idGiorno == 4) $listaGiovedi[$value->idFasciaOraria] = $value;
											if($value->idGiorno == 5) $listaVenerdi[$value->idFasciaOraria] = $value;
											if($value->idGiorno == 6) $listaSabato[$value->idFasciaOraria] = $value;
											if($value->idGiorno == 0) $listaDomenica[$value->idFasciaOraria] = $value;
										} 
									  echo '<pre style="display:none">'; print_r($listaLunedi); echo '</pre>';
								?>
								<tr><th>Lunedì</th>  <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunI1" value="<?=esiste($listaLunedi[1]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunF1" value="<?=esiste($listaLunedi[1]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="lunPersone1" maxlength="1" value="<?=esiste($listaLunedi[1]->numPersone, $numPersone)?>"> <input type="hidden" name="lun1" value="<?=esiste($listaLunedi[1]->idOrarioCentroRaccolta)?>"> </td>
													 <td class="bordo" style="display:none"><select class="antpost"  name="lunAntpost1"><option value="A" <?=($listaLunedi[1]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaLunedi[1]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunI2" value="<?=esiste($listaLunedi[2]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunF2" value="<?=esiste($listaLunedi[2]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="lunPersone2" maxlength="1" value="<?=esiste($listaLunedi[2]->numPersone, $numPersone)?>"> <input type="hidden" name="lun2" value="<?=esiste($listaLunedi[2]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="lunAntpost2"><option value="A" <?=($listaLunedi[2]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaLunedi[2]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunI3" value="<?=esiste($listaLunedi[3]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunF3" value="<?=esiste($listaLunedi[3]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="lunPersone3" maxlength="1" value="<?=esiste($listaLunedi[3]->numPersone, $numPersone)?>"> <input type="hidden" name="lun3" value="<?=esiste($listaLunedi[3]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="lunAntpost3"><option value="A" <?=($listaLunedi[3]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaLunedi[3]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunI4" value="<?=esiste($listaLunedi[4]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="lunF4" value="<?=esiste($listaLunedi[4]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="lunPersone4" maxlength="1" value="<?=esiste($listaLunedi[4]->numPersone, $numPersone)?>"> <input type="hidden" name="lun4" value="<?=esiste($listaLunedi[4]->idOrarioCentroRaccolta)?>"> </td>
													 <td style="display:none"><select class="antpost" name="lunAntpost4"><option value="A" <?=($listaLunedi[4]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaLunedi[4]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>
													 <td><input type="button" value="c" id="lunC" onClick="copia(this)"><br/><input type="button" value="i" id="lunI" onClick="incolla(this)" style="width:23px; margin-top:2px"></td>

								<tr><th>Martedì</th> <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="marI1" value="<?=esiste($listaMartedi[1]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="marF1" value="<?=esiste($listaMartedi[1]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="marPersone1" maxlength="1" value="<?=esiste($listaMartedi[1]->numPersone, $numPersone)?>"> <input type="hidden" name="mar1" value="<?=esiste($listaMartedi[1]->idOrarioCentroRaccolta)?>"> </td>
													 <td class="bordo" style="display:none"><select class="antpost"  name="marAntpost1"><option value="A" <?=($listaMartedi[1]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMartedi[1]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="marI2" value="<?=esiste($listaMartedi[2]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="marF2" value="<?=esiste($listaMartedi[2]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="marPersone2" maxlength="1" value="<?=esiste($listaMartedi[2]->numPersone, $numPersone)?>"> <input type="hidden" name="mar2" value="<?=esiste($listaMartedi[2]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="marAntpost2"><option value="A" <?=($listaMartedi[2]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMartedi[2]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="marI3" value="<?=esiste($listaMartedi[3]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="marF3" value="<?=esiste($listaMartedi[3]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="marPersone3" maxlength="1" value="<?=esiste($listaMartedi[3]->numPersone, $numPersone)?>"> <input type="hidden" name="mar3" value="<?=esiste($listaMartedi[3]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="marAntpost3"><option value="A" <?=($listaMartedi[3]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMartedi[3]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="marI4" value="<?=esiste($listaMartedi[4]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="marF4" value="<?=esiste($listaMartedi[4]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="marPersone4" maxlength="1" value="<?=esiste($listaMartedi[4]->numPersone, $numPersone)?>"> <input type="hidden" name="mar4" value="<?=esiste($listaMartedi[4]->idOrarioCentroRaccolta)?>"> </td>
													 <td style="display:none"><select class="antpost" name="marAntpost4"><option value="A" <?=($listaMartedi[4]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMartedi[4]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>
													 <td><input type="button" value="c" id="marC" onClick="copia(this)"><br/><input type="button" value="i" id="marI" onClick="incolla(this)" style="width:23px; margin-top:2px"></td>

								<tr><th>Mercoledì</th><td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="merI1" value="<?=esiste($listaMercoledi[1]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="merF1" value="<?=esiste($listaMercoledi[1]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="merPersone1" maxlength="1" value="<?=esiste($listaMercoledi[1]->numPersone, $numPersone)?>"> <input type="hidden" name="mer1" value="<?=esiste($listaMercoledi[1]->idOrarioCentroRaccolta)?>"> </td>
													 <td class="bordo" style="display:none"><select class="antpost"  name="merAntpost1"><option value="A" <?=($listaMercoledi[1]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMercoledi[1]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="merI2" value="<?=esiste($listaMercoledi[2]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="merF2" value="<?=esiste($listaMercoledi[2]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="merPersone2" maxlength="1" value="<?=esiste($listaMercoledi[2]->numPersone, $numPersone)?>"> <input type="hidden" name="mer2" value="<?=esiste($listaMercoledi[2]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="merAntpost2"><option value="A" <?=($listaMercoledi[2]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMercoledi[2]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="merI3" value="<?=esiste($listaMercoledi[3]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="merF3" value="<?=esiste($listaMercoledi[3]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="merPersone3" maxlength="1" value="<?=esiste($listaMercoledi[3]->numPersone, $numPersone)?>"> <input type="hidden" name="mer3" value="<?=esiste($listaMercoledi[3]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="merAntpost3"><option value="A" <?=($listaMercoledi[3]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMercoledi[3]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="merI4" value="<?=esiste($listaMercoledi[4]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="merF4" value="<?=esiste($listaMercoledi[4]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="merPersone4" maxlength="1" value="<?=esiste($listaMercoledi[4]->numPersone, $numPersone)?>"> <input type="hidden" name="mer4" value="<?=esiste($listaMercoledi[4]->idOrarioCentroRaccolta)?>"> </td>
													 <td style="display:none"><select class="antpost" name="merAntpost4"><option value="A" <?=($listaMercoledi[4]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaMercoledi[4]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>
													 <td><input type="button" value="c" id="merC" onClick="copia(this)"><br/><input type="button" value="i" id="merI" onClick="incolla(this)" style="width:23px; margin-top:2px"></td>

								<tr><th>Giovedì</th> <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioI1" value="<?=esiste($listaGiovedi[1]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioF1" value="<?=esiste($listaGiovedi[1]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="gioPersone1" maxlength="1" value="<?=esiste($listaGiovedi[1]->numPersone, $numPersone)?>"> <input type="hidden" name="gio1" value="<?=esiste($listaGiovedi[1]->idOrarioCentroRaccolta)?>"> </td>
													 <td class="bordo" style="display:none"><select class="antpost"  name="gioAntpost1"><option value="A" <?=($listaGiovedi[1]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaGiovedi[1]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioI2" value="<?=esiste($listaGiovedi[2]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioF2" value="<?=esiste($listaGiovedi[2]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="gioPersone2" maxlength="1" value="<?=esiste($listaGiovedi[2]->numPersone, $numPersone)?>"> <input type="hidden" name="gio2" value="<?=esiste($listaGiovedi[2]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="gioAntpost2"><option value="A" <?=($listaGiovedi[2]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaGiovedi[2]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioI3" value="<?=esiste($listaGiovedi[3]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioF3" value="<?=esiste($listaGiovedi[3]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="gioPersone3" maxlength="1" value="<?=esiste($listaGiovedi[3]->numPersone, $numPersone)?>"> <input type="hidden" name="gio3" value="<?=esiste($listaGiovedi[3]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="gioAntpost3"><option value="A" <?=($listaGiovedi[3]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaGiovedi[3]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioI4" value="<?=esiste($listaGiovedi[4]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="gioF4" value="<?=esiste($listaGiovedi[4]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="gioPersone4" maxlength="1" value="<?=esiste($listaGiovedi[4]->numPersone, $numPersone)?>"> <input type="hidden" name="gio4" value="<?=esiste($listaGiovedi[4]->idOrarioCentroRaccolta)?>"> </td>
													 <td style="display:none"><select class="antpost" name="gioAntpost4"><option value="A" <?=($listaGiovedi[4]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaGiovedi[4]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>
													 <td><input type="button" value="c" id="gioC" onClick="copia(this)"><br/><input type="button" value="i" id="gioI" onClick="incolla(this)" style="width:23px; margin-top:2px"></td>

								<tr><th>Venerdì</th> <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="venI1" value="<?=esiste($listaVenerdi[1]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="venF1" value="<?=esiste($listaVenerdi[1]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="venPersone1" maxlength="1" value="<?=esiste($listaVenerdi[1]->numPersone, $numPersone)?>"> <input type="hidden" name="ven1" value="<?=esiste($listaVenerdi[1]->idOrarioCentroRaccolta)?>"> </td>
													 <td class="bordo" style="display:none"><select class="antpost"  name="venAntpost1"><option value="A" <?=($listaVenerdi[1]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaVenerdi[1]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="venI2" value="<?=esiste($listaVenerdi[2]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="venF2" value="<?=esiste($listaVenerdi[2]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="venPersone2" maxlength="1" value="<?=esiste($listaVenerdi[2]->numPersone, $numPersone)?>"> <input type="hidden" name="ven2" value="<?=esiste($listaVenerdi[2]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="venAntpost2"><option value="A" <?=($listaVenerdi[2]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaVenerdi[2]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="venI3" value="<?=esiste($listaVenerdi[3]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="venF3" value="<?=esiste($listaVenerdi[3]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="venPersone3" maxlength="1" value="<?=esiste($listaVenerdi[3]->numPersone, $numPersone)?>"> <input type="hidden" name="ven3" value="<?=esiste($listaVenerdi[3]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="venAntpost3"><option value="A" <?=($listaVenerdi[3]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaVenerdi[3]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="venI4" value="<?=esiste($listaVenerdi[4]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="venF4" value="<?=esiste($listaVenerdi[4]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="venPersone4" maxlength="1" value="<?=esiste($listaVenerdi[4]->numPersone, $numPersone)?>"> <input type="hidden" name="ven4" value="<?=esiste($listaVenerdi[4]->idOrarioCentroRaccolta)?>"> </td>
													 <td style="display:none"><select class="antpost" name="venAntpost4"><option value="A" <?=($listaVenerdi[4]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaVenerdi[4]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>
													 <td><input type="button" value="c" id="venC" onClick="copia(this)"><br/><input type="button" value="i" id="venI" onClick="incolla(this)" style="width:23px; margin-top:2px"></td>

								<tr><th>Sabato</th> <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabI1" value="<?=esiste($listaSabato[1]->inizio)?>"><span class="validity"></span><br>
														 <input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabF1" value="<?=esiste($listaSabato[1]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="sabPersone1" maxlength="1" value="<?=esiste($listaSabato[1]->numPersone, $numPersone)?>"> <input type="hidden" name="sab1" value="<?=esiste($listaSabato[1]->idOrarioCentroRaccolta)?>"> </td>
													 <td class="bordo" style="display:none"><select class="antpost"  name="sabAntpost1"><option value="A" <?=($listaSabato[1]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaSabato[1]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabI2" value="<?=esiste($listaSabato[2]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabF2" value="<?=esiste($listaSabato[2]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="sabPersone2" maxlength="1" value="<?=esiste($listaSabato[2]->numPersone, $numPersone)?>"> <input type="hidden" name="sab2" value="<?=esiste($listaSabato[2]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="sabAntpost2"><option value="A" <?=($listaSabato[2]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaSabato[2]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabI3" value="<?=esiste($listaSabato[3]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabF3" value="<?=esiste($listaSabato[3]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="sabPersone3" maxlength="1" value="<?=esiste($listaSabato[3]->numPersone, $numPersone)?>"> <input type="hidden" name="sab3" value="<?=esiste($listaSabato[3]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="sabAntpost3"><option value="A" <?=($listaSabato[3]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaSabato[3]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabI4" value="<?=esiste($listaSabato[4]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="sabF4" value="<?=esiste($listaSabato[4]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="sabPersone4" maxlength="1" value="<?=esiste($listaSabato[4]->numPersone, $numPersone)?>"> <input type="hidden" name="sab4" value="<?=esiste($listaSabato[4]->idOrarioCentroRaccolta)?>"> </td>
													 <td style="display:none" ><select class="antpost" name="sabAntpost4"><option value="A" <?=($listaSabato[4]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaSabato[4]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>
													 <td><input type="button" value="c" id="sabC" onClick="copia(this)"><br/><input type="button" value="i" id="sabI" onClick="incolla(this)" style="width:23px; margin-top:2px"></td>

								<tr><th>Domenica</th><td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="domI1" value="<?=esiste($listaDomenica[1]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="domF1" value="<?=esiste($listaDomenica[1]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="domPersone1" maxlength="1" value="<?=esiste($listaDomenica[1]->numPersone, $numPersone)?>"> <input type="hidden" name="dom1" value="<?=esiste($listaDomenica[1]->idOrarioCentroRaccolta)?>"> </td>
													 <td class="bordo" style="display:none"><select class="antpost"  name="domAntpost1"><option value="A" <?=($listaDomenica[1]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaDomenica[1]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="domI2" value="<?=esiste($listaDomenica[2]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="domF2" value="<?=esiste($listaDomenica[2]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="domPersone2" maxlength="1" value="<?=esiste($listaDomenica[2]->numPersone, $numPersone)?>"> <input type="hidden" name="dom2" value="<?=esiste($listaDomenica[2]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="domAntpost2"><option value="A" <?=($listaDomenica[2]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaDomenica[2]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="domI3" value="<?=esiste($listaDomenica[3]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="domF3" value="<?=esiste($listaDomenica[3]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="domPersone3" maxlength="1" value="<?=esiste($listaDomenica[3]->numPersone, $numPersone)?>"> <input type="hidden" name="dom3" value="<?=esiste($listaDomenica[3]->idOrarioCentroRaccolta)?>"> </td>
													 <td  class="bordo" style="display:none"><select class="antpost" name="domAntpost3"><option value="A" <?=($listaDomenica[3]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaDomenica[3]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>

													 <td ><input type="time" class="ore" min="05:00" max="20:00" step="900" name="domI4" value="<?=esiste($listaDomenica[4]->inizio)?>"><span class="validity"></span><br>
														  <input type="time" class="ore" min="05:00" max="20:00" step="900" name="domF4" value="<?=esiste($listaDomenica[4]->fine)?>"><span class="validity"></span></td>
													 <td ><input class="persone" name="domPersone4" maxlength="1" value="<?=esiste($listaDomenica[4]->numPersone, $numPersone)?>"> <input type="hidden" name="dom4" value="<?=esiste($listaDomenica[4]->idOrarioCentroRaccolta)?>"> </td>
													 <td style="display:none"><select class="antpost" name="domAntpost4"><option value="A" <?=($listaDomenica[4]->ordinamento=='A') ? 'selected':'' ?> >A</option><option value="P" <?=($listaDomenica[4]->ordinamento=='P') ? 'selected':'' ?> >P</option></select></td>
													 <td><input type="button" value="c" id="domC" onClick="copia(this)"><br/><input type="button" value="i" id="domI" onClick="incolla(this)" style="width:23px; margin-top:2px"></td>
							</table>
							<div style="text-align: center;">
								<button class="btn btn-primary" style="padding: 20px;width: 200px;" onClick="salva()">Salva</button>
							</div>
							<?php } ?>

							</from>
						</div>
						<br />
						<table class="uk-table uk-table-striped uk-table-condensed uk-table-hover" style="background:#efefef">
						<thead>
						<tr>
						<th colspan="3">Legenda</th>	
						</tr>
						<tr>
						<th>Nr. Ris.</th>	
						<th style="font-size: 90%;">Numero Risorse</th>
						<th>&nbsp;</th>
						</tr>
						<!--
						<tr>
						<th >Ant / Post</th>	
						<th style="font-size: 90%;">Anticipo / Posticipo</th>
						<th>&nbsp;</th>
						</tr>
						-->
						<tr>
						<th>C / I</th>	
						<th style="font-size: 90%;">Copia / Incolla</th>
						<th>&nbsp;</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
						</table>
						
					</main>
				</div>
			</div>
		</div>
	</div>
		
		<div class="tm-block tm-block-padding-top ">
			<div class=" uk-container uk-container-center">
				<section class="tm-bottom-a uk-grid" data-uk-grid-match="{target:'> div > .uk-panel'}" data-uk-grid-margin>
					<div class="uk-width-1-1">
						<div class="uk-panel"></div>
					</div>
				</section>
			</div>
		</div>
		
		<a class="tm-totop-scroller  tm-block-secondary" data-uk-smooth-scroll href="#"></a>
	
	</div>