<?php

namespace App\Controllers;
helper(['html','form']);
use App\Models\TontineModel;

class adherent extends BaseController
{
    public function index(){
        $model=new TontineModel();
        $idAdherent=session()->get("id");
        $listeTontineResp=$model->ListeTontineResp($idAdherent);   
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"adherentAcc"];
        echo view('layout/entete',$data);
        echo view("adherent/index");
        echo view("layout/pied");

    }
}