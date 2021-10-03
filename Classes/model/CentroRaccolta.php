<?php
namespace model;

use util\DB, util\Dates, util\Numbers, exception\DBException, exception\DupkeyException;

class CentroRaccolta{

	public  $idCentroRaccolta; 
	public  $nomeCentro;
	public  $luogoCentro;
	public  $cap;
	public  $indirizzo;	
	public  $attivo;
	public  $numPersone;
	public  $codiceCC;
	
	
	public function loadCentriRaccolta($attivo,$idTipologiaUtente=1){
		$db = new DB();

		$query = "SELECT id_centro_raccolta, nome_centro, indirizzo, attivo, num_persone FROM centro_raccolta WHERE 1=1 ";
		
		if (isset($attivo)) {
			$params = array($attivo);
			$query .="AND attivo=? ";
		}else {
			$params = array();
		}

		$query .="order by nome_centro ";
		

		$result = $db->getResultQuery($query, $params);
		
		$listCentriRaccolta = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = new CentroRaccolta();
				$obj->idCentroRaccolta = $row['id_centro_raccolta'];
				$obj->nomeCentro = $row['nome_centro'];
				$obj->indirizzo = $row['indirizzo'];
				$obj->attivo = $row['attivo'];
				$obj->numPersone = $row['num_persone'];
				
				$listCentriRaccolta[$obj->idCentroRaccolta]=$obj;
			}
			
		}
		
		return $listCentriRaccolta; 
	}


	public function getCentroRaccolta(){
		$db = new DB();

		$query = "SELECT id_centro_raccolta, nome_centro, indirizzo, attivo, num_persone,codice_cc FROM centro_raccolta WHERE id_centro_raccolta=? ";

		$params = array($this->idCentroRaccolta);
	
		$result = $db->getResultQuery($query, $params);
		
		$listCentriRaccolta = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = new CentroRaccolta();
				$this->idCentroRaccolta = $row['id_centro_raccolta'];
				$this->nomeCentro = $row['nome_centro'];
				$this->indirizzo = $row['indirizzo'];
				$this->attivo = $row['attivo'];
				$this->numPersone = $row['num_persone'];
				$this->codiceCC = $row['codice_cc'];
				
				
				break;
			}
			
		}
		 
	}


	
	

	
	
}
?>