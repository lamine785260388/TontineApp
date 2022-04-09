<?php 
namespace App\Models;
use CodeIgniter\Model;
class TontineModel extends Model{
    protected $table="tontine";
    protected $allowedFields=["nom","périodicite","dateDeb","nbEcheance","idResponsable"];
    function ListeTontineResp($idAdherent){
        return $this->where("idResponsable",$idAdherent)
                    ->findAll();
    }
    function tontine($idtontine){
        return $this->find($idtontine);

    }
}