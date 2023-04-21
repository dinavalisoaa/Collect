<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
     protected $table='contrattransport';
     protected $fillable=[
        'id',
        'montant',
        'etatpaiment',
        'transportid',
        'duree',
        'datedebut'
     ];
     public $timestamps=false;
}
