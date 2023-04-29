<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatStock extends Model{
    protected $table = "v_etatstock";
    protected $primaryKey = 'produitid';
    protected $fillable = [
        'produitid',
        'valeurstock',
        'quantitestock',
    ];
    public $timestamps = false;
    use HasFactory;
    public function sortie()
    {
        
        # code...
    }
}
