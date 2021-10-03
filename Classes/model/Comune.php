<?php
namespace model;

use util\DB, exception\DBException;

class Comune {

	public  $idComune; 
	public  $descComune;
	public  $idConsorzio;
	public  $mailComune;
	
	public static function getListaComuni() {
		$db = new DB();

		$params = array();

		$query = 
			"SELECT id_comune, nome_comune, mail_comune " .
			"FROM comuni ";
			
		
		$query .= "ORDER BY nome_comune ";

		$result = $db->getResultQuery($query, $params);
		
		$listaComuni = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$comune = new Comune();
				$comune->idComune = $row['id_comune'];
				$comune->descComune = $row['nome_comune'];
				$comune->mailComune = $row['mail_comune'];
				$listaComuni[$comune->idComune] = $comune;
			}
			
		}
		
		return $listaComuni; 
	}
	
	public static function getListaComuniByDenominazioneLike($denominazione) {
		$db = new DB();

		$params = array("%" . strtoupper($denominazione) . "%");

		$query = 
			"SELECT id_comune, nome_comune " . 
			"FROM comuni ".
			"WHERE UPPER(nome_comune) LIKE ? " . 
			"ORDER BY nome_comune ";

		$result = $db->getResultQuery($query, $params);
		
		$listaComuni = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$comune = new Comune();
				$comune->idComune = $row['id_comune'];
				$comune->descComune = $row['nome_comune'];
				
				$listaComuni[$comune->idComune] = $comune;
			}
		}
		
		return $listaComuni;
	}
	
}
?>