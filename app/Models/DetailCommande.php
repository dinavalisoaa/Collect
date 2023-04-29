<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCommande extends Model
{ 
    protected $table = 'detailcommande';

    /**
     * @var array $fillable
     */

public $timestamps = false;

    use HasFactory;
   
    public  function getCommande(){
        return Commande::find($this->commandeid);
    }
    public static function details($commandeid){
        $tab = Statistique::fromQuery("select * from DetailCommande where commandeid = ".$commandeid);
        return $tab;
    }
    public function getProduit(){
        return Produit::find($this->produitid);
    }
}
