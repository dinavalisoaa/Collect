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

    /**
     * @var array $fillable
     */
    protected $id;
    protected $nom;
    protected $typeproduitid;
    protected $dureeperemption;
    protected $modeconservation;
    protected $debutsaison;
    protected $finsaison;

    protected $guard = ['updated_at', 'created_at'];
    protected $fillable = [
        'id',
        'nom',
        'typeproduitid',
        'dureeperemption',
        'modeconservation',
        'debutsaison',
        'finsaison'
    ];
}
