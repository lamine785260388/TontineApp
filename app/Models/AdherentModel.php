<?php 
namespace App\Models;
use CodeIgniter\Model;
class AdherentModel extends Model{
	protected $table="adherent";
	protected $allowedFields=["nom","prenom","login","motPasse","profil"];
}
