<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model{
    protected $table = 'produit';
    protected $fillable = [
        'id',
        'nom',
        'typeproduitid',
        'dureeperemption',
        'modeconservation',
        'debutsaison',
        'finsaison',
        'saisonid',
        'dureeprremption',
        'modeconservation',
        'typestockid',
    ];
    public function getTypeProduit()
    {
        return TypeProduit::find($this->typeproduitid);
    }
    public function getSaison()
    {
        return Saison::find($this->saisonid);
    }

    public $timestamps = false;
    use HasFactory;

    public function mouvements(){
        return $this->hasMany(Mouvement::class, 'produitid')->orderBy('date', 'desc');
    }

    public function typestock(){
        return $this->belongsTo(TypeStock::class, 'typestockid');
    }

    public function stocks(){
        $val = $this->hasMany(Stock::class, 'produitid')->where('quantite', '<>', 0)->orderBy('id', 'desc');
        if($val->count() == 0){
            $stk = new Stock();
            $stk->quantite = 0;
            $stk->prixunitaire = 0;
            $val->add($stk);
        }
        return $val;
    }
    public function getPrixAchat(){
        $etat = EtatStock::find($this->id);
        return $etat->valeurstock/$etat->quantitestock;
    }

    public function addEntree(Mouvement $mouv){
        if($this->typestockid==1){
            $stock = Stock::where('produitid', $this->id)->get()[0];
            $total = $stock->total();
            $stock->quantite += $mouv->quantite;
            $stock->prixunitaire = ($total + $mouv->montant()) / $stock->quantite;
            $stock->save();
        } else {
            $stock = new Stock();
            $stock->produitid = $this->id;
            $stock->quantite = $mouv->quantite;
            $stock->dateentree = $mouv->date;
            $stock->prixunitaire = $mouv->prixunitaire;
            $stock->save();
        }
        $mouv->save();
    }
    public function epuise($qte) {
        $etat = EtatStock::find($this->id);
        $data=[
            'etat'=>'false',
            'message'=>'Possible'
        ];
        if(!isset($etat) || $etat->quantitestock < $qte)
        { 
            $data=[
                'etat'=>'true',
                'message'=>'Quantité en stock:'.$etat->quantitestock
            ];
        return $data;
        }
        return $data;
    }

    public function addSortie(Mouvement $mouv,$idl){
        $etat = EtatStock::find($this->id);
        if(!isset($etat) || $etat->quantitestock < $mouv->quantite)
        { 
            // return "dasdinsaidniasndiasdn";
            throw new \Exception('Pas asser en stock! Produit'.$mouv->produitid);
        }
        {
        $type = $this->typestockid;
        $mouv->quantite = -$mouv->quantite;
        $quant = $mouv->quantite;
        $ord = '';
        if($type == 2) $ord = 'asc';
        else if($type == 3) $ord = 'desc';
        if($type == 1){
            $stock = Stock::where('produitid', $this->id)->get()[0];
            $mouv->prixunitaire = $stock->prixunitaire;
            $total = $stock->total();
            $stock->quantite += $quant;
            $stock->save();
            $mouv->save();
        } else {
            $stocks = Stock::where('produitid', $this->id)
            ->where('quantite', '<>', 0)
            ->orderBy('id', $ord)
            ->get();
            foreach ($stocks as $stock) {
                $mv = new Mouvement();
                $mv->prixunitaire = $stock->prixunitaire;
                $mv->date = $mouv->date;
                $mv->produitid = $this->id;
                $mv->engardid = $mouv->engardid;
                $origin = $quant;
                $quant += $stock->quantite;
                if($quant > 0) $quant = 0;
                if($quant != 0){
                    $mv->quantite = -$stock->quantite;
                    $mv->save();
                    $stock->quantite = 0;
                    $stock->save();
                } else if($quant == 0) {
                    $mv->quantite = $origin;
                    $mv->save();
                    $stock->quantite += $origin;
                    $stock->save();
                    break;
                }
            }
        }
        $taille=Livraison::fromQuery("select *from livraison where commandeid=".$idl);
        if(count($taille)==0){
            $livre = new Livraison();
            $livre->commandeid =$idl;
            $livre->date= Util::now();
            $livre->save();
        }
      

        $dlivraison=new DetailLivraison();
        $dlivraison->livraisonid= Livraison::getLast();
        $dlivraison->produitid=    $mouv->produitid;
        $dlivraison->quantite=    $mouv->quantite;
        $dlivraison->save();
    }
}   
}
