<?php 
namespace App\Models;
use CodeIgniter\Model;
class cotiseModel extends Model{
	protected $table="cotiser";
	protected $allowedFields=["idAdherant","idEcheance"];


}
