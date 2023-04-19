<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model{
    protected $table = "etatstock";
    protected $fillable = [
        'id',
        'produitid',
        'quantite',
        'dateentree',
        'prixunitaire',
    ];
    public $timestamps = false;
    use HasFactory;

    public function total(){
        return $this->quantite * $this->prixunitaire;
    }
}
