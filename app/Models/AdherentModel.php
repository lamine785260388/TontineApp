<?php 
namespace App\Models;
use CodeIgniter\Model;
class AdherentModel extends Model{
	protected $table="adherent";
	protected $allowedFields=["nom","prenom","login","motPasse","profil"];
	function participer($idtontine){
		return 	$this->join("participer as p","p.idAdherant=adherent.id")
		->join("tontine as t","t.id=p.idTontine")
		->where("t.id",$idtontine)
		->findAll();
}
function cotiser($idtontine){
	$cotis=$this->selectCount('adherent.id',"nbCotis")
	            ->select('adherent.id')
				->join("cotiser as c","c.idAdherant=adherent.id")
				->join("echeance as e","e.id=c.idEcheance")
				->where("e.idTontine",$idtontine)
				->groupBy('adherent.id')
				->get()->getResultArray();
				$cotisations=[];
				foreach($cotis as $coti)
				$cotisations[$coti["id"]]=$coti["nbCotis"];
				return $cotisations;


}
}
