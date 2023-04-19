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

    public function stocks(){
        return $this->hasMany(Stock::class, 'produitid')->orderBy('dateentree', 'desc');
    }
}
