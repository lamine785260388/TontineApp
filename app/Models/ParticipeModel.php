<?php 
namespace App\Models;
use CodeIgniter\Model;
class ParticipeModel extends Model{
	protected $table="participer";
	protected $allowedFields=["idTontine","idAdherant","Montant"];
	public function nombreParticipant(){
	
        $cotis=$this->select("id")->findAll();
        $i=0;
        foreach($cotis as $count){
           $i=$i+1;
        }
       
        return $i;
                  
   }

}
