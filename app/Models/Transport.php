<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model{
    use HasFactory;
    protected $table='transport';
    protected $fillable=[
        'idsociete',
        'nom',
        'contact'
    ];
    public $timestamps=false;
    //exemple getter
    public function getNameAttribute($value){
        return ucfirst($value);
    }
    // Setter pour le nom
    // public function setNameAttribute($value) {
    //     $this->attributes['name'] = strtolower($value);
    // }
}
