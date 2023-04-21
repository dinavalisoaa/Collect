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

    public function __construct()
    {
        $this->attributes['quantite'] = 0;
        $this->attributes['prixunitaire'] = 0.0;
    }

    public function total(){
        return $this->quantite * $this->prixunitaire;
    }

    public function formatTotal(){
        return number_format($this->quantite * $this->prixunitaire, 2, '.', ' ');
    }

    public function formatPU(){
        return number_format($this->prixunitaire, 2, '.', ' ');
    }
}
