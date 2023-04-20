<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeStock extends Model{
    protected $table = "typestock";
    protected $fillable = [
        'id',
        'nom',
    ];
    public $timestamps = false;
    use HasFactory;
}
