<?php
namespace model;

use util\DB, exception\DBException;

class Rifiuto{

	public  $idRifiuto;
	public  $idConsorzio;
	public  $descRifiuto;
	public  $max;
		
	public static function getListaRifiuti() {
		$db = new DB();

		$params = array();

		$query = 
			"select r.id_rifiuto,r.desc_rifiuto, r.id_consorzio, r.max, r. cer " .
			"from rifiuti r " .
			"where 1 = 1 ";
		
		$query .= "order by r.desc_rifiuto ";
		
		$result = $db->getResultQuery($query, $params);
		
		$listaRifiuti = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = self::caricaRifiuto($row);
				
				$listaRifiuti[$obj->idRifiuto]=$obj;
			}
		}
		
		return $listaRifiuti;
	}

	public static function getListaCodiciCer() {
		$db = new DB();

		$params = array();

		$query = 
			"select distinct cer " .
			"from rifiuti  " .
			"where cer is not null ".
			"order by cer ";
		
		$result = $db->getResultQuery($query, $params);
		
		$listaRifiuti = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = new Rifiuto();
				$obj->cer = $row['cer'];
				$listaRifiuti[$obj->cer]=$obj;
			}
		}
		
		return $listaRifiuti;
	}
	
	public static function caricaRifiutiFromCentroRaccolta($idCentroRaccolta,$idTipologiaUtente) {
		$db = new DB();

		$params = array($idCentroRaccolta,$idTipologiaUtente);

		$query = "select r.id_rifiuto,r.desc_rifiuto, r.id_consorzio, r.max, r.cer ".
		  		 "from rifiuti r  ".
				 "join rifiuto_centro_raccolta_tip_utente rcs on r.id_rifiuto=rcs.id_rifiuto and rcs.data_fine is null ".
				 "where rcs.id_centro_di_raccolta  = ? ".
				 "and rcs.id_tipologia_utente   = ? ".
		         "order by r.ordine, r.desc_rifiuto ";

		$result = $db->getResultQuery($query, $params);
		
		$listRifiuti = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = self::caricaRifiuto($row);
				
				$listRifiuti[$obj->idRifiuto]=$obj;
			}
		}
		
		return $listRifiuti;
	}

	public static function caricaAllRifiuti() {
		$db = new DB();

		$params = array();

		$query = "select r.id_rifiuto,r.desc_rifiuto, r.id_consorzio, r.max ".
				 "from rifiuti r ".
				 "order by r.desc_rifiuto ";

		$result = $db->getResultQuery($query, $params);
		
		$listRifiuti = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = self::caricaRifiuto($row);
				
				$listRifiuti[$obj->idRifiuto]=$obj;
			}
		}
		
		return $listRifiuti;
	}
	
	private static function caricaRifiuto($row) {
		$rifiuto = new Rifiuto();
		$rifiuto->idRifiuto = $row['id_rifiuto'];
		$rifiuto->descRifiuto = $row['desc_rifiuto'];
		$rifiuto->idConsorzio = $row['id_consorzio'];
		$rifiuto->max = $row['max'];
		$rifiuto->cer = $row['cer'];
		
		return $rifiuto;
	}
	
}
?>