<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Transport extends Model{
    use HasFactory;
    protected $table='transport';
    protected $fillable=[
        'idsociete',
        'nom',
        'contact',
        'idsociete',
        'type',
        'capacite',
        'immatriculation',
        'etat',
        'marque'

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
    
    public static function allShipping() {
        $companies = Cache::remember('companies', now()->addHour(), function () {
            return Transport::get(['id', 'immatriculation']);
        });
        return $companies;
    }
}
