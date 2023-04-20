<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    use HasFactory;
    protected $table = 'collect';
    public $timestamps = false;
    // produitid | pointcollectid | collecteurid | planningcollecteid
    public function getProduit()
    {
        return Produit::find($this->produitid);
    }
    public function getCollecteur()
    {
        return Collecteur::find($this->collecteurid);
    }
    public function getPlanningCollecte()
    {
        return PlanningCollect::find($this->planningcollecteid);
    }

    // public static function login($email, $mdp)
    // {
    //     $tab = Collecteur::fromQuery("select *From collecteur where login='" . $email . "' and mdp='" . $mdp . "' limit 1");
    //     $id = 0;
    //     if (count($tab) == 0) {
    //         return -1;
    //     }
    //     return $tab[0]['id'];
    // }

}
