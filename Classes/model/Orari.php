<?php
namespace model;

use util\DB, util\Dates, util\Numbers, exception\DBException, exception\DupkeyException;

class Orari{

	public  $idOrarioCentroRaccolta; 
	public  $idCentroRaccolta;
	public  $idFasciaOraria;	
	public  $idGiorno;
	public  $giorno;
	public  $numPersone;
	public  $ordinamento;
	public  $inizio;
	public  $fine;
	public  $numFascia15;
	
	public function loadNumPersone($id){
		$db = new DB();

		$query = "SELECT num_persone FROM centro_raccolta WHERE id_centro_raccolta = ?";
		$params = array($id);
		$result = $db->getResultQuery($query, $params);
		$numPersone = $result[0]['num_persone'];
		return $numPersone;
	}

	public function loadOrari($id){
		$db = new DB();

		$query = "SELECT o.*, giorno.giorno
					FROM orario_centro_raccolta as o
						join giorno on o.id_giorno = giorno.id_giorno
					WHERE o.id_centro_raccolta = ?";
		$query .="order by id_fascia_oraria ";		
		$params = array($id);
		$result = $db->getResultQuery($query, $params);
		
		$lista = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = new Orari();
				$obj->idOrarioCentroRaccolta = $row['id_orario_centro_raccolta'];
				$obj->idCentroRaccolta = $row['id_centro_raccolta'];
				$obj->idFasciaOraria = $row['id_fascia_oraria'];
				$obj->idGiorno = $row['id_giorno'];
				$obj->giorno = strtolower(substr($row['giorno'],0,3));
				$obj->numPersone = $row['num_persone'];
				$obj->ordinamento = $row['ordinamento'];
				$obj->inizio = ($row['inizio'] == '00:00:00' ? '':$row['inizio']);
				$obj->fine = ($row['fine'] == '00:00:00' ? '':$row['fine']);
				$obj->numFascia15 = $row['num_fascia15'];
				
				$lista[$obj->idOrarioCentroRaccolta]=$obj;
			}
		}
		return $lista; 
	}


	public function salvaOrari($post){
		$db = new DB();
		$settimana = array(
			"0" => "dom",
			"1" => "lun",
			"2" => "mar",
			"3" => "mer",
			"4" => "gio",
			"5" => "ven",
			"6" => "sab",
		);

		foreach ($settimana as $idGiorno => $giorno) {
			for ($i = 1; $i <= 4; $i++) {
				if($post[$giorno.$i]){ //record esistente
					$inizio = strtotime('2007-09-01 '.$post[$giorno.'I'.$i]);
					$fine = strtotime('2007-09-01 '.$post[$giorno.'F'.$i]);
					$num_fascia15 = (abs($inizio - $fine) / 60) / 15;
					$params = array($post['centroRaccolta'], $i, $idGiorno, $post[$giorno.'Persone'.$i], $post[$giorno.'Antpost'.$i], $post[$giorno.'I'.$i], $post[$giorno.'F'.$i], $num_fascia15, $post[$giorno.$i]);
					$query = "UPDATE orario_centro_raccolta ".
							"SET id_centro_raccolta=?, id_fascia_oraria=?, id_giorno=?, num_persone=?, ordinamento=?, inizio=?, fine=?, num_fascia15=? ".
							"WHERE id_orario_centro_raccolta=?";
					if (!$db->executeQuery($query, $params)) {
						throw new DBException("Errore nella modifica orari");
						return false;
					}
				}
				else{ //nuovo inserimento
					
					if(($post[$giorno.'I'.$i]) and ($post[$giorno.'F'.$i])){ //inserisco solo se inizio fine compilate
						$inizio = strtotime('2007-09-01 '.$post[$giorno.'I'.$i]);
						$fine = strtotime('2007-09-01 '.$post[$giorno.'F'.$i]);
						$num_fascia15 = (abs($inizio - $fine) / 60) / 15;
						$params = array($post['centroRaccolta'], $i, $idGiorno, $post[$giorno.'Persone'.$i], $post[$giorno.'Antpost'.$i], $post[$giorno.'I'.$i], $post[$giorno.'F'.$i], $num_fascia15);
						$query = "INSERT INTO orario_centro_raccolta(id_centro_raccolta, id_fascia_oraria, id_giorno, num_persone, ordinamento, inizio, fine, num_fascia15) ".
						"		VALUES (?,?,?,?,?,?,?,?) ";
						if (!$db->executeQuery($query, $params)) {
							throw new DBException("Errore nella modifica orari");
							return false;
						}
					}
				}
			}
		}
		return true;
	}
	

}
?>