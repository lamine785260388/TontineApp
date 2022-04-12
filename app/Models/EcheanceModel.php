<?php 
namespace App\Models;
use CodeIgniter\Model;
class EcheanceModel extends Model{
	protected $table="echeance";
	protected $allowedFields=["idTontine","date","numero"];
    function generer($tabEcheance){
        return $this->insertBatch($tabEcheance);
    }
   function echeancesTontine($idtontine){
       return $this->where('idTontine',$idtontine)->findAll();
   }
   function Noscotisation($idtontine){
    
       return $this->join("cotiser as c","c.idEcheance=echeance.id")
                    ->where("echeance.idTontine",$idtontine)
                   ->where("c.idAdherant",session()->get("id"))->findAll();;
   }

}
