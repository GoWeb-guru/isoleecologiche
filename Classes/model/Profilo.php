<?php
namespace model;

use util\DB, exception\DBException;

class Profilo{

	public  $idUser;
	public  $denominazione; 
	public  $identificativo; 
	public  $email;
	public  $idCentroRaccolta;
	public  $nomeCentroRaccolta;
 	public  $idConsorzio;
	public  $idComune;
	public  $areaEcologica;
	
	public function caricaProfilo($idUser){
		$db = new DB();
		
		$params = array($idUser);

		$query = "SELECT id_consorzio, id_comune, id_centro_raccolta ".
				 "FROM users ".
				 "WHERE id = ? ";

		$result = $db->getResultQuery($query, $params);


		$this->idUser=$idUser;
		
		if ($result) {

			$row = reset($result);
			
			if ($row) {
				if (!empty($row['id_comune'])) {
					$this->idComune = $row['id_comune'];
				}elseif (!empty($row['id_centro_raccolta'])) {
					$this->idCentroRaccolta = $row['id_centro_raccolta'];
				}else {
					$this->idConsorzio = $row['id_consorzio'];
				}
			}
			
		}

		
		if (isset($this->idComune) && !empty($this->idComune))
		{			
			$params = array($this->idComune);
			
			$query = "SELECT nome_comune as denominazione, mail_comune as email ".
					 "FROM comuni ".
					 "WHERE id_comune = ? ";	 
		}
		if (isset($this->idCentroRaccolta) && !empty($this->idCentroRaccolta))
		{			

			$params = array($this->idUser);
			
			$query = "SELECT email, denominazione,  coalesce(a.partita_iva, a.codice_fiscale) as identificativo ".
				 "FROM users ".
				 "join azienda a on a.id_users=id ".
				 "WHERE id = ? "; 
		}
		if (isset($this->idConsorzio) && !empty($this->idConsorzio))
		{			
			$params = array($this->idConsorzio);
			
			$query = "SELECT nome_consorzio as denominazione, mail_consorzio as email ".
					 "FROM consorzio ".
					 "WHERE id_consorzio = ? ";	 
		}
		

		
		$result = $db->getResultQuery($query, $params);
		
		if ($result) {

			foreach ($result as $key => $row) {
				$this->denominazione = $row['denominazione'];
				$this->email = $row['email'];
				$this->identificativo = $row['identificativo'];
				break;
			}
			
		}
	}


	public function caricaProfiloAreaEcologica($idUser){
		$db = new DB();
		
		$this->idUser=$idUser;
		

		$params = array($this->idUser);
		
		$query = "SELECT email, denominazione,  coalesce(a.partita_iva, a.codice_fiscale) as identificativo ".
				"FROM users ".
				"join azienda a on a.id_users=id ".
				"WHERE id = ? "; 


		

		
		$result = $db->getResultQuery($query, $params);
		
		if ($result) {

			foreach ($result as $key => $row) {
				$this->denominazione = $row['denominazione'];
				$this->email = $row['email'];
				$this->identificativo = $row['identificativo'];
				$this->areaEcologica = true;
				break;
			}
			
		}
	}


	public function caricaProfiloForComune($idUser){
		$db = new DB();
		
		$params = array($idUser);
		
		$query = "SELECT email, denominazione,  coalesce(a.partita_iva, a.codice_fiscale) as identificativo ".
				 "FROM users ".
				 "join azienda a on a.id_users=id ".
				 "WHERE id = ? ";

		
		$result = $db->getResultQuery($query, $params);
		
		if ($result) {
			foreach ($result as $key => $row) {
				$this->idUser = $idUser;
				$this->denominazione = $row['denominazione'];
				$this->identificativo = $row['identificativo'];
				$this->email = $row['email'];

				break;
			}
			
		}

	}


	public static function abilitaIntermediario($idUser){
		$db = new DB();
	
		$params = array($idUser);

		$query = "UPDATE users_groups ".
				 "SET group_id=2 ".
				 "WHERE user_id=? ";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nell'abilitazione dell'intermediario'");
		}
	}
	
}
?>