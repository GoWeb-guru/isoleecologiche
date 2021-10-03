<?php
namespace model;

use util\DB, exception\DBException;

class Sede{

    public  $idSede; 
	public  $idComune; 
	public  $descComune;
	public  $indirizzo;
	public  $note;
	
	public static function caricaSedi($idAzienda, $principale = 0){
		$db = new DB();

		$params = array($idAzienda, $principale);

		$query = "SELECT s.id_sede, s.id_comune, s.indirizzo, s.note, c.nome_comune ".
		         "FROM sedi s ".
				 "join comuni c on c.id_comune=s.id_comune ".
				 "WHERE id_azienda=? ".
				 "and sede_principale=? ";

		$result = $db->getResultQuery($query, $params);
		
		$listSedi = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$sede = new Sede();
				$sede->idSede = $row['id_sede'];
				$sede->idComune = $row['id_comune'];
				$sede->descComune = $row['nome_comune'];
				$sede->indirizzo = $row['indirizzo'];
				$sede->note = $row['note'];
				$listSedi[$sede->idSede]=$sede;
			}
			
		}
		
		return $listSedi; 
	}
	
	public function inserisciSede($idAzienda, $sedePrincipale) {
		$db = new DB();
		return $this->inserisciSedeWithAzienda($db, $idAzienda, $sedePrincipale);
	}
	
	public function inserisciSedeWithAzienda(&$db, $idAzienda, $sedePrincipale) {
		
	    $params = array($idAzienda, $sedePrincipale, $this->idComune, $this->indirizzo, $this->note);
		
		$query = "INSERT INTO sedi(id_azienda, sede_principale, id_comune, indirizzo, note) ".
				  "		VALUES (?,?,?,?,?) ";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nell'inserimento della sede");
		}
		
		$idSede = $db->getLastInsertId();
	}
	
	
	public function modificaSede() {
		$db = new DB();
	
	    $params = array($this->idComune, $this->indirizzo, $this->note, $this->idSede);
		
		$query = "UPDATE sedi ".
				 "SET id_comune=?, indirizzo=?, note=? ".
				 "WHERE id_sede = ?";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nella modifica della sede");
		}
	}

	public function deleteSedi(&$db,$idAzienda) {

	    $params = array($idAzienda);
		
		$query = "DELETE from sedi ".
				 "WHERE id_azienda = ?";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nella cancellazione della sedi");
		}
	}

	public static function getSedePrincipale($idAzienda) {
		$listSedi = self::caricaSedi($idAzienda, 1);
		
		if (count($listSedi) > 0) {
			return array_values($listSedi)[0];
		}
		
		return new Sede();
	}
	
	public function getSedeByIdSede($db, $idAzienda, $idSede){

		$params = array($idAzienda, $idSede);

		$query = "SELECT s.id_sede, s.id_comune, s.indirizzo, s.note, c.nome_comune ".
		         "FROM sedi s ".
				 "join comuni c on c.id_comune=s.id_comune ".
				 "WHERE id_azienda=? ".
				 "and s.id_sede=? ";

		$result = $db->getResultQuery($query, $params);
		
		if ($result) {
			foreach ($result as $key => $row) {
				$this->idSede = $row['id_sede'];
				$this->idComune = $row['id_comune'];
				$this->descComune = $row['nome_comune'];
				$this->indirizzo = $row['indirizzo'];
				$this->note = $row['note'];
				break;
			}
		}
	}
	
	public function deleteSede($idSede, $idAzienda) {
		$db = new DB();
			
	    $params = array($idSede, $idAzienda);
		
		$query = "DELETE FROM sedi ".
				 "WHERE id_sede=? ".
				 "  and  id_azienda = ? ";
			
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nella cancellazione della Sede");
		}
	}
}
?>