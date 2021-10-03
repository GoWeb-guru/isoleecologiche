<?php
namespace model;

use util\DB, util\Dates, util\Numbers, exception\DBException, exception\DupkeyException;

class Giorno{

	public $idGiorno; 
	public $giorno;
	public $data;	
	public $idOrarioCentroRaccolta;
	public $descFasciaOraria;  
	
	public function loadGiorniPerPrenotazione($idCentroRaccolta){
		$db = new DB();

		

		$query = "SELECT distinct  g.giorno, g.id_giorno, giorni.date "
		."FROM orario_centro_raccolta oc "
		."	join giorno g on g.id_giorno=oc.id_giorno "
		."	join (select adddate( CURDATE() + interval ? DAY, @num:=@num+1) as date "
		."from ora, (select @num:=-1) num "
		.'limit 7) as giorni on DATE_FORMAT(giorni.date, "%w")=g.id_giorno '
		."WHERE oc.id_centro_raccolta=? "
		."and giorni.date not in (SELECT giornoFestivo FROM festivita) "
		."order by giorni.date  ";
		
		//fino alle 14 posso prenotare da domani, dopo le 14 da dopodomani
		$ora=date("G");
		if ($ora<14){
			$intervallo=1;
		} else {
			$intervallo=2;
		}

		$params = array($intervallo,$idCentroRaccolta);

		$result = $db->getResultQuery($query, $params);
		
		$listGiorni = array();

		if ($result) {
			foreach ($result as $key => $row) {
				$obj = new CentroRaccolta();
				$obj->idGiorno = $row['id_giorno'];
				$obj->data = Dates::formatDate($row['date']);
				$obj->giorno = $row['giorno'];
				
				$listGiorni[$obj->idGiorno]=$obj;
			}
			
		}
		
		return $listGiorni; 
	}

	
	public function getFasciaOraria($idCentroRaccolta,$idGiorno,$dataPrenotazione){
		$db = new DB();
	

		$query = "SELECT oc.id_orario_centro_raccolta,  CONCAT(o.ora, '.',  fo.inzio,'-',o.ora,'.',fo.fine ) as orario "
		."FROM orario_centro_raccolta oc "
		."	join ora o on o.id_ora=oc.id_ora "
		."	join fascia_oraria fo on fo.id_fascia_oraria=oc.id_fascia_oraria "
		."WHERE oc.id_centro_raccolta=? and oc.id_giorno=? "
		."and oc.num_persone> ( "
		."				select count(1) "
		."		from prenotazioni p "
		."		where p.id_orario_centro_raccolta=oc.id_orario_centro_raccolta "
		."		and p.data_prenotazione=STR_TO_DATE(?, '%d/%m/%Y') "
		."	  ) "
		."order by oc.ordinamento "
		."limit 1  ";
		
		

		$params = array($idCentroRaccolta,$idGiorno,$dataPrenotazione);

		$result = $db->getResultQuery($query, $params);

		if ($result) {
			foreach ($result as $key => $row) {
				$this->idOrarioCentroRaccolta=$row['id_orario_centro_raccolta'];
				$this->descFasciaOraria=$row['orario'];
			break;
			}
		}
	}
	
	
}
?>