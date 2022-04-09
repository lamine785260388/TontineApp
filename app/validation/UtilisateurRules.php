<?php 
namespace App\validation;
use App\Models\AdherentModel;
class UtilisateurRules{
    public function utilisateurValide (string $str,string $fields, array $data){
        $model=new AdherentModel();
        $user=$model->where("login",$data["login"])
                    ->where("motPasse",$data["motPasse"])
                    ->first();
                    return $user?true:false;


    }
}