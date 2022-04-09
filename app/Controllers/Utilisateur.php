<?php

namespace App\Controllers;
use App\Models\AdherentModel;
helper(['html','form']);

class Utilisateur extends BaseController
{
     public function index()
    {
         $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"connexion"];
       
        if($this->request->getMethod()=="post"){
            $reglesValid=[
            "motPasse"=>["rules"=>"required|utilisateurValide[login,motPasse]","errors"=>["required"=>"le mot de passe est obligatoire","utilisateurValide"=>"Email et/ou mot de passe incorrect(s)"]],
    


            ];
           if(!$this->validate($reglesValid)){
             
            $data['validation']=$this->validator;
           }
           else{
              $model=new AdherentModel();
              $user=$model->where('login',$this->request->getPost('login'))
                          ->where('motPasse',$this->request->getPost('motPasse'))
                          ->first();
                          $data=[
                              "id"=>$user["id"],
                              "nom"=>$user["nom"],
                              "prenom"=>$user["prenom"],
                              "login"=>$user["login"],
                              "profil"=>$user["profil"],
                          ];
                          session()->set($data);
                          return redirect()->to(base_url($user["profil"]));


           }
            
        }
        echo view('layout/entete',$data);
        echo view('utilisateur/index');
        echo view('layout/pied');

    }
    public function inscription()
    {
         $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"inscription"];
         if($this->request->getMethod()=="post"){
            $reglesValid=["nom"=>["rules"=>"required","errors"=>["required"=>"le nom est obligatoire"]],
            "prenom"=>["rules"=>"required","errors"=>["required"=>"le prenom est obligatoire"]],
            "login"=>["rules"=>"required|min_length[6]","errors"=>["required"=>"le nom est obligatoire","min_length"=>"le login doit comporter au moins 6 caractères"]],
            "motPasse"=>["rules"=>"required","errors"=>["required|min_length[6]"=>"le mot de passe est obligatoire","min_length"=>"le mot de passe doit comporter au moins 6 caractères"]],
            "motPasseConf"=>["rules"=>"required|matches[motPasse]","errors"=>["required"=>"la Confirmation du mot de passe est obligatoire","matches"=>"la confirmation doit étre identique au mot de passe"]]


            ];
            if(!$this->validate($reglesValid)){
                $data['validation']=$this->validator;
            }
            else{
                $adherentData=[
                    "nom"=>$this->request->getPost('nom'),
                    "prenom"=>$this->request->getPost('prenom'),
                    "login"=>$this->request->getPost('login'),
                    "motPasse"=>$this->request->getPost('motPasse'),
                    "profil"=>"adherent"
                ];
                $adherent=new AdherentModel();
                $adherent->insert($adherentData);
                $session=session();
                $session->setFlashdata('success','inscription réussie. Connectez-vous');
                return redirect()->to('utilisateur');
            
            }
        }
         
        echo view('layout/entete',$data);
        echo view('utilisateur/inscription');
        echo view('layout/pied');

    }
    public function deconnexion(){
        session()->destroy();
        return redirect()->to("Utilisateur/deconnexionMessage");
        
    }
    public function deconnexionMessage(){
        $session=session();
        $session->setFlashdata("success","Deconnexion réussie");
        return redirect()->to("utilisateur");
    }
}
