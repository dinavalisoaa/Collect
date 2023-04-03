<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produit';
    public $timestamps = false;
    public function getTypeProduit()
    {
        return TypeProduit::find($this->typeproduitid);
    }
    public function getSaison()
    {
        return Saison::find($this->saisonid);
    }
}
