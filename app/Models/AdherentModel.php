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
}
