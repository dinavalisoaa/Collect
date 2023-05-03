<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model{
    use HasFactory;
    protected $table='livraison';
    protected $fillable=[
        'id',
        'nom'
    ];
    public function getCommande()
    {
        // $i=Livraison::fromQuery("select *from livraison")
        # code...
    }
    public $timestamps=false;
    public static function getLast(){
        $tab = Livraison::fromQuery("select * from livraison order by id desc limit 1");
        return $tab[0]->id;
    }
    public function getResteApayer(){
        $d=Livraison::fromQuery("select sum(prixunitaire)*sum(quantite) total from detailcommande where commandeid=".$this->commandeid);
        $payer=$d[0]->total;
    
        $d2=Paiement::fromQuery("select sum(montant) total from paiement where livraisonid=".$this->id);
        $deja_payer=$d2[0]->total;
    return $payer-$deja_payer;
    
    }
}
