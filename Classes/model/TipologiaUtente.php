<?php
namespace model;

use util\DB, util\Dates, util\Numbers, exception\DBException, exception\DupkeyException;

class TipologiaUtente{

	public  $idTipologiaUtente; 
	public  $descTipologiaUtente;
	
	
	public function loadTipologiaUtente(){
		$db = new DB();

		$query = "SELECT id_tipologia_utente,desc_tipologia_utente FROM tipologia_utente order by desc_tipologia_utente ";

		$params = array();		

		$result = $db->getResultQuery($query, $params);
		
		$listTipologiaUtente = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = new TipologiaUtente();
				$obj->idTipologiaUtente = $row['id_tipologia_utente'];
				$obj->descTipologiaUtente = $row['desc_tipologia_utente'];
	
				
				$listTipologiaUtente[$obj->idTipologiaUtente]=$obj;
			}
			
		}
		
		return $listTipologiaUtente; 
	}


}
?>