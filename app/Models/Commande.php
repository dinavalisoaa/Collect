<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{ protected $table = 'commande';

    /**
     * @var array $fillable
     */

public $timestamps = false;
protected $guard=['updated_at','created_at'];
    use HasFactory;

    public static function list(){
        $tab = Commande::fromQuery("select * from v_commandeClient");
        return $tab;
    }
    public function getEtat(){
        $tab = Commande::find($this->id)->get();
        return $tab[0]['etat'];//$tab[0]->etat;
    }

    public static function last(){
        $tab = Commande::fromQuery("select * from commande order by id desc limit 1");
        return $tab[0];
    }
    public function getLivraison(){
        $detail=Livraison::fromQuery("select * from livraison where commandeid=".$this->id);
        return $detail[0];
    }
    public function sortiePossible(){
        $data=[
            'etat'=>'true',
            'message'=>'possible'
        ];
        $detail=DetailCommande::fromQuery("select * from detailcommande where commandeid=".$this->id);
        foreach ($detail as $row ) {
         if($row->getProduit()->epuise($row->quantite)['etat']=='true'){
            $data=[
                'etat'=>'false',
                'message'=>'Stock epuisé:'.$row->getProduit()->nom
            ];
            return $data;
         }
        }
        if(count($detail)==0){
            $data=[
                'etat'=>'false',
                'message'=>'No command' ];
            return $data;
        }
    
        return $data;
    }

    public static function details($id){
        $tab = Commande::fromQuery("select d.*,p.nom from detailcommande d join produit p on d.produitid = p.id where commandeid = ".$id);
        return $tab;
    }

    public static function progression($commandeid){
        $tab = Commande::fromQuery("select commandeid,sum(commande) as commande,sum(livraison) as livraison from v_progressionCommandeClient where commandeid = ".$commandeid." group by commandeid");
        if(count($tab) > 0){
            $commande = $tab[0]['commande'];
            $livraison = $tab[0]['livraison'];
            $progression = ($livraison * 100) / $commande;
        }
        else{
            $progression = 0;
        }
        return $progression;
    }

}

