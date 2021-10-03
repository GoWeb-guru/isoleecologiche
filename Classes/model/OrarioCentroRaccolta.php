<?php
namespace model;

use util\DB, util\Dates, util\Numbers, exception\DBException, exception\DupkeyException;

class OrarioCentroRaccolta{

	public $idGiorno; 
	public $giorno;
	public $data;	
	public $idOrarioCentroRaccolta;
	public $descFasciaOraria;  
	public $inizio;
	public $fine;
	public $fascia15;
	public $ordinamento;
	public $disp;
	public $numFascia15;
	
	

	/*
	TO per le aziende permettere 2 prenotazioni al giorno, per gli utenti 1
	*/
	public function loadGiorniPerPrenotazione($idCentroRaccolta,$idAzienda,$idTipologiaUtente){
		$db = new DB();

		/*
		la join con tabella users. mi serve solo per andare ad estrarre 7 record (limit 7) relativi ai giorni della settimana
		potevo mettere qualsiasi altra tabella in join, l'unico vincolo è che abbia almeno 7 record
		*/
		$query = "SELECT distinct  g.giorno, g.id_giorno, giorni.date, "
		."(select count(1) FROM prenotazioni WHERE id_azienda_storico=? and data_prenotazione=giorni.date) as num_pren "
		."FROM orario_centro_raccolta oc "
		."	join giorno g on g.id_giorno=oc.id_giorno "
		."	join (select adddate( CURDATE() + interval ? DAY, @num:=@num+1) as date "
		."from users, (select @num:=-1) num "
		.'limit 31) as giorni on DATE_FORMAT(giorni.date, "%w")=g.id_giorno '
		."WHERE oc.id_centro_raccolta=? "
		."and giorni.date not in (SELECT giornoFestivo FROM festivita) "
		."and num_persone>0 "
		."order by giorni.date  ";
		

		$intervallo=0;
		
		

		

		if ($idTipologiaUtente==1){
			//l'azienda può richiedere 2 prenotazioni al giorno
			$max_prenotazioni=5;
		} else {
			//l'utenza domestica può richiedere uan sola prenotazione al giorno
			$max_prenotazioni=5;
		}

		$params = array($idAzienda,$intervallo,$idCentroRaccolta);

		$result = $db->getResultQuery($query, $params);
		
		$listGiorni = array();

		if ($result) {
			$i = 0;

			foreach ($result as $key => $row) {

				if ($row['num_pren']<$max_prenotazioni){
					$i++;
					$obj = new CentroRaccolta();
					$obj->idGiorno = $row['id_giorno'];
					$obj->data = Dates::formatDate($row['date']);
					$obj->giorno = $row['giorno'];
					
					$listGiorni[$i]=$obj;
				}
			}
			
		}
		return $listGiorni; 
	}
	
	public function getFasciaOraria($idCentroRaccolta,$idGiorno,$dataPrenotazione){
		$db = new DB();
	
		$query = "SELECT COALESCE(p.fascia15,  "
		."CASE "
		."WHEN o.ordinamento ='A' THEN o.num_fascia15 "
		."ELSE 1 "
		."END) as fascia15, o.id_orario_centro_raccolta, o.id_fascia_oraria, o.num_fascia15, o.num_persone, "
		."(o.num_persone - count(p.fascia15)) disp, o.inizio, o.fine, o.ordinamento "
		."from orario_centro_raccolta as o "
		."left join prenotazioni as p  on o.id_orario_centro_raccolta = p.id_orario_centro_raccolta "
		."and p.data_prenotazione=STR_TO_DATE(?, '%d/%m/%Y')  "
		."WHERE o.id_centro_raccolta = ? and o.id_giorno=? "
		."group by o.id_fascia_oraria, p.fascia15 "
		."order by o.id_fascia_oraria,  disp desc ";
		

		$params = array($dataPrenotazione,$idCentroRaccolta,$idGiorno);

		$result = $db->getResultQuery($query, $params);

		$listOrarioCentroRaccolta = array();
		$listOrarioCentroRaccoltaNew = array();
		$listIdOrarioCentroRaccoltaDelete = array();

		if ($result) {
			$count=0;
			foreach ($result as $key => $row) {
				$obj = new OrarioCentroRaccolta();
				$obj->idOrarioCentroRaccolta = $row['id_orario_centro_raccolta'];
				$obj->inizio = strtotime($row['inizio']);
				$obj->fine = strtotime($row['fine']);
				$obj->fascia15 = $row['fascia15'];
				$obj->numFascia15=$row['num_fascia15'];
				$obj->disp=$row['disp'];
				$obj->ordinamento = $row['ordinamento'];
				$listOrarioCentroRaccolta[$count++]=$obj;


				if ($obj->disp==0 && (($obj->ordinamento=='P' && $obj->fascia15==$obj->numFascia15 ) || ($obj->ordinamento=='A' && $obj->fascia15==1))){
					$listIdOrarioCentroRaccoltaDelete[$obj->idOrarioCentroRaccolta]=$obj->idOrarioCentroRaccolta;
				}
			}

			foreach ($listOrarioCentroRaccolta as $key => $row) {
				if ($listIdOrarioCentroRaccoltaDelete[$row->idOrarioCentroRaccolta]!=$row->idOrarioCentroRaccolta){
					$listOrarioCentroRaccoltaNew[$row->idOrarioCentroRaccolta]= $row;
				}
			}

			
			
			foreach ($listOrarioCentroRaccoltaNew as $key => $row) {

				//Se disp  è 0 devo verificare il motivo
				//- devo cambiare fascia, quindi devon considerare il record
				//- e' gia' cambiata la fascia per questo record, quidi ho gia' trovato un record con lo stesso idOrarioCentroRaccolta

				$changeFascia=false;
				if ($row->disp==0){
						$changeFascia=true;
				}

				if ($changeFascia){
					if ($row->ordinamento=='A'){
						$row->fascia15--;
					} else {
						$row->fascia15++;
					} 
				}	
				$row->descFasciaOraria= date("G:i",($row->inizio + (15*60* ($row->fascia15-1) ))).'-'.date("G:i",($row->inizio + (15*60* ($row->fascia15) )));	
			}
		}
		
		return $listOrarioCentroRaccoltaNew; 
	}
	
	
	
	
	public function getFascieOccupate($idCentroRaccolta,$idGiorno,$dataPrenotazione){
		$db = new DB();
	
		$query = "SELECT o.id_orario_centro_raccolta, o.num_persone, o.num_fascia15, p.fascia15, (o.num_persone - count(p.fascia15)) disp, o.inizio, o.fine "
		."from  orario_centro_raccolta as o "
        ."left join prenotazioni as p on p.id_orario_centro_raccolta = o.id_orario_centro_raccolta and p.data_prenotazione=STR_TO_DATE(?, '%d/%m/%Y') "
        ."WHERE o.id_centro_raccolta = ? and o.id_giorno=? "
        ."GROUP by o.id_orario_centro_raccolta, p.fascia15 "
		."order by o.id_orario_centro_raccolta, p.fascia15 asc";
		
		$params = array($dataPrenotazione, $idCentroRaccolta, $idGiorno);
		//echo print_r($params);
		$result = $db->getResultQuery($query, $params);
		//echo print_r($query);
		$listOrarioCentroRaccolta = array();
		if ($result) {
			$count=0;
			foreach ($result as $key => $row) {
				
					$obj = new OrarioCentroRaccolta();
					$obj->idOrarioCentroRaccolta = $row['id_orario_centro_raccolta'];
					$obj->inizio = strtotime($row['inizio']);
					$obj->fine = strtotime($row['fine']);
					$obj->fascia15 = $row['fascia15'];
					$obj->numFascia15=$row['num_fascia15'];
					$obj->disp=$row['disp'];
					//$obj->ordinamento = $row['ordinamento'];
					$listOrarioCentroRaccolta[$row['id_orario_centro_raccolta'].'!'.$row['fascia15']]=$obj;
				
			}
		}
		return $listOrarioCentroRaccolta;
	} //chiusura getFascieOccupate
	
}
?>