<?php

namespace App\Controllers;

use App\Models\AdherentModel;
use App\Models\ParticipeModel;
use App\Models\TontineModel;

helper(['html','form']);

class administrateur extends BaseController
{
    public function index(){
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontines administrateur","menuActif"=>"administrateurAcc"];
        $model=new AdherentModel();
        $nombreAdherent=$model->nombreadherent();
        $data["nombreadherent"]=$nombreAdherent;
        $modelTontine=new TontineModel();
        $nombreTontine=$modelTontine->nombretontine();
       $data["nombreTontine"]=$nombreTontine;
       $modelParticipant=new ParticipeModel();
       $data["nombreParticipant"]=$modelParticipant->nombreParticipant();
        echo view("layout/entete",$data);
        echo view("administrateur/administrateur");
        echo view("layout/pied");
    }
    public function changeMotPasse($iduser){
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontines administrateur","menuActif"=>"administrateurgest"];
        if($this->request->getMethod()=="post"){
            $reglesValid=[
            "motPasse"=>["rules"=>"required|min_length[6]","errors"=>["required"=>"le mot de passe est obligatoire","min_length"=>"le mot de passe doit contenir au minimum 6 caratctéres"]],
            "confirmation"=>["rules"=>"required|matches[motPasse]","errors"=>["required"=>"la confirmation est obligatoire","matches"=>"la confirmation de mot de passe doit étre identique"]],
    


            ];
           if(!$this->validate($reglesValid)){
             
            $data['validation']=$this->validator;
           }
           else{

     $model=new AdherentModel();
            $adherentData=[
                "id"=>$this->request->getPost('id'),
                "motPasse"=>$this->request->getPost('motPasse'),
                
            ];
            $model->save($adherentData);
            $session=session();
            
            $session->setFlashdata("success","Mot de passe changé avec succés");
           return redirect()->to("administrateur/gestionUtilisateur");

           }
            
        }
        else{
            $data["iduser"]=$iduser;
        }
      
        echo view("layout/entete",$data);
        echo view("administrateur/changeMotPasse");
        echo view("layout/pied");
    }
    public function gestionUtilisateur(){
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontines administrateur","menuActif"=>"administrateurgest"];
        //1 recupérer la liste des utilisateur
        $modeladherent=new AdherentModel();
        $listeUtilisateur=$modeladherent->listeUtilisateur();

       $data["listeUtilisateur"]=$listeUtilisateur;
        echo view("layout/entete",$data);
        echo view("administrateur/listeUtilisateur");
        echo view("layout/pied");
       
    }
}