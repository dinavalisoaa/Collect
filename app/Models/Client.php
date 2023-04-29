<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{ protected $table = 'client';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $adresse;
protected $email;
protected $telephone;

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'adresse',
        'email',
        'telephone'
    ];
    use HasFactory;

    public function ifExist(){
        $tab = Statistique::fromQuery("select * from Client where nom = '".$this->nom."' and adresse = '".$this->adresse."' and email = '".$this->email."' and telephone = '".$this->telephone."'");
        if(count($tab) > 0){
            return true;
        }
        return false;
    }

    public static function findname($mot){
        $tab = Statistique::fromQuery("select * from Client where upper(nom) like upper('%". $mot ."%')");
        return $tab;
    }
}
