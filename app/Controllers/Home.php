<?php

namespace App\Controllers;
helper(['html','form']);

class Home extends BaseController
{
    public function index()
    {
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"acceuil"];
      echo view('layout/entete',$data);
      echo view('welcome_message');
      echo view('layout/pied');
    }
    public function contact()
    {

         echo view('layout/entete');
        echo view('contact');
        echo view('layout/pied');
    }
    public function presentation(){
         $data=["titre"=>"sama Tontine::Faciliter la gestion des tontine","menuActif"=>"presentation"];
        echo view('layout/entete',$data);
        echo view("presentation");
        echo view('layout/pied');
    }
}
