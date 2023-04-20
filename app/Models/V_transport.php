<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class V_transport extends Model
{
    use HasFactory;
    protected $table = 'v_transport';
    protected $fillable = [
        'idSociete',
        'idtransport',
        'transport',
        'contact',
        'societe'
    ];
    public $timestamps = false;
}
