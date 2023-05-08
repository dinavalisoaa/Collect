<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produit extends Model{
    protected $table = 'produit';
    protected $fillable = [
        'id',
        'nom',
        'typeproduitid',
        'saisonid',
        'dureeprremption',
        'modeconservation',
        'typestockid',
    ];
    public $timestamps = false;
    use HasFactory;

    public function mouvements(){
        return $this->hasMany(Mouvement::class, 'produitid')->orderBy('date', 'desc');
    }

    public function typestock(){
        return $this->belongsTo(TypeStock::class, 'typestockid');
    }

    PUBLIC function resumeStock(){
        $res = DB::select('SELECT VE.PRODUITID,COALESCE(VE.TOTALENTREE, 0) TOTALENTREE,COALESCE(VS.TOTALSORTIE, 0) TOTALSORTIE FROM V_ENTREE VE JOIN V_SORTIE VS ON VE.PRODUITID=VS.PRODUITID WHERE VE.PRODUITID=? LIMIT 1', [$this->id]);
        if(!empty($res)) return $res[0];
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

    public function addEntree(Mouvement $mouv){
        if($this->typestockid==1){
            $stock = Stock::where('produitid', $this->id)->first();
            if(!$stock) {
                $stock = new Stock();
                $stock->produitid = $this->id;
            }
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

    public function addSortie(Mouvement $mouv){
        $etat = EtatStock::find($this->id);
        if(!isset($etat) || $etat->quantitestock < $mouv->quantite) throw new \Exception('Pas asser en stock!');
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
    }
}
