<?php
namespace model;

use util\DB, exception\DBException;

class Stato {

	public  $idStato;
	public  $descStato;

	public static function getListaStatiConsorzio(){
		$db = new DB();

		$query = "SELECT id_stato, desc_stato " . 
			"FROM stato " .
			"ORDER BY id_stato ";

		$result = $db->getResultQuery($query, array());
		
		$listaStati = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = new Stato();
				$obj->idStato = $row['id_stato'];
				$obj->descStato = $row['desc_stato'];
				
				$listaStati[$obj->idStato]=$obj;
			}
		}
		
		return $listaStati;
	}
}
?>