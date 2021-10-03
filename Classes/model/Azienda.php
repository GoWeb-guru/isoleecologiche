<?php
namespace model;

use util\DB, model\Sede, util\Numbers, exception\DBException, exception\DupkeyException;

class Azienda{

	public  $idUser;
	public  $idAzienda;
	public  $denominazione; 
	public  $partitaIVA;
	public  $codiceFiscale;
	public  $telefono;
	public  $email;
	public  $idTipologiaUtente;
	public  $targa;
	public  $idIntermediario;
	public  $descTipologiaUtente;
	public  $sedePrincipale;
	public  $sedi;


	public static function caricaAziendeByUser($idUser){
		$db = new DB();

		$params = array($idUser);

		$query = "SELECT a.id_azienda, a.partita_iva, a.codice_fiscale, a.denominazione, a.telefono, a.id_tipologia_utente, tu.desc_tipologia_utente, u.email, a.targa  ".
				 "FROM azienda a ".
				 "LEFT JOIN tipologia_utente tu on a.id_tipologia_utente=tu.id_tipologia_utente ".
				 "left JOIN users u on a.id_users=u.id ".
				 "where u.id=? ";

		$result = $db->getResultQuery($query, $params);
		
		$listaAziende = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$azienda = new Azienda();
				$azienda->idAzienda = $row['id_azienda'];
				$azienda->partitaIVA = $row['partita_iva'];
				$azienda->codiceFiscale = $row['codice_fiscale'];
				$azienda->denominazione = $row['denominazione'];
				$azienda->telefono = $row['telefono'];
				$azienda->idTipologiaUtente = $row['id_tipologia_utente'];
				$azienda->targa = $row['targa'];
				$azienda->descTipologiaUtente = $row['desc_tipologia_utente'];
				$azienda->email = $row['email'];

				$azienda->sedePrincipale = Sede::getSedePrincipale($azienda->idAzienda);
				$azienda->sedi = Sede::caricaSedi($azienda->idAzienda);


				$listaAziende[$azienda->idAzienda] = $azienda;
			}
			
		}
		return $listaAziende; 
	}
	
	public function caricaAzienda($idUser){
		$db = new DB();

		$params = array($idUser);

		$query = "SELECT a.id_azienda, a.partita_iva, a.codice_fiscale, a.denominazione, a.telefono, a.id_tipologia_utente, u.email, a.targa ".
				 "FROM azienda a ".
				 "JOIN users u on u.id=a.id_users ".
				 "where u.id=? ";

		$result = $db->getResultQuery($query, $params);
		

		if ($result) {
			foreach ($result as $key => $row) {
				$this->idAzienda = $row['id_azienda'];
				$this->partitaIVA = $row['partita_iva'];
				$this->codiceFiscale = $row['codice_fiscale'];
				$this->denominazione = $row['denominazione'];
				$this->telefono = $row['telefono'];
				$this->email = $row['email'];
				$this->idTipologiaUtente = $row['id_tipologia_utente'];
				$this->targa = $row['targa'];
				break;
			}
			
		}
		$this->sedePrincipale = Sede::getSedePrincipale($this->idAzienda);
		$this->sedi = Sede::caricaSedi($this->idAzienda);
	}

	public function caricaAziendaByIdAzienda($idAzienda){
		$db = new DB();

		$params = array($idAzienda);

		$query = "SELECT a.id_azienda, a.partita_iva, a.codice_fiscale, a.denominazione, a.telefono, u.email, a.id_tipologia_utente ".
				 "FROM azienda a ".
				 "LEFT JOIN users u on u.id=a.id_users ".
				 "where a.id_azienda=? ";

		$result = $db->getResultQuery($query, $params);		

		if ($result) {
			foreach ($result as $key => $row) {
				$this->idAzienda = $row['id_azienda'];
				$this->partitaIVA = $row['partita_iva'];
				$this->codiceFiscale = $row['codice_fiscale'];
				$this->denominazione = $row['denominazione'];
				$this->telefono = $row['telefono'];
				$this->email = $row['email'];
				$this->idTipologiaUtente = $row['id_tipologia_utente'];
				break;

				
			}
			
		}
		$this->sedePrincipale = Sede::getSedePrincipale($this->idAzienda);
		$this->sedi = Sede::caricaSedi($this->idAzienda);
	}

	public function caricaAziendaById(){
		$db = new DB();

		$params = array($this->idAzienda);

		$query = "SELECT a.id_azienda, a.partita_iva, a.codice_fiscale, a.denominazione, a.telefono, a.id_tipologia_utente, tu.desc_tipologia_utente, u.email, a.targa  ".
				 "FROM azienda a ".
				 "LEFT JOIN tipologia_utente tu on a.id_tipologia_utente=tu.id_tipologia_utente ".
				 "left JOIN users u on a.id_users=u.id ".
				 "where a.id_azienda=? ";

		$result = $db->getResultQuery($query, $params);
		

		if ($result) {
			foreach ($result as $key => $row) {
				$this->idAzienda = $row['id_azienda'];
				$this->partitaIVA = $row['partita_iva'];
				$this->codiceFiscale = $row['codice_fiscale'];
				$this->denominazione = $row['denominazione'];
				$this->telefono = $row['telefono'];
				$this->idTipologiaUtente = $row['id_tipologia_utente'];
				$this->descTipologiaUtente = $row['desc_tipologia_utente'];
				$this->email = $row['email'];
				$this->targa = $row['targa'];
				break;
			}
			
		}
		$this->sedePrincipale = Sede::getSedePrincipale($this->idAzienda);
		$this->sedi = Sede::caricaSedi($this->idAzienda);
	}
	
	public function inserisciComuneAzienda() {
		$this->inserisciAzienda();
	}
	
	public function inserisciAzienda() {

		$db = new DB();

		$db->startTransaction();
		
	    $params = array($this->partitaIVA, $this->codiceFiscale, $this->denominazione, $this->telefono, $this->idUser, $this->idTipologiaUtente, $this->targa, $this->idIntermediario);
		
		$query = "INSERT INTO azienda(partita_iva, codice_fiscale, denominazione, telefono, id_users, id_tipologia_utente, targa, id_intermediario) ".
				  "		VALUES (?,UPPER(?),?,?,?, ?, ?, ?) ";
  
		
		try {
			if (!$db->executeQuery($query, $params)) {
				throw new DBException("Errore nell'inserimento dell'utente");
			}
		}catch (DupkeyException $d){
			if ($this->idTipologiaUtente==2)
			    throw new DBException("L'utente con Codice Fiscale {$this->codiceFiscale} risulta essere già stata registrato");
			else
				throw new DBException("L'azienda con Partita IVA {$this->partitaIVA} risulta essere già stata registrata");
		}

		
		$idAzienda = $db->getLastInsertId();
		
		$this->sedePrincipale->inserisciSedeWithAzienda($db, $idAzienda, 1);

		$this->idAzienda=$idAzienda; 
		
		$db->commit();
		
		/*
		if (count($this->sedi) > 0) {
			foreach ($this->sedi as $key => $row) {
				return $row->inserisciSede($idAzienda, 0);
			}
		}*/
	}

	/*
	 *	Verifica se esiste già un azienda registrata conla partita iva o il codcie fiscale passato 
	 	Restitusice 
		0: non è stato trovato nulla, si può proseguire con l'inserimento
		-1: non si può  proseguire perchè esiste già un'azienda collegata ad un'utenza
		altri valori: è stata trovata un'azienda, ma non è associata a nessun utente, si può  proseguire ma bisogna fare un update e non una insert

	 */
	public function checkAziendaExist(){
		$db = new DB();

		$params = array($this->codiceFiscale, $this->partitaIVA);



		$query = 
			"SELECT id_azienda, id_users  " .
			"FROM azienda " . 
			"WHERE UPPER(codice_fiscale) = UPPER(?) or partita_iva = ? ";


		$result = $db->getResultQuery($query, $params);

		if ($result) {
			foreach ($result as $key => $row) {
				if (empty($row['id_users']))
					return $row['id_azienda'];
				else return -1;	
			}
		}
		return 0;
	}
	
	
	public function modificaAzienda() {
		$db = new DB();
	
	    $params = array($this->partitaIVA, $this->codiceFiscale, $this->denominazione, $this->telefono, $this->targa, $this->idAzienda);
		
		$query = "UPDATE azienda ".
				 "SET partita_iva=?, codice_fiscale=UPPER(?), denominazione=?, telefono=?, targa=? ".
				 "WHERE id_azienda=?";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nella modifica dell'Azienda");
		}
	}

	public function modificaAziendaConsorzio() {
		$db = new DB();


		//Devo farlo onde evitare il dupkey
		if ($this->partitaIVA ==''){
			$this->partitaIVA=null;
		}

		if ($this->codiceFiscale ==''){
			$this->codiceFiscale=null;
		}
		
	    $params = array($this->partitaIVA, $this->codiceFiscale, $this->denominazione, $this->telefono,  $this->idTipologiaUtente, $this->idAzienda);
		
		$query = "UPDATE azienda ".
				 "SET partita_iva=?, codice_fiscale=UPPER(?), denominazione=?, telefono=?, id_tipologia_utente=? ".
				 "WHERE id_azienda=?";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nella modifica dell'Azienda");
		}
	}

	public function insertModificaAzienda() {
		$db = new DB();


		//Devo farlo onde evitare il dupkey
		if ($this->partitaIVA ==''){
			$this->partitaIVA=null;
		}

		if ($this->codiceFiscale ==''){
			$this->codiceFiscale=null;
		}
		
	    $params = array($this->partitaIVA, $this->codiceFiscale, $this->denominazione, $this->telefono,  $this->idTipologiaUtente, $this->idUser, $this->targa, $this->idAzienda);
		
		$query = "UPDATE azienda ".
				 "SET partita_iva=?, codice_fiscale=UPPER(?), denominazione=?, telefono=?, id_tipologia_utente=?, id_users=?, targa=? ".
				 "WHERE id_azienda=?";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore nella modifica dell'Azienda");
		}

		//cancello le eventuali sedi precedenti
		$this->sedePrincipale->deleteSedi($db,$this->idAzienda);

		//inserisco la nuova sede
		$this->sedePrincipale->inserisciSedeWithAzienda($db, $this->idAzienda, 1);

		$db->commit();
	}

	public function inserisciTargaAzienda() {
		$db = new DB();
	
	    $params = array($this->targa, $this->idAzienda);
		
		$query = "UPDATE azienda ".
				 "SET targa=? ".
				 "WHERE id_azienda=?";
		
		if (!$db->executeQuery($query, $params)) {
			throw new DBException("Errore in inserisciTargaAzienda");
		}
	}
	
	public function duplicaAzienda() {
		$aziendaDup = new Azienda();
		
		$aziendaDup->idUser=$this->idUser;
		$aziendaDup->idAzienda=$this->idAzienda;
		$aziendaDup->denominazione=$this->denominazione;
		$aziendaDup->partitaIVA=$this->partitaIVA;
		$aziendaDup->codiceFiscale=$this->codiceFiscale;
		$aziendaDup->targa=$this->targa;
		$aziendaDup->telefono=$this->telefono;
		$aziendaDup->idTipologiaUtente=$this->idTipologiaUtente;
		$aziendaDup->email=$this->email;
		$aziendaDup->sedePrincipale=$this->sedePrincipale;
		$aziendaDup->sedi=$this->sedi;
		
		return $aziendaDup;
	}
	
	/*
	 *	Ricerca una lista di aziende il cui codice fiscale contenga la stringa in input 
	 */
	public static function getListaAziendeByCodiceFiscaleLike($cfPortion){
		$db = new DB();

		$params = array("%" . strtoupper($cfPortion) . "%");

		$query = 
			"SELECT id_azienda, codice_fiscale, denominazione " .
			"FROM azienda " . 
			"WHERE UPPER(codice_fiscale) LIKE ? " . 
			"ORDER BY UPPER(codice_fiscale)";

		$result = $db->getResultQuery($query, $params);
		
		$listaAziende = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$azienda = new Azienda();
				$azienda->idAzienda = $row['id_azienda'];
				$azienda->codiceFiscale = $row['codice_fiscale'];
				$azienda->denominazione = $row['denominazione'];
				
				$listaAziende[$azienda->idAzienda] = $azienda;
			}
		}
		
		return $listaAziende;
	}
	
	
	public function ricercaAziende($filtri = array()) {
		$db = new DB();

		$params = array();
		
		$query = 
			"SELECT a.id_users, a.id_azienda, a.partita_iva, a.codice_fiscale, a.denominazione, a.telefono, a.id_tipologia_utente, u.email, tu.desc_tipologia_utente, a.targa ".
			"FROM azienda a ".
			"left JOIN users u on u.id=a.id_users ".
			"JOIN tipologia_utente tu on tu.id_tipologia_utente=a.id_tipologia_utente ".
			"WHERE 1 = 1 ";	
		
		
		if (isset($filtri['denominazione'])) {
			$query .= "AND UPPER(a.denominazione) LIKE ? ";
			$params[] = '%' . strtoupper($filtri['denominazione']) . '%';
		}
		
		if (isset($filtri['codiceFiscale'])) {
			$query .= "AND UPPER(a.codice_fiscale) LIKE ? ";
			$params[] = '%' . strtoupper($filtri['codiceFiscale']) . '%';
		}

		if (isset($filtri['partitaIVA'])) {
			$query .= "AND UPPER(a.partita_iva) LIKE ? ";
			$params[] = '%' . strtoupper($filtri['partitaIVA']) . '%';
		}

		if (isset($filtri['contoTerziIdintermediario'])) {
			$query .= "AND (a.id_intermediario = ? or u.id = ? ) ";
			$params[] = $filtri['contoTerziIdintermediario'];
			$params[] = $filtri['contoTerziIdintermediario'];
		}
		
		$query .= "order by a.denominazione ";
		$query .= "limit ".MAX_RIGHE_AZIENDE;

		$result = $db->getResultQuery($query, $params);
		
		$listaAziende = array();

		if ($result) {
			
			foreach ($result as $key => $row) {
				$azienda = new Azienda();
				$azienda->idAzienda = $row['id_azienda'];
				$azienda->idUser = $row['id_users'];
				$azienda->partitaIVA = $row['partita_iva'];
				$azienda->codiceFiscale = $row['codice_fiscale'];
				$azienda->idTipologiaUtente = $row['id_tipologia_utente'];
				$azienda->descTipologiaUtente = $row['desc_tipologia_utente'];
				$azienda->denominazione = $row['denominazione'];
				$azienda->telefono = $row['telefono'];
				$azienda->email = $row['email'];
				$azienda->targa = $row['targa'];
				$listaAziende[$azienda->idAzienda] = $azienda;
			}
			
			
		}
		
		return $listaAziende; 
	}
	
}
?>