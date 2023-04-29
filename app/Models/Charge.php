<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;
    protected $table = 'charge';
    public $timestamps = false;
    public function getType()
    {
        return TypeCharge::find($this->typechargeid);
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
