<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engard extends Model{
    protected $table = 'engard';
    protected $fillable = [
        'id',
        'nom',
        'latitude',
        'longitude',
        'regionid',
    ];
    public $timestamps = false;
    use HasFactory;
}
