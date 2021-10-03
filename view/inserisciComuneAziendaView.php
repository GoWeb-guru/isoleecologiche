<script>
$.validator.addMethod(
	"regex",
	function(value, element, regexp) {
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
	},
	"Controlla il contenuto del campo."
);
</script>

<div class=" uk-container uk-container-center">
  <div class="tm-middle uk-grid">
    <main class="tm-main uk-width-medium-1-1">
    
    
    <div id="system-message-container">
			<?php if (isset($errorMessage)) {?>
      <div class="uk-alert uk-alert-large uk-alert-warning" data-uk-alert="">
        <button type="button" class="uk-alert-close uk-close"></button>
        <h2>Attenzione</h2>
        <p><?=$errorMessage?></p>
      </div>
      <?php } ?>
    </div>
    
    <div class="registration">      
      <div class="page-header">
        <div class="uk-hidden-large" style="margin-top:10px; "><h2>Sistema di prenotazione del ritiro teli agricoli, contenitori bonificati di fitofarmaci e toner</h2></div>
        <h2>Nuovo Utente</h2>
      </div>
      
      
      <form id="register" action="ctrl/inserisciComuneAziendaCtrl.php" method="post" class="form-validate form-horizontal well">
        
		<h4>Dati Utente</h4>

		  <style>
		  .rdo
			  position: relative
			  display: block
			  float: left
			  width: 18px
			  height: 18px
			  border-radius: 10px
			  background-color: #606062 
			  background-image: linear-gradient(#474749,#606062)
			  box-shadow: inset 0 1px 1px rgba(white,.15), inset 0 -1px 1px rgba(black,.15)
			  transition: all .15s ease
			  &:after
				content: ""
				position: absolute
				display: block
				top: 6px
				left: 6px
				width: 6px
				height: 6px
				border-radius: 50%
				background: white
				opacity: 0
				transform: scale(0)

			.cbx + span,
			.rdo + span
			  float: left
			  margin-left: 6px

			.forms
			  margin: auto
			  user-select: none

			  label
				display: inline-block
				margin: 10px
				cursor: pointer

			  input[type="checkbox"]
			  input[type="radio"]
				position: absolute
				opacity: 0

			  input[type="radio"]:checked + .rdo
				background-color: #606062 
				background-image: linear-gradient(#255CD2,#1D52C1)
				&:after
				  opacity: 1
				  transform: scale(1)
			  	transition: all .15s ease

		  </style>

		  <label for="rdo1" style="float: left; margin-right: 15px">
			<input type="radio" id="rdo1"  id="domesticoRadio" name="idTipologiaUtente" value="2">
			<span class="rdo"></span>
			<span style="font-weight: bold">Utenza domestica</span>
		  </label>

		  <label for="rdo2">
			<input type="radio" id="rdo2" id="aziendaRadio" name="idTipologiaUtente" value="1">
			<span class="rdo"></span>
			<span style="font-weight: bold">Azienda</span>
		  </label>
		<br><br>
        <div id="contenitoreForm">

        <div class="control-group">
          <div class="control-label contenitoreAzienda">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Denominazione:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="control-label contenitoreDomestico">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Cognome Nome:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="denominazione" maxlength="500" 
          value="<?php echo isset($_POST['denominazione']) ? output($_POST['denominazione']) : ''; ?>"  class="required" size="30" required="required" aria-required="true">
            <?=$validator->outputError('denominazione')?>						
           </div>
        </div>
              
        <div class="control-group contenitoreDomestico">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Codice Fiscale:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="codiceFiscale" maxlength="16" 
          value="<?php echo isset($_POST['codiceFiscale']) ? output($_POST['codiceFiscale']) : ''; ?>"  class="required" size="30" required="required" aria-required="true">
            <?=$validator->outputError('codiceFiscale', 'input')?>						
           </div>
        </div>
        
        <div class="control-group contenitoreAzienda">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Partita IVA:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" id="partitaIva" name="partitaIva" maxlength="500" 
          value="<?php echo isset($_POST['partitaIva']) ? output($_POST['partitaIva']) : ''; ?>" class="required" size="30" required="required" size="30" aria-required="true">
            <?=$validator->outputError('partitaIva')?>						
           </div>
        </div>
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Cellulare:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" id="telefono" name="telefono" maxlength="20" 
          value="<?php echo isset($_POST['telefono']) ? output($_POST['telefono']) : ''; ?>"  class="required" size="30" required="required" aria-required="true">
            <?=$validator->outputError('telefono')?>						
           </div>
        </div>
		
    
      <div class="control-group contenitoreAzienda">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Targa veicolo:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
            <input type="text" name="targaAz" maxlength="20" 
          value="<?php echo isset($_POST['targaAz']) ? output($_POST['targaAz']) : ''; ?>"  class="required" size="30" required="required" aria-required="true">
            <?=$validator->outputError('targa')?>						
           </div>
      </div>

      <div class="control-group contenitoreDomestico">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Targa veicolo:
            </label>
          </div>
          <div class="controls">
            <input type="text" name="targaDom" maxlength="20" 
          value="<?php echo isset($_POST['targaDom']) ? output($_POST['targaDom']) : ''; ?>"  size="30" aria-required="true">
            <?=$validator->outputError('targa')?>						
           </div>
      </div>

		
		<h4 class="contenitoreAzienda">Dati sede (altre sedi secondarie si potranno inserire successivamente)</h4>
    <h4 class="contenitoreDomestico">Dati sede utenza</h4>
		
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Comune:<span class="star">&nbsp;*</span>
            </label>
          </div>
          <div class="controls">
			<select name="idComune" id="idComune">
				<option value="">- seleziona un comune -</option>
				<?php foreach ($comuni as $idComune => $comune) { ?>
				<option value="<?=$idComune?>" <?=getSelectedOption('idComune', $idComune)?> >
				<?=output($comune->descComune)?></option>
				<?php } ?>
			</select>	
            <?=$validator->outputError('idComune')?>						
           </div>
        </div>
		<div class="control-group">
          <div class="control-label">
            <label id="jform_name-lbl" for="jform_name" class="hasTooltip required">
              Indirizzo:
            </label>
          </div>
          <div class="controls">
            <input type="text" name="indirizzo" maxlength="500" 
          value="<?php echo isset($_POST['indirizzo']) ? output($_POST['indirizzo']) : ''; ?>"  size="50" aria-required="true">
            <?=$validator->outputError('indirizzo')?>						
           </div>
        </div>
		

        <div id="privacy" style="width:98%; height: 300px; overflow-y: scroll; border-style: inset; background-color: ivory;">
		   
       <div class=WordSection1 style="padding: 10px;">
       
       <p class=MsoNormal align=center style='text-align:center;line-height:normal'><b
       style='mso-bidi-font-weight:normal'><span style='font-size:12.0pt;font-family:
       "Garamond",serif;mso-fareast-font-family:"Times New Roman";mso-fareast-language:
       IT'>INFORMATIVA SPECIFICA SUL TRATTAMENTO DATI PERSONALI DEGLI UTENTI DEI
       SERVIZI DI RACCOLTA RIFIUTI <o:p></o:p></span></b></p>
       
       <p class=MsoNormal align=center style='text-align:center;line-height:normal'><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:"Times New Roman";
       mso-bidi-font-family:Calibri;color:#365F91;mso-fareast-language:IT'><o:p>&nbsp;</o:p></span></p>
       
       <p class=MsoHeader style='text-align:justify'><span lang=X-NONE
       style='font-family:"Garamond",serif'>Ai sensi degli artt. 13 e 14 del
       Regolamento 2016/679/UE (nel seguito “GDPR”)</span><span lang=X-NONE
       style='font-family:"Garamond",serif;mso-ansi-language:IT'> </span><span
       style='font-family:"Garamond",serif;mso-ansi-language:IT'>STR S.R.L., </span><span
       lang=X-NONE style='font-family:"Garamond",serif'>nella sua veste di “Titolare
       del trattamento”, </span><span style='font-family:"Garamond",serif;mso-ansi-language:
       IT'>nella persona del legale rappresentante <i style='mso-bidi-font-style:normal'>pro
       tempore</i>, </span><span lang=X-NONE style='font-family:"Garamond",serif'>La
       informa che i Suoi dati personali raccolti</span><span style='font-family:"Garamond",serif;
       mso-ansi-language:IT'> nell’ambito del servizio pubblico di raccolta rifiuti</span><span
       lang=X-NONE style='font-family:"Garamond",serif'> saranno trattati nel rispetto
       delle normativa citata, al fine di garantire i diritti, le libertà
       fondamentali, nonché la dignità delle persone fisiche, con particolare
       riferimento alla riservatezza e all'identità personale. <o:p></o:p></span></p>
       
       <p class=MsoHeader><span lang=X-NONE style='font-family:"Garamond",serif;
       mso-bidi-font-family:Calibri'><o:p>&nbsp;</o:p></span></p>
       
       <ol style='margin-top:0cm' start=1 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Titolare del trattamento<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Il Titolare del trattamento
       è STR S.R.L., con sede legale in Piazza Risorgimento n. 1, Alba (CN) – C.A.P.
       12051 (P.IVA:02996810046; Tel:0172/560137; <span class=SpellE>Pec</span>:
       str@pec.it; e-mail: </span><a href="mailto:segreteria@strweb.biz"><span
       style='font-family:"Garamond",serif'>segreteria@strweb.biz</span></a><span
       style='font-family:"Garamond",serif'>, nella persona del legale rappresentante <i
       style='mso-bidi-font-style:normal'>pro tempore </i>contattabile per tramite dei
       recapiti di cui sopra. <o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=2 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Responsabile della Protezione Dati
            (c.d. “DPO”) <o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Il Responsabile della
       Protezione Dati è l’avvocato CRISTIANO BURDESE del Foro di Torino, con studio
       in Torino, in Piazza Carlo Emanuele II n. 13, contattabile per tramite dei
       seguenti recapiti: E-mail: c.burdese@agcavvocati.org; PEC:
       cristianoburdese@pec.ordineavvocatitorino.it; <span class=SpellE>Tel</span>:
       011-533234 – Fax: O11-542993).<o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=3 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Tipologia ed origine dei dati
            trattati<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Verranno trattati
       esclusivamente dati pertinenti e non eccedenti rispetto alle finalità di
       seguito elencate.<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>I dati personali saranno da
       Lei direttamente forniti in occasione della prenotazione del servizio in
       oggetto. In particolare, verranno raccolti i seguenti dati: nome, cognome,
       codice fiscale.<o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=4 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Finalità e base giuridica del
            trattamento<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><u><span style='font-family:"Garamond",serif'>Finalità:<o:p></o:p></span></u></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Il trattamento dei Suoi dati
       personali di cui sopra è effettuato dal Titolare del trattamento per la
       gestione del servizio pubblico di raccolta rifiuti. <o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Più precisamente - nel
       rispetto della normativa vigente in materia di protezione dei dati personali e
       senza necessità di uno specifico consenso da parte dell’Interessato - i Dati
       saranno raccolti, annotati ed archiviati, per i seguenti fini:<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l2 level1 lfo4'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>a)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>adempimento di una funzione pubblica (erogazione
       di servizi di interesse pubblico);<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l2 level1 lfo4'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>b)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>assolvimento ad obblighi normativi
       (Decreto 8 aprile 2008), nonché ad obblighi connessi ad attività
       amministrativo-contabili.<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><u><span style='font-family:"Garamond",serif'>Base giuridica:<o:p></o:p></span></u></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Il trattamento dei dati di
       cui sopra non è soggetto all’obbligo di acquisizione del consenso in quanto i
       dati da Lei forniti vengono utilizzati per adempiere ad una funzione pubblica (art.
       6, co. I, <span class=SpellE>lett</span>. e), nonché ad un obbligo di legge
       (art. 6, co. I, <span class=SpellE>lett</span>. C)) del GDPR.<o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=5 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Natura del conferimento<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:6.0pt;
       margin-left:36.0pt;text-align:justify;line-height:normal'><span
       style='font-family:"Garamond",serif'>Il conferimento dei dati di cui sopra è
       obbligatorio ai fini della prenotazione del servizio in oggetto ed in generale
       per l’assolvimento degli obblighi previsti dalle vigenti disposizioni normative
       e regolamentari.<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:6.0pt;
       margin-left:36.0pt;text-align:justify;line-height:normal'><span
       style='font-family:"Garamond",serif'>Il mancato conferimento dei dati stessi
       comporta l’impossibilità di prenotare il servizio in oggetto ed accedere al
       centro di raccolta rifiuti.<o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=6 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Ambito di comunicazione e diffusione<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>La informiamo che i dati
       raccolti non saranno mai diffusi e non saranno oggetto di comunicazione senza
       Suo esplicito consenso, salvo le comunicazioni necessarie che possono
       comportare il trasferimento di dati a <span class=SpellE>CoABSeR</span>
       (Consorzio Albese Braidese Servizi Rifiuti, ivi compreso il Comune di Bra) o ad
       altri soggetti per l’adempimento di obblighi di legge o contrattuali.<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Tutti i dipendenti ed ogni
       altra “persona fisica” che svolgono la propria attività sulla base delle istruzioni
       ricevute da STR S.R.L. (es. impiegati eco-sportello, coordinatore e guardiani
       dei centri di raccolta), ai sensi dell’art. 29 del GDPR, sono nominati
       “Autorizzati al trattamento” (nel seguito anche “Autorizzati”). Ai soggetti autorizzati
       STR S.R.L. impartisce adeguate istruzioni operative, con particolare
       riferimento all’adozione ed al rispetto delle misure di sicurezza, al fine di
       poter garantire la riservatezza e la sicurezza dei dati. <o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Non è previsto alcun tipo di
       diffusione dei dati.<o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=7 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Trasferimento all’estero<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>I dati raccolti ed elaborati
       non vengono trasferiti presso Società o altri enti al di fuori del territorio
       comunitario. <o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=8 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Modalità di trattamento<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>I Suoi dati sono raccolti e
       registrati in modo lecito e secondo correttezza per le finalità sopra indicate
       nel rispetto dei principi e delle prescrizioni di cui all’art. 5, co. 1 del
       GDPR. <o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Il trattamento dei dati
       personali avviene mediante strumenti manuali, informatici e telematici con
       logiche strettamente correlate alle finalità stesse e, comunque, in modo da
       garantirne la sicurezza e la riservatezza. <o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Il trattamento – in forma
       automatizzata e/o manuale – viene effettuato nel rispetto di quanto previsto
       dall’art. 32 del GDPR in materia di misure di sicurezza, ad opera di soggetti
       appositamente autorizzati in ottemperanza a quanto previsto dall’art. 29 del
       GDPR.<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Il trattamento è svolto dal Titolare
       del trattamento, ed infine, dai soggetti autorizzati ex art. 29 del GDPR.<o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=9 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Tempi di conservazione<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>I dati saranno trattati dal
       Titolare del trattamento ai fine dell’erogazione del servizio in oggetto e per
       dare esecuzione ad obblighi derivanti dal quadro regolamentare e normativo <i
       style='mso-bidi-font-style:normal'>pro tempore</i> applicabile, nel rispetto
       degli specifici obblighi di legge sulla conservazione dei dati (10 anni).<o:p></o:p></span></p>
       
       <ol style='margin-top:0cm' start=10 type=1>
        <li class=MsoNormal style='text-align:justify;line-height:normal;mso-list:
            l1 level1 lfo2'><b style='mso-bidi-font-weight:normal'><span
            style='font-family:"Garamond",serif'>Diritti dell’interessato<o:p></o:p></span></b></li>
       </ol>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>In ogni momento, Lei potrà
       esercitare, ai sensi degli artt. da 15 a 22 del GDPR, il diritto di:<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>a)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>chiedere la conferma dell’esistenza o meno
       di propri dati personali, nonché chiedere l’accesso agli stessi e alle
       informazioni relative;<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>b)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>ottenere le indicazioni circa le finalità
       del trattamento, le categorie dei dati personali, i destinatari o le categorie
       di destinatari a cui i dati personali sono stati o saranno comunicati e, quando
       possibile, il periodo di conservazione;<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>c)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>ottenere la rettifica, l’integrazione o la
       cancellazione dei dati;<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>d)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>ottenere la limitazione del trattamento;<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>e)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>ottenere la portabilità dei dati, ossia
       riceverli da un titolare del trattamento, in un formato strutturato, di uso
       comune e leggibile da dispositivo automatico, e trasmetterli ad un altro
       titolare del trattamento senza impedimenti;<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>f)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>opporsi al trattamento in qualsiasi
       momento ed anche nel caso di trattamento per finalità di marketing diretto;<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>g)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>opporsi ad un processo decisionale
       automatizzato relativo alle persone <span class=SpellE>ﬁsiche</span>, compresa
       la <span class=SpellE>profilazione</span>.<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>h)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>chiedere al titolare del trattamento
       l’accesso ai dati personali e la rettifica o la cancellazione degli stessi o la
       limitazione del trattamento che lo riguardano o di opporsi al loro trattamento,
       oltre al diritto alla portabilità dei dati;<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>i)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>revocare il consenso in qualsiasi momento
       senza pregiudicare la liceità del trattamento basata sul consenso prestato
       prima della revoca (diritto esperibile nel caso in cui il trattamento sia
       fondato sul consenso dell’interessato);<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:72.0pt;text-align:justify;text-indent:
       -18.0pt;line-height:normal;mso-list:l5 level1 lfo5'><![if !supportLists]><span
       style='font-family:"Garamond",serif;mso-fareast-font-family:Garamond;
       mso-bidi-font-family:Garamond'><span style='mso-list:Ignore'>j)<span
       style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
       style='font-family:"Garamond",serif'>proporre reclamo a un’autorità di
       controllo (Autorità Garante per la protezione dei dati personali) ex art. 77
       del GDPR.<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'>Se intende richiedere
       ulteriori informazioni sul trattamento dei Suoi dati personali o per
       l'eventuale esercizio dei Suoi diritti, potrà rivolgersi per iscritto al
       Titolare del trattamento, contattabile per tramite dei seguenti recapiti: </span><a
       href="mailto:segreteria@strweb.biz"><span style='font-family:"Garamond",serif'>segreteria@strweb.biz</span></a><span
       style='font-family:"Garamond",serif'> tel. 0173/364891<o:p></o:p></span></p>
       
       <p class=MsoNormal style='margin-left:36.0pt;text-align:justify;line-height:
       normal'><span style='font-family:"Garamond",serif'><o:p>&nbsp;</o:p></span></p>
       
       <p class=MsoNormal align=right style='margin-left:36.0pt;text-align:right;
       line-height:normal'><span style='font-family:"Garamond",serif'>Il Titolare del
       trattamento,<o:p></o:p></span></p>
       
       <p class=MsoNormal align=right style='margin-left:36.0pt;text-align:right;
       line-height:normal'><span style='font-family:"Garamond",serif'>in persona del
       legale rappresentante <i style='mso-bidi-font-style:normal'>pro tempore.</i><o:p></o:p></span></p>
       
       </div>
       
            </div>
             <br>
             <br>
             <div id="advise">Visualizzare interamente l'informativa sulla privacy prima di poter procedere alla registrazione</div>

             <div class="control-group"  id="checkPrivacy" style="display: none">
              <div class="controls">
                <input type="checkbox" name="condizioni" value="true" class="required" size="30" required="required" aria-required="true" />
          &nbsp;&nbsp;Dichiaro che l'utente che sto registrando ha preso visione dell'informativa privacy
          <?=$validator->outputError('condizioni')?>
              </div>
            </div>
		
        <br/>
 	
       
        <div class="control-group">
          <div class="controls">
            <button type="submit" name="submit" id="btnRegistrati" value="Registrati" style="display: none" class="btn btn-primary">Registra utente</button>
          </div>
        </div>

        </div>
        
      </form>
     </div>
	</main>
 </div>
 </div>  
  
	<script type="text/javascript">
		$(document).ready (function() {

      $("#privacy").scroll(function(e) {  
        
        if(e.originalEvent.srcElement.scrollHeight - e.originalEvent.srcElement.scrollTop -10 <= e.originalEvent.srcElement.clientHeight) {
            $("#advise").hide();
            $("#checkPrivacy").show();
            $("#confermaBtn").show();
      $("#btnRegistrati").show();
      
        }
      });

      <?php if (isset($_POST['idTipologiaUtente'])) {?>
        $("#contenitoreForm").css("display", "block");
        <?php if ($_POST['idTipologiaUtente']=='2') {?>
            $("#contenitoreForm").css("display", "block");
            $(".contenitoreDomestico").css("display", "block");
            $(".contenitoreAzienda").css("display", "none");
            $('input:radio[name=idTipologiaUtente][value=2]').attr('checked', true)
        <?php } else {?>
          $("#contenitoreForm").css("display", "block");
            $(".contenitoreDomestico").css("display", "none");
            $(".contenitoreAzienda").css("display", "block");
            $('input:radio[name=idTipologiaUtente][value=1]').attr('checked', true)
        <?php } ?>

      <?php } else {?>
        $("#contenitoreForm").css("display", "none");
      <?php } ?>


  

      

      $('input[type=radio][name=idTipologiaUtente]').change(function() {
          if (this.value == '2') {
            $("#contenitoreForm").css("display", "block");
            $(".contenitoreDomestico").css("display", "block");
            $(".contenitoreAzienda").css("display", "none");
            $("#partitaIva").val('');
          }
          else if (this.value == '1') {
            $("#contenitoreForm").css("display", "block");
            $(".contenitoreDomestico").css("display", "none");
            $(".contenitoreAzienda").css("display", "block");
            $("#codiceFiscale").val('');
          }
      })
			
			$('#register').on('click', '[type="submit"]', function(e) {
				//Rimuovo gli eventuali div di errore della validazione 
				//lato server
				$(".uk-alert-danger").remove();
				$("#register").removeClass("uk-form-danger");
				
				rules = {
					denominazione: "required",
					partitaIva: {
						regex: "^[0-9]{11}$"
					},
					codiceFiscale: {
						required: true,
						regex: "^[0-9]{11}$|^[A-Za-z]{6}[0-9]{2}[A-Za-z][0-9]{2}[A-Za-z][0-9]{3}[A-Za-z]$"
					},
					email: {
						required: true,
						email: true
					},
					telefono: {
						required: true,
						regex: "^[1-9][0-9]+\$"
					},
					idComune: "required",
          targaAz: "required",
					rules: {
						required: true,
						range: [1, 1]
					}
				}

				if ($.validator) {
					$('#register').validate({
						rules: rules,
						messages: {
							partitaIva: {
								regex: "Inserire una partita IVA"
							},
							codiceFiscale: {
								regex: "Inserire un codice fiscale o una partita IVA"
							},
              telefono: {
								regex: "Inserire un numero di cellulare, non un numero di telefono fisso. Inserire solo numeri."
							}
						},
						errorClass: "uk-form-danger"
					});
				}
			});

		});
	</script>
</body>
</html>