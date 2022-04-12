<?php
namespace App\Filters;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdministrateurFilter implements FilterInterface{
 public function before(RequestInterface $request, $arguments = null)
 {
     if(session()->get('profil')!="administrateur"){
      
         session()->setFlashdata("nonAutorise","Accés non autorisé");
         return redirect()->to(session()->get('profil'));
     }
 }   
 public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
 {
     
 }

}
