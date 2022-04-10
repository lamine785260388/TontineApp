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
    function ListeTontine($idAdherent){
//1.Recupérer la liste des tontines auxquelles l'aherent participent
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
}