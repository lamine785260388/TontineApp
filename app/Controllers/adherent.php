<?php

namespace App\Controllers;
helper(['html','form']);

use App\Models\AdherentModel;
use App\Models\TontineModel;
use App\Models\ParticipeModel;
use App\Models\EcheanceModel;
use App\Models\cotiseModel;
use CodeIgniter\I18n\Time;

class adherent extends BaseController
{
  
    public function index(){
        $model=new TontineModel();
        $idAdherent=session()->get("id");
        $tontinesParticiper=$model->tontineParticiper($idAdherent);
        $listeTontineResp=$model->ListeTontineResp($idAdherent); 
        $data["tontinesParticiper"]=$tontinesParticiper;  
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"adherentAcc","listeTontineResp"=>$listeTontineResp,"tontinesParticiper"=>$tontinesParticiper];
        echo view('layout/entete',$data);
        echo view("adherent/index");
        echo view("layout/pied");

    }
    public function echeanceTontine($idtontine){
          
        //1.recupérer  les infos
        $tontine=new TontineModel();
        $maTontine=$tontine->tontine($idtontine);
        //2.ajouter à la liste des données t$ransmises
        $data=["titre"=>"Sama tontine::Acceuil adherent","menuActif"=>"adherentAcc"];
        $data["maTontine"]=$maTontine;
        
       
       //Echeances 
       $modelEcheance=new EcheanceModel();
       $echeances=$modelEcheance->echeancesTontine($idtontine);
       $data["echeances"]=$echeances;
       $cotisationsfaite=$modelEcheance->Noscotisation($idtontine);
      $data["cotisationsfaite"]=$cotisationsfaite;
     
       echo view('layout/entete',$data);
      echo view("adherent/Echeancetontine");
       echo view("layout/pied");
        
    }
    public function payerEcheance($idAdherent,$idtontine,$idEcheance){
        //1.inserer la cotisation à travers le modele cotise
        $modelcotise=new cotiseModel();
        $modelcotise->insert(["idAdherant"=>$idAdherent,"idEcheance"=>$idEcheance]);
        //2.Revenir sur la page tontine avec le message de confirmation
 $session=session();
 $session->setFlashdata("successajCotise"," Cotisations enregistré");
  return redirect()->to("adherent/tontine/".$idtontine);

    }
    public function genererEcheance($idTontine){
        //1.Récupérer les informations sur la tontine courante
        $model=new TontineModel();
        $maTontine=$model->tontine($idTontine);
        //2.créer un tableau des échéances
        $tabEcheance=[];
        $dateDeb=Time::createFromFormat('Y-m-d',$maTontine["dateDeb"]);       
         for($i=1;$i<=$maTontine["nbEcheance"];$i++){
            $tabEcheance[]=["date"=>$dateDeb->toDateString(),'numero'=>$i,'idTontine'=>$idTontine];
            if($maTontine["periodicite"]=="mensuelle"){ 
                $dateDeb=$dateDeb->addMonths(1);
            }
            else{
                $dateDeb=$dateDeb->addDays(7);
            }
        }
        //3.Insérer le tableau dans la base de donné

        $modelEcheance=new EcheanceModel();
        $nbInserer=$modelEcheance->generer($tabEcheance);
        //4.rediriger l'utilisateur sur la page tontine avec un message de confirmation
        $session=session();
        $session->setFlashdata("successajEcheance",$nbInserer." échéances ajoutées");
        return redirect()->to('adherent/tontine/'.$idTontine); 


    }
    public function adhererTontine($idTontine){
        $data=["titre"=>"Sama tontine::Acceuil adherent","menuActif"=>"adhesion"];
        if($this->request->getMethod()=="post"){
            $reglesValid=[
                "Montant"=>["rules"=>"required|integer",
                "errors"=>["required"=>"le montant est obligatoire","integer"=>"le montant doit etre un entier"]
                ]
            ];
        
    if(!$this->validate($reglesValid)){
        $data["validation"]=$this->validator;
    }else{
        $participeData=[
            "idTontine"=>$idTontine,
            "Montant"=>$this->request->getPost('Montant'),
            "idAdherant"=>session()->get('id')
        ];
        $participe=new ParticipeModel();
        $participe->insert($participeData);
        $session=session();
        $session->setFlashdata("successAdhesion","Adhésion effectué avec succés");
        return redirect()->to("adherent/adhesion");
    }
        } else{
            $data["idTontine"]=$idTontine;
        }
        echo view('layout/entete',$data);
        echo view("adherent/ajoutAdhesion");
       echo view("layout/pied");
    
    }
    public function adhesion(){
        $data=["titre"=>"Sama tontine::Acceuil adherent","menuActif"=>"adhesion"];
        //1.Instancier le modéle et recupérer les tontines disponible
        $idAdherent=session()->get('id');
        $model=new TontineModel();
        $listeTontine=$model->listeTontines($idAdherent);
//2.ajouter à la liste des données transmises
   $data["listeTontines"]=$listeTontine;
   echo view('layout/entete',$data);
         echo view("adherent/adhesion");
        echo view("layout/pied");

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
        $participants=$participe->participer($idtontine);
        //4.ajouter à la liste des donés transmise
        $data["participants"]=$participants;
        //5.récupérer la liste des échéances 
        $modelEcheance=new EcheanceModel();
        $echeances=$modelEcheance->echeancesTontine($idtontine);
      $data["echeances"]=$echeances;
        //recupére le nombre de cotisations par adherent
        $modelAd=new AdherentModel();
        $cotisation=$modelAd->cotiser($idtontine);
        $data["cotisations"]=$cotisation;
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