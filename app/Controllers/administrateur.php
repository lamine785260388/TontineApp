<?php

namespace App\Controllers;
helper(['html','form']);

class administrateur extends BaseController
{
    public function index(){
        $data=["titre"=>"sama Tontine::Faciliter la gestion des tontines administrateur","menuActif"=>"administrateurAcc"];
        echo view("layout/entete",$data);
        echo view("administrateur/administrateur");
        echo view("layout/pied");
    }
}