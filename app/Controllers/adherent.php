<?php

namespace App\Controllers;
helper(['html','form']);

use App\Models\AdherentModel;
use App\Models\TontineModel;
use CodeIgniter\I18n\Time;

class adherent extends BaseController
{
    public function index(){
        $model=new TontineModel();
        $idAdherent=session()->get("id");
        $listeTontineResp=$model->ListeTontineResp($idAdherent);   
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"adherentAcc","listeTontineResp"=>$listeTontineResp];
        echo view('layout/entete',$data);
        echo view("adherent/index");
        echo view("layout/pied");

    }
    public function adhesion(){
        $data=["titre"=>"Sama tontine::Acceuil adherent","menuActif"=>"adherent"];
        //1.Instancier le modéle et recupérer les tontines disponible
        $idAdherent=session()->get('id');
        $model=new TontineModel($idAdherent);
        $listeTontine=$model->listeTontines();
//2.ajouter à la liste des données transmises
   $data["listeTontines"]=$listeTontine;
    }
    public function supprimerTontine($idtontine){
        $tontine=new TontineModel();
        $tontine->delete($idtontine);
        $session=session();
        $session->setFlashdata("successAjTontine","Suppression effectué");
        return redirect()->to('adherent');


    }
    public function tontine($idtontine){
       
        //1.recupérer  les infos
        $tontine=new TontineModel();
        $maTontine=$tontine->tontine($idtontine);
        //2.ajouter à la liste des données transmises
        $data=["titre"=>"Sama tontine::Acceuil adherent","menuActif"=>"adherentAcc"];
        $data["maTontine"]=$maTontine;
        //3.listes des participants
        $participe=new AdherentModel();
        $parricipants=$participe->participer($idtontine);
        $data["participants"]=$parricipants;
        

        
        echo view('layout/entete',$data);
         echo view("adherent/tontine");
        echo view("layout/pied");
    }
    public function modifierTontine($idtontine){
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"adherentAcc"];
        $data["periodicite"]=["mensuelle"=>"mensuelle","hebdomadaire"=>"hebdomadaire"];
        $data["nbEcheance"]=[1=>1,2,3,4,5,6,7,8,9,10,11,12];
        $reglesValid=[
            "nom"=>["rules"=>"required","errors"=>["required"=>"nom de la tontine obligatoire"]
        ],
        "periodicite"=>["rules"=>"required","errors"=>["required"=>"périodicité obligatoire"]],
        "dateDeb"=>["rules"=>"required|valid_date[d/m/Y]",
        "errors"=>["required"=>"Date de début obligatoire", "valid_date"=>"Date non valide"]
    ],
    "nbEcheance"=>["rules"=>"required",
    "errors"=>["required"=>"nbEcheance obligatoire"]
],

    ];
    if($this->request->getMethod()=="post"){
    if(!$this->validate($reglesValid)){
        $data["validation"]=$this->validator;
    }else{
        $dateDeb=Time::createFromFormat('d/m/Y',$this->request->getPost("dateDeb"));
        $tontineData=[
            "id"=>$this->request->getPost('id'),
            "nom"=> $this->request->getPost("nom"),
            "periodicite"=>$this->request->getPost('periodicite'),
            "dateDeb"=>$dateDeb->format("Y/m/d"),
            "nbEcheance"=>$this->request->getPost("nbEcheance"),
            "idResponsable"=>session()->get('id')
        ];
        $tontine=new TontineModel();
        $tontine->save($tontineData);
        $session=session();
        $session->setFlashdata("successAjTontine","Tontine modifié avec succés");
        return redirect()->to('adherent');

    }
   
}else{
    $tontine=new TontineModel();
    $maTontine=$tontine->tontine($idtontine);

    $dateDeb=Time::createFromFormat('Y-m-d',$maTontine["dateDeb"]);
    $maTontine["dateDeb"]=$dateDeb->format("d/m/Y");
    $data["tontine"]=$maTontine;

}
echo view('layout/entete',$data);
echo view("adherent/modificationTontine");
echo view("layout/pied");
        
    }
    public function ajouterTontine(){

 
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"adherentAcc"];
        $data["periodicite"]=["mensuelle"=>"mensuelle","hebdomadaire"=>"hebdomadaire"];
        $data["nbEcheance"]=[1=>1,2,3,4,5,6,7,8,9,10,11,12];
        $reglesValid=[
            "nom"=>["rules"=>"required","errors"=>["required"=>"nom de la tontine obligatoire"]
        ],
        "periodicite"=>["rules"=>"required","errors"=>["required"=>"périodicité obligatoire"]],
        "dateDeb"=>["rules"=>"required|valid_date[d/m/Y]",
        "errors"=>["required"=>"Date de début obligatoire", "valid_date"=>"Date non valide"]
    ],
    "nbEcheance"=>["rules"=>"required",
    "errors"=>["required"=>"nbEcheance obligatoire"]
],

    ];
    if($this->request->getMethod()=="post"){
    if(!$this->validate($reglesValid)){
        $data["validation"]=$this->validator;
    }else{
        $dateDeb=Time::createFromFormat('d/m/Y',$this->request->getPost("dateDeb"));
        $tontineData=[
            "nom"=> $this->request->getPost("nom"),
            "periodicite"=>$this->request->getPost('periodicite'),
            "dateDeb"=>$dateDeb->format("Y/m/d"),
            "nbEcheance"=>$this->request->getPost("nbEcheance"),
            "idResponsable"=>session()->get('id')
        ];
        $tontine=new TontineModel();
        $tontine->insert($tontineData);
        $session=session();
        $session->setFlashdata("successAjTontine","Tontine ajoutée avec succés");
        return redirect()->to('adherent');

    }
}
        echo view('layout/entete',$data);
        echo view("adherent/ajoutTontine");
        echo view("layout/pied");
    }
}