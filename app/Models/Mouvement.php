<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouvement extends Model{
    protected $table = 'mouvementstock';
    protected $fillable = [
        'id',
        'prixunitaire',
        'quantite',
        'date',
        'produitid',
        'engardid',
    ];
    public $timestamps = false;
    use HasFactory;

    public function produit(){
        return $this->belongsTo(Produit::class, 'produitid');
    }

    public function setPrixunitaireAttribute($value){
        if(!is_numeric($value)) throw new \Exception('Le prix unitaire doit etre numeric!');
        if($value < 0) throw new \Exception('Le prix unitaire ne doit pas etre negatif!');
        $this->attributes['prixunitaire'] = $value;
    }

    public function setQuantiteAttribute($value){
        if(!is_numeric($value)) throw new \Exception('La quantite doit etre numeric!');
        if($value == 0) throw new \Exception('La quantite ne doit pas etre 0');
        $this->attributes['quantite'] = $value;
    }

    public function setDateAttribute($value){
        if(!strtotime($value)) throw new \Exception('Date invalide!');
        if(strtotime($value) > strtotime('today')) throw new \Exception('La date ne doit pas etre apres aujourd\'hui!');
        $this->attributes['date'] = $value;
    }
}
