<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanningCollect extends Model
{
    use HasFactory;
    protected $table = 'planningcollecte';
    public $timestamps = false;
    public function getProduit()
    {
        return Produit::find($this->produitid);

    }
}
