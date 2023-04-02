<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collecteur extends Model
{
    use HasFactory;
    protected $table = 'collecteur';
    public $timestamps = false;
    public static function login($email, $mdp)
    {
        $tab = Collecteur::fromQuery("select *From collecteur where login='" . $email . "' and mdp='" . $mdp . "' limit 1");
        $id = 0;
        if (count($tab) == 0) {
            return -1;
        }
        return $tab[0]['id'];
    }

}
