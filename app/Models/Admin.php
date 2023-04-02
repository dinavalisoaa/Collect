<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{ protected $table = 'admin';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $email;
protected $mdp;

protected $guard=['updated_at','created_at']; 
    protected $fillable = [
        'id',
        'nom',
        'email',
        'mdp'
    ];
    use HasFactory;
    public static function login($email,$mdp){
        $tab=Admin::fromQuery("select *From Admin where Email='".$email."' and mdp=md5('".$mdp."') limit 1");
        $id=0;
        if(count($tab)==0){
            return -1;
        }
        return $tab[0]['id'];

    }
}
