<?php 
namespace App\Models;
use CodeIgniter\Model;
class EcheanceModel extends Model{
	protected $table="echeance";
	protected $allowedFields=["id","date","numero"];
    function generer($tabEcheance){
        return $this->insertBatch($tabEcheance);
    }

}
