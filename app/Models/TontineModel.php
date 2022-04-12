<?php 
namespace App\Models;
use CodeIgniter\Model;
class TontineModel extends Model{
    protected $table="tontine";
    protected $allowedFields=["nom","periodicite","dateDeb","nbEcheance","idResponsable"];
    function ListeTontineResp($idAdherent){
        return $this->where("idResponsable",$idAdherent)
                    ->findAll();
    }
    function tontine($idtontine){
        return $this->find($idtontine);

    }
    function listeTontines($idAdherent){
//1.Recupérer la liste des tontines auxquelles l'aherent participent builder parceque c'est une autre table
$listPart=$this->builder("participer")
->distinct()
->select('idTontine')
->where("idAdherant",$idAdherent)->get()->getResultArray(); 
//2. garder les idTontines dans ce tableau
$idTons=[];
foreach($listPart as $tp)
$idTons[]=$tp["idTontine"];
//3.Recupérer la liste des tontines sans les tontines déja choisies
if($idTons)
$this->whereNotIn("id",$idTons);
 return $this->findAll();
    }
    function tontineParticiper($idAdherent){
    return    $this->join("participer as p","p.idTontine=tontine.id")
                   ->where("p.idAdherant",$idAdherent)
                   ->findAll();

    }
    public function nombretontine(){
	
        $cotis=$this->select("id")->findAll();
        $i=0;
        foreach($cotis as $count){
           $i=$i+1;
        }
       
        return $i;
                  
   }
}