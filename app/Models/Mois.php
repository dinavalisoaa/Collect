<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mois extends Model
{ protected $table = 'mois';

    /**
     * @var array $fillable
     */
protected $id;
protected $nom;
protected $abreviation;

protected $guard=['updated_at','created_at'];
    protected $fillable = [
        'id',
        'nom',
        'abreviation'
    ];
    use HasFactory;
}
