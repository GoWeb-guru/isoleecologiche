<?php
/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/
if ($config = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/isoleecologiche/config.ini")) {
	$dbhost = $config["db_host"];
	$dbuser = $config["db_user"];
	$dbpass = $config["db_pass"];
	$dbname = $config["db_name"];
}

//	Connection
global $tutorial_db;

$tutorial_db = new mysqli();
$tutorial_db->connect($dbhost, $dbuser, $dbpass, $dbname);
$tutorial_db->set_charset("utf8");

//	Check Connection
if ($tutorial_db->connect_errno) {
    printf("Connect failed: %s\n", $tutorial_db->connect_error);
    exit();
}


/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
//$html .= '<a class="linkrifiuti" href=urlString>';
$html .= 'nameString pulsante ';
//$html .= '<h4>functionString</h4>';
//$html .= '</a>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-99èéòçàùìë,]/", " ", $_POST['query']);
$search_string = $tutorial_db->real_escape_string($search_string);

$idTipologiaUtente = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['idTipologiaUtente']);
$idTipologiaUtente = $tutorial_db->real_escape_string($idTipologiaUtente);

$centroRaccolta = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['centroRaccolta']);
$centroRaccolta = $tutorial_db->real_escape_string($centroRaccolta);


//$search_string ="sa";
// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	
	// Build Query
	//$query = 'SELECT * FROM rifiuti WHERE desc_rifiuto_it LIKE "%'.$search_string.'%" ORDER BY desc_rifiuto_it';
	
	/*
	$query = "SELECT r . * " 
			."FROM rifiuti_verdeg r "
			."WHERE r.desc_rifiuto_it LIKE '%".($search_string)."%' "
			." ORDER BY desc_rifiuto_it"; 
	*/
	$query = "select r.*, rel.id_rifiuto_verdeg, rel.cer " 
		."from rifiuti_verdeg r  " 
		."left join rel_rifiuti_verdeg rel on (rel.id_rifiuto_verdeg = r.id_rifiuto_verdeg "
												."AND (rel.id_tipologia_utente = 0 or rel.id_tipologia_utente = ".$idTipologiaUtente. ")) "
		."WHERE r.desc_rifiuto_it LIKE '%".($search_string)."%' ";
	//echo $query;
	//die();
	//return;
	
	
	//echo("idCoomune:".$lidComune);
	//echo("$idconsorzio:".$$idconsorzio);
	// Do Search
	$result = $tutorial_db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}
	
	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

			// Format Output Strings And Hightlight Matches
			$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['desc_rifiuto_it']);
			
			// Insert Name
			$output = str_replace('nameString', $display_name, $html);

			// Insert URL
			//$output = str_replace('urlString', $display_url, $output);
			
			//Gestione pulsante
			if (isset($result['id_rifiuto_verdeg'])) {
				$display_url = "\"javascript:void(0);onclick=impostaRifiuto('".urlencode(str_replace("'","\'",$result['desc_rifiuto_it']))."|".$result['id_rifiuto_verdeg']."|".$result['cer']."');return false;\"";

				$output = str_replace('pulsante', '<button type="button" onClick='.$display_url.' class="btn btn-primary">Aggiungi</button>', $output);
			}
			else{ //rifiuti presenti solo su verdegufo e quindi non conferibili
				$display_url = "javascript:void(0);onclick=segnala();";

				$output = str_replace('pulsante', '<button type="button" onClick='.$display_url.' class="btn btn-secondary">Non conferibile</button>', $output);
			}
			
			// Output
			echo($output);
		}
    if (count($result_array)==1)
    {
      $descrizione=str_replace("'","&#39",$result_array[0]['desc_rifiuto_it']);
      echo '<input type="hidden" id="results-rifiuti-hidden" value="'.$descrizione.'">';
      
      
      $display_id=$descrizione."|".urlencode($result_array[0]['id_rifiuto']);
            
      echo '<input type="hidden" id="results-rifiuti-hidden-id" value="'.$display_id.'">';

      
      
    }
    else
    {
      echo '<input type="hidden" id="results-rifiuti-hidden" value="">';
    }
	}else{

		echo '<input type="hidden" id="results-rifiuti-hidden" value="">';
		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<b>Nessun risultato trovato.</b>', $output);
		$output = str_replace('pulsante','',$output);
		$output = str_replace('functionString', 'Sorry :(', $output);

		// Output
		echo($output);
	}
}

?>